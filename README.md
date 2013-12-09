Movie Database
==============

a SQL database for storing movie information

###Installation Instructions
```sh lamp-install.sh```

```sh setup-database.sh```

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
