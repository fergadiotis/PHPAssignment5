<?php
session_start();
require_once('../model/database.php');
require_once('../model/product_db.php');

$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$version = filter_input(INPUT_POST, 'version');
$release_date = filter_input(INPUT_POST, 'date');

if ($code == null || $name == null || $version == null || $release_date == null) {
    $error = "Invalid product data. Check all fields and try again.";
    include('../errors/error.php');
} else {
    try {
        add_product($code, $name, $version, $release_date);
        $_SESSION['product'] = "$name, version $version";
        header("Location: confirmation.php");
        exit();
    } catch (TypeError $e) {
        $error = "A TypeError occurred: " . $e->getMessage();
        include('../errors/error.php');
    } catch (Exception $e) {
        $error = "An error occurred: " . $e->getMessage();
        include('../errors/error.php');
    }
}
?>