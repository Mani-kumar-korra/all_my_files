$(document).ready(function() {
  var products = [
    { id: 1, name: "surgical mask", sku: "SKU001", quantity: 100, price: 19.99, image: "mask.jpg" },
    { id: 2, name: "surgical scissors", sku: "SKU002", quantity: 5, price: 9.99, image: "sciors.jpg" },
    { id: 3, name: "surgical gloves", sku: "SKU003", quantity: 3, price: 14.99, image: "gloves.jpg" },
    { id: 4, name: "multi-vitamin", sku: "SKU004", quantity: 8, price: 24.99, image: "mutli1.jpg" },
    { id: 5, name: "omega 3 6 9 fish oil", sku: "SKU005", quantity: 12, price: 29.99, image: "aswagandha.jpg" },
    { id: 6, name: "Aswaganda", sku: "SKU006", quantity: 2, price: 7.99, image: "aswagandha.jpg" },
    { id: 7, name: "calicum and vitamin D", sku: "SKU007", quantity: 6, price: 11.99, image: "calcium.jpeg" },
    { id: 8, name: "Fiber gummies", sku: "SKU008", quantity: 15, price: 17.99, image: "fibergummies.jpg" }
  ];

  var productsPerPage = 4;
  var currentPage = 1;
  var totalPages = Math.ceil(products.length / productsPerPage);
  var selectedProductSKU = null;

  function displayProducts(page) {
    var startIndex = (page - 1) * productsPerPage;
    var endIndex = startIndex + productsPerPage;
    var productsToShow = products.slice(startIndex, endIndex);

    var productContainer = $("#product-container");
    productContainer.empty();

    $.each(productsToShow, function(index, product) {
      var productHtml = `
        <div class="product ${selectedProductSKU === product.sku ? 'active' : ''}">
          <img src="${product.image}" alt="${product.name}">
          <div class="product-name">${product.name}</div>
          <button class="product-details" data-product-sku="${product.sku}">Show Details</button>
        </div>
      `;
      productContainer.append(productHtml);
    });
  }

  function displayPagination() {
    var pagination = $("#pagination");
    pagination.empty();
  
    var prevButtonHtml = `<li class="pagination-arrow prev-arrow">&lt;</li>`; // here wt iam doing is creating previousbt and adding that in html li
    pagination.append(prevButtonHtml);
  
    for (var i = 1; i <= totalPages; i++) {//In each iteration, the code checks whether the current value of i is equal to currentPage. If they are equal, it means the current page being generated is the active page.
      var activeClass = i === currentPage ? "active" : "";
      var pageHtml = `<li class="${activeClass}">${i}</li>`;
      pagination.append(pageHtml);
    }
  
    var nextButtonHtml = `<li class="pagination-arrow next-arrow">&gt;</li>`;
    pagination.append(nextButtonHtml);
  }
  
  
  function clearSelectedProductDetails() {
    selectedProductSKU = null;
    $("#product-details").empty();
    $(".product").show();
  }
  
  
  displayProducts(currentPage);
  displayPagination();
  
 // so wt iam ddoin is if the clicked li has class prev na aroow decrement by 1 , if 
  $("#pagination").on("click", "li", function() {
    var clickedElement = $(this);
  
    if (clickedElement.hasClass("prev-arrow")) {
      if (currentPage > 1) {
        currentPage--;
      }
    } else if (clickedElement.hasClass("next-arrow")) {
      if (currentPage < totalPages) {
        currentPage++;
      }
    } else {
      currentPage = parseInt(clickedElement.text());
    }
  
    clearSelectedProductDetails();
    displayProducts(currentPage);
    displayPagination();
  });
  $("#product-container").on("click", ".product-details", function() {
    selectedProductSKU = $(this).data("product-sku");
    displayProducts(currentPage);
    displayPagination();

    var selectedProduct = products.find(function(product) {
      return product.sku === selectedProductSKU;
    });

    if (selectedProduct) {
      var detailsHtml = `
        <table class="details-table">
          <tr>
            <th>Product Name:</th>
            <td>${selectedProduct.name}</td>
          </tr>
          <tr>
            <th>SKU:</th>
            <td>${selectedProduct.sku}</td>
          </tr>
          <tr>
            <th>Quantity:</th>
            <td>${selectedProduct.quantity}</td>
          </tr>
          <tr>
            <th>Price:</th>
            <td>${selectedProduct.price}</td>
          </tr>
        </table>
      `;

      var productDetails = $("#product-details");
      productDetails.html(detailsHtml);
    }

    // tohide
    $(".product").not(".active").hide();
  });
});