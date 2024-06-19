<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('mahasiswa/simpandata', ['class' => 'formmahasiswa']) ?>
            <!-- autentifikasi menjaga serangan injeksi -->
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="nim" name="nim" placeholder="Masukkan NIM">
                        <div class="valid-feedback errornim">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control is-valid" id="nama" name="nama" placeholder="Masukkan Nama Lengkap">
                        <div class="valid-feedback errornama">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tmplahir" class="col-sm-2 col-form-label">Tempat & Tanggal Lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control is-valid" id="tmplahir" name="tmplahir" placeholder="Masukkan Tempat Lahir">
                        <div class="valid-feedback errortmplahir">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <input type="date" class="form-control is-valid" name="tgllahir" id="tgllahir" placeholder="Masukkan Tanggal Lahir">
                        <div class="valid-feedback errortgllahir">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select name="jenkel" id="jenkel" class="form-control is-valid">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <div class="valid-feedback errorjenkel">
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan" id="tombolsimpan">Simpan</button>
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
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    // Validasi
                    if (response.error) {
                        if (response.error.nim) {
                            $('#nim').addClass('is-invalid');
                            $('.errornim').html(response.error.nim);
                        } else {
                            $('#nim').removeClass('is-invalid');
                            $('.errornim').html('');
                        }

                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errornama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errornama').html('');
                        }

                        if (response.error.tmplahir) {
                            $('#tmplahir').addClass('is-invalid');
                            $('.errortmplahir').html(response.error.tmplahir);
                        } else {
                            $('#tmplahir').removeClass('is-invalid');
                            $('.errortmplahir').html('');
                        }

                        if (response.error.tgllahir) {
                            $('#tgllahir').addClass('is-invalid');
                            $('.errortgllahir').html(response.error.tgllahir);
                        } else {
                            $('#tgllahir').removeClass('is-invalid');
                            $('.errortgllahir').html('');
                        }

                        if (response.error.jenkel) {
                            $('#jenkel').addClass('is-invalid');
                            $('.errorjenkel').html(response.error.jenkel);
                        } else {
                            $('#jenkel').removeClass('is-invalid');
                            $('.errorjenkel').html('');
                        }
                    } else {
                        // Jika valid
                        // alert(response.sukses);
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.sukses,
                        });

                        // Tutup modal tambah
                        $('#modaltambah').modal('hide');
                        // panggil fungsi data mahasiswa yang berada pada view tampil data
                        datamahasiswa();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
</script>