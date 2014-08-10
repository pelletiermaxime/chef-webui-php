#!/usr/bin/php
<?php
$peoples = file_get_contents('people.json');
$peoples = json_decode($peoples);
foreach ($peoples as $people) {
    file_put_contents($people->id . '.json', json_encode($people));
}
