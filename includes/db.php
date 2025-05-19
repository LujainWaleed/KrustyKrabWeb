<?php
$host = 'sql206.infinityfree.com'; 
$dbname = 'if0_38575501_krustykrab'; 
$username = 'if0_38575501'; 
$password = 'v5RjftBrFKLgDK'; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>


