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

## API endpoints

1. `http://localhost:8001/notes/add` - Add new note.
2. `http://localhost:8001/notes/{id}` - Get note by id.
3. `http://localhost:8001/notes/{id}` - Put an update to note by id.
4. `http://localhost:8001/notes/{id}` - Delete a note by id.
5. `http://localhost:8001/notes?limit=&sortby=&search=` or `http://localhost:8001/notes`
   1. Query parameters have to be limit, sortby and search. If any are excluded it will return result with the parameters provided.
   2. Alternativly you can call `/notes` without query parameters and get all results. 

## Manual testing scenarios using Postman

