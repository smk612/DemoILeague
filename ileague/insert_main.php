<?php
        $temp=mysqli_connect("localhost", "root", "","i_league");   		
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Insert Data</title>
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
<h2>Insert Data In I-League Database.</h2>
<a href="index.php">Click Here to Go Back to Reports</a>
<div class="tab">
  <button class="tablinks" onclick="openForm(event, 'Player')">Player</button>
  <button class="tablinks" onclick="openForm(event, 'Injuries')">Injuries</button>
  <button class="tablinks" onclick="openForm(event, 'meaT')">Team</button>
  <button class="tablinks" onclick="openForm(event, 'Match')" id="defaultOpen">Match</button>
</div>

<div id="Player" class="tabcontent">
	
  <h3>Add New Player</h3>
  <form action="insert_plyr.php" method="post">
    <p>
        <label for="Name">Name:<sup>*</sup></label>
        <input type="text" name="p_name" id="Name" value="" placeholder="Player name">
    </p>
    <p>
        <label for="Position">Position:</label>
        <input type="text" name="pos" id="Position" value="" placeholder="Plays at which position">
    </p>
    <p>
        <label for="Skill">Skill:</label>
        <input type="number" size="2" min="0" name="skill" id="Skill" placeholder="His skill level">
    </p>
    <p>
        <label for="Team">Team:<sup>*</sup></label>
        <select name="team" id="Team">
		<option value="Free Agent">Free Agent</option>
		<?php
           $res1=mysqli_query($temp,"SELECT * FROM TEAM ORDER BY name");
           while($row1=mysqli_fetch_array($res1))
           {
		?>
			<option value="<?php echo $row1[0]?>"><?php echo $row1["0"];?></option>
		<?php
           }
        ?>
        </select>
    </p>
    <p>Labels marked * are required</p>
    <input class="submit" type="submit" value="Submit">
    <input type="reset">
	</form>


	<!--Form for Updating player details-->
	<h3>Transfer Player</h3>
	<form action="update_plyr.php" method="post">
    <p>
        <label for="nPid">Name:<sup>*</sup></label>
        <select name="n_pid" id="nPid">
		<?php
           $res3=mysqli_query($temp,"SELECT * FROM PLAYER ORDER BY name");
           while($row3=mysqli_fetch_array($res3))
           {
		?>
			<option value="<?php echo $row3[0]?>"><?php echo $row3["1"];?></option>
		<?php
           }
        ?>
        </select>
    </p>
    <p>
        <label for="NTeam">New Team:<sup>*</sup></label>
        <select name="nteam" id="nTeam">
		<option value="Free Agent">Free Agent</option>
		<?php
           $res2=mysqli_query($temp,"SELECT * FROM TEAM ORDER BY name");
           while($row2=mysqli_fetch_array($res2))
           {
		?>
			<option value="<?php echo $row2[0]?>"><?php echo $row2["0"];?></option>
		<?php
           }
        ?>
        </select>
    </p>
    <input type="hidden" name="captain" value="no" />
    <input type="checkbox" name="captain" value="yes">Captain<br>
    <p>Labels marked * are required</p>
    <input class="submit" type="submit" value="Submit">
    <input type="reset">
	</form>
	
</div>

<div id="Injuries" class="tabcontent">
  <h3>Add Injury record</h3>
  <form action="insert_inj.php" method="post">
    <p>
        <label for="Pid">Name:<sup>*</sup></label>
        <select name="pid" id="Pid">
		<?php
           $res=mysqli_query($temp,"SELECT * FROM PLAYER ORDER BY name");
           while($row=mysqli_fetch_array($res))
           {
		?>
			<option value="<?php echo $row[0]?>"><?php echo $row["1"];?></option>
		<?php
           }
        ?>
        </select>
    </p>
    <p>
        <label for="Start">Injury Date:<sup>*</sup></label>
        <input type="date" name="start" id="Start" min="2007-11-24">
    </p>
    <p>
        <label for="End">Recovery Date:</label>
        <input type="date" name="end" id="End" min="2007-11-24">
    </p>
    <p>
        <label for="Toi">Type of Injury:</label>
        <input type="text" name="toi" id="Toi" placeholder="What kind of injury?">
    </p>
    <p>Labels marked * are required</p>
    <input class="submit" type="submit" value="Submit">
    <input type="reset">
	</form>
</div>

<div id="meaT" class="tabcontent">
  <h3>Add New Team</h3>
	<form action="insert_team.php" method="post">
  	<p>
        <label for="T_Name">Team Name:<sup>*</sup></label>
        <input type="text" name="t_name" id="T_Name" value="" placeholder="Team name">
    </p>
    <p>
        <label for="Coach">Coach:<sup>*</sup></label>
        <input type="text" name="coach" id="Coach" value="" placeholder="Who coaches it?">
    </p>
    <p>
        <label for="Home">Home City:</label>
        <input type="text" name="hmecty" id="Home" placeholder="Most supporters at.">
    </p>
    <p>
        <label for="Cid">Captain:</label>
        <select name="cid" id="Cid">
        <option value="0">Not Selected</option>
		<?php
           $res2=mysqli_query($temp,"SELECT * FROM PLAYER ORDER BY name");
           while($row2=mysqli_fetch_array($res2))
           {
		?>
			<option value="<?php echo $row2[0]?>"><?php echo $row2["1"];?></option>
		<?php
           }
        ?>
        </select>
    </p>
    <p>Labels marked * are required</p>
    <input class="submit" type="submit" value="Submit">
    <input type="reset">
    </form>
</div>

<div id="Match" class="tabcontent">
	<h3>Add New Match Details</h3>
	<form action="insert_match.php" method="post">
  	<p>
        <label for="M_Date">Match Date:<sup>*</sup></label>
        <input type="date" name="date" id="M_Date" max=
     <?php
         echo date('Y-m-d');
     ?>>
    </p>
    <p>
     	<label for="Venue">Venue:<sup>*</sup></label>
     	<input type="text" name="venue" id="Venue" placeholder="Where did you go to cheer?">
    </p>
    <p>
    	<label for="H_Name">Home Team:<sup>*</sup></label>
    	<select name="t_h" id="H_Name">
		<?php
           $res3=mysqli_query($temp,"SELECT * FROM TEAM ORDER BY name");
           while($row3=mysqli_fetch_array($res3))
           {
		?>
			<option value="<?php echo $row3[0]?>"><?php echo $row3["0"];?></option>
		<?php
           }
        ?>
        </select>

        &nbsp;&nbsp;&nbsp;&nbsp;
        <label for="A_Name">Away Team:<sup>*</sup></label>
    	<select name="t_a" id="A_Name">
		<?php
           $res4=mysqli_query($temp,"SELECT * FROM TEAM ORDER BY name");
           while($row4=mysqli_fetch_array($res4))
           {
		?>
			<option value="<?php echo $row4[0]?>"><?php echo $row4["0"];?></option>
		<?php
           }
        ?>
        </select>
    </p>
	<p>Goals Scored:</p>
    <p>
    	<label for="H_Goals">Home:</label>
    	<input type="number" size="2" min="0" name="h_g" id="H_Goals" value="0">
    	-
    	<label for="A_Goals">Away:</label>
    	<input type="number" size="2" min="0" name="a_g" id="A_Goals" value="0">
    </p>
    <p>
     	<label for="Ref">Referee:<sup>*</sup></label>
     	<input type="text" name="ref" id="Ref" placeholder="Who was the head Ref?">
    </p>
	<p>
		<textarea rows="4" cols="50" name="comment" placeholder="Any extra information?"></textarea>
	</p>
    
    <p>Labels marked * are required</p>
    <input class="submit" type="submit" value="Submit">
    <input type="reset">
    </form>
</div>
</div>

<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
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
