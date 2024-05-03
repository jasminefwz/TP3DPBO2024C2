<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Resto.php');
include('classes/Template.php');

// buat instance restoran
$resto = new Resto($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$resto->open();

// tampilkan data makanan
$resto->getResto();

// buat instance template
$view = new Template('templates/skintabel.html');

$mainTitle = 'Restoran';

// button untuk tambah list makanan
$btn = '<a href="tambahResto.php" class="btn btn-primary mb-3">Tambah Restoran</a>';

//menampilkan tabel
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Restoran</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'restoran';

// ambil data restoran
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($div = $resto->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['name_resto'] . '</td>
    <td style="font-size: 22px;">
        <a href="updateResto.php?id=' . $div['id_resto'] . '" title="Ubah Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="resto.php?hapus=' . $div['id_resto'] . '" title="Hapus Data" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// jika klik hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // jika berhasil, kemudian mengarah ke halaman yang sama
        if ($resto->deleteResto($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'resto.php';
            </script>";
        } 
        // jika gagal, mengarah ke halaman yang sama
        else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'resto.php';
            </script>";
        }
    }
}

// tutup koneksi
$resto->close();

// simpan data ke template
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_BUTTON', $btn);
$view->write();
