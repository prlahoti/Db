<?php
require 'db.php';
class Opt
{
    
    public function get()
    {
        if(isset($_GET["id"]) || isset($_GET["name"]))
        {
            $id=$_GET["id"];
            $name=$_GET["name"];
        
        }
        $db = new DB();
        $conn = $db->connect();
        $n2=new Opt();
        if(isset($_GET["select"]))
        {
            $n2->select($id,$name,$conn);
        }
        elseif(isset($_GET["insert"]))
        {
            $n2->insert($id,$name,$conn);
        }
        elseif (isset($_GET["delete"])) 
        {
            $n2->del($id,$name,$conn);
        }
        elseif(isset($_GET["update"]))
        {
            $n2->update($id,$name,$conn);
        }
        $conn=$db->disconn();
    }
    public function select($id,$name,$conn)
    {
        if(empty($id) && empty($name))
        {
            echo "Both Fields Empty";
        }
        elseif (!empty($id) && empty($name)) 
        {
            try
            {
                $sql1=$conn->prepare("SELECT * from MyP WHERE id=:id");
                $sql1->bindParam(':id', $id);
                $sql1->execute();
                $result = $sql1->fetchAll();
                if(!empty($result))
                {
                    foreach($result as $row) 
                    {
                        echo "ID=".$row['id']. "    " ."NAME=".$row['name']. '<br>';
                    }
                }
                else
                {
                    echo "No results to show";
                }
            }
            catch(PDOException $e) 
            {
                echo "Error: " . $e->getMessage();
            }
        }

        elseif (!empty($id) && !empty($name)) 
        {
            try
            {
                $sql1=$conn->prepare("SELECT * from MyP WHERE id=:id and name=:name");
                $sql1->bindParam(':id', $id);
                $sql1->bindParam(':name', $name);
                $sql1->execute();
                $result = $sql1->fetchAll();
                if(!empty($result))
                {
                    foreach($result as $row) 
                    {
                        echo "ID=".$row['id']. "    " ."NAME=".$row['name']. '<br>';
                    }
                }
                else
                {
                    echo "No results to show";
                }
            }
            catch(PDOException $e) 
            {
                echo "Error: " . $e->getMessage();
            }
        }

        elseif (empty($id) && !empty($name)) 
        {
            try
            {
                $sql1=$conn->prepare("SELECT * from MyP WHERE name=:name");
                $sql1->bindParam(':name', $name);
                $sql1->execute();
                $result = $sql1->fetchAll();
                if(!empty($result))
                {
                    foreach($result as $row) 
                    {
                        echo "ID=".$row['id']. "    " ."NAME=".$row['name']. '<br>';
                    }
                }
                else
                {
                    echo "No results to show";
                }
                
            }
            catch(PDOException $e) 
            {
                echo "Error: " . $e->getMessage();
            }
        }   
    }
    public function insert($id,$name,$conn)
    {
        if(empty($id) && empty($name))
        {
            echo "Both Fields Empty";
        }
        elseif(empty($id) && !empty($name))
        {
            //perform insert
            try
            {
                $query1 = $conn->prepare("INSERT INTO MyP VALUES (DEFAULT, :name)");
                //Binding Parameters
                $query1->bindParam(':name', $name);
                $query1->execute();
                echo "Inserted successfully";
            }
            catch(PDOException $e)
            {
                echo "<br>" . $e->getMessage();
            }
        }
        elseif (!empty($id)) 
        {
            echo "Only Name to be entered";
        }
    }
    public function update($id,$name,$conn)
    {
        if(empty($id) && empty($name))
        {
            echo "Both Fields Empty";
        }
        elseif(empty($id) || empty($name))
        {
            echo "Both fields Must be filled";
        }
        elseif(!empty($id) && !empty($name))
        {
            try
            {
                $sql1 = "UPDATE MyP SET name=:name WHERE id=:id";
                $stmt = $conn->prepare($sql1);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                echo $stmt->rowCount() . " record(s) UPDATED successfully";
            }
            catch(PDOException $e)
            {
                echo "<br>" . $e->getMessage();
            }
        
        }
    }
    public function del($id,$name,$conn)
    {
        
        if(empty($id) && empty($name))
        {
            echo "Both Fields Empty";
        }
        elseif (!empty($name) && empty($id)) 
        {
            try
            {
                $sql1 = "DELETE FROM MyP WHERE name=:name";
                $stmt = $conn->prepare($sql1);
                $stmt->bindParam(':name', $name);
                $stmt->execute();
                echo $stmt->rowCount() . " record(s) DELETED successfully"; 
            }
        
            catch(PDOException $e)
            {
                echo $sql1 . "<br>" . $e->getMessage();
            }
        }
        elseif(!empty($id))
        {
            try
            {
                $sql2="DELETE FROM MyP WHERE id=:id";
                $stmt = $conn->prepare($sql2);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                echo $stmt->rowCount() . " record(s) DELETED successfully";
            }
            catch(PDOException $e)
            {
                echo "<br>" . $e->getMessage();
            }
        }
    }
}
?>