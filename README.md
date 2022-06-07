# ECOLE POO

Une vidéo d'une démo de ce projet se trouve à la racine de ce dépôt.

## Mise en place back

La base de données utilisée ici est SQLITE. Utilisez le fichier .env.example pour créer votre propre fichier .env

Pour créer un utilisateur comme le suivant:

```
user: faniry.consulting@gmail.com
pass: 12345678
```

Lancer:

```
cd back

composer install
yarn install

php artisan ui vue --auth

php artisan migrate
php artisan key:generate

yarn dev
php artisan serve
```

Et inscrivez-vous sur http://127.0.0.1:8000/ en cliquant sur _Register_ en haut à droite.

## Mise en place front

Lancer:

```
cd front

yarn install
yarn web
```

## A propos de l'API:

- GET sur **/api/employees** : est protégée donc, il faut s'authentifier sur http://127.0.0.1:8000/ en cliquant sur Register en haut à droite pour avoir la réponse de cette requête.

Puis utiliser, utiliser un Bearer Token du type suivant après avoir obtenu un token valide à partir de l'étape précédente:

```js
{
    'Authorization': 'Bearer ' + validToken()
}
```

- POST sur **/api/employees** : crée un employé, les données JSON que cette route attend sont:

```json
{
    "name": "...",
    "firstName": "...",
    "department": "..."
}
```

- POST sur **/api/employees/{employeeId}/checkin** : permet à un employé de faire un check-in, le commentaire optionnel suivant est attendu:

```json
{
    "comment": "..."
}
```

- PATCH sur **/api/employees/{employeeId}/checkout** : permet à un employé de faire un check-out, le commentaire optionnel suivant est attendu:

```json
{
    "comment": "..."
}
```
