<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Tambah Buku</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        
        if (isset($_POST['submit'])) {
            $isbn = $_POST['isbn'];
            $judul = $_POST['judul'];
            $idpengarang = $_POST['idpengarang'];
            $stok = $_POST['stok'];
            if (empty($isbn)) {
                echo "isbn harus diisi";
            } elseif (empty($judul)) {
                echo "judul harus diisi";
            } elseif (empty($idpengarang)) {
                echo "pengarang harus diisi";
            } elseif (empty($stok)) {
                echo "stok harus diisi";
            } else {
                if (isset($_FILES['gambar'])) {
                    $errors = array();
                    $file_name = trim($_FILES['gambar']['name']);
                    $file_size = $_FILES['gambar']['size'];
                    $file_tmp = $_FILES['gambar']['tmp_name'];
                    $file_type = $_FILES['gambar']['type'];
                    $file_ext = strtolower(end(explode('.', $_FILES['gambar']['name'])));
                    $expensions = array("jpeg", "jpg", "png");
                    if (in_array($file_ext, $expensions) === false) {
                        echo "file harus berupa JPEG or PNG file.";
                    } else if ($file_size > 2097152) {
                        echo 'ukuran file max 2 MB';
                    } else {
                        move_uploaded_file($file_tmp, "../image/" . $file_name);
                    }
                }
                $con = connect_db();
                $query = "INSERT INTO buku (isbn,judul,idpengarang,stok,gambar) "
                        . "VALUES ('$isbn','$judul','$idpengarang','$stok','$file_name')";
                $result = execute_query($con, $query);
                if (mysqli_affected_rows($con) != 0) {
                    header("location:index.php");
                }
            }
        }
        ?>
        <form 
            name="formtambah" 
            method="post"  
            enctype="multipart/form-data"
            id="formtambah">
            <div>
                <label for="nama">ISBN:</label>
                <input type="text" name="isbn" id="isbn"
                      required="required">
            </div>
            <div>
                <label for="judul">Judul:</label> 
                <input type="text" name="judul" id="judul" 
                       required="required" size="30">
            </div>
            <div>
                <label for="gambar">Foto:</label>
                <input type="file" name="gambar" id="gambar">
            </div>
            <div>
                <label for="role">Pengarang:</label> 
                <select name="idpengarang" id="idpengarang">
                    <?php
                    $con = connect_db();
                    $query = "SELECT * FROM pengarang";
                    $result = execute_query($con, $query);
                    while ($pengarang = mysqli_fetch_array($result)) {
                        ?>
                        <option value="<?= $pengarang['id'] ?>"><?= $pengarang['nama'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="stok">Stok:</label> 
                <input type="text" name="stok" id="stok" 
                       required="required" size="10">
            </div>
            <div>
                <input type="submit" value="Simpan" id="submit" name="submit">
            </div>
        </form>
    </main>
    <?php
    include '../fragment/footer.php';
    ?>