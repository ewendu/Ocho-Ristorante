<?php 

class UserController
{
    public function httpGetMethod()
    {
        // Method called when it's a get request 
    }
    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
    	 
    	 
    	 
    	$usermodel = new UserModel();
    	$usermodel->signUp(/*I need to put my forms values here*/);
    } 
}