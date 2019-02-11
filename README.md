# Installation environnement Dev

## Pré-réquis

 - Serveur Web/DB (e.x. Apache, Nginx / MySQL) obtenable avec un uWAMP ou  EasyPHP Devserver
 - PHP ~7.3 [Windows PHP Download](https://windows.php.net/download#php-7.3)
 (Ne pas oublier d'ajouter php.exe au variables d'environnement [Comment ajouter une variable d'environnement sous Windows](https://docs.alfresco.com/4.2/tasks/fot-addpath.html))
 - Composer [download](https://getcomposer.org/download/)
 - Shell BASH (e.x Git bash)
 ## Installation 
 Git clone ce dépôt.  
 Créer une base de données m306
 
 Dans php.ini, activer les extensions:
 - curl
 - fileinfo
 - openssl
 - pdo_mysql
 
 Avec le Shell BASH, exécuter le script init

     bash init
Si le script init n'arrive pas a faire tourner composer install, faites le manuellement avec

     composer install
 Configurer .env selon configuration base de données  
 Configurer la rubrique dev dans phinx.yml également si cela n'est pas automatiquement faite  
Exécuter le script db avec paramètre m

    bash db m
Créer un virtual host avec dossier root /public/
