'use strict';


var OrderForm = function ()
{
    this.$form         = $('#order-form');  // Form selection
    this.$meal         = $('#meal');        // <select> selection
    this.$mealDetails  = $('#meal-details');// Container where the infos will apear selection 
    this.$quantity     = $('#quantity');
    this.basketSession = new BasketSession();
    
};

OrderForm.prototype.run = function() 
{
    // Event when the user change the <select>
    this.$meal.on('change', this.onChangeMeal.bind(this));
    $('#addtobasket').on('click', this.onClickAddMeal.bind(this));
};

OrderForm.prototype.onChangeMeal = function(event) 
{
    var $currentOption;
    var queryString;
    var mealId;
    // Getting selected option
    $currentOption = $(event.currentTarget);
    
    // The value of the current option is : 
    mealId         = $currentOption.val();
    
    queryString = getRequestUrl()+'/meal?id='+mealId;
    
    $.getJSON(queryString, this.onAjaxChangeMeal.bind(this));
    
   
};

OrderForm.prototype.onAjaxChangeMeal = function(meal) 
{
    this.$mealDetails.fadeIn('slow');
    var src = getWwwUrl()+'/images/meals/'+meal.Photo;
    this.$mealDetails.find('.card-title').empty().append(meal.MealName)
    this.$mealDetails.find('.card-image img').empty().attr('src', src );
    this.$mealDetails.find('p').empty().append(meal.Description);
    this.$mealDetails.find('a').empty().append('Price : '+meal.SalePrice+',00 $');
    this.$form.find('input[name=salePrice]').val(meal.SalePrice);
};


OrderForm.prototype.onClickAddMeal = function() 
{  
    // Hydration of basket session with the infos caught with  <select>
    this.basketSession.add(
                            
                            this.$meal.val(), // mealId
                            this.$mealDetails.find('.card-title').text(), // Name
                            this.$mealDetails.find('p').text(), // Description
                            this.$quantity.val(),  // Quantity
                            this.$mealDetails.find('input[name=salePrice]').val() // Price
                            ); 
                            
    this.refreshOrderSummary();
    
};

OrderForm.prototype.refreshOrderSummary = function() 
{
    var url = getRequestUrl()+'/basket';
    $.post(url, this.basketSession, this.onAjaxRefreshOrderSummary.bind(this));
};

OrderForm.prototype.onAjaxRefreshOrderSummary = function(data) 
{
    
};