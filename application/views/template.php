<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../style/style.css">
	<link rel="stylesheet" href="../../style/divs.css"> 
	<link rel="stylesheet" href="../../style/form.css"> 
	<link rel="stylesheet" href="../../style/ports.css"> 
	<link rel="stylesheet" href="../../style/temperature.css">
	<link rel="stylesheet" href="../../style/camera.css">
	<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />
	<script src="../../jquery/jquery-1.8.2.min.js"></script>
	<script src="../../jquery/amcharts.js"></script>
</head>
<body>

<!--- <div id="window" class="container_12"> --->

 <!--- First row for Partner links and search--------------------------------->
  <div id="top_menu_admin">
   <?= $top_menu_admin ?>
  </div> 					      <!-- End div top_menu -->
 <!------End of first row ---------------------------------------------------->

 <!---- Fourth row for main screen ------------------------------------------->
  <div id="content">
   <?= $content ?>
  </div>					       <!-- End div content -->
 <!------- End of fourth row ------------------------------------------------->

 <!---- Fifth row for footer ------------------------------------------------->
  <div id="footer">
   <?= $footer ?>
  </div>					       <!-- End div footer -->
 <!------- End of fifth row ------------------------------------------------->

<!--- </div> <!--End div window -->


</body>
</html>
