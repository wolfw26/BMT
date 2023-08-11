<div class="modal fade" id="peserta_alamat" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form action="laporan/peserta_alamat.php" target="_blank" method="post" enctype="multipart/form-r">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Laporan Peserta <br> <small> Berdasarkan Jabatan</small></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <i class="ti-close"></i>
	        </button>
	      </div>
	      <div class="modal-body"> 
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Jabatan</label> 
	            <select name="ruang" class="form-control" id=""> 
	            	<option>Pilih</option>
                      <?php
                        $sql=mysqli_query($db, "SELECT * FROM ruang");
                        while ($are = mysqli_fetch_array($sql)){
                            echo "<option value='$are[id_ruang]'>$are[kandidat]</option>";
                        }
                      ?>
                    </select>
	          </div> 
	       </div>
	       <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="submit" class="btn btn-primary">Cetak</button>
	       </div>
	     </div>
	   </form>
  </div>
</div>

<div class="modal fade" id="ujian1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form action="laporan/ujian1_status.php" target="_blank" method="post" enctype="multipart/form-r">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Laporan Ujian Berkas (Tahap 1) <br> <small> Berdasarkan Status</small></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <i class="ti-close"></i>
	        </button>
	      </div>
		  
	      <div class="modal-body"> 
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Status</label> 
	            <select name="status_berkas" class="form-control" id=""> 
	            	<option>Pilih</option>
                      <option value="Lanjut Ke Tes Tertulis dan Wawancara">Lanjut Tes Tertulis dan Wawancara</option>
                      <option value="Tidak Lulus">Tidak Lulus</option>
                    </select>
	          </div> 
	       </div>
	       <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="submit" class="btn btn-primary">Cetak</button>
	       </div>
	     </div>
		 
	   </form>
  </div>
</div>

<div class="modal fade" id="nilai_alamat" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form action="laporan/nilai_alamat.php" target="_blank" method="post" enctype="multipart/form-r">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Laporan Penilaian <br> <small> Berdasarkan Kecamatan</small></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <i class="ti-close"></i>
	        </button>
	      </div>
	      <div class="modal-body"> 
	          <div class="form-group">
	            <label for="recipient-name" class="col-form-label">Jabatan</label> 
	            <select name="ruang" class="form-control" id=""> 
	            	<option>Pilih</option>
                      <?php
                        $sql=mysqli_query($db, "SELECT * FROM ruang");
                        while ($are = mysqli_fetch_array($sql)){
                            echo "<option value='$are[id_ruang]'>$are[kandidat]</option>";
                        }
                      ?>
                    </select>
	          </div> 
	       </div>
	       <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="submit" class="btn btn-primary">Cetak</button>
	       </div>
	     </div>
	   </form>
  </div>
</div>