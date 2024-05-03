<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Food.php');
include('classes/Template.php');

// buat instance food
$food = new Food($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$food->open();

// buat instance template
$view = new Template('templates/skinform.html');

// temp untuk data ke template
$mainTitle = 'Tambah Data Makanan';
$btn = 'Tambah';
$title = 'Tambah';
$link = 'tambahFood.php';
 
// membuat form
$form = '
<div class="mb-3">
    <label for="name_food" class="form-label">Nama</label>
    <input type="text" class="form-control" id="name_food" name="name_food" required>
</div>
';

// jika submit (add)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // prepare data to be added
    $foodData = [
        'name_food' => $_POST['name_food']
    ];

    // jika berhasil, kemudian mengarah ke halaman food
    if ($food->addFood($foodData) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'food.php';
        </script>";
    } 
    // jika gagal, mengarah ke halaman yang sama
    else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'tambahFood.php';
        </script>";
    }
}

// tutup koneksi
$food->close();

// simpan data ke template
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM', $form);
$view->replace('DATA_LINK', $link);
$view->write();