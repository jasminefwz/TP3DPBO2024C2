<?php

class Chef extends DB
{
    //mengambil data chef dengan menggabungkan informasi makanan dan resto
    function getChefJoin()
    {
        $query = "SELECT * FROM chef 
        JOIN food ON chef.id_food=food.id_food 
        JOIN resto ON chef.id_resto=resto.id_resto";

        return $this->execute($query);
    }

    //mengambil semua data chef
    function getChef()
    {
        $query = "SELECT * FROM chef";
        return $this->execute($query);
    }

    //mengambil data chef berdasarkan id
    function getChefById($id)
    {
        $query = "SELECT * FROM chef JOIN food ON chef.id_food=food.id_food JOIN resto ON chef.id_resto=resto.id_resto WHERE id_chef=$id";
        return $this->execute($query);
    }

    //mencari chef berdasarkan keyword
    function searchChef($keyword)
    {
        $query = "SELECT chef.*, resto.name_resto 
                  FROM chef 
                  JOIN food ON chef.id_food=food.id_food 
                  JOIN resto ON chef.id_resto=resto.id_resto 
                  WHERE chef.name_chef LIKE '%$keyword%' 
                  OR chef.asal_chef LIKE '%$keyword%'
                  OR resto.name_resto LIKE '%$keyword%'
                  ORDER BY chef.name_chef ASC";
        return $this->execute($query);
    }

    // mengambil data chef dengan pengurutan
    function getChefJoinSorted($orderBy)
    {
        $query = "SELECT * FROM chef 
        JOIN food ON chef.id_food=food.id_food 
        JOIN resto ON chef.id_resto=resto.id_resto 
        ORDER BY $orderBy ASC";

        return $this->execute($query);
    }

    //menambahkan data chef baru
    function addData($data, $file)
    {
        $foto = $file;
        $nama = $data['name_chef'];
        $asal = $data['asal_chef'];
        $telp = $data['telp_chef'];
        $id_food = $data['id_food'];
        $id_resto = $data['id_resto'];
        $query = "INSERT INTO chef VALUES ('', '$foto', '$nama', '$asal', '$telp', '$id_food', '$id_resto')";
        return $this->executeAffected($query);
    }

    //memperbarui data chef berdasarkan id
    function updateData($id, $data)
    {
        //jika update foto
        if(isset($data['foto_chef']) && $data['foto_chef'] != null){
            $foto = $data['foto_chef'];
            $nama = $data['name_chef'];
            $asal = $data['asal_chef'];
            $telp = $data['telp_chef'];
            $id_food = $data['id_food'];
            $id_resto = $data['id_resto'];
            $query = "UPDATE chef 
                    SET foto_chef='$foto', name_chef='$nama', asal_chef='$asal', telp_chef='$telp', id_food='$id_food', id_resto='$id_resto' 
                    WHERE id_chef=$id";
        }
        else{
        $nama = $data['name_chef'];
        $asal = $data['asal_chef'];
        $telp = $data['telp_chef'];
        $id_food = $data['id_food'];
        $id_resto = $data['id_resto'];
        $query = "UPDATE chef 
                  SET name_chef='$nama', asal_chef='$asal', telp_chef='$telp', id_food='$id_food', id_resto='$id_resto' 
                  WHERE id_chef=$id";
        }
        return $this->executeAffected($query);
    }

    //menghapus data chef berdasarkan id
    function deleteData($id)
    {
        $query = "DELETE FROM chef WHERE id_chef=$id";
        return $this->executeAffected($query);
    }
}
