document.addEventListener("DOMContentLoaded", function () {
  const mobileToggle = document.querySelector(".pg-header__mobile-toggle");
  const mobileNav = document.querySelector(".pg-header__nav");
  const body = document.body;

  // Create overlay element
  const overlay = document.createElement("div");
  overlay.className = "pg-header__overlay";
  document.body.appendChild(overlay);

  mobileToggle.addEventListener("click", function () {
    this.classList.toggle("is-active");
    mobileNav.classList.toggle("is-active");
    overlay.classList.toggle("is-active");
    body.style.overflow = body.style.overflow === "hidden" ? "" : "hidden";
  });

  // Close menu when clicking overlay
  overlay.addEventListener("click", function () {
    mobileToggle.classList.remove("is-active");
    mobileNav.classList.remove("is-active");
    overlay.classList.remove("is-active");
    body.style.overflow = "";
  });

  // Close menu when clicking nav links
  const navLinks = document.querySelectorAll(".pg-nav__item a");
  navLinks.forEach((link) => {
    link.addEventListener("click", function () {
      mobileToggle.classList.remove("is-active");
      mobileNav.classList.remove("is-active");
      overlay.classList.remove("is-active");
      body.style.overflow = "";
    });
  });
});
