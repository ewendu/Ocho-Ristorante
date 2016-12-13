<?php
class UserModel
{
    
    // Method used when a user want to sign up 
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
                    
        $passwordHash = $this->hashPassword($password);
            $database = new Database();
            $database->executeSql($sql,[
                                        $firstName,
                                        $lastName,
                                        $birthDate,
                                        $address,
                                        $city,
                                        $zipCode,
                                        $phone,
                                        $email,
                                        $passwordHash
                                        ]
                                );
        $flashBag = new FlashBag();
        $flashBag->add('Your account has been created');
    }
    
    // Method when the user want to log in 
    
    function findWithEmailPassword($email,$password)
    {
        $database = new Database();
        $sql='
                SELECT Id, LastName, FirstName, Email, Password
                FROM User
                WHERE Email = ? 
            ';
        $userinfo = $database->queryOne($sql, [$email]);
        if(empty($userinfo) || $this->verifyPassword($password, $userinfo['Password']) == false)
        {
           throw new Exception('Wrong password or email address !');
        }
        $this->updateLoginTimestamp($userinfo['Id']);
        return $userinfo;
        
    }
    
    
    private function verifyPassword($password, $hashPassword)
    {
        return  crypt($password, $hashPassword) == $hashPassword;
    }
    
    private function updateLoginTimestamp($userId)
    {
        $database = new Database();
        $sql= '
                    UPDATE User SET  
                         LastLoginTimestamp = NOW()
                    WHERE User.Id = ?
                ';
        $database->executeSql($sql,[$userId]);
        
        
    }
    private function hashPassword($password)
    {
        $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)),0,22);
        return crypt($password, $salt);
    }
        
        
}


