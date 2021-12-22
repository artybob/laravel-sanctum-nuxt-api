# Laravel nuxt sanctum test api

This project created for me just for educational purposes. I want to understand how nuxt+sanctum works. 
It also contains pusher chat, social auth and simple roles system. Backend based on docker.
 
## Project setup
```
docker-compose up -d

docker exec lns-app php composer install

docker exec lns-app php artisan key:generate

docker exec lns-app php artisan migrate --seed

docker exec lns-app php artisan storage:link

docker exec lns-app php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### ENV
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=lns
DB_USERNAME=lns_user
DB_PASSWORD=password

FACEBOOK_CLIENT_ID= ...

Change your app url data

API_URL=...
SANCTUM_STATEFUL_DOMAINS=localhost:3000
CLIENT_BASE_URL=http://localhost:3000

```

### Add pusher keys for chat
```
https://dashboard.pusher.com/

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
```

### admin data
```
admin:
johndoe@example.com
password
```
