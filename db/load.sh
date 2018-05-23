#!/bin/sh

BASE_DIR=$(dirname $(readlink -f "$0"))
if [ "$1" != "test" ]
then
    psql -h localhost -U piscina -d piscina < $BASE_DIR/piscina.sql
fi
psql -h localhost -U piscina -d piscina_test < $BASE_DIR/piscina.sql
