<?php
function get_customers_by_last_name($last_name)
{
    global $db;
    $query = 'SELECT * FROM customers
              WHERE lastName LIKE :last_name
              ORDER BY lastName';
    $statement = $db->prepare($query);
    $statement->bindValue(':last_name', $last_name . '%');
    $statement->execute();
    $customers = $statement->fetchAll();
    $statement->closeCursor();
    return $customers;
}

function get_customer($customer_id)
{
    global $db;
    $query = 'SELECT * FROM customers
              WHERE customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

//Function add customer
function add_customer($customer)
{
    global $db;
    $query = 'INSERT INTO customers
                 (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password)
              VALUES
                 (:firstName, :lastName, :address, :city, :state, :postalCode, :countryCode, :phone, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $customer['firstName']);
    $statement->bindValue(':lastName', $customer['lastName']);
    $statement->bindValue(':address', $customer['address']);
    $statement->bindValue(':city', $customer['city']);
    $statement->bindValue(':state', $customer['state']);
    $statement->bindValue(':postalCode', $customer['postalCode']);
    $statement->bindValue(':countryCode', $customer['countryCode']);
    $statement->bindValue(':phone', $customer['phone']);
    $statement->bindValue(':email', $customer['email']);
    $statement->bindValue(':password', password_hash($customer['password'], PASSWORD_DEFAULT));
    $statement->execute();
    $statement->closeCursor();
}

// Function to get customers by last name
function get_customers_by_lastname($lastName) {
    global $db;
    $query = 'SELECT * FROM customers WHERE lastName = :lastName';
    $statement = $db->prepare($query);
    $statement->bindValue(':lastName', $lastName);
    $statement->execute();
    $customers = $statement->fetchAll();
    $statement->closeCursor();
    return $customers;
}

// Function to get customer by ID
function get_customer_by_id($customerID) {
    global $db;
    $query = 'SELECT * FROM customers WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

// Function to update customer information
function update_customer($customer)
{
    global $db;
    $query = 'UPDATE customers
              SET firstName = :firstName,
                  lastName = :lastName,
                  address = :address,
                  city = :city,
                  state = :state,
                  postalCode = :postalCode,
                  countryCode = :countryCode,
                  phone = :phone,
                  email = :email
              WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customer['customerID']);
    $statement->bindValue(':firstName', $customer['firstName']);
    $statement->bindValue(':lastName', $customer['lastName']);
    $statement->bindValue(':address', $customer['address']);
    $statement->bindValue(':city', $customer['city']);
    $statement->bindValue(':state', $customer['state']);
    $statement->bindValue(':postalCode', $customer['postalCode']);
    $statement->bindValue(':countryCode', $customer['countryCode']);
    $statement->bindValue(':phone', $customer['phone']);
    $statement->bindValue(':email', $customer['email']);
    $statement->execute();
    $statement->closeCursor();

    if (!empty($customer['password'])) {
        $query = 'UPDATE customers
                  SET password = :password
                  WHERE customerID = :customerID';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customer['customerID']);
        $statement->bindValue(':password', password_hash($customer['password'], PASSWORD_DEFAULT));
        $statement->execute();
        $statement->closeCursor();
    }
}

function validate_customer($customer)
{
    $errors = array();

    //Validation rules here
    if (empty($customer['firstName'])) {
        $errors[] = "First name is required.";
    }
    if (empty($customer['lastName'])) {
        $errors[] = "Last name is required.";
    }
    if (empty($customer['email'])) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($customer['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    return $errors;
}
?>