#! /bin/bash

echo SQL username:
read USER

echo SQL password:
read PASS

mysql --user=$USER --password=$PASS movies << END_SQL

# SQL commands go here

END_SQL

exit

