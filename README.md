# Brief3
# Brief3 - Gestion du Profil Utilisateur

Ce projet permet à un utilisateur de gérer son profil, notamment de modifier son nom d'utilisateur, son email et de consulter l'historique de ses connexions. Le projet utilise PHP et une base de données pour stocker les informations utilisateurs.

## Table des matières
1. [Description du projet](#description-du-projet)
2. [Fonctionnalités](#fonctionnalités)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Structure du projet](#structure-du-projet)
6. [Technologies utilisées](#technologies-utilisées)
7. [Contribution](#contribution)


1. Description du projet

Ce projet permet aux utilisateurs de :
- Voir et modifier leurs informations personnelles comme le nom d'utilisateur et l'email.
- Consulter l'historique de leurs connexions, avec les dates de connexion et de déconnexion.
- Le tout est fait via une interface web qui affiche les informations en lecture seule et une modal pour les modifier.

2. Fonctionnalités

- **Visualisation du profil utilisateur** : L'utilisateur peut voir son nom d'utilisateur, son email et son rôle.
- **Modification du profil** : L'utilisateur peut modifier son nom d'utilisateur et son email via une modal.
- **Historique des connexions** : L'utilisateur peut voir l'historique des sessions de connexion et de déconnexion avec les dates et heures.

3. Installation

Pour installer et exécuter ce projet sur votre machine locale, suivez ces étapes :

### Prérequis
Avant de commencer, assurez-vous que vous avez installé :
- **PHP 7.4+** ou supérieur
- **MySQL** ou un autre système de gestion de bases de données compatible
- Un serveur web comme **Apache** ou **Nginx**
- **Composer** pour gérer les dépendances PHP (si utilisé)

### Étapes d'installation

1. **Clonez ce dépôt** :
   Ouvrez un terminal et exécutez la commande suivante pour cloner le dépôt Git sur votre machine :
   ```bash
   git clone https://github.com/ton-compte/mon-projet.git

4.Usage
Une fois l'application en cours d'exécution, l'utilisateur peut accéder aux différentes sections de son profil via l'interface. Les informations de profil sont affichées dans une carte (Card Bootstrap), et un bouton permet d'ouvrir une modale pour mettre à jour les informations.
## Modification du Profil
L'utilisateur peut cliquer sur le bouton "Modifier mes informations" pour ouvrir la modale contenant des champs de formulaire pré-remplis avec ses informations actuelles. Une fois les informations mises à jour, l'utilisateur peut les soumettre via le bouton "Mettre à jour".
## Historique des Connexions
L'utilisateur peut également consulter l'historique de ses connexions avec des dates et heures de connexion et déconnexion dans un tableau.

5. Structure du projet
Voici un aperçu de la structure des fichiers du projet :
app/
├── index.php                     # Point d'entrée unique de l'application, agit comme le routeur de l'applisation pour gérer les routes c'est-à-dire les différentes rédirection
├── config/                       # Contient le fichier de configuration à la base de données  (logique métier)
│   └── config.php                # fichier de configuration de la connexion à la base de donnéees
├── controllers/                  # Contient les fichiers contrôleurs (logique métier)
│   └── UserController.php        # Contrôleur pour gérer les informations utilisateur
│   └── DashboardController.php   # Contrôleur pour gérer les informations des utilisateurs depuis un point centrale appelé le dashboard
│   └── AuthController.php        # Contrôleur pour gérer les informations lié à l'authentification d'un compte 
├── views/                    # Contient les vues (HTML)
│   └── profile.php          # Vue pour afficher et modifier le profil
│   └── dashboard.php          # Vue pour effectuer des opérations CRUD(Create Read Update Delete) sur les comptes
│   └── login.php          # Vue pour se connecter à l'application
│   └── header.php          # Vue pour l'entete de la page
│   └── footer.php          # Vue pour le pied de page 
├── models/                   # Contient les modèles (interactions avec la base de données)
│   └── Database.php         # Modèle pour se connecter et intéragir avec la bas de donnée
│   └── User.php             # Modèle qui Gère les opérations CRUD sur les utilisateurs.
│   └── Role.php             # Modèle qui Gère l'accès aux rôles stockés en base de données.
│   └── Session.php             # Modèle qui Gère l'enregistrement des sessions de connexion des utilisateurs. données.
├── public/           # Contient les fichiers statiques (CSS, JS)
│   └── assets/           # les fichiers statiques (CSS, JS)
│       └── css/           # contient les fichiers de styles
│           └── styles.css           # Styles personnalisés
│       └── images/           # contient les images               
└──  README.md             # Documentation du projet

6. Technologies utilisées
PHP 7.4+ : Langage côté serveur pour gérer la logique de l'application.

MySQL : Base de données pour stocker les informations utilisateur et l'historique des connexions.

HTML/CSS : Pour le rendu de l'interface utilisateur.

Bootstrap 4 : Framework CSS pour la mise en page et les composants (comme la modale et la carte).

jQuery : Utilisé pour la gestion des événements et l'affichage dynamique.

7. Contribution
Si vous souhaitez contribuer à ce projet, vous pouvez suivre ces étapes :

Forkez le projet.

Créez une branche (git checkout -b feature/nom_de_feature).

Effectuez vos modifications.

Commettez vos changements (git commit -am 'Ajout d'une nouvelle fonctionnalité').

Poussez la branche (git push origin feature/nom_de_feature).

Ouvrez une pull request.

