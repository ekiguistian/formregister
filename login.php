<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login - Cek Data</title>
    <style>
        /* Global Styles */
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

        /* Wrapper Styles */
        .wrapper {
            width: 100%;
            max-width: 680px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 20px; /* Margin top added for spacing */
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

        /* Input Styles */
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

        .input-group .input--style-4::placeholder {
            color: #999999;
        }

        /* Button Styles */
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

        /* Navbar Styles */
        .navbar {
            background-color: #333;
            overflow: hidden;
            padding: 15px 20px; /* Padding adjusted for spacing */
            display: flex;
            justify-content: space-between; /* Space between links */
        }

        .navbar a {
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

        /* Responsive Styles */
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
        .salah{
            color: red;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="https://allnet.id">Beranda</a>
        <a class="back-button" href="index.php">Kembali</a>
    </div>

    <!-- Login Form Container -->
    <div class="page-wrapper">
        <div class="wrapper">
            <div class="card-body">
                <h2 class="title">Login Admin</h2>
                <h2 class="salah"><?php ini_set('display_errors', 0); $pesan = $_GET['error']; echo $pesan; ?></h2>
                <form action="process_login.php" method="POST">
                    <div class="input-group">
                        <label for="username" class="label">Username</label>
                        <input type="text" id="username" name="username" class="input--style-4" required>
                    </div>
                    <div class="input-group">
                        <label for="password" class="label">Password</label>
                        <input type="password" id="password" name="password" class="input--style-4" required>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <hr/>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
