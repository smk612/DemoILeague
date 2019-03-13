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
$name = mysqli_real_escape_string($link, $_REQUEST['t_name']);
$coach = mysqli_real_escape_string($link, $_REQUEST['coach']);
$hmecty = mysqli_real_escape_string($link, $_REQUEST['hmecty']);
$cid = mysqli_real_escape_string($link, $_REQUEST['cid']);

// attempt insert query execution
$res=mysqli_query($link,"SELECT * FROM PLAYS_FOR WHERE p_id = '$cid'");
if(mysqli_num_rows($res) == 0)
{
	if($cid!=0)
	{
		$sql = "INSERT INTO team (name, coach, home_city, captain_id) VALUES ('$name', '$coach', '$hmecty','$cid')";
	}
	else
	{
		$sql = "INSERT INTO team (name, coach, home_city) VALUES ('$name', '$coach', '$hmecty')";
	}
	if(mysqli_query($link, $sql)){
	    echo '<script language="javascript">';
		echo 'alert("Records added successfully into table team.")';
		echo '</script>';  	   
	} else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);$err=1;
	}
	if($cid!=0)
	{
		$sql1 = "INSERT INTO plays_for (t_name, p_id) VALUES ('$name', '$cid')";
		if(mysqli_query($link, $sql1))
		{
    		echo '<script language="javascript">';
			echo 'alert("Records added successfully in table plays_for.")';
			echo '</script>'; 
		} 
		else
		{
    		echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);$err=1;
		}
	}
}
else
{
	echo '<script language="javascript">';
	echo 'alert("The person you chose as captain plays for another team.")';
	echo '</script>';  
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
