
<html>
<head>
	<title>SGBD base</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>

	<form action="" method="get">
	<div class="nav">
		<a href="/"> <h1>SGBD</h1> </a>
		<div class="button-center" action="" method="get">
		<input type="submit" value="Produse" name="produse">
		
		<input type="submit" value="Pc-uri"  name="pcuri">
	
		<input type="submit" value="Laptop-uri"  name="laptopuri">

		<input type="submit" value="Imprimante"  name="imprimante">
		</div>
	</div>

	
	<div class="result">
	<div class="record-menu">
		<?php 
		function getTable($connection, $table){
			return mysqli_query($connection, "select * from ".$table); 
		}
		function printTable($result){
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
					echo $query;
				} else {
					$query = "DELETE FROM ".$table." WHERE Cod=".$key;
				}
				$result = mysqli_query($connection, $query);
				var_dump($result);
				var_dump($table);
				var_dump($keys);
			}
		}
	
		$connection = mysqli_connect("localhost", "root", "", "bazasgbd");
		//if(!mysql_select_db("bazasgbd", $connection))
			//echo "Can't enstabilish a connection with database";
			
		
		$result;
		$table;
		if(empty($_GET)) exit();
		if(isset($_GET["produse"])) {
			$table="produse";
			if($_GET["produse"]=="Delete") {
				deleteRecords($connection, $table, $_GET["drecord"]);
			}
			$result=getTable($connection, "produse");
		} else if(isset($_GET["pcuri"])) {
			$table="pcuri";
			if($_GET["pcuri"]=="Delete") {
				deleteRecords($connection, "pc_uri", $_GET["drecord"]);
			}
			$result=getTable($connection, "pc_uri");
		} else if(isset($_GET["laptopuri"])) {
			$table="laptopuri";
			if($_GET["laptopuri"]=="Delete") {
				deleteRecords($connection, "laptop_uri", $_GET["drecord"]);
			}
			$result=getTable($connection, "laptop_uri");
		} else if(isset($_GET["imprimante"])) {
			$table="imprimante";
			if($_GET["imprimante"]=="Delete") {
				deleteRecords($connection, "imprimante", $_GET["drecord"]);
			}
			$result=getTable($connection, "imprimante");
		}
		
		
			echo "<input type='submit' name=$table value='Delete'>";
		?>
		
	</div>
	<div class="content">
	<?php
	
		printTable($result);

	?>
	</div>
	</div>
	</form>
</body>
</html>