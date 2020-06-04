# WeBeats

WeBeats est un site spécialisé dans l'achat et la vente de productions musicales appelées "Beats".  

## Installation et WampServer

Installer au préalable WAMP.  
Exécuter WAMP.  
Placer le dossier du site dans le répertoire www de WampServer.  
Dans l'URL de votre navigateur, se rendre sur [http://localhost](http://localhost)[/nom de votre dossier]

## Base de données 

L'installation de la base de données est indispensable au bon fonctionnement du site.  
Sur [phpmyadmin](http://localhost/phpmyadmin), installer les différentes bases de données situées dans le dossier BDD.  
Connectez-vous avec l'identifiant 'root' et sans mot de passe.

## Structure du Projet

```bash

Projet
├──assets
│  ├── css
│  ├── db
│  ├── functions
│  ├── icon
│  ├── img
│  ├── js
│  ├── skeleton
│  ├── js
│  └── img
│
├──audio
│  ├── csscomb.json  # json file containing all css files to combine
│  ├── jscomb.json   # json file containing all js files to combine
│  ├── css           # source files for css
│  ├── js            # source files for js
│  ├── sass          # sass files
│  └── tmp           # temp folder for csscomb
│
│──dist              # the only folder you need for your app/website/template
│  ├── css
│  ├── fonts
│  ├── js
└──└── img

```

## Description du Projet

### index.php
Contient l'index du site, page d'accueil de WeBeats.

### aboutus.php
Qui sommes-nous ? Description des contributeurs du projet.

### connexion.php
Page de connexion à WeBeats.

### dashboard.php

### deconnexion.php
Permet à un membre de WeBeats de se déconnecter

### editer-profil.php
Editer ou modifier son profil.  
Ajouter une photo de profil, une biographie, changer de pseudo, de mail ou bien de mot de passe.

### edit-newupload.php

### fichierfct.php

### functions_panier.php
Fonctions liées au panier. Ajouter un article dans un panier, le supprimer.

### inscription.php
Permet l'inscription au site. Contient une sécurité qui vérifie si les données que rentre l'utilisateur sont correctes.

### media_player.php

### message.php
Envoyer des messages aux personnes inscrites (et non-bloquées) sur WeBeats. 

### messagerie.php

### privee.php

### profils.php
Affiche les profils des membres de WeBeats. Permet de suivre ou bloquer une personne.

### search.php
Rechercher un Beats, un membre, un producteur.

### sendPanierBDD.php
Lorsqu'un article est ajouté dans le panier, celui-ci est déplacé dans la base de données

### utilisateurs.php

### navbar.php
Ce fichier comporte tous les éléments de la barre de navigation du site. Permet d'accéder à différentes rubriques au sein du site.
 

### Dossier assets

Ce dossier contient l'ensemble des fichiers css, certaines images du site, ainsi que des fonctions en JavaScript.  
Contient également le dossier skeleton qui comporte le fichier navbar.php, les headlink (liens css) ainsi que les endlink (liens JQuery, JavaScript).


### Dossier data
Contient les photos de profils et les Beats uploadés des membres du site.


## Auteurs

Site réalisé par Mlamali SAIS SALIMO, Ari RAJAOFERA et Mathieu CISSE.  
Site réalisé dans le cadre de réalisation de projet de l'EISTI. 