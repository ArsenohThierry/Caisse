<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (!$username || !$password) {
            return redirect()->to('/')->with('error', 'Veuillez remplir tous les champs.');
        }

        $userModel = new User();
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['mdp'])) {
            return redirect()->to('/')->with('error', 'Identifiants incorrects.');
        }

        session()->set([
            'user_id'  => $user['id'],
            'username' => $user['username'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/home')->with('success', 'Connecté.');
    }

    public function register()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirm  = $this->request->getPost('confirm_password');

        if (!$username || !$password || !$confirm) {
            return redirect()->to('/')->with('error', 'Veuillez remplir tous les champs.');
        }

        if ($password !== $confirm) {
            return redirect()->to('/')->with('error', 'Les mots de passe ne correspondent pas.');
        }

        $userModel = new User();

        if ($userModel->where('username', $username)->first()) {
            return redirect()->to('/')->with('error', 'Ce nom d\'utilisateur existe déjà.');
        }

        $userId = $userModel->insertUser($username, $password);
        $user = $userModel->find($userId);

        session()->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/home')->with('success', 'Bienvenue !');
    }

 
}
