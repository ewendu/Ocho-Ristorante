<?php

class UserModel
{
    function signUp (array $values)
    {
        $sql='
                INSERT INTO 
                User
                (FirstName, LastName, Email, Password, BirthDate, Address, City, ZipCode, Country, Phone, CreationTimestamp)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW());
        ';
        $database = new Database();
        $database->executeSql($sql,$values);
    }
}