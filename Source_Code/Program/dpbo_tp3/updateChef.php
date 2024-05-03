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
$mainTitle = 'Ubah Data Chef';
$btn = 'Simpan';
$title = 'Ubah';
$link = 'updateChef.php';
 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // mengambil id chef
        $chef->getChefById($id);
        $row = $chef->getResult();

        // temp untuk mengambil data yang sudah ada
        $namaChef = $row['name_chef'];
        $asalChef = $row['asal_chef'];
        $telpChef = $row['telp_chef'];
        $selectedFoodId = $row['id_food'];
        $selectedRestoId = $row['id_resto'];
        
        // membuat instance dari kelas Food dan Resto
        $food = new Food($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
        $resto = new Resto($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

        // membuka koneksi ke database
        $food->open();
        $resto->open();

        // mengambil data makanan dan restoran
        $foods = $food->getFoodArray();
        $restos = $resto->getRestoArray();

        // menutup koneksi ke database
        $food->close();
        $resto->close();

        // membuat pilihan makanan dalam dropdown select
        $options_food = '';
        foreach ($foods as $food) {
            $selected = ($food['id_food'] == $selectedFoodId) ? 'selected' : '';
            $options_food .= '<option value="' . $food['id_food'] . '" ' . $selected . '>' . $food['name_food'] . '</option>';
        }

        // membuat pilihan resto dalam dropdown select
        $options_resto = '';
        foreach ($restos as $resto) {
            $selected = ($resto['id_resto'] == $selectedRestoId) ? 'selected' : '';
            $options_resto .= '<option value="' . $resto['id_resto'] . '" ' . $selected . '>' . $resto['name_resto'] . '</option>';
        }

        // membuat form yang terdapat input hidden id
        $form = '
        <input type="hidden" name="id" value="' . $id . '">
        <div class="mb-3">
            <label for="foto_chef" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto_chef" name="foto_chef" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="name_chef" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name_chef" name="name_chef" value="' . $namaChef . '" required>
        </div>
        <div class="mb-3">
            <label for="asal_chef" class="form-label">Asal</label>
            <input type="text" class="form-control" id="asal_chef" name="asal_chef" value="' . $asalChef . '" required>
        </div>
        <div class="mb-3">
            <label for="telp_chef" class="form-label">No. Telp</label>
            <input type="text" class="form-control" id="telp_chef" name="telp_chef" value="' . $telpChef . '" required>
        </div>
        <div class="mb-3">
            <label for="food" class="form-label">Makanan yang dibuat</label>
            <select class="form-control" id="food" name="food" required>
                ' . $options_food . '
            </select>
        </div>
        <div class="mb-3">
            <label for="resto" class="form-label">Restoran tempat bekerja</label>
            <select class="form-control" id="resto" name="resto" required>
                ' . $options_resto . '
            </select>
        </div>
        ';
        
        // simpan data ke template
        $view->replace('DATA_VAL_NAMA', $namaChef);
        $view->replace('DATA_VAL_ASAL', $asalChef);
        $view->replace('DATA_VAL_TELP', $telpChef);
    }
}

// jika submit (update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // periksa apakah pengguna mengunggah foto baru
    if ($_FILES['foto_chef']['name'] != '') {
        // jika ada, upload foto baru
        $photo = $_FILES['foto_chef']['name'];
        $path = 'assets/images/' . basename($_FILES['foto_chef']['name']);
        move_uploaded_file($_FILES['foto_chef']['tmp_name'], $path);
        
        // prepare data to be added
        $chefData = [
            'foto_chef' => $_FILES['foto_chef']['name'],
            'name_chef' => $_POST['name_chef'],
            'asal_chef' => $_POST['asal_chef'],
            'telp_chef' => $_POST['telp_chef'],
            'id_food' => $_POST['food'],
            'id_resto' => $_POST['resto']
        ];
    }
    else{
        // prepare data to be added
        $chefData = [
            'name_chef' => $_POST['name_chef'],
            'asal_chef' => $_POST['asal_chef'],
            'telp_chef' => $_POST['telp_chef'],
            'id_food' => $_POST['food'],
            'id_resto' => $_POST['resto']
        ];
    }

    // jika berhasil, kemudian mengarah ke halaman index
    if ($chef->updateData($_POST['id'], $chefData) > 0) {
        echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'index.php';
        </script>";
    } else {
        // jika gagal, mengarah ke halaman index
        echo "<script>
            alert('Data gagal diubah!');
            document.location.href = 'index.php';
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
