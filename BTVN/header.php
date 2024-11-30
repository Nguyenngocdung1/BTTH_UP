<!DOCTYPE html>
<html>
<head>
    <title>Trang Sản Phẩm</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .navbar {
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            background-color: #fff !important;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .nav-link {
            color: #333 !important;
            margin: 0 1rem;
        }

        .nav-link:hover {
            color: #007bff !important;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            text-align: center;
        }

        main {
            padding: 20px 0;
        }

        h1 {
            text-align: center; /* Căn giữa tiêu đề chính */
            margin-bottom: 20px;
            color: #333;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: left; /* Căn trái tiêu đề phụ nếu cần */
        }
        .product-header {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        /* Phần tiêu đề */
        .product-header span {
            display: block;
            text-align: left; /* Căn trái */
            padding-left: 11px; /* Đảm bảo khoảng cách trái đồng đều */
        }


        /* Đảm bảo chiều cao các dòng */
        .product-header, .product-item {
           display: grid;
           grid-template-columns: 3fr 2fr 1fr 1fr; /* Chia tỷ lệ các cột */
           align-items: center; /* Căn giữa theo chiều dọc */
           padding: 10px 0; /* Khoảng cách giữa các dòng */
        }


        .product-list {
            list-style: none;
            padding: 0;
            text-align: left; /* Giữ danh sách sản phẩm ở đầu dòng */
        }

        .product-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold; /* Chữ đậm cho sản phẩm */
            
        }
        

        .price-tag {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block; /* Giữ kích thước phù hợp */
            transform: translateX(-40px);
        
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .action-icons {
            font-size: 18px;
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .action-icons.edit {
            color: #007bff;
            transform: translateX(-235px);
        }

        .action-icons.delete {
            color: #dc3545;
            transform: translateX(-115px);
        }

        .action-icons:hover.edit {
            background-color: #e9f5ff;
        }

        .action-icons:hover.delete {
            background-color: #fdecea;
        }

        .add-product {
            margin-left: 0;
            text-align: left;
        }

        .add-product .btn {
            font-size: 16px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .add-product .btn:hover {
            background-color: #218838;
        }


        .pagination {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }

        .pagination a {
            text-decoration: none;
            color: #007bff;
            padding: 5px 10px;
            margin: 0 5px;
        }

        .pagination a:hover {
            background-color: #f0f0f0;
            border-radius: 3px;
        }

        .pagination span {
           padding: 5px 10px;
           background-color: #007bff;
           color: white;
           border-radius: 3px;
           margin: 0 5px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">TLU</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto"> <!-- Thêm ms-auto để đẩy menu sang phải -->
        <a class="nav-link" href="#">Trang chủ</a>
        <a class="nav-link" href="#">Sản phẩm</a>
        <a class="nav-link" href="#">Liên hệ</a>
      </div>
    </div>
  </div>
</nav>
    <div class="container">