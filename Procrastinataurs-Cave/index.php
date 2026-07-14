<?php
$currentPage = "home";

require_once 'includes/db.php';
include 'includes/header.php';
?>

<!-- BOOTSTRAP CODE HERE -->

<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/images/CarouselPhoto1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/images/CarouselPhoto2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/images/CarouselPhoto3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- BOOTSTRAP END -->

<section class="collection-section" id="shop">
    <div class="section-heading compact-heading">
        <p class="eyebrow">Métiers d’Art 2026</p>
        <p class="collection-label">Collection</p>
        <h1>Handbags</h1>
        <p>Discover a curated selection from the collection.</p>
    </div>

    <?php
    $products = [
        ['name' => 'Maxi Flapbag', 'description' => 'Sequins & Gold-Tone Metal — Red & Multicolor', 'image' => 'bag001.svg'],
        ['name' => 'Maxi Flapbag', 'description' => 'Mixed Fibers & Gold-Tone Metal — Yellow, Black & Red', 'image' => 'bag002.svg'],
        ['name' => 'Classic 11.12 Handbag', 'description' => 'Embroidered Wool Crepe, Raffia, Glass Beads & Gold-Tone Metal', 'image' => 'bag003.svg'],
        ['name' => 'Mini Flap Bag', 'description' => 'Lambskin, Shearling Lambskin & Gold-Tone Metal', 'image' => 'bag004.svg']
    ];
    ?>

    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <article class="product-card">
                <div class="product-image-wrap">
                    <img src="assets/images/bag_photos/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p><?= htmlspecialchars($product['description']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="featured-grid">
        <article class="featured-product">
            <img src="assets/images/bag_photos/bag005.svg" alt="Apple-shaped minaudiere handbag">
            <h2>Apple Minaudiere</h2>
            <p>Lacquered Metal, Enamel & Gold-Tone Metal — Red, Green & Golden</p>
        </article>

        <article class="featured-product">
            <img src="assets/images/bag_photos/bag006.svg" alt="Dark burgundy mini flap bag">
            <h2>Mini Flap Bag</h2>
            <p>Lambskin & Gold-Tone Metal — Dark Burgundy</p>
        </article>
    </div>

    <a href="#categories" class="primary-button">Discover More</a>
</section>

<section class="perfect-bag-section">
    <div class="perfect-bag-copy">
        <h2>Find Your Perfect Bag</h2>
        <p>Some text here omfg. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, voluptas. Find the silhouette, size, and style that matches your everyday routine.</p>
        <a href="shop.php" class="light-button">Shop Here</a>
    </div>

    <img src="assets/images/model_photo.svg" alt="Models carrying handbags">
</section>

<section class="variations-section" id="categories">
    <div class="section-heading">
        <h2>Different Variations</h2>
    </div>

    <?php
    $categories = [
        ['title' => 'Handbags', 'image' => 'handbags.jpg'],
        ['title' => 'Backpacks', 'image' => 'backpacks.jpg'],
        ['title' => 'Travel Bags', 'image' => 'workbag.jpg'],
        ['title' => 'Luggage', 'image' => 'luggage.jpg']
    ];
    ?>

    <div class="category-list">
        <?php foreach ($categories as $index => $category): ?>
            <article class="category-row <?= $index % 2 === 1 ? 'reverse' : '' ?>">
                <img src="assets/images/category_bags_photos/<?= htmlspecialchars($category['image']) ?>" alt="<?= htmlspecialchars($category['title']) ?> bag category">
                <div class="category-copy">
                    <h3><?= htmlspecialchars($category['title']) ?></h3>
                    <p>Some text here omfg. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinct bags, practical shapes, and carefully selected materials for different styles and occasions.</p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
