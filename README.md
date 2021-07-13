# Project 3 - Student Interim - Symfony 5.*

![Wild Code School](https://wildcodeschool.fr/wp-content/uploads/2019/01/logo_pink_176x60.png)

This is a 5 weeks project at the Wild Code School. It's a professionnal project based on a symfony website-skeleton with some additional tools to validate code standards.
Our client: company Student Interim.

### PREREQUISITES

To install this project, you will need to have some packages installed on your machine. Here is the recommended setup :

    PHP 7.4.* (check by running php -v in your console)
    Composer 2.* (check by running composer --version in your console)
    node 14.* (check by running node -v in your console)
    Yarn 1.* (check by running yarn -v in your console)
    MySQL 8.0.* (check by running mysql --version in your console)
    Git 2.* (check by running git --version in your console)
    You will also need a test SMTP connection, which you can configure using tools like Mailtrap

Please note that you may also need to install other packages to fully make everything work together (like php-mysql).

### INSTALLATION

If your machine follows all the prerequisites, then you can just follow the instructions below to install the project in a dev environment:

    * run git clone {REPO_ADDRESS} {YOUR_CHOSEN_FOLDER_NAME} in your console to fetch the repository from GitHub
    * run cd {YOUR_CHOSEN_FOLDER_NAME} to move into the folder where the project has been downloaded
    * run composer install to download and install PHP dependencies
    * run yarn install to download and install JS dependencies
    * run yarn encore dev to build assets
    * use the .env file as a template to create a .env.local file (which should never be versionned by Git), and fill the MAILER_DSN, MAILER_TO_ADDRESS, MAILER_FROM_ADDRESS and DATABASE_URL lines with the appropriate information
        note : the DATABASE_URL variable should contain the connection information of a user that has CREATE/DROP DATABASE, CREATE/DROP TABLE, INSERT INTO, UPDATE, DELETE and SELECT rights on the given database, and you may need to create that user and grant it those rights beforehand
    * run bin/console doctrine:database:create to create your database with the informations that you wrote in .env.local
    * run bin/console doctrine:migrations:migrate to create the tables structure of the database
    * run bin/console doctrine:fixtures:load to fill the database with fictive information
    * run symfony server:start to launch you PHP Symfony server
    * open your preferred web browser and go to localhost:8000

## Built With

* [Symfony](https://github.com/symfony/symfony)
* [GrumPHP](https://github.com/phpro/grumphp)
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [PHPStan](https://github.com/phpstan/phpstan)
* [PHPMD](http://phpmd.org)
* [ESLint](https://eslint.org/)
* [Sass-Lint](https://github.com/sasstools/sass-lint)

## Authors

Wild Code School - Student Interim (POUILLART Alexandre, MOINEAU Julien, LOSANGE Endrick, GUICHARD Maxime, GIRAUDEAU Maxime)