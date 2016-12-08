<?php 

class MealModel 
{
    function listAll()
    {
        
        
        $sql ='
                SELECT *
                FROM Meal
                ';
        $database = new Database();
        return $database->query($sql);
        
    }
}