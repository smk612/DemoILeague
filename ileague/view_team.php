<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Team Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/w3.css" rel="stylesheet">
</head>
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "","i_league");
$err=0;
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$team = mysqli_real_escape_string($link, $_REQUEST['team']);
echo "<h3>The Details for ".$team." are:</h3>";
$res1=mysqli_query($link,"SELECT * FROM team WHERE name = '$team'");
$row1=mysqli_fetch_array($res1);
echo "<p>Coach: ".$row1["coach"]." </p>";
echo "<p>Home City: ".$row1["home_city"]." </p>";
$cid=$row1["captain_id"];

$res=mysqli_query($link,"SELECT player.p_id,name, position, skill_level FROM plays_for INNER JOIN player ON plays_for.p_id=player.p_id WHERE t_name = '$team' ORDER BY position ASC");
if (mysqli_num_rows($res) > 0) 
{
    echo "<table class='w3-table-all'>
    <thead>
    	<tr class='w3-light-grey'>
    		<th>Name</th>
    		<th>Position</th>
    		<th>Skill Level</th>   		
    	</tr>
    </thead>";
    // output data of each row
    while($row = mysqli_fetch_array($res)) 
    {
		if($row["p_id"]==$cid)
		{
        	echo "<tr class='w3-deep-orange'>";
		}
		else
		{
        	echo "<tr class='w3-sand'>";
		}
        echo "
        		<td>".$row["name"]."</td>
        		<td>".$row["position"]."</td>
        		<td>".$row["skill_level"]."</td>
        	</tr>";
    }
    echo "</table>";
    echo "<p>Key:<br>Red:Captain</p>";
} 
else 
{
    echo "No Results Found.";
}

// close connection
mysqli_close($link);
?>
<br><a href="index.php">Go Back</a>
