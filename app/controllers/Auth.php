<?php

class Auth extends Controller {
    public function index()
    {
        $this->login();
    }

    public function login()
    {
        $data['judul'] = 'Login';
        $this->view('auth/login', $data);
    }

    public function register()
    {
        $data['judul'] = 'Register';
        $this->view('auth/register', $data);
    }
}
