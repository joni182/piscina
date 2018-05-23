#!/bin/sh

if [ "$1" = "travis" ]
then
    psql -U postgres -c "CREATE DATABASE piscina_test;"
    psql -U postgres -c "CREATE USER piscina PASSWORD 'piscina' SUPERUSER;"
else
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists piscina
    [ "$1" != "test" ] && sudo -u postgres dropdb --if-exists piscina_test
    [ "$1" != "test" ] && sudo -u postgres dropuser --if-exists piscina
    sudo -u postgres psql -c "CREATE USER piscina PASSWORD 'piscina' SUPERUSER;"
    [ "$1" != "test" ] && sudo -u postgres createdb -O piscina piscina
    sudo -u postgres createdb -O piscina piscina_test
    LINE="localhost:5432:*:piscina:piscina"
    FILE=~/.pgpass
    if [ ! -f $FILE ]
    then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE
    then
        echo "$LINE" >> $FILE
    fi
fi
