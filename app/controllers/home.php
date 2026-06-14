<?php
class home extends Controller
{
    public function index()
    {
        $svModel = $this->model('sinhvienModel');
        $lopModel = $this->model('lopModel');

        $totalSV = $svModel->countAll();
        $totalLop = $lopModel->countAll();

        $active = $svModel->countActive();

        $this->view('home/index', [
            'totalSV' => $totalSV,
            'totalLop' => $totalLop,
            'active' => $active
        ]);
    }


  public function about()
  {
    echo "Đây là trang giới thiệu";
  }
  public function login()
  {
    require_once '../app/views/home/login.php';

  }

}
