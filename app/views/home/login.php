<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Quản Lý Sinh Viên</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 420px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 35px 30px;
            text-align: center;
        }

        .login-header i {
            font-size: 3.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .login-body {
            padding: 40px 35px;
        }

        .form-label {
            font-weight: 600;
            color: #444;
        }

        .form-control {
            padding: 14px 16px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.15);
        }

        .input-group-text {
            background: #f8f9fa;
            border-radius: 10px 0 0 10px;
        }

        .btn-login {
            padding: 14px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .forgot-link {
            color: #667eea;
            text-decoration: none;
            font-size: 14.5px;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-graduation-cap"></i>
            <h2 class="mb-1 fw-bold">QL Sinh Viên</h2>
            <p class="mb-0">Hệ thống quản lý sinh viên & lớp học</p>
        </div>


        <div class="login-body">
            <form action="/auth/login" method="post">
                <div class="mb-4">
                    <label class="form-label">Tên đăng nhập</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="username" 
                               placeholder="Nhập tên đăng nhập" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" 
                               placeholder="Nhập mật khẩu" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ghi nhớ tôi</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-login">
                    <i class="fas fa-sign-in-alt"></i> Đăng Nhập
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">Chưa có tài khoản? 
                    <a href="#" class="text-primary fw-medium">Liên hệ quản trị viên</a>
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>