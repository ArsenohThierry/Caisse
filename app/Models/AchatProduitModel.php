<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatProduitModel extends Model
{
    protected $table            = 'AchatProduit';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idAchat', 'idProduit', 'qte'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addProduit(int $idAchat, int $idProduit, int $qte): bool
    {
        return $this->insert([
            'idAchat'   => $idAchat,
            'idProduit' => $idProduit,
            'qte'       => $qte,
        ]);
    }

    public function getByAchat(int $idAchat): array
    {
        return $this->select('AchatProduit.*, Produit.label, Produit.pu AS puProduit')
            ->join('Produit', 'Produit.id = AchatProduit.idProduit')
            ->where('AchatProduit.idAchat', $idAchat)
            ->findAll();
    }

    public function calculateTotal(int $idAchat): float
    {
        $row = $this->select('COALESCE(SUM(AchatProduit.qte * Produit.pu), 0) AS total', false)
            ->join('Produit', 'Produit.id = AchatProduit.idProduit')
            ->where('AchatProduit.idAchat', $idAchat)
            ->get()
            ->getRowArray();

        return (float) ($row['total'] ?? 0);
    }

    public function deleteByAchat(int $idAchat): bool
    {
        return $this->where('idAchat', $idAchat)->delete();
    }
}
