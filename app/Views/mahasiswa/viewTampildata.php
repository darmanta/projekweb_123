<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->Section('isi') ?>

<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="<?= base_url() ?>/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Required datatable js -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="col-sm-12">
    <div class="page-title-box">
        <h4 class="page-title">Data Mahasiswa</h4>
    </div>
</div>

<div class="col-sm-12">
    <div class="card m-b-30">
        <div class="card-body">
            <div class="card-title">
                <button type="button" class="btn btn-primary tomboltambah">
                    <i class="bi bi-plus-circle-fill"></i> Tambah Data
                </button>
            </div>
            <p class="card-text viewdata">

            </p>
        </div>
    </div>
</div>
<div class="viewmodal" style="display:none;"></div>
<script>
    function datamahasiswa() {
        $.ajax({
            url: "<?= site_url('mahasiswa/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
    $(document).ready(function() {
        datamahasiswa();
        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('mahasiswa/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        })
    });
</script>
<?= $this->endSection() ?>