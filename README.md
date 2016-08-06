INSTALLATION :
========================
```
$ composer install
```

L'installateur Symfony de composer devrait par la suite vous permettre de configurer automatiquement votre fichier app/config/parameters.yml, si celui-ci n'existe pas.
Si ce n'est pas le cas, faites le manuellement.

Installation de la base de données
--------------

Le fichier "install.sh" contient le script d'installation de la base de données et de ses fixtures. Vous pouvez le lancer avec la commande :
```
$ sh install.sh
```

## Méthodologie :

J'ai effectué le travail demandé avec les moyens autorisés, en essayant d'obtenir au final **une base viable et pérenne** pour la création d'une API Rest permettant à différent devices d'intéragir avec le serveur.


Les entités ont d'abord été générées grâce à Doctrine,
puis les routes de l'API furent ensuites rédigées.


Enfin, la majeure partie du travail consista à développer le manager de Shop,
qui permet de découpler le controlleur du modèle et de réellement obtenir une architecture MVC fiable.

*Si vous m'aviez permis d'installer des bundles supplémentaires*,
voici les étapes supplémentaires que j'aurais souhaité effectuer :

1. J'aurais tout d'abord installé le bundle **FOSRestBundle** afin d'automatiquement **sérialiser les entités Shop hydratées en JSON**,
en utilisant les tags YML permettant de définir des groupes.

2. J'aurais ensuite installé le bundle **DoctrineFixturesBundle** afin de générer plus facilement les fixtures de la base de données.

3. Des tests auraient pu être crées à l'aide du framework **PHPUnit**

4. Finalement, j'aurais utilisé le bundle **NelmioApiDocBundle** afin d'automatiquement **générer la documentation de l'API**.


Utilisation de l'API
--------------

J'ai arbitrairement choisi d'envoyer les data à l'API au format RAW (pour les méthodes POST, dans le Body de la requête).
J'aurais également pu mettre ceux-ci en tant que form-data, ou bien passer des paramètres tels que l'Id directement dans l'url.


## Exemples :

Pour la route /shop/get :
```
{

  "id": 1
}
```

Pour la route /shop/create :
```
{

  "name": "Nouveau Shop",
  "address": "87, rue Bonneterie"
}
```

Pour la route /shop/get :
```
{
  "id": 2,
  "name": "API GUERET",
  "address": "2, rue Gontier-Patin"
}
```

(Des **screens sont également disponibles dans le dossier 'doc'**, ayant utilisé l'extension Chrome POSTMAN pour tester l'API).
