# Application de carnet
===============

## Intitulé du sujet
---
L'objectif de cet exercice est de nous décrire et détailler la 
procédure a suivre pour le développement d'un carnet d'adresse mutli-utilisateurs 
sur Symfony2, voici un descriptif des fonctionnalités auxquelles devra répondre le programme :

- Identification (Inscription/Connexion/Déconnexion) de l'utilisateur par login/mot de passe (voir FOSUserBundle).
- Afficher/Modifier ses informations (email / adresse / téléphone / site web).
- Ajouter/Afficher/Lister/Supprimer les membres de son carnet d'adresses (membres qui devront être préalablement inscrit sur le site)

## Description des pages
---

### La page d'accueil
On peut sur cette page entrer son login et mot de passe pour se connecter à l'application.
On peut également créer un compte. <br />
**Vue -> index.html.twig**


### La page de profil
Sur la page de profil, on peut consulter les informations sur son compte, une liste de contacts.
De cette page, on peut accéder à toutes les autres :
    - voir le profil d'un contact
    - voir la liste des contacts
    - accéder à la page d'ajout d'un contact <br />
**Vue -> profil.html.twig**


### La page des contacts
Sur cette page, on peut lister les contacts de son carnet d'adresses.
La liste est affichée sous forme d'une liste de checkbox.
Chaque checkbox sélectionné pourra être supprimé par l'utilisateur. <br />
**Vue -> listing.html.twig**


### La page d'ajout de contact
Sur cette page, on peut ajouter un contact en entrant son email dans le formulaire de recherche. <br />
**Vue -> ajouter.html.twig**
