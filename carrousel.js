let currentIndex = 0;
const slides = document.querySelectorAll('.carousel-container img');
const totalSlides = slides.length;

function showSlide(index) {
  slides.forEach((slide) => {
    slide.style.display = 'none';
  });
  slides[index].style.display = 'block';
}

function nextSlide() {
  currentIndex = (currentIndex + 1) % totalSlides;
  showSlide(currentIndex);
}

function prevSlide() {
  currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
  showSlide(currentIndex);
}

showSlide(currentIndex); // Affiche la première image au chargement de la page
//setInterval(nextSlide, 3000);