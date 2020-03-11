<?php

return [
    'name' => 'Formulaires',

	'fields' => [
		'text' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
				'min',
				'max',
			],
		],
		'email' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
				'min',
				'max',
			],
		],
		'password' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
				'min',
				'max',
			],
		],
		'hidden' => [
			'attr' => [
				'value',
			],
		],
		'textarea' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
				'cols',
				'rows'
			],
		],
		'number' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
				'min',
				'max',
				'step',
			],
		],
		'file' => [
			'attr' => [
				'accept',
				'multiple',
				'required',
			],
		],
		'image' => [
			'attr' => [
				'required',
				'multiple',
			],
		],
		'url' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
			],
		],
		'tel' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
			],
		],
		'color' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
			],
		],
		'date' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
			],
		],
		'range' => [
			'attr' => [
				'placeholder',
				'value',
				'required',
				'min',
				'max',
				'step',
			],
		],
		'select' => [
			'attr' => [
				'checked',
				'value',
				'required',
				'selected',
				'multiple',
			],
		],
		'checkbox' => [
			'attr' => [
				'checked',
				'value',
				'required',
			],
		],
		'radio' => [
			'attr' => [
				'checked',
				'value',
				'required',
			],
		],
		'static' => [
			'attr' => [
				'tag',
				'value',
			],
		],
	]
];
