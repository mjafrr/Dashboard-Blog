// script.js
document.addEventListener("DOMContentLoaded", function () {
  // Back to top
  window.addEventListener('scroll', function() {
    var backToTopButton = document.querySelector('.back-top');
    if (window.scrollY > 100) {
      backToTopButton.style.display = 'block';
    } else {
      backToTopButton.style.display = 'none';
    }
  });
  document.querySelector('.back-top').addEventListener('click', function(e) {
    e.preventDefault();
    // Smooth scroll to the top
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
});