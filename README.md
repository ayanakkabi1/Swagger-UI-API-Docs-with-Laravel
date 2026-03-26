
```markdown
# 🚀 Laravel Swagger Integration - Live Coding

Ce projet est une démonstration pratique de l'implémentation de **Swagger UI** dans une application **Laravel**. L'objectif est de générer automatiquement une documentation d'API interactive et testable.

## 🛠️ Technologies utilisées
- **Laravel 11** (Framework PHP)
- **L5-Swagger** (Package d'intégration OpenAPI)
- **OpenAPI / Swagger** (Spécifications de documentation)

## 📦 Étape 1 : Installation
Pour installer le package dans votre projet Laravel, exécutez la commande suivante :
```bash
composer require "darkaonline/l5-swagger"
```

## ⚙️ Étape 2 : Configuration
1. **Publier le fichier de configuration :**
```bash
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
```

2. **Activer la génération automatique dans le `.env` :**
Ajoutez cette ligne pour que votre documentation se mette à jour à chaque modification :
```env
L5_SWAGGER_GENERATE_ALWAYS=true
```

## 📝 Exemple d'Annotation (@OA)
Voici comment nous déclarons les informations de base de l'API dans le contrôleur principal :

```php
/**
 * @OA\Info(
 * title="Mon API PortElite",
 * version="1.0.0",
 * description="Documentation interactive des ressources de l'API"
 * )
 */
```

## 🚀 Utilisation
Une fois configuré, accédez à votre documentation via l'URL :
`http://localhost:8000/api/documentation`

Pour forcer la génération manuelle des fichiers JSON :
```bash
php artisan l5-swagger:generate
```

---
 *Développé par Aya Nakkabi et Ilyas Doughmi dans le cadre de la formation YouCode.*
```

---