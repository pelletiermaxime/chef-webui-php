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

    public function show($node_name)
    {
        try {
            $node = Cache::remember(
                "node-$node_name",
                60,
                function () use ($node_name) {
                    $node = Chef::get("/nodes/$node_name");
                    $node->run_list = $this->clean_run_list($node->run_list);
                    return $node;
                }
            );
            Debugbar::log($node);
        } catch (Exception $e) {
            return Redirect::route('nodes.index');
        }

        $cookbooks = Cookbooks::getForEnvironment($node->chef_environment);
        Debugbar::log($cookbooks);

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
        $attributes = (object) Input::except(['node_name', '_token', 'run_list']);

        $node = Chef::get("/nodes/{$input->node_name}");

        $attributes = json_decode(json_encode($attributes), false);

        // var_dump($attributes);
        // die;

        // $node->override->nsca->encryption_method = "2";
        // $node->override = $attributes;
        $node->normal = $attributes;
        $node->run_list = explode(' ', trim($input->run_list));
        // $node->attributes->nsca->encryption_method = "2";

        // var_dump($node);

        Chef::put("/nodes/{$input->node_name}", $node);

        Cache::forget("node-{$input->node_name}");

        $successMessage = "Node saved.";
        return Redirect::route('nodes.show', $input->node_name)->withSuccess($successMessage);
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

    private function clean_run_list($run_list)
    {
        $expanded_run_list['recipe'] = [];
        $expanded_run_list['role'] = [];
        foreach ($run_list as $r) {
            $r = rtrim($r, ']');
            list($type, $name) = explode('[', $r);
            $expanded_run_list[$type][] = $name;
        }
        return $expanded_run_list;
    }
}
