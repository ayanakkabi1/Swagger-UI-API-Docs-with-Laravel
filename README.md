
```markdown
# 🚀 Laravel Swagger Integration - Live Coding

Ce projet est une démonstration pratique de l'implémentation de **Swagger UI** dans une application **Laravel**. L'objectif est de générer automatiquement une documentation d'API interactive et testable.

## 🛠️ Technologies utilisées
- **Laravel 11** (Framework PHP)
- **L5-Swagger** (Package d'intégration OpenAPI)
- **OpenAPI / Swagger** (Spécifications de documentation)

## 1. Installation

Exécutez la commande suivante pour ajouter le package au projet :

composer require "darkaonline/l5-swagger"

## 2. Configuration

### Publication des fichiers
Cette commande permet d'extraire le fichier de configuration vers le répertoire config/ de Laravel :

php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

### Paramétrage de l'environnement
Ajoutez la ligne suivante dans votre fichier .env pour automatiser la mise à jour de la documentation :

L5_SWAGGER_GENERATE_ALWAYS=true

## 3. Définition des métadonnées (Annotations)

Le bloc suivant doit être placé au-dessus de la classe dans app/Http/Controllers/Controller.php pour identifier l'API :

/**
 * @OA\Info(
 * title="Nom du Projet",
 * version="1.0.0",
 * description="Description technique de l'API"
 * )
 */

### Explication des termes :
- @OA\Info : Déclare les informations globales de l'API.
- title : Définit le nom affiché sur l'interface Swagger.
- version : Indique le numéro de version actuel du développement.
- description : Fournit un résumé des fonctionnalités disponibles.

## 4. Génération et Visualisation

### Commande de génération
Si la génération automatique n'est pas active, utilisez cette commande pour compiler les annotations :

php artisan l5-swagger:generate

### Accès à l'interface
Une fois le serveur lancé, la documentation est consultable à l'adresse :
http://localhost:8000/api/documentation

---
 *Développé par Aya Nakkabi et Ilyas Doughmi dans le cadre de la formation YouCode.*
```

---