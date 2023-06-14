# SAE Qualité de dev et Dev IHM

## Parent Arthur-Erwan Lecomte
## Logins

## Documentation
### Fonctionnalités
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
#### Pages web
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