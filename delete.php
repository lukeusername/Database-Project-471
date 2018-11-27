<!DOCTYPE html>
<html>
	<CENTER>
		<title>DELETE</title>
		<br>
		<br>
		<br>
		<h2>DELETE FROM LUKE'S DATABASE</h2>

		 <form action="connect.php" method="post"><br><br>
			<br><br><br><br>
			<input type="radio" name="querytype" value="DELETE" checked>
			DELETE FROM
			<input type="text" name="input1"></input>
			<select name="querytype2">
				<option></option>
				<option>WHERE</option>
			</select>
			<input type="text" name="input2"></input>
			<input type="submit" name="enter"></input>
		</form>
	</CENTER>
</html>

<?php
include_once 'dbh.inc.php';
$in0 = $_POST['input0'];
$object = new Dbh;
print_r("TABLE: ".$in0);
echo nl2br("\n");
$stmt = $object->connect()->query("SELECT * FROM ".$in0);

if ($in0 == 'department'){
	echo "<table border='1'>
	<tr>
	<th>deptNum</th>
	<th>deptName</th>
	</tr>";
	while ($row = $stmt->fetch()){
		echo "<tr>";
		echo "<td>" . $row['deptNum'] . "</td>";
		echo "<td>" . $row['deptName'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
if ($in0 == 'employee'){
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
	while ($row = $stmt->fetch()){
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
if ($in0 == 'manager'){
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
	while ($row = $stmt->fetch()){
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
if ($in0 == 'dependent'){
	echo "<table border='1'>
	<tr>
	<th>name</th>
	<th>relationship</th>
	<th>guardian_ssn</th>
	</tr>";
	while ($row = $stmt->fetch()){
		echo "<tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['relationship'] . "</td>";
		echo "<td>" . $row['guardian_ssn'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
if ($in0 == 'location'){
	echo "<table border='1'>
	<tr>
	<th>deptNum</th>
	<th>location</th>
	</tr>";
	while ($row = $stmt->fetch()){
		echo "<tr>";
		echo "<td>" . $row['deptNum'] . "</td>";
		echo "<td>" . $row['location'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
if ($in0 == 'project'){
	echo "<table border='1'>
	<tr>
	<th>projName</th>
	<th>projNum</th>
	<th>projDesc</th>
	</tr>";
	while ($row = $stmt->fetch()){
		echo "<tr>";
		echo "<td>" . $row['projName'] . "</td>";
		echo "<td>" . $row['projNum'] . "</td>";
		echo "<td>" . $row['projDesc'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>