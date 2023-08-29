<?php
require 'rb/rb-mysql.php';
session_start();
if (!isset($_SESSION['role']))
    $_SESSION['role'] = 1;
R::setup('mysql:host=127.0.0.1;dbname=app_problems', 'root', 'root');
ini_set('display_errors', 1);
require_once 'application/web.php';
R::close();