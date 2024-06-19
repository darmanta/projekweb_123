<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('mahasiswa/updatedata', ['class' => 'formmahasiswa']) ?>
            <!-- autentifikasi menjaga serangan injeksi -->
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control is-valid" id="id_mahasiswa" name="id_mahasiswa" placeholder="Masukkan NIM" value="<?= $id_mahasiswa ?>" readonly>
                        <input type="text" class="form-control is-valid" id="nim" name="nim" placeholder="Masukkan NIM" value="<?= $nim ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" value="<?= $nama ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tmplahir" class="col-sm-2 col-form-label">Tempat & Tanggal Lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control is-valid" id="tmplahir" name="tmplahir" placeholder="Masukkan Tempat Lahir" value="<?= $tmplahir ?>">
                    </div>
                    <div class="col-sm-5">
                        <input type="date" class="form-control is-valid" name="tgllahir" id="tgllahir" placeholder="Masukkan Tanggal Lahir" value="<?= $tgllahir ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select name="jenkel" id="jenkel" class="form-control is-valid">
                            <option value="L" <?php if ($jenkel == 'L') echo "selected"; ?>>Laki - Laki</option>
                            <option value="P" <?php if ($jenkel == 'P') echo "selected"; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan" id="tombolsimpan">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div class="position-fixed align-items-center" style="position :absolute;
top: 50%;
left: 50%;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <!-- <img src="..." class="rounded mr-2" alt="..."> -->
            <strong class="mr-auto">Simpan</strong>
            <!-- <small>11 mins ago</small> -->
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Data Berhasil di Simpan !!!
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formmahasiswa').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="bi bi-arrow-repeat"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Update');
                },
                success: function(response) {
                    // alert(response.sukses);
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: response.sukses,
                    });

                    // Tutup modal edit
                    $('#modaledit').modal('hide');
                    datamahasiswa();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>