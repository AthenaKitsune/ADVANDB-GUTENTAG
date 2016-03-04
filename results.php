<html>
	<head>
		<title>
			Query Results
		</title>
	</head>
	<body>
		<style>
			html {overflow-y:hidden; overflow-x:hidden;}
			body {font-family:verdana; background-image:url("pic/bg3.jpg");}
			#top {position:fixed; top:50%; left:50%; margin-top:-272; margin-left:-272; color:black; z-index:10}
			#content {position:absolute; border-radius:8px; height:300px; width:600px; top:50%; left:50%; margin-top:-150px; margin-left:-300px; text-align:center; clear:both; z-index:5}
			#end {position:absolute; text-align:center; padding-top:5px; padding-bottom:5px; color:white; width:100%; height:20px; bottom:0; left:0; background:rgba(192,192,192,0.7);}
			.rainbow {
				background-image: -webkit-gradient( linear, left top, right top, color-stop(0, #f22), color-stop(0.15, #f2f), color-stop(0.3, #22f), color-stop(0.45, #2ff), color-stop(0.6, #2f2),color-stop(0.75, #2f2), color-stop(0.9, #ff2), color-stop(1, #f22) );
				background-image: gradient( linear, left top, right top, color-stop(0, #f22), color-stop(0.15, #f2f), color-stop(0.3, #22f), color-stop(0.45, #2ff), color-stop(0.6, #2f2),color-stop(0.75, #2f2), color-stop(0.9, #ff2), color-stop(1, #f22) );
				color:transparent;
				-webkit-background-clip: text;
				background-clip: text;
			}
		</style>
		<center>
		<div id="content" style="border:1px solid; background:white;">
			<?php
				//Don't forget to change the table!
				$con=mysqli_connect("localhost","root","","marinduque");
				session_start();
				
				//Different queries
				if ($_POST['queries'] == 'query1') {
					echo "QUERY 1";
					$sql = "SELECT COUNT(DISTINCT main_id) FROM hpq_mem
							WHERE educind = 2 AND jobind = 2 AND regvotind = 1;";
				}
				else if ($_POST['queries'] == 'query2') {
					echo "QUERY 2";
					$sql = "SELECT COUNT(DISTINCT main_id) FROM hpq_mem
							WHERE age_yr < 18 AND educal < 41 AND jobind = 1 AND educind = 1;"
				}
				else if ($_POST['queries'] == 'query3') {
					echo "QUERY 3";
				}
				else if ($_POST['queries'] == 'query4') {
					echo "QUERY 4";
				}
				else if ($_POST['queries'] == 'query5') {
					echo "QUERY 5";
				}
				else if ($_POST['queries'] == 'query6') {
				
				}
				else if ($_POST['queries'] == 'query7') {
				
				}
				
				//Execution time in milliseconds
				$exec = microtime(true);
				mysqli_query($sql);
				$exec = microtime(true)-$exec;
				echo ($msc * 1000) . ' ms';
				
				$i = 0;				
				echo '<tr>';
				while ($i < mysqli_num_fields($result)) {
					$meta = mysqli_num_fields($result, $i));
					echo '<td>' . $meta->name . '</td>';
					array_psuh($cols, $meta->name);
					$i++;
				}
				echo '</tr>';
				while ($row = mysqli_fetch_array($result)) {
					echo '<tr>';
					for ($x = 0l $x < count ($cols); $x++) {
						echo '<td>' . $row[$cols[$x]] . '</td>';
					}
					echo '</tr>';
				}
			?>
		</div>
		</center>
	</body>
</html>