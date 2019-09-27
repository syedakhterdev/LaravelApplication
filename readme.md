<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

# Basic Laravel Application

This Application shows basic usage of :
- Collections.
- Dispatching a Job.
- Triggering an Event and setting up an Event Listener.

## Installation

### Minimum Requirements
- [Composer](https://getcomposer.org/).
- Apache Server
- MySQL
- PHP >= 7.2
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### Steps:

- Go into the project folder and run the following command

```bash
composer install
```
- After composer has finished installing vendor files create .env file by following commands and add database information respectively
```bash
cp .env.example .env
```
- Run Migrations
```bash
php artisan migrate
```
- Run the server
```bash
php artisan serve
```
## Usage

> You can register a user and then log in to view all registered users.
> If you perform any CRUD operations on the user an Observable will register that into log file.
> There's also a job that is dispatched if a user is edited and saved into the same Log file (Storage > logs > laravel-yyyy-mm-dd.log).

