$(document).ready(function () {
  $(".add-to-cart").click(function () {
    const productId = $(this).data("product-id");
    $.ajax({
      type: "POST",
      url: "add_to_cart.php",
      data: { product_id: productId },
      success: function (response) {
        alert(response); // Show a success message or handle as needed
        // Load and display the cart contents in the modal
        $("#cart-content").load("cart_contents.php"); // Create this file to retrieve cart contents
        $("#cartModal").modal("show"); // Show the modal
      },
      error: function () {
        alert("Error adding product to cart");
      },
    });
  });
});
