<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Food.php');
include('classes/Resto.php');
include('classes/Chef.php');
include('classes/Template.php');

// buat instance chef
$chef = new Chef($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$chef->open();

$data = nulL;

// ambil data chef berdasarkan id yang dipilih
// gabungkan dgn tag html
// untuk di passing ke skin/template
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $chef->getChefById($id);
        $row = $chef->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['name_chef'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto_chef'] . '" class="img-thumbnail" alt="' . $row['foto_chef'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['name_chef'] . '</td>
                                </tr>
                                <tr>
                                    <td>Asal</td>
                                    <td>:</td>
                                    <td>' . $row['asal_chef'] . '</td>
                                </tr>
                                <tr>
                                    <td>No. Telp</td>
                                    <td>:</td>
                                    <td>' . $row['telp_chef'] . '</td>
                                </tr>
                                <tr>
                                    <td>Makanan</td>
                                    <td>:</td>
                                    <td>' . $row['name_food'] . '</td>
                                </tr>
                                <tr>
                                    <td>Restoran</td>
                                    <td>:</td>
                                    <td>' . $row['name_resto'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="UpdateChef.php?id=' . $row['id_chef'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['id_chef'] . ' " onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

// jika klik hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // jika berhasil, kemudian mengarah ke halaman index
        if ($chef->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } 
        // jika gagal, mengarah ke halaman yang sama
        else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'detail.php';
            </script>";
        }
    }
}

// tutup koneksi
$chef->close();

// buat instance template
$detail = new Template('templates/skindetail.html');

// simpan data ke template
$detail->replace('DATA_DETAIL_CHEF', $data);
$detail->write();
