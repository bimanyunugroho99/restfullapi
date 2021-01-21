<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="container">
        <?php foreach ($property as $data) : ?>
            <div class="col">
                <div class="col-md-6">
                    <div class="card my-4">
                        <h5 class="card-header"><?= $data['nama_property']; ?></h5>
                        <div class="card-body">
                            <img src="http://localhost/restfullapi/rest_server/public/assets/uploads/<?= $data['gambar']; ?>" class="img-thumbnail" alt="...">
                            <h5 class="card-title"><?= $data['harga_property']; ?></h5>
                            <a href="property/detail/<?= $data['slug']; ?>" class="btn btn-primary">Detail</a>
                            <a href="<?= $data['slug']; ?>" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>