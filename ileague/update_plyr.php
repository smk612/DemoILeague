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
$pid = mysqli_real_escape_string($link, $_REQUEST['n_pid']);
$team = mysqli_real_escape_string($link, $_REQUEST['nteam']);
$flag = mysqli_real_escape_string($link, $_REQUEST['captain']);
// attempt insert query execution
$res = mysqli_query($link,"SELECT * FROM team WHERE captain_id = '$pid'");
if(mysqli_num_rows($res) != 0)
{
	$sql2 = "UPDATE team SET captain_id = NULL WHERE captain_id = '$pid'";
	if(mysqli_query($link, $sql2)){
    	echo '<script language="javascript">';
		echo 'alert("Player was Removed from Captaincy.")';
		echo '</script>';
	} else{
    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);$err=1;
	}
}
if($flag=='yes' and $team != "Free Agent")
{
	$sql3 = "UPDATE team SET captain_id = '$pid' WHERE name = '$team'";
	if(mysqli_query($link, $sql3)){
    	echo '<script language="javascript">';
		echo 'alert("Player Promoted to Captain.")';
		echo '</script>';
	} else{
    echo "ERROR: Could not able to execute $sql3. " . mysqli_error($link);$err=1;
	}
}

if($team != "Free Agent")
{
	$res=mysqli_query($link,"SELECT * FROM plays_for WHERE p_id = '$pid'");
	if(mysqli_num_rows($res) > 0)
	{
		$sql1 = "UPDATE plays_for SET t_name = '$team' WHERE p_id='$pid'";
	}
	else
	{
		$sql1 = "INSERT INTO plays_for (t_name, p_id) VALUES ('$team','$pid')";
	}
	if(mysqli_query($link, $sql1)){
    	echo '<script language="javascript">';
		echo 'alert("Player Transfered Successfully.")';
		echo '</script>';
	} else{
    echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);$err=1;
	}
}
else
{
	$sql = "DELETE FROM plays_for WHERE p_id='$pid' ";
	if(mysqli_query($link, $sql)){
    	echo '<script language="javascript">';
		echo 'alert("Player is a Free Elf.")';
		echo '</script>';
	} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link); $err=1;
}
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
