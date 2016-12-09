<?php

class UserModel
{
    function signUp (
        $firstName,
        $lastName,
        $birthDate,
        $address,
        $city,
        $zipCode,
        $phone,
        $email,
        $password
    )
    {
        // Request to check if the email is already in the database
        $database = new Database();
        
        
        $sql='
                SELECT Email
                FROM User
                WHERE Email = ?
        ';
        
        $user = $database->queryOne($sql, [$email]);
        
        
        // Check if the email is in the database
        if(!empty($user))
        {  
         // If it's alredy in the database lets throm an exception
          throw new Exception('Your email is already used !');
        }   
        
        $sql='
                INSERT INTO 
                User
                (FirstName, LastName, BirthDate, Address, City, ZipCode, Phone, Email, Password, CreationTimestamp)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW());
                    ';
            $database2 = new Database();
            $database2->executeSql($sql,[
                                        $firstName,
                                        $lastName,
                                        $birthDate,
                                        $address,
                                        $city,
                                        $zipCode,
                                        $phone,
                                        $email,
                                        $password
                                        ]
                                );
    }
        
        
        
}