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
    $sql = "SELECT * FROM account";
    $result = $conn->query($sql);
    $daybooked = $_POST['day'];
    $timebooked = $_POST['time'];
    $name = $_SESSION['name'];
    $complete = $daybooked . $timebooked;
    $error = 0;
    if ($result->num_rows > 0) {
        //checks if the account is correct
        while($row = $result->fetch_assoc()) {
            if($complete == $row['TIMEBOOKED']){
                $_SESSION['redanbokadtid'] = true;
                header('Location: kontosida.php');
                $error++;
            }
        }
        if($error == 0){
            $sql = "UPDATE account SET TIMEBOOKED='".$complete."' WHERE NAME = '".$name."'";
            if($conn->query($sql) === TRUE){    
                $sql = "UPDATE account SET BOOKED= 1 WHERE NAME = '".$name."'";
                if($conn->query($sql) === TRUE){
                    $_SESSION['klarbokat'] = true;
                    header('Location: kontosida.php');
                }
            }else{
                echo "Error updating record: " . $conn->error;
            }           
        }
    }
?>
<html>
    <body>
    
        
    
    </body>

</html>