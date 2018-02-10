<?php
return [
	/* Basic Config */
	'config' => [
	],
	/* Framework Config */
	'framework'	=> [
		'default.index'		=> 'index',
		'case_sensitive' 	=> false,
		'views.path'		=> APPPATH. '/view/',
		'views.extension'	=> '.php',
		'model.prefix'		=> '_model',
		'helper.prefix'		=> '_helper',
		'library.prefix'	=> '_lib',
		'base_url'		=> '',
		'handle_errors'		=> true,
		'log_errors'		=> true
	]
];
