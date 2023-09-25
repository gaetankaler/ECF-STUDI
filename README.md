# **ecf-studi**

Le site web est une plateforme destinée à la gestion d'un garage automobile. Il offre différentes fonctionnalités selon les utilisateurs connectés :

### **Administrateurs** :

Ils ont un accès complet à la gestion des voitures, des employés et des horaires.
Ils peuvent créer, éditer et supprimer des annonces de voitures.
Ils peuvent ajouter, éditer et supprimer des employés.
Ils ont la possibilité de gérer les horaires du garage.

### **Employés** :

Les employés ont accès à une section spéciale où ils peuvent consulter les horaires du garage.
Ils peuvent également gérer les commentaires en attente de validation.
Les employés ont un accès limité par rapport aux administrateurs.

### **Utilisateurs non connectés** :

Les visiteurs du site peuvent consulter les annonces de voitures, mais ils doivent se connecter pour effectuer des actions spécifiques.
Le site dispose également d'un système de commentaires pour les annonces de voitures, avec des fonctionnalités de validation et de suppression par les administrateurs et les employés.

Le site web est un outil de gestion complet pour un garage automobile, offrant des fonctionnalités de gestion des voitures, des employés, des horaires et des commentaires, tout en distinguant les rôles et les autorisations entre administrateurs et employés.

## **Requis** 

  - symfony 5.4 ou plus
  - php 8.0 ou plus
  - composer
  - MySQL 8.0
  - Node.js
  - symfony encore

## **Installation**

- Cloner le repository:
  
  `git clone [repository URL]`

- Dépendance:
  
  `composer install`

- MySQL connexion:
  
  utilisateur  : `root`

  mot de passe : `root`

- Affichage du site sur "http://localhost:8000/" :
  
  `symfony server-start`

  `npm run dev-server`

- Connexion admin
  
  nom : `admin`

  mot de passe : `pass_1234`
