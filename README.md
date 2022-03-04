## About this Pokemon application

The application shows a basic application made with a React JS frontend and a Laravel backend. I first created the backend using a Test Driven Development approach to create the endpoints "/api/pokemons" and "/api/pokemons/:id"

Then I setup the React JS frontend to hit this endpoints to display data from the db.

For this application I created a function to populate the db automatically. However, we will not use this function for subsequent setup for the application. Thus we will use a database dump to view the pokemon list.

## Setup

#### Clone project

```
git clone https://github.com/philipokumu/pokemon-application.git
```

#### Open project

```
cd pokemon-application
```

#### I am using laravel, livewire and alpine js in this application

#### Install backend dependencies

```
composer install
```

#### Install frontend dependencies

```
npm install

npm run prod
```

#### Create a database for the project in your php localhost e.g. pokemon-api

#### Open .env file and ensure to setup DB_DATABASE, DB_USERNAME and DB_PASSWORD for your database according to your environment

#### Migrate the database

```
php artisan migrate
```

#### Empty the db you created in your local php environment and upload the file pockemon_api.sql found in the project folder

#### Start your server

```
php artisan serve
```

#### Access the site through the link provided by the above command. Commonly: http://127.0.0.1:8000
