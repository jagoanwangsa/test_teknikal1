<?php
class Produkmodel extends CI_Model{



     
     public function savedataproduct($namabarang,$hargabeli,$hargajual, $stok,$gambarbarang) {


        $data = array(
            'namabarang'=>$namabarang,
            'hargabeli'=>$hargabeli,
            'hargajual'=>$hargajual,
            'stok'=> $stok,
            'gambarbarang' => $gambarbarang
        );

        $this->db->insert('tb_barang',$data);
        return ($this->db->affected_rows() != 1) ? false : true;

     }

     public function getDataAllProduct()
     {
         $query = $this->db->query("SELECT * FROM  tb_barang");
         return $query->result_array(); 
     }

        
    public function findDetailBarang($paramid)
    {
        $query = $this->db->query("SELECT * FROM tb_barang  WHERE  tb_barang.idbarang ='".$paramid."'");
        return $query->result_array(); 
    }


    public function update_barang($id, $textnamabarang, $convertnumberhargabeli, $convertnumberhargajual, $inputgambar, $convertstokbarang ) {
        // $data = array(
        //     'namabarang' => $textnamabarang,
        //     'hargabeli' => $convertnumberhargabeli,
        //     'hargajual' => $convertnumberhargajual,
        //     'stok' => $convertstokbarang,
        //     'gambarbarang' => $inputgambar
            
        // );

        $data["namabarang"] = $textnamabarang;
        $data["hargabeli"] = $convertnumberhargabeli;
        $data["hargajual"] = $convertnumberhargajual;
        $data["stok"] = $convertstokbarang;
        $data["gambarbarang"] = $inputgambar;


            $this->db->where('idbarang', $id);
            $this->db->update('tb_barang', $data);

            return true;

      }

      public function deleteproduk($id){
        $this -> db -> where('idbarang', $id);
        $this -> db -> delete('tb_barang');
    }

}
?>