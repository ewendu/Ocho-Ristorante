<?php

class LoginController
{
    public function httpGetMethod()
    {
        // Method called when it's a get request 
        return ['showonfail'=>''];
    }
    public function httpPostMethod(Http $http, array $formFields)
    {
        try
        {
            $usermodel = new UserModel();
            $usermodel->findWithEmailPassword(  $formFields['email'], 
                                            $formFields['password']);
            return ['showonfail'=> 'You successfully loged in ! '];
        }
        catch(Exception $e)
        {
            return ['showonfail' => $e->getMessage()];
        }
        
        
    }
}