<?php

class Cookbooks
{
    public static function get()
    {
        $cookbooks = Cache::remember(
            'cookbooks',
            60, //60 minutes
            function () {
                try {
                    $cookbooks = Chef::get('/cookbooks?num_versions=all');
                } catch (Exception $e) {
                    $cookbooks = Chef::get('/cookbooks');
                }
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

    public static function getForEnvironment($env = '_default')
    {
        $cookbooks = Cache::remember(
            "cookbooks_env_$env",
            60, //60 minutes
            function () use ($env) {
                $cookbooks = Chef::get("environments/$env/recipes");
                if (empty($cookbooks)) {
                    return [];
                }
                $cookbooks = (array) $cookbooks;
                sort($cookbooks);
                return $cookbooks;
            }
        );
        return $cookbooks;
    }

    public static function create($name, $version)
    {
        $recipe = new StdClass();
        $recipe->name = 'default.rb';
        $recipe->path = 'recipes/default.rb';

        $metadata = new StdClass();
        $metadata->name = $name;
        $metadata->version = $version;
        $metadata->description = $name;

        $cookbook = new StdClass();
        $cookbook->name          = "$name-$version";
        $cookbook->cookbook_name = $name;
        $cookbook->version       = $version;
        $cookbook->recipes       = [$recipe];
        $cookbook->metadata      = $metadata;
        $cookbook->chef_type     = 'cookbook_version';

        Debugbar::log($cookbook);

        Chef::put("/cookbooks/$name/$version", $cookbook);
        Cache::forget('cookbooks');
        Cache::forget('cookbooks_env__default');
    }
}
