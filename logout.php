<?php require_once('site-config.php'); ?>
<?php session_start(); ?>
<?php session_destroy(); ?>
<?php header('Location: '.SITE_DASHBOARD); ?>