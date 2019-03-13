<?php
        $temp=mysqli_connect("localhost", "root", "","i_league");   		
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Request Reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/w3.css" rel="stylesheet">
<style>
body {font-family: Arial;}

/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

input[type=reset] {
    background-color: #ff3300;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=reset]:hover {
    background-color: #e62e00;
}
.container{
	padding: 25px;

}
</style>
</head>

<body>
<!--HTML Form -->
<div class="container">

<h2>Request Reports from the I-League Database.</h2>
<a href="insert_main.php">Click Here to Insert into Database</a>
	<div class="tab">
	  <button class="tablinks" onclick="openForm(event, 'Match')">Match Report</button>
	  <button class="tablinks" onclick="openForm(event, 'Goal')">Goal Report</button>
	  <button class="tablinks" onclick="openForm(event, 'Point')">Point Report</button>
	  <button class="tablinks" onclick="openForm(event, 'Player')">Team Details</button>
	</div>

	<div id="Match" class="tabcontent">
	
	  <p>So you want all the details of the matches played between 2 dates? 
	  Pick up the Dates below in order to get the result(or don't).
	  Dates are optional.</p>
	  <form action="view_match.php" method="post">
		<p>
        	<label for="End">From:</label>
        	<input type="date" name="from" id="Start" min="2007-11-24">
    	</p>
		<p>
        	<label for="End">To:</label>
        	<input type="date" name="to" id="End" min="2007-11-24">
    	</p>
		<input class="submit" type="submit" value="Submit">
    	<input type="reset">
	  </form>
  
	
	</div>

	<div id="Goal" class="tabcontent">
	  <p>To view Comparative Analysis of the Average number of goals scored per Season, select the corresponding button.</p>
	  <form action="view_goals.php" method="post">	
	  	<input type="radio" name="seasons" value="3"> Last 3 Seasons<br>
  		<input type="radio" name="seasons" value="5"> Last 5 Seasons<br>
  		<input type="radio" name="seasons" value="0" checked> All <br>
	  	<input class="submit" type="submit" value="Compare Average Goals">
  	  </form>
	</div>

	<div id="Point" class="tabcontent">
	  <p>To view the Points Table for a Season, please select the Season</p>
	  <form action="view_point.php" method="post">
		<p>
			<label for="Season">Season:</label>
       		<select name="s" id="Season">
			<?php
           		$res1=mysqli_query($temp,"SELECT season FROM points GROUP BY season");
           		while($row1=mysqli_fetch_array($res1))
           		{
			?>
			<option value="<?php echo $row1[0]?>"><?php echo $row1["0"];?></option>
			<?php
        	   	}
        	?>
        	</select>
		</p>
		<input class="submit" type="submit" value="Submit">
    	<input type="reset">
	  </form>
	
	</div>

	<div id="Player" class="tabcontent">
		<p>To view the details of a team, select the team.</p>
		<form action="view_team.php" method="post">
		<p>
			<label for="team">Team:</label>
       		<select name="team" id="team">
			<?php
           		$res2=mysqli_query($temp,"SELECT name FROM team ORDER BY name");
           		while($row2=mysqli_fetch_array($res2))
           		{
			?>
			<option value="<?php echo $row2[0]?>"><?php echo $row2["0"];?></option>
			<?php
        	   	}
        	?>
        	</select>
		</p>
		<input class="submit" type="submit" value="Submit">
    	<input type="reset">
		</form>
	</div>
</div>

<script>
function openForm(evt, formName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(formName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
</body>
</html>
