<?php
class UserSessionFilter implements InterceptingFilter
{
    public function run(Http $http, array $queryFields, array $formFields)
    {
        $userSession = new UserSession();
        return ['userSession' => $userSession];
    }
}





















// La classe UserSessionFilter "implémente" l'interface InterceptingFilter qui définit le comportement d'un filtre