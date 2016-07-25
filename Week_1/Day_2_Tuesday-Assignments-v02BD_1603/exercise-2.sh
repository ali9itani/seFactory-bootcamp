#!/bin/sh
bool=1;
#get used memory percentage 
usedRamPercentage=$(free | awk 'FNR == 3 {print $4/($3+$4)*100}' ) 
int=${usedRamPercentage%.*}
if [ $int -ge 80 ];
	then
		bool=0 
		echo "ALARM: Disk Virtual Memory is at $int %"			 
fi
#check size used for all mounted disks
for entry in "/dev/sda"*
	do		 
		#extract the % only	
		percent=$(df --output=pcent $entry) 
		value=$(echo $percent| cut -d'%' -f 2)
		if [ $value -ge 80 ];
			then
				bool=0  
				echo "ALARM Disk $entry is at $value%"
		fi
    done
#check if everything is ok
if [ $bool = 1 ];
	then
		echo "everything is ok"
fi