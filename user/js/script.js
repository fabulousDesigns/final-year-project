$(document).ready(function () {
  $.ajax({
    url: "book-info.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      // Display data in the div box
      var html = "";
      $.each(data, function (index, value) {
        html += "<p>" + value.field1 + " " + value.field2 + "</p>";
      });
      $(".receipt").html(html);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    },
  });
});
