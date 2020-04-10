<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DSDG Cibiru Wetan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 60vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                SELAMAT DATANG
            </div>

            <div class="links">
                <h3>Untuk Melakukan Pengajuan Silahkan untuk mengisikan NIK dibawah ini</h3>
                <form action="">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="NIK ..." id="nik">
                    </div>
                    <button type="button" id="buttonSubmit" class="btn btn-primary">Check NIK</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="detail_card" style="display: none;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center" id="nama"></h3>

                                <p class="text-muted text-center" id="nikResult"></p>
                                <p class="text-muted text-center" id="umur"> Tahun</p>
                                <div class="text-muted text-center">
                                    <b>Alamat :</b>
                                    <p id="alamat"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Pilih Jenis Pengajuan</label>
                                    <select name="pengajuan" id="pengajuan" class="form-control">
                                        <option value="sktm">Surat Keterangan Tidak Mampu</option>
                                    </select>
                                </div>
                                <input type="hidden" id="penduduk_id">
                                <div class="form-group">
                                    <button class="btn btn-success" id="buttonPengajuan">Ajukan</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="pengajuan_card" style="display: none;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">Pengajuan Berhasil Dibuat ! Silahkan datang ke
                            kantor desa
                            dan cetak hasil pengajuan dengan memasukan NIK anda</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="pengajuan_exist" style="display: none;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">Anda Sudah Pernah Melakukan Pengajuan! Silahkan
                            Cetak Pengajuan Terlebih Dahulu Dengan Datang Ke Kantor Desa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $("#buttonSubmit").click(function () {
            var nik = $("#nik").val();

            if (nik == "") {
                Swal.fire('Oops...', 'Nik Harus Di Isi!', 'error')
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{url('/penduduk/check')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "nik": nik
                    },
                    success: function (data) {
                        if (data.status == "error") {
                            Swal.fire('Oops...', 'Nik Yang Anda Masukan Belum Terdaftar Di System!', 'error')
                        }
                        if (data.status == "success") {
                            $("#detail_card").show();
                            $("#penduduk_id").val(data.data.id);
                            $("#nikResult").html(data.data.nik);
                            $("#nama").html(data.data.nama);
                            $("#alamat").html(data.data.alamat + " RT : " + data.data.rt + " RW: " + data.data.rw + " Ds. Cibiru Wetan");
                            $("#umur").html(data.data.umur + " Tahun");
                        }
                    }
                });
            }
        });

        $("#buttonPengajuan").click(function () {
            var penduduk_id = $("#penduduk_id").val();

            $.ajax({
                type: "POST",
                url: "{{url('/pengajuan')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "penduduk_id": penduduk_id
                },
                success: function (data) {
                    if (data.status == "success") {
                        $("#pengajuan_card").show();
                    }
                    if (data.status == "exist") {
                        $("#pengajuan_exist").show();
                    }
                    if (data.status == "error") {
                        Swal.fire('Oops...', 'Terjadi Kesalahan!', 'error')
                    }
                }
            });
        });
    });
</script>

</html>