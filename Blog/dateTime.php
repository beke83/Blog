<?php
date_default_timezone_set("Africa/Lagos");
$CurrentTime = time();
$DateTime=strftime( "%Y-%m-%d %H:%M:%S",$CurrentTime);
echo $DateTime;
?>