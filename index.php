<?php
require 'opt.php';
$n1=new Opt();
$n1->get();
?>

<html>
<body>
<br>
<form method="get" action="opt.php">
Id: <input type="text" name="id"><br><br>
Name: <input type="text" name="name"><br><br>
<button type="submit" name="select" value="select" onclick="select();">Select</button>
<button type="submit" name="insert" value="insert" onclick="insert();">Insert</button>
<button type="submit" name="update" value="update" onclick="update();">Update</button>
<button type="submit" name="delete" value="delete" onclick="del();">Delete</button>
</form> 

</body>
</html>