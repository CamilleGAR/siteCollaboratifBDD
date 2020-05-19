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


# UTILISATION :

Il existe quatre types d’utilisateurs : Les administrateur, les élèves, les professeurs, les experts.

• Les administrateurs sont les seuls à pouvoir créer des comptes utilisateurs. C’est le principe de toutes les écoles. L’administration nous génère nos comptent en début d’année et nous les donne en main propre. Vous allez devoir utiliser le seul compte utilisateur existant (PseudoAdmin, PassAdmin) pour pouvoir en générer d’autres. Vous pourrez après supprimer celui par défaut.

• Les élèves peuvent faire des demandes d’aides. Ils doivent sélectionner un domaine (mathématiques, physiques, etc…) et expliquer leur problème. Leur requête sera redirigée vers tous les professeurs du domaine correspondant. Les élèves ont un suivi de toutes leurs demandes et voient leur état (réponses reçues, demandes en attente de réponses, demandes en attente de redirection).

• Les professeurs voient les demandes qui correspondent à leur domaine. Leur rôle est de rediriger les élèves vers un expert. Ainsi les professeurs de mathématiques voient les demandes en mathématiques et peuvent sélectionner un expert parmi la liste de tous les experts en mathématiques. Un fois un expert sélectionné, les demandes ne sont plus visibles par les professeurs.

• Les experts voient la liste de toutes les demandes en attentes et de toutes les demandes auxquelles ils ont répondu.

Les élèves ainsi que les experts peuvent sélectionner une demande pour y répondre et voir l’historique de tous les messages relatifs à cette demande. Les réponses sont classées par date.


# BASE DE DONNEE :

Dans notre base de données, il existe trois tables :

• La table « utilisateurs ». C’est une table simple qui répertorie le pseudo, password, nom, etc… des différents utilisateurs.

• La table « aide ». C’est la table qui répertorie les demandes d’aide. Il y est écrit les personnes concernées (élève, expert, professeur), l’état de la demande (en cours, en attente, etc…), le texte de la demande et le domaine (mathématiques, etc…).

• La table « reponse ». Cette table est liée à la table « aide ». Elle répertorie toutes les réponses liées à une demande d’aide. Pour chaque réponse, on trouve donc son texte, sa date, la personne qui a répondu, et l’id de l’« aide » correspondante.


# SECURITE :

Les mots de passe sont hashés grace à la fonction password_hash(). Quelqu'un ayant accès à la base de donnée ne peut donc pas les récupérer car les antécédents des mots de passes hashés sont impossibles à trouver. Quand on veut se connection, on utilise la fonction password_verify() pour vérifier la correspondance entre notre mot de passe et le hash enregistré.

On utilise des variables de session. A chaque fois qu’on entre sur une nouvelle page, on vérifie que les variables de sessions existent et qu’elles donnent accès à cette page (S’il s’agit de la page administrateur, on vérifie que la personne soit bien un administrateur). Cela évite que l’on puisse taper nous-même l’adresse « localhost/administrateur.php » dans la barre de recherche sans s’être identifié sur la page d’accueil.

Quand on est élève ou expert et qu’on sélectionne une demande d’aide, on est amené sur un page où on visualise toutes les réponses liées à cette demande. Pour cela, on doit conserver l’identifiant de la demande que l’on a sélectionnée. Cette conservation se fait par adresse url. Exemple : « http://localhost/dossier.php?id=1 ». Pour éviter que l’on puisse changer la valeur de l’id et ainsi accéder aux messages privés d’autres personnes, on vérifie que l’utilisateur est effectivement investi dans une demande d’aide ayant cet id.


# DECONNECTION ET RETOUR :

Toutes les pages sont dotées de boutons « déconnection » et « retour ». Le bouton retour nous amène sur la page précédente en conservant les variables de session. Le bouton déconnection nous ramène sur la page d’accueil et efface toutes les variables de session existantes.


# ACCES INTERDITS : 

Si on essaie d’accéder à une page qui nous est normalement interdite, par modification de l’url, un message nous indiquera que nous n’avons pas accès à cette page. Les vérifications se font comme expliqué dans le paragraphe securité.



