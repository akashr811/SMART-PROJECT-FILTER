<?php
if(!isset($_SESSION))
	session_start();

define("ADMIN", 1);
define("GD", 2);
define("PG", 3);
define("PGDP", "GUIDE");
define("PGRP", "GROUP");

function getBaseUrl()
{
	return "http://".$_SERVER["HTTP_HOST"]."/spf/";
}
function getFolderPath()
{
	return $_SERVER["DOCUMENT_ROOT"]."/spf/";
}
function getDBconn()
{
	$mysqli=new mysqli("localhost", "root", "", "spf");
	return $mysqli;
}
function redirect($url)
{
	if(headers_sent())
	{
		echo "window.location.href=".$url;
	}
	else
		header("Location: ".$url);
	exit(0);
}
function displayMsg()
{
	if(isset($_SESSION["msg"]))
	{
		echo $_SESSION["msg"];
		unset($_SESSION["msg"]);
	}
}
function setMsg($msg, $class)
{
	$_SESSION["msg"]="<div class='alert alert-".$class."'>".$msg."</div>";
}
?>