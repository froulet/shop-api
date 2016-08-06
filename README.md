INSTALLATION :
========================

$ composer install

L'installateur Symfony de composer devrait par la suite vous permettre de configurer automatiquement votre fichier app/config/parameters.yml.
Si ce n'est pas le cas, faites le manuellement.

Installation de la base de données
--------------

Le fichier "install.sh" contient le script d'installation de la base de données et de ses fixtures. Vous pouvez le lancer avec la commande :
```
$ sh install.sh
```

Si vous m'aviez permis d'installer des bundles supplémentaires,
voici comment j'aurais procédé :

1. J'aurais tout d'abord installé le bundle FOSRestBundle afin d'automatiquement sérialiser les entités Shop hydratées en JSON,
en utilisant les tags YML permettant de définir des groupes.

2. J'aurais ensuite installé le bundle DoctrineFixturesBundle afin de générer plus facilement les fixtures de la base de données.

Utilisation de l'API
--------------

J'ai arbitrairement choisi d'envoyer les data à l'API au format RAW (pour les méthodes POST, dans le Body de la requête).

Pour la route /shop/get :
```
{

  "id": 1
}
```

Par exemple, pour la route /shop/create :
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

(Des **screens sont également disponibles dans le dossier 'doc'**, ayant utilisé POSTMAN pour tester l'API).

En espérant que cela vous convienne et en espérant de tout coeur travailler prochainement avec vous,


Frantz
