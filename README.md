# **Dekhil Omran**
#  Trilia App
## It's a full stack project management App Developed By Dekhil Omran [01-08-2023]
## Project Prerequisite

Below are the requirement for running the project

-   [Node](https://nodejs.org/en), For Nodejs
-   [Composer](https://getcomposer.org/download/), For Composer
-   [XAMPP](https://www.apachefriends.org/download.html), For PHP and MySQL

## Project Setup

1. Clone Repository and download all dependency

    ```bash
    git clone "https://github.com/dkhomran/Trilia.git"
    cd Trilia
    composer install
    npm install
    php artisan key:generate
    code .
    ```
2.Run xampp and turn on the MySQL server

3.Configure the project `.env` by copying the availabel `.env.example` and change below parameter:

    ```env
    APP_NAME = Trilia

    APP_URL = http://localhost:[8000]

    DB_CONNECTION = mysql
    DB_HOST = 127.0.0.1
    DB_PORT = 3306
    DB_DATABASE = Trilia_App [The Database Name]
    DB_USERNAME = root [Username Database]
    ```

4.Run database migartions

    ```bash
    php artisan migrate:fresh
    ```
    Or 
    'Import The SQL File [Trilia.sql] in your Mysql Database'

5.In a seperate terminal run the vite server (for building tailwind css stlye)

    ```bash
    npm run dev
    ```

6.In a seperate terminal run the artisan serve command

    ```bash
    php artisan serve --host='localhost' --port='8000'
    ```

## Project Dependecies

Below are libraries and devtools included inside the project:

-   [Tailwind](https://tailwindcss.com/docs/utility-first), for styling.
-   [Livewire](https://laravel-livewire.com/docs/2.x/quickstart), for dynamic UI component if it's a dumb component use [Blade Template Component](https://laravel.com/docs/10.x/blade#components) .
-   [Blade Icons](https://blade-ui-kit.com/blade-icons), font awesome icon.
-   [AlpineJs](https://alpinejs.dev/start-here), UI interactivity
