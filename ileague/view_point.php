<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Point Table</title>
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
$s = mysqli_real_escape_string($link, $_REQUEST['s']);
echo "<h3>The Point Table for Season ".$s." is:</h3>";

$res=mysqli_query($link,"SELECT * FROM points WHERE season = '$s' ORDER BY points DESC");
if (mysqli_num_rows($res) > 0) 
{
    echo "<table class='w3-table-all w3-hoverable'>
    <thead>
    	<tr class='w3-light-grey'>
    		<th>Team Name</th>
    		<th>Points</th>  		
    	</tr>
    </thead>";
    $c=0;
    // output data of each row
    while($row = mysqli_fetch_array($res)) 
    {
		if($c==0)
		{
        	echo "<tr class='w3-green'>";
		}
		if($c==1)
		{
        	echo "<tr class='w3-light-green'>";
		}
		if($c==2)
		{
        	echo "<tr class='w3-lime'>";
		}
        echo "
        		<td>".$row["team"]."</td>
        		<td>".$row["points"]."</td>
        	</tr>";
        $c=$c+1;
    }
    echo "</table>";
} 
else 
{
    echo "No Results Found.";
}

// close connection
mysqli_close($link);
?>
<br><a href="index.php">Go Back</a>
