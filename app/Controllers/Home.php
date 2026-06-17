<?php

namespace App\Controllers;

use App\Models\Caisse;
use App\Models\Produits;

class Home extends BaseController
{
    public function index(): string
    {
        // get tous les caisses
        $caisseModel = new Caisse();
        $caisses = $caisseModel->findAll();
        $data = [];
        $data['caisses'] = $caisses;
        return view('PageAccueuil',$data);
    }

    public function formAchats(){
        // get l'idCaisse
         $idCaisse = $this->request->getPost('caisse');
         $produitModel = new Produits();
         $produits = $produitModel->findAll();  
         $data = [];
         $data['idCaisse'] = $idCaisse;
         $data['produits'] = $produits;
        return view('SaisieAchat',$data);
    }
}
