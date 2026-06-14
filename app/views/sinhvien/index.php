<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Danh sách sinh viên' ?></title>

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Segoe UI', Tahoma;
            background: linear-gradient(135deg,#f5f7fa,#c3cfe2);
            padding: 30px;
        }

        h1 {
            text-align:center;
            margin-bottom:20px;
            color:#2c3e50;
        }

        table {
            width:100%;
            max-width:1200px;
            margin:auto;
            border-collapse:collapse;
            background:#fff;
            border-radius:12px;
            overflow:hidden;
        }

        th {
            background:#3498db;
            color:#fff;
            padding:12px;
        }

        td {
            padding:12px;
            border-bottom:1px solid #eee;
        }

        tr:nth-child(even){ background:#f8f9fa; }

        .btn {
            padding:6px 10px;
            border-radius:6px;
            color:white;
            text-decoration:none;
            font-size:13px;
        }

        .edit { background:#f39c12; }
        .delete { background:#e74c3c; }

        .pagination {
            text-align:center;
            margin-top:20px;
        }

        .pagination a {
            padding:8px 12px;
            margin:2px;
            text-decoration:none;
            background:#ddd;
            border-radius:5px;
            color:black;
        }

        .pagination a.active {
            background:red;
            color:white;
        }

        input, select {
            padding:6px;
        }
    </style>
</head>

<body>

<h1>Danh sách sinh viên</h1>

<?php
$page = $currentPage ?? 1;
$pageSize = $pageSize ?? 5;
$search = $search ?? '';
$ma_lop = $ma_lop ?? '';

function buildQuery($page, $search, $ma_lop, $pageSize) {
    return http_build_query([
        'page' => $page,
        'search' => $search,
        'ma_lop' => $ma_lop,
        'pageSize' => $pageSize
    ]);
}
?>

<form method="GET" style="margin-bottom:20px;display:flex;gap:10px;align-items:center;">

    <input type="text"
           name="search"
           placeholder="Tìm theo họ tên..."
           value="<?= htmlspecialchars($search) ?>">

    <select name="ma_lop" onchange="this.form.submit()">
        <option value="">Tất cả lớp</option>
        <?php foreach($lops as $lop): ?>
            <option value="<?= $lop['ma_lop'] ?>"
                <?= ($ma_lop == $lop['ma_lop']) ? 'selected' : '' ?>>
                <?= $lop['ma_lop'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="pageSize" onchange="this.form.submit()">
        <option value="5"  <?= ($pageSize == 5) ? 'selected' : '' ?>>5 / trang</option>
        <option value="10" <?= ($pageSize == 10) ? 'selected' : '' ?>>10 / trang</option>
        <option value="20" <?= ($pageSize == 20) ? 'selected' : '' ?>>20 / trang</option>
    </select>

    <button type="submit"
            style="background:#3498db;color:white;border:none;padding:8px 15px;border-radius:5px;cursor:pointer;">
        Tìm kiếm
    </button>
</form>

<table>
<thead>
<tr>
    <th>STT</th>
    <th>Mã SV</th>
    <th>Họ tên</th>
    <th>Giới tính</th>
    <th>Ngày sinh</th>
    <th>Địa chỉ</th>
    <th>Lớp</th>
    <th>Thao tác</th>
</tr>
</thead>

<tbody>

<?php foreach ($sinhviens as $index => $sv): ?>

<?php $q = buildQuery($page, $search, $ma_lop, $pageSize); ?>

<tr>
    <td><?= (($page - 1) * $pageSize) + $index + 1 ?></td>

    <td><?= htmlspecialchars($sv['ma_sv']) ?></td>
    <td><?= htmlspecialchars($sv['ho_ten']) ?></td>
    <td><?= htmlspecialchars($sv['gioi_tinh']) ?></td>
    <td><?= htmlspecialchars($sv['ngay_sinh']) ?></td>
    <td><?= htmlspecialchars($sv['dia_chi']) ?></td>
    <td><?= htmlspecialchars($sv['ma_lop']) ?></td>

    <td>
        <a class="btn edit"
           href="/sinhvien/index?<?= $q ?>&edit=<?= $sv['id'] ?>">
            Sửa
        </a>

        <a class="btn delete"
           href="/sinhvien/delete/<?= $sv['id'] ?>"
           onclick="return confirm('Xóa sinh viên?')">
            Xóa
        </a>
    </td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<div class="pagination">

<?php if ($page > 1): ?>
    <a href="/sinhvien/index?<?= buildQuery($page - 1, $search, $ma_lop, $pageSize) ?>">⬅</a>
<?php endif; ?>

<?php for ($i = 1; $i <= ($totalPages ?? 1); $i++): ?>
    <a class="<?= ($i == $page) ? 'active' : '' ?>"
       href="/sinhvien/index?<?= buildQuery($i, $search, $ma_lop, $pageSize) ?>">
        <?= $i ?>
    </a>
<?php endfor; ?>

<?php if ($page < ($totalPages ?? 1)): ?>
    <a href="/sinhvien/index?<?= buildQuery($page + 1, $search, $ma_lop, $pageSize) ?>">➡</a>
<?php endif; ?>

</div>

</body>
</html>