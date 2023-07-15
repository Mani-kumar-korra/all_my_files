require.config({
  paths: {
    'knockout': 'https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest',
    'data': 'data'
  },
});

require(['knockout', 'data'], function (ko, productsData) {
  function Product(id, name, price, category, description, image, sku) {
    var self = this;
    self.id = id;
    self.name = name;
    self.price = price;
    self.category = category;
    self.description = description;
    self.image = image;
    self.sku = sku;
  }

  function ProductListViewModel(products) {
    var self = this;

    self.products = ko.observableArray(products);
    self.pageSize = 4;
    self.currentPageIndex = ko.observable(0);
    self.isProductDetailsVisible = ko.observable(false);
    self.selectedProduct = ko.observable();
    self.cartCount = ko.observable(0);
    self.cartItems = ko.observableArray([]);
    self.filteredProducts = ko.observableArray([]);
    self.selectedCategory = ko.observable();
    self.isNextButtonEnabled = ko.observable(false);
    self.isElectronicsSelected = ko.observable(false);
    self.isFashionSelected = ko.observable(false);
    self.isHomeSelected = ko.observable(false);
    self.isBeautySelected = ko.observable(false);

    self.maxPageIndex = ko.computed(function () {
      return Math.ceil(self.filteredProducts().length / self.pageSize) - 1;
    });

    self.pagedProducts = ko.computed(function () {
      var startIndex = self.pageSize * self.currentPageIndex();
      return self.filteredProducts().slice(startIndex, startIndex + self.pageSize);
    });

    self.paginationNumbers = ko.computed(function () {
      var pages = [];
      for (var i = 0; i <= self.maxPageIndex(); i++) {
        pages.push(i + 1);
      }
      return pages;
    });

    self.previousPage = function () {
      if (self.currentPageIndex() > 0) {
        self.currentPageIndex(self.currentPageIndex() - 1);
      }
    };

    self.nextPage = function () {
      if (self.currentPageIndex() < self.maxPageIndex()) {
        self.currentPageIndex(self.currentPageIndex() + 1);
      }

      if (self.currentPageIndex() === self.maxPageIndex()) {
        self.isNextButtonEnabled(false);
      } else {
        self.isNextButtonEnabled(true);
      }
    };

    self.goToPage = function (pageIndex) {
      self.currentPageIndex(pageIndex - 1);
    };

    self.isActivePage = function (pageIndex) {
      return self.currentPageIndex() === (pageIndex - 1);
    };

    self.showProductDetails = function (product) {
      self.selectedProduct(product);
      self.isProductDetailsVisible(true);
      
      var modal = document.getElementById("productDetailsModal");
      modal.style.display = "block";
    };
    
    self.hideProductDetails = function () {
      self.isProductDetailsVisible(false);
     
      var modal = document.getElementById("productDetailsModal");
      modal.style.display = "none";
    };
    
    self.viewProductDetails = function (product) {
      
      localStorage.setItem('selectedProduct', JSON.stringify(product));
      
     
      window.open('productdetails.html', '_blank');
    };

    self.addToCart = function (product) {
      
      var existingItem = ko.utils.arrayFirst(self.cartItems(), function (item) {
        return item.name === product.name;
      });
    
      if (existingItem) {
     
        
        existingItem.count += 1;
        existingItem.price = existingItem.count * product.price;
      } else {
        
        self.cartItems.push({
          image: product.image,
          name: product.name,
          price: product.price,
         
          count: 1 

         
        });
      }
    
      // Update cart count
      self.cartCount(self.cartCount() + 1);
    
      // Update local storage
      localStorage.setItem('cartItems', JSON.stringify(self.cartItems()));
    };
    

    self.filterByCategory = function () {
      var selectedCategories = [];
    
      if (self.isElectronicsSelected()) {
        selectedCategories.push('Electronics');
      }
    
      if (self.isFashionSelected()) {
        selectedCategories.push('Fashion');
      }
    
      if (self.isHomeSelected()) {
        selectedCategories.push('Home');
      }
    
      if (self.isBeautySelected()) {
        selectedCategories.push('Beauty');
      }
    
      if (selectedCategories.length === 0) {
        self.filteredProducts(self.products());
      } else {
        self.filteredProducts(self.products().filter(function (product) {
          return selectedCategories.includes(product.category);
        }));
      }
    
      self.currentPageIndex(0);
      self.isNextButtonEnabled(true);
    };

    self.filterByCategory('All');
  }

  var productListViewModel = new ProductListViewModel(productsData);
  ko.applyBindings(productListViewModel);
});
