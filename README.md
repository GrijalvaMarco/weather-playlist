# Laravel weather playlist
**Neubox Challenge 2:** The purpose of this application is to recommend a playlist based on the current temperature. 

## Bussiness rules

- Recommend party music if the temperature is greater than **30º**
- Recommend pop music if temperature is between **15º and 30º**
- Recommend rock music if temperature is between **10º and 14º**
- Recommend classical music if temperature is lower than **10º**

## Installation

Weather playlist requires:
- [Php](https://www.php.net/manual/en/install.php) v7.4+ to run.
- [Composer](https://getcomposer.org/) v2.3.6+
- [Laravel](https://laravel.com/) v8.83.26+

Install the dependencies and configure the app.

```sh
cd weather-playlist
composer install
cp .env.example .env
php artisan key:generate
```

## Technologies

| type or tech | functionality |
| ------ | ------ |
| Laravel | Popular php framework|
| Sail | Docker development environment |
| Repository | Pattern design for manage data layer |
| Services | Manage bussiness logic and request fetch data |
| Mysql | As a database |

## Run
Run with laravel [sail](https://laravel.com/docs/9.x/sail):

```sh
./vendor/bin/sail up -d
```
Run migrations:
```sh
./vendor/bin/sail artisan migrate
```

Run Seeders:
```sh
./vendor/bin/sail artisan db:seed
```
Now the app is running in http://localhost/

## Run in local with artisan
After installation dependencies and configure them:

```sh
cd weather-playlist
```
Run migrations:
```sh
php artisan migrate
```

Run Seeders:
```sh
php artisan db:seed
```

Serve:
```sh
php artisan serve --port=8000
```
Now the app is running in http://localhost:8000/

## Usage
After run with sail or artisan we need to sync data from spotify api.
Execute a reques to:
```sh
 http://localhost/api/spotify/sync
```
This will retrive the spotify data to avoid requesting every time a user send a request.
*This method could be used for run as a cron job and update tracks and playlists.

**Getting recommended playlist and tracks(execute one of them) to get by city or coordinates:**
```sh
http://localhost:8000/api/playlist/recommended?city=zapopan
or
http://localhost:8000/api/playlist/recommended?lat=20.6746601&lon=-103.3350782
```

For a better undestanding of how works the endpoints see the postman folder located at **weather-playlist/postman** 