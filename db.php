<?php
include_once ("config/vars.php");
include_once ("jalali.php");
function getCategoryById($id)
{
	global $dbUserName,$dbPassword,$dbName;
	$id*=1;
	$mysqli = new mysqli("localhost", "$dbUserName","$dbPassword", "$dbName");
	$mysqli->query("set names utf8 collate utf8_persian_ci");
	$resultSet = $mysqli->query("SELECT * FROM category where id=$id");
	if (isset($resultSet))
	{
		return $resultSet->fetch_object();
	}
	else
	{
		return false;
	}

}
function getCategories ()
{
	global $dbUserName,$dbPassword,$dbName;
	$res=array();
	/* select all rows */
	$mysqli = new mysqli("localhost", "$dbUserName","$dbPassword", "$dbName");
	$mysqli->query("set names utf8 collate utf8_persian_ci");
	$resultSet = $mysqli->query("SELECT * FROM vcategorycost order by id<>1, name");
//	print_r($resultSet);	return array();
	while($row = $resultSet->fetch_object())
	{
		$res[]=$row;
	}
	return $res;
}
function addCost ($categoryID,$amount,$note='')
{
	global $dbUserName,$dbPassword,$dbName;
	$categoryID *= 1;
	$amount	*= 1;

	$mysqli = new mysqli("localhost", "$dbUserName","$dbPassword", "$dbName");
	$mysqli->query("set names utf8 collation utf8_persian_ci");
	$mysqli->query ("insert into cost (category,amount,note) values ($categoryID,$amount,'$note');");
	
}
function getCategoryList ($justInUse=false)
{
	global $dbUserName,$dbPassword,$dbName;

	$mysqli = new mysqli("localhost", "$dbUserName","$dbPassword", "$dbName");
	$mysqli->query("set names utf8 collation utf8_persian_ci");
	if ($justInUse)
		$resultSet=$mysqli->query("select * from category where id in (select distinct category from cost");
	else
		$resultSet=$mysqli->query("select * from category");

	while($row = $resultSet->fetch_object())
	{
		$res[]=$row;
	}
	return $res;
}
function getCostList ($categoryID='')
{

	global $dbUserName,$dbPassword,$dbName;
	if ($categoryID!='')
		$categoryID*=1;

	$mysqli = new mysqli("localhost", "$dbUserName","$dbPassword", "$dbName");
	$mysqli->query("set names utf8 collation utf8_persian_ci");

	if ($categoryID!='')
		$res=$mysqli->query("select * from cost c where category=$categoryID order by `when` desc");
	else
		$res=$mysqli->query("select * from cost c order by `when` desc");

	$rowid=0;
	while($row = $resultSet->fetch_object())
	{
		$row->when=toJalali($row->when);
		$row->recno= ++$rowid;
		$res[]=$row;
	}
	return $res;
}

function checkUserPassword($user,$password)
{
	global $dbUserName,$dbPassword,$dbName;
	$md5password=md5($password);
	$user=mb_strtolower($user);

	$mysqli = new mysqli("localhost", "$dbUserName","$dbPassword", "$dbName");
	$mysqli->query("set names utf8 collate utf8_persian_ci");
	$user=$mysqli->real_escape_string($user);
	$resultSet = $mysqli->query("SELECT * FROM user where `Username`='$user' and `Password`='$md5password'");
	if (isset($resultSet))
	{
		return $resultSet->fetch_object();
	}
	else
	{
		return false;
	}
}
