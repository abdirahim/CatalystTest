<?php
$options = getopt("f:u:p:h:");
//var_dump($options);exit;

$servername = $options['h'];
$username = $options['u'];
$password = $options['p'];
$db = "CatalystTest";
$filename = $options['f'];

try {

    $conn = new PDO("mysql:host=$servername;dbname=$db;port=8889","$username","$password");
    if(!$conn){
        die("Database Connection Failed.");
    }
    //echo "Connected successfully";

    $file = fopen($filename, "r");

    while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            // check email is valid
            if(filter_var($getData[2], FILTER_VALIDATE_EMAIL)) {
                $sql = "INSERT INTO users (name, surname, email) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([ucwords(strtolower($getData[0])), ucwords(strtolower($getData[1])), strtolower($getData[2])]);
            }
            else {
                echo "$getData[2] is not a valid email address \n";
            }
    }

}
catch(exception $e)
{
    echo "Connection failedd: " . $e->getMessage();
}

fclose($file);

