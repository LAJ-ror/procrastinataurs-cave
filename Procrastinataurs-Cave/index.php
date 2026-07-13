<?php
$currentPage = "home";

require_once 'includes/db.php';
include 'includes/header.php';
?>

<section class="hero" aria-label="Fashion handbag collection">
    <!-- IMAGE PATH: Palitan ang assets/images/hero-banner.jpg ng hero/banner image mo -->
    <img src="assets/images/hero-banner.jpg" alt="Fashion models carrying handbags">
</section>

<section class="collection-section" id="shop">
    <div class="section-heading compact-heading">
        <p class="eyebrow">Métiers d’Art 2026</p>
        <p class="collection-label">Collection</p>
        <h1>Handbags</h1>
        <p>Discover a curated selection from the collection.</p>
    </div>

    <?php
    // IMAGE PATHS: Palitan ang image filenames sa bawat product kapag may actual product images ka.
    $products = [
        ['name' => 'Maxi Flapbag', 'description' => 'Sequins & Gold-Tone Metal — Red & Multicolor', 'image' => 'product-1.jpg'],
        ['name' => 'Maxi Flapbag', 'description' => 'Mixed Fibers & Gold-Tone Metal — Yellow, Black & Red', 'image' => 'product-2.jpg'],
        ['name' => 'Classic 11.12 Handbag', 'description' => 'Embroidered Wool Crepe, Raffia, Glass Beads & Gold-Tone Metal', 'image' => 'product-3.jpg'],
        ['name' => 'Mini Flap Bag', 'description' => 'Lambskin, Shearling Lambskin & Gold-Tone Metal', 'image' => 'product-4.jpg']
    ];
    ?>

    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <article class="product-card">
                <div class="product-image-wrap">
                    <!-- PRODUCT IMAGE PATH: Galing sa image value sa $products array sa taas -->
                    <img src="assets/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p><?= htmlspecialchars($product['description']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="featured-grid">
        <article class="featured-product">
            <!-- IMAGE PATH: Palitan ang assets/images/featured-1.jpg -->
            <img src="assets/images/featured-1.jpg" alt="Apple-shaped minaudiere handbag">
            <h2>Apple Minaudiere</h2>
            <p>Lacquered Metal, Enamel & Gold-Tone Metal — Red, Green & Golden</p>
        </article>

        <article class="featured-product">
            <!-- IMAGE PATH: Palitan ang assets/images/featured-2.jpg -->
            <img src="assets/images/featured-2.jpg" alt="Dark burgundy mini flap bag">
            <h2>Mini Flap Bag</h2>
            <p>Lambskin & Gold-Tone Metal — Dark Burgundy</p>
        </article>
    </div>

    <a href="#categories" class="primary-button">Discover More</a>
</section>

<section class="perfect-bag-section">
    <div class="perfect-bag-copy">
        <h2>Find Your Perfect Bag</h2>
        <p><strong>Some text here omfg.</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, voluptas. Find the silhouette, size, and style that matches your everyday routine.</p>
        <a href="#shop" class="light-button">Shop Here</a>
    </div>

    <!-- IMAGE PATH: Palitan ang assets/images/perfect-bag.jpg -->
    <img src="assets/images/perfect-bag.jpg" alt="Models carrying handbags">
</section>

<section class="variations-section" id="categories">
    <div class="section-heading">
        <h2>Different Variations</h2>
    </div>

    <?php
    // IMAGE PATHS: Palitan ang image filenames sa bawat category kapag may actual category images ka.
    $categories = [
        ['title' => 'Category 1', 'image' => 'category-1.jpg'],
        ['title' => 'Category 2', 'image' => 'category-2.jpg'],
        ['title' => 'Category 3', 'image' => 'category-3.jpg'],
        ['title' => 'Category 4', 'image' => 'category-4.jpg']
    ];
    ?>

    <div class="category-list">
        <?php foreach ($categories as $index => $category): ?>
            <article class="category-row <?= $index % 2 === 1 ? 'reverse' : '' ?>">
                <!-- CATEGORY IMAGE PATH: Galing sa image value sa $categories array sa taas -->
                <img src="assets/images/<?= htmlspecialchars($category['image']) ?>" alt="<?= htmlspecialchars($category['title']) ?> bag category">
                <div class="category-copy">
                    <h3><?= htmlspecialchars($category['title']) ?></h3>
                    <p><strong>Some text here omfg.</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinct bags, practical shapes, and carefully selected materials for different styles and occasions.</p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
