<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Lớp Học</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: none;
        }
        .table th {
            background-color: #f1f3f5;
        }
        .btn-action {
            font-size: 0.9rem;
        }
        .modal-header {
            background-color: #4361ee;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-chalkboard-teacher"></i> QUẢN LÝ LỚP
        </h2>
        <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#lopModal">
            <i class="fas fa-plus"></i> Thêm lớp mới
        </button>
    </div>

    <div class="card mb-4">
        <div class="card-body">
           <form method="GET" class="row g-3 align-items-center">
    <div class="col-md-6">
        <input type="text" 
               name="search" 
               class="form-control form-control-lg"
               placeholder="Tìm theo mã lớp hoặc tên lớp..."
               value="<?= htmlspecialchars($search ?? '') ?>">
    </div>

    <div class="col-md-2">
        <select name="pageSize" class="form-select form-control-lg"
                onchange="this.form.submit()">

            <option value="5"  <?= ($pageSize ?? 5) == 5 ? 'selected' : '' ?>>5 /trang</option>
            <option value="10" <?= ($pageSize ?? 5) == 10 ? 'selected' : '' ?>>10 /trang</option>
            <option value="20" <?= ($pageSize ?? 5) == 20 ? 'selected' : '' ?>>20 /trang</option>

        </select>
    </div>

    <div class="col-md-4">
        <button type="submit" class="btn btn-primary btn-lg w-100">
            <i class="fas fa-search"></i> Tìm kiếm
        </button>
    </div>

</form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="80">ID</th>
                            <th>Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Ghi chú</th>
                            <th width="180" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($lops)): ?>
                            <?php foreach($lops as $lop): ?>
                            <tr>
                                <td class="fw-bold text-muted"><?= $lop['id'] ?></td>
                                <td><strong><?= htmlspecialchars($lop['ma_lop']) ?></strong></td>
                                <td><?= htmlspecialchars($lop['ten_lop']) ?></td>
                                <td><?= htmlspecialchars($lop['ghi_chu'] ?? '') ?></td>
                                <td class="text-center">
                                    <a href="?edit=<?= $lop['id'] ?>" 
                                       class="btn btn-warning btn-sm btn-action">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="/lop/delete/<?= $lop['id'] ?>" 
                                       class="btn btn-danger btn-sm btn-action"
                                       onclick="return confirm('Bạn có chắc muốn xóa lớp này?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                    Không có dữ liệu
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if($totalPages > 1): ?>
    <div class="d-flex justify-content-center mt-4">
        <nav>
            <ul class="pagination">
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search ?? '') ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>

</div>
<div class="modal fade" id="lopModal" tabindex="-1" aria-labelledby="lopModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lopModalLabel">
                    <?= isset($editLop) && $editLop ? 'Cập nhật lớp' : 'Thêm lớp mới' ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form method="POST" 
                  action="<?= isset($editLop) && $editLop ? '/lop/update/' . $editLop['id'] : '/lop/create' ?>">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Mã lớp <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="ma_lop" 
                               class="form-control"
                               value="<?= $editLop['ma_lop'] ?? '' ?>"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">Tên lớp <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="ten_lop" 
                               class="form-control"
                               value="<?= $editLop['ten_lop'] ?? '' ?>"
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium">Ghi chú</label>
                        <textarea name="ghi_chu" 
                                  class="form-control" 
                                  rows="4"><?= $editLop['ghi_chu'] ?? '' ?></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> 
                        <?= isset($editLop) && $editLop ? 'Cập nhật' : 'Lưu lớp' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
<?php if(isset($editLop) && $editLop): ?>
document.addEventListener("DOMContentLoaded", function() {
    const modal = new bootstrap.Modal(document.getElementById('lopModal'));
    modal.show();
});
<?php endif; ?>
</script>

</body>
</html>