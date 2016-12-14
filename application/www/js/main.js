'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

function runFormValidation()
{
    var $form;
    
    $form = $('form:not([data-no-validation=true])');
    
    if($form.length == 1)
    {
        var formValidator = new FormValidator($form);
        formValidator.run();
    }
}

function runOrderForm()
{
    
    var orderForm = new OrderForm();
    orderForm.run();
    
}





/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(function()
{
    // Exectution of form validation
    runFormValidation();
    
    // Execution of OrderForm only if OrderForm class is defined
    if(typeof OrderForm != 'undefined')
    {
        runOrderForm();
    }
  
    
});