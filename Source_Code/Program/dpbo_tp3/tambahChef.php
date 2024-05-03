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

// buat instance template
$view = new Template('templates/skinform.html');

// temp untuk data ke template
$mainTitle = 'Tambah Data Chef';
$btn = 'Tambah';
$title = 'Tambah';
$link = 'tambahChef.php';

// membuat instance dari kelas Food dan Resto
$listfood = new Food($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listresto = new Resto($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// membuka koneksi ke database
$listfood->open();
$listresto->open();

// mengambil data makanan dan resto
$foods = $listfood->getFoodArray();
$restos = $listresto->getRestoArray();

// menutup koneksi ke database
$listfood->close();
$listresto->close();

// membuat pilihan makanan dalam dropdown select
$options_food = '<option value="" selected disabled> </option>';
foreach ($foods as $food) {
    $options_food .= '<option value="' . $food['id_food'] . '">' . $food['name_food'] . '</option>';
}

// membuat pilihan resto dalam dropdown select
$options_resto = '<option value="" selected disabled> </option>';
foreach ($restos as $resto) {
    $options_resto .= '<option value="' . $resto['id_resto'] . '">' . $resto['name_resto'] . '</option>';
}
 
// membuat form dengan dropdown makanan dan restoran
$form = '
<div class="mb-3">
    <label for="foto_chef" class="form-label">Foto</label>
    <input type="file" class="form-control" id="foto_chef" name="foto_chef" accept="image/*" required>
</div>
<div class="mb-3">
    <label for="name_chef" class="form-label">Nama</label>
    <input type="text" class="form-control" id="name_chef" name="name_chef" required>
</div>
<div class="mb-3">
    <label for="asal_chef" class="form-label">Asal</label>
    <input type="text" class="form-control" id="asal_chef" name="asal_chef" required>
</div>
<div class="mb-3">
    <label for="telp_chef" class="form-label">No. Telp</label>
    <input type="text" class="form-control" id="telp_chef" name="telp_chef" required>
</div>
<label for="food" class="form-label">Makanan yang dibuat</label>
<div class="mb-3">
    <select class="form-control" id="food" name="food" required>
    ' . $options_food . '
    </select>
</div>
<label for="resto" class="form-label">Restoran tempat bekerja</label>
<div class="mb-3">
    <select class="form-control" id="resto" name="resto" required>
    ' . $options_resto . '
    </select>
</div>
';

// jika submit (add)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // handle file upload
    $file = $_FILES['foto_chef']['name'];
    // proses upload foto
    $path = 'assets/images/' . basename($_FILES['foto_chef']['name']);
    move_uploaded_file($_FILES['foto_chef']['tmp_name'], $path);
    
    // prepare data to be added
    $chefData = [
        'name_chef' => $_POST['name_chef'],
        'asal_chef' => $_POST['asal_chef'],
        'telp_chef' => $_POST['telp_chef'],
        'id_food' => $_POST['food'],
        'id_resto' => $_POST['resto']
    ];

    // jika berhasil, kemudian mengarah ke halaman index
    if ($chef->addData($chefData, $file) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'index.php';
        </script>";
    } 
    // jika gagal, mengarah ke halaman yang sama
    else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'tambahChef.php';
        </script>";
    }
}

// tutup koneksi
$chef->close();

// simpan data ke template
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM', $form);
$view->replace('DATA_LINK', $link);
$view->write();
