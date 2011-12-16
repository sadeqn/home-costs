<?php
	require_once ('auth.php');
	if (defined("AUTHCOMPLETE"))
		include ("dispatch.php");
	else
		include ("noaccess.php");
