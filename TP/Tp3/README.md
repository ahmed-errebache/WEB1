# TP3 - Système d'authentification Admin

## Fonctionnalités implémentées

### Connexion Admin
- Un formulaire modal s'affiche quand on clique sur "CONNECT"
- Validation des identifiants contre la table `admins` de la base de données
- Utilisation de SHA2(256) pour le hachage des mots de passe
- Gestion des erreurs (identifiants incorrects, base de données indisponible)
- Variables de session pour maintenir l'état de connexion

### Déconnexion
- Lien "DISCONNECT" affiché quand l'utilisateur est connecté
- Déconnexion via paramètre GET `?disconnect=1`
- Suppression des variables de session liées à l'authentification

### Interface utilisateur
- Modal de connexion avec CSS personnalisé (style sombre)
- Boutons d'annulation et de validation
- Messages d'erreur en cas de problème de connexion
- Fermeture du modal en cliquant à l'extérieur ou sur le bouton fermer (×)

### Sécurité
- Formulaire auto-validé (action vers la même page)
- Protection contre les injections SQL avec requêtes préparées
- Échappement HTML pour l'affichage des données

### Base de données
- Table `admins` avec colonnes : login, password, email, contact
- Utilisateur de test : login='admin', password='admin123'

## Structure des fichiers modifiés
- `header.php` : Logique d'authentification et formulaire modal
- `footer.php` : JavaScript pour la gestion du modal
- `assets/css/style.css` : Styles pour le modal
- `config.php` : Gestion de la connexion à la base de données
- `setlist.php` : Adaptation pour les cas sans base de données