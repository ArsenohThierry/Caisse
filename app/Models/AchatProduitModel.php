<?php

class AchatProduitModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // ajoyuter un produit à un achat
    public function addProduit(int $idAchat, int $idProduit, int $qte, float $pu): bool
    {
        $sql = "INSERT INTO AchatProduit (idAchat, idProduit, qte, pu)
                VALUES (:idAchat, :idProduit, :qte, :pu)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':idAchat' => $idAchat,
            ':idProduit' => $idProduit,
            ':qte' => $qte,
            ':pu' => $pu
        ]);
    }

    // get tout les prodits d'un achat avec label 
    public function getByAchat(int $idAchat): array
    {
        $sql = "
            SELECT ap.*, p.label
            FROM AchatProduit ap
            JOIN Produit p ON p.id = ap.idProduit
            WHERE ap.idAchat = :idAchat
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':idAchat' => $idAchat]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // total achat : somme des (qte * pu) pour tous les produits d'un achat
    public function calculateTotal(int $idAchat): float
    {
        $sql = "
            SELECT SUM(qte * pu) AS total
            FROM AchatProduit
            WHERE idAchat = :idAchat
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':idAchat' => $idAchat]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (float)($result['total'] ?? 0);
    }

    //delete tout les produits d'un achat
    public function deleteByAchat(int $idAchat): bool
    {
        $sql = "DELETE FROM AchatProduit WHERE idAchat = :idAchat";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([':idAchat' => $idAchat]);
    }
}