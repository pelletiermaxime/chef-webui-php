<?php

class Nodes
{
    public static $rulesCreate = [
        'name' => [
            'required',
            'regex:/^[\.\-[:alnum:]_]+$/',
        ],
    ];
}
