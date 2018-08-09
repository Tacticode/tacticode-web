## Installation

### Prerequisite

* Install Git, PHP >= 5.5.9, a database engine (MySQL, PostgreSQL, SQLite or SQL Server) and a web server (Apache, Nginx...).
* Install [Composer](https://getcomposer.org/download/)
* Install Laravel ```composer global require "laravel/installer"```

### Install project

* Clone project ```git clone https://github.com/Tacticode/tacticode-web.git```
* Go into project ```cd tacticode-web```
* Install dependencies ```composer install```
* Copy env.example and fill it ```cp .env.example .env```
* Launch migrations ```php artisan migrate:refresh --seed```
* Create vhost for ```tacticode-web/public/```
* Launch website and enjoy!

### Install tacticode Arena-Viewer (optionnal)

* Go into project ```cd tacticode-web```
* ```git submodule init --recursive```
* ```git submodule update --remote --recursive```