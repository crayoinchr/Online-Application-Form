$(document).ready(function () {
  // Set the maximum date to today
  let today = new Date().toISOString().split("T")[0];
  $("#dob").attr("max", today);

  $("#regForm").on("submit", function (event) {
    let phone = $("#phone").val().trim();
    let dob = $("#dob").val();

    if (!/^[0-9]{10}$/.test(phone)) {
      alert("Please enter a valid 10-digit phone number.");
      event.preventDefault();
      return;
    }

    if (!dob || dob > today) {
      alert("Please select a valid date of birth.");
      event.preventDefault();
      return;
    }
  });
});
