<html>
<head>
	<title>SGBD base</title>
	<style>
		body {
			margin:0;
		}
		form {
			display:block;
			background:#dddddd;
			text-align:center;
			padding:30px;
			box-shadow: 0 5px 15px 0 #aaa;
			margin-bottom:0;
			box-sizing:border-box;
			height:100px;
		}
		input[type="submit"] {
			border:0;
			padding:10px;
			background:black;
			color:white;
			border-radius:2px;
			transition: transform .3s ease-in-out;
		}
		input[type="submit"]:hover {
			background:#eaeaea;
			color:black;
			transform: scale(1.3);
		}
		.result {
			margin:0 auto;
			width:900px;
			box-shadow: 0 0 50px 0 #ddd;
			box-sizing:border-box;
			padding:50px;
		}
		.result table {
			margin:auto;
			border-collapse:collapse;
			text-align:center;
			width:100%;
		}
		.result table tr{
			border-bottom:1px solid black;
		}
		.result table td {
			border-right:1px solid black;
		}
		.result table tr:last-of-type, .result table tr td:last-of-type {
			border:0;
		}
	</style>
</head>
<body>
	<form action="" method="get">
		<input type="submit" value="produse" name="produse">
		<input type="submit" value="pc_uri"  name="pcuri">
		<input type="submit" value="laptop_uri"  name="laptopuri">
		<input type="submit" value="imprimante"  name="imprimante">
	</form>
	
	<div class="result">
	<?php
	
		function showTableAll($connection, $table){
			return mysqli_query($connection, "select * from ".$table); 
		}
		function printQueryResult($result){
			echo "<table>";
			while($row = $result->fetch_assoc()){
				echo "<tr>";
				foreach($row as $column){
					echo "<td>".$column."</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
			return;
		}
	
		$connection = mysqli_connect("localhost", "root", "", "bazasgbd");
		//if(!mysql_select_db("bazasgbd", $connection))
			//echo "Can't enstabilish a connection with database";
			
		
		$result;
		if(isset($_GET["produse"])) {
			$result=showTableAll($connection, "produse");
		} else if(isset($_GET["pcuri"])) {
			$result=showTableAll($connection, "pc_uri");
		} else if(isset($_GET["laptopuri"])) {
			$result=showTableAll($connection, "laptop_uri");
		} else {
			$result=showTableAll($connection, "imprimante");
		}
		
		printQueryResult($result);
	?>
	</div>
</body>
</html>