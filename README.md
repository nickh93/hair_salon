# _Hair Salon_

#### _A site that allows for the owner of a hair salon to manage their stylists and customers 9/23/2016_

#### By _**Nicolas Hurtado**_

## Description

_This application uses databases and forms that allow the owner of a hair salon to manage their clients and stylists. The salon owner can add new stylists in a form, when created, the form will create a SQL query that will add a stylists to the database. Since there is a one-to-many relationship going on, the stylist can add multiple customers to a single stylist by clicking on a stylist which directs them to another form where they can add multiple clients to that stylists; the form executes a SQL command that creates the client and the relationship._

## Specifications

_Program lists existing stylists_
  * example input: Open page
  * example output: [stylist[1], stylist[2], stylist[3], ... stylist[n]]

_Program adds and displays new stylist when added in the form_
  * example input: Celyna
  * example output: [Celyna, stylist[2], ... stylist[n]]

_Program deletes a stylist when delete button is clicked_
  * example input: in Celyna, click on delte stylist
  * example output: [stylist[2], ... stylist[n]]

_Program updates a stylist's information when update button is clicked_
  * example input: in Celyna, click on update, change name to Celynna
  * example output: [Celynna, stylist[2], ... stylist[n]]

_Program displays existing customers to a stylist when clicked on stylist_
  * example input: click on "Sandra"
  * example output: Sandra: [client[1], client[2], client[3], ... client[n]]

_Program adds and displays a new customer when added to a stylist_
  * example input: In Sandra, add, Lisa
  * example output: Sandra: [Lisa, client[2], client[3], client[4], ... client[n]]

_Program deletes a client when delete button is clicked_
  * example input: in client Lisa's site,  click on delete client
  * example output: Sandra: [client[2], client[3], client[4], ... client[n]]

_Program updates a client's information when update button is clicked_
  * example input: in Lisa, click on update, change name to Luisa
  * example output: Sandra: [Luisa, client[2], client[3], client[4], ... client[n]]


## Setup/Installation Requirements

* _Computer_
* _Operating System_
* _Internet Connection_
* _Web browser_
* _Enter Git hub_
* _Navigate to my hair_salon repository_
* _Copy and paste url in top right_
* _Open terminal, type "git clone 'url'"_
* _Run composer install on your terminal_
* _Open MAMP go to preferences->web server tab->click on the folder icon right after document root->find project folder and click select-> click Ok -> click Run Server_
* _Go to localhost:8888/phpmyadmin, click on import, under the "File to Import" section click on choose file, navigate to project foler and select hair_salon.sql.zip, repeat process for hair_salon_test.sql.zip_
* _Navigate to web folder on terminal, and type "php -S localhost:8000" - to make it your document root_
* _To view in local browser, type - "localhost:8000" - in navigation bar_

##SQL Queries for Database Set-up

CREATE DATABASE hair_salon;
USE hair_salon;
CREATE TABLE stylists (id serial PRIMARY KEY, name varchar (255));
CREATE TABLE clients (id serial PRIMARY KEY, name varchar (255));
## Known Bugs

_In this version, there are no known bugs, but feel free to play around with the code and find out!_

## Support and contact details

_Please feel free to contact me, the developer of this awesome application:

Nicolas Hurtado: nickh93@outlook.com

## Technologies Used

_{Atom, HTML, CSS, PHP, loops, arrays, MySQL, Silex, Twig}_

### License

*Epicodus License*

Copyright (c) 2016 **_Nicolas Hurtado_**
