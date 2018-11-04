<?php
$config = 'config.php';
require_once($config);
session_start();
$userQuery->registerUser();
