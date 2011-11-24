<?php
	ob_start();
	include_once('jalali.php');
?>
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
<?php // i$fmt = new IntlDateFormatter("fa_IR@calendar=persian", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Tehran', IntlDateFormatter::TRADITIONAL); echo "تاریخ: " . $fmt->format(time()) . "\n"; ?>
<?php 
if (!empty($_GET['msg'])) 
{
	?>	<div class="msg"><?=$_GET['msg'];?></div> <?php
}

	include_once('db.php');
	if (!isset($_GET['cid']))
	{
		// No category is selected!
		// Show it!
		$categories = getCategories();
		foreach ($categories as $category) 
		{
			echo "\t<li><a href=\"?cid=",$category->id,"\">",$category->name,'</a> (',$category->amount,")</li> \n";
		}
	}
       	elseif (!isset($_POST['am']))
	{
		// Category selected but not amount 
		// Show amount form + category name
?>
	<form method="POST" action="?cid=<?=$_GET['cid'];?>">
		<h2><?php echo getCategoryById($_GET['cid'])->name;?></h2>
		مبلغ: <input name="am" autofocus="autofocus" type="number" placeholder="به تومان"/> <br />
		شرح: <input name="ds" type="text" placeholder="شرح خرید"> </br />
		<button type="submit" >ثبت</button>
	</form>
	<hr />
	<a href="?">بازگشت</a>
<?php
	} else {
		$msg='';
		$amount=$_POST['am']*1;
		$cid=$_GET['cid']*1;
		$desc=$_POST['ds'];
		if (($cid!=0) && ($amount!=0))
		{
			// insert cost to db
			addCost($cid,$amount,$desc);
			if (!empty($desc))
				$msgdesc="به شرح:<em> $desc </em>";
			else
				$msgdesc="";
			$msg="$amount برای <em>".getCategoryById($_GET['cid'])->name . "</em> $msgdesc ثبت شد";
		}
		header ("Location: ./?cid=$cid&msg=$msg");

	}
?>
</body>
</html>
