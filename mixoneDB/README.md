# 🎵 MixOne - Plateforme de Réservation de Studios de Musique

MixOne est une solution complète de mise en relation entre artistes et studios d'enregistrement. La plateforme permet aux propriétaires de studios de gérer leurs fiches, et aux artistes de réserver et payer leurs sessions en toute sécurité.

---

## 🚀 Fonctionnalités Clés

### 🎤 Pour les Artistes

- **Recherche multicritère** : Trouver des studios par ville, équipements ou tarifs.
- **Réservation en temps réel** : Choix des créneaux horaires et durée de session.
- **Paiement Sécurisé** : Intégration complète avec **Stripe** (CB, Apple Pay, Google Pay).
- **Messagerie Intégrée** : Communiquer directement avec les studios avant et après la session.
- **Système d'avis** : Noter et commenter les sessions pour aider la communauté.

### 🎹 Pour les Studios (Propriétaires)

- **Gestion de fiche premium** : Jusqu'à 5 photos haute définition (optimisées WebP) et gestion détaillée du matériel.
- **Tableau de Bord** : Suivi des réservations, des revenus et des messages.
- **Stripe Connect** : Virement automatique des fonds sur le compte bancaire du propriétaire.
- **Validation Administrative** : Système de modération pour garantir la qualité des annonces.

### 🛠️ Administration & Sécurité

- **Interface Admin** : Gestion des utilisateurs, des studios et des litiges.
- **Conformité RGPD** : Gestion des cookies, export des données et suppression de compte facilitée.
- **Notifications Emails** : Cycle de vie complet informé par email (via Brevo/Resend).

---

## 💻 Stack Technique

- **Backend** : Laravel 11.x (PHP 8.2+)
- **Frontend** : Blade, JavaScript (ES6), Tailwind CSS
- **Base de données** : MySQL 8.0+
- **Paiements** : Stripe API & Stripe Connect
- **Emails** : SMTP (Brevo ou Resend)
- **Traitement d'images** : Intervention Image v3 (Conversion WebP & Redimensionnement)
- **Cartographie** : API Adresse Data Gouv (France)

---

## 🛠️ Installation en Local

1. **Cloner le dépôt** :

    ```bash
    git clone https://github.com/Matheo-sys/MixOne.git
    cd MixOne/mixoneDB
    ```

2. **Installer les dépendances** :

    ```bash
    composer install
    npm install
    ```

3. **Configurer l'environnement** :

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Lancer les migrations et les seeders** :

    ```bash
    php artisan migrate --seed
    ```

5. **Compiler les assets** :
    ```bash
    npm run dev
    ```

---

## 🚢 Déploiement & CI/CD

### Pipeline GitHub Actions

Le projet inclut une pipeline de **Continuous Integration (CI)** située dans `.github/workflows/laravel-ci.yml`. À chaque `push` sur la branche `main` :

- Les dépendances sont installées.
- Une base de données MySQL de test est créée.
- Les tests **PHPUnit** sont exécutés.

### Hébergement (Railway)

Le déploiement est optimisé pour **Railway** via Nixpacks :

- Le fichier `nixpacks.toml` gère la compilation des assets et les migrations automatiques.
- Les variables d'environnement (`APP_KEY`, `STRIPE_SECRET`, etc.) doivent être configurées dans le dashboard Railway.

---

## 🔑 Variables d'Environnement (Production)

| Variable                       | Description                                  |
| :----------------------------- | :------------------------------------------- |
| `APP_KEY`                      | Clé de chiffrement Laravel                   |
| `DB_URL`                       | URL de connexion à la base de données        |
| `STRIPE_KEY` / `STRIPE_SECRET` | Clés API Stripe Live                         |
| `STRIPE_WEBHOOK_SECRET`        | Secret de signature des webhooks Stripe      |
| `MAIL_HOST` / `MAIL_PASSWORD`  | Identifiants SMTP (Brevo/Resend)             |
| `IMAGE_DRIVER`                 | Pilote de traitement d'image (gd ou imagick) |

---

## ⚖️ Licence & Crédits

Développé par Elias Louhichi et Mathéo Soriano.
Tous droits réservés.
