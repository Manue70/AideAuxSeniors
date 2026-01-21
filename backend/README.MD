# SENIORAIDE – Application d’assistance pour seniors

## Description
SeniorAide est une application web destinée aux seniors. Elle permet de :
- Recevoir de l’aide via un assistant virtuel (chat basé sur OpenAI)
- Gérer ses rappels et ses médicaments
- Maintenir un profil personnalisé
- Contacter des personnes d’urgence facilement
- Profiter d’une interface simple, accessible et responsive

---

## Fonctionnalités principales
- Chat d’assistance avec intelligence artificielle
- Gestion des rappels (`reminders`) et médicaments (`medications`)
- Gestion des contacts et contacts d’urgence (`contacts`, `emergency_contacts`)
- Onboarding des utilisateurs avec suivi des réponses (`onboarding_answers`)
- Profil personnalisé avec thèmes et options d’accessibilité (`profiles`)
- Authentification et gestion des sessions (`users`, `sessions`)
- Cache interne pour les données temporaires (`cache`, `cache_locks`)

---

## Technologies utilisées
- PHP 8.4, Laravel 12.44
- MySQL
- React (intégré dans le backend, compilé avec Vite)
- Tailwind / Bootstrap pour le design
- OpenAI API pour l’assistant virtuel
- Docker / Docker Compose pour le déploiement

---

## Installation et lancement

### Backend (Laravel)
```bash
git clone <repo-url>
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev

# Lancer le serveur Laravel
php artisan serve



Configuration

.env :

DB_DATABASE, DB_USERNAME, DB_PASSWORD pour MySQL

OPENAI_API_KEY pour l’assistant virtuel

Render ou autre serveur : assure-toi que storage/ et bootstrap/cache/ sont accessibles en écriture

Structure de la base de données (MCD / MLD simplifié)
Tables principales


#Table	                                     Description	                                                               Principaux champs
users	                             Utilisateurs de l’application	                                               id, name, email, password, is_admin
profiles	                         Profils détaillés par utilisateur	                                           user_id, prenom, telephone, theme_accueil, accessibilite
reminders	                         Rappels pour les utilisateurs	                                               user_id, type, message, heure, est_effectue
medications	                         Médicaments des utilisateurs	                                               user_id, nom, dosage
contacts	                         Contacts génériques	                                                       nom, telephone
emergency_contacts	                 Contacts d’urgence liés à un utilisateur	                                   user_id, nom, telephone, lien
onboarding_answers	                 Réponses des utilisateurs lors de l’onboarding	                               user_id, question, reponse
sessions	                         Sessions utilisateurs	                                                       user_id, ip_address, user_agent, payload
cache / cache_locks	                 Stockage temporaire pour Laravel	                                           key, value, expiration
migrations	                         Historique des migrations	                                                   migration, batch


Relations principales

users 1 → 1 profiles

users 1 → n reminders

users 1 → n medications

users 1 → n emergency_contacts

users 1 → n onboarding_answers

users 1 → n sessions

Les tables cache et migrations sont internes à Laravel et ne contiennent pas de relations directes avec les autres tables.

(voir diagramme dans backend/public/readme/diagramme.png)


Usage

Créez un compte utilisateur

Complétez l’onboarding pour définir vos préférences

Ajoutez vos contacts et médicaments

Lancez le chat pour obtenir de l’aide ou des informations

Consultez vos rappels et marquez-les comme effectués

Tests

PHPUnit est installé par défaut (phpunit.xml)

Les tests ne sont pas configurés pour le moment

Vous pouvez lancer php artisan test pour exécuter les tests si vous en ajoutez

Nettoyage avant production

Supprimer src/public/hot.txt (utile seulement pour le hot reload en dev)

Vider storage/logs/laravel.log pour enlever les erreurs de dev

Vérifier que .env contient les bonnes clés de production et n’est pas poussé sur GitHub


Licence

MIT

