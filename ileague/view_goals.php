<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Goal Comparision</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/w3.css" rel="stylesheet">

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
$seasons = mysqli_real_escape_string($link, $_REQUEST['seasons']);
echo "<script> var s=".$seasons."</script>";
//$res=mysqli_query($link,"SELECT YEAR(m_date),AVG(h_goals)+AVG(a_goals) FROM matches GROUP BY YEAR(m_date) ORDER BY YEAR(m_date)");
mysqli_close($link);
?>

	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <script type="text/javascript">
      // Load the Visualization API and the line package.
      google.charts.load('current', {'packages':['bar']});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
  
    function drawChart() {
  
        $.ajax({
        type: 'POST',
        url: 'getdata.php',
          
        success: function (data1) {
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
  
      data.addColumn('string', 'Season');
      data.addColumn('number', 'Avg Goals per Match');
        
      var jsonData = $.parseJSON(data1);//window.alert(s); window.alert(jsonData.length);

		//Conditions so that Requested number of seasons are displayed
		if(s>jsonData.length||s==0)
			s=jsonData.length;	
     	//window.alert(s);
      for (var i = 0; i < s; i++) {
            data.addRow([jsonData[i].season, parseInt(jsonData[i].average)]);
      }
      var options = {
        chart: {
          title: 'Comparative Analysis of Goals per match'
        }
      };
      var chart = new google.charts.Bar(document.getElementById('chart_div'));
      chart.draw(data, options);
       }
     });
    }
  </script>
</head>
<body>
	<?php	
	echo "<h3>The Details of ";
	if($seasons=="3")
	{
		echo "last 3 seasons are:</h3>";
	}
	elseif($seasons=="5")
	{
		echo "last 5 seasons are:</h3>";
	}
	elseif($seasons=="0")
	{
		echo "all seasons in record are:</h3>";
	}
	?>
	<div id="chart_div" style="width: 800px; height: 500px;"></div>
    <br><a href="index.php">Go Back</a>
</body>

</html>

