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
            function () use ($node) {
                return Chef::get("/nodes/$node");
            }
        );
        Debugbar::log($node);

        $cookbooks = Cookbooks::get();

        return View::make('nodes/show')
            ->withNode($node)
            ->withAvailableCookbooks($cookbooks)
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

    public function storeCreate()
    {
        $input = Input::except(['_token']);
        $node_name = $input['name'];

        $validator = Validator::make($input, Nodes::$rulesCreate);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $input = (object) $input;

        Chef::post('/nodes', $input);

        Cache::forget('nodes');

        $successMessage = "Node $node_name created.";
        return Redirect::route('nodes.index')->withSuccess($successMessage);
    }

    public function destroy($id)
    {
        $url = "/nodes/$id";
        Chef::delete($url);
        Cache::forget('nodes');
        return Redirect::route('nodes.index')->withSuccess("Node <b>$id</b> deleted.");
    }
}
