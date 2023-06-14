# SAE Qualité de dev et Dev IHM

## Parent Arthur-Erwan Lecomte
## Logins
pare0028:Arthur Parent
leco0107: Erwan Lecomte
## Documentation
### Fonctionnalités
- Lister les films selon leur genre (ex: animation,action,...)
- Ajouter un film 
- Supprimer un film
- Editer les informations d'un film
- Consulter les acteurs d'un film
- Consulter les informations d'un film
- Consulter les informations d'un acteur
- Consulter les films dont un acteur à joué 
### Programmes
#### Classes:
- Entity
  - Actor: Classe qui représente une entitée acteur conforme à la base de donnée
  - Cast:  Classe qui représente une entitée cast conforme à la base de donnée (permet de faire la jonction entre l'entité movie et actor)
  - Image: Classe qui représente une entitée image conforme à la base de donnée
  - Movie: Classe qui représente une entitée movie conforme à la base de donnée
  - Type:  Classe qui représente une entitée type de film conforme à la base de donnée
- Collection
  - ActorCollection : Classe qui permet de récupérer tous les acteurs sous forme de liste 
  - CastCollection :  Classe qui permet de récupérer les acteurs ayants joué dans un film (et inversement) sous forme de liste
  - MovieCollection:  Classe qui permet de récupérer tous les films selon certains critères (genre) ou non sous forme de liste.
  - TypeCollection :  Classe qui permet de récupérer tous les genres de films sous forme de liste.
- Exception
  - ParameterException : Classe héritant de la classe Exception , permet d'indiquer une erreur de paramètre
- Html
    - Form 
      - MovieForm : Classe qui permet la génération d'un formulaire et sa gestion (impacte la classe movie)
    - StringEscaper : Trait contenant des méthodes de protection de caractère spéciaux et de sécurité
    - WebPage : Classe qui permet la génération d'une page Web
#### Public
- admin
  - movie-delete.php: Programme permettant la suppression d'un film
  - movie-form.php: Programme permettant la génération de la page du formulaire d'édition/création d'un film
  - movie-save.php : Programme permettant la sauvegarde dans la base de donnée de l'édition/création d'un film
- css
  - Style.css : Feuille de style
- Image
- actor.php : Programme générant une page permettant de consulter les informations d'un acteur
- imageActor.php : Programme permettant la bonne récupéraion des avatars des acteurs
- imageFilm.php Programme permettant la bonne récupéraion des posters des films
- index.php : Page principale, génère une page qui permet de consulter les films de la base de donnée
- movie.php : Programme générant une page permettant de consulter les informations d'un film
### Script Composer
1.
```
composer "start:linux"
```
Cette commande permet de lancer un serveur Web local sur une machine linux
2.
```
composer "text:cs"
```
Cette commande permet de lancer une vérification du code en utilisant cs-fixer
3.
```
composer "fix:cs"
```
Cette commande permet de lancer une correction du code en utilisant cs-fixer
4.
```
composer start:Windows
```
Cette commande permet de lancer un serveur web local sur une machine avec un OS windows 
5. 
```
composer start
```
Cette commande lance un serveur web local sur sur une machine avec un OS windows 