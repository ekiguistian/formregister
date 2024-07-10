<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Berlangganan Internet</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .center {
            text-align: center;
            margin-bottom: 20px;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f3f4f6;
        }

        .wrapper {
            width: 100%;
            max-width: 680px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-body {
            padding: 40px;
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #333333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group .label {
            display: block;
            font-size: 14px;
            color: #666666;
            margin-bottom: 8px;
        }

        .input-group .input--style-4,
        .input-group .radio-group {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333333;
            box-sizing: border-box;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .radio-group input[type="radio"] {
            margin-right: 10px;
        }

        .input-group .input--style-4::placeholder {
            color: #999999;
        }

        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            padding: 12px 30px;
            text-align: center;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            border: none;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Responsiveness */
        @media screen and (max-width: 768px) {
            .wrapper {
                border-radius: 0;
            }

            .card-body {
                padding: 20px;
            }

            .title {
                font-size: 20px;
                margin-bottom: 20px;
            }
            
        }
        .msg{
                font-size: 20px;
                color: red;
                align-content: center;
                padding: 10px;
                margin-bottom: 20px;
            }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="https://allnet.id/">Beranda</a>
        <a href="https://allnet.id/#pricing">Paket Internet</a>
        <a href="login.php?alert=error&msg=Anda harus login dulu...!" style="float:right">Form Admin</a>
    </div>

    <div class="page-wrapper">
        <div class="wrapper">
            <div class="card-body">
                <div class="input-group"><h3 class="msg"><?php ini_set('display_errors', 0); $pesan = $_GET['msg']; echo $pesan; ?></h3></div>
                <h2 class="title">Formulir Berlangganan Internet Allnet.id</h2>
                <form method="POST" action="proses.php" enctype="multipart/form-data">
                    <div class="input-group">
                        <label class="label">NIK KTP</label>
                        <input class="input--style-4" type="number" name="nik" required minlength="15" placeholder="3602xxxxx">
                    </div>
                    <div class="input-group">
                        <label class="label">Foto KTP</label>
                        <p>*maksimal ukuran 6MB</p>
                        <input class="input--style-4" type="file" name="file" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Nama Sesuai KTP</label>
                        <input class="input--style-4" type="text" name="nama" required placeholder="Carles Babage">
                    </div>
                    <div class="input-group">
                        <label class="label">No. WhatsApp Aktif</label>
                        <input class="input--style-4" type="number" placeholder="628xxxxx" name="wa" required minlength="10">
                    </div>
                    <div class="input-group">
                        <label class="label">E-mail Aktif</label>
                        <input class="input--style-4" type="email" name="email" required placeholder="carlesbabage@gmail.com">
                    </div>
                    <div class="input-group">
                        <label class="label">Alamat Lengkap</label>
                        <input class="input--style-4" type="text" name="alamat" required placeholder="Jl. jendral Sudirman, G. Mawar. RT.001/002">
                    </div>
                    <div class="input-group">
                        <label class="label">Permintaan Khusus</label>
                        <input class="input--style-4" type="text" name="permintaan" placeholder="jadwalkan pemasangan pada hari Minggu." required>
                    </div>
                    <div class="input-group">
                        <label class="label">Pilih Paket Sesuai Kebutuhan Anda.</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="paket" value="Family Package 25 Mbps - Rp. 225.000" required>
                                Family Package 25 Mbps - Rp. 225.000
                            </label>
                            <label>
                                <input type="radio" name="paket" value="Games Package 50 Mbps - Rp. 465.000" required>
                                Games Package 50 Mbps - Rp. 465.000
                            </label>
                            <label>
                                <input type="radio" name="paket" value="Business Package 100 Mbps - Rp. 675.000" required>
                                Business Package 100 Mbps - Rp. 675.000
                            </label>
                        </div>
                    </div>
                    <button class="btn btn--radius-2 btn--green" type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim formulir..!')">Kirim Formulir</button>
                   
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>
    <script src="js/global.js"></script>
</body>
</html>
