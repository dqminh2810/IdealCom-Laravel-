<?php

return [
    'name' => 'Roles',


	'roles' => [
		'admin' => [
			'display_name' => 'Administrateur',
			'description' => 'Accès à tout le panel admin sauf la partie \'Configuration\'',
			'permissions' => [
				'admin-dashboard',
				'admin-news',
				'admin-users',
				'admin-pages',
				'admin-medias-documents',
				'admin-medias-photos',
				'admin-medias-videos',
				'admin-answers',
			]
		],
		'superadmin' => [
			'display_name' => 'Super Administrateur',
			'description' => 'Accès à tout le panel admin',
			'permissions' => [
				'admin-dashboard',
				'admin-news',
				'admin-users',
				'admin-roles',
				'admin-users-roles',
				'admin-permissions',
				'admin-modules',
				'admin-pages',
				'admin-medias-documents',
				'admin-medias-photos',
				'admin-medias-videos',
				'admin-cookies',
				'admin-formulaires',
				'admin-fields',
				'admin-answers',
				'admin-countries',
				'admin-domains',
				'admin-agences',
				'admin-menus',
				'admin-menuitems',
				'admin-languages',
                'admin-subscribers'
			]
		]
	],

	'permissions' => [
		'admin-dashboard' => [
			'display_name' => 'Accès au back-office',
			'description' => 'Permission nécessaire pour accéder au back-office (www.example.tld/admin)'
		],
		'admin-news' => [
			'display_name' => 'Accès au système d\'actualités',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer des actualités'
		],
		'admin-users' => [
			'display_name' => 'Accès à la gestion des utilisateurs',
			'description' => 'Permission nécessaire pour voir/créer/éditer/supprimer les utilisateurs'
		],
		'admin-roles' => [
			'display_name' => 'Accès à la gestion des rôles',
			'description' => 'Permission nécessaire pour voir/créer/éditer/supprimer les rôles'
		],
		'admin-users-roles' => [
			'display_name' => 'Définir des rôles à un utilisateur',
			'description' => 'Permission nécessaire pour définir un rôle à un utilisateur'
		],
		'admin-permissions' => [
			'display_name' => 'Accès à la gestion des permissions',
			'description' => 'Permission nécessaire pour voir/créer/éditer/supprimer les permissions'
		],
		'admin-modules' => [
			'display_name' => 'Accès à la gestion des modules',
			'description' => 'Permission nécessaire pour voir et éditer les modules'
		],
		'admin-pages' => [
			'display_name' => 'Accès à la gestion des pages de contenu',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les pages de contenu'
		],
		'admin-medias-documents' => [
			'display_name' => 'Accès à la gestion des documents',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les documents'
		],
		'admin-medias-photos' => [
			'display_name' => 'Accès à la gestion des photos',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les photos'
		],
		'admin-medias-videos' => [
			'display_name' => 'Accès à la gestion des vidéos',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les vidéos'
		],
		'admin-cookies' => [
			'display_name' => 'Accès à la gestion du consentement des cookies',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer le bandeau concernant le consentement des utilisateurs pour les cookies'
		],
		'admin-formulaires' => [
			'display_name' => 'Accès à la gestion des formulaires',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les formulaires'
		],
		'admin-fields' => [
			'display_name' => 'Accès à la gestion des champs pour les formulaires',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les champs d\'un formulaire'
		],
		'admin-answers' => [
			'display_name' => 'Accès à la gestion des réponses pour les formulaires',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les réponses d\'un formulaire'
		],
		'admin-countries' => [
			'display_name' => 'Accès à la gestion des pays',
			'description' => 'Permission nécessaire pour éditer/supprimer les pays'
		],
		'admin-domains' => [
			'display_name' => 'Accès à la gestion des domaines',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les domaines liés au site'
		],
		'admin-agences' => [
			'display_name' => 'Accès à la gestion des agences',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les agences liées au site'
		],'admin-menus' => [
			'display_name' => 'Accès à la gestion des menus',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les menus'
		],'admin-languages' => [
			'display_name' => 'Accès à la gestion des languages',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les languages'
		],'admin-menuitems' => [
			'display_name' => 'Accès à la gestion des menuitems',
			'description' => 'Permission nécessaire pour créer/éditer/supprimer les menuitems'
		],'admin-subscribers' => [
            'display_name' => 'Accès à la gestion des abonnés',
            'description' => 'Permission nécessaire pour créer/éditer/supprimer les abonnés'
        ],
	]
];
