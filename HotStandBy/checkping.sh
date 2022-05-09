#!/bin/bash

hostip=172.27.173.73
ping -c1 hostip 1>dev/null 2>dev/null
connected=$?

if [$connected -eq 0]
then
	echo "$hostip connected"
else 
	echo "$hostip not connected"
	'filepath/changeserver.sh'
fi
#EOF
