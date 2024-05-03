<?php

//extends class db karena akan ada proses crud yang diambil dari database agar lebih memudahkan
class Resto extends DB
{
    //mengambil semua data resto dari database
    function getResto()
    {
        $query = "SELECT * FROM resto
        ORDER BY resto.name_resto ASC";

        //memanggil fungsi dari db untuk eksekusi query
        return $this->execute($query);
    }

    //mengambil data resto berdasarkan id tertentu (lebih spesifik)
    function getRestoById($id)
    {
        $query = "SELECT * FROM resto WHERE id_resto=$id";
        //memanggil fungsi dari db untuk eksekusi query
        return $this->execute($query);
    }

    //method untuk menambahkan data resto baru ke dalam database
    function addResto($data)
    {
        $nama = $data['name_resto'];
        $query = "INSERT INTO resto VALUES('', '$nama')";
        //memanggil fungsi dari db untuk eksekusi query
        return $this->executeAffected($query);
    }

    //method untuk mengubah data resto yang sudah ada di dalam database
    function updateResto($id, $data)
    {
        $nama = $data['name_resto'];
        $query = "UPDATE resto SET name_resto='$nama' WHERE id_resto=$id";
        //memanggil fungsi dari db untuk eksekusi query
        return $this->executeAffected($query);
    }

    //method untuk menghapus data resto dari database berdasarkan id tertentu
    function deleteResto($id)
    {
        //cek apakah id resto masih digunakan dalam data chef
        $queryChef = "SELECT COUNT(*) as total FROM chef WHERE id_resto = $id";
        $this->execute($queryChef);
        $rowChef = $this->getResult();
        $chefCount = $rowChef['total'];

        //jika id resto masih digunakan dalam data chef, kembalikan pesan kesalahan
        if ($chefCount > 0) {
            echo "<script>alert('Restoran tidak dapat dihapus karena masih digunakan dalam data chef.');</script>";
            return false;
        }
        else{
            $query = "DELETE FROM resto WHERE id_resto=$id";
            //memanggil fungsi dari db untuk eksekusi query
            $this->executeAffected($query);
            return true;
        }
    }
}
