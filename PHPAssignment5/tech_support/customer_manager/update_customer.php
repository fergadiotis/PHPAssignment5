<?php
// Check if the request method is POST to ensure the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Get the posted data from the form
    $customerID = $_POST['customerID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $countryCode = $_POST['countryCode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the required fields 
    if (empty($customerID) || empty($firstName) || empty($lastName) || empty($email)) {
        echo "Error: Please ensure all required fields are filled out.";
        exit; // Stop further execution if validation fails
    }

    // Connect to the database
    require('../model/database.php'); // Correct path to database connection

    // SQL update query
    $query = "UPDATE customers
              SET firstName = :firstName, lastName = :lastName, address = :address,
                  city = :city, state = :state, postalCode = :postalCode, 
                  countryCode = :countryCode, phone = :phone, email = :email, password = :password
              WHERE customerID = :customerID";

    // Prepare and bind the parameters
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':postalCode', $postalCode);
    $statement->bindValue(':countryCode', $countryCode);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password); 
    $statement->bindValue(':customerID', $customerID);

    // Execute and check if successful
    if ($statement->execute()) {
        // Success message
        $successMessage = "Update successful!";
    } else {
        // Error message
        $errorMessage = "Update failed: " . $statement->errorInfo()[2];
    }

    // Close the cursor regardless
    $statement->closeCursor();
} else {
    // If the form wasn't submitted via POST, redirect back to the index page or handle the error
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Customer</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>
    <header>
        <h1>SportsPro Technical Support</h1> 
        <p>Sports management software for the sports enthusiast</p> 
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li> 
        </ul>
    </nav>
    </header>
    <main>

    <!-- Show the success or error message -->
    <?php if (isset($successMessage)) : ?>
        </br> <h2 style="color: green;"><?php echo $successMessage; ?></h2></br>
        <p><a href="view_update_customer.php?customerID=<?php echo $customerID; ?>">Back to Customer Details</a></p>
    <?php elseif (isset($errorMessage)) : ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
        <p><a href="view_update_customer.php?customerID=<?php echo $customerID; ?>">Try Again!</a></p>
    <?php endif; ?>

    <p><a href="index.php">Back to Search Customers</a></p>
    </main>
    <?php include("../view/footer.php"); ?> 
</body>
</html>