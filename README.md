
# MyContacts

Une application très simple de gestion de contacts. 






## Fonctionnalités

- Connexion
- Inscription
- Ajouter un contact
- Modifier un contact
- Supprimer un contact
- Consulter la liste des contacts
- Responsive design


## Technologies

- Symfony 7.2.3
- TWIG
- Doctrine 
- DQL
- CSS3


## Lancer le projet en local

- Clonez le projet depuis Github
- Dans votre terminal, allez au projet et faites composer install
- Lancez MailHog (sinon une erreur surviendra au lancement de l'application car j'ai mis en place un système de mail)
- Dans votre terminal tapez : symfony console doctrine:database:create (crée la base de données) et symfony console doctrine:migrations:migrate (permet d'avoir les différentes propriétés des entités)
- Lancez le serveur symfony avec la commande symfony server:start -d
## Prérequis
- Symfony 7
- Composer
## Author

- [@mayados](https://www.github.com/mayados)
