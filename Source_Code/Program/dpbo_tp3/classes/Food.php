<?php

//extends class db karena akan ada proses crud yang diambil dari database agar lebih memudahkan
class Food extends DB
{
    //mengambil semua data makanan dari database
    function getFood()
    {
        $query = "SELECT * FROM food
        ORDER BY food.name_food ASC";
        
        //memanggil fungsi dari db untuk eksekusi query
        return $this->execute($query);
    }

    //mengambil data makanan berdasarkan id tertentu (lebih spesifik)
    function getFoodById($id)
    {
        $query = "SELECT * FROM food WHERE id_food=$id";
        //memanggil fungsi dari db untuk eksekusi query
        return $this->execute($query);
    }

    //method untuk menambahkan data makanan baru ke dalam database
    function addFood($data)
    {
        $nama = $data['name_food'];
        $query = "INSERT INTO food VALUES('', '$nama')";
        //memanggil fungsi dari db untuk eksekusi query
        return $this->executeAffected($query);
    }

    //method untuk mengubah data makanan yang sudah ada di dalam database
    function updateFood($id, $data)
    {
        $nama = $data['name_food'];
        $query = "UPDATE food SET name_food='$nama' WHERE id_food=$id";
        //memanggil fungsi dari db untuk eksekusi query
        return $this->executeAffected($query);
    }

    //method untuk menghapus data makanan dari database berdasarkan id tertentu
    function deleteFood($id)
    {
        //cek apakah id food masih digunakan dalam data chef
        $queryChef = "SELECT COUNT(*) as total FROM chef WHERE id_food = $id";
        $this->execute($queryChef);
        $rowChef = $this->getResult();
        $chefCount = $rowChef['total'];

        //jika id food masih digunakan dalam data chef, kembalikan pesan kesalahan
        if ($chefCount > 0) {
            echo "<script>alert('Makanan tidak dapat dihapus karena masih digunakan dalam data chef.');</script>";
            return false;
        }
        else{
            $query = "DELETE FROM food WHERE id_food=$id";
            //memanggil fungsi dari db untuk eksekusi query
            $this->executeAffected($query);
            return true;
        }
    }
}
