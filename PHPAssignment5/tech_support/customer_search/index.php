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

if ($action == 'search_customers') {
    $last_name = filter_input(INPUT_GET, 'last_name');
    if ($last_name === NULL || $last_name === FALSE) {
        $last_name = '';
    }
    $customers = get_customers_by_last_name($last_name);
    include('customer_search.php');
} else if ($action == 'display_customer') {
    $customer_id = filter_input(INPUT_GET, 'customer_id', FILTER_VALIDATE_INT);
    if ($customer_id === NULL || $customer_id === FALSE) {
        $error = "Invalid customer ID.";
        include('../errors/error.php');
    } else {
        $customer = get_customer($customer_id);
        include('customer_display.php');
    }
} else if ($action == 'display_add_form') {
    include('customer_add_update.php');
}
