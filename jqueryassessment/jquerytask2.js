$(document).ready(function() {
    var products = [
      { id: 1, name: "surgical mask", sku: "SKU001", quantity: 100, price: 19.99, image: "mask.jpg" },
      { id: 2, name: "surgical scissors", sku: "SKU002", quantity: 5, price: 9.99, image: "mask.jpg" },
      { id: 3, name: "surgical gloves", sku: "SKU003", quantity: 3, price: 14.99, image: "mask.jpg" },
      { id: 4, name: "multi-vitamin", sku: "SKU004", quantity: 8, price: 24.99, image: "mutli1.jpg" },
      { id: 5, name: "omega 3 6 9 fish oil", sku: "SKU005", quantity: 12, price: 29.99, image: "aswagandha.jpg" },
      { id: 6, name: "Aswaganda", sku: "SKU006", quantity: 2, price: 7.99, image: "aswagandha.jpg" },
      { id: 7, name: "calicum and vitamin D", sku: "SKU007", quantity: 6, price: 11.99, image: "aswagandha.jpg" },
      { id: 8, name: "Fiber gummies", sku: "SKU008", quantity: 15, price: 17.99, image: "aswagandha.jpg" }
    ];
    var productsPerPage = 4;
  var currentPage = 1;
  var totalPages = Math.ceil(products.length / productsPerPage);//iam writing this for totno of pags
  var selectedProductID = null;

  function displayProducts(page) {// to create new arrang cus based on page& products per page only we can append
    var startIndex = (page - 1) * productsPerPage;
    var endIndex = startIndex + productsPerPage;
    var productsToShow = products.slice(startIndex, endIndex);

    var productContainer = $("#product-container");
    productContainer.empty();

    $.each(productsToShow, function(index, product) {
      var productHtml = `
        <div class="product ${selectedProductID === product.id ? 'active' : ''}">
          <img src="${product.image}" alt="${product.name}">
          <div class="product-name">${product.name}</div>
          <button class="product-details" data-product-id="${product.id}">Show Details</button>
        </div>
      `;
      productContainer.append(productHtml);
    });
  }

});