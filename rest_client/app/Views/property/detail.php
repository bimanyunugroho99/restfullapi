<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="container">
        <div class="col">
            <div class="col-md-6">
                <div class="card my-4">
                    <h5 class="card-header"><?= $property['nama_property']; ?></h5>
                    <div class="card-body">
                        <h6 class="card-title"><?= $property['slug']; ?></h6>
                        <h5 class="card-title"><?= $property['harga_property']; ?></h5>
                        <img src="http://localhost/restfullapi/rest_server/public/assets/uploads/<?= $property['gambar']; ?>" class="img-thumbnail" alt="...">
                        <a href="/" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>