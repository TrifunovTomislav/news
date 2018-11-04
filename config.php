<?php
$filesArray = array('db.php','userQuerys.php','newsQuerys.php');
if(in_array('db.php',$filesArray)){
	require_once('db.php');
}
if(in_array('userQuerys.php',$filesArray)){
	require_once('userQuerys.php');
}
if(in_array('newsQuerys.php',$filesArray)){
	require_once('newsQuerys.php');
}