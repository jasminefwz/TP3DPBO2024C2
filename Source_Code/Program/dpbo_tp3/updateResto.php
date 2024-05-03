<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Resto.php');
include('classes/Template.php');

// buat instance resto
$resto = new Resto($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$resto->open();

// buat instance template
$view = new Template('templates/skinform.html');

// temp untuk data ke template
$mainTitle = 'Ubah Data Restoran';
$btn = 'Simpan';
$title = 'Ubah';
$link = 'updateResto.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // mengambil id resto
        $resto->getRestoById($id);
        $row = $resto->getResult();

        // temp untuk mengambil data yang sudah ada
        $dataUpdate = $row['name_resto'];

        // membuat form yang terdapat input hidden id
        $form = '
        <input type="hidden" name="id" value="' . $id . '">
        <div class="mb-3">
            <label for="name_resto" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name_resto" name="name_resto" value="' . $dataUpdate . '" required>
        </div>
        ';

        // simpan data ke template
        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

// jika submit (update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // prepare data to be added
    $restoData = [
        'name_resto' => $_POST['name_resto']
    ];

    // jika berhasil, kemudian mengarah ke halaman resto
    if ($resto->updateResto($_POST['id'], $restoData) > 0) {
        echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'resto.php';
        </script>";
    } 
    // jika gagal, kemudian mengarah ke halaman resto
    else {
        echo "<script>
            alert('Data gagal diubah!');
            document.location.href = 'updateResto.php?id=$id';
        </script>";
    }
}

// tutup koneksi
$resto->close();

// simpan data ke template
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM', $form);
$view->replace('DATA_LINK', $link);
$view->write();