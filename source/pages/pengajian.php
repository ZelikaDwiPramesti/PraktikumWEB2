<?php require("header.php") ?>

 <h4><i class="bi bi-calendar2-week"></i>DATA JADWAL PENGAJIAN</h4>
 <h5> </h5>
 <button type="button" class="btn btn-success" id="btnModalPengajian">Tambah Data</button>

 <button type="button" class="btn btn-success" id="btnReportPengajian">Laporan</button>
 
 <!-- Modal Data Jumat-->
 <div class="modal fade" id="PengajianModal" tabindex="-1" aria-labelledby="titlesholatPengajianModal" aria-hidden="true">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header bg-success">
 <h5 class="modal-title" id="titlePengajianModal"></h5>
 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>
 <div class="modal-body">
 <form>
 <div class="row mb-3">
 <label for="txtnik" class="col-sm-3 col-form-label">Nama Ustadz</label>
 <div class="col-sm-9">
 <select id="txtimam" class="form-control"></select>
 <input type="hidden" class="form-control" id="txtidpengajian">
 </div>
</div>
 <div class="row mb-3">
 <label for="txthari" class="col-sm-3 col-form-label">Hari</label>
 <div class="col-sm-9">
 <input type="text" class="form-control" id="txthari">
 </div>
 </div>
 <div class="row mb-3">
 <label for="txttgl" class="col-sm-3 col-form-label">Tanggal</label>
 <div class="col-sm-9">
 <input type="date" class="form-control" id="txttgl_pengajian">
 </div>
 </div>
 <div class="row mb-3">
 <label for="txthari" class="col-sm-3 col-form-label">Tema</label>
 <div class="col-sm-9">
 <input type="text" class="form-control" id="txttema">
 </div>
 </div>
 <div class="row mb-3">
<label for="txthari" class="col-sm-3 col-form-label">Keterangan</label>
 <div class="col-sm-9">
 <input type="text" class="form-control" id="txtket">
 </div>
 </div>
 
 </form>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
 <button type="button" class="btn btn-success" id="btnPengajian">Save changes</button>
 </div>
 </div>
 </div>
 </div>
 
 <br><br>
 <div class="table-responsive margin">
 <table id="table-sholat-pengajian" class="table table-bordered">
 <thead>
 <tr>
 <th style="width: 10px">#</th>
 <th style="width: 100px">Hari</th>
 <th style="width: 100px">Tanggal</th>
 <th style="width: 200px;">Ustadz</th>
 <th style="width: 200px;">Tema</th>
 <th style="width: 200px;">Keterangan</th>
 <th style="width: 50px;"></th>
 </tr>
 </thead>
 
 </table>
 </div>
 
 <?php require("footer.php") ?>
 