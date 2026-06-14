<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Quản Lý Sinh Viên</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
   <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .hero {
            background: linear-gradient(rgba(52, 152, 219, 0.85), rgba(41, 128, 185, 0.85)),
                        url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1') center/cover;
            color: white;
            padding: 100px 0 60px;
            text-align: center;
        }

        .main-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .management-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
            transition: all 0.4s ease;
            height: 100%;
            padding: 35px 25px;
        }

        .management-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.18);
        }

        .icon-circle {
            width: 85px;
            height: 85px;
            font-size: 2.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border-radius: 50%;
            color: white;
        }

        .card-sinhvien .icon-circle { background: linear-gradient(135deg, #3498db, #2980b9);
     }
        .card-lop .icon-circle { background: linear-gradient(135deg, #27ae60, #219a5f); }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-primary" href="#">
            <i class="fas fa-graduation-cap"></i> QL Sinh Viên
        </a>
        
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted">Xin chào, <strong>Admin</strong></span>
            <a href="/auth/logout" class="btn logout-btn px-4 py-2" 
               onclick="return confirm('Bạn có chắc muốn đăng xuất?')">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
        </div>
    </div>
</nav>
<section class="hero">
    <div class="container">
        <h1 class="fw-bold">Quản Lý Sinh Viên</h1>
        <p class="text-white-50">Hệ thống quản lý lớp học & sinh viên</p>
    </div>
</section>

<div class="container py-5">

    <div class="row justify-content-center g-4">

    <div class="col-lg-5 col-md-6">
        <a href="/sinhvien" class="text-decoration-none">
            <div class="main-card bg-white text-center">
                <div class="icon-circle text-primary mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <h5 class="fw-bold">Sinh Viên</h5>
                <p class="text-muted small">Quản lý sinh viên</p>
                <span class="btn btn-primary btn-sm px-4">
                    Truy cập
                </span>
            </div>
        </a>
    </div>

    <div class="col-lg-5 col-md-6">
        <a href="/lop" class="text-decoration-none">
            <div class="main-card bg-white text-center">
                <div class="icon-circle text-success mx-auto">
                    <i class="fas fa-chalkboard"></i>
                </div>
                <h5 class="fw-bold">Lớp Học</h5>
                <p class="text-muted small">Quản lý lớp học</p>
                <span class="btn btn-success btn-sm px-4">
                    Truy cập
                </span>
            </div>
        </a>
    </div>

</div>

    <div class="row mt-4 g-3 text-center stats">

    <div class="col-md-4">
        <div class="card p-3">
            <h5>Tổng SV</h5>
            <h2 class="text-primary"><?= $totalSV ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <h5>Tổng Lớp</h5>
            <h2 class="text-success"><?= $totalLop ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <h5>Hoạt động</h5>
            <h2 class="text-warning"><?= $active ?></h2>
        </div>
    </div>

</div>

</div>

<footer class="bg-white py-4 mt-5 text-center text-muted">
    <small>© 2026 Hệ thống Quản lý Sinh Viên & Lớp Học</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>