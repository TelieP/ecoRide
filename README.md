# ecoRide
# Projet Garage

## Prérequis

Un serveur web pour le déploiement en local. Plusieur outils sont utisables, soit :
1. [WAMP](https://www.wampserver.com/)
2. ou [XAMP](https://www.apachefriends.org/fr/index.html)
3. ou [MAMP](https://www.mamp.info/en/downloads/)

Un logiciel de gestion de versions décentralisé :
   [Git](https://git-scm.com/downloads)

Le CLI de Symfony : [Symfony CLI](https://symfony.com/download)

## Installation du projet en local

### Import du projet Git

* Se placer à la racine du serveur web.
* Taper la commande suivante : 
  ```git clone https://github.com/TelieP/ecoRide.git``` qui permet d'importer le projet sur le serveur local et sera nommé `ecoRide``.
* Une fois le projet cloné dans le bon dossier: il faut par la suite installer les dépendances grace à la commande: ```composer install``

### Import de la base de données

* Se rendre sur [PhpMyAdmin](http://localhost/phpmyadmin/)
* Cliquer sur le bouton `Importer` dans la barre d'outils.
* Sélectionner le fichier `ecoride.sql` fourni dans l'archive puis cliquer sur le bouton `Importer` : cela permet de créer la base de données pour le site.
Password admin haché((( $2y$13$61DjB6bfIrIJlclfrrmgpOTlVnQMhaMXyojaf1bTAWH9PIpzLssma  )))
### Paramétrage du site

#### Paramétrage de la base de données
* Par défaut, les identifiants sont `"root"` / `""` avec une base de données Mysql mais il est possible de les modifier dans le fichier `.env` à la racine du projet :
1. Repérer la section `DATABASE_URL` et ajuster vos paramètres
2. Ma connexion à la base est la suivante : `DATABASE_URL="mysql://root:@127.0.0.1:3306/ecoride?serverVersion=8.0.31&charset=utf8mb4"`

### Accès au site
* Se placer à la racine du projet et lancer la commande `symfony server:start`.
* Rendez-vous sur la [page d'accueil du site](http://localhost:8000) pour commencer à naviguer.

## Création d'un administrateur et d'un employé
* Un administrateur Vincent Parrot est déjà créé avec les identifiants : `parrot.vincent@gmail.com` / `Adminadmin`.
* Un autre utilisateur, un employé, est également créé avec le rôle `ROLE_EMPLOYE` avec les identifiants : `deroo.nicolas@gmail.com` / `Garagiste`.
* Pour créer un un employé, se connecter en tant qu'administrateur (avec le rôle `'ROLE-ADMIN`'), rendez-vous sur la [page d'enregistrement](https://localhost:8000/register) ou cliquez sur `Espace réservé` sur le site web.

* Pour créer un admnistrateur "à la main":
  1. Taper la commande `symfony console security:hash-password`.
  2. Un `Password hash` du type suivant vous est renvoyé : $2y$13$aRlemBXP8Z3kdLtLSOxv1.IYXo68YtZ0kd5D.hWsGnVraTemxgYwC
  3. Exécuter la requête suivante en backslashant les '$':
    INSERT INTO user (email, roles, password, name, sur_name) VALUES ('`votre_email`', '[\"ROLE_ADMIN\"]',
  '\$2y\$13\$aRlemBXP8Z3kdLtLSOxv1.IYXo68YtZ0kd5D.hWsGnVraTemxgYwC', '`votre_nom`', '`votre_prenom`');


## Site en ligne
Le site web est disponible en ligne. Vous pourrez vous y rendre [ici](https://garage.deroonicolas.eu/).