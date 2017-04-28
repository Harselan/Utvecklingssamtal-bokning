<?php 
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "utvecklingssamtal";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $name = $_SESSION['name'];
    
    $sql = "UPDATE account SET TIMEBOOKED='' WHERE NAME = '".$name."'";
            if($conn->query($sql) === TRUE){    
                $sql = "UPDATE account SET BOOKED= 0 WHERE NAME = '".$name."'";
                if($conn->query($sql) === TRUE){
                    $_SESSION['avbokat'] = true;
                    header('Location: kontosida.php');
                }
            }else{
                echo "Error updating record: " . $conn->error;
            }
?>