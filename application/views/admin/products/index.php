<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Product List</h2>
        <a href="<?= site_url('index.php/product/create') ?>" class="btn btn-success">+ Add New Product</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Images</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p->name) ?></td>
                <td>₹<?= number_format($p->price, 2) ?></td>
                <td>
                    <?php
                    $images = $this->db->get_where('product_images', ['product_id' => $p->id])->result();
                    foreach ($images as $img): ?>
                        <img src="<?= base_url($img->image_path) ?>" width="60" class="img-thumbnail me-2 mb-2">
                    <?php endforeach; ?>
                </td>

                <td>
                        <a href="<?= site_url('index.php/ProductController/edit/'.$p->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= site_url('index.php/ProductController/delete/'.$p->id) ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure to delete this product?')">Delete</a>
                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
