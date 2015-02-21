<?php

class CookbooksController extends \Controller
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
