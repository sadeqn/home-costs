<?php
include_once('db.php');

// Check User
if (isset($_SERVER['PHP_AUTH_USER']))
		$username = $_SERVER['PHP_AUTH_USER'];
	else
		$username = '';

if (isset($_SERVER['PHP_AUTH_PW']))
		$passwd = $_SERVER['PHP_AUTH_PW'];
	else
		$passwd = '';

$user=checkUserPassword($username,$passwd);

$needlogin = (false==$user) || (isset($_GET['forcelogin']) );
// If Need login

if ( $needlogin ) {
    header('WWW-Authenticate: Basic realm="Home Costs"');
    header('HTTP/1.0 401 Unauthorized');
?>
You need to login before use Home Costs system

<?php
    exit;
} else if (isset($_GET['forcelogin'])) {
	header('Location: ./');
	exit;
}

// It is ok to use system
include 'main.php';
