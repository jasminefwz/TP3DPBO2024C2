<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Food.php');
include('classes/Resto.php');
include('classes/Chef.php');
include('classes/Template.php');

// buat instance chef
$listChef = new Chef($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listChef->open();

// tampilkan data chef
$listChef->getChefJoin();

// cari chef
if (isset($_POST['btn-cari'])) {
    // method mencari data chef
    $listChef->searchChef($_POST['cari']);
} 
// pengurutan data
elseif (isset($_POST['btn-urut'])) {
    // pengurutan data
    $kriteria = $_POST['kriteria'];
    switch ($kriteria) {
        case 'nama_chef':
            $listChef->getChefJoinSorted('chef.name_chef');
            break;
        case 'asal_chef':
            $listChef->getChefJoinSorted('chef.asal_chef');
            break;
        case 'nama_resto':
            $listChef->getChefJoinSorted('resto.name_resto');
            break;
        default:
            $listChef->getChefJoin();
            break;
    }
} else {
    // method menampilkan data chef jika tidak ada pencarian atau pengurutan
    $listChef->getChefJoin();
}

$data = null;

// ambil data chef
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listChef->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['id_chef'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['foto_chef'] . '" class="card-img-top" alt="' . $row['foto_chef'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['name_chef'] . '</p>
                <p class="card-text divisi-nama">' . $row['asal_chef'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['name_resto'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listChef->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_CHEF', $data);
$home->write();
