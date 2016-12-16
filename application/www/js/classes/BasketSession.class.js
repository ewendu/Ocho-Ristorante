'use strict';


var BasketSession = function ()
{
    
    this.items = new Array();
    
    
    
};

BasketSession.prototype.add = function(mealId, name, description, quantity, price) 
{
    console.log('bask session');
    
    mealId   = parseInt(mealId);
    quantity = parseInt(quantity);
    price    = parseFloat(price);
    // Creating a new object with the parameters
    var item = new Object();
    item.mealId      = mealId;
    item.Name        = name;
    item.Description = description;
    item.Quantity    = quantity;
    item.Price       = price;
    // if the product is already in the basket we just add the quantity
    for(var i = 0; i < this.items.length; i++)
    {
        if(this.items[i].mealId == mealId)
        {
            this.items[i].Quantity += quantity;
            return;
        }
    
    }
    // if not we add the product in the array
    this.items.push(item);
    
    
};

BasketSession.prototype.removeItem = function(mealId) 
{
    for(var i = 0; i < this.items.length; i++)
    {
        if(this.items[i].mealId == mealId)
        {
            this.items.splice(i,1);
        }
    }
};