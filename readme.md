# Rapport de TP : Qualité de Développement - CharleBin

**Étudiant :** Alexis Couturier

**Parcours :** BUT S4.02 - DWM

**Dépôt GitHub :** https://github.com/AlexisCou/CharleBin.git


## 1. Gestion de Version et Débogage (TD 1)

L'objectif de cette séquence était de maîtriser les commandes Git pour sécuriser l'historique et isoler les développements via un workflow de branches.

### Manipulation Bisect

Pour identifier le commit ayant introduit un changement de nom indésirable (PrivateBin vers CharleBin), nous avons utilisé `git bisect`.

* **Procédure** : Après avoir déclaré un état sain (`git bisect good`) et un état buggé (`git bisect bad`), Git a navigué dans l'historique par dichotomie.


* **Automatisation** : La commande `git bisect run make test` a été utilisée. Le script de test échouait dès que le titre détecté par `curl` différait de "PrivateBin".



## 2. Analyse Statique et Automatisation (TD 3)

Nous avons automatisé la détection d'erreurs et le respect des standards PSR-12 pour garantir une base de code uniforme.

### Configuration du Makefile

Trois outils ont été intégrés dans le `makefile` pour centraliser le contrôle qualité via la commande `make lint`:

* **PHP Lint** : Vérifie la validité de la syntaxe PHP.


* **PHPCS** : Valide le respect du standard PSR-12 (indentation, accolades).


* **PHPMD** : Détecte le code complexe, les variables inutilisées ou mal nommées.



### Automatisation Locale (Git Hooks)

Un script de `pre-commit` a été créé dans le dossier `.git/hooks/`.

* **Action** : Le script lance `php-cs-fixer` pour la correction automatique et `phpmd` pour valider la complexité.


* **Manipulation** : L'ajout volontaire d'une variable `$x` dans `lib/Filter.php` a provoqué le blocage du commit par PHPMD en raison d'un nom trop court (violation de nommage).



### Intégration Continue (GitHub Actions)

Nous avons configuré un workflow `.github/workflows/lint.yml` pour exécuter les tests de qualité sur GitHub à chaque push. La branche `main` est protégée : le merge est impossible tant que le job `php-quality` n'est pas validé.

## 3. Outils de Développement et IA (TD 4)

### Audit de Sécurité via DevTools

À l'aide des outils de développement du navigateur (F12):

* **Network** : L'inspection de la requête POST lors de l'envoi d'un message montre que le champ `data` contient du contenu chiffré. Cela prouve que le serveur ne reçoit jamais le texte en clair.


* **Application** : Nous avons vérifié que les données ne sont pas stockées de manière persistante dans le navigateur, respectant la confidentialité de l'application.



### Refactoring assisté par IA

La méthode `formatHumanReadableTime` dans `lib/Filter.php` a été simplifiée grâce à GitHub Copilot. L'IA a proposé une structure utilisant un tableau de conversion, ce qui est plus maintenable que les conditions multiples initiales.


## 4. Stratégie de Tests (TD 5 & 6)

### Tests Unitaires (PHPUnit)

* **Objectif** : Tester des fonctions isolées sans dépendances.


* **Fichier** : `tst/Vizhash16x16Test.php`.


* **Manipulation** : Ce test vérifie que la génération d'images Vizhash produit des sorties uniques selon l'adresse IP.



### Tests End-to-End (Cypress)

Cypress a été utilisé pour simuler un parcours utilisateur réel du début à la fin.

* **Scénario validé** :
1. Accès à la page locale via `cy.visit('/')`.


2. Saisie d'un texte secret et d'un mot de passe.


3. Clic sur le bouton de soumission et récupération de l'URL.


4. Rechargement via l'URL, saisie du mot de passe et vérification que le message déchiffré est correct.



## Conclusion

Ce cycle de travaux a permis de mettre en place une pipeline de qualité complète. Le projet CharleBin est désormais protégé par trois niveaux de sécurité : le contrôle local (Hook), la revue par les pairs (PR) et la validation automatisée (CI GitHub Actions).
