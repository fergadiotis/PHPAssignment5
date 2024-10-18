<?php
require('../model/database.php');
require('../model/customer_db.php'); 
include('../includes/header.php');

// Initialize the $lastName variable for storing search input
$lastName = '';

// Initialize an empty array for customers
$customers = [];

// Check if lastName is set and not empty in the GET request
if (isset($_GET['lastName']) && !empty($_GET['lastName'])) {
    $lastName = $_GET['lastName']; // Get the last name from the request
    // Fetch customers based on the last name
    $customers = get_customers_by_lastname($lastName);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>SportsPro Technical Support</title> 
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
<h1>Customer Search</h1>
<!-- Search form for entering the last name -->
<form action="index.php" method="get">
    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
    <input type="submit" value="Search">
</form>

<?php if (!empty($lastName)) : // Check if last name was entered ?>
    <?php if (isset($customers) && count($customers) > 0) : // Check if any customers were found ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>Select</th>
            </tr>
            <?php foreach ($customers as $customer) : // Loop through the customers ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['city']); ?></td>
                    <td>
                        <!-- Form to select a customer for viewing/updating -->
                        <form action="view_update_customer.php" method="get">
                            <input type="hidden" name="customerID" value="<?php echo $customer['customerID']; ?>">
                            <input type="submit" value="Select">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : // No customers found ?>
        <p>No customers found with last name "<?php echo htmlspecialchars($lastName); ?>"</p>
    <?php endif; ?>
<?php endif; ?>
</main>

<?php include '../view/footer.php'; ?> <!-- Include footer -->

</body>
</html>