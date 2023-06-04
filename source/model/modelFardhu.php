<?php
  
  class modelFardhu extends koneksiDB{
  public function __construct(){
  $this->hubungkanDatabase();
  }
  
  // method untuk Simpan Data jadwal Sholat Fardhu
  public function simpanSholatFardhu($nik_imam, $waktu, $tgl){ 
    $varDB =$this->databasenya;
 try {
 
     $perintah = $varDB ->prepare("INSERT INTO jadwal_sholat_fardhu (nik_imam,hari,tanggal) VALUES( :nik, :waktu, :tgl) ");
     $perintah->bindParam("nik",$nik_imam);
     $perintah->bindParam("waktu",$waktu);
     $perintah->bindParam("tgl",$tgl); 
     $perintah->execute();
     $posisi[0]=true;//acuan kode berhasil
     $posisi[1]="Data Jadwal Sholat Fardhu Berhasil disimpan";
     
     
     return $posisi;
    } catch (PDOException $psn) {
         $posisi[0]=false; //acuan kode salah
         $posisi[1]=$psn->getMessage();
         return $posisi;
         }
         }

         // method untuk Ubah Data Jadwal Sholat Fardhu
    public function ubahSholatFardhu($id, $nik_imam, $waktu, $tgl){
     $varDB =$this->databasenya;
     try {
                $perintah = $varDB ->prepare(" UPDATE jadwal_sholat_fardhu SET tanggal= :tgl, hari= :waktu, nik_imam= :nimam WHERE id= :idfardhu");
        $perintah->bindParam("idfardhu",$id);
        $perintah->bindParam("tgl",$tgl);
        $perintah->bindParam("waktu",$waktu);
        $perintah->bindParam("nimam",$nik_imam);
        $perintah->execute();
        $posisi[0]=true;//acuan kode berhasil
        $posisi[1]="Data Jadwal Sholat Fardhu Berhasil diubah";
        return $posisi;
        } catch (PDOException $psn) {
     $posisi[0]=false; //acuan kode salah
     $posisi[1]=$psn->getMessage();
     return $posisi;
     }
     }

     // method untuk Hapus Data 
    public function hapusSholatFardhu($id){
     $varDB =$this->databasenya;
     try {
     $perintah = $varDB ->prepare("DELETE FROM jadwal_sholat_fardhu WHERE id= :idfardhu");
     $perintah->bindParam("idfardhu",$id);
     $perintah->execute();
     $posisi[0]=true;//acuan kode berhasil
     $posisi[1]="Data Jadwal Sholat Fardhu Berhasil dihapus";
     return $posisi;
     } catch (PDOException $psn) {
     $posisi[0]=false; //acuan kode salah
     $posisi[1]=$psn->getMessage();
     return $posisi;
     }
     }
    
     //method mengambil record data
    public function recordDataJadwalFardhu(){
     $varDB =$this->databasenya;
     try {
     
     $perintah = $varDB ->prepare("SELECT*FROM view_sholat_fardhu ORDER BY tanggal DESC");
     $perintah->execute();
     $posisi[0]=true;//acuan kode berhasil
     $posisi[1]="Data_Sholat_Fardhu";
     $posisi[2]=$perintah->fetchAll(PDO::FETCH_ASSOC); 
     return $posisi;
     } catch (PDOException $psn) {
     $posisi[0]=false; //acuan kode salah
     $posisi[1]=$psn->getMessage();
     $posisi[2]=[];
     return $posisi;
     }
     }
      
 
    //method getNIK Petugas
    public function getnikPetugasFardhu($varnNama){
    $varDB =$this->databasenya;
    try {
    $perintah = $varDB ->prepare("SELECT*FROM petugas WHERE nama='$varnNama'");
    $perintah->execute();
    $petugas=$perintah->fetch();
    return $petugas['nik'];
    } catch (PDOException $psn) {
    return $psn->getMessage();
    }
    }
    }

 ?>
