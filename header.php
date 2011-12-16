<html>
<head>
	<title>مدیریت خانه</title>
	<STYLE type="text/css">
		body {
			direction:rtl;
			color:#FFF;
			background-color:#000;
		}	
		a {
			color:gold;
			text-decoration:none;
		}
		a:hover {
			color:limegreen;
		}
		input {
			width:3cm;
		}
		.msg {
			color:blue;
		}
		.msg em { color:lightblue; }
	</STYLE>
</head>
<body >
<h1>هزینه‌های خانه</h1>
<?php
	echo toJalali(time());
?>
<hr />
<?php 
if (!empty($_GET['msg'])) 
{
	?>	<div class="msg"><?=$_GET['msg'];?></div> <?php
}

