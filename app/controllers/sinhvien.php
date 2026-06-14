<?php

require_once '../app/core/controller.php';

class sinhvien extends Controller
{
   public function index()
{
    $limit = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 5;
    if ($limit <= 0) $limit = 5;

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $offset = ($page - 1) * $limit;

    $search = $_GET['search'] ?? '';
    $ma_lop = $_GET['ma_lop'] ?? '';

    $model = $this->model('sinhvienModel');
    $lopModel = $this->model('lopModel');

    $lops = $lopModel->getAll();
    $result = $model->paging($limit, $offset, $search, $ma_lop);


    $this->view("layout/masterlayout", [
        'viewname' => 'sinhvien/index',
        'sinhviens' => $result['sinhviens'],
        'totalPages' => $result['totalPages'],

        'currentPage' => $page,
        'pageSize' => $limit,   

        'search' => $search,
        'lops' => $lops,
        'ma_lop' => $ma_lop
    ]);
}

    public function create()
    {
        $this->view('sinhvien/create', [
            'title' => 'Thêm sinh viên'
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'ma_sv'     => $_POST['ma_sv'] ?? null,
                'ho_ten'    => $_POST['ho_ten'] ?? null,
                'gioi_tinh' => $_POST['gioi_tinh'] ?? null,
                'ngay_sinh' => $_POST['ngay_sinh'] ?? null,
                'dia_chi'   => $_POST['dia_chi'] ?? null,
                'ma_lop'    => $_POST['ma_lop'] ?? null
            ];

            if (empty($data['ho_ten'])) {
                $_SESSION['error'] = "Họ tên không được để trống!";
                header('Location: /sinhvien/create');
                exit();
            }

            $model = $this->model('sinhvienModel');
            $result = $model->create($data);

            if ($result) {
                $_SESSION['success'] = 'Thêm sinh viên thành công!';
                header('Location: /sinhvien/index');
                exit();
            }

            $_SESSION['error'] = 'Thêm sinh viên thất bại!';
            header('Location: /sinhvien/create');
            exit();
        }
    }

    public function delete($id)
    {
        $model = $this->model('sinhvienModel');
        $result = $model->delete($id);

        $_SESSION[$result ? 'success' : 'error'] =
            $result ? 'Xóa thành công!' : 'Xóa thất bại!';

        header('Location: /sinhvien/index');
        exit();
    }

    public function edit($id)
    {
        $model = $this->model('sinhvienModel');
        $sinhvien = $model->edit($id);

        if (!$sinhvien) {
            $_SESSION['error'] = 'Không tìm thấy sinh viên!';
            header('Location: /sinhvien/index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'ma_sv'     => $_POST['ma_sv'],
                'ho_ten'    => $_POST['ho_ten'],
                'gioi_tinh' => $_POST['gioi_tinh'],
                'ngay_sinh' => $_POST['ngay_sinh'],
                'dia_chi'   => $_POST['dia_chi'],
                'ma_lop'    => $_POST['ma_lop']
            ];

            $model->update($id, $data);

            $_SESSION['success'] = "Cập nhật thành công!";
            header('Location: /sinhvien/index');
            exit();
        }

        header('Location: /sinhvien/index');
        exit();
    }
}