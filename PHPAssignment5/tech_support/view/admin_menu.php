<?php include 'header.php'; ?>
<main>
    <nav>
        <div class="admin">
            <h2>Administrators</h2>
            <ul>
                <li><a href="product_manager">Manage Products</a></li>
                <li><a href="technician_manager">Manage Technicians</a></li>
                <li><a href="?action=manage_customers">Manage Customers</a></li>
                <li><a href="incident_manager/create_incident.php">Create Incident</a></li>
                <li><a href="incident_manager/assign_incident.php">Assign Incident</a></li>
                <li><a href="incident_manager/display_incidents.php">Display Incidents</a></li>
            </ul>
        </div>

        <div class="tech">
            <h2>Technicians</h2>
            <ul>
                <li><a href="incident_manager/update_incident.php">Update Incident</a></li>
            </ul>
        </div>

        <div class="customer">
            <h2>Customers</h2>
            <ul>
                <li><a href="product_register">Register Product</a></li>
            </ul>
        </div>

    </nav>
</main>
<?php include 'footer.php'; ?>