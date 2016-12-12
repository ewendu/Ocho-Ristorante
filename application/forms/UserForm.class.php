<?php

class UserForm extends Form
{
    public function build()
    {
        $this->addFormField('firstname');
        $this->addFormField('lastname');
        $this->addFormField('birthdate');
        $this->addFormField('address');
        $this->addFormField('city');
        $this->addFormField('zip');
        $this->addFormField('phone');
        $this->addFormField('mail');
    }
}