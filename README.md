# Ideal-Com Framework Laravel 5.6
Nouveau framework Laravel 5.6 pour la société **Ideal-Com Interactive**


# Installation
Télécharger le repo et executer (cmd) dans le dossier du repo :
```bash
$ composer update
$ composer dump-autoload
```
Modifier la configuration pour la base de donnée `.env`

Enlever la commentaire de la langue français trouvée dans le chemin :
```bash
vendor/mcamara/laravel-localization/src/config/config.php
```
Créer un nouveau sous-répertoire  `avatar` dans la chemin `public/storage`

Executer les commandes suivantes pour installer les tables de la base de donnée :
```bash
$ php artisan migrate:fresh
```

Pour générer les utilisateurs/rôles/permissions par défaut :
```
$ php artisan db:seed
```

Création du lien symbolique pour le dossier `/public/storage` :
```
$ php artisan storage:link
```

Création du lien symbolique pour le dossier `/public/Themes` :
```
$ php artisan themes:link
```

Utilisateurs créé par défaut :
```
> Rôle: superadmin
|-> Email: email00@blop.fr
|-> Mdp: password00

> Rôle: admin
|-> Email: email10@blop.fr
|-> Mdp: password10

> Rôle: null
|-> Email: email20@blop.fr
|-> Mdp: password20
```

Phase de Test: 
```
> Testing BROWSER
$ composer require --dev laravel/dusk
$ php artisan dusk:install
$ php artisan dusk tests/Browser/put-your-test-hereTest.php

> Testing FEATURE DATABASE
$ phpunit tests/Feature/Database/put-your-test-hereTest.php

> Testing FEATURE ROUTE
$ phpunit tests/Feature/Route/put-your-test-hereTest.php
```
