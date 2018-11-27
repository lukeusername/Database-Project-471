<?php
require_once '../PHP-SQL-Parser/src/PHPSQLParser.php';
include_once __DIR__.'../../htdocs/dbh.inc.php';


$querytype = $_POST['querytype'];
$in1 = $_POST['input1'];
$in2 = $_POST['input2'];

if ($querytype == 'SELECT' || $querytype == 'DELETE'){
	$querytype2 = $_POST['querytype2'];
}
if ($querytype == 'SELECT' || $querytype == 'UPDATE') {
	$in3 = $_POST['input3'];
}

if ($querytype == 'SELECT'){
	$object = new Dbh;
	print_r("input: ".$querytype." ".$in1." FROM ".$in2." ".$querytype2);
	$stmt = $object->connect()->query($querytype." ".$in1." FROM ".$in2." ".$querytype2." ".$in3);
	echo nl2br("\n\nRESULTS:\n");
	while ($row = $stmt->fetch()){
		$output = $row[$in1];
		echo nl2br("\n");
		print_r($output);
	}
}
if ($querytype == 'DELETE'){
	$object = new Dbh;
	print_r($querytype." FROM ".$in1." ".$querytype2." ".$in2);
	$stmt = $object->connect()->query($querytype." FROM ".$in1." ".$querytype2." ".$in2);

	$object2 = new Dbh;
	echo nl2br("\n");
	print_r("TABLE UPDATED: ".$in1);
	echo nl2br("\n");
	$stmt2 = $object2->connect()->query("SELECT * FROM ".$in1);

	if ($in1 == 'department'){
		echo "<table border='1'>
		<tr>
		<th>deptNum</th>
		<th>deptName</th>
		</tr>";
		while ($row = $stmt2->fetch()){
			echo "<tr>";
			echo "<td>" . $row['deptNum'] . "</td>";
			echo "<td>" . $row['deptName'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	if ($in1 == 'employee'){
		echo "<table border='1'>
		<tr>
		<th>ssn</th>
		<th>dob</th>
		<th>fname</th>
		<th>minit</th>
		<th>lname</th>
		<th>address</th>
		<th>hourPay</th>
		<th>monthSal</th>
		</tr>";
		while ($row = $stmt2->fetch()){
			echo "<tr>";
			echo "<td>" . $row['ssn'] . "</td>";
			echo "<td>" . $row['dob'] . "</td>";
			echo "<td>" . $row['fname'] . "</td>";
			echo "<td>" . $row['minit'] . "</td>";
			echo "<td>" . $row['lname'] . "</td>";
			echo "<td>" . $row['address'] . "</td>";
			echo "<td>" . $row['hourPay'] . "</td>";
			echo "<td>" . $row['monthSal'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	if ($in1 == 'manager'){
		echo "<table border='1'>
		<tr>
		<th>ssn</th>
		<th>dob</th>
		<th>fname</th>
		<th>minit</th>
		<th>lname</th>
		<th>address</th>
		<th>monthSal</th>
		</tr>";
		while ($row = $stmt2->fetch()){
			echo "<tr>";
			echo "<td>" . $row['ssn'] . "</td>";
			echo "<td>" . $row['dob'] . "</td>";
			echo "<td>" . $row['fname'] . "</td>";
			echo "<td>" . $row['minit'] . "</td>";
			echo "<td>" . $row['lname'] . "</td>";
			echo "<td>" . $row['address'] . "</td>";
			echo "<td>" . $row['monthSal'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	if ($in1 == 'dependent'){
		echo "<table border='1'>
		<tr>
		<th>name</th>
		<th>relationship</th>
		<th>guardian_ssn</th>
		</tr>";
		while ($row = $stmt2->fetch()){
			echo "<tr>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['relationship'] . "</td>";
			echo "<td>" . $row['guardian_ssn'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	if ($in1 == 'location'){
		echo "<table border='1'>
		<tr>
		<th>deptNum</th>
		<th>location</th>
		</tr>";
		while ($row = $stmt2->fetch()){
			echo "<tr>";
			echo "<td>" . $row['deptNum'] . "</td>";
			echo "<td>" . $row['location'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	if ($in1 == 'project'){
		echo "<table border='1'>
		<tr>
		<th>projName</th>
		<th>projNum</th>
		<th>projDesc</th>
		</tr>";
		while ($row = $stmt2->fetch()){
			echo "<tr>";
			echo "<td>" . $row['projName'] . "</td>";
			echo "<td>" . $row['projNum'] . "</td>";
			echo "<td>" . $row['projDesc'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
if ($querytype == 'INSERT'){
	$object = new Dbh;
	print_r($querytype." INTO ".$in1." VALUES ".$in2);

  	$parser=new PHPSQLParser($querytype." INTO ".$in1." VALUES ".$in2, true);

  	$val = 1;
  	if ($parser->parsed['INSERT'][0]['table'] == 'employee'){
  		if (strlen($parser->parsed['VALUES'][0]['data'][0]['base_expr']) != 9){
  			echo nl2br("\n");
  			print_r('bad job, ssn should be 9 digits long');
  			$val = 0;

  		}
  	}
  	if ($parser->parsed['INSERT'][0]['table'] == 'manager'){
  		if (strlen($parser->parsed['VALUES'][0]['data'][0]['base_expr']) != 9){
  			echo nl2br("\n");
  			print_r('bad job, ssn should be 9 digits long');
  			$val = 0;
  		}
  	}
  	if ($parser->parsed['INSERT'][0]['table'] == 'dependent'){
  		if (strlen($parser->parsed['VALUES'][0]['data'][2]['base_expr']) != 9){
  			echo nl2br("\n");
  			print_r('bad job, ssn should be 9 digits long');
  			$val = 0;
  		}
  	}
  	if ($parser->parsed['INSERT'][0]['table'] == 'project'){
  		if (strlen($parser->parsed['VALUES'][0]['data'][1]['base_expr']) != 5){
  			echo nl2br("\n");
  			print_r('bad job, project number should be 5 digits long');
  			$val = 0;
  		}
  	}
  	if ($parser->parsed['INSERT'][0]['table'] == 'department'){
  		if (strlen($parser->parsed['VALUES'][0]['data'][0]['base_expr']) != 3){
  			echo nl2br("\n");
  			print_r('bad job, department number should be 3 digits long');
  			$val = 0;
  		}
  	}
  	if ($parser->parsed['INSERT'][0]['table'] == 'location'){
  		if (strlen($parser->parsed['VALUES'][0]['data'][0]['base_expr']) != 3){
  			echo nl2br("\n");
  			print_r('bad job, location number should be 3 digits long');
  			$val = 0;
  		}
  	}

  	if ($val == 1){

		$stmt = $object->connect()->query($querytype." INTO ".$in1." VALUES ".$in2);

		$object2 = new Dbh;
		echo nl2br("\n");
		print_r("TABLE UPDATED: ".$in1);
		echo nl2br("\n");
		$stmt2 = $object2->connect()->query("SELECT * FROM ".$in1);

		if ($in1 == 'department'){
			echo "<table border='1'>
			<tr>
			<th>deptNum</th>
			<th>deptName</th>
			</tr>";
			while ($row = $stmt2->fetch()){
				echo "<tr>";
				echo "<td>" . $row['deptNum'] . "</td>";
				echo "<td>" . $row['deptName'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		if ($in1 == 'employee'){
			echo "<table border='1'>
			<tr>
			<th>ssn</th>
			<th>dob</th>
			<th>fname</th>
			<th>minit</th>
			<th>lname</th>
			<th>address</th>
			<th>hourPay</th>
			<th>monthSal</th>
			</tr>";
			while ($row = $stmt2->fetch()){
				echo "<tr>";
				echo "<td>" . $row['ssn'] . "</td>";
				echo "<td>" . $row['dob'] . "</td>";
				echo "<td>" . $row['fname'] . "</td>";
				echo "<td>" . $row['minit'] . "</td>";
				echo "<td>" . $row['lname'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['hourPay'] . "</td>";
				echo "<td>" . $row['monthSal'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		if ($in1 == 'manager'){
			echo "<table border='1'>
			<tr>
			<th>ssn</th>
			<th>dob</th>
			<th>fname</th>
			<th>minit</th>
			<th>lname</th>
			<th>address</th>
			<th>monthSal</th>
			</tr>";
			while ($row = $stmt2->fetch()){
				echo "<tr>";
				echo "<td>" . $row['ssn'] . "</td>";
				echo "<td>" . $row['dob'] . "</td>";
				echo "<td>" . $row['fname'] . "</td>";
				echo "<td>" . $row['minit'] . "</td>";
				echo "<td>" . $row['lname'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['monthSal'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		if ($in1 == 'dependent'){
			echo "<table border='1'>
			<tr>
			<th>name</th>
			<th>relationship</th>
			<th>guardian_ssn</th>
			</tr>";
			while ($row = $stmt2->fetch()){
				echo "<tr>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['relationship'] . "</td>";
				echo "<td>" . $row['guardian_ssn'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		if ($in1 == 'location'){
			echo "<table border='1'>
			<tr>
			<th>deptNum</th>
			<th>location</th>
			</tr>";
			while ($row = $stmt2->fetch()){
				echo "<tr>";
				echo "<td>" . $row['deptNum'] . "</td>";
				echo "<td>" . $row['location'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		if ($in1 == 'project'){
			echo "<table border='1'>
			<tr>
			<th>projName</th>
			<th>projNum</th>
			<th>projDesc</th>
			</tr>";
			while ($row = $stmt2->fetch()){
				echo "<tr>";
				echo "<td>" . $row['projName'] . "</td>";
				echo "<td>" . $row['projNum'] . "</td>";
				echo "<td>" . $row['projDesc'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	}
}
if ($querytype == 'UPDATE'){
	$object = new Dbh;
	print_r($querytype." ".$in1." SET ".$in2." WHERE ".$in3);
	$stmt = $object->connect()->query($querytype." ".$in1." SET ".$in2." WHERE ".$in3);
}

?>