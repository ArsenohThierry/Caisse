<?php

namespace App\Controllers;

use App\Models\AchatModel;
use App\Models\AchatProduitModel;
use App\Models\Produits;

class SaisieAchatController extends BaseController
{
    public function index()
    {
        $idCaisse = (int) session()->get('idCaisse');

        if ($idCaisse <= 0) {
            return redirect()->to('/');
        }

        $produitModel = new Produits();
        $panier = session()->get('panier') ?? [];
        $total = 0;

        foreach ($panier as $item) {
            $total += ($item['qte'] ?? 0) * ($item['pu'] ?? 0);
        }

        return view('SaisieAchat', [
            'idCaisse' => $idCaisse,
            'produits' => $produitModel->findAll(),
            'panier' => $panier,
            'total' => $total,
        ]);
    }

    public function choisirCaisse()
    {
        $idCaisse = (int) $this->request->getPost('caisse');

        if ($idCaisse <= 0) {
            return redirect()->to('/home');
        }

        session()->set('idCaisse', $idCaisse);
        session()->remove('panier');

        return redirect()->to('/saisie-achat');
    }

    public function addToPanier()
    {
        $idProduit = (int) $this->request->getPost('produit');
        $qte = (int) $this->request->getPost('quantite');
        $idCaisse = (int) $this->request->getPost('idCaisse') ?: (int) (session()->get('idCaisse') ?? 0);

        if ($idCaisse <= 0 || $idProduit <= 0 || $qte <= 0) {
            return redirect()->to('/saisie-achat');
        }

        session()->set('idCaisse', $idCaisse);

        $produitModel = new Produits();
        $produit = $produitModel->find($idProduit);

        if (!$produit) {
            return redirect()->to('/saisie-achat');
        }

        $panier = session()->get('panier') ?? [];

        $panier[] = [
            'idProduit' => $idProduit,
            'label' => $produit['label'],
            'qte' => $qte,
            'pu' => (float) $produit['pu'],
        ];

        session()->set('panier', $panier);

        return redirect()->to('/saisie-achat');
    }

    public function cloturerAchat()
    {
        $idCaisse = (int) $this->request->getPost('idCaisse') ?: (int) (session()->get('idCaisse') ?? 0);
        $panier = session()->get('panier') ?? [];

        if ($idCaisse <= 0 || empty($panier)) {
            return redirect()->to('/saisie-achat');
        }

        $achatModel = new AchatModel();
        $achatProduitModel = new AchatProduitModel();

        try {
            $idAchat = $achatModel->create($idCaisse);
        } catch (\Throwable $e) {
            log_message('error', 'AchatModel::create failed: ' . $e->getMessage());
            return redirect()->to('/saisie-achat')->with('error', 'Erreur création achat: ' . $e->getMessage());
        }

        if (!$idAchat) {
            log_message('error', 'AchatModel::create returned no ID');
            return redirect()->to('/saisie-achat')->with('error', 'Erreur: aucun ID retourné');
        }

        $total = 0;

        foreach ($panier as $item) {
            $qte = (int) ($item['qte'] ?? 0);
            $pu = (float) ($item['pu'] ?? 0);
            $idProduit = (int) ($item['idProduit'] ?? 0);

            if ($idProduit <= 0 || $qte <= 0) {
                continue;
            }

            $result = $achatProduitModel->addProduit($idAchat, $idProduit, $qte);
            if (!$result) {
                log_message('error', "AchatProduitModel::addProduit failed for idAchat=$idAchat, idProduit=$idProduit");
            }
            $total += $qte * $pu;
        }

        $achatModel->updateTotal($idAchat, $total);

        session()->remove('panier');
        session()->remove('idCaisse');

        return redirect()->to('/home')->with('success', 'Achat clôturé avec succès.');
    }
}
