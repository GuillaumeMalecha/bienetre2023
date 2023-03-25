# Site bien-être 2023

## Deployer le site

### Technologies utilisées :

Le projet a été créé avec les outils suivant, assurez vous d’avoir au minimum ces versions pour pouvoir déployer ce projet dans de bonnes conditions : 

**Symfony version 5.4**

**PHP 7.4.26**

**phpMyAdmin 5.1.1**

**MySQL 5.7.36**

### Installation du projet :

>Extraire le contenu de l’archive bienetre2023.rar
>
>Installer les dépendances avec la commande ‘composer install’
>
>Configurer le fichier .env avec les informations de connexion à votre base de données
>
>DATABASE_URL="mysql://root:@127.0.0.1:3306/bienetre?serverVersion=5.1"
>
>Création de la base de données ‘php bin/console doctrine:database:create’
>
>Structure de la base de données ‘php bin/console doctrine:migrations:migrate’
>
>Accéder au site en lançant le serveur: ‘symfony server:start’et aller à l’adresse qui s’affiche (normalement https://127.0.0.1:8000/)
>
>Charger les communes dans la db en allant à https://127.0.0.1:8000/ajoutadresses
>
>Créer un premier utilisateur et pour lui donner les accès administrateur il faut modifier en base de données dans la table utilisateur le rôle de [“ROLE_USER”] vers [“ROLE_ADMIN”]

Avec un compte admin, il deviendra alors possible de créer les catégories de services du site. Dans le dossier images vous trouverez un dossier avec plusieurs logos vectorisés en .png qui s’intégreront parfaitement au site pour illustrer les catégories qui seront proposées. Dans ce même dossier images se trouveront quelques photos libres de droit si le besoin d’illustrer un premier prestataire s’en faisait sentir.



