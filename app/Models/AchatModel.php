<?php

class AchatModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function create(int $idCaisse): int
    {
        $sql = "INSERT INTO Achat (idCaisse) VALUES (:idCaisse)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':idCaisse' => $idCaisse
        ]);

        return (int)$this->db->lastInsertId();
    }

    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM Achat WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM Achat ORDER BY dateAchat DESC";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTotal(int $idAchat, float $total): bool
    {
        $sql = "UPDATE Achat SET total = :total WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':total' => $total,
            ':id' => $idAchat
        ]);
    }
}