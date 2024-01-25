
<?php
require("connect.php");
$dsn="mysql:dbname=".BASE.";host=".SERVER;
try{
    //connexion à la base de donnée favori
    $pdo = new PDO($dsn, USER,PASSWD , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}catch(PDOexception $e){
 echo "echec de la connexion:%s\n" .$e->getMessage();
}

?>




