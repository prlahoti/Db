
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

        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>ID</th><th>NAME</th></tr>";

    class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td>" . parent::current(). "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
    } 

    if(empty($id) && empty($name)){
        echo "Both Fields Empty";
    }
    elseif (!empty($id)) {
        try{
             $sql1=$conn->prepare("SELECT * from MyP WHERE id='$id'");
        $sql1->execute();

        // set the resulting array to associative
        $result = $sql1->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new TableRows(new RecursiveArrayIterator($sql1->fetchAll())) as $k=>$v) {
            echo $v;
            }
        }

        catch(PDOException $e) {
             echo "Error: " . $e->getMessage();
            }
    }
    elseif (empty($id) && !empty($name)) {
            try{
             $sql1=$conn->prepare("SELECT * from MyP WHERE name='$name'");
        $sql1->execute();

        // set the resulting array to associative
        $result = $sql1->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new TableRows(new RecursiveArrayIterator($sql1->fetchAll())) as $k=>$v) {
            echo $v;
            }
        }

        catch(PDOException $e) {
             echo "Error: " . $e->getMessage();
            }
    }
    
    $conn=null;
    echo "</table>";
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
            
            $query1 = "INSERT INTO MyP (id,name) VALUES (DEFAULT,'$name')";
            $conn->exec($query1);
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
            $sql1 = "UPDATE MyP SET name='$name' WHERE id='$id'";
        // Prepare statement
        $stmt = $conn->prepare($sql1);
        // execute the query
        $stmt->execute();
        echo $stmt->rowCount() . " record(s) UPDATED successfully";
        }
        catch(PDOException $e)
        {
            echo "<br>" . $e->getMessage();
        }
        
    }
    $conn=null;
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
            
            $sql1 = "DELETE FROM MyP WHERE name='$name'";
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
