<?php

class NodesController extends BaseController
{
    public function index()
    {
        $nodes = Cache::remember(
            'nodes',
            60, //60 minutes
            function () {
                $nodes = Chef::get('/nodes');
                if (empty($nodes)) {
                    return [];
                }
                $nodes = (array) $nodes;
                ksort($nodes);
                return $nodes;
            }
        );
        Debugbar::log($nodes);

        return View::make('nodes/index')
            ->withNodes($nodes)
            ;
    }

    public function show($node)
    {
        $node = Cache::remember(
            "node-$node",
            60,
            function() use($node) {
                return Chef::get("/nodes/$node");
            }
        );
        Debugbar::log($node);
        return View::make('nodes/show')
            ->withNode($node)
            ;
    }


    public function create()
    {
        return View::make('nodes/create');
    }

    public function store()
    {
        $input = (object) Input::all();
        $attributes = (object) Input::except(['node_name', '_token']);

        $node = Chef::get("/nodes/{$input->node_name}");

        $attributes = json_decode(json_encode($attributes), FALSE);

        var_dump($attributes);
        // die;

        // $node->override->nsca->encryption_method = "2";
        // $node->override = $attributes;
        $node->normal = $attributes;
        // $node->attributes->nsca->encryption_method = "2";

        var_dump($node);

        Chef::put("/nodes/{$input->node_name}", $node);

        Cache::forget("node-{$input->node_name}");

        $successMessage = "Node saved.";
        // return Redirect::route($redirect)->withSuccess($successMessage);
    }
}
