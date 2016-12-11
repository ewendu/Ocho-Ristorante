<?php 

class CategoryController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        // Method called when it's a get request 
        $categoryModel = new CategoryModel();
        $categoryIds =  [1,2,3,4];
        if (in_array($queryFields['id'],$categoryIds)):
           $categoryResult = $categoryModel->listCategory($queryFields['id']);
            return ['categoryItems' => $categoryResult];
        else :  ['showonfail' => 'This page doesn\'t exist !'];
        endif;
        
        
    }
   
}