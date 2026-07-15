<?php
$currentPage = "shop";

require_once 'includes/db.php';
include 'includes/header.php';
?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Shop</h1>
        <p class="text-muted">Browse our latest bag collection.</p>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search bags...">
                    <button class="btn btn-dark" type="submit">
                        <i class="bi bi-search"></i>
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center mb-5">
        <button class="btn btn-outline-dark m-1">All</button>
        <button class="btn btn-outline-dark m-1">Handbags</button>
        <button class="btn btn-outline-dark m-1">Backpacks</button>
        <button class="btn btn-outline-dark m-1">Travel Bags</button>
        <button class="btn btn-outline-dark m-1">Luggage</button>
    </div>

    <div class="container">
        <div class="row">

            <!-- Card 1 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="assets/images/product_bags/handbag.avif" class="card-img-top" alt="Handbag">
                    <div class="card-body">
                        <h5 class="card-title">Handbag</h5>
                        <p class="text-muted mb-2">₱380,575.00</p>
                        <p class="small">Perfect for students and everyday use.</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="product.php" class="btn btn-outline-dark w-100 mb-2">View Details</a>
                        <button class="btn btn-dark w-100">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="assets/images/product_bags/backpack.webp" class="card-img-top" alt="Classic Backpack">
                    <div class="card-body">
                        <h5 class="card-title">Backpack</h5>
                        <p class="text-muted mb-2">₱202,573.00</p>
                        <p class="small">Perfect for students and everyday use.</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="product.php" class="btn btn-outline-dark w-100 mb-2">View Details</a>
                        <button class="btn btn-dark w-100">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="assets/images/product_bags/travebag.webp" class="card-img-top" alt="Travel Bag">
                    <div class="card-body">
                        <h5 class="card-title">Travel Bag</h5>
                        <p class="text-muted mb-2">₱1,043,524.00</p>
                        <p class="small">Perfect for students and everyday use.</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="product.php" class="btn btn-outline-dark w-100 mb-2">View Details</a>
                        <button class="btn btn-dark w-100">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="assets/images/product_bags/luggage.jpg" class="card-img-top" alt="Luggage">
                    <div class="card-body">
                        <h5 class="card-title">Luggage</h5>
                        <p class="text-muted mb-2">₱122,050.00</p>
                        <p class="small">Perfect for students and everyday use.</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="product.php" class="btn btn-outline-dark w-100 mb-2">View Details</a>
                        <button class="btn btn-dark w-100">Add to Cart</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<?php
include 'includes/footer.php';
?>