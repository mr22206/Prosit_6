# My Todoo

Une application de gestion de tâches développée en PHP avec une architecture MVC.

## Prérequis

- PHP 7.4 ou supérieur
- Composer
- Serveur web (Apache recommandé)

## Installation

1. Clonez le repository :
```bash
git clone https://github.com/votre-username/my-todoo.git
```

2. Installez les dépendances :
```bash
composer install
```

3. Configurez votre serveur web :
- Créez une entrée DNS locale mytodoo.local -> 127.0.0.1
- Configurez un VirtualHost pointant vers le répertoire du projet

## Structure du projet

- `/src` : Code source de l'application
- `/templates` : Templates Twig
- `/tests` : Tests unitaires
- `/vendor` : Dépendances (généré par Composer)

## Tests

Pour exécuter les tests :
```bash
./vendor/bin/phpunit tests
```

## Contributeurs

- Votre nom

## Licence

MIT

![CI](https://github.com/votre-username/my-todoo/workflows/CI/badge.svg)
