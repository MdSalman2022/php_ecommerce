// Simple form validation
document.addEventListener("DOMContentLoaded", function () {
  // Checkout form validation
  var checkoutForm = document.querySelector('form[action*="process_order"]');

  if (checkoutForm) {
    checkoutForm.addEventListener("submit", function (event) {
      var nameField = document.getElementById("customer_name");
      var phoneField = document.getElementById("customer_phone");
      var addressField = document.getElementById("customer_address");

      if (
        nameField.value.trim() === "" ||
        phoneField.value.trim() === "" ||
        addressField.value.trim() === ""
      ) {
        event.preventDefault();
        alert("Please fill in all required fields");
      }
    });
  }

  // Quantity validation
  var quantityInputs = document.querySelectorAll('input[type="number"]');
  quantityInputs.forEach(function (input) {
    input.addEventListener("change", function () {
      if (parseInt(this.value) < 0) {
        this.value = 0;
      }
    });
  });
});
