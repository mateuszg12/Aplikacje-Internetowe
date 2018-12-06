<html>
<head>
    <title>M Grudzieñ - nastaw</title>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"> <!-- Polskie znaki w PHP -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="HTML,CSS,PHP,JavaScript,learning">
	<meta name="author" content="Mateusz Grudzieñ">
	<meta name="description" content="Strona napisana podczas zajêæ z Aplikacji Internetowych.">
	
	<link rel="icon" href="img/ikona.png" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	
    <?php
        $data = file_get_contents('data/data.txt');
		$j = 0;
		$tmp = "";
		
		for($i = 0; $i < strlen($data); $i++)
		{
			if($j < 4)
			{
				if($data[$i] == ":")
				{
					$temp[$j] = $tmp;
					$tmp = "";
					$j++;
				}
				else
				{
					$tmp = $tmp . $data[$i];
				}
			}
			else
			{
				if($data[$i] == ":")
				{
					$core[$j-4] = $tmp;
					$tmp = "";
					$j++;
				}
				else
				{
					$tmp = $tmp . $data[$i];
				}
			}
		}
    ?> 
	
	<?php
		$data_to_write = $temp[0] . ":" . $temp[1] . ":" . $temp[2] . ":" . $temp[3] . ":";
		$data_to_write =  $data_to_write . $_GET["core_1"] . ":" . $_GET["core_2"] . ":" . $_GET["core_3"] . ":" . $_GET["core_4"] . ":";
		$filename = "data/data.txt";
		$handle = fopen($filename, "w");
		fwrite($handle, $data_to_write);
		fclose($handle);
	?>
</head>
<body>	
	<h2 align=center> Nastawiono nowe parametry </h2>

	Temperatura rdzenia 1: <?php echo $temp[0]; ?><br>
	Temperatura rdzenia 2: <?php echo $temp[1]; ?><br>
	Temperatura rdzenia 3: <?php echo $temp[2]; ?><br>
	Temperatura rdzenia 4: <?php echo $temp[3]; ?><br> <br>
	
	U¿ycie rdzenia 1: <?php echo $_GET["core_1"]; ?><br>
	U¿ycie rdzenia 2: <?php echo $_GET["core_2"]; ?><br>
	U¿ycie rdzenia 3: <?php echo $_GET["core_3"]; ?><br>
	U¿ycie rdzenia 4: <?php echo $_GET["core_4"]; ?><br> <br>


	<form action="index.html">
    
		<input type="submit" value="Powrót" />

	</form>
</body>
</html> 