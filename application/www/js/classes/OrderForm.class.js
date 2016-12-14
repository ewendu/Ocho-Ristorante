'use strict';


var OrderForm = function ()
{
    this.$form         = $('#order-form');  // Form selection
    this.$meal         = $('#meal');        // <select> selection
    this.$mealDetails  = $('#meal-details');// Container where the infos will apear selection 
  
};

OrderForm.prototype.run = function() 
{
    // Event when the user change the <select>
    this.$meal.on('change', this.onChangeMeal.bind(this));
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
    this.$mealDetails.find('a').empty().append(meal.SalePrice+',00 $');
};