<?php
$pageTitre = "Carrousel";
$metaDescription = "Carrousel";
$currentPage = 'carrousel';
require_once 'header.php';
?>

    <h1>Carrousel</h1>
<div class="carousel">
  <div class="carousel-container">
    <img src="./img/image1.jpg" alt="Image 1">
    <img src="./img/image2.jpg" alt="Image 2">
    <img src="./img/image3.jpg" alt="Image 3">
  </div>
  <button class="prev" onclick="prevSlide()">&#10094;</button>
  <button class="next" onclick="nextSlide()">&#10095;</button>
</div>

<script src="./carrousel.js"></script>
</body>
</html>
<?php require_once 'footer.php'; ?>