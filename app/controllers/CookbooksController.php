<?php

class CookbooksController extends BaseController
{
    public function index()
    {
        $cookbooks = Cookbooks::get();
        Debugbar::log($cookbooks);

        return View::make('cookbooks/index')
            ->withCookbooks($cookbooks)
            ;
    }
}
