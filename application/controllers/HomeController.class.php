<?php

class HomeController
{
    public function httpGetMethod()
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
    	 $mealModel = new MealModel();
    	 $mealsresults = $mealModel->listAll();
    	 $queryResults = array
    	 ( 
    	     'meals'    => $mealsresults,
    	     'flashBag' => new FlashBag
    	 );
    	 return $queryResults;
    	 
    
    }


}








// Correspondance entre URL et controller = rooting 
// Il va falloir creer des controller pour chaques pages du site 
// La méthode qui est executée dans le controler doit retourner un 
// tableau associatif dont les clés vont être transformés en variables 
// dans la vue








    /*public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	
    } */
    