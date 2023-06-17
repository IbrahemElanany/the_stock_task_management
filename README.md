## Simple Task Management

This task is built using [Laravel Sail](https://laravel.com/docs/10.x/sail), This powerful tool helped me to dockerize the application smoothly.

[This is the postman collection](https://documenter.getpostman.com/view/4435162/2s93si1Vuo)

I used sanctum for authentication.

I used Service Oriented Architecture to make the code more organized.

I implemented queue for both sending email and resizing images to get the best performance, so to receive the email please change `MAIL_USERNAME` & `MAIL_PASSWORD` to your mailtrap account.

I made some test cases (Feature & Unit tests) to show that i can handle test cases, of course the coverage is not much but i think we won't depend on it for now.

### Steps to get the project up and running :
- use `docker-compose up` to run the project.
- Copy .env.example to .env `cp .env.example .env`
- then `docker-compose exec laravel.test bash`
- then `composer install`
- then `php artisan:migrate --seed`

Grab any test user which was made by the factory and start using the API with it.

So all functionalities plus the bonus points are implemented except for Kubernetes as i have no experience with it but i can learn it if needed.
