<?php
    session_start();
?>
<html>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "utvecklingssamtal";

    $conn = new mysqli($servername,$username, $password,$dbname);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM account";
    $result = $conn->query($sql);
    $vektor = array('Man08:00' => false, 'Man08:30' => false, 'Man09:00' => false,'Man09:30' => false,'Man10:00' => false,'Man10:30' => false,'Man11:00' => false,'Man11:30' => false,'Man12:00' => false,'Man12:30' => false,'Man13:00' => false,'Man13:30' => false,'Man14:00' => false,'Man14:30' => false, 'Man15:00' => false, 'Tis08:00' => false, 'Tis08:30' => false, 'Tis09:00' => false,'Tis09:30' => false,'Tis10:00' => false,'Tis10:30' => false,'Tis11:00' => false,'Tis11:30' => false,'Tis12:00' => false,'Tis12:30' => false,'Tis13:00' => false,'Tis13:30' => false,'Tis14:00' => false,'Tis14:30' => false, 'Tis15:00' => false, 'Ons08:00' => false, 'Ons08:30' => false, 'Ons09:00' => false,'Ons09:30' => false,'Ons10:00' => false,'Ons10:30' => false,'Ons11:00' => false,'Ons11:30' => false,'Ons12:00' => false,'Ons12:30' => false,'Ons13:00' => false,'Ons13:30' => false,'Ons14:00' => false,'Ons14:30' => false, 'Ons15:00' => false,'Tor08:00' => false, 'Tor08:30' => false, 'Tor09:00' => false,'Tor09:30' => false,'Tor10:00' => false,'Tor10:30' => false,'Tor11:00' => false,'Tor11:30' => false,'Tor12:00' => false,'Tor12:30' => false,'Tor13:00' => false,'Tor13:30' => false,'Tor14:00' => false,'Tor14:30' => false, 'Tor15:00' => false, 'Fre08:00' => false, 'Fre08:30' => false, 'Fre09:00' => false,'Fre09:30' => false,'Fre10:00' => false,'Fre10:30' => false,'Fre11:00' => false,'Fre11:30' => false,'Fre12:00' => false,'Fre12:30' => false,'Fre13:00' => false,'Fre13:30' => false,'Fre14:00' => false,'Fre14:30' => false, 'Fre15:00' => false);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
           if($row['BOOKED'] == 1){
               $vektor[$row['TIMEBOOKED']] = true;    
           }
        }
    }
    $tidpunkter = array("08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00");
    $dagar = array("Man", "Tis", "Ons", "Tor", "Fre");
?>
    <head>
        <title>Utvecklingssamtal</title>
        <link rel="stylesheet" type="text/css" href="css.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
            <h1>Utvecklingssamtal</h1>
            <?php 
            
                if (isset($_SESSION['name'])){
                    header('Location: kontosida.php');
                }else{
                    echo "<form method='POST' action='kontosida.php'>
                    Namn:<input type='text' name='name'>
                    Lösenord:<input type='password' name='password'>
                    <input type='submit' class='submit' value='logga in'> 
                    </form>";    
                }
            
            ?>
            <table cellspacing="0">     
                <tr class="toprow">        
                    <td style="border-top-left-radius: 10px;">Tid:</td>
                    <td>Mån</td>
                    <td>Tis</td>
                    <td>Ons</td>
                    <td>Tors</td>
                    <td style="border-top-right-radius: 10px;">Fre</td>           
                </tr>
                <?php                             
                    for($i = 0; $i < count($tidpunkter); $i++){
                        echo "<tr><td>" . $tidpunkter[$i] . "</td>";
                        for($j = 0; $j < 5; $j++){
                                $tempString = "";
                                $tempString .= $dagar[$j];
                                $tempString .= $tidpunkter[$i];
                                if($vektor[$tempString]){
                                        echo "<td class='upptaget'>";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){
                                        if($row['BOOKED'] == 1){
                                            if($row['TIMEBOOKED'] == $tempString){
                                                
                                                echo $row["NAME"] . "</td>"; 
                                                
                                            }
                                        }
                                    }
                                        
                                }else{
                                    echo "<td><div class='shower'></div></td>";
                                }
                                $tempString = "";
                        }
                        echo "</tr>";
                    }   
                ?>
            </table>
            <div class="signcontainer">
                <div class="upptaget uppvisning"></div>
                <h2>Bokad</h2>
            </div>
        </div>
        </div>
    </body>
</html>