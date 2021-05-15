<?php
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "AirportDB";


$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
    $sql = "CREATE DATABASE IF NOT EXISTS AIRPDB";
    if (mysqli_query($conn, $sql)) {
        echo "Database created successfully<br/>";
    }
    else {
        echo "Error creating database: " . mysqli_error($conn);
    }
    $sql = "USE AIRPDB";
    mysqli_query($conn, $sql);

    $sql="truncate table  Country";
    if (mysqli_query($conn, $sql)) {
        echo "Truncated successfully<br/>";
    }
    else {
        echo "Error truncating " . mysqli_error($conn);
    }
    $sql="truncate table  City";
    if (mysqli_query($conn, $sql)) {
        echo "Truncated successfully<br/>";
    }
    else {
        echo "Error truncating " . mysqli_error($conn);
    }
    $sql="truncate table  Immigration";
    if (mysqli_query($conn, $sql)) {
        echo "Truncated successfully<br/>";
    }
    else {
        echo "Error truncating " . mysqli_error($conn);
    }
    $sql="truncate table  CheckIn";
    if (mysqli_query($conn, $sql)) {
        echo "Truncated successfully<br/>";
    }
    else {
        echo "Error truncating " . mysqli_error($conn);
    }
    $sql="truncate table  SupportStaff";
    if (mysqli_query($conn, $sql)) {
        echo "Truncated successfully<br/>";
    }
    else {
        echo "Error truncating " . mysqli_error($conn);
    }
    $sql="truncate table  Security";
    if (mysqli_query($conn, $sql)) {
        echo "Truncated successfully<br/>";
    }
    else {
        echo "Error truncating " . mysqli_error($conn);
    }
   
    $sql="UPDATE Flight set DepDate=SYSDATE() where DepDate<> SYSDATE()";
    if (mysqli_query($conn, $sql)) {
        echo "Updated successfully<br/>";
    }
    else {
        echo "Error updating " . mysqli_error($conn);
    }
   
//For Airport Table
$sql = "CREATE TABLE IF NOT EXISTS Airport (
ID int(6),
Name varchar(30) NOT NULL,
City varchar(20) NOT NULL,
Country varchar(20) NOT NULL,
PRIMARY KEY (ID)
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }
//For City table
$sql = "CREATE TABLE IF NOT EXISTS City (
ID int(6), 
City varchar(20) NOT NULL,
FOREIGN KEY (ID)
REFERENCES Airport(ID)
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }

//For Country table
$sql = "CREATE TABLE IF NOT EXISTS Country (
ID int(6), 
Country varchar(20) NOT NULL,
City varchar(20) NOT NULL,
FOREIGN KEY (ID)
REFERENCES Airport(ID)
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }

//For Employee Table
$sql = "CREATE TABLE IF NOT EXISTS Employee (
EmpID int(6),
Name varchar(30) NOT NULL,
DOB date NOT NULL,
Salary int NOT NULL,
Terminal varchar(20) NOT NULL,
PRIMARY KEY (EmpID) 
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    
//For Immigration table
$sql = "CREATE TABLE IF NOT EXISTS Immigration (
EmpID int(6),
CounterNum int NOT NULL,
FOREIGN KEY (EmpID)
REFERENCES Employee(EmpID) 
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }

//For CheckIn table
$sql = "CREATE TABLE IF NOT EXISTS CheckIn (
EmpID int(6),
Airline varchar(10) NOT NULL,
FOREIGN KEY (EmpID)
REFERENCES Employee(EmpID) 
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }

//For SupportStaff table
$sql = "CREATE TABLE IF NOT EXISTS SupportStaff(
EmpID int(6),
Location varchar(10) NOT NULL,
FOREIGN KEY (EmpID)
REFERENCES Employee(EmpID) 
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }

//For Security table
$sql = "CREATE TABLE IF NOT EXISTS Security (
EmpID int(6),
Gate varchar(10) NOT NULL,
CounterNum int NOT NULL,
FOREIGN KEY (EmpID)
REFERENCES Employee(EmpID) 
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }

//For Flight Table
$sql = "CREATE TABLE IF NOT EXISTS Flight (
AirportID int,
FlightNo int,
DepDate date,
DepTime time NOT NULL,
Gate varchar(20) NOT NULL,
Terminal varchar(20) NOT NULL,
Capacity int NOT NULL,
AirplaneCompany varchar(10) NOT NULL,
DestCountry varchar(20) NOT NULL,
DestCity varchar(20) NOT NULL,
AirportName varchar(10) NOT NULL,
Status varchar(20) DEFAULT "SCHEDULED",
PRIMARY KEY (FlightNo),
FOREIGN KEY (AirportID)
REFERENCES Airport(ID)
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    $sql="CREATE TRIGGER before_Flight_insert
    BEFORE INSERT
    ON Flight FOR EACH ROW
    BEGIN
    DECLARE errorMessage VARCHAR(255);
    SET errorMessage = CONCAT('The new capacity  cannot be  greater than 1000 '
                              );
    
    IF (NEW.Capacity >1000 OR (NEW.Status <>'ARRIVED' AND New.Status<> 'DELAYED' AND NEW.Status <>'SCHEDULED' AND New.Status<> 'GATE OPEN' AND NEW.Status <>'BOARDING' AND New.Status<> 'ENROUTE' ) ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = errorMessage;
    END IF;
    END; ";
    
    if (mysqli_query($conn, $sql)) {
        echo "Trigger successfully<br/>";
    }
    else {
        echo "Error in trigger " . mysqli_error($conn);
    }
//For Passenger Table
$sql = "CREATE TABLE IF NOT EXISTS Passenger (
TicketNum int(13),
FlightNo int,
Class varchar(20) NOT NULL,
Price int NOT NULL,
SeatNum int(3) NOT NULL,
FirstName varchar(10) NOT NULL,
LastName varchar(10) NOT NULL,
PhoneNum bigint(10) NOT NULL,
checkin tinyint(1),
immigration tinyint(1) DEFAULT 0,
security tinyint(1) DEFAULT 0,
PRIMARY KEY (TicketNum) DEFAULT 0,
FOREIGN KEY (FlightNo)
REFERENCES Flight(FlightNo)
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    
    $sql="CREATE TRIGGER before_Passenger_insert
    BEFORE INSERT
    ON Passenger FOR EACH ROW
    BEGIN
    DECLARE errorMessage VARCHAR(255);
    SET errorMessage = CONCAT('Order of formalities:- CheckIn-> Immigration(if International)-> Security'
                              );
    
    IF (NEW.immigration =1 AND NEW.checkin=0) OR (NEW.security =1 AND NEW.checkIn=0) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = errorMessage;
    END IF;
    END; ";
    if (mysqli_query($conn, $sql)) {
        echo "Trigger successfully<br/>";
    }
    else {
        echo "Error in trigger " . mysqli_error($conn);
    }
//For Duty free Table
$sql = "CREATE TABLE IF NOT EXISTS  DutyFree (
ShopID int,
ProductID int,
TotalCost int,
PurchaseItem varchar(100),
PRIMARY KEY (ShopID,ProductID)
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }

//For Purchase table
$sql = "CREATE TABLE IF NOT EXISTS Purchases (
ShopID int,
ProductID int,
TicketNum int(13),
FOREIGN KEY (ShopID,ProductID)
REFERENCES DutyFree(ShopID,ProductID),
/*FOREIGN KEY (ProductID)
REFERENCES DutyFree(ProductID)*/
FOREIGN KEY (TicketNum)
REFERENCES Passenger(TicketNum)
)";
    if (mysqli_query($conn, $sql)) {
        echo "Table Table created successfully<br/>";
    }
    else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    
$sql="INSERT INTO Airport (ID,Name,City,Country) VALUES (101,'CSM','Mumbai','India'),(482,'CIA','Chennai','India'),
    
    (254,'IGI','Delhi','India'),(111,'PVG','Shanghai','China'),(355,'NRT','Tokyo','Japan')";
    
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    
$sql= "INSERT  INTO Domestic VALUES (101,'Chennai'),
    
    (101,'Delhi'),(254,'Jaipur'),(254,'Chennai')";
    
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    
$sql= " INSERT INTO International VALUES (101, 'UAE','Abhu Dhabi'),(101, 'USA','New York'),
    
    (101, 'Singapore','Singapore'),(482,'China','Shanghai'),(482,'Japan','Tokyo')";
    
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    
 $sql=" INSERT INTO Employee VALUES (10101,'Varun','1996/10/01',50000,'T1'),
    
    (10111,'Arun','1996/09/01',50000,'T2'), (11111,'Varun','1995/08/08',50000,'T3'),
    
    (14321,'Varun','1995/12/11',45000,'T1'), (12321,'Varun','1994/12/10',55000,'T2')";
    
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    
    $sql="INSERT INTO Flight VALUES (101,321,SYSDATE(),'12:10','F6','T1',300,'Spicejet','India','Bangalore','BIA','GATE OPEN'),
    (101,256,SYSDATE(),'3:40','G2','T3',350,'Lufthansa','Germany','Berlin','GIA','SCHEDULED'),
    (101,311,SYSDATE(),'2:45','D3','T2',200,'Scoot','Singapore','Singapore','CIA','BOARDING'),
    (101,783,SYSDATE(),'10:30','C1','T3',300,'Emirates','UAE','Dubai','DIA','SCHEDULED'),
        (101,370,SYSDATE(),'14:50','A2','T1',350,'AirIndia','India','Delhi','IGI','DELAYED'),
    (355,138,SYSDATE(),'23:15','E1','T1',560,'AirIndia','India','Mumbai','CST','ARRIVED'),
    (482,543,SYSDATE(),'2:05','D4','T2',400,'Vistara','India','Mumbai','CST','ARRIVED')";
    
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    $sql="INSERT INTO Passenger VALUES (3421,311,'Economy',45000,'11D','Varsha','Menon',4567623122,1,0,0),
    (34421,311,'Business',110000,'1C','Karen','Jack',623122,1,1,0),
    (3452,311,'Economy',45500,'27F','Navya','Mathur',8967213126,0,0,0),
    (3621,370,'Economy',5000,'16F','Arnav','Thakur',3557673221,1,0,1),
    (34210,370,'Economy',45100,'13A','Aaron','Watson',123122,1,1,1)";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    
    $sql="INSERT INTO CheckIn VALUES (10101,'AirIndia')";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    $sql="INSERT INTO Immigration VALUES (10111,4)";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    $sql="INSERT INTO Security VALUES (14321,'1C',2)";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    $sql="INSERT INTO DutyFree VALUES (1001,'01',1200,'Apple Earpods'),(1003,'09',200,'Cashmere Shawl'),(1009,'03',900,'Agatha Christe- The ABC Murders'),(1004,'10',1099,'Dairy Milk- 5 set Chocolate'),(10013,'02',30,'The Hindu- Newspaper')";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Values inserted successfully<br/>";
    }
    else {
        echo "Error inserting values: " . mysqli_error($conn);
    }
    
    $sql="CREATE TRIGGER IF NOT EXISTS before_Purchase_insert
    BEFORE INSERT
    ON Purchases FOR EACH ROW
    BEGIN
    DECLARE TN int;
    
    
    DECLARE errorMessage VARCHAR(255);
    SET errorMessage = CONCAT('Payment Unsuccessful!. Ticket Number not registered.'
                              );
    SELECT P.TicketNum into TN FROM Passenger P  where P.TicketNum=NEW.TicketNum;
    IF (TN = NULL ) THEN
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = errorMessage;
    
    END IF;
    END; ";
    if (mysqli_query($conn, $sql)) {
        echo "Trigger successfully<br/>";
    }
    else {
        echo "Error in trigger " . mysqli_error($conn);
    }
    
   /* $sql="UPDATE Passenger set checkin=1 where F.DepDate= (select F.DepDate from Passenger P JOIN Flight F on P.FlightNo=F.FlightNo AND year(F.DepDate)=year(SYSDATE()) AND hour(F.DepTime)=hour(SYSDATE())+3)";
    if (mysqli_query($conn, $sql)) {
        echo "Updated successfully<br/>";
    }
    else {
        echo "Error updating " . mysqli_error($conn);
    }*/
    /*$sql="delimiter /";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Delimiter changed <br/>";
    }
    else {
        echo "Delimiter not changed " . mysqli_error($conn);
    }*/
    /*$sql="CREATE PROCEDURE IF NOT EXISTS TodayFlights() BEGIN select*from Flights where DepDate=SYSDATE(); END ";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Procedure created<br/>";
    }
    else {
        echo "Error creating procedure: " . mysqli_error($conn);
    }*/
   /* $sql="delimiter ;";
    if (mysqli_multi_query($conn, $sql)) {
        echo "Delimiter changed <br/>";
    }
    else {
        echo "Delimiter not changed " . mysqli_error($conn);
    }*/
  /*$sql="INSERT INTO DutyFree VALUES ( 1,11,200,’Shawl’), ( 1,12,50,’Studs’), ( 2,21,100,’Slippers’),  (2,22,90,’Icecream’), ( 3,31,40,’Juice’)";
    
    
    
  /*  INSERT INTO CheckIn VALUES (10101,’AirIndia’),(11111,’IndiGo’),(10111,’GoAir’),(12321,’GoAir’),(14321,’AirIndia’);*/
    

/*if ($conn->query($sql) === TRUE) {
  echo "Table AirportDB created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}*/

//$conm/n->close();
    mysqli_close($conn); 
?>
