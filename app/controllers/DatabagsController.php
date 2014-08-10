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
        $info['action'] = 'modify';
        $info['databag_name'] = $databags;
        $info['item_name'] = $item;
        Debugbar::log($dataItem);
        return View::make('databags/create')
            ->withInfo($info)
            ->withItem($dataItem);
    }

    public function create()
    {
        $databag = new Stdclass();
        return View::make('databags/create')
            ->withDatabag($databag);
    }

    public function store()
    {
        $input = (object) Input::all();
        $item_value = (object) Input::except(['item_name', 'databag_name', '_token', 'action']);

        if ($input->action == 'modify') {
            Chef::put("/data/{$input->databag_name}/{$input->item_name}", $item_value);
        } else {
            Chef::post("/data/{$input->databag_name}", $item_value);
        }

        $successMessage = "Databag {$input->databag_name}/{$input->item_name} saved.";
        return Redirect::route('databags.index')->withSuccess($successMessage);
    }

    public function delete($id)
    {
    }
}
