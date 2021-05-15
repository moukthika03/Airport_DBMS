<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #000;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  text-align:justify;
}

.sidenav button:hover {
  color: #555555;
}

.main {
  margin-left: 150px; 
  font-size: 27px;
  margin-top: 50px;
  padding: 0px 10px;
  height: 100%;
  background-size:100% 100%;
 background-repeat:no-repeat;
 color: #bbaa88;
 text-align:justify;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.topnav {
  top:0;
  width:100%;
  overflow-x: hidden;
  background-color: #000;
  position:fixed;
}
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: justify;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    
    margin: 4px 0px;
    cursor: pointer;
}


/*.button1 {
    background-color: black;
    color: black;
    //border: 2px solid #4CAF50;
}*/
.button5 {background-color: #000000;}
.topnav p {
  
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 22px;
}


table {
    border-collapse: collapse;
    width: 100%;
    color: #588c7e;
    font-family: monospace;
    font-size: 20px;
    text-align: left;
    
}
th {
    background-color: #588c7e;
    color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}[

</style>
 <script>
    function SearchFlight(btnPassport){
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = btnPassport.value == "Yes" ? "block" : "none";
    }
    </script>
</head>
<body>

<div class="sidenav"><br><br><br><br><br>
<!--	<a href=""> Flights scheduled Today</a><br><br>
  
  <a href="">Employee Record</a><br><br>
  <a href="">Search Flights</a><br>
  <a href="">Ongoing Formalities</a>*/  -->
  < <form method="post">
  <button class="button button5" name="button1">DEPARTURES</button>
  <button class="button button5" name="button3">ARRIVALS</button>
  <button class="button button5" name="button2">PASSENGER DETAILS</button>
    
 
    
  <button class="button button5" name="button5">ONGOING FORMALITIES</button>
    </form>
    <button class="button button5" name="button6" onclick="location.href='DUTYFREE.php';">DUTY-FREE</button>
  
</div>
<div class="topnav">
    <p>AIRPORT DATABASE</p>

</div>
<div class="main"><br><br>
    
    <table>
        <tr>
         <!--   <th>FlightNo</th>
            <th>DepDate</th>
            <th>DepTime</th>
           <th>Gate</th>
            <th>Terminal</th>
            <th>AirplaneCompany</th>  -->
        </tr>
        <?php
    if(array_key_exists('button1', $_POST))
    {
        Disp();
    }
    if(array_key_exists('button2', $_POST))
    {
        PassengerDet();
    }
    if(array_key_exists('button3', $_POST))
    {
        DispARR();
    }
    
    if(array_key_exists('button5', $_POST))
    {
        FormalitiesList();
    }
   
    function Disp()
    {
        
        $conn = mysqli_connect("localhost", "root", "", "AIRPDB");
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT FlightNo,DepDate,DepTime,Gate,AirplaneCompany,Status FROM Flight where year(DepDate)= year(SYSDATE()) AND month(DepDate)= month(SYSDATE()) AND day(DepDate)= day(SYSDATE()) AND (Status<>'ARRIVED' AND Status<>'EN ROUTE') ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<tr><th>" . "FlightNo". "</th><th>" . "DepDate ". "</th><th>"
            . "DepTime". "</th><th>"."Gate"."</th><th>"."Airplane company"."</th><th>"."Status"."</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>" . $row["FlightNo"]. "</td><td>" . $row["DepDate"] . "</td><td>"
                . $row["DepTime"]. "</td><td>". $row["Gate"]. "</td><td>" . $row["AirplaneCompany"] ."</td><td>" . $row["Status"] . "</td></tr>";
            }
            echo "</table>";
        } else
            { echo "0 results"; }
         $conn->close();
    }
    function DispARR()
    {
        
        $conn = mysqli_connect("localhost", "root", "", "AIRPDB");
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT FlightNo,DepDate,DepTime,Gate,AirplaneCompany,Status FROM Flight where year(DepDate)= year(SYSDATE()) AND month(DepDate)= month(SYSDATE())  AND (Status='ARRIVED' OR Status='EN ROUTE')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<tr><th>" . "FlightNo". "</th><th>" . "DepDate ". "</th><th>"
            . "DepTime". "</th><th>"."Gate"."</th><th>"."Airplane company"."</th><th>"."Status"."</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>" . $row["FlightNo"]. "</td><td>" . $row["DepDate"] . "</td><td>"
                . $row["DepTime"]. "</td><td>". $row["Gate"]. "</td><td>" . $row["AirplaneCompany"] ."</td><td>" . $row["Status"] . "</td></tr>";
            }
            echo "</table>";
        } else
        { echo "0 results"; }
        $conn->close();
    }
    function PassengerDet()
    {
        $conn = mysqli_connect("localhost", "root", "", "AIRPDB");
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT P.TicketNum,P.FirstName,P.SeatNum,F.FlightNo,F.DepDate,F.DepTime,Gate,F.AirplaneCompany FROM Passenger P JOIN Flight F ON P.FlightNo = F.FlightNo  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<tr><th>" . "TicketNum ". "</th><th>" . "Firstname ". "</th><th>"
            . "SeatNum "."</th><th>"."FlightNo "."</th><th>"."DepDate "."</th><th>"."DepTime ". "</th><th>"."Gate"."</th><th>"."Airplane company"."</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>" . $row["TicketNum"]. "</td><td>" . $row["FirstName"] . "</td><td>"
                . $row["SeatNum"]. "</td><td>". $row["FlightNo"]. "</td><td>" . $row["DepDate"] . "</td><td>"
                . $row["DepTime"]. "</td><td>". $row["Gate"]. "</td><td>" . $row["AirplaneCompany"] . "</td></tr>";
            }
            echo "</table>";
        } else
        { echo "0 results"; }
         $conn->close();
    }
    function FormalitiesList()
    {
        $conn = mysqli_connect("localhost", "root", "", "AIRPDB");
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "CHECK IN COMPLETED AND LUGGAGE LOADED:-<br><br>";
        $sql = "SELECT TicketNum,FlightNo,Class,FirstName,LastName from Passenger where checkin=1  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<tr><th>" . "TicketNum ". "</th><th>" . "FlightNo". "</th><th>"
            . "Class"."</th><th>"."FirstName "."</th><th>"."LastName "."</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>" . $row["TicketNum"]. "</td><td>" . $row["FlightNo"] . "</td><td>"
                . $row["Class"]. "</td><td>". $row["FirstName"]. "</td><td>" . $row["LastName"] . "</td></tr>";
            }
            echo "</table>";
        } else
        { echo "0 results"; }
        
        echo "<br><br>IMMIGRATION COMPLETED [FOR INTERNATIONAL FLIGHTS ONLY]:-<br><br>";
        $sql = "SELECT TicketNum,FlightNo,Class,FirstName,LastName from Passenger where checkin=1 AND immigration=1  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<table> <tr><th>" . "TicketNum ". "</th><th>" . "FlightNo". "</th><th>"
            . "Class"."</th><th>"."FirstName "."</th><th>"."LastName "."</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>" . $row["TicketNum"]. "</td><td>" . $row["FlightNo"] . "</td><td>"
                . $row["Class"]. "</td><td>". $row["FirstName"]. "</td><td>" . $row["LastName"] . "</td></tr>";
            }
            echo "</table>";
        } else
        { echo "0 results"; }
        
        echo "<br><br>READY TO BOARD:-<br><br>";
        $sql = "SELECT TicketNum,FlightNo,Class,FirstName,LastName from Passenger where checkin=1 AND security=1  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<table> <tr><th>" . "TicketNum ". "</th><th>" . "FlightNo". "</th><th>"
            . "Class"."</th><th>"."FirstName "."</th><th>"."LastName "."</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>" . $row["TicketNum"]. "</td><td>" . $row["FlightNo"] . "</td><td>"
                . $row["Class"]. "</td><td>". $row["FirstName"]. "</td><td>" . $row["LastName"] . "</td></tr>";
            }
            echo "</table>";
        } else
        { echo "0 results"; }
        $conn->close();
    }
    
   /* function SearchFlight()
    {
        
        $conn = mysqli_connect("localhost", "root", "", "AIRPDB");
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        
        /*$sql = "SELECT FlightNo,DepDate,DepTime,Gate,AirplaneCompany FROM Flight where year(DepDate)= year(SYSDATE()) ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<tr><th>" . "FlightNo". "</th><th>" . "DepDate ". "</th><th>"
            . "DepTime". "</th><th>"."Gate"."</th><th>"."Airplane company"."</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>" . $row["FlightNo"]. "</td><td>" . $row["DepDate"] . "</td><td>"
                . $row["DepTime"]. "</td><td>". $row["Gate"]. "</td><td>" . $row["AirplaneCompany"] . "</td></tr>";
            }
            echo "</table>";
        } else
        { echo "0 results"; }
        $conn->close();*/
    //}
   
            ?>
    </table>
	</div>
</div>
   
</body>
</html> 

