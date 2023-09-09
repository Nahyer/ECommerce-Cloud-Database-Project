$(document).ready(function () {
  $(".add-to-cart").click(function () {
    const productId = $(this).data("product-id");
    $.ajax({
      type: "POST",
      url: "add_to_cart.php",
      data: { product_id: productId },
      success: function () {
        // Show the toast notification
        $("#cartNotification").toast("show");

        // Load and display the cart contents in the modal
        $("#cart-content").load("cart_contents.php"); // Create this file to retrieve cart contents
        $("#cartModal").modal("show"); // Show the modal
      },
      error: function () {
        alert("Error adding product to cart");
      },
    });
  });

      var checkoutButton = document.getElementById("checkoutButton");
      checkoutButton.addEventListener("click", function () {
        // Redirect the user to the checkout page
        window.location.href = "checkout.php"; // Change "checkout.php" to your actual checkout page URL
      });
});


