'use strict';

var FormValidator = function($form)
{
    
    this.$form            = $form; 
    this.$errorMessage    = this.$form.find('#error-message'); 
    this.$totalErrorCount = this.$form.find('#total-error-count');  
    
    
    this.totalErrors = null;
};

FormValidator.prototype.run = function()
{
    this.$form.on('submit', this.onSubmitForm.bind(this));   
};

FormValidator.prototype.onSubmitForm = function(event)
{
    var $errorList;
    
    
    $errorList = this.$form.find('#error'); 
            
    $errorList.empty();
    
    
    this.totalErrors = new Array();
    
    this.checkRequiredFields();
    

    this.$form.data('validation-error-count', this.totalErrors.length);
    
    if(this.totalErrors.length > 0)
    {
        this.totalErrors.forEach(function(error)
        {
            var message;
            
            message = 'Field <em><strong>' + error.fieldName + '</strong></em> '+ error.message + '.<br>';
            
            $errorList.append(message);
        });
        
        this.$totalErrorCount.text(this.totalErrors.length);
        
        this.$errorMessage.fadeIn('slow');
        
        event.preventDefault(); 
    }
};

FormValidator.prototype.checkRequiredFields = function()
{
    var errors;
    
    errors = new Array();
    
    this.$form.find('[data-required]').each(function()
    {
        var value;
        
        value = $(this).val().trim();
        
        if(value.length == 0)
        {
            errors.push(
                {
                    fieldName : $(this).data('name'),
                    message   : 'is required'
                }    
            );
        }
    });
    
    $.merge(this.totalErrors, errors);
    
};