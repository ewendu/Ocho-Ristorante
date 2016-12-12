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
    	   
    	    $user      = $userModel->findWithEmailPassword
                (
                    $formFields['email'],
                    $formFields['password']
                );
                
                // Session creation 
            $userSession = new UserSession();
            $userSession->create(
            					$user['Id'], 
            					$user['FirstName'],
            					$user['LastName'],
            					$user['Email']
            					);
            				
            $http->redirectTo('/');
		}
		catch(Exception $e)
		{
		    return ['showonfail' => $e->getMessage()];
		}
	}
	
}