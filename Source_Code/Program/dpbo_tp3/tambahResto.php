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
$mainTitle = 'Tambah Data Restoran';
$btn = 'Tambah';
$title = 'Tambah';
$link = 'tambahResto.php';
 
// membuat form
$form = '
<div class="mb-3">
    <label for="name_resto" class="form-label">Nama</label>
    <input type="text" class="form-control" id="name_resto" name="name_resto" required>
</div>
';

// jika submit (add)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data to be added
    $restoData = [
        'name_resto' => $_POST['name_resto']
    ];
    
    // jika berhasil, kemudian mengarah ke halaman resto
    if ($resto->addResto($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'resto.php';
        </script>";
    } 
    // jika gagal, mengarah ke halaman yang sama
    else {
        echo "<script>
            alert('Data gagal ditambah!');
                document.location.href = 'tambahResto.php';
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