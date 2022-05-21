<?php

namespace App\Controller;

class AdminController extends AppController
{

    public function initialize(): void
    {
    }

    public function index()
    {
        $this->autoRender = false;
        print_r($this->Admins);
        echo "Welcome to admin controller";
    }
}
