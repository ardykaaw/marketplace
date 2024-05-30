const navbar = document.querySelector('.navbar')

window.addEventListener('scroll', function() {
  if (this.window.scrollY > 4) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
})