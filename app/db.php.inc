<?php 

    define("DBHOST", "localhost");
    define("DBNAME","birzeit_car_rental_online_system");
    define("DBUSER","MotasemAli");
    define("DBPASS","Simon1110");

    function db_connect($dbhost = DBHOST,$dbname = DBNAME, $dbuser = DBUSER, $dbpass = DBPASS){
        $connectionString = "mysql:host=$dbhost;dbname=$dbname";

        try{
            $pdo = new PDO($connectionString, $dbuser, $dbpass);
        return $pdo;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function displayHead(){
       $headerHTML = <<<REC
        <header>
            <nav>
            <figure><img src="../images/logo.jpg" alt="logo" height="80" width="80" /></figure>
            <span>Shippify</span>
            </nav>
            <h1>Welcome to Shippify</h1>
            <p>
            one of the best stores you could ever visit in your entire life<br />no
            need to go to a thousends of stores
            </p>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="./registration/step1.php">Register</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="index.php">Home</a></li>
            </ul>
            <hr/>
         </header>
    REC;
        return $headerHTML;
    }

    function displayFooter(){
        $footerHTML = <<<REC
        <footer>
        <hr/>
            <h2>Contact Details</h2>
            <p>Last update date: 4/6/2024</p>
            <p>Address: Tulkarm/Kuffer Jammal/Secondary school street</p>
            <h3>Customer Support:</h3>
            <nav>
                <ul>
                    <li>Telephone Number: +972 546 697 525</li>
                    <li>Email: shippify@gmail.com</li>
                </ul>
            </nav>
        </footer>
     REC;
         return $footerHTML;
     }
    
?>