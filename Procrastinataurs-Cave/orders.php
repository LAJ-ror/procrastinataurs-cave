<?php
require_once 'includes/db.php';
require_once 'includes/session.php';

include 'includes/header.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="container my-5">

    <h1 class="text-center fw-bold mb-5">
        My Orders
    </h1>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Total Amount</th>
                        <th>Payment Method</th>
                        <th>Reference #</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Date Ordered</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['order_id']; ?></td>
                                <td>₱<?php echo number_format($row['total_amount'], 2); ?></td>
                                <td><?php echo $row['payment_method']; ?></td>
                                <td>
                                    <?php echo !empty($row['reference_number']) ? $row['reference_number'] : 'N/A'; ?>
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        <?php echo $row['payment_status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?php echo $row['order_status']; ?>
                                    </span>
                                </td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                You have no orders yet.
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
