<?php
/**
* Convert date to Jalali Date String
* 
* Note: You need install and enable intl extension. (that seems not work in Windows yet)
**/
function toJalali ($date)
{
	$fmt = new IntlDateFormatter("fa_IR@calendar=persian", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Tehran', IntlDateFormatter::TRADITIONAL);
	return $fmt->format($date);
}
