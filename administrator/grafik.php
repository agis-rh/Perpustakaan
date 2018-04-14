<html>
<head>
<script type="text/javascript" src="JS/jquery-1.4.js"></script>
<script type="text/javascript" src="JS/jquery.fusioncharts.js"></script>
</head>
<body>
	<center>

	<table id="myHTMLTable" width="600" border="0" align="center" cellpadding="5">
	<tr bgcolor="#FF9900"> <th>Bulan</th> <th>Total Peminjaman</th></tr>
<?php
      include "fungsi_indotgl.php";

      $result = mysql_query("SELECT bulan, SUM(peminjaman) as total FROM grafik GROUP BY bulan");
      while ($data = mysql_fetch_array($result)) {
        $bulan=konversi_bulan($data[bulan]);
	       echo "<tr bgcolor='#D5F35B'>
              <td>$bulan</td>
              <td align='center'>$data[total]</td>
              </tr>";
      }
?>

	</table>
	<script type="text/javascript">
	$('#myHTMLTable').insertFusionCharts({
		swfPath: "Charts/",
		type: "MSColumn3D",
		data: "#myHTMLTable",
 	      width: "800",
		height: "500",
		dataFormat: "HTMLTable"
	});
	</script>
    
	</center>
</body>
</html>
