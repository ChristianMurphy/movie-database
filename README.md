Movie Database
==============

a SQL database for storing movie information

NOTE: This was made on Ubuntu, thus the instructions here will relate to deploying on Linux
###Installation Instructions
```sh lamp-install.sh```
```Or if not on Ubuntu, install LAMP packages```

Move movie-database folder into apache folder, usually /var/www

```mysql --user=(USERNAME) --password=(PASSWORD)```
Then within mysql command line, write: 
```create database movies;```

```sh installers/setup-database.sh```

In web browser, localhost/movie-database/php/index.php
or 127.0.1.1/movie-database/php/index.php


###Run Sample Queries
```mysql --user=username --password=password movies < query.txt```

###Run the Server
point your PHP server to the PHP folder in the project

###How It Works
pages work as views for Query Engine and Display Engine

* Query Engine

takes in a return type, a parameter type and a value and dynamically generates a query

* Dislay Engine

takes in a query and a return type and generates a table of the information
