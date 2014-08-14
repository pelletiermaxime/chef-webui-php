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
        $redirect = 'databags.index';
        $item_value = (object) Input::except(['databag_name', '_token']);

        $url = '/data';

        if (isset($item_value->databag_item)) {
            $databag_name = $item_value->id;
            // $redirect = 'databags.show';
            $url .= "/{$item_value->databag_item}";
        } else {
            $databag_name = $item_value->name;
        }

        Chef::post($url, $item_value);

        Cache::forget($url);

        $successMessage = "Databag $databag_name created.";
        return Redirect::route($redirect)->withSuccess($successMessage);
    }

    public function delete($id)
    {
        $url = "/data/$id";
        Chef::delete($url);
        Cache::forget('/data');
        return Redirect::route('databags.index')->withSuccess("Databag $id deleted.");
    }
}
