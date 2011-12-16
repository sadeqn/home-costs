<?php
	if (!defined("AUTHCOMPLETE")) exit;
	ob_start();
	include_once('jalali.php');
	include_once('db.php');
	if (!isset($_GET['cid']))
	{
		include ("header.php");
		// No category is selected!
		// Show it!
		$categories = getCategories();
		foreach ($categories as $category) 
		{
			echo "\t<li><a href=\"?cid=",$category->id,"\">",$category->name,'</a> (',$category->amount,")</li> \n";
		}
		include ("footer.php");
	}
       	elseif (!isset($_POST['am']))
	{
		include ("header.php");
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
		include ("footer.php");
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
