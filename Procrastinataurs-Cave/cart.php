<?php
include 'includes/header.php';
?>

<div class="container my-5">

    <h1 class="text-center fw-bold mb-5">

        Shopping Cart

    </h1>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/products/product1.jpg"
                                 width="80"
                                 class="me-3 rounded">
                            <div>
                                <strong>
                                    Classic Backpack
                                </strong>
                            </div>
                        </div>
                    </td>
                    <td>
                        ₱1,499.00
                    </td>
                    <td>
                        <input
                            type="number"
                            value="1"
                            class="form-control"
                            style="width:90px;">
                    </td>
                    <td>
                        ₱1,499.00
                    </td>
                    <td>
                        <button class="btn btn-danger">
                            Remove
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="text-end">
        <h3>
            Total:
            ₱1,499.00
        </h3>
        <a href="checkout.php"
           class="btn btn-dark btn-lg">
            Proceed to Checkout
        </a>
    </div>
</div>

<?php
include 'includes/footer.php';
?>