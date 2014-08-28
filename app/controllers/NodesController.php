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
}
