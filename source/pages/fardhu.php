<?php require("header.php") ?>
 
 <h4><i class="bi bi-calendar2-week"></i>DATA JADWAL SHOLAT FARDHU (WAJIB)</h4>
 <h5> </h5>
 <button type="button" class="btn btn-success" id="btnModalFardhu">Tambah Data</button>
 
 <button type="button" class="btn btn-success" id="btnReportFardhu">Laporan</button>
 
 <!-- Modal Data Jumat-->
 <div class="modal fade" id="sholatFardhuModal" tabindex="-1" aria-labelledby="titlesholatFardhuModal" aria-hidden="true">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header bg-success">
 <h5 class="modal-title" id="titlesholatFardhuModal"></h5>
 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>
 <div class="modal-body">
 <form>
 <div class="row mb-3">
 <label for="txtnik" class="col-sm-3 col-form-label">Tanggal</label>
 <div class="col-sm-9">
 <select id="txtimam" class="form-control"></select>
 <input type="hidden" class="form-control" id="txtidfardhu">
 </div>
 </div>
 <div class="row mb-3">
 <label for="txthari" class="col-sm-3 col-form-label">Waktu</label>
 <div class="col-sm-9">
 <input type="text" class="form-control" id="txthari">
 </div>
 </div>
 <div class="row mb-3">
 <label for="txttgl" class="col-sm-3 col-form-label">Nama Imam</label>
 <div class="col-sm-9">
 <input type="date" class="form-control" id="txttgl_fardhu">
 </div>
 </div>
 
 </form>
 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
 <button type="button" class="btn btn-success" id="btnSholatFardhu">Save changes</button>
 </div>
 </div>
 </div>
 </div>
 
 <br><br>
 <div class="table-responsive margin">
 <table id="table-sholat-fardhu" class="table table-bordered">
 <thead>
 <tr>
 <th style="width: 10px">#</th>
 <th style="width: 100px">Nama Khatib</th>
 <th style="width: 100px">Hari</th>
 <th style="width: 100px;">Tanggal</th>
 <th style="width: 50px;"></th>
 </tr>
 </thead>
 
 </table>
 </div>
 
 <?php require("footer.php") ?>
 
