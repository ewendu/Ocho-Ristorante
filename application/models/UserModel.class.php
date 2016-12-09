<?php

class UserModel
{
    function signUp (array $values)
    {
        $sql='
                INSERT INTO 
                User
                (FirstName, LastName, BirthDate, Address, City, ZipCode, Phone, Email, Password, CreationTimestamp)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW());
        ';
        $database = new Database();
        $database->executeSql($sql,$values);
    }
}