<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "","i_league");
$err=0;
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());$err=1;
}
 
// Escape user inputs for security
$pid = mysqli_real_escape_string($link, $_REQUEST['pid']);
$start = mysqli_real_escape_string($link, $_REQUEST['start']);
$end = mysqli_real_escape_string($link, $_REQUEST['end']);
$toi = mysqli_real_escape_string($link, $_REQUEST['toi']);

// attempt insert query execution
$sql = "INSERT INTO injuries (p_id, i_date, t_o_i, e_date) VALUES ('$pid', '$start', '$toi','$end')";
if(mysqli_query($link, $sql)){
    echo '<script language="javascript">';
	echo 'alert("Records added successfully into table injuries.")';
	echo '</script>';
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);$err=1;
}
 
// close connection
mysqli_close($link);
?>
<br><a href="insert_main.php" id="defaultOpen">Go Back</a>
<script>
	if($err!=1)
	{
		document.getElementById("defaultOpen").click();
	}
</script>
