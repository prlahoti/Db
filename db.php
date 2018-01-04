<?php
class DB
{
	public function connect()
	{
		$servername = "localhost";
        $username = "root";
        $password = "Pragya@246";
        $dbname = "myDB";
        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully"; 
        }

        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
	}

	public function disconn()
	{
		$conn = null;
        return $conn;
	}
}

?>


