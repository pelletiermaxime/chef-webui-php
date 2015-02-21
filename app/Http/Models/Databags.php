<?php

class Databags
{
    public static $rulesCreate = [
        'name' => [
            'required',
            'regex:/^[\.\-[:alnum:]_]+$/',
        ],
    ];

    public static $rulesCreateItem = [
        'id' => [
            'required',
            'regex:/^[\.\-[:alnum:]_]+$/',
        ],
    ];
}
