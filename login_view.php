
<html>
<head>
	<title>
		Home
	</title>
</head>
<body>
<?php

$this->load->helper('form');
echo form_open('Main/get'); ?>

<?php
echo "<p>Id:";
echo form_input(array('id' => 'id', 'name' => 'id'));
//echo form_input('id',$this->input->post('id'));
echo "</p>";
echo "<p>Name:";
echo form_input(array('id' => 'name', 'name' => 'name'));
//echo form_input('name',$this->input->post('name'));
echo "</p>";
echo form_submit('select','Select');//type=submit,name=select,value=Select
echo form_submit('insert','Insert');
echo form_submit('update','Update');
echo form_submit('delete','Delete');
echo form_close();
?>
</body>
</html>