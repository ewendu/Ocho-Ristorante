<?php

class AdminModel
{
    public function getCategorysForForm()
    {
        $database = new Database();
        $sql =
        '
            SELECT Id, Name
            FROM Category
        ';
       
        return  $database->query($sql);
    }
    
    public function saveProduct(
            $name,
            $category,
            $description,
            $picture,
            $quantityInStock,
            $buyPrice,
            $salePrice
        )
    {
        // Request to check if the name of the product is not in the database
        $database = new Database();
        $sql = 
        '
            SELECT Name
            FROM Meal
            WHERE Name = ?
        ';
        $productName = $database->queryOne($sql, [$name]);
        
        if(!empty($productName) == true)
        {
            throw new DomainException('Your product is already registered');
        }
        
        $database = new Database();
        $sql =
        '
            INSERT INTO
                Meal(Name, Category_Id, Description, Photo, QuantityInStock, BuyPrice, SalePrice)
            VALUES 
                (?, ?, ?, ?, ?, ?, ?);
        
        ';
        $database->executeSql($sql,
        [
            $name,
            $category,
            $description,
            $picture,
            $quantityInStock,
            $buyPrice,
            $salePrice
            
        ]);
       $flashBag = new FlashBag();
       $flashBag->add('Your product has been saved');
    }
}