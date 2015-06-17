# Application CarnetApp
===============

Par Brondon UNG

## Intitulé du sujet
---
L'objectif de cet exercice est de nous décrire et détailler la 
procédure a suivre pour le développement d'un carnet d'adresse mutli-utilisateurs 
sur Symfony2, voici un descriptif des fonctionnalités auxquelles devra répondre le programme :

- Identification (Inscription/Connexion/Déconnexion) de l'utilisateur par login/mot de passe (voir FOSUserBundle).
- Afficher/Modifier ses informations (email / adresse / téléphone / site web).
- Ajouter/Afficher/Lister/Supprimer les membres de son carnet d'adresses (membres qui devront être préalablement inscrit sur le site)


## Explication de l'application
---
Un utilisateur se connecte sur le site. Il arrive sur la page de ses informations. Il peut consulter la liste de ses contacts, faire une recherche de membre et éditer ses informations.
Il peut voir la page d'information de ses contacts par le biais de sa liste de contacts, mais ne peut pas accéder à celle des autres membres. Néanmoins, en faisant une recherche, il peut accéder aux
pages des membres qu'il a cherché. <br>
L'ajout d'un contact est direct, il n'y a pas de système de requête auprès du membre ajouté.


## Description des pages
---

### La page d'accueil
On peut sur cette page entrer son login et mot de passe pour se connecter à l'application. <br>
On peut également créer un compte. <br>
**Vue -> login.html.twig** se trouvant dans le Bundle CarnetAdressesUserBundle <br>
**Route -> /login/**


### La page d'inscription
On peut sur cette page s'inscrire sur le site en créant un compte. <br>
**Vue -> register.html.twig** se trouvant dans le Bundle CarnetAdressesUserBundle <br>
**Route -> /register/**

### La page de profil
Sur la page de profil, on peut consulter les informations sur son compte, une liste de contacts. <br>
De cette page, on peut :
    - aller modifier ses informations personnelles
    - voir la liste de ses contacts
    - faire une recherche de membres
    - si la page de profil n'est pas celle de l'utilisateur connecté, alors il peut ajouter le membre propriétaire du profil à ses contacts <br>
**Vue -> show.html.twig** se trouvant dans le Bundle CarnetAdressesUserBundle pour l'utilisateur connecté - **route -> /profile/** <br>
**Vue -> profile.html.twig** se trouvant dans le Bundle CarnetAdressesAppBundle pour tout autre membre - **route -> /view/{username}** 
où username est le pseudo du profil à afficher


### La page d'édition de profil
Sur cette page, on peut modifier ses informations personnelles. <br>
**Vue -> edit.html.twig** se trouvant dans le Bundle CarnetAdressesUserBundle pour l'utilisateur connecté <br>
**Route -> /profile/edit/**

### La page de modification de mot de passe
Depuis la page d'édition de profil, on peut accéder à cette page pour modifier son mot de passe. <br>
**Vue -> changePassword.html.twig** se trouvant dans le bundle CarnetAdressesUserBundle <br>
**Route -> /profile/change-password/**

### La page des contacts
Sur cette page, on peut lister les contacts de son carnet d'adresses.
La liste est affichée sous forme d'une liste de checkbox.
Chaque checkbox qui n'est pas sélectionné pourra être supprimé par l'utilisateur. <br>
**Vue -> contacts.html.twig** <br>
**Route -> /profile/contacts/**

### La page de recherche d'un contact
Sur cette page, on peut rechercher un/des contact(s) en fonction des données entrées dans le formulaire de recherche. <br>
Le résultat de la recherche est envoyé sur une autre page qui liste les membres trouvés. De cette liste, on peut accéder au 
profil de chaque membre. <br>
**Vue -> search.html.twig** <br>
**Route -> /search/**


## Les Entités
---

J'ai décidé de séparer le côté carnet d'adresses et utilisateur pour avoir d'un côté ce qui concerne l'application, càd le carnet d'adresses, et de l'autre les utilisateurs.

### AppBundle
* AddressBook -> représente le carnet d'adresses en relation OneToOne avec un utilisateur qui est son propriétaire
et en relation ManyToMany avec les contacts présents dans le carnet, car un utilisateur peut se trouver dans plusieurs carnets d'adresses. <br>
Il est défini par :
    - son id
    - son owner
    - ses contacts

### UserBundle
Le bundle est le fils de FOSUserBundle
* User -> il étend le User de FOSUserBundle. <br>
Il est défini par :
    - son id
    - son username
    - son e-mail
    - son password
    - son firstname
    - son surname
    - son address
    - son phonenumber
    - son siteweb


## Les vues
---

### UserBundle
Comme le bundle hérite de FOSUserBundle, j'ai décidé de surcharger toutes les vues dont j'ai eu besoin lors du développement de l'application. Ici, le profil, l'inscription et la connexion.
J'ai utilisé la notion de triple héritage en la vue de base de l'application base.html.twig se trouvant dans app/Resources/view, les layouts de chaque bundle et toutes les pages de l'application.

## Amélioration possible
---
* Ajouter un système d'envoi d'e-mail avec SwiftMailer
