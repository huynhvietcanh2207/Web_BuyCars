<!DOCTYPE html>
<html>
<head>
    <title>Sản phẩm mới ra mắt</title>
</head>
<body>
    <h1>Chào bạn nhá!</h1>
    <p>Chúng tôi rất vui thông báo rằng sản phẩm mới đã được thêm:</p>
    <h2>Sản phẩm : {{ $product->name }}</h2>
    <p>Giá: {{ $product->price }}</p>
    <p>Mô tả: {{ $product->description }}</p>
    <p>Hãy ghé thăm website để xem thêm!</p>
</body>
</html>
