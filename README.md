requirment :

1.Display PLP and PDP(when click show more it has to display PDP) & using close button it has to close slected product

2.pagination ( should able to navigate using previous & next button,then using page no)

3.filter products using subcateory(ex: selected product type is "beauty", it has to display beauty realted product)


4.Add to cart

  1. when click on add to cart it has to display no of poducts added to cart

  2.when click on cart icon it has to redirect to whole new HTMl page.
  
    * it will display the products whichever added to cart.
    
    * Then we can remove products from cart using remove button

     
Duration :

  1. 6 hours for knockout js(estimated time - Null)
     
  2. 3.5 hours for require js(estimated time - Null)

     
Solution approach :

started with creating 2 html page one is for home and another one is for cart.
have created seprate files for js, i have used 2 buttons one is for show more details(show PDP), another button does 2 things 1.count 2. add products to cart( created seprate array basically it will push the selected products). Then filter products based on category.
In cart page : we can remove cart items( by using pop).
I have disabled preious and next button when not necessary . 
idenity current active page . 
  
dropback :

  i did not write code for no of quanity selected it leads to some issue, say i added same product twice to the cart it will be added to cart as 2 differenet product.

Test case:

  i have create a object of array which store all the data of products ex: name,price,image etc.

