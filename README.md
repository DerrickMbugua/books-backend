# Topup Mama Assessment

### Installation

```
composer install
copy .env.example .env
change db configurations
php artisan migrate
php artisan add:api-data
php artisan db:seed
php -S localhost:8000 -t public
```

Application runs on : http://127.0.0.1:8000/ <br>
Live API URL : https://topup-mama.herokuapp.com/

### My Postman Documentation for the APIs
https://documenter.getpostman.com/view/15847425/UVyn3KPM

### Entity Relation Database
![alt text](https://topup-mama.herokuapp.com/erd.png)

### How to implement
Create tables and models. <br>
Sync the Api data using a command into the database. <br>
Create comment seeder to seed comments into the database. <br>
Create controllers and routes. <br>
Use crud operations to fetch data from the database. <br>

