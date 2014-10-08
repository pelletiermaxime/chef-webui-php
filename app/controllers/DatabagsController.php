<?php

class DatabagsController extends BaseController
{
    public function index($databagName = '')
    {
        $dataItem = '';
        $url = "/data";
        if ($databagName !== '') {
            $url .= "/$databagName";
            $dataItem = $databagName;
        }
        $databags = Cache::remember(
            $url,
            60, //60 minutes
            function () use($url) {
                $databags = Chef::get($url);
                if (empty($databags)) {
                    return [];
                }
                $databags = (array) $databags;
                ksort($databags);
                return $databags;
            }
        );
        Debugbar::log($databags);

        return View::make('databags/index')
            ->withDataItem($databagName)
            ->withDatabags($databags);
    }

    public function show($databags)
    {
        return $this->index($databags);
    }

    public function editItem($databags, $item)
    {
        $dataItem = Chef::get("/data/$databags/$item");
        $info['databag_name'] = $databags;
        $info['item_name'] = $item;
        Debugbar::log($dataItem);
        return View::make('databags/modify')
            ->withInfo($info)
            ->withItem($dataItem);
    }

    public function create($item = '')
    {
        if (empty($item)) {
            return View::make('databags/create');
        } else {
            return View::make('databags/createItem')
                ->withItem($item);
        }
    }

    public function store()
    {
        if (empty($input->action)) {
            return $this->storeCreate();
        }
        $input = (object) Input::all();
        $item_value = (object) Input::except(['item_name', 'databag_name', '_token', 'action']);

        Chef::put("/data/{$input->databag_name}/{$input->item_name}", $item_value);

        $successMessage = "Databag {$input->databag_name}/{$input->item_name} saved.";
        return Redirect::route($redirect)->withSuccess($successMessage);
    }

    public function storeCreate()
    {
        $item_value = Input::except(['databag_name', '_token']);

        $validationRules = Databags::$rulesCreate;

        if (isset($item_value['databag_item'])) { //Create/modify item
            $validationRules = Databags::$rulesCreateItem;
        }

        $validator = Validator::make($item_value, $validationRules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if (isset($item_value['databag_item'])) {
            return $this->storeCreateItem($item_value);
        }

        $item_value = (object) $item_value;

        $url = '/data';

        $databag_name = $item_value->name;

        $successfulSave = $this->saveDatabag($url, $item_value);
        if ($successfulSave !== true) {
            return $successfulSave;
        }

        $successMessage = "Databag <b>$databag_name</b> created.";
        return Redirect::route('databags.index')->withSuccess($successMessage);
    }

    public function storeCreateItem($item_value)
    {
        $databag_name = $item_value['id'];
        $databag_item_name = $item_value['databag_item'];
        $url = "/data/$databag_item_name";

        $databag_item = new StdClass();
        $databag_item->id = $databag_name;
        if (isset($item_value['item_name'])) {
            foreach ($item_value['item_name'] as $index => $field_name) {
                $field_value = $item_value['item_value'][$index];
                $databag_item->$field_name = $field_value;
            }
        }

        $method = 'post';
        if (isset($item_value['action']) && $item_value['action'] == 'modify') {
            $method = 'put';
            $url = "/data/$databag_item_name/$databag_name";
        }

        $successfulSave = $this->saveDatabag($url, $databag_item, $method);
        if ($successfulSave !== true) {
            return $successfulSave;
        }

        $successMessage = "Databag item <b>$databag_name</b> saved.";
        return Redirect::route('databags.show', $databag_item_name)->withSuccess($successMessage);
    }

    private function saveDatabag($url, $value, $method = 'post')
    {
        try {
            Chef::$method($url, $value);
        } catch (Exception $e) {
            $errorMsg = "Error saving: " . $e->getMessage();
            return Redirect::back()->withErrors($errorMsg)->withInput();
        }

        Cache::forget($url);
        return true;
    }

    public function destroy($id)
    {
        $url = "/data/$id";
        Chef::delete($url);
        Cache::forget('/data');
        return Redirect::route('databags.index')->withSuccess("Databag <b>$id</b> deleted.");
    }

    public function destroyItem($item, $id)
    {
        $url = "/data/$item/$id";
        Chef::delete($url);
        Cache::forget("/data/$item");
        return Redirect::route('databags.show', $item)->withSuccess("Databag <b>$id</b> deleted.");
    }
}
