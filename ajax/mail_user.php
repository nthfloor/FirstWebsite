<?php

//validates the input parameter to ensure that it does not contain special chars
function checkOK($field)
{
if (eregi("\r",$field) || eregi("\n",$field)){
die("Invalid Input!");
}
}



?>