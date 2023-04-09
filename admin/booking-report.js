$(document).ready(function () {
  $("#submit_btn").click(function () {
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    if (start_date != "" && end_date != "") {
      $.ajax({
        url: "get-booking-report.php",
        type: "POST",
        data: { start_date: start_date, end_date: end_date },
        success: function (data) {
          $("#booking_report tbody").html(data);
        },
      });
    }
  });

  $("#print_btn").click(function () {
    // window.jsPDF = window.jspdf.jsPDF;
    var doc = new jsPDF();
    doc.autoTable({ html: "#booking_report" });
    doc.save("booking_report.pdf");
  });
});
