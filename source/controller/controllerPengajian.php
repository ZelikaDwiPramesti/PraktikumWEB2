<?php
 
 include "../model/koneksiDB.php";
 include "../model/modelPengajian.php";
 if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
 {
 $method=$_POST['method_pengajian']; // cara yang dikirim dari js
 $crud = new modelPengajian();
 $retval = [];
 
 if($method == 'recordDataJadwalPengajian') // mengecek nilai method apakah menangkap data petugas
 {
    $list = $crud->recordDataJadwalPengajian();
    $retval['status'] = $list[0];
    $retval['message'] = $list[1];
    $retval['data'] = $list[2];
    echo json_encode($retval);
    }
    
    
    if($method == 'Simpan_JadwalPengajian') // mengecek nilai method apakah perintah simpan Data
    {
    $CtrlID = $_POST['js_idpengajian'];
    $CtrlTGL = $_POST['js_tgl'];
    $Ctrlhari = $_POST['js_hari']; 
    $Ctrltema = $_POST['js_tema']; 
    $Ctrlket = $_POST['js_ket']; 
    $Ctrlnik=$crud->getnikPetugasPengajian($_POST['js_ustadz']);
    $simpan = $crud->simpanPengajian($CtrlIMAM,$CtrlWAKTU,$CtrlTGL);
    $retval['status'] = $simpan[0];
    $retval['pesan'] = $simpan[1];
    echo json_encode($retval);
    }
    
    if($method == 'Ubah_JadwalPengajian') // mengecek nilai method apakah perintah ubah Data
    {
    $CtrlID = $_POST['js_idpengajian'];
    $CtrlTGL = $_POST['js_tgl'];
    $Ctrlhari = $_POST['js_hari']; 
    $Ctrltema = $_POST['js_tema']; 
    $Ctrlket = $_POST['js_ket']; 
    $Ctrlnik=$crud->getnikPetugasPengajian($_POST['js_ustadz']);
    $simpan = $crud->ubahPengajian($CtrlID,$CtrlIMAM,$CtrlWAKTU,$CtrlTGL);
    $retval['status'] = $simpan[0];
    $retval['pesan'] = $simpan[1];
    echo json_encode($retval);
    }
    
    if($method == 'Hapus_JadwalPengajian')
    {
    $CtrlIdFardhu=$_POST['js_idpengajian'];
    $hapus = $crud->hapusPengajian($CtrlIdFardhu);
    $retval['status'] = $hapus[0];
    $retval['message'] = $hapus[1];
    echo json_encode($retval);
    }
    
    }else{
    header("HTTP/1.1 401 Unauthorized");
    exit;
    }
    
    ?>
    