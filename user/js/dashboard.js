// =================================================
// ? DISPLAY DATE & TIME
// =================================================

var timeDisplay = document.getElementById("time");

function refreshTime() {
  var dateString = new Date().toLocaleString("en-US", {
    timeZone: "Africa/Nairobi",
  });
  var formattedString = dateString.replace(", ", " - ");
  timeDisplay.innerHTML = formattedString;
}

setInterval(refreshTime, 1000);
// =================================================
// ? DISPLAY BOOKING FORM
// =================================================
const book = document.querySelector("#book");
const bookingForm = document.querySelector(".booking__form");
const bookClose = document.querySelector("#book__close");

book.addEventListener("click", () => {
  bookingForm.style.display = "block";
});
bookClose.addEventListener("click", () => {
  bookingForm.style.display = "none";
});
//=====================================================
//? PAYMENT FORM
//=====================================================
const pay = document.querySelector("#pay_U");
const payForm = document.querySelector(".payment__form");
const payClose = document.querySelector("#pay__close");

pay.addEventListener("click", () => {
  payForm.style.display = "block";
});
payClose.addEventListener("click", () => {
  payForm.style.display = "none";
});
