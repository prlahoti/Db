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
<button type="submit" name="select">Select</button>
<button type="submit" name="insert">Insert</button>
<button type="submit" name="update">Update</button>
<button type="submit" name="delete">Delete</button>
</form> 

</body>
</html>
