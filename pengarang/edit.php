<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Tambah Pengarang</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $id = $_POST['id'];
            if (empty($nama)) {
                echo "nama harus diisi";
            } elseif (empty($email)) {
                echo "email divisi harus diisi";
            } else {
                $con = connect_db();
                $query = "UPDATE pengarang SET nama='$nama',email='$email' WHERE id='$id'";
                $result = execute_query($con, $query);
                if (mysqli_affected_rows($con) != 0) {
                    header("location:index.php");
                }
            }
        }else if (isset($_GET['id'])) {
            $con = connect_db();
            $id = $_GET['id'];
            $query = "SELECT * FROM pengarang WHERE id='$id'";
            $result = execute_query($con, $query);
            $data = mysqli_fetch_array($result);
        } else {
            header("location:index.php");
        }
        ?>
        <form 
            name="formtambah" 
            method="post" 
            id="formtambah">
             <input type="hidden" name="id" id="id" 
                   value="<?= $id ?>">
            <div>
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" 
                        value="<?= $data['nama'] ?>"
                       size="50" required="required">
            </div>
            <div>
                <label for="telpon">Email:</label> 
                <input type="text" name="email" id="email" 
                        value="<?= $data['email'] ?>"
                       required="required" size="30">
            </div>
            <div>
                <input type="submit" value="Simpan" id="submit" name="submit">
            </div>
        </form>
    </main>
    <?php
    include '../fragment/footer.php';
    ?>