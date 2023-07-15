require.config({
    baseUrl: '/',
    paths: {
        'knockout': 'https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest',
    },
});

require(['knockout'], function (ko) {
    function CartItem(image, name, price) {
        this.image = image;
        this.name = name;
        this.price = price;
        this.count = ko.observable(1);
        
    }

    function CartViewModel() {
        var self = this;
        self.cartItems = ko.observableArray([]);
        
        var storedCartItems = localStorage.getItem('cartItems');
        if (storedCartItems) {
            self.cartItems(JSON.parse(storedCartItems));
        }

        self.removeFromCart = function (item) {
            self.cartItems.remove(item);
            localStorage.setItem('cartItems', ko.toJSON(self.cartItems));
        };

        
        self.showEmptyCart = ko.computed(function () {
            return self.cartItems().length === 0;
        });
        

    }
      

    var cartViewModel = new CartViewModel();
    ko.applyBindings(cartViewModel, document.getElementById('cart-items-container'));
});
