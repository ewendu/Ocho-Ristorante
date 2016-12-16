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
    if(loadDataFromDomStorage('Basket') != null )
    {
        this.basketSession.items = loadDataFromDomStorage('Basket');
        if(loadDataFromDomStorage('Basket') !='')
        {
            this.refreshOrderSummary();
        }
        
    }
    
    $('#addtobasket').on('click', this.onClickAddMeal.bind(this));
    $('#order-summary').on('click','button', this.onClickRemoveItem.bind(this));
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
    this.$mealDetails.find('.card-title').empty().append(meal.MealName);
    this.$mealDetails.find('.card-image img').empty().attr('src', src );
    this.$mealDetails.find('p').empty().append(meal.Description);
    this.$mealDetails.find('a').empty().append('Price : '+meal.SalePrice+',00 $');
    $('#salePrice').val(meal.SalePrice);
};


OrderForm.prototype.onClickAddMeal = function() 
{  
    // Hydration of basket session with the infos caught with  <select>

    this.basketSession.add(
                            
                            this.$meal.val(), // mealId
                            this.$mealDetails.find('.card-title').text(), // Name
                            this.$mealDetails.find('p').text(), // Description
                            this.$quantity.val(),  // Quantity
                            $('#salePrice').val() // Price
                            ); 
    saveDataToDomStorage('Basket', this.basketSession.items);
    this.refreshOrderSummary();
    
};

OrderForm.prototype.refreshOrderSummary = function() 
{
    var formFields;
    
    formFields = {
        basketItems : this.basketSession.items
    };
    
    
    var url = getRequestUrl()+'/basket';
    $.post(url, formFields, this.onAjaxRefreshOrderSummary.bind(this));
};

OrderForm.prototype.onAjaxRefreshOrderSummary = function(table) 
{
    $('#showonclick').fadeIn('slow');
    $('#order-summary').empty().append(table);
};

OrderForm.prototype.onClickRemoveItem = function(event) 
{
    
    var currentMealId = $(event.currentTarget).data('meal-id');
    //mealId = event.currentTarget.getAttribute('data-meal-id'); // JS  solution 1
    //mealId = event.currentTarget.dataset.meal-id;              // JS  solution 2
    this.basketSession.removeItem(currentMealId);
    saveDataToDomStorage('Basket', this.basketSession.items);
    this.refreshOrderSummary();
    
};