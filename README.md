# Installation environnement Dev

## Pré-réquis

 - Composer
 - Serveur Web/DB (e.x. Apache, Nginx / MySQL) obtenable avec un uWAMP ou  EasyPHP Devserver
 - PHP ~7.3
 - Shell BASH (e.x Git bash)
 ## Installation 
 Créer un dépôt git local et ajouter un remote de ce dépot git fetch le contenu.  
 Créer une base de données m306  
 Avec le Shell BASH dans le dossier racine du projet, exécuter le script init

     bash init

 Configurer .env selon configuration base de données  
 Configurer la rubrique dev dans phinx.yml également, si cela n'est pas automatiquement faite  
Exécuter le script db avec paramètre m

    bash db m
Créer un virtual host avec dossier root /public/
