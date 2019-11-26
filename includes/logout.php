<?php
require_once '../admin/functions.php';

session_start();

unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['user_role']);

redirect('../');

