<?php
$methods = [
	'submitAmbassador' => [
		'params' => [
			[
				'name' => 'firstname',
				'source' => 'p',
				'pattern' => 'surname',
				'required' => true,
			],
			[
				'name' => 'secondname',
				'source' => 'p',
				'pattern' => 'surname',
				'required' => true,
			],
			[
				'name' => 'position',
				'source' => 'p',
				'required' => false,
				'default' => ' ',
			],
			[
				'name' => 'phone',
				'source' => 'p',
				'pattern' => 'phone-ukr',
				'required' => true,
			],
		    [
				'name' => 'email',
				'source' => 'p',
				'required' => false,
				'default' => ' ',

			],
		]
	]
];