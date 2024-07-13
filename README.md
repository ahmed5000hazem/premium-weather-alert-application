# About the app

Premium weather alert application using Laravel. Users can subscribe to receive timely weather updates and alerts for their specified locations

## Prerequisites

-   php: "^8.1"
-   composer: "2.4.1"
-   nodejs : "20.11.1"

## First clone the project

`git clone git@github.com:ahmed5000hazem/premium-weather-alert-application.git`

## create local domain in the hosts file

on windows go to `C:\Windows\System32\drivers\etc\hosts`
and append `127.0.0.1 weather-today.test` to the file

## copy env file

```
cd premium-weather-alert-application
cp .env.example .env
```

## install dependencies

```
composer install
npm i
```

## generate app encryption key

```
php artisan key:generate
```

## setup database connection

update the connection .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=weather
DB_USERNAME=root
DB_PASSWORD=
```

## run migrations

```
php artisan migrate
```

## run seeder

```
php artisan db:seed InitSeeder
```

## to setup weather api

replace WEATHER_KEY in env file with yours

```
WEATHER_KEY=your-key
```

to get the weather api key you need to create account at https://www.weatherapi.com/
then from side bar go to `dashboard > api` to get your key

## stripe setup

replace stripe variables at the .env with yours you will find the in your stripe account
Please sign into your account at stripe https://dashboard.stripe.com
from the navbar click on **developers** then **api keys**

```
STRIPE_KEY=your-stripe-key
STRIPE_SECRET=your-stripe-secret
```

### stripe webhook

add webhook route if not exists

```
php artisan cashier:webhook
```

please refere to the following link to install **stripe cli** https://docs.stripe.com/stripe-cli
after successfully instaling stripe cli
you will need to start a session with stripe using

```
stripe login
```

to get the token and open a tunnel for webhooks run

```
stripe listen --forward-to http://weather-today.test:8000/stripe/webhook
```

after runing command abouve you should have response like that

```
Ready! You are using Stripe API Version [2024-06-20]. Your webhook signing secret is <your_webhook_secret>
```

copy pase the webhook secret to the .env

```
STRIPE_WEBHOOK_SECRET=your-stripe-webhook-secret
```

## mail setup

login to your account at https://mailtrap.io/
from the sidebar go to email testing > inboxes
under the integration tab you will find the integration keys required to email ingetration
update the env file with the keys

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## runing queues

**Note**: make sure the `QUEUE_CONNECTION=database` in the .env file
start the queue using the command

```
php artisan queue:work
```

start task scheduler using

```
php artisan schedule:work
```

## testing

**Note**: make sure you have database with name **weather_testing**
to run tests run command

```
php artisan test
```

## serve application

```
php artisan serve
```

## run frontend

```
npm run dev
```
