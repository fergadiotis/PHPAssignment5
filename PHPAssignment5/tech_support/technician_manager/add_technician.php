<?php
session_start();
require_once('../model/database.php'); 

// Getting data from the form
$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING); 
$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING); 
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

// Validating the inputs
if ($firstName == null || $lastName == null || $email == null || $phone == null || $password == null) {
    $_SESSION['error'] = 'Invalid data. Please make sure all fields are filled.'; 
    header("Location: ../errors/error.php"); 
    die(); 
}

$queryCheck = "SELECT COUNT(*) FROM technicians WHERE email = :email"; 
$statementCheck = $db->prepare($queryCheck); 
$statementCheck->bindValue(':email', $email); 
$statementCheck->execute(); 
$emailExists = $statementCheck->fetchColumn(); 
$statementCheck->closeCursor(); 

if ($emailExists) {
    $_SESSION['error'] = 'Email already exists. Please use a different email.'; 
    header("Location: ../errors/error.php"); 
    die(); 
}

$query = "INSERT INTO technicians (firstName, lastName, email, phone, password) VALUES (:firstName, :lastName, :email, :phone, :password)"; // Query to insert new technician
$statement = $db->prepare($query);
$statement->bindValue(':firstName', $firstName); 
$statement->bindValue(':lastName', $lastName);
$statement->bindValue(':email', $email);
$statement->bindValue(':phone', $phone);
$statement->bindValue(':password', $password);
$statement->execute(); 
$statement->closeCursor(); 

// Confirmation message
$_SESSION['name'] = $firstName . ' ' . $lastName; 
header("Location: confirmation.php"); 
die(); 
?>