<?php
// Memanggil file koneksi.php untuk membuat koneksi
include 'koneksi.php';

// Mengecek apakah di URL ada nilai GET idDosen
if (isset($_GET['idDosen'])) {
    // Ambil nilai idDosen dari URL dan disimpan dalam variabel $id
    $id = $_GET["idDosen"];

    // Menyiapkan pernyataan prepared statement
    $stmt = $link->prepare("SELECT * FROM t_dosen WHERE idDosen = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();

    // Mendapatkan hasil
    $result = $stmt->get_result();

    // Mengecek apakah query gagal
    if (!$result) {
        die("Query Error: " . $stmt->errno . " - " . $stmt->error);
    }

    // Mengambil data dari database dan membuat variabel-variabel untuk menampung data
    // Variabel ini nantinya akan ditampilkan pada form
    $data = $result->fetch_assoc();
    $idDosen = $data["idDosen"];
    $namaDosen = $data["namaDosen"];
    $noHP = $data["noHP"];
} else {
    // Apabila tidak ada data GET id, akan di-redirect ke viewdosen.php
    header("location:viewdosen.php");
}
?>
<!-- <!DOCTYPE html>
<html>
<head>
    <style>
        h1 {
            text-align: center;
        }
        .container{
            width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Edit Data</h1>
    <div class="container">
        <form id="form_mahasiswa" action="proses_editdosen.php" method="post">
            
            <fieldset>
                <legend>Edit Data Dosen</legend>
                <p>
                    <label for="idDosen">ID : </label>
                    <input type="hidden" name="idDosen" value="<?php echo $idDosen; ?>">
                    <input type="text" name="idDosenDisabled" id="idDosenDisabled" value="<?php echo $idDosen ?>" disabled >
                </p>
                <p>
                    <label for="namaDosen">Nama Dosen : </label>
                    <input type="text" name="namaDosen" id="namaDosen" value="<?php echo $namaDosen ?>">
                </p>
                <p>
                    <label for="noHP">No HP : </label>
                    <input type="text" name="noHP" id="noHP" value="<?php echo $noHP ?>">
                </p>
            </fieldset>
            <p>
                <input type="submit" name="edit" value="Update Data">
            </p>
        </form>
    </div>    
</body>
</html>
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Data Dosen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="min-vh-100 align-items-center justify-content-center row">
            <div class="col-md-5">
                <a href="./dashboard.php">
                    <img src="./top-logo.png" alt="Logo Politeknik" height="48px" class="d-block mx-auto" />
                </a>

                <div class="card mt-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3>Edit Lecturers</h3>

                        <a href="./viewdosen.php" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-body">

                        <form id="form_mahasiswa" action="proses_editdosen.php" method="post">
                            <fieldset>
                                <legend>Input Data Dosen</legend>
                                <div class="form-group mb-3">
                                    <label for="nama">ID Dosen : </label>
                                    <input type="text" name="idDosenDisabled" id="idDosenDisabled" value="<?php echo $idDosen ?>" disabled class="form-control" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Dosen : </label>
                                    <input type="text" name="namaDosen" value="<?php echo $namaDosen ?>" id="namaDosen" class="form-control" />
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="ipk">Nomor HP :</label>
                                    <input type="text" name="noHP" value="<?php echo $noHP ?>" id="noHP" class="form-control" placeholder="Contoh : 081222333444">
                                </div>
                            </fieldset>
                            <p>
                                <input type="submit" name="input" value="Simpan" class="btn btn-primary" />
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

