<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Detail Buku</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        if (isset($_GET['id'])) {
            $con = connect_db();
            $id = $_GET['id'];
            $query = "SELECT * FROM buku INNER JOIN pengarang ON pengarang.id=buku.idpengarang WHERE buku.id='$id'";
            $result = execute_query($con, $query);
            $data = mysqli_fetch_array($result);
            ?>
        <table>
             <tr>
                <th>ISBN</th>
                <td><?= $data['isbn'] ?></td>
            </tr>
            <tr>
                <th>Judul</th>
                <td><?= $data['judul'] ?></td>
            </tr>
             <tr>
                <th>Gambar</th>
                <td><img src='../image/<?= $data['gambar'] ?>' width="100" height="100"></td>
            </tr>
            <tr>
                <th>Pengarang</th>
                <td><?= $data['nama'] ?></td>
            </tr>
            <tr>
                <th>Stok</th>
                <td><?= $data['stok'] ?></td>
            </tr>
        </table>
        <?php
        }else{
            header("location:index.php");
        }
        ?>
    </main>
    <?php include '../fragment/footer.php'; ?>