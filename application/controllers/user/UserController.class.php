<?php 

class UserController
{
    public function httpGetMethod()
    {
        // Method called when it's a get request 
        return ['_form' => new UserForm()];
    }
    public function httpPostMethod(Http $http, array $formFields)
    {   // Inserting into database with signUp() method of UserModel object
    	
    	try
    	{
    	    $usermodel = new UserModel();
        	$usermodel->signUp(
        	        $formFields['firstname'],
        	        $formFields['lastname'],
        	        $formFields['birthdate'], 
        	        $formFields['address'], 
        	        $formFields['city'], 
        	        $formFields['zip'], 
        	        $formFields['phone'], 
        	        $formFields['mail'], 
        	        $formFields['password']);
        	        $http->redirectTo('/');
    	}
    	catch (Exception $e)
    	{
    	    $signupForm = new UserForm();
    	    $signupForm->bind($formFields);
    	    $signupForm->setErrorMessage($e->getMessage());
    	    return ['_form' => $signupForm];
    	}
    	// Redirect to homepage
    	
    } 
}