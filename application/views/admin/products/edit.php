<!-- Load Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-warning text-white">
      <h4 class="mb-0">Edit Product</h4>
    </div>
    <div class="card-body">
      <form method="POST" action="<?= site_url('index.php/ProductController/update/' . $product->id) ?>" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" name="name" id="name" class="form-control" value="<?= $product->name ?>" required>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" name="price" id="price" class="form-control" value="<?= $product->price ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Current Images</label><br>
          <?php if (!empty($product_images)) : ?>
            <div class="row">
              <?php foreach ($product_images as $img) : ?>
                <div class="col-md-3 text-center mb-3">
                  <img src="<?= base_url('uploads/products/' . $img->image_path) ?>" class="img-thumbnail mb-2" width="100">
                  <a href="<?= site_url('index.php/product/delete_image/' . $img->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this image?')">Delete</a>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else : ?>
            <p>No images uploaded.</p>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label for="images" class="form-label">Add New Images (Optional)</label>
          <input type="file" name="images[]" id="images" class="form-control" multiple>
          <small class="text-muted">Upload additional images if needed.</small>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-warning px-4 py-2 text-white">Update Product</button>
        </div>
      </form>
    </div>
  </div>
</div>
