<?php

class lop extends Controller
{
    public function index()
{
    $limit = 5;

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    if($page < 1){
        $page = 1;
    }

    $offset = ($page - 1) * $limit;

    $search = $_GET['search'] ?? '';

    $model = $this->model('lopModel');

    $result = $model->paging($limit,$offset,$search);

    $editLop = null;

    if(isset($_GET['edit']))
    {
        $editLop = $model->find($_GET['edit']);
    }

    $this->view("layout/masterlayout",[
        'viewname'=>'lop/index',
        'lops'=>$result['lops'],
        'totalPages'=>$result['totalPages'],
        'currentPage'=>$page,
        'search'=>$search,

        'editLop'=>$editLop
    ]);
}

    public function create()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $model = $this->model('lopModel');

        $result = $model->create($_POST);

        if(!$result)
        {
            echo "<script>
                    alert('Mã lớp đã tồn tại!');
                    history.back();
                  </script>";
            exit;
        }

        header("Location: ?url=lop");
        exit;
    }
}

    public function edit($id)
    {
        $model = $this->model('lopModel');

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $model->update($id,$_POST);

            header("Location: /lop");
            exit;
        }

        $lop = $model->find($id);

        $this->view("layout/masterlayout",[
            'viewname'=>'lop/edit',
            'lop'=>$lop
        ]);
    }

    public function delete($id)
    {
        $model = $this->model('lopModel');

        $model->delete($id);

        header("Location: /lop");
        exit;
    }
}