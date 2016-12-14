<?php

class ProductForm extends Form
{
    public function build()
    {
        $this->addFormField('name');
        $this->addFormField('category');
        $this->addFormField('description');
        $this->addFormField('picture');
        $this->addFormField('quantity');
        $this->addFormField('buyPrice');
        $this->addFormField('salePrice');
    }
}