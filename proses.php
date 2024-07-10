<?php
// Include the database configuration file
include_once 'config.php'; // Pastikan file ini berisi informasi koneksi database Anda

// Class untuk mengelola proses formulir
class FormProcessor {

    // Properti
    private $db; // Koneksi database

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );
        try {
            $this->db = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new Exception("Kesalahan koneksi database: " . $e->getMessage());
        }
    }

    // Method untuk memproses pengiriman formulir
    public function processForm() {
        // Validasi dan proses pengiriman formulir
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validasi input data
            $nik = $this->validateInput($_POST['nik']);
            $nama = $this->validateInput($_POST['nama']);
            $wa = $this->validateInput($_POST['wa']);
            $email = $this->validateInput($_POST['email']);
            $alamat = $this->validateInput($_POST['alamat']);
            $permintaan = $this->validateInput($_POST['permintaan']);
            $paket = $this->validateInput($_POST['paket']);
            $tanggal_daftar = date('Y-m-d'); // Gunakan tanggal saat ini

            // Handle pengunggahan file
            $uploadResult = $this->handleFileUpload();
            if (!$uploadResult['success']) {
                $this->redirectWithError($uploadResult['message']);
            }

            $fotoktp = $uploadResult['filename'];

            // Masukkan data ke database
            $insertResult = $this->insertIntoDatabase($nik, $fotoktp, $nama, $wa, $email, $alamat, $permintaan, $paket, $tanggal_daftar);
            if (!$insertResult['success']) {
                $this->redirectWithError($insertResult['message']);
            }

            // Kirim pesan ke Telegram setelah data berhasil disimpan
            $this->sendTelegramMessage($nama, $wa, $alamat, $paket);

            // Redirect ke halaman sukses
            $this->redirectWithSuccess("Data berhasil dikirim. Terima kasih!");

        } else {
            $this->redirectWithError("Metode permintaan tidak valid.");
        }
    }

    // Method untuk mengelola pengunggahan file
    private function handleFileUpload() {
        $uploadDir = 'file/'; // Direktori tempat file akan disimpan
        $maxFileSize = 6291456; // 6MB dalam bytes

        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            return array('success' => false, 'message' => 'Gagal mengunggah file: ' . $_FILES['file']['error']);
        }

        $filename = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];

        if ($fileSize > $maxFileSize) {
            return array('success' => false, 'message' => 'Ukuran file terlalu besar (maksimal 6MB).');
        }

        $rand = rand();
        $newFilename = $rand . '_' . $filename;
        $uploadPath = $uploadDir . $newFilename;

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
            return array('success' => false, 'message' => 'Gagal memindahkan file.');
        }

        return array('success' => true, 'filename' => $newFilename);
    }

    // Method untuk validasi input data
    private function validateInput($data) {
        return htmlspecialchars(trim($data));
    }

    // Method untuk memasukkan data ke database
    private function insertIntoDatabase($nik, $fotoktp, $nama, $wa, $email, $alamat, $permintaan, $paket, $tanggal_daftar) {
        try {
            $sql = "INSERT INTO data (nik, fotoktp, nama, no_whatsapp, email, alamat, permintaan_khusus, paket, tanggal_daftar) 
                    VALUES (:nik, :fotoktp, :nama, :wa, :email, :alamat, :permintaan, :paket, :tanggal_daftar)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nik', $nik);
            $stmt->bindParam(':fotoktp', $fotoktp);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':wa', $wa);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':permintaan', $permintaan);
            $stmt->bindParam(':paket', $paket);
            $stmt->bindParam(':tanggal_daftar', $tanggal_daftar);
            $stmt->execute();

            return array('success' => true);
        } catch (PDOException $e) {
            return array('success' => false, 'message' => 'Gagal menyimpan data ke database: ' . $e->getMessage());
        }
    }

    // Method untuk mengirim pesan ke Telegram
    private function sendTelegramMessage($nama, $wa, $alamat, $paket) {
        $botToken = '7160849453:AAEoc9Jpq99DmzQOkVK6HoVjFnaU9fua15U';
        $chatId = '6001452813';
        // Pesan yang akan dikirim ke Telegram
        $message = "Pelanggan Baru Saja Mendaftar :\n\n"
                 . "Nama: $nama\n"
                 . "Nomor WhatsApp: $wa\n"
                 . "Alamat: $alamat\n"
                 . "Paket: $paket";

        // URL API Telegram untuk mengirim pesan
        $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);

        // Kirim permintaan HTTP menggunakan file_get_contents
        $result = file_get_contents($telegramUrl);

        // Cek hasil pengiriman pesan (bisa di-handle sesuai kebutuhan)
        if ($result) {
            // Jika berhasil, Anda bisa menambahkan log atau tindakan lain
            // Contoh: simpan log pengiriman pesan ke file atau database
        } else {
            // Jika gagal, bisa di-handle sesuai kebutuhan
        }
    }

    // Method untuk mengarahkan dengan pesan error
    private function redirectWithError($message) {
        header("Location: index.php?alert=error&msg=" . urlencode($message));
        exit();
    }

    // Method untuk mengarahkan dengan pesan sukses
    private function redirectWithSuccess($message) {
        header("Location: index.php?msg=" . urlencode($message));
        exit();
    }
}

// Alur eksekusi utama
try {
    $processor = new FormProcessor('localhost', 'sql_register_lln', 'sql_register_lln', 'cab8a800b3b8b');
    $processor->processForm();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
