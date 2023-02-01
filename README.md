# API Netflix

Comment lancer le projet ?

  ## 1. Cloner le git

  ## 2. Terminal -> Composer install (Installation du projet)

  ## 3. Vérifier le .env afin de lui adresser la bonne route de DATABASE_URL (Penser à démarrer le serveur de BDD)

  ## 4. Terminal -> php bin/console doctrine:database:create (Création de la base de donnée)

  ## 5. Terminal -> php bin/console doctrine:migrations:migrate (Permet d'ajouter la table "Audiovisual" à la BDD "api-netflix")

  ## 6 Terminal -> symfony server:start (Permet de démarrer le serveur en local)

  ## 7. Grâce à Postman, en méthode POST à l'url "http://127.0.0.1:8000/create" on a la possibilité d'ajouter des films/séries en raw sous la forme suivante :

    {
        "Nom": "film connu",
        "Synopsis" : "description du film très très connu comme pulp fiction",
        "Type" : "film",
        "Date" : "1954-07-17"
    }

  ## 8. On peut ainsi créer plusieurs entités de la sorte.

  ## 9. Une fois ces entités créer, nous pouvons les récuperer via Postman en méthode GET à l'url "http://127.0.0.1:8000/getall". Si nous voulons récupérer une production audiovisuelle en particulier, toujours en GET il faut s'adresser à l'url "http://127.0.0.1:8000/get(id)"

  ## 10. De Maintenant à l'url "http://localhost:8000/" vous pouvez y voir s'afficher les différents films / séries ajouté depuis Postman 
