#!/bin/sh
saveToFile="/home/$(whoami)/Desktop/log_dump.csv"
#clearing file 
printf "" > $saveToFile
#looping in the logs file and searching for ones that has .log as an extension
for file in "/var/log/"*".log"
     do
     	#getting the size of file and converting it from Byte to KB
        actualsize=$(($(wc -c <"$file")/1024))
        #attach the new line to the end of the file
        echo $(basename -a ${file})", $actualsize" >> $saveToFile
done
echo "Status: job finished"