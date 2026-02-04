# CharleBin 

CharleBin est un outil de partage de texte et de code ultra-sécurisé, basé sur PrivateBin. 

L'objectif est simple : permettre d'envoyer des informations sensibles sans que personne d'autre que le destinataire ne puisse les lire.

## Pourquoi utiliser CharleBin ?

* Sécurité maximale : Le serveur ne connaît jamais le contenu de vos messages. Tout est chiffré dans votre navigateur avant l'envoi.
* Zéro trace : Les messages peuvent s'auto-détruire après une seule lecture ("Burn on reading").
* Contrôle du temps : Choisissez une date d'expiration (1 heure, 1 jour, 1 semaine, etc.) après laquelle le message disparaît définitivement.
* Anonymat : Aucune inscription n'est requise.

## Comment ça marche ?

1.  Collez votre texte ou votre code.
2.  Choisissez les options de sécurité (mot de passe, expiration).
3.  Partagez le lien généré à votre destinataire.
4.  Une fois le délai passé ou le message lu, les données sont supprimées du serveur.

## Installation rapide

Si vous souhaitez héberger votre propre instance de CharleBin :
1. Clonez ce dépôt sur un serveur avec PHP.
2. Copiez le fichier `cfg/conf.sample.php` vers `cfg/conf.php`.
3. Ajustez les réglages si nécessaire, et c'est prêt !
