<?php


class LogoutController 
{
    public function httpGetMethod(Http $http)
    {
        $userSession = new UserSession();
        if($userSession->isAuthenticated())
        {
            $userSession->destroy();
        }
        $http->redirectTo('/');
    }
}