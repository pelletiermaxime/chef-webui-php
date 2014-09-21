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

        if (isset($item_value['databag_item'])) {
            return $this->storeCreateItem();
        }

        $validator = Validator::make($item_value, Databags::$rulesCreate);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $item_value = (object) $item_value;

        $url = '/data';

        $databag_name = $item_value->name;

        try {
            Chef::post($url, $item_value);
        } catch (Exception $e) {
            $errorMsg = "Error creating databag: " . $e->getMessage();
            return Redirect::back()->withErrors($errorMsg)->withInput();
        }

        Cache::forget($url);

        $successMessage = "Databag <b>$databag_name</b> created.";
        return Redirect::route('databags.index')->withSuccess($successMessage);
    }

    public function storeCreateItem()
    {
        $item_value = Input::except(['databag_name', '_token']);

        $validator = Validator::make($item_value, Databags::$rulesCreateItem);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

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

        try {
            Chef::post($url, $databag_item);
        } catch (Exception $e) {
            $errorMsg = "Error creating databag item: " . $e->getMessage();
            return Redirect::back()->withErrors($errorMsg)->withInput();
        }

        Cache::forget($url);

        $successMessage = "Databag item <b>$databag_name</b> created.";
        return Redirect::route('databags.show', $databag_item_name)->withSuccess($successMessage);
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
