<?php 

class MealModel 
{
    public function listAll()
    {
        
        
        $sql ='
                SELECT *
                FROM Meal
                ';
        $database = new Database();
        return $database->query($sql);
        
    }
    public function getMeal($mealId)
    {
        $database = new Database();
        
        $sql=
        '
            SELECT Category.Id as CategoryId, Category.Name as CategoryName, Meal.Id as MealId, Meal.Name as MealName, Description, Photo, Category_Id, SalePrice
            FROM Meal
            INNER JOIN Category
            ON Category.Id = Meal.Category_Id
            WHERE Meal.Id = ?
            
        
        ';
        
        return $database->queryOne($sql, [$mealId]);
    }
    
    public function listCategoriesForForm()
    {
        $database = new Database();
        $sql =
        '
            SELECT Id, Name
            FROM Category
        ';
       
        return  $database->query($sql);
    } 
}