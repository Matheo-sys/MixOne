# MixOne 🎧

Bienvenue sur le dépôt du projet **MixOne** ! 

MixOne est une plateforme de mise en relation entre des artistes indépendants et des studios d'enregistrement professionnels. Elle permet aux artistes de rechercher, comparer et réserver des créneaux dans des studios proches de chez eux, tout en offrant aux propriétaires de studios une interface de gestion de leurs équipements et plannings.

## 🚀 Version en direct (Beta)

Le projet est actuellement déployé et accessible en ligne : 
👉 **[https://mixone.up.railway.app/](https://mixone.up.railway.app/)**

## 🛠️ Stack Technique

* **Framework Backend** : Laravel 10 (PHP 8.2)
* **Architecture** : MVC étendu avec le pattern **Action + DTO** pour une logique métier découplée.
* **Frontend** : Modèles Blade, HTML5, CSS3, JavaScript Vanilla.
* **Base de données** : MySQL
* **Déploiement** : Railway

## ✨ Fonctionnalités Principales

* **Système d'Authentification** : Gestion des inscriptions et connexions (artistes / studios).
* **Création de Profils de Studios** : Adresse (via API Geo Gouv), équipements, galerie photos.
* **Recherche** : Filtrage des studios par ville et département.
* **Réservations** : Système de demande de réservation avec gestion du statut (en attente, refusé, annulé).
* **Messagerie Temps Réel (Polling)** : Chat intégré entre utilisateurs avec indicateur de messages non-lus, avec possibilité d'éditer ou de cacher des conversations.
* **Wishlist** : Permet aux artistes d'ajouter des studios en favoris.

## 💻 Installation en local

Si vous souhaitez faire tourner le projet sur votre machine (via Laravel Sail / Docker) :

1. Clonez ce dépôt
2. `composer install`
3. `cp .env.example .env` (puis générez votre `APP_KEY` avec `php artisan key:generate`)
4. `./vendor/bin/sail up -d`
5. `./vendor/bin/sail artisan migrate`

## 👨‍💻 Développeur
Développé par le compte **Matheo-sys** dans le cadre du projet MixOne.
