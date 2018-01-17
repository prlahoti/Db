
<html>
<head>
    <title>Welcome</title>
</head>
<body>
	<ul>
		@foreach ($names as $show)
			<li>
			<a href="index.php/names/{{$show->id}}"> {{$show->person_name}}</a> </li>
		@endforeach
	</ul>
</body>
</html>