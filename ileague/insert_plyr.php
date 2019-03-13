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
$name = mysqli_real_escape_string($link, $_REQUEST['p_name']);
$pos = mysqli_real_escape_string($link, $_REQUEST['pos']);
$skill = mysqli_real_escape_string($link, $_REQUEST['skill']);
$team = mysqli_real_escape_string($link, $_REQUEST['team']);

// attempt insert query execution
$sql = "INSERT INTO player (name, position, skill_level) VALUES ('$name', '$pos', '$skill')";
if(mysqli_query($link, $sql)){
   	echo '<script language="javascript">';
	echo 'alert("Records added successfully into table player.")';
	echo '</script>'; 
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);$err=1;
}

if($team != "Free Agent")
{
	$sql1 = "INSERT INTO plays_for (t_name, p_id) VALUES ('$team', LAST_INSERT_ID())";
	if(mysqli_query($link, $sql1)){
    	echo '<script language="javascript">';
		echo 'alert("Records added successfully into table plays_for.")';
		echo '</script>';
	} else{
    echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);$err=1;
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
