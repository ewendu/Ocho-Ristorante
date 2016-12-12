<?php
    
class LoginController
{
	public function httpGetMethod()
	{
	    return ['showonfail' => ''];
	}
	
	public function httpPostMethod(Http $http, array $formFields)
	{
	    try
		{
    	   $userModel = new UserModel();
    	   
    	    /*$user      = $userModel->findWithEmailPassword
                (
                    $formFields['email'],
                    $formFields['password']
                );
             */   
            return ['showonfail' => 'You successfully connected !'];
		}
		catch(Exception $e)
		{
		    return ['showonfail' => $e->getMessage()];
		}
	}
	
}