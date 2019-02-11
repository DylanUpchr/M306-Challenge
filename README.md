# Installation environnement Dev

## Pré-réquis

 - Composer [download](https://getcomposer.org/download/)
 - Serveur Web/DB (e.x. Apache, Nginx / MySQL) obtenable avec un uWAMP ou  EasyPHP Devserver
 - PHP ~7.3 (Ne pas oublier d'ajouter php.exe au variables d'environnement [Comment ajouter une variable d'environnement sous Windows](https://docs.alfresco.com/4.2/tasks/fot-addpath.html))
 - Shell BASH (e.x Git bash)
 ## Installation 
 Git clone ce dépôt.  
 Créer une base de données m306  
 Avec le Shell BASH, exécuter le script init

     bash init

 Configurer .env selon configuration base de données  
 Configurer la rubrique dev dans phinx.yml également si cela n'est pas automatiquement faite  
Exécuter le script db avec paramètre m

    bash db m
Créer un virtual host avec dossier root /public/
