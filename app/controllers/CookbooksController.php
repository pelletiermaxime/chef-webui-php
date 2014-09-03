<?php

class CookbooksController extends BaseController
{
    public function index()
    {
        $cookbooks = Cache::remember(
            'cookbooks',
            60, //60 minutes
            function () {
                $cookbooks = Chef::get('/cookbooks');
                if (empty($cookbooks)) {
                    return [];
                }
                $cookbooks = (array) $cookbooks;
                ksort($cookbooks);
                return $cookbooks;
            }
        );
        Debugbar::log($cookbooks);

        return View::make('cookbooks/index')
            ->withCookbooks($cookbooks)
            ;
    }
}
