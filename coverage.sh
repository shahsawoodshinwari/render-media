#!/bin/bash

php artisan test --coverage-html=coverage --stop-on-failure

http-server coverage -p 8001

open http://localhost:8001