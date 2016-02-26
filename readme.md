# _Hair Salon App, Code Review 3 PHP_

#### _Code Review for week 3 of PHP, 2.26.2016_

### By _**Joseph Karasek**_

## Description

_This web app is designed to collect and display information for a hair salon, including stylist and their clients. Information can be added, edited, and deleted. All information is stored in a database using mySQL._

_The goal of this code review is to show basic understanding and competency with php, Silex, and mySQL._

_The code review will consider the following criteria.._
* Do the database table and column names follow proper naming conventions?
* Did you write your test methods before beginning on your Silex routes?
* Are all tests passing?
* Does each class have all its methods for CRUD, as well as getters, setters, a constructor and private properties?
* Has CRUD functionality for each class been built in the Silex application? (CREATE, READ (all and singular objects), UPDATE, DELETE (all and singular objects))
* Is the one-to-many relationship set up correctly in the database?
* Are you able to display all the clients for a particular stylist?
* Are the commands on how to setup the database in the README? Did you include the .sql files?

## Setup/Installation Requirements

1. _Fork and clone this repository from_ [gitHub](https://github.com/joekarasek/epicodus-php-hair_salon.git).
2. Navigate to the root directory of the project in which ever CLI shell you are using and run the command: __composer install__ .
3. Create a local server in the /web directory within the project folder using the command: __php -S localhost:8000__ (assuming you are using a mac).
4. Open the directory http://localhost:8000 in any standard web browser.

## SQL Commands used to Setup database

> CREATE DATABASE hair_salon;

> USE hair_salon;

> CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR(255));

> CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR(255), stylist_id INT);

## Known Bugs

_There are no known bugs at this time._

## Support and contact details

_If you have any questions, concerns, or feedback, please contact the author through_ [gitHub](https://github.com/joekarasek/epicodus-php-hair_salon.git).

## Technologies Used

_This web application was created using the_  [Silex micro-framework](http://silex.sensiolabs.org/)_, as well _[Twig](http://twig.sensiolabs.org/), a template engine for php.

### License

MIT License.

Copyright (c) 2016 **_Joseph Karasek_**
