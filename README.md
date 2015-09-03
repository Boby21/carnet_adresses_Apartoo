# Application CarnetAdressesApp
=============

A Symfony project created on August 26, 2015, 10:44 pm.

Par Mathieu WEINICH


## Les routes
---

### La page d'accueil
**Route -> /login/**

### La page d'inscription
**Route -> /register/**

### La page du profil
**route -> /profile/** <br>
**route -> /view/{username}**

### La page d'édition du profil
**Route -> /profile/edit/**

### La page de modification du mot de passe
**Route -> /profile/change-password/**

### La page des contacts
**Route -> /profile/contacts/**

### La page de recherche d'un contact
**Route -> /search/**


## Les Entités
---

### AppBundle
Il est défini par :
    - id
    - owner
    - contacts

### UserBundle
Il est défini par :
    - id
    - username
	- email
    - firstname
    - surname
    - address
    - phonenumber
    - siteweb
	- password	


## Les relations et les héritages
---

### AppBundle
* AddressBook -> Représente le carnet d'adresses. Il est en relation "ManyToMany" avec les contacts présents dans le carnet d'adresses, car un utilisateur peut se trouver le carnet d'adresses de plusieurs autres utilisateurs. Et, en relation "OneToOne" avec un utilisateur.

### UserBundle
Ce bundle est le fils de FOSUserBundle. <br>
Comme le bundle hérite de FOSUserBundle, j'ai décidé de surcharger toutes les vues dont j'ai eu besoin lors du développement de l'application. Ici, le profil, l'inscription et la connexion.
J'ai utilisé la notion de triple héritage en la vue de base de l'application base.html.twig se trouvant dans app/Resources/view, les layouts de chaque bundle et toutes les pages de l'application.

	
## Les actions des pages
---

### La page d'accueil
Cette page permet d'entrer son login et mot de passe afin de se connecter à l'application. <br>
Elle permet aussi de créer un compte.

### La page d'inscription
Cette page permet de s'inscrire sur le site en créant un compte.

### La page du profil
Sur la page du profil, on peut consulter les informations sur son compte, une liste de contacts. <br>
De cette page, on peut :
    - Voir la liste de ses contacts
    - Rechercher des membres afin de les ajouter à sa liste de contacts
    - Sur l'utilisateur connecté est sur la page du profil d'un autre membre, alors il peut ajouter ce dernier à ses contacts

### La page d'édition du profil
Cette page permet de modifier ses informations personnelle afin de mettre à jour son profil.

### La page de modification du mot de passe
On peut y accéder depuis la page d'édition de profil, afin de modifier son mot de passe.

### La page des contacts
Cette page permet de lister les contacts de son carnet d'adresses. <br>

### La page de recherche d'un contact
Cette page permet de rechercher un/des contact(s) selon certains critères. <br>
Le résultat de la recherche est affiché sur une autre page avec la liste des membres trouvés. A partir de cette liste, on peut accéder au profil de chaque membre afin des les ajouter ou non.


## Les vues
---

### La page d'accueil
**Vue -> login.html.twig** Dans CarnetAdressesUserBundle.

### La page d'inscription
**Vue -> register.html.twig** Dans CarnetAdressesUserBundle.

### La page du profil
**Vue -> show.html.twig** Dans CarnetAdressesUserBundle pour l'utilisateur connecté.
**Vue -> profile.html.twig** Dans CarnetAdressesAppBundle pour tout autre membre.

### La page d'édition du profil
**Vue -> edit.html.twig** Dans CarnetAdressesUserBundle pour l'utilisateur connecté.

### La page de modification du mot de passe
**Vue -> changePassword.html.twig** Dans CarnetAdressesUserBundle pour l'utilisateur connecté.

### La page des contacts
**Vue -> contacts.html.twig**

### La page de recherche d'un contact
**Vue -> search.html.twig**# carnet_adresses_Apartoo
