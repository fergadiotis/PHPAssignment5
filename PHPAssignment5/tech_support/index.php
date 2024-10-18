<?php
require('../model/database.php');
require('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'search_customers';
    }
}

switch ($action) {
    case 'search_customers':
        $last_name = filter_input(INPUT_GET, 'last_name');
        if ($last_name === NULL || $last_name === FALSE) {
            $last_name = '';
        }
        $customers = get_customers_by_last_name($last_name);
        include('customer_search.php');
        break;

    case 'select_customer':
        $customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);
        if ($customer_id === NULL || $customer_id === FALSE) {
            $error = "Invalid customer ID.";
            include('../errors/error.php');
        } else {
            $customer = get_customer($customer_id);
            include('customer_add_update.php');
        }
        break;

    case 'display_add_form':
        include('customer_add_update.php');
        break;

    case 'add_customer':
        // Add customer logic here
        $customer = array();
        $customer['firstName'] = filter_input(INPUT_POST, 'firstName');
        $customer['lastName'] = filter_input(INPUT_POST, 'lastName');
        $customer['address'] = filter_input(INPUT_POST, 'address');
        $customer['city'] = filter_input(INPUT_POST, 'city');
        $customer['state'] = filter_input(INPUT_POST, 'state');
        $customer['postalCode'] = filter_input(INPUT_POST, 'postalCode');
        $customer['countryCode'] = filter_input(INPUT_POST, 'countryCode');
        $customer['phone'] = filter_input(INPUT_POST, 'phone');
        $customer['email'] = filter_input(INPUT_POST, 'email');
        $customer['password'] = filter_input(INPUT_POST, 'password');

        // Validate the data
        $errors = validate_customer($customer);
        if (!empty($errors)) {
            include('customer_add_update.php');
        } else {
            add_customer($customer);
            header("Location: .?action=search_customers");
        }
        break;

    case 'update_customer':
        // Update customer logic here
        $customer_id = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
        $customer = array();
        $customer['customerID'] = $customer_id;
        $customer['firstName'] = filter_input(INPUT_POST, 'firstName');
        $customer['lastName'] = filter_input(INPUT_POST, 'lastName');
        $customer['address'] = filter_input(INPUT_POST, 'address');
        $customer['city'] = filter_input(INPUT_POST, 'city');
        $customer['state'] = filter_input(INPUT_POST, 'state');
        $customer['postalCode'] = filter_input(INPUT_POST, 'postalCode');
        $customer['countryCode'] = filter_input(INPUT_POST, 'countryCode');
        $customer['phone'] = filter_input(INPUT_POST, 'phone');
        $customer['email'] = filter_input(INPUT_POST, 'email');
        $customer['password'] = filter_input(INPUT_POST, 'password');

        // Validate the data
        $errors = validate_customer($customer);
        if (!empty($errors)) {
            include('customer_add_update.php');
        } else {
            update_customer($customer);
            header("Location: .?action=search_customers");
        }
        break;

    default:
        $error = "Unknown action: " . $action;
        include('../errors/error.php');
        break;
}
