<!DOCTYPE html>
<html>
	<head>
		<title>MySQL Query Tester</title>
		<link href="query.css" rel="stylesheet">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="query.js"></script>
	</head>
	<body>
		<center><h1>CSE 154 Query Tester</h1></center>
		<form id="queryform" action="" method="POST">
			<div id="database">
				<strong style="float: left">Database:</strong>
				<label ><input type="radio" name="database" id="database_world" value="world" onclick="makevisible()"></input> world </label>
				<label ><input type="radio" name="database" id="database_simpsons" value="simpsons" onclick="makevisible()"></input> simpsons </label>
				<label ><input type="radio" name="database" id="database_imdb_small" value="imdb_small" onclick="makevisible()"></input> imdb_small </label>
				<span id="other">
					<label class="other"><input type="radio" name="database" id="database_other" value="other"  onclick="makevisible()"></input> other: </label>
					<input type="text" name="database_other_name" id="database_other_name" size="10" value=""></input></span>
			</div>
			<div id="authentication">
				<!------><label ><strong >Username:</strong><input type="text" name="username" id="username" size="16" maxlength="12" placeholder="MySQL username" value="" required pattern="^[\w]{1,12}$" tabindex="2"></input></label>
				<!------><label ><strong >MySQL password:</strong><input type="password" name="password" id="password" size="16" maxlength="24" placeholder="MySQL password" value="" tabindex="3"></input></label>
				<aside id="note">
					<i>(for the full imdb database, your personal MySQL password should have been emailed to you)</i></aside>
			</div>


			<div id="pdo">
				<strong style="font-weight: normal;">PHP code for a PDO connection to this database:</strong> <aside>
					<i>(select for password)</i>
				</aside><br/>
				<code>$db = new PDO("mysql:dbname=<span id="pdo_database"></span>;host=localhost;charset=utf8", "<span id="pdo_username"></span>", "<span id="pdo_password"></span>");</code><br/>
			</div>

			<div id="query">
				<strong >SQL query:</strong>								<div class="textarea">
					<textarea name="query" rows="7" cols="65" placeholder="SELECT * FROM languages;" value="" required tabindex="4"></textarea>				</div>
			</div>


			<div id="submit">
				<input id="submitbutton" name="submit" type="submit" value="Submit Query Ctrl+↲"></input>

			</div>
		</form>

		<div id="responsecontainer" align="center">
			<?php
		$database = $_POST['database'];
$conn = mysqli_connect("localhost","root","","$database");
if(isset($_POST['submit'])){
$query = $_POST['query'];
	$result = mysqli_query($conn,$query);
	$fields_num = mysqli_num_fields($result);
	echo "<table border='1' style='margin:20px;'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysqli_fetch_field($result);
    echo "<th>{$field->name}</th>";
}
echo "</tr>\n";
// printing table rows
while($row = mysqli_fetch_row($result))
{
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
        echo "<td>$cell</td>";

    echo "</tr>\n";
}
echo "</table>";
}

mysqli_close($conn);
?>
		</div>

		<fieldset class="legend" id="legend_world" style="display: none;">
	<legend>world:</legend>
	<table class="sqltable">
		<caption>countries</caption>
		<caption style="font-size: smaller;">Other columns:
			<strong>region</strong>,
			<strong>surface_area</strong>,
			<strong>life_expectancy</strong>,
			<strong>gnp_old</strong>,
			<strong>local_name</strong>,
			<strong>government_form</strong>,
			<strong>capital</strong>,
			<strong>code2</strong>
		</caption>
		<tr>
			<th>code</th>
			<th>name</th>
			<th>continent</th>
			<th>independence_year</th>
			<th>population</th>
			<th>gnp</th>
			<th>head_of_state</th>
			<th>...</th>
		</tr>
		<tr>
			<td>AFG</td>
			<td>Afghanistan</td>
			<td>Asia</td>
			<td>1919</td>
			<td>22720000</td>
			<td>5976.0</td>
			<td>Mohammad Omar</td>
			<td>...</td>
		</tr>
		<tr>
			<td>NLD</td>
			<td>Netherlands</td>
			<td>Europe</td>
			<td>1581</td>
			<td>15864000</td>
			<td>371362.0</td>
			<td>Beatrix</td>
			<td>...</td>
		</tr>
		<tr><td colspan="8" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>languages</caption>
		<tr><th>country_code</th><th>language</th><th>official</th><th>percentage</th></tr>
		<tr>
		<td>AFG</td><td>Pashto</td><td>T</td><td>52.4</td></tr>
		<td>NLD</td><td>Dutch</td><td>T</td><td>95.6</td></tr>
		<tr><td colspan="4" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>cities</caption>
		<tr>
			<th>id</th>
			<th>name</th>
			<th>country_code</th>
			<th>district</th>
			<th>population</th>
		</tr>
		<tr><td>3793</td><td>New York</td><td>USA</td><td>New York</td><td>8008278</td></tr>
		<tr><td>1</td><td>Los Angeles</td><td>USA</td><td>California</td><td>3694820</td></tr>
		<tr><td colspan="5" style="text-align: center">...</td></tr>
	</table>
</fieldset>

<fieldset class="legend" id="legend_simpsons" style="display: none;">
	<legend>simpsons:</legend>

	<table class="sqltable">
		<caption>students</caption>
		<tr><th>id</th><th>name</th><th>email</th><th>password</th></tr>
		<tr><td>123</td><td>Bart</td><td>bart@fox.com</td><td>bartman</td></tr>
		<tr><td>456</td><td>Milhouse</td><td>milhouse@fox.com</td><td>fallout</td></tr>
		<tr><td colspan="4" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>grades</caption>

		<tr><th>student_id</th><th>course_id</th><th>grade</th></tr>
		<tr><td>123</td><td>10001</td><td>B-</td></tr>
		<tr><td>404</td><td>10002</td><td>B</td></tr>
		<tr><td colspan="3" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>courses</caption>
		<tr><th>id</th><th>name</th><th>teacher_id</th></tr>
		<tr><td>10001</td><td>Computer Science 142</td><td>1234</td></tr>
		<tr><td>10002</td><td>Computer Science 143</td><td>5678</td></tr>
		<tr><td colspan="3" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>teachers</caption>
		<tr><th>id</th><th>name</th></tr>
		<tr><td>1234</td><td>Krabappel</td></tr>
		<tr><td>5678</td><td>Hoover</td></tr>
		<tr><td colspan="2" style="text-align: center">...</td></tr>
	</table>
</fieldset>

<fieldset class="legend" id="legend_imdb_small" style="display: none;">
	<legend>imdb_small and imdb:</legend>

	<table class="sqltable">
		<caption>movies</caption>
		<tr><th>id</th><th>name</th><th>year</th><th>rank</th></tr>
		<tr><td>112290</td><td>Fight Club</td><td>1999</td><td>8.5</td></tr>
		<tr><td>209658</td><td>Meet the Parents</td><td>2000</td><td>7</td></tr>
		<tr><td>210511</td><td>Memento</td><td>2000</td><td>8.7</td></tr>
		<tr><td colspan="4" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>roles</caption>
		<tr><th>actor_id</th><th>movie_id</th><th>role</th></tr>
		<tr><td>433259</td><td>313398</td><td>Capt. James T. Kirk</td></tr>
		<tr><td>433259</td><td>407323</td><td>Sgt. T.J. Hooker</td></tr>
		<tr><td>797926</td><td>342189</td><td>Herself</td></tr>
		<tr><td colspan="3" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>actors</caption>
		<tr><th>id</th><th>first_name</th><th>last_name</th><th>gender</th><th>film_count</th></tr>
		<tr><td>433259</td><td>William</td><td>Shatner</td><td>M</td><td>162</td></tr>
		<tr><td>797926</td><td>Britney</td><td>Spears</td><td>F</td><td>65</td></tr>
		<tr><td>831289</td><td>Sigourney</td><td>Weaver</td><td>F</td><td>72</td></tr>
		<tr><td colspan="5" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>movies_directors</caption>
		<tr><th>director_id</th><th>movie_id</th></tr>
		<tr><td>24758</td><td>112290</td></tr>
		<tr><td>66965</td><td>209658</td></tr>
		<tr><td>72723</td><td>313398</td></tr>
		<tr><td colspan="2" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>directors</caption>
		<tr><th>id</th><th>first_name</th><th>last_name</th></tr>
		<tr><td>24758</td><td>David</td><td>Fincher</td></tr>
		<tr><td>66965</td><td>Jay</td><td>Roach</td></tr>
		<tr><td>72723</td><td>William</td><td>Shatner</td></tr>
		<tr><td colspan="3" style="text-align: center">...</td></tr>
	</table>

	<table class="sqltable">
		<caption>movies_genres</caption>
		<tr><th>movie_id</th><th>genre</th></tr>
		<tr><td>209658</td><td>Comedy</td></tr>
		<tr><td>313398</td><td>Action</td></tr>
		<tr><td>313398</td><td>Sci-Fi</td></tr>
		<tr><td colspan="2" style="text-align: center">...</td></tr>
	</table>
</fieldset>
<script>
	window.onload=reload;
</script>
	</body>
</html>
