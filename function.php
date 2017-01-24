<?php
function emailAvail($email)
{
	$query = mysql_query("SELECT * FROM web_service1 WHERE email = '$email'");
	$countRow = mysql_num_rows($query);
	return ($countRow > 0) ? false : true;
}
