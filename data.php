<?php
session_start();

if (!isset($_SESSION['username'])) {
    $botToken = '7160849453:AAEoc9Jpq99DmzQOkVK6HoVjFnaU9fua15U';
    $chatId = '6001452813';
    $message = "Ada upaya akses tanpa autentikasi pada halaman data pelanggan!";
    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);

    file_get_contents($telegramUrl);

    header("Location: login.php?error=Anda Harus Seorang Admin...!");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Berlangganan Internet - ALLNet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
            text-transform: uppercase;
        }

        .table td {
            font-size: 14px;
            color: #666;
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

        @media screen and (max-width: 600px) {
            .table {
                border: 0;
            }

            .table thead {
                display: none;
            }

            .table tr {
                margin-bottom: 10px;
                display: block;
                border-bottom: 2px solid #ddd;
            }

            .table td {
                display: block;
                text-align: right;
                font-size: 13px;
            }

            .table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
        .msg{
                font-size: 20px;
                color: red;
                align-content: center;
                padding: 10px;
                margin-bottom: 20px;
            }
            .reload{
                font-size: 18;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: green;
                padding: 10px;
            }
            .fotoktp{
                width: 80%;
                height: 80%;
            }
            .navbar {
                overflow: hidden;
                background-color: #333;
                padding: 15px 20px;
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
    </style>
</head>
<body>
    <div class="navbar">
        <a href="logout.php" style="float:right">Keluar</a>
        <button class="btn btn--radius-2 btn--green" onclick="refreshPage()" a href>Refresh Data</button>
    </div>

    <div class="container">
        <h2>Data Berlangganan Internet - ALLNet</h2>
        <div class="table-wrapper"><h3 class="msg"><?php ini_set('display_errors', 0); $pesan = $_GET['msg']; echo $pesan; ?></h3></div>
        <div class="table-wrapper">
            <table class="table">
                <colgroup>
                    <col style="width: 5%;">
                    <col style="width: 10%;">
                    <col style="width: 15%;">
                    <col style="width: 10%;">
                    <col style="width: 15%;">
                    <col style="width: 15%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK KTP</th>
                        <th>Foto KTP</th>
                        <th>Nama</th>
                        <th>No WhatsApp</th>
                        <th>E-Mail</th>
                        <th>Alamat</th>
                        <th>Permintaan Khusus</th>
                        <th>Pilihan Paket</th>
                        <th>Tanggal Daftar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $host = 'localhost';
                    $database = 'sql_register_lln';
                    $username = 'sql_register_lln';
                    $password = 'cab8a800b3b8b';

                    $conn = new mysqli($host, $username, $password, $database);
                    if ($conn->connect_error) {
                        die("Koneksi ke database gagal: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM data";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nik']; ?></td>
                                <td><a href="file/<?php echo $row['fotoktp']; ?>"><img class="fotoktp" src='file/<?php echo $row['fotoktp']; ?>'></a></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['no_whatsapp']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['alamat']; ?></td>
                                <td><?php echo $row['permintaan_khusus']; ?></td>
                                <td><?php echo $row['paket']; ?></td>
                                <td><?php echo $row['tanggal_daftar']; ?></td>
                                <td><a href="hapus.php?nik=<?php echo $row['nik']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data, <?php echo $row['nama']; ?> ...!')">Hapus</a></td>
                            </tr>
                        <?php }
                    } else {
                        echo "<tr><td colspan='10'>Tidak ada data yang ditemukan</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
