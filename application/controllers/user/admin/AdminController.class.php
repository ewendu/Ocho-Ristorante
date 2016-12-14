<?php

class AdminController
{
    
    public function httpGetMethod()
    {
        $adminModel = new AdminModel();
        $categorysInfo  = $adminModel->getCategorysForForm();
        return ['categorys' => $categorysInfo];
    }
    public function httpPostMethod(Http $http, array $formFields)
    {   // Inserting into database with signUp() method of UserModel object
    	
    	try
    	{
    	    $adminModel = new AdminModel();
    	    
    	    $adminModel->saveProduct
    	    (
    	        $formFields['name'],
    	        $formFields['category'],
    	        $formFields['description'],
    	        $formFields['picture'],
    	        $formFields['quantity'],
    	        $formFields['buyPrice'],
    	        $formFields['salePrice']
    	    );
    	    
    	    $http->redirectTo('/');
    	}
    	catch (DomainException $e)
    	{
    	   $productSaveForm = new ProductForm();
    	   $productSaveForm->bind($formFields);
    	   $productSaveForm->setErrorMessage($e->getMessage());
    	   return ['_form' => $productSaveForm];
    	   
    	}
    	// Redirect to homepage
    	
    } 
}