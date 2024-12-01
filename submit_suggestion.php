<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username MySQL Anda
$password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "inovasi_hijau"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$message = "";

// Memproses data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $suggestion = $_POST['suggestion'];

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO suggestions (name, email, suggestion) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $suggestion);

    if ($stmt->execute()) {
        $message = "Saran berhasil disimpan! Silakan masukkan data lainnya.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Suggestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="img/logo.svg" type="image/x-icon">
    <style>
        .transparent-bg {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 40px;
            cursor: pointer;
        }
        .navbar-custom {
            background-color: #004d4d;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-navbar">
        <div class="container">
            <a class="navbar-brand" href="html.html">
                <img src="img/logo.jpeg" alt="Logo" style="height: 60px; margin-right: 20px; border-radius: 50%;">
                Inovasi Hijau
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="html.html"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="project.html">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="suggestions.html"><i class="fas fa-lightbulb"></i> Suggestions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_suggestions.php"><i class="fas fa-eye"></i> View Suggestions</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-5">
        <section class="text-justify transparent-bg position-relative">
            <span class="close-btn" onclick="window.history.back();">×</span>
            <h1 class="mb-4 text-center">Submit Suggestion</h1>
            <?php if ($message): ?>
                <div class="alert alert-info text-center">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            <!-- Form -->
            <form action="submit_suggestion.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="suggestion" class="form-label">Suggestion</label>
                    <textarea class="form-control" id="suggestion" name="suggestion" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&copy; 2024 Inovasi Hijau. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
