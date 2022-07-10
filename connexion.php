
<?php
$servname = "localhost"; $user = "root"; $pass = ""; $dbname = "colnet";
$connect = new PDO("mysql:host=$servname;dbname=$dbname;port=3306", $user, $pass);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 ?> 
