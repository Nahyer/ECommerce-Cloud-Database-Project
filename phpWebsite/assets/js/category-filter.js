$(document).ready(function () {
  // Function to load products based on the selected category
  function loadProducts(categoryId) {
    // Send an AJAX request to a PHP script to fetch products by category
    document.getElementById("all-products").style.display = "none";
    $.ajax({
      type: "POST",
      url: "fetch-products-by-category.php", // Create this PHP script
      data: { categoryId: categoryId },
      success: function (response) {
        // Replace the content of the product container with the fetched products
        $("#product-container").html(response);
      },
    });
  }

  // Event handler for category selection
  $(".dropdown-item").on("click", function () {
    var categoryId = $(this).data("category-id");
    loadProducts(categoryId);
  });
});