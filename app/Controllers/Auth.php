<?php

namespace App\Controllers;


use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function auth():RedirectResponse
    {
        $pass   = $this->request->getVar("pass");
        if($pass == "AFC2024MelGU")
            $this->session->set("auth",true);
        else
            $this->session->setFlashdata("","неверный пароль");

        return redirect()->to(base_url("/"));
    }
    public function exit():RedirectResponse
    {
        $this->session->destroy();
        return redirect()->to(base_url("/"));
    }

}