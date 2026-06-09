<?php
    require_once  '../app/core/DB.php';

    class sinhvienModel {
        private $conn;

        public function __construct() {
           $this->conn = ConnectDB::connect();
        }
        public function getAllSinhVien() {
            $query = "SELECT * FROM sinhvien";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
       public function create($data) {
    $query = "INSERT INTO sinhvien 
    (ma_sv, ho_ten, gioi_tinh, ngay_sinh, dia_chi, lop)
    VALUES (:ma_sv, :ho_ten, :gioi_tinh, :ngay_sinh, :dia_chi, :lop)";

    $stmt = $this->conn->prepare($query);

    $ok = $stmt->execute([
        ':ma_sv' => $data['ma_sv'],
        ':ho_ten' => $data['ho_ten'],
        ':gioi_tinh' => $data['gioi_tinh'],
        ':ngay_sinh' => $data['ngay_sinh'],
        ':dia_chi' => $data['dia_chi'],
        ':lop' => $data['lop']
    ]);

    if (!$ok) {
        echo "SQL ERROR:<br>";
        print_r($stmt->errorInfo());
        die;
    }

    return $ok;
}

      public function paging($limit = 5, $offset = 0, $search = '')
{
    $query = "SELECT * FROM sinhvien 
              WHERE ho_ten LIKE :search
              ORDER BY id ASC
              LIMIT :limit OFFSET :offset";

    $stmt = $this->conn->prepare($query);

    $stmt->bindValue(':search', "%$search%");
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $count = $this->conn->prepare("SELECT COUNT(*) FROM sinhvien WHERE ho_ten LIKE :search");
    $count->bindValue(':search', "%$search%");
    $count->execute();

    $totalRecords = $count->fetchColumn();
    $totalPages = ceil($totalRecords / $limit);

    return [
        'sinhviens' => $result,
        'totalPages' => $totalPages
    ];
}
}

?>