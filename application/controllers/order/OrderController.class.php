<?php

class OrderController
{
    public function httpGetMethod(Http $http)
	{
	    // Checking if the user is connected
	   $userSession = new UserSession();
	   if($userSession->isAuthenticated() == false)
	   {
	       $http->redirectTo('/user/login');
	   }
	   
	   // Getting mealslist infos from the data base
	   $mealModel = new MealModel();
	   
	   $meals = $mealModel->listAll();
	   
	   // Returning mealsinfo for the view
	   return ['meals' => $meals];

	}
	
   
   
}