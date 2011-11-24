<?php
/**
* Convert date to Jalali Date String
**/
function toJalali ($date)
{
	$fmt = new IntlDateFormatter("fa_IR@calendar=persian", IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Tehran', IntlDateFormatter::TRADITIONAL);
	return $fmt->format($date);
}
