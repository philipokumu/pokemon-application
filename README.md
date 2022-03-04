## About this Pokemon application

The application shows a basic application made with a React JS frontend and a Laravel backend. I first created the backend using a Test Driven Development approach to create the endpoints "/api/pokemons" and "/api/pokemons/:id"

Then I setup the React JS frontend to hit this endpoints to display data from the db.

For this application I created a function to populate the db automatically. However, we will not use this function for subsequent setup for the application. Thus we will use a database dump to view the pokemon list.

## Setup

#### Clone project

```
git clone https://github.com/philipokumu/pokemon-application.git
```

Open project

```
cd pokemon-application
```

I am using laravel and React JS in this application

Install backend dependencies

```
composer install
```

Install frontend dependencies

```
npm install

npm run prod
```

Create a database for the project in your php localhost e.g. pokemon-api

```
Copy .env.example to .env
```

Open .env file and ensure to setup DB_DATABASE, DB_USERNAME and DB_PASSWORD for your database according to your environment

Migrate the database

```
php artisan migrate
```

Empty the db you created in your local php environment and upload the file pockemon_api.sql found in the project folder

Start your server

```
php artisan serve
```

Access the site through the link provided by the above command. Commonly: http://127.0.0.1:8000

## Points of improvement in the application

-   The application certainly needs design done on the frontend
-   The application tests covers all endpoints such as api/pokemons and api/pokemons:id
-   The authentication on frontend is quite basic and is just for demonstrating functionality. I can improve this overtime
-   Editting a pokemon functionality does not work. Neither does the view a pokemon show details of the pokemons. This can be improved with time. I can also add redux to help in state preservation across pages.
-   Calling a pokemon list can also be memoized to avoid expensive fetch operations on the site on page reload.
-   The axios call can be be improved to attach the header automatically without having to write every request with header configuration
