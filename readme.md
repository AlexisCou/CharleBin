# Rapport de TP : Qualité de Développement - CharleBin

**Étudiant :** Alexis Couturier  
**Parcours :** BUT S4.02 - DWM  
**Dépôt :** AlexisCou/CharleBin

---

## 1. Gestion de Version et Débogage (TD 1)

L'objectif était de maîtriser Git pour sécuriser l'historique du projet CharleBin.

### Manipulation Bisect
Nous avons utilisé `git bisect` pour identifier le commit ayant introduit un changement de nom indésirable (PrivateBin vers CharleBin). 
* **Procédure** : Après avoir déclaré un état sain (`good`) et un état buggé (`bad`), Git a navigué dans l'historique par dichotomie.
* **Automatisation** : La commande `git bisect run make test` a été utilisée pour automatiser la détection via un script de test.

---

## 2. Analyse Statique et Automatisation (TD 3)

Nous avons mis en place des outils pour automatiser la détection d'erreurs et le respect des standards.

### Configuration des Linters
Trois outils ont été intégrés dans le `makefile` via la cible `make lint` :
* **PHP Lint** : Vérifie la syntaxe de base des fichiers .php.
* **PHP Code Sniffer** : Valide le respect de la norme PSR-12.
* **PHP Mess Detector** : Détecte le code complexe ou mal nommé.

### Automatisation Locale (Git Hooks)
Un script de `pre-commit` a été créé dans le répertoire `.git/hooks/`. 
* **Action** : Il exécute `php-cs-fixer` pour corriger le style automatiquement et `phpmd` pour bloquer le commit si des violations subsistent.
* **Manipulation** : Une variable `$x` a été ajoutée pour tester le blocage ; le commit a échoué car le nom est trop court, prouvant l'efficacité du hook.

---

## 3. Outils de Développement et IA (TD 4)

### Refactoring assisté
La méthode `formatHumanReadableTime` dans `lib/Filter.php` a été réécrite à l'aide de GitHub Copilot pour en simplifier la logique.

### Audit de Sécurité
À l'aide des outils de développement du navigateur (F12) :
* **Réseau** : Nous avons vérifié que le texte envoyé n'apparaît pas en clair dans les requêtes réseau grâce au chiffrement client.
* **Application** : Nous avons contrôlé que l'application ne stocke aucune donnée sensible de manière persistante sur le navigateur.

---

## 4. Stratégie de Tests (TD 6)

### Tests Unitaires
Les tests unitaires via PHPUnit sont situés dans le dossier `tst/`.
* **Fichier cité** : `tst/Vizhash16x16Test.php` qui vérifie l'unicité des avatars PNG générés.

### Tests End-to-End
Avec Cypress, nous avons simulé un scénario complet :
* Création d'un paste sécurisé avec mot de passe.
* Accès à l'URL et saisie du mot de passe pour vérifier l'intégrité du contenu déchiffré.


### Lien vers le github :
* https://github.com/AlexisCou/CharleBin.git
