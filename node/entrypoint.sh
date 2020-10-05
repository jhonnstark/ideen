#!/bin/bash

echo "running install"

npm install

exec "$@"
