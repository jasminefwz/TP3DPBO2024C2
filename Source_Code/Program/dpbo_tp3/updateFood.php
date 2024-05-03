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
$mainTitle = 'Ubah Data Makanan';
$btn = 'Simpan';
$title = 'Ubah';
$link = 'updateFood.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // mengambil id food
        $food->getFoodById($id);
        $row = $food->getResult();

        // temp untuk mengambil data yang sudah ada
        $dataUpdate = $row['name_food'];

        // membuat form yang terdapat input hidden id
        $form = '
        <input type="hidden" name="id" value="' . $id . '">
        <div class="mb-3">
            <label for="name_food" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name_food" name="name_food" value="' . $dataUpdate . '" required>
        </div>
        ';

        // simpan data ke template
        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

// jika submit (update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // prepare data to be added
    $foodData = [
        'name_food' => $_POST['name_food']
    ];

    // jika berhasil, kemudian mengarah ke halaman food
    if ($food->updateFood($_POST['id'], $foodData) > 0) {
        echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'food.php';
        </script>";
    } 
    // jika gagal, mengarah ke halaman food
    else {
        echo "<script>
            alert('Data gagal diubah!');
            document.location.href = 'food.php';
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