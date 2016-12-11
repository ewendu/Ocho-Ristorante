<?php

class CategoryModel
{
    public function listCategory ($id)
    {
        $sql ='
                    SELECT Meal.Name as MealName, Category.Name as CatName, Description, Photo, SalePrice
                    FROM Meal
                    INNER JOIN Category ON Meal.Category_Id = Category.Id
                  
                    WHERE Category.Id = ?
                ';
        $database = new Database();
        return $database->query($sql, [$id]);
        
    }
}