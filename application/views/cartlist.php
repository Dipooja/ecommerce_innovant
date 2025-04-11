<!DOCTYPE html>
<html>
<head>
    <title>Cart Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Cart Items for User ID 1</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Added On</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($cart_items as $item): ?>
        <tr>
            <td><?= $item->name ?></td>
            <td><?= $item->price ?></td>
            <td><?= $item->quantity ?></td>
            <td><?= $item->price * $item->quantity ?></td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
