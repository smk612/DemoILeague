<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Match Results</title>
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
$from = mysqli_real_escape_string($link, $_REQUEST['from']);
$to = mysqli_real_escape_string($link, $_REQUEST['to']);
echo "<h3>The Match Results ";

if(empty($from) and !empty($to))
{
	$res=mysqli_query($link,"SELECT * FROM matches WHERE m_date <= '$to'");
	echo "upto ".$to;
}
elseif(!empty($from) and empty($to))
{
	$res=mysqli_query($link,"SELECT * FROM matches WHERE m_date >= '$from'");
	echo "from ".$from;
}
elseif(!empty($from) and !empty($to))
{
	$res=mysqli_query($link,"SELECT * FROM matches WHERE m_date >= '$from' AND m_date<='$to'");
	echo "from ".$from. " to ".$to;
}
else
{
	$res=mysqli_query($link,"SELECT * FROM matches");
}
echo " are:</h3>";
if (mysqli_num_rows($res) > 0) 
{
    echo "<table class='w3-table-all'>
    <thead>
    	<tr class='w3-light-grey'>
    		<th>Match Date</th>
    		<th>Home Team</th>
    		<th>Away Team</th>
    		<th>Venue</th>
    		<th>Score</th>
    		<th>Referee</th>
    		<th>Comments</th>    		
    	</tr>
    </thead>";
    // output data of each row
    while($row = mysqli_fetch_array($res)) 
    {
		if($row["h_goals"]>$row["a_goals"])
		{
        	echo "<tr class='w3-green'>";
		}
		if($row["h_goals"]<$row["a_goals"])
		{
        	echo "<tr class='w3-red'>";
		}
		if($row["h_goals"]==$row["a_goals"])
		{
        	echo "<tr class='w3-yellow'>";
		}
        echo "
        		<td>".$row["m_date"]."</td>
        		<td>".$row["t_home"]."</td>
        		<td>".$row["t_away"]."</td>
        		<td>".$row["venue"]."</td>
        		<td>".$row["h_goals"]." : ".$row["a_goals"]."</td>
        		<td>".$row["m_referee"]."</td>
        		<td>".$row["comment"]."</td>
        	</tr>";
    }
    echo "</table>";
    echo "<p>Key:<br>Green:Home Win<br>Red:Away Win<br>Yellow:Draw</p>";
} 
else 
{
    echo "No Results Found.";
}

// close connection
mysqli_close($link);
?>
<br><a href="index.php">Go Back</a>
