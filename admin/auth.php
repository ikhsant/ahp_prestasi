<?php 

session_start();

// cek sesi role
if (!$_SESSION['role']) {
	header('Location: login.php');
}