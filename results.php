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
			#content {position:absolute; border-radius:8px; width:1200px; top:50%; left:50%; margin-top:-300px; margin-left:-600px; text-align:center; clear:both; z-index:5}
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
				$con = mysqli_connect("localhost","root","","marinduque");
				session_start();
				
				//Different queries
				if ($_POST['queries'] == 'Submit Query 1') {
					$sql = "SELECT COUNT(DISTINCT main_id) FROM hpq_mem
							WHERE educind = 2 AND jobind = 2 AND regvotind = 1;";
				}
				else if ($_POST['queries'] == 'Submit Query 2') {
					$sql = "SELECT COUNT(DISTINCT main_id) FROM hpq_mem
							WHERE age_yr < 18 AND educal < 41 AND jobind = 1 AND educind = 1;";
				}
				else if ($_POST['queries'] == 'Submit Query 3') {
					$sql = "SELECT hpq_hh.mun, COUNT(hpq_hh.mun)
							FROM hpq_hh JOIN hpq_death ON hpq_hh.id = hpq_death.main_id
							WHERE hpq_death.mdeady!=9 OR hpq_death.mdeady > 12
							GROUP BY hpq_hh.mun;";
				}
				else if ($_POST['queries'] == 'Submit Query 4') {
					$sql = "SELECT hpq_hh.mun, SUM(hpq_mem.mtheftind), SUM(hpq_mem.mrapeind), SUM(hpq_mem.minjurind), SUM(hpq_mem.mcarnapind), SUM(hpq_mem.mcattrustlind)
							FROM hpq_hh JOIN hpq_mem ON hpq_hh.id = hpq_mem.main_id
							WHERE hpq_mem.mcrimeind = 1
							GROUP BY hpq_hh.mun;";
				}
				else if ($_POST['queries'] == 'Submit Query 5') {
					$sql = "SELECT hpq_hh.mun, AVG(hpq_crop.crop_vol)
							FROM hpq_hh INNER JOIN hpq_mem ON hpq_hh.id = hpq_mem.main_id INNER JOIN hpq_crop ON hpq_mem.main_id = hpq_crop.main_id
							WHERE hpq_mem.jobind = 1 AND hpq_hh.cropind = 1
							GROUP BY hpq_hh.mun;";
				}
				else if ($_POST['queries'] == 'Submit Query 6') {
					$sql = "SELECT hpq_hh.mun, AVG(hpq_aquani.aquani_vol)
							FROM hpq_hh INNER JOIN hpq_mem ON hpq_hh.id = hpq_mem.main_id INNER JOIN hpq_aquani ON hpq_mem.main_id = hpq_aquani.main_id
							WHERE hpq_mem.jobind = 1 AND hpq_hh.fishind = 1
							GROUP BY hpq_hh.mun;";
				}
				else if ($_POST['queries'] == 'Submit Query 7') {
					$sql = "SELECT hpq_hh.mun, AVG(hpq_hh.fishincsh), AVG(hpq_hh.fishinknd),AVG(hpq_aquani.aquani_vol), AVG(hpq_hh.cropincsh), AVG(hpq_hh.cropinknd), AVG(hpq_crop.crop_vol), AVG(hpq_hh.pouincsh), AVG(hpq_hh.pouinknd)
							FROM hpq_hh INNER JOIN hpq_mem ON hpq_hh.id = hpq_mem.main_id INNER JOIN hpq_aquani ON hpq_mem.main_id = hpq_aquani.main_id INNER JOIN hpq_crop ON hpq_aquani.main_id = hpq_crop.main_id
							WHERE hpq_mem.jobind = 1 AND (hpq_hh.fishind = 1 OR hpq_hh.cropind = 1 OR hpq_hh.poultind = 1)
							GROUP BY hpq_hh.mun;";
				}
				
				//Execution time in milliseconds
				$exec = microtime(true);
				mysqli_query($con, $sql);
				$exec = microtime(true)-$exec;
				//echo ($msc * 1000) . ' ms';
				
				$result = mysqli_query($con, $sql) or die(mysqli_error());
				
				//Print the column names
				$i = 0;				
				echo '<tr>';
				while ($i < mysqli_num_fields($result)) {
					$field_info = mysqli_fetch_field($result, $i);
					echo '<td>' . $field_info->name . '</td>';
					$i++;
				}
				echo '</tr>';
				
				//Print the data
				while($row = mysqli_fetch_row($result)) {
					echo "<tr>";
					foreach($row as $value) {
						echo "<td>" . $value . "</td>";
					}
					echo "</tr>";
				}
				
				mysqli_close($con);
			?>
		</div>
		</center>
	</body>
</html>