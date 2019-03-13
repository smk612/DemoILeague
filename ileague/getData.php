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

$res=mysqli_query($link,"SELECT YEAR(m_date) AS season,AVG(h_goals)+AVG(a_goals) AS average FROM matches GROUP BY YEAR(m_date) ORDER BY YEAR(m_date)");

$records = array();

//Retrive the records and add it to the array
while($row  = mysqli_fetch_assoc($res))
{
	$records[] = $row;
}
//Converting to json type data before printing
print(json_encode($records));
mysqli_close($link);
?>
