# Projet CharleBin : Qualité et Automatisation Logicielles

CharleBin est un fork du projet OpenSource PrivateBin, un outil de partage de texte ultra-sécurisé où le serveur n'a aucune connaissance des données envoyées grâce à un chiffrement AES-256 bits côté client. Ce projet a servi de support au module "Qualité de Développement" (BUT S4.02) pour mettre en place une chaîne de production logicielle (Pipeline) garantissant la stabilité, la sécurité et la maintenabilité du code.

## Sommaire

1. [TD-1 : Gestion de Version et Débogage dichotomique]
2. [TD-2 : Processus de Collaboration (Pull Requests)]
3. [TD-3 : Analyse Statique et Automatisation]
4. [TD-4 : Outils de Développement et IA]
5. [TD-5 : Stratégies de Tests]

## TD-1 : Gestion de Version et Débogage dichotomique <a name="td1"></a>

L'objectif de cette étape était de maîtriser le cycle de vie des fichiers dans Git et l'exploration de l'historique.

* **Workflow Local** : Utilisation des trois zones de Git : Working Directory (fichiers en cours d'édition), Staging Area (préparation du commit) et Repository (historique sauvegardé).


* **Gestion des Branches** : Isolation des développements pour maintenir la branche main toujours fonctionnelle. Par exemple, nous avons travaillé sur le changement de `languagedefault` vers `fr` dans `Configuration.php` sur une branche isolée.


* **Débogage avec git bisect** :

  * **Problématique** : Un bug a renommé le titre du projet en "CharleBin" au lieu de "PrivateBin".


  * **Solution** : Utilisation de `git bisect` pour effectuer une recherche dichotomique dans l'historique. En marquant un commit comme "bad" et un ancien comme "good", Git nous a permis d'isoler le commit exact responsable de la régression.





## TD-2 : Processus de Collaboration (Pull Requests) <a name="td2"></a>

Pour travailler en équipe de manière industrielle, nous avons mis en place un workflow basé sur les Pull Requests (PR).

* **Reviewing** : Avant chaque fusion, une revue de code est nécessaire pour vérifier l'absence de "code smells" et s'assurer que le code est documenté et facile à comprendre.


* **Documentation de Contribution** : Création d'un fichier `CONTRIBUTING.md` détaillant les règles (normes de nommage, obligation de passer les tests) pour garantir l'uniformité du projet.


* **PR Template** : Mise en place d'un modèle de description pour chaque PR afin de forcer l'explication du problème, de la cause racine et de la solution technique apportée.



## TD-3 : Analyse Statique et Automatisation <a name="td3"></a>

C'est le cœur de la qualité logicielle. Nous avons automatisé la détection d'erreurs sans exécution du code.

### 1. Les Linters (Analyse passive)

* **PHP Lint** : Vérification immédiate de la syntaxe pour éviter les erreurs de type "Parse Error".


* **PHP Code Sniffer (PHPCS)** : Force le respect du standard PSR-12 (indentation, placement des accolades, tags @author obligatoires).


* **PHP Mess Detector (PHPMD)** : Analyse la complexité du code. Il nous a permis de détecter des méthodes trop longues ou des variables mal nommées (ex: variables d'une seule lettre comme `$i` ou `$x`).



### 2. Le Pre-commit Hook (Automatisation locale)

Nous avons créé un script Bash dans `.git/hooks/pre-commit` pour automatiser les vérifications avant chaque commit:

* Correction automatique du style avec **PHP CS Fixer** (espaces, parenthèses).


* Validation de complexité avec **PHPMD**. Si le code présente des violations, Git refuse le commit.


* **Note technique** : Ce hook peut être ignoré via `--no-verify`, d'où l'importance de la CI.



### 3. Intégration Continue (GitHub Actions)

Création d'un workflow `.github/workflows/lint.yml` qui exécute les tests de qualité sur un serveur distant à chaque push.

* **Sécurité** : La branche main est protégée. Le bouton "Merge" reste grisé tant que le job de vérification n'est pas passé au vert.



## TD-4 : Outils de Développement et IA <a name="td4"></a>

* **Productivité** : Utilisation de **PHP Intelephense** pour l'autocomplétion avancée et de **GitHub Copilot** pour le refactoring de méthodes complexes comme `formatHumanReadableTime`.


* **Audit de sécurité (DevTools)** :


  * Utilisation de l'onglet **Network** pour prouver que les données envoyées au serveur sont déjà chiffrées (aucune donnée en clair dans les payloads).


  * Vérification via l'onglet **Application** que PrivateBin ne stocke aucune information sensible de manière persistante sur le navigateur.





## TD-5 : Stratégies de Tests <a name="td5"></a>

Pour garantir que chaque modification n'introduit pas de nouveau bug, nous utilisons deux niveaux de tests:

* **Tests Unitaires (PHPUnit)** : Validation unitaire des fonctions critiques, comme la génération de PNG uniques par IP.


* **Tests End-to-End (Cypress)** : Simulation réelle d'un utilisateur.


* **Scénario testé** : Création d'un secret avec mot de passe -> récupération de l'URL -> rechargement -> saisie du mot de passe -> vérification de l'intégrité du texte décodé.





## Conclusion

L'implémentation de cette chaîne de qualité sur CharleBin permet de réduire drastiquement la dette technique. Le développeur bénéficie d'un feedback immédiat (IDE/Hook), et le projet est protégé contre les régressions par une CI robuste et des tests de haut niveau.

---

*Projet réalisé dans le cadre du BUT Informatique à l'IUT Charlemagne*.
