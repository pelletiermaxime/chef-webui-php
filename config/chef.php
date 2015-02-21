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

// return [
//     'server'    => 'https://gourmet.libeo.com/organizations/libeo',
//     'client'    => 'mpelletier2',
//     'key'       => '/home/max/.chef/mpelletier2.pem',
//     'version'   => '12.0.0',
//     'enterprise' => true
// ];
//
// return [
//     'server'    => 'http://chef-server.libeo.com:4040',
//     'client'    => 'mpelletier2',
//     'key'       => '/home/max/.chef/mpelletier2.pem',
//     'version'   => '12.0.0',
// ];

return [
    'server'    => 'http://127.0.0.1:8889/',
    // 'server'    => 'http://192.168.1.153:8889/',
    'client'    => 'clientname',
    'key'       => base_path() . '/tests/key.pem',
    'version'   => '0.11.x',
];
