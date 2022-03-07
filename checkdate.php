<?php

$url = file_get_contents("http://ergast.com/api/f1/2022");
echo $url;
echo (json_decode($url));
?>
