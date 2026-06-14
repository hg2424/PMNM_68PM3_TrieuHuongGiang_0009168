<?php

require_once '../app/core/DB.php';

class lopModel {

    private $conn;

    public function __construct() {
        $this->conn = ConnectDB::connect();
    }

    public function paging($limit, $offset, $search = '')
    {
        if (!empty($search)) {

            $sql = "SELECT * FROM lop
                    WHERE ma_lop LIKE :search
                    OR ten_lop LIKE :search
                    LIMIT :limit OFFSET :offset";

            $countSql = "SELECT COUNT(*) FROM lop
                         WHERE ma_lop LIKE :search
                         OR ten_lop LIKE :search";

            $searchParam = "%$search%";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':search', $searchParam);

            $countStmt = $this->conn->prepare($countSql);
            $countStmt->bindParam(':search', $searchParam);

        } else {

            $sql = "SELECT * FROM lop
                    LIMIT :limit OFFSET :offset";

            $countSql = "SELECT COUNT(*) FROM lop";

            $stmt = $this->conn->prepare($sql);
            $countStmt = $this->conn->prepare($countSql);
        }

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        $lops = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $countStmt->execute();

        $totalRows = $countStmt->fetchColumn();

        return [
            'lops' => $lops,
            'totalPages' => ceil($totalRows / $limit)
        ];
    }

    public function getAll()
{
    $stmt = $this->conn->prepare("
        SELECT *
        FROM lop
        ORDER BY ma_lop
    ");

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function find($id)
    {
        $sql = "SELECT * FROM lop WHERE id=:id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id',$id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
{
    // Kiểm tra mã lớp đã tồn tại chưa
    $check = $this->conn->prepare(
        "SELECT id FROM lop WHERE ma_lop = :ma_lop"
    );

    $check->execute([
        ':ma_lop' => $data['ma_lop']
    ]);

    if($check->rowCount() > 0)
    {
        return false;
    }

    $sql = "INSERT INTO lop(ma_lop, ten_lop, ghi_chu)
            VALUES(:ma_lop, :ten_lop, :ghi_chu)";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':ma_lop' => $data['ma_lop'],
        ':ten_lop' => $data['ten_lop'],
        ':ghi_chu' => $data['ghi_chu']
    ]);
}

    public function update($id,$data)
    {
        $sql = "UPDATE lop
                SET ma_lop=:ma_lop,
                    ten_lop=:ten_lop,
                    ghi_chu=:ghi_chu
                WHERE id=:id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id'=>$id,
            ':ma_lop'=>$data['ma_lop'],
            ':ten_lop'=>$data['ten_lop'],
            ':ghi_chu'=>$data['ghi_chu']
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM lop WHERE id=:id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id'=>$id
        ]);
    }
    public function countAll()
{
    $stmt = $this->conn->query("SELECT COUNT(*) FROM lop");
    return $stmt->fetchColumn();
}
}