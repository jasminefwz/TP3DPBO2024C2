<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Food.php');
include('classes/Template.php');

// buat instance makanan
$food = new Food($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$food->open();

// tampilkan data makanan
$food->getFood();

// buat instance template
$view = new Template('templates/skintabel.html');

$mainTitle = 'Makanan';

// button untuk tambah list makanan
$btn = '<a href="tambahFood.php" class="btn btn-primary mb-3">Tambah Makanan</a>';

//menampilkan tabel
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Makanan</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'food';

// ambil data makanan
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($div = $food->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['name_food'] . '</td>
    <td style="font-size: 22px;">
    <a href="updateFood.php?id=' . $div['id_food'] . '" title="Ubah Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="food.php?hapus=' . $div['id_food'] . '" title="Hapus Data" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

// jika klik hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // jika berhasil, kemudian mengarah ke halaman yang sama
        if ($food->deleteFood($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'food.php';
            </script>";
        } 
        // jika gagal, mengarah ke halaman yang sama
        else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'food.php';
            </script>";
        }
    }
}

// tutup koneksi
$food->close();

// simpan data ke template
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_BUTTON', $btn);
$view->write();
