<?php

class Cookbooks
{
    public static function get()
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
        return $cookbooks;
    }

    public static function create($name, $version)
    {
        $cookbook = new StdClass();
        $cookbook->name = $name;
        $cookbook->version = $version;
        Chef::put("/cookbooks/$name/$version", $cookbook);
        Cache::delete('cookbooks');
    }
}
