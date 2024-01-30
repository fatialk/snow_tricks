# Snow_tricks
Project 6 of OpenClassrooms "PHP/Symfony app developper" course.

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/b02e25724a06491b9d9aa88126643ae4)](https://app.codacy.com/gh/fatialk/snow_tricks/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

# Description

SnowTricks is a community website for snowboarders.

Home page, tricks list and trick details are visible for all visitors but only reegistered users are allowed to comment tricks and add/edit their own tricks.

# Symfony 6.4 / PHP 8 / Bootstrap 5 project

# Installation

1. Git clone the project
https://github.com/fatialk/snow_tricks.git

2. Install dependencies

  composer require symfony/runtime


3. Create database

- Update DATABASE_URL .env file with your database configuration.
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/snow_tricks_test

- Create database:
php bin/console doctrine:database:create


- Insert fictive data
php bin/console doctrine:fixtures:load

4. Configure MAILER_DSN of Symfony mailer in .env file