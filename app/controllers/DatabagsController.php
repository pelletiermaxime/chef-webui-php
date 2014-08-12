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

    public function create()
    {
        $dataItem = new Stdclass();
        return View::make('databags/create')
            ->withItem($dataItem);
    }

    public function store()
    {
        if (empty($input->action)) {
            return $this->storeCreate();
        }
        $input = (object) Input::all();
        $item_value = (object) Input::except(['item_name', 'databag_name', '_token', 'action']);

        if ($input->action == 'modify') {
            Chef::put("/data/{$input->databag_name}/{$input->item_name}", $item_value);
        } else {
            Chef::post("/data", $item_value);
        }

        $successMessage = "Databag {$input->databag_name}/{$input->item_name} saved.";
        return Redirect::route('databags.index')->withSuccess($successMessage);
    }

    public function storeCreate()
    {
        $item_value = (object) Input::except(['databag_name', '_token']);

        $url = '/data';
        Chef::post($url, $item_value);

        Cache::forget($url);

        $successMessage = "Databag {$item_value->name} created.";
        return Redirect::route('databags.index')->withSuccess($successMessage);
    }

    public function delete($id)
    {
        $url = "/data/$id";
        Chef::delete($url);
        Cache::forget('/data');
        return Redirect::route('databags.index')->withSuccess("Databag $id deleted.");
    }
}
