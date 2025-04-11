<!-- Load Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Add New Product</h4>
    </div>
    <div class="card-body">
      <form method="POST" action="<?= site_url('index.php/product/store') ?>" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" name="price" id="price" class="form-control" placeholder="Enter product price" required>
        </div>

        <div class="mb-3">
          <label for="images" class="form-label">Product Images</label>
          <input type="file" name="images[]" id="images" class="form-control" multiple required>
          <small class="text-muted">You can upload multiple images.</small>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-success px-4 py-2">Save Product</button>
        </div>
      </form>
    </div>
  </div>
</div>
