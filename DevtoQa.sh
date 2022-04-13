read -p 'Version Name' version



scp -r /home/mit490/git/IT490F1/historicaldata.php mit@172.27.223.55:/home/mit/git/IT490F1/; 

 

echo Vmpass1 | ssh -tt mit@172.27.223.55 sudo systemctl restart dmz.service

