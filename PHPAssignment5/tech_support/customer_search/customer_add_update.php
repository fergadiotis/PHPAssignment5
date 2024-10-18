<?php include '../view/header.php'; ?>
<main>
    <h1><?php echo isset($customer['customerID']) ? 'Update' : 'Add'; ?> Customer</h1>
    <?php if (!empty($errors)) : ?>
        <ul class="errors">
            <?php foreach ($errors as $error) : ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form action="." method="post">
        <input type="hidden" name="action" value="<?php echo isset($customer['customerID']) ? 'update_customer' : 'add_customer'; ?>">
        <?php if (isset($customer['customerID'])) : ?>
            <input type="hidden" name="customerID" value="<?php echo $customer['customerID']; ?>">
        <?php endif; ?>

        <label>First Name:</label>
        <input type="text" name="firstName" value="<?php echo isset($customer['firstName']) ? htmlspecialchars($customer['firstName']) : ''; ?>">
        <br>

        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo isset($customer['lastName']) ? htmlspecialchars($customer['lastName']) : ''; ?>">
        <br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo isset($customer['address']) ? htmlspecialchars($customer['address']) : ''; ?>">
        <br>

        <label>City:</label>
        <input type="text" name="city" value="<?php echo isset($customer['city']) ? htmlspecialchars($customer['city']) : ''; ?>">
        <br>

        <label>State:</label>
        <input type="text" name="state" value="<?php echo isset($customer['state']) ? htmlspecialchars($customer['state']) : ''; ?>">
        <br>

        <label>Postal Code:</label>
        <input type="text" name="postalCode" value="<?php echo isset($customer['postalCode']) ? htmlspecialchars($customer['postalCode']) : ''; ?>">
        <br>

        <label>Country Code:</label>
        <input type="text" name="countryCode" value="<?php echo isset($customer['countryCode']) ? htmlspecialchars($customer['countryCode']) : ''; ?>">
        <br>

        <label>Phone:</label>
        <input type="tel" name="phone" value="<?php echo isset($customer['phone']) ? htmlspecialchars($customer['phone']) : ''; ?>">
        <br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo isset($customer['email']) ? htmlspecialchars($customer['email']) : ''; ?>">
        <br>

        <label>Password:</label>
        <input type="password" name="password">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="<?php echo isset($customer['customerID']) ? 'Update' : 'Add'; ?> Customer">
        <br>
    </form>
    <p><a href="?action=search_customers">Search Customers</a></p>
</main>
<?php include '../view/footer.php'; ?>