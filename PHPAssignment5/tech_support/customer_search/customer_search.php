<?php include '../view/header.php'; ?>
<main>
    <h1>Customer Search</h1>
    <form action="." method="get">
        <input type="hidden" name="action" value="search_customers">
        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
        <input type="submit" value="Search">
    </form>

    <?php if (!empty($customers)) : ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['firstName'] . ' ' . $customer['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['city']); ?></td>
                    <td>
                        <form action="." method="get">
                            <input type="hidden" name="action" value="select_customer">
                            <input type="hidden" name="customer_id" value="<?php echo $customer['customerID']; ?>">
                            <input type="submit" value="Select">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p><a href="?action=display_add_form">Add Customer</a></p>
</main>
<?php include '../view/footer.php'; ?>