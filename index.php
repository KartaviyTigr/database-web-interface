
<html>
<head>
	<title>SGBD base</title>
	<style>
		body {
			margin:0;
		}
		.nav {
			display:block;
			background:#dddddd;
			text-align:center;
			padding:30px;
			box-shadow: 0 5px 15px 0 #aaa;
			margin-bottom:0;
			box-sizing:border-box;
			height:100px;
		}
		ul {
			list-style:none;
			padding-left:0;
			margin:0;
		}
		.menu { 
			display:inline-block;
			vertical-align:top;
		}
		.drop-down{
			max-height:0;
			overflow:hidden;
			transition:max-height 0.5s ease-in-out;
		}
		.menu:hover .drop-down{
			overflow:visible;
			max-height:80px;

		}
		.menu p{ margin:0;}
		.drop-down input{width:100%;}
		.drop-down input, .menu p {
			border:0;
			padding:10px;
			background:black;
			color:white;
			border-radius:2px;
			transition: transform .3s ease-in-out, height .3s ease-in-out;
		}
		.menu p:hover, .drop-down input:hover{
			background:#eaeaea;
			color:black;
			transform: scale(1.3);
			z-index:10;
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

	<form class="nav" action="" method="get">
		<div class="menu">
		<p>Produse</p>
		<ul class="drop-down">
			<li><input type="submit" value="Show" name="produse"></li>
			<li><input type="submit" value="Delete" name="produse"></li>
		</ul>
		</div>
		<div class="menu">
		<p>PC-uri</p>
		<ul class="drop-down">
			<li><input type="submit" value="Show"  name="pcuri"></li>
			<li><input type="submit" value="Delete"  name="pcuri"></li>
		</ul>
		</div>
		<div class="menu">
		<p>Laptop-uri</p>
		<ul class="drop-down">
			<li><input type="submit" value="Show"  name="laptopuri"></li>
			<li><input type="submit" value="Delete"  name="laptopuri"></li>
		</ul>
		</div>
		<div class="menu">
		<p>Imprimante</p>
		<ul class="drop-down">
			<li><input type="submit" value="Show"  name="imprimante"></li>
			<li><input type="submit" value="Delete"  name="imprimante"></li>
		</ul>
		</div>

	
	<div class="result">
	<?php
		function showTableAll($connection, $table){
			return mysqli_query($connection, "select * from ".$table); 
		}
		function printQueryResult($result){
			echo "<table>";
			while($row = $result->fetch_assoc()){
				if(isset($_GET["produse"])){
					next($row);
					echo "<tr><td><input type='checkbox' name=drecord[] value='".pos($row)."'>";
					reset($row);
				}
				else {echo "<tr><td><input type='checkbox' name=drecord[] value='".pos($row)."'>";}
				foreach($row as $column){
					echo "<td>".$column."</td>";
				}
				echo "</td></tr>";
			}
			echo "</table>";
			return;
		}
		function deleteRecords($connection, $table, $keys){
			foreach($keys as $key){
				if(isset($_GET["produse"])){
					$query = "DELETE FROM $table WHERE Model=$key";
				} else {
					$query = "DELETE FROM ".$table." WHERE Cod=".$key;
				}
				mysqli_query($connection, $query);
			}
		}
	
		$connection = mysqli_connect("localhost", "root", "", "bazasgbd");
		//if(!mysql_select_db("bazasgbd", $connection))
			//echo "Can't enstabilish a connection with database";
			
		
		$result;
		if(isset($_GET["produse"])) {
			if($_GET["produse"]=="Show"){
				$result=showTableAll($connection, "produse");
			} else {
				deleteRecords($connection, "produse", $_GET["drecord"]);
				$result=showTableAll($connection, "produse");
			}
		} else if(isset($_GET["pcuri"])) {
			if($_GET["pcuri"]=="Show"){
				$result=showTableAll($connection, "pc_uri");
			} else {
				deleteRecords($connection, "pc_uri", $_GET["drecord"]);
				$result=showTableAll($connection, "pc_uri");
			}
		} else if(isset($_GET["laptopuri"])) {
			if($_GET["laptopuri"]=="Show"){
				$result=showTableAll($connection, "laptop_uri");
			} else {
				deleteRecords($connection, "laptop_uri", $_GET["drecord"]);
				$result=showTableAll($connection, "laptop_uri");
			}
		} else {
			if($_GET["imprimante"]=="Show"){
				$result=showTableAll($connection, "imprimante");
			} else {
				deleteRecords($connection, "imprimante", $_GET["drecord"]);
				$result=showTableAll($connection, "imprimante");
			}
		}
		
		printQueryResult($result);
	?>
	</div>
	</form>
</body>
</html>