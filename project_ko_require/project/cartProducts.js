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
    }

    function CartViewModel() {
        var self = this;
        self.cartItems = ko.observableArray([]);

        // Load cartItems from localStorage
        var storedCartItems = localStorage.getItem('cartItems');
        if (storedCartItems) {
            self.cartItems(JSON.parse(storedCartItems));
        }

        self.removeFromCart = function (item) {
            self.cartItems.remove(item);
            localStorage.setItem('cartItems', ko.toJSON(self.cartItems));
        };
    }

    var cartViewModel = new CartViewModel();
    ko.applyBindings(cartViewModel, document.getElementById('cart-items-container'));
});