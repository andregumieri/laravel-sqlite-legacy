# SQLite Legacy for Laravel 11+
An easy way to connect Laravel 11+ to outdated SQLite databases

## Motivation
> This should not exist, but yet, here we are...

I crafted laravel-sqlite-legacy when I hit a snag: Laravel 11 demanded SQLite 3.35.0, but AWS Lambda, when deploying with bref.sh and Serverless Framework, stuck to 3.7.x. This clash made deploying Laravel apps a pain. To simplify life for Laravel devs navigating these stacks laravel-sqlite-legacy was born, effortlessly bridging this gap making possible deploying Laravel 11 on AWS Lambda with bref.sh and Serverless Framework. This project should not exist. Once this stack has updated SQLite, this project goes six feet under!