<?php

class Databags {

	public static $rules = [
		'name' => [
			'required',
			'regex:/^[\.\-[:alnum:]_]+$/',
		],
	];

}