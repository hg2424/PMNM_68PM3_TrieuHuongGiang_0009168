<?php
require_once '../app/core/DB.php';

class sinhvienModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::connect();
    }

    public function paging($limit, $offset, $search = '', $ma_lop = '')
{
    $where = "WHERE 1=1";
    $params = [];

    if ($search !== '') {
        $where .= " AND ho_ten LIKE :search";
        $params[':search'] = "%$search%";
    }

    if ($ma_lop !== '') {
        $where .= " AND ma_lop = :ma_lop";
        $params[':ma_lop'] = $ma_lop;
    }

    // DATA
    $sql = "SELECT * FROM sinhvien $where ORDER BY id ASC LIMIT :limit OFFSET :offset";
    $stmt = $this->conn->prepare($sql);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countSql = "SELECT COUNT(*) FROM sinhvien $where";
    $count = $this->conn->prepare($countSql);

    foreach ($params as $key => $value) {
        $count->bindValue($key, $value);
    }

    $count->execute();
    $total = $count->fetchColumn();

    return [
        'sinhviens' => $data,
        'totalPages' => ceil($total / $limit)
    ];
}

    public function create($data)
    {
        $sql = "INSERT INTO sinhvien 
                (ma_sv, ho_ten, gioi_tinh, ngay_sinh, dia_chi, ma_lop)
                VALUES (:ma_sv, :ho_ten, :gioi_tinh, :ngay_sinh, :dia_chi, :ma_lop)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM sinhvien WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function edit($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM sinhvien WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE sinhvien SET 
                ma_sv = :ma_sv,
                ho_ten = :ho_ten,
                gioi_tinh = :gioi_tinh,
                ngay_sinh = :ngay_sinh,
                dia_chi = :dia_chi,
                ma_lop = :ma_lop
                WHERE id = :id";

        $data[':id'] = $id;

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function countAll()
{
    $stmt = $this->conn->query("SELECT COUNT(*) FROM sinhvien");
    return $stmt->fetchColumn();
}
public function countActive()
{
    $stmt = $this->conn->query("SELECT COUNT(*) FROM sinhvien");
    return $stmt->fetchColumn();
}
}