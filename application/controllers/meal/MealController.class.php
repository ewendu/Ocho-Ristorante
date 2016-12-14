<?php



class MealController
{
    public function httpGetMethod(Http $http, array $queryFields)
	{
	    if(array_key_exists('id', $queryFields) == true)
	    {
	        if(ctype_digit($queryFields['id']) == true)
	        {
	            $mealModel    = new MealModel();
        	    $currentMeal  = $mealModel->getMeal($queryFields['id']);
        	    $http->sendJsonResponse($currentMeal);
	        }
	    }
	    
	    $http->redirectTo('/');
	} 
    

    
}