
<?php


if(isset($_GET["id"]) || isset($_GET["name"])){
    $id=$_GET["id"];
    $name=$_GET["name"];
}


if(isset($_GET["select"])){
    select($id,$name);
}

elseif(isset($_GET["insert"])){
        insert($id,$name);
}

elseif (isset($_GET["delete"])) {
        del($id,$name);
}

elseif(isset($_GET["update"])){
    update($id,$name);
}


function select($id,$name){


        $servername = "localhost";
        $username = "root";
        $password = "Pragya@246";
        $dbname = "myDB";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if(empty($id) && empty($name)){
        echo "Both Fields Empty";
    }
    elseif (!empty($id)) {
        try{
             $sql1=$conn->prepare("SELECT * from MyP WHERE id=:id");
             $sql1->bindParam(':id', $id);
        $sql1->execute();
        $result = $sql1->fetchAll();
        foreach($result as $row) {
            echo "ID=".$row['id']. "    " ."NAME=".$row['name']. '<br>';
        }
        
        }

        catch(PDOException $e) {
             echo "Error: " . $e->getMessage();
            }
       

    }
    elseif (empty($id) && !empty($name)) {

            try{
             $sql1=$conn->prepare("SELECT * from MyP WHERE name=:name");
              $sql1->bindParam(':name', $name);
        $sql1->execute();
        $result = $sql1->fetchAll();
        foreach($result as $row) {
            echo "ID=".$row['id']. "    " ."NAME=".$row['name']. '<br>';
        }
    }

        catch(PDOException $e) {
             echo "Error: " . $e->getMessage();
            }
    }
    
    $conn=null;
}





function insert($id,$name){
        $servername = "localhost";
        $username = "root";
        $password = "Pragya@246";
        $dbname = "myDB";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(empty($id) && empty($name)){
        echo "Both Fields Empty";
    }

    elseif(empty($id) && !empty($name)){
        //perform insert
        try{
            $query1 = $conn->prepare("INSERT INTO MyP VALUES (DEFAULT, :name)");
            $query1->bindParam(':name', $name);
            $query1->execute();
            echo "Inserted successfully";
        }
        catch(PDOException $e)
        {
            echo "<br>" . $e->getMessage();
        }

    }
    elseif (!empty($id)) {
        echo "Only Name to be entered";
    }
    
    $conn = null;
}




function update($id,$name){

        $servername = "localhost";
        $username = "root";
        $password = "Pragya@246";
        $dbname = "myDB";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(empty($id) && empty($name)){
        echo "Both Fields Empty";
    }

    elseif(empty($id) || empty($name))
    {
        echo "Both fields Must be filled";
    }

    elseif(!empty($id) && !empty($name))
    {
        try{
            
            $sql1 = "UPDATE MyP SET name='$name' WHERE id=$id";
            $stmt = $conn->prepare($sql1);
            $stmt->execute();
        echo $stmt->rowCount() . " record(s) UPDATED successfully";
        }
        catch(PDOException $e)
        {
            echo "<br>" . $e->getMessage();
        }
        
    }
}




function del($id,$name){

    $servername = "localhost";
        $username = "root";
        $password = "Pragya@246";
        $dbname = "myDB";
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    if(empty($id) && empty($name)){
        echo "Both Fields Empty";
    }

    elseif (!empty($name) && empty($id)) {
        try{
            
            $sql1 = "DELETE FROM MyP WHERE name=$name";
            $conn->exec($sql1);
            echo "Deleted successfully";
        
        }
        
       catch(PDOException $e)
        {
            echo $sql1 . "<br>" . $e->getMessage();
         }
        
    }

    elseif(!empty($id)){
        try{
           
            $sql2="DELETE FROM MyP WHERE id=$id";
            $conn->exec($sql2);
            echo "Deleted";
        }
        catch(PDOException $e)
        {
            echo $sql2 . "<br>" . $e->getMessage();
         }
         
    }

    $conn=null;
    
}


?>




<html>
<body>
<br>
<form>
Id: <input type="text" name="id"><br><br>
Name: <input type="text" name="name"><br><br>
<button type="submit" name="select" value="select" onclick="select();">Select</button>
<button type="submit" name="insert" value="insert" onclick="insert();">Insert</button>
<button type="submit" name="update" value="update" onclick="update();">Update</button>
<button type="submit" name="delete" value="delete" onclick="del();">Delete</button>
</form> 

</body>
</html>