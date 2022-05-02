read -p 'Package Name: ' pname
zip -r $pname.zip historicaldata.php
 
scp -r /home/mit490/git/IT490F1/$pname.zip /home/mit490/deployment
scp -r /home/mit490/git/IT490F1/historicaldata.php mit@172.27.223.55:/home/mit/git/IT490F1/; 

 

echo Vmpass1 | ssh -tt mit@172.27.223.55 sudo systemctl restart dmz.service

