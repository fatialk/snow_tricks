SnowTricks
Project 6 of OpenClassrooms "PHP/Symfony app developper" course.

Codacy Badge

Description
SnowTricks is a community website for snowboarders.

Home page, tricks list and trick details are visible for all visitors but only reegistered users are allowed to comment tricks and add/edit their own tricks.

Symfony 6.4 / Bootstrap 5 project
Installation
1 - Git clone the project
https://github.com/fatialk/snow_tricks.git
    
2 - Install libraries

    php bin/console composer install
	
3 - Create database

a) Update DATABASE_URL .env file with your database configuration.
            DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
        
b) Create database:
            php bin/console doctrine:database:create
        
c) Create database structure:
            php bin/console make:migration
        
d) Insert fictive data 
            php bin/console doctrine:fixtures:load
        
4 - Configure MAILER_DSN of Symfony mailer in .env file

Usage
For access :

- if you used fictive data (see 3-d)), you can login with following accounts :
    - user account :
        username : User
        password : User1*
    
- if you did not use fictive data:
    - create a user account with sign up form
    - activate your account by following the activation link
