#!/bin/bash

# Run tests and generate phpmd report
./vendor/bin/phpmd . html phpmd.xml --reportfile report/index.html --ignore-violations-on-exit &

# Start http-server and open URL
http-server report --port 8082 &
server_pid=$!

# Wait for the server to start
sleep 2

# Open the URL
open http://localhost:8082

# Wait for the user to close the browser
echo "Press any key to stop the server"
read -n 1 -s

# Stop the http-server
kill $server_pid
