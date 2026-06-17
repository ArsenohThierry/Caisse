<?php

namespace App\Controllers;

use App\Models\Produits;
use App\Models\Caisse;
use App\Models\AchatModel;
use App\Models\AchatProduitModel;

class ListeController extends BaseController
{
    public function produits()
    {
        $produitModel = new Produits();
        $produits = $produitModel->findAll();

        return view('ListeProduits', [
            'produits' => $produits,
        ]);
    }

    public function achats()
    {
        $caisseModel = new Caisse();
        $caisses = $caisseModel->findAll();

        $idCaisse = (int) $this->request->getGet('caisse');
        $achats = [];

        if ($idCaisse > 0) {
            $achatModel = new AchatModel();
            $achatProduitModel = new AchatProduitModel();
            $achats = $achatModel->where('idCaisse', $idCaisse)->orderBy('dateAchat', 'DESC')->findAll();

            foreach ($achats as &$achat) {
                $achat['produits'] = $achatProduitModel->getByAchat($achat['id']);
            }
            unset($achat);
        }

        return view('ListeAchats', [
            'caisses' => $caisses,
            'idCaisse' => $idCaisse,
            'achats' => $achats,
        ]);
    }
}
