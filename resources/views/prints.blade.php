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
                <h3>Print Pengajuan Silahkan untuk mengisikan NIK dibawah ini</h3>
                <form action="">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="NIK ..." id="nik">
                    </div>
                    <button type="button" id="buttonSubmit" class="btn btn-primary">Check</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="print_card" style="display: none;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            Hai <b id="nama"></b> Anda Telah Melakukan Pengajuan <b id="nama_pengajuan"></b> Pada Tanggal <b id="tanggal"></b> Silahkan klik tombol dibawah ini untuk mencetak pengajuan anda
                            <br><br><button class="btn btn-primary" id="cetak_pengajuan">Cetak Pengajuan</button>
                        </span>
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
                    url: "{{url('/pengajuan/check')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "nik": nik
                    },
                    success: function (data) {
                        if (data.status == "error") {
                            Swal.fire('Oops...', data.message, 'error')
                        }
                        if (data.status == "success") {
                            $("#print_card").show();
                            $("#nama").html(data.data.nama);
                            $("#nama_pengajuan").html(data.data.nama_pengajuan);
                            $("#tanggal").html(data.data.tanggal);
                        }
                    }
                });
            }
        });
    });
    $("#cetak_pengajuan").click(function () {
        var url = "{{url('/pdf')}}/"+$("#nik").val();
        window.open(url, '_blank');
    });
</script>

</html>