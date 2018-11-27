<!DOCTYPE html>
<html>
	<CENTER>
		<title>SELECT</title>
		<br>
		<br>
		<br>
		<h2>SELECT FROM LUKE'S DATABASE</h2>

		 <form action="connect.php" method="post"><br><br>
			<br><br><br><br>
			<input type="radio" name="querytype" value="SELECT" checked>
			SELECT
			<input type="text" name="input1"></input>
			FROM
			<input type="text" name="input2"></input>
			<select name="querytype2">
				<option></option>
				<option>WHERE</option>
			</select>
			<input type="text" name="input3"></input>
			<input type="submit" name="enter"></input>
		</form>
	</CENTER>
</html>