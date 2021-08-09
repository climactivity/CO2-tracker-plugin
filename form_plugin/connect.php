<?php
	$he = $_POST['he']; // households
	$tt = $_POST['tt']; // transports
	$food = $_POST['food'];
	$mc = $_POST['mc']; // Miscellaneous Comsumption
	$pc = $_POST['pc']; // Public Consumption
	$month = $_POST['month'];
	$year = $_POST['year'];


	$conn = new mysqli('localhost','root','','c4564aps5'); // for dev commection will be chnaged
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into tracking(he, tt, food, mc, pc, month, year) values(?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("dddddii", $he, $tt, $food, $mc, $pc, $month, $year);
		$execval = $stmt->execute();
		$query1= "insert into tracking (user_id) select ID from wp_users"; //code should be changed from here
		$query2 = "SELECT * FROM tracking";
		$result1 = mysqli_query($conn, $query1);
		$result2 = mysqli_query($conn, $query2);


		$chart_data = '';
		while($row = mysqli_fetch_array($result2))
		{
		 $chart_data .= "{ he:".$row["he"].", tt:".$row["tt"].", food:".$row["food"].",mc:".$row["mc"].", pc:".$row["pc"].", month:'M:'+'".$row["month"]."' + '/Y:'+ '".$row["year"]."'}, ";
		}
		$chart_data = substr($chart_data, 0, -2);
		}

		
?>


<!DOCTYPE html>
<html>
 <head>
  <title>chart with PHP & Mysql</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  
 </head>
 <body>
  <br /><br />
  <div class="container" align="center" style="width:900px;">
   <h2 align="center"><Tracking Chart</h2>
   <h3 align="center">Your CO2 Tracking</h3>   
   <br /><br />
   <div id="chart" align="center"></div>
  </div>
 </body>
</html>

<script>

Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'month',
 ykeys:['he', 'tt', 'food', 'mc', 'pc'],
 labels:['Households', 'Transport', 'Food', 'Miscellaneous', 'Public','Date'],
 hideHover:'auto',
 stacked:true
});
</script>
