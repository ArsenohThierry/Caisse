<?php

namespace App\Controllers;

use App\Models\Caisse;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login/login');
    }

    public function formAchats(){
        // get l'idCaisse
         $idCaisse = $this->request->getPost('caisse');
         $data = [];
         $data['idCaisse'] = $idCaisse;
        return view('SaisieAchat',$data);
    }

       public function accueuil(){
        // get tous les caisses
        $caisseModel = new Caisse();
        $caisses = $caisseModel->findAll();
        $data = [];
        $data['caisses'] = $caisses;
        return view('PageAccueuil',$data);
    }
}
