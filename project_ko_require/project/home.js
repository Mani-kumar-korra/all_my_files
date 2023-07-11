require.config({
  // baseUrl: '/',
  paths: {
    'knockout': 'https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest',
    'data':'data'
  },
  
});


require(['knockout','data'], function(ko,productsData) {
function Product(id, name, price, category, description, image, sku) { //my model 


    var self = this;
    self.id = id;
    self.name = name;
    self.price = price;
    self.category = category;
    self.description = description;
    self.image = image;
    self.sku = sku;
  }

function ProductListViewModel(products) { //my view model
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

self.maxPageIndex = ko.computed(function () {
  return Math.ceil(self.filteredProducts().length / self.pageSize) - 1;
  //console.log(self.filteredProducts().length)
});


self.pagedProducts = ko.computed(function () {
  var startIndex = self.pageSize * self.currentPageIndex();// page one ku 4* 0 apo 0 so index starts from zero
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
};

self.hideProductDetails = function () {
  self.isProductDetailsVisible(false);
};

self.addToCart = function (product) {
  self.cartCount(self.cartCount() + 1);
  self.cartItems.push({
    image: product.image,
    name: product.name,
    price: product.price
  });

  // Store cartItems in local storage
  localStorage.setItem('cartItems', JSON.stringify(self.cartItems()));
};

self.filterByCategory = function (category) {
  self.selectedCategory(category);
  if (category === 'All') {
    self.filteredProducts(self.products());
  } else {
    self.filteredProducts(self.products().filter(function (product) {
      return product.category === category;
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