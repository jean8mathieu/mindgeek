## How to make this project work
 1. Clone this repo
 2. `composer install` (Will install composer)
 3. `npm install` (Will install the required file to compile our CSS and JS)
 4. Copy `.env.example` to `.env`
 5. `npm run dev` or `npm run production` (Will generate the CSS and JS)
 6. `php artisan migrate:refresh --seed` (Migrate the database and insert data into it)
 7. `phpunit` will run the test cases
 8. Visit the url link to this project