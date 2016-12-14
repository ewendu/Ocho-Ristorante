<?php

class UserSession 
{
    
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        };
        
    }
    
    public function create($userId, $firstName, $lastName, $email, $admin)
    {
        // User session construction 
       $_SESSION['user'] = 
       [
           'UserId'    => $userId,
           'FirstName' => $firstName,
           'LastName'  => $lastName,
           'Email'     => $email,
           'Admin'     => $admin
           
        ];
        
    }
    
    public function destroy()
    {
        if(session_status() == PHP_SESSION_ACTIVE)
        {
            $_SESSION = array();
            session_destroy();
        }
    }
    
    public function isAuthenticated()
    {
       if(array_key_exists('user',$_SESSION))
       {
           if(!empty($_SESSION['user']))
           {
               return true;
           }
       }
       return false;
    }
    public function isAdmin()
    {
        if(!empty($_SESSION['user']) &&  $_SESSION['user']['Admin'] == true)
        {
            return true;
        }
        return false;
    }
    public function getUserId()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['UserId'];
    }
    
    public function getFirstName()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['FirstName'];
    }
    
    public function getLastName()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['LastName'];
    }
    
    public function getEmail()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['Email'];
    }
    
    public function getFullName()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }
        return $_SESSION['user']['FirstName'].' '.$_SESSION['user']['LastName'];
    }
    
}