# BikeeShop

Projet réalisé dans le cadre de la licence Pro Développeur Web et Mobile pour le Commerce Electronique avec Symfony 4.

## Contexte

La société BikeeShop a quelques magasins vendant des vélos dans la région. Elle semble enfin prête pour se lancer dans la vente de vélo sur Internet en ayant son propre site web bikeeshop.com.

## Objectifs

Réalisé sa boutique web pour permettre la commande de produits disponibles dans ces magasins physiques avec l'utilisation de webservices.

#### Scénarios à réaliser:
**Page d'accueil:** Page d'accueil de la boutique où l'on peut voir la liste des catégories et une liste de produits en avant.
**Liste des produits:** Page listant les produits avec une pagination et catégorisation.
**Descriptif produit:** Page de description du produit avec son prix, des informations diverses et la possibilité de commander.
**Panier:** Liste des articles commandés avec possibilité de modifier les quantités et ainsi recalculer le total de notre panier.
**Commande:** Formulaire pour récupérer les informations de l'utilisation.
**Confirmation:** Si l'enregistrement de la commande se passe bien, on lui affiche un message confirmation. Sinon on lui affiche un message d'erreur (article plus en stock, etc)

## Livrables 

 1. *bikeeshop-api:* application serveur (webservices) en PHP
 4. *bikeeshop-app:* application client (site internet) en PHP

## Installation

WampServer 3.1.7 : PHP 7.3.1 / Apache 2.4.37 / MySQL 5.7.24

Lancer la commande suivante sur les deux livrables:
```
$ composer install
```

Définir vos identifiants de connexion en créant le fichier *.env.local* à la racine du dossier *bikeeshop-api* sous ce format: 
```
DATABASE_URL=mysql://root:password@127.0.0.1:3306/bikeeshop
```

Créer la base de données avec la commande suivante:
```
$  php bin/console doctrine:database:create
```
Installer le fichier de jeu de données nommé *bikeeshop.sql* disponible dans le dossier *bikeeshop-app\src\Migrations*

Lancer la commande suivante sur le dossier *bikeeshop-api* puis sur *bikeeshop-app*:
```
$ php bin/console server:run
```

## Lancement

L'application devrait être accessible à l'adresse http://127.0.0.1:8001/ et l'API à cette adresse http://127.0.0.1:8000/


## Demo

https://user-images.githubusercontent.com/22661042/136624616-cc0e625e-6374-4548-a556-4f432c92465e.mp4