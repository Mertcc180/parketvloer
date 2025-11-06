document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector(".pg-header");
  const headerOffset = header ? header.offsetHeight + 20 : 140;

  document
    .querySelectorAll('.services-grid .service-card[href^="#"]')
    .forEach((link) => {
      link.addEventListener("click", (event) => {
        const targetId = link.getAttribute("href");
        const targetEl = document.querySelector(targetId);
        if (!targetEl) return;

        event.preventDefault();

        const elementTop =
          targetEl.getBoundingClientRect().top + window.pageYOffset;

        window.scrollTo({
          top: elementTop - headerOffset,
          behavior: "smooth",
        });

        history.replaceState(null, "", targetId);
      });
    });
});
