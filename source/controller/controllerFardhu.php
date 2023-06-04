<?php
 
 include "../model/koneksiDB.php";
 include "../model/modelFardhu.php";
 if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
 {
 $method=$_POST['method_fardhu']; // cara yang dikirim dari js
 $crud = new modelFardhu();
 $retval = [];
 
 if($method == 'recordDataJadwalFardhu') // mengecek nilai method apakah menangkap data petugas
 {
 $list = $crud->recordDataJadwalFardhu();
 $retval['status'] = $list[0];
 $retval['message'] = $list[1];
 $retval['data'] = $list[2];
 echo json_encode($retval);
 }
 
 if($method == 'Satu_BarisFardhu') 
 {
 $CtrlId = $_POST['js_idfardhu'];
 $list = $crud->SatuBarisFardhu($CtrlId);
 $retval['status'] = $list[0]; 
 $retval['message'] = $list[1];
 $retval['data'] = $list[2]; 
 echo json_encode($retval);
 }
 
 if($method == 'Get_NIK_Petugas') 
 {
 $CtrlId = $_POST['js_namaPetugas'];
 $list = $crud->getnikPetugasJumat($CtrlId);
 $retval['status'] = $list[0]; 
 $retval['message'] = $list[1];
 $retval['data'] = $list[2]; 
 echo json_encode($retval);
 }
 
 if($method == 'Simpan_JadwalFardhu') // mengecek nilai method apakah perintah simpan Data
 {
 $CtrlTGL = $_POST['js_tgl'];
 $CtrlWAKTU = $_POST['js_hari']; 
 $CtrlIMAM=$crud->getnikPetugasFardhu($_POST['js_namaimam']);
 $simpan = $crud->simpanSholatFardhu($CtrlIMAM,$CtrlWAKTU,$CtrlTGL);
 $retval['status'] = $simpan[0];
 $retval['pesan'] = $simpan[1];
 echo json_encode($retval);
 }
 
 if($method == 'Ubah_JadwalFardhu') // mengecek nilai method apakah perintah ubah Data
 {
    $CtrlID = $_POST['js_idfardhu'];
    $CtrlTGL = $_POST['js_tgl'];
    $CtrlWAKTU = $_POST['js_hari']; 
    $CtrlIMAM=$crud->getnikPetugasFardhu($_POST['js_namaimam']);
    $simpan = $crud->ubahSholatFardhu($CtrlID,$CtrlIMAM,$CtrlWAKTU,$CtrlTGL);
    $retval['status'] = $simpan[0];
    $retval['pesan'] = $simpan[1];
    echo json_encode($retval);
    }
    
    if($method == 'Hapus_JadwalFardhu')
    {
    $CtrlIdFardhu=$_POST['js_idfardhu'];
    $hapus = $crud->hapusSholatFardhu($CtrlIdFardhu);
    $retval['status'] = $hapus[0];
    $retval['message'] = $hapus[1];
    echo json_encode($retval);
    }
    
    
    }else{
    header("HTTP/1.1 401 Unauthorized");
    exit;
    }
    
    ?>
   