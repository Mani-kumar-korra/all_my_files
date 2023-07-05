$(document).ready(function() {
    var products = [
      { id: 1, name: "surgical mask", sku: "SKU001", quantity: 100, price: 19.99, image: "mask.jpg" },
      { id: 2, name: "surgical scissors", sku: "SKU002", quantity: 5, price: 9.99, image: "sciors.jpg" },
      { id: 3, name: "surgical gloves", sku: "SKU003", quantity: 3, price: 14.99, image: "gloves.jpg" },
      { id: 4, name: "multi-vitamin", sku: "SKU004", quantity: 8, price: 24.99, image: "mutli1.jpg" },
      { id: 5, name: "omega 3 6 9 fish oil", sku: "SKU005", quantity: 12, price: 29.99, image: "omega.jpeg" },
      { id: 6, name: "Aswaganda", sku: "SKU006", quantity: 2, price: 7.99, image: "aswagandha.jpg" },
      { id: 7, name: "calicum and vitamin D", sku: "SKU007", quantity: 6, price: 11.99, image: "calcium.jpeg" },
      { id: 8, name: "Fiber gummies", sku: "SKU008", quantity: 15, price: 17.99, image: "fibergummies.jpg" },
      { id: 9, name: "Fiber gummies", sku: "SKU0sasda08", quantity: 15, price: 17.99, image: "fibergummies.jpg" }
      
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
            ${selectedProductSKU !== product.sku ? `<button class="product-details" data-product-sku="${product.sku}">Show Details</button>` : ''}
          </div>
        `;
        productContainer.append(productHtml);
      });
    }
    
    function updatePrice() {
        var selectedQuantity = parseInt($(".quantity").val()) || 1; // Use default quantity of 1 if none selected
        var selectedProduct = products.find(function(product) {
          return product.sku === selectedProductSKU;
        });
    
        if (selectedProduct) {
          var totalPrice = selectedProduct.price * selectedQuantity;
          $("#priceDisplay").text("$" + totalPrice.toFixed(2));
        }
      }
      function displayPagination() {
        var pagination = $("#pagination");
        pagination.empty();
      
        
        if (currentPage > 1) {
          var prevButtonHtml = `<li class="pagination-arrow prev-arrow">&lt;</li>`;
          pagination.append(prevButtonHtml);
        }
      
        for (var i = 1; i <= totalPages; i++) {
          var activeClass = i === currentPage ? "active" : "";
          var pageHtml = `<li class="${activeClass}">${i}</li>`;
          pagination.append(pageHtml);
        }
      
       
        if (currentPage < totalPages) {
          var nextButtonHtml = `<li class="pagination-arrow next-arrow">&gt;</li>`;
          pagination.append(nextButtonHtml);
        }
      }
  
    function clearSelectedProductDetails() {
      selectedProductSKU = null;
      $("#product-details").empty();
      $(".product").show();
    }
  
   
      
      $("#product-container").on("change", ".quantity", function() {
        updatePrice();
      });
    displayProducts(currentPage);
    displayPagination();
  
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
          <table class="details-table" >
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
              <td>
                <select class="quantity" onchange="updatePrice()">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>Price:</th>
              <td id="priceDisplay">${selectedProduct.price}</td>
            </tr>
          </table>
        `;
        var productDetails = $("#product-details");
        productDetails.html(detailsHtml);

        $("#product-details").on("change", ".quantity", function() {
            updatePrice();
          });
      }
  
      $(".product").not(".active").hide();
      $("#back-button").show();
      $(".product-details").hide();
      $(".pagination").hide()
    });
  
    $("#back-button").click(function() {
      clearSelectedProductDetails();
      displayProducts(currentPage);
      displayPagination();
      $("#back-button").hide();
      $(".pagination").show()
    });
  });

