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
$date = mysqli_real_escape_string($link, $_REQUEST['date']);
$t_h = mysqli_real_escape_string($link, $_REQUEST['t_h']);
$t_a = mysqli_real_escape_string($link, $_REQUEST['t_a']);
$venue = mysqli_real_escape_string($link, $_REQUEST['venue']);
$h_g = mysqli_real_escape_string($link, $_REQUEST['h_g']);
$a_g = mysqli_real_escape_string($link, $_REQUEST['a_g']);
$ref = mysqli_real_escape_string($link, $_REQUEST['ref']);
$com = mysqli_real_escape_string($link, $_REQUEST['comment']);

// attempt insert query execution
if($t_h!=$t_a)
{
	$sql = "INSERT INTO matches (m_date, t_home, t_away, venue, h_goals, a_goals, m_referee, comment) VALUES ('$date', '$t_h', '$t_a','$venue','$h_g','$a_g','$ref','$com')";
	if(mysqli_query($link, $sql)){
		echo '<script language="javascript">';
		echo 'alert("Records added successfully into table matches.")';
		echo '</script>';
	//if draw
	if($h_g==$a_g)
	{
		//adding for home team
		$res1=mysqli_query($link,"SELECT * FROM POINTS WHERE season = '$date' and team = '$t_h'");
		if(mysqli_num_rows($res1) == 0)
		{
			$sql1 = "INSERT INTO points(season, team, points) VALUES ('$date', '$t_h', 1)";
		}
		else
		{
			$sql1 = "UPDATE points SET points = points + 1 WHERE season = '$date' and team = '$t_h'";
		}
		if(mysqli_query($link, $sql1)){
			echo '<script language="javascript">';
			echo 'alert("Record added succesfully into table points for Home-team draw.")';
			echo '</script>';
		} else{
		    echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);$err=1;
		}
		//adding for away team
		$res2=mysqli_query($link,"SELECT * FROM POINTS WHERE season = '$date' and team = '$t_a'");
		if(mysqli_num_rows($res2) == 0)
		{
			$sql2 = "INSERT INTO points(season, team, points) VALUES ('$date', '$t_a', 1)";
		}
		else
		{
			$sql2 = "UPDATE points SET points = points + 1 WHERE season = '$date' and team = '$t_a'";
		}
		if(mysqli_query($link, $sql2)){
			echo '<script language="javascript">';
			echo 'alert("Record added succesfully into table points for away-team draw.")';
			echo '</script>';
		} else{
		    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);$err=1;
		}
	}
	else
	{
		if($h_g>$a_g)
		{
			$res1=mysqli_query($link,"SELECT * FROM POINTS WHERE season = '$date' and team = '$t_h'");
			if(mysqli_num_rows($res1) == 0)
			{
				$sql1 = "INSERT INTO points(season, team, points) VALUES ('$date', '$t_h', 3)";
			}
			else
			{
				$sql1 = "UPDATE points SET points = points + 3 WHERE season = '$date' and team = '$t_h'";
			}
			if(mysqli_query($link, $sql1)){
				echo '<script language="javascript">';
				echo 'alert("Record added succesfully into table points for Home-team win.")';
				echo '</script>';
			} else{
			    echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);$err=1;
			}
		}	
		else
		{
			$res2=mysqli_query($link,"SELECT * FROM POINTS WHERE season = '$date' and team = '$t_a'");
			if(mysqli_num_rows($res2) == 0)
			{
				$sql2 = "INSERT INTO points(season, team, points) VALUES ('$date', '$t_a', 3)";
			}
			else
			{
				$sql2 = "UPDATE points SET points = points + 3 WHERE season = '$date' and team = '$t_a'";
			}
			if(mysqli_query($link, $sql2)){
				echo '<script language="javascript">';
				echo 'alert("Record added succesfully into table points for away-team win.")';
				echo '</script>';
			} else{
			    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);$err=1;
			}
		}
	}
		}
else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);$err=1;
	}
}
else{
	echo '<script language="javascript">';
	echo 'alert("Both teams are the same. Was this a practise match?")';
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
