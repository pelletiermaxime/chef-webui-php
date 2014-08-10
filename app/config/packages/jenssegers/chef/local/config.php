<?php
/*
|--------------------------------------------------------------------------
| Chef API configuration
|--------------------------------------------------------------------------
| This file will contain the settings for the chef library.
|
| 'server'  = the URL for the Chef Server
| 'client'  = the name used when authenticating to a Chef Server
| 'key'     = the location of the file which contains the client key
| 'version' = the version of the Chef Server API that is being used
*/

return array(
    'server'    => 'http://chef-server.libeo.com:4000/',
    'client'    => 'mpelletier2',
    'key'       => '/home/max/.chef/mpelletier2.pem',
    'version'   => '0.11.x',
);
