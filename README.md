<p align="center"><h1>Blogpost.com</h1></p>

*PHP7.4, Laravel, MySQL, Bootstrap, Redis (docker), PHPUnit*

## Getting Started
Before installation the project, make sure that you have installed:

1. Check the official laravel installation guide -> [Official Laravel Documentation](https://laravel.com/docs/8.x/installation)
1. PHP 7.4
1. nodeJs, npm
1. Composer 
1. Docker (Redis image)

## Installation

Clone the repository

    git clone https://github.com/mercury6699/blogpost.com.git

Switch to the repo folder
    
    cd blogpost.com

Copy the example env file and **make the required configuration changes** in the .env file

    cp .env.example .env
    
Notice: Set correct configuration of your Database, Redis port (docker) for caching and queue job

(Create 2 Databases (first for main use, second for Unit testing), run Redis docker container)

Install all the dependencies using composer
    
    composer install
    npm install

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the npm scripts

    npm run dev

Start the local development server

    php artisan serve
    
You can now access the server at http://localhost:8000

**Command list**

    git clone https://github.com/mercury6699/blogpost.com.git
    cd blogpost.com
    cp .env.example .env
    composer install
    npm install
    php artisan key:generate
    php artisan migrate
    npm run dev
    php artisan serve
    
## Database seeding

Run the database seeder and you're done 

Notice: In the terminal you will have to input some inputs (to refresh the database (yes|no) , numbers of users, blogposts, comments, tags for posts)

    php artisan db:seed
    
(Optionally) If you want to seed by default

    php artisan db:seed -n
    
