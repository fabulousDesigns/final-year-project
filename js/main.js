let intro = document.querySelector(".intro");
let logo = document.querySelector(".logo-header");
let logoSpan = document.querySelectorAll(".logo");
// ===========================================================================
// splash-screen
// ===========================================================================

window.addEventListener("DOMContentLoaded", () => {
  logoSpan.forEach((span, idx) => {
    setTimeout(() => {
      span.classList.add("active");
    }, (idx + 1) * 500);
  });
  setTimeout(() => {
    logoSpan.forEach((span, idx) => {
      setTimeout(() => {
        span.classList.remove("active");
        span.classList.add("fade");
      }, (idx + 1) * 150);
    });
  }, 2000);
  setTimeout(() => {
    intro.style.top = "-100vh";
  }, 2500);
});
// ===========================================================================
// end splash-screen
// ===========================================================================
