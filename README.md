# Note API

Symfony based note API. Provides API endpoints to create, read, update and delete notes.

## Setup

1. Install [docker](https://www.docker.com/get-started)
2. Start up docker compose instance - `docker-compose up --build -d`
3. Gain access to php bash shell - `docker exec -it php bash`
4. Go to root of symfony project - `cd code`
5. Install dependencies - `composer install`
6. Run database migrations to create nessecarry tables - `php bin/console doctrine:migrations:migrate`
7. It is recommended to fill database with fake data for testing purposes. Optional is this [package](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html) for symfony.
8. Open site in browser [localhost:8001](http://localhost:8001). If you see symfony welcome page then every is setup correctly.
9. Install [Postman](https://www.postman.com/downloads/) for easier API call testing.

Additional information:
1. To access phpmyadmin terminal username and password from `docker-compose.yml` file has to be used.

## API endpoints

1. `http://localhost:8001/notes/add` - Add new note.
2. `http://localhost:8001/notes/{id}` - Get note by id.
3. `http://localhost:8001/notes/{id}` - Put an update to note by id.
4. `http://localhost:8001/notes/{id}` - Delete a note by id.
5. `http://localhost:8001/notes?limit=&sortby=&search=` or `http://localhost:8001/notes`
   1. Query parameters have to be limit, sortby and search. If any are excluded it will return result with the parameters provided.
   2. Alternativly you can call `/notes` without query parameters and get all results. 
   3. `'ASC'` and `'DESC'` are only valid values for sortby key.

Note `{id}` has to be valid id. Otherwise exception is thrown.

## Manual testing scenarios using Postman

1. Manual testing scenario: adding note with `/notes/add`. The request contains json with data to be added as per image below. Both values are mandatory, if any is not provided exception is thrown. 
![first_image](https://github.com/niklavsricards/NoteAPI/blob/main/docs/Screenshot_1.png)

2. Manual testing scenario: geting a single note by id with `/notes/{id}`. If note is not found by id then exception is thrown.
![second_image](https://github.com/niklavsricards/NoteAPI/blob/main/docs/Screenshot_2.png)

3. Manual testing scenario: updating a note by id `/notes/{id}`. If note is not found by id then exception is thrown. PUT method is used. Values provided in json are being updated.
![third_image](https://github.com/niklavsricards/NoteAPI/blob/main/docs/Screenshot_3.png)

4. Manual testing scenario: deleting a note by id `/notes/{id}`. If note is not found by id then exception is thrown. DELETE method is used. On succesful deletion a json reponse is returned as per image.
![fourth_image](https://github.com/niklavsricards/NoteAPI/blob/main/docs/Screenshot_4.png)

5. Manual testing scenario: geting all notes based on query parameters in endpoint `/notes?limit=&sortby=&search=`.
In this case scenario only one parameter is provided, therefore showing that not all have to be filled and search also is working.
![fifth_image](https://github.com/niklavsricards/NoteAPI/blob/main/docs/Screenshot_5.png)

6. Manual testing scenario: geting all notes without any query parameters defined in endpoint `/notes`. 
Default sorting is starting with newest.
![sixth_image](https://github.com/niklavsricards/NoteAPI/blob/main/docs/Screenshot_6.png)

7. Manual testing scenario: geting all based on parameters provided in `/notes?limit=&sortby=&search=`.
In this case limit and flipped sorting is applied. Result returns two notes and sorted started with oldest.
![seventh_image](https://github.com/niklavsricards/NoteAPI/blob/main/docs/Screenshot_7.png)
