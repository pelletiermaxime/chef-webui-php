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
    'server'    => 'http://chefserver.com/',
    'client'    => 'clientname',
    'key'       => 'absolute/path/to/key.pem',
    'version'   => '0.11.x',
);
