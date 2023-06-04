<?php
  
  class modelPengajian extends koneksiDB{
  public function __construct(){
  $this->hubungkanDatabase();
  }
  
  // method untuk Simpan Data 
  public function simpanPengajian($hari, $tgl, $nikustad,$tema,$keterangan){
 $varDB =$this->databasenya;
 try {
 
 $perintah = $varDB ->prepare("INSERT INTO pengajian (hari,tanggal,nik_ustadz,tema,keterangan) VALUES( :hari, :tgl, :nik,:tema,:ket) ");
 $perintah->bindParam("hari",$hari);
 $perintah->bindParam("tgl",$tgl);
 $perintah->bindParam("nik",$nikustad); 
 $perintah->bindParam("tema",$tema);
 $perintah->bindParam("ket",$keterangan); 
 $perintah->execute();
 $posisi[0]=true;//acuan kode berhasil
 $posisi[1]="Data Jadwal Sholat Pengajian Berhasil disimpan";
 

 return $posisi;
 } catch (PDOException $psn) {
 $posisi[0]=false; //acuan kode salah
 $posisi[1]=$psn->getMessage();
 return $posisi;
 }
 }
 
 // method untuk Ubah Data 
 public function ubahPengajian($id, $hari, $tgl, $nikustad,$tema,$keterangan){
 $varDB =$this->databasenya;
 try {
 $perintah = $varDB ->prepare(" UPDATE pengajian SET hari= :hari, tanggal= :tgl, nik_ustadz= :nik, tema=:tema, keterangan=:ket WHERE id= :id");
 $perintah->bindParam("id",$id);
 $perintah->bindParam("hari",$hari);
 $perintah->bindParam("tgl",$tgl);
 $perintah->bindParam("nik",$nikustad); 
 $perintah->bindParam("tema",$tema);
 $perintah->bindParam("ket",$keterangan); 
 $perintah->execute();
 $posisi[0]=true;//acuan kode berhasil
 $posisi[1]="Data Jadwal Pengajian Berhasil diubah";
 return $posisi;
 } catch (PDOException $psn) {
 $posisi[0]=false; //acuan kode salah
 $posisi[1]=$psn->getMessage();
 return $posisi;
 }
 }
 
 // method untuk Hapus Data 
 public function hapusPengajian($id){
 $varDB =$this->databasenya;
 try {
 $perintah = $varDB ->prepare("DELETE FROM pengajian WHERE id= :id");
 $perintah->bindParam("id",$id);
 $perintah->execute();
 $posisi[0]=true;//acuan kode berhasil
 $posisi[1]="Data Jadwal Pengajian Berhasil dihapus";
 return $posisi;
 } catch (PDOException $psn) {
 $posisi[0]=false; //acuan kode salah
 $posisi[1]=$psn->getMessage();
 return $posisi;
 }
 }
 
 //method mengambil record data
 public function recordDataJadwalPengajian(){
 $varDB =$this->databasenya;
 try {
 
 $perintah = $varDB ->prepare("SELECT*FROM view_pengajian ORDER BY tanggal DESC");
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
 public function getnikPetugasPengajian($varnNama){
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
 