# Site bien-être 2023

![Logo](https://i.imgur.com/SCrbC7o.png)

## Deployer le site

### Technologies utilisées :

Le projet a été développé avec les outils suivants. Assurez vous d’avoir au minimum ces versions pour déployer ce projet dans de bonnes conditions : 

>Symfony version 5.4
>
>PHP 7.4.26
>
>phpMyAdmin 5.1.1
>
>MySQL 5.7.36

## Installation du projet :

> - Extraire le contenu de l’archive bienetre2023.rar
>
> - Installer les dépendances en exécutant la commande ‘composer install’
>
> - Configurer le fichier .env avec les informations de connexion à votre base de données :
>
>DATABASE_URL="mysql://user:password@127.0.0.1:3306/bienetre?serverVersion=5.1"
>
>(Remplacez user et password par vos identifiants de connexion à la base de données)
>
> - Créer de la base de données ‘php bin/console doctrine:database:create’
>
> - Appliquer la structure de la base de données ‘php bin/console doctrine:migrations:migrate’
>
> - Lancer le serveur avec la commande ‘symfony server:start’et accéder au site à l’adresse affichée (normalement https://127.0.0.1:8000/)
>
> - Charger les communes, localités et codes postaux dans la base de données en visitant l'adresse https://127.0.0.1:8000/ajoutadresses
>
> - Créer un premier utilisateur. Pour lui donner les accès administrateur, modifier en base de données dans la table ‘utilisateur’ le rôle de [“ROLE_USER”] vers [“ROLE_ADMIN”]
>
> - Victoire ! Votre site est à présent opérationnel.

L'administrateur pourra gérer l'ajout, la modification et la suppression de catégories de services, ainsi que la modification et la suppression de prestataires de services.

Site réalisé avec JetBrains PHPStorm.

Pour plus d'informations, consultez les documentations utilisateur et développeur.