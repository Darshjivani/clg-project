<?php
session_start();
if (!isset($_SESSION['User_Logged-In'])) {
    header("Location: Authentication");
    exit();
}

require_once 'DB/connetction.php';

// Get user's orders
$user_id = $_SESSION['admin_id'];
$sql = "SELECT * FROM shipment_details WHERE User_ID = ? ORDER BY ID DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Get success/error messages
$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Global Logistic Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1><i class="fas fa-chart-line"></i> Dashboard</h1>
            <div class="user-info">
                <span class="user-name">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</span>
                <a href="/Darsh/Client/Home" class="btn btn-secondary btn-small">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="/Darsh/Client/Logout" class="btn btn-secondary btn-small">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <?php if ($status && $message): ?>
            <div class="alert alert-<?php echo $status === 'success' ? 'success' : 'error'; ?>">
                <i class="fas fa-<?php echo $status === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Orders</h3>
                    <p><?php echo count($orders); ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon import">
                    <i class="fas fa-download"></i>
                </div>
                <div class="stat-info">
                    <h3>Import Orders</h3>
                    <p><?php echo count(array_filter($orders, function($o) { return $o['Shipment_Type'] === 'import'; })); ?></p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon export">
                    <i class="fas fa-upload"></i>
                </div>
                <div class="stat-info">
                    <h3>Export Orders</h3>
                    <p><?php echo count(array_filter($orders, function($o) { return $o['Shipment_Type'] === 'export'; })); ?></p>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="orders-section">
            <div class="orders-header">
                <h2><i class="fas fa-shipping-fast"></i> Your Orders</h2>
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search orders by ID, name, or destination...">
                </div>
                <a href="/Darsh/Client/Service" class="btn btn-primary btn-small">
                    <i class="fas fa-plus"></i> New Order
                </a>
            </div>

            <div class="orders-grid" id="ordersGrid">
                <?php if (empty($orders)): ?>
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <h3>No Orders Yet</h3>
                        <p>You haven't placed any orders yet. Start by creating your first shipment!</p>
                        <a href="/Darsh/Client/Service?type=Sea Freight" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create First Order
                        </a>
                    </div>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <div class="order-card" data-order-id="<?php echo $order['ID']; ?>">
                            <div class="order-header">
                                <div class="order-id">Order #<?php echo str_pad($order['ID'], 6, '0', STR_PAD_LEFT); ?></div>
                                <span class="order-badge badge-<?php echo $order['Shipment_Type']; ?>">
                                    <?php echo strtoupper($order['Shipment_Type']); ?>
                                </span>
                            </div>

                            <div class="order-route">
                                <div class="route-point">
                                    <div class="detail-label">From</div>
                                    <div class="detail-value"><?php echo htmlspecialchars($order['Origin_Port']); ?></div>
                                </div>
                                <i class="fas fa-arrow-right route-arrow"></i>
                                <div class="route-point">
                                    <div class="detail-label">To</div>
                                    <div class="detail-value"><?php echo htmlspecialchars($order['Dest_Port']); ?></div>
                                </div>
                            </div>

                            <div class="order-details">
                                <div class="detail-item">
                                    <span class="detail-label">Transport Mode</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($order['Transport_Mode']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Weight</span>
                                    <span class="detail-value"><?php echo number_format($order['Weight'], 2); ?> kg</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Quantity</span>
                                    <span class="detail-value"><?php echo $order['Quantity']; ?> units</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Charge</span>
                                    <span class="detail-value">$<?php echo number_format($order['Shipment_Charge'], 2); ?></span>
                                </div>
                            </div>

                            <div class="order-actions">
                                <button class="btn btn-edit btn-small view-details" onclick="viewOrderDetails(<?php echo $order['ID']; ?>)">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button class="btn btn-primary btn-small edit-contact" onclick="editContact(<?php echo $order['ID']; ?>)">
                                    <i class="fas fa-edit"></i> Edit Contact
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-info-circle"></i> Order Details</h2>
                <button class="close-modal" onclick="closeModal('detailsModal')">&times;</button>
            </div>
            <div class="modal-body" id="detailsModalBody">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    <!-- Edit Contact Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-edit"></i> Edit Contact Details</h2>
                <button class="close-modal" onclick="closeModal('editModal')">&times;</button>
            </div>
            <form id="editForm" method="POST" action="/Darsh/Client/UpdateContact">
                <div class="modal-body" id="editModalBody">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/dashboard.js"></script>
    <script>
        // Orders data for JavaScript
        const ordersData = <?php echo json_encode($orders); ?>;
    </script>
</body>
</html>