document.getElementById("btn-toggle").addEventListener("click", () => {
    // // // // // // //     // Ketika tombol id=> btn-toggle kita klik akan menambah/menjinglakan class active-sidebar
    document.getElementById("sidebar").classList.toggle("active-sidebar");
    // // // // // // //     // Ketika tombol id=> diklik akan menambah/menjinglakan class active-main-content
    document.getElementById("main-content").classList.toggle("active-main-content");
  });

  $(document).ready(function(){
    $('#btnModalPetugas').click(function(){
        $('#petugasModal').modal('show');
        $('#titlePetugasModal').text('Tambah Data');
        $('#btnPetugas').text('Simpan');
        $('txtnik').val('');
        $('txtnama').val('');
        $('txttempat').val('');
        $('txttgl').val('');
        $('txttelp').val('');
        $('txtalamat').val('');
    });

    $('#btnPetugas').click(function(){
        if ($('#btnPetugas').text()=='Simpan'){
            // area kode simpan data
            if($('#txtnik').val().length==0){
                    swal({
                        title:'Form Petugas',type:'warning',
                        text:'NIK Wajib Diisi'
                    });
                }else if ($('#txtnama').val().lenghth==0){
                    swal({
                        title:'Form Petugas',type:'Warning',
                        text:'Nama Wajib Diisi'
                    });
                }else if ($('#txttempat').val().lenghth==0){
                    swal({
                        title:'Form Petugas',type:'Warning',
                        text:'Tempat Lahir Wajib Diisi'
                    });
                }else if ($('#txttgl').val().lenghth==0){
                    swal({
                        title:'Form Petugas',type:'Warning',
                        text:'Tanggal Lahir Wajib Diisi'
                    });
                }else if ($('#txttelp').val().lenghth==0){
                    swal({
                        title:'Form Petugas',type:'Warning',
                        text:'No Telp Wajib Diisi'
                    });
                }else if ($('#txtalamat').val().lenghth==0){
                    swal({
                        title:'Form Petugas',type:'Warning',
                        text:'Alamat Wajib Diisi'
                    });
                }else{
                //area ajax CRUD petugas
                $.ajax({ 
                    url: "source/controller/controllerPetugas.php", 
                    type: "POST", 
                    data: { 
                        js_nikPetugas:$('#txtnik').val(), 
                        js_namaPetugas:$('#txtnama').val(), 
                        js_tempatLahirPetugas:$('#txttempat').val(), 
                        js_tanggalLahirPetugas:$('#txttgl').val(), 
                        js_telpPetugas:$('#txttelp').val(), 
                        js_alamatPetugas:$('#txtalamat').val(), 
                        method_petugas:'Simpan_Petugas' 
                    }, 
                    success: function(data, textStatus, jqXHR)
                    { 
                    // Acuan Ajax kode simpan data petugas  
                        $resp = JSON.parse(data);

                        if($resp['duplicate']== 'Duplicate Yes'){ 
                            swal($resp['message']); 
                            //cek duplikasi Primarykey NIK
                            $.ajax({
                                url:"source/controller/controllerPetugas.php",
                                type:"POST",
                                data : {
                                js_nikPetugas:$('#txtnik').val(),
                                method_petugas:'Cari_NIK_petugas'
                                },
                                success: function(data_duplikasi,textStatus, jqXHR)
                                {
                                    $respDupikasi = JSON.parse(data_duplikasi);
                                    $('#txttnama').val($respDupliksi['data'][0]['nama']);
                                    $('#txttempat').val($respDupliksi['data'][0]['tempat_lahir']);
                                    $('#txttgl').val($respDupliksi['data'][0]['tanggal_lahir']);
                                    $('#txttelp').val($respDupliksi['data'][0]['telp']);
                                    $('#txtalamat').val($respDupliksi['data'][0]['alamat']);
                                }
                            }); 
                } else { 
                    // area kode berhasil disimpan 
                    $("#petugasModal").modal("hide");
                    let tempTable = $('#table-petugas').DataTable();
                    //#table_petugas merupakan nama ID tabel pada HTML
                    tempTable.ajax.reload(null,false); 
                    swal($resp['message']); 
                        } 
                    }, 
                error: function (request, textStatus, errorThrown) { 
                    swal("Error", request.responseJSON.message, "error"); 
                    } 
                });
                }
        }else {
            // area kode ubah data
            $.ajax({
                        url: "source/controller/controllerPetugas.php",
                        type: "POST",
                        data: {
                                js_nikPetugas:$('#txtnik').val(),
                                js_namaPetugas:$('#txtnama').val(),
                                js_tempatLahirPetugas:$('#txttempat').val(),
                                js_tanggalLahirPetugas:$('#txttgl').val(),
                                js_telpPetugas:$('#txttelp').val(),
                                js_alamatPetugas:$('#txtalamat').val(),
                                method_petugas:'Ubah_Petugas'
                            },
                        success: function(data, textStatus, jqXHR){
                            $resp = JSON.parse(data);
                            swal($resp['message']);
                            let tempTable = $('#table_petugas').DataTable();
                            // #table_petugas merupakan nama ID tabel pada HTML
                            tempTable.ajax.reload(null, false);
                        }
                    });
        }
    });
    
    // menampilkan data
    $('#table-petugas').dataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "processing": true,
        "ordering": false,
        "info": false,
        "responsive": true,
        "autoWidth": false,
        "pageLength": 100,
        "dom": '<"top"f>rtip',
        "fnDrawCallback": function(osettings){   
        },
        "ajax": {
            "url": "source/controller/controllerPetugas.php",
            "type": "POST",
            "data": {
                method_petugas: "recordDataPetugas"
        },
        Error: function(request, textStatus, errorThrown) {
            swal(request.responseJSON.message);
        }
    },
    columns:[
        {"data": null,render : function (data,type,full,meta) {
            return meta.row + 1;
        }},
        {"data":"nik"},
        {"data":"nama"},
        {"data":"tempat_lahir"},
        {"data":"tempat_lahir"},
        {"data":"telp"},
        {"data":"alamat"},
        {"data":null, render : function(data,type,row){
            return "<button title= 'Edit' class='btn btn-edit-petugas btn-warning btn-xs'><i class='fafa-pencil'></i> Edit</button> <button title= 'Delete' class='btn btn-hapus-petugas btn-danger btn-xs><i class='fa fa-remove'></i>Delete</button>";
    
        }  },
    ]
    });

    // Membuat Kode hapus data petugas 
    $(document).on("click",".btn-hapus-petugas",function(){ 
        let posisiBaris = $(this).parents('tr'); 
        if (posisiBaris.hasClass('child')) { 
              posisiBaris = posisiBaris.prev(); 
        } 
        let table = $('#table-petugas').DataTable(); 
        let data = table.row(posisiBaris).data(); 
         
        swal({ 
            title: "Delete", 
            text: "Apakah anda yakin menghapus data ini ?", 
            type: "warning", 
            showCancelButton: true, 
            confirmButtonClass: "btn-danger", 
            confirmButtonText: "Delete", 
            closeOnConfirm: false, 
            showLoaderOnConfirm: true 
        }, 
            function () { 
        
                $.ajax({ 
                url:"source/controller/controllerPetugas.php", 
                type: "POST", 
                data: { 
                            js_nikPetugas: data.nik, 
                            method_petugas:'Hapus_Petugas' 
                        }, 
                success: function(data, textStatus, jqXHR)
                { 
                        $resp = JSON.parse(data); 
                        if($resp['hasil'] == true){ 
                        swal($resp['message']); 
                        let xtable = $('#table-petugas').DataTable(); 
                        xtable.ajax.reload( null, false ); 
                        }else{ 
                        swal("Error hapus Petugas: "+$resp['message']) 
                        } 
                    },
                    error: function(request, textStatus, errorThrown){
                        swal("Error ", request.responseJSON.message, "error");
                    } 
                }); 
            }); 
        });

        $('#btnModalJumat').click(function(){
            $('#sholatJumatModal').modal('show');
            $('#titlesholatModal').text('Tambah Data');
            $('#btnSholatJumat').text('Simpan');
            $('#txttgl').val('');
            $('#txtwaktu').val('');
            $('#txtkhatib').val('');
            $('#txtimam').val('');
            $('#txtmuadzin').val('');
            $('#txtbilal').val('');
            });

    // nambah combo nama Khatib
    $.ajax({
        url:"source/controller/ControllerPetugas.php",
        data:{
            'method_petugas':'recordDataPetugas'
        },
        success:function(data){
            $hasil = JSON.parse(data);
            for(i=0;i<$hasil['data'].length;i++)
        {
            $('#txtkhatib').append($('<option>').val($hasil['data'][i]['nama']).text($hasil['data'][i]['nama']));
        }
    
        }
    });



    // nambah combo nama imam
    $.ajax({
        url:"source/controller/ControllerPetugas.php",
        method:"POST",
        data:{
            'method_petugas':'recordDataPetugas'
        },
        success:function(data){
            $hasil = JSON.parse(data);
            for(i=0;i<$hasil['data'].length;i++)
        {
            $('#txtimam').append($('<option>').val($hasil['data'][i]['nama']).text($hasil['data'][i]['nama']));
        }

        }
    });

    // nambah combo nama muadzin
    $.ajax({
        url:"source/controller/ControllerPetugas.php",
        method:"POST",
        data:{
            'method_petugas':'recordDataPetugas'
        },
        success:function(data){
            $hasil = JSON.parse(data);
            for(i=0;i<$hasil['data'].length;i++)
        {
            $('#txtmuadzin').append($('<option>').val($hasil['data'][i]['nama']).text($hasil['data'][i]['nama']));
        }
    
        }

     });

    // nambah combo nama bilal
    $.ajax({
        url:"source/controller/ControllerPetugas.php",
        method:"POST",
        data:{
            'method_petugas':'recordDataPetugas'
        },
        success:function(data){
            $hasil = JSON.parse(data);
            for(i=0;i<$hasil['data'].length;i++)
        {
            $('#txtbilal').append($('<option>').val($hasil['data'][i]['nama']).text($hasil['data'][i]['nama']));
        }
        }   
    
     });

     $('#btnSholatJumat').click(function(){
    
    if ($('#btnSholatJumat').text()=="Simpan"){
    $.ajax({
    url:"source/controller/ControllerJumat.php",
    method:"POST",
    data:{
            'method_jumat':'Simpan_JadwalJumat',
            'js_idjumat':$('#txtidJumat').val(),
            'js_tanggaljumat':$('#txttgl').val(),
            'js_waktujumat':$('#txtwaktu').val(),
            'js_khatibjumat':$('#txtkhatib').val(),
            'js_imamjumat':$('#txtimam').val(),
            'js_muadzinjumat':$('#txtmuadzin').val(),
            'js_bilaljumat':$('#txtbilal').val()
        },
    success:function(data){
        $hasil=JSON.parse(data);
        swal($hasil['message']);
        $('#sholatJumatModal').modal('hide');
        let xtable = $('#table-sholat-jumat').DataTable();
        xtable.ajax.reload( null, false );
    }
});
}else{
$.ajax({
url:"source/controller/ControllerJumat.php",
method:"POST",
data:{
    'method_jumat':'Ubah_JadwalJumat',
    'js_idjumat':$('#txtidjumat').val(),
    'js_tanggaljumat':$('#txttgl').val(),
    'js_waktujumat':$('#txtwaktu').val(),
    'js_khatibjumat':$('#txtkhatib').val(),
    'js_imamjumat':$('#txtimam').val(),
    'js_muadzinjumat':$('#txtmuadzin').val(),
    'js_bilaljumat':$('#txtbilal').val()
},
success:function(data){
    $hasil=JSON.parse(data);
    swal($hasil['message']);
    $('#sholatJumatModal').modal('hide');
    let xtable = $('#table-sholat-jumat').DataTable();
    xtable.ajax.reload( null, false );
     }
    });
    }
    
    });
    $('#table-sholat-jumat').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "processing": true,
        "ordering": false,
        "info": false,
        "responsive": true,
        "autoWidth": false,
        "pageLength": 100,
        "dom": '<"top"f>rtip',
        "fnDrawCallback": function( oSettings ) {
        },
        "ajax": {
        "url": "source/controller/controllerJumat.php",
        "type": "POST",
        "data" : {
        method_jumat : "recordDataJadwalJumat"
        },
        error: function (request, textStatus, errorThrown) {
            swal(request.responseJSON.message);
            }
            },
            
            columns: [
            { "data": null,render : function ( data, type, full, meta ) {
            return meta.row + 1;
            }},
            { "data": "tanggal" },
            { "data": "waktu" },
            { "data": "nama_khatib" },
            { "data": "nama_imam" },
            { "data": "nama_muadzin" },
            { "data": "nama_bilal" },
            { "data": null, render : function(data,type,row){
            return "<button title='Edit' class='btn btn-edit-jumat btn-warning btn-xs'><i class='fafa-pencil'></i> Edit</button> <button title='Delete' class='btn btn-hapus-jumat btndanger btn- xs'><i class='fa fa-remove'></i> Delete</button> ";
                 }    },
                ]
                });
                
            



            $('#btnModalFardhu').click(function(){
            $('#sholatFardhuModal').modal('show');
            $('#titlesholatFardhuModal').text('Tambah Data');
            $('#btnSholatFardhu').text('Simpan');
            $('#txttgl').val('');
            $('#txtwaktu').val('');
            $('#txtkhatib').val('');
            $('#txtimam').val('');
            $('#txtmuadzin').val('');
            $('#txtbilal').val('');
            });
    
    $('#table-sholat-fardhu').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "processing": true,
        "ordering": false,
        "info": false,
        "responsive": true,
        "autoWidth": false,
        "pageLength": 5,
        "dom": '<"top"f>rtip',
        "fnDrawCallback": function( oSettings ) {
        },
        "ajax": {
        "url": "source/controller/controllerFardhu.php",
        "type": "POST",
        "data" : {
        method_fardhu : "recordDataFardhu"
        }
        },
        
        columns: [
        { "data": null,render : function ( data, type, full, meta ) {
        return meta.row + 1;
        }},
        { "data": "nama_imam" },
        { "data": "hari" },
        { "data": "tanggal" },
        { "data": null, render : function(data,type,row){
             return "<button title='Edit' class='btn btn-edit-fardhu btn-warning btn-xs'><i class='fafa-pencil'></i> Edit</button> <button title='Delete' class='btn btn-hapus-fardhu btn-danger btn- xs'><i class='fa fa-remove'></i> Delete</button> ";
    } },
        ]
        });
        
        $(document).on("click",".btn-edit-fardhu",function(){
            $('#sholatFardhuModal').modal('show');
            var posisiBaris = $(this).parents('tr');
            if (posisiBaris .hasClass('child')) {
            posisiBaris = posisiBaris .prev();
            }
            var table = $('#table-sholat-fardhu').DataTable();
            var data = table.row( posisiBaris ).data();
            $('#txtidfardhu').val(data.id);
            $('#txttgl_fardhu').val(data.tanggal);
            $('#txthari').val(data.hari);
            $('#txtimam').val(data.nama_imam);
            
            $('#btnSholatFardhu').text('Ubah');
            $('#sholatFardhuModal').modal('show');
            });
            
            $('#btnSholatFardhu').click(function(){

                if ($('#btnSholatFardhu').text()=="Simpan"){
                
                $.ajax({
                url:"source/controller/controllerFardhu.php",
                type:"POST",
                data:{
                js_namaimam:$('#txtimam').val(),
                js_hari:$('#txthari').val(),
                js_tgl:$('#txttgl_fardhu').val(),
                js_idfardhu:$('#txtidfardhu').val(),
                method_fardhu:"Simpan_JadwalFardhu"
                },
                success:function(respon){
                $hasil=JSON.parse(respon);
                swal($hasil['pesan']);
                }
                });
                
                }else{
                
                }
                
                });
                
                $.ajax({
                    url:"source/controller/controllerFardhu.php",
                    type:"POST",
                    data:{
                    js_namaimam:$('#txtimam').val(),
                    js_hari:$('#txthari').val(),
                    js_tgl:$('#txttgl_fardhu').val(),
                    js_idfardhu:$('#txtidfardhu').val(),
                    method_fardhu:"Ubah_JadwalFardhu"
                    },
                    success:function(respon){
                    $hasil=JSON.parse(respon);
                    swal($hasil['pesan']);
                    }
                    });
                    
            // Membuat Kode hapus data fardhu
 $(document).on("click",".btn-hapus-fardhu",function(){
    let posisiBaris = $(this).parents('tr');
    if (posisiBaris.hasClass('child')) {
    posisiBaris = posisiBaris.prev();
    }
    let table = $('#table-sholat-fardhu').DataTable();
    let data = table.row(posisiBaris).data();
    
    swal({
    title: "Delete",
    text: "Apakah anda yakin menghapus data ini ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Delete",
    closeOnConfirm: false,
    showLoaderOnConfirm: true
    },
    function(){
    
    $.ajax({
    url:"source/controller/controllerFardhu.php",
    type: "POST",
    data: {
    js_idfardhu : data.id,
    method_fardhu:"Hapus_JadwalFardhu"
    },
    success: function(data)
    {
    $resp = JSON.parse(data);
    if($resp['status'] == true){
    swal($resp['message']);
    let xtable = $('#table-sholat-fardhu').DataTable();
    xtable.ajax.reload( null, false );
    }else{
    swal("Error hapus Petugas: "+$resp['message'])
    }
    
    }
    });
    });
    });
    

    $('#btnModalPengajian').click(function(){
         $('#PengajianModal').modal('show');
         $('#titlePengajianModa').text('Tambah Data');
         $('#btnPengajian').text('Simpan');
         $('#txttgl_pengajian').val('');
         $('#txthari').val('');
         $('#txttema').val('');
         $('#txtket').val('');
         $('#txtimam').val('');
         $('#txtidpengajian').val('');
         });
         
        
}); //akhir       