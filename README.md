Ce projet est un site web collaboratif ayant pour but d’aider les étudiants/professeurs/experts/administration à communiquer.


# GUIDE D’INSTALLATION :

• Pour un essai en local, téléchargez WampServer.

• Sur notre page gitHub, cliquez sur le bouton « Clone or Dowload » puis « Download ZIP ».

• Mettez le contenu du ZIP dans le dossier « www » de Wamp.

• Lancez Wamp. Une icône en bas à droite de votre écran passera par la couleur rouge, orange, puis verte.

• Tapez « localhost/phpmyadmin/ » dans votre barre de recherche.

• Connectez-vous avec « root » comme pseudo et aucun mot de passe.

• Allez dans l’onglet « Importer » et importez-y le fichier sitebdd.sql du ZIP. Votre base de données est maintenant prête. Elle a été initialisée avec un utilisateur de pseudo « PseudoAdmin » et de mot de passe « PassAdmin ». Ne le supprimez pas tout de suite, il nous servira pour créer notre premier vrai utilisateur.

• Tapez « localhost » dans votre barre de recherche. Vous voilà sur le site fonctionnel.


# FONCTIONNEMENT :

Il existe quatre types d’utilisateurs : Les administrateur, les élèves, les professeurs, les experts.

• Les administrateurs sont les seuls à pouvoir créer des comptes utilisateurs. C’est le principe de toutes les écoles. L’administration nous génère nos comptent en début d’année et nous les donne en main propre. Vous allez devoir utiliser le seul compte utilisateur existant (PseudoAdmin, PassAdmin) pour pouvoir en générer d’autres. Vous pourrez après supprimer celui par défaut.

• Les élèves peuvent faire des demandes d’aides. Ils doivent sélectionner un domaine (mathématiques, physiques, etc…) et expliquer leur problème. Leur requête sera redirigée vers tous les professeurs du domaine correspondant. Les élèves ont un suivi de toutes leurs demandes et voient leur état (réponses reçues, demandes en attente de réponses, demandes en attente de redirection).

• Les professeurs voient les demandes qui correspondent à leur domaine. Leur rôle est de rediriger les élèves vers un expert. Ainsi les professeurs de mathématiques voient les demandes en mathématiques et peuvent sélectionner un expert parmi la liste de tous les experts en mathématiques. Un fois un expert sélectionné, les demandes ne sont plus visibles par les professeurs.

• Les experts voient la liste de toutes les demandes en attentes et de toutes les demandes auxquelles ils ont répondu.

Les élèves ainsi que les experts peuvent sélectionner une demande pour y répondre et voir l’historique de tous les messages relatifs à cette demande. Les réponses sont classées par date.

