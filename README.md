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
On peut sur cette page entrer son login et mot de passe pour se connecter à l'application. <br>
On peut également créer un compte. <br>
**Vue -> login.html.twig** se trouvant dans le Bundle CarnetAdressesUserBundle


### La page d'inscription
On peut sur cette page s'inscrire sur le site en créant un compte. <br>
**Vue -> register.html.twig** se trouvant dans le Bundle CarnetAdressesUserBundle


### La page de profil
Sur la page de profil, on peut consulter les informations sur son compte, une liste de contacts. <br>
De cette page, on peut :
    - aller modifier ses informations personnelles
    - voir la liste de ses contacts
    - faire une recherche de membres
    - si la page de profil n'est pas celle de l'utilisateur connecté, alors il peut ajouter le membre propriétaire du profil à ses contacts <br>
**Vue -> show.html.twig** se trouvant dans le Bundle CarnetAdressesUserBundle pour l'utilisateur connecté <br>
**Vue -> profile.html.twig** se trouvant dans le Bundle CarnetAdressesAppBundle pour tout autre membre


### La page d'édition de profil
Sur cette page, on peut modifier ses informations personnelles. <br>
**Vue -> edit.html.twig** se trouvant dans le Bundle CarnetAdressesUserBundle pour l'utilisateur connecté


### La page des contacts
Sur cette page, on peut lister les contacts de son carnet d'adresses.
La liste est affichée sous forme d'une liste de checkbox.
Chaque checkbox qui n'est pas sélectionné pourra être supprimé par l'utilisateur. <br>
**Vue -> contacts.html.twig**


### La page d'ajout de contact
Sur cette page, on peut ajouter un contact en entrant son email dans le formulaire de recherche. <br>
**Vue -> ajouter.html.twig**
