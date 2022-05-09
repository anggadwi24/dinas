<form action="<?= base_url('home/add_keberatan_warga')?>" method="POST">
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h2>FORM KETERANGAN KEBERATAN WARGA</h2>
</div>
</div>
<div class="col-12"><h6>Pelapor : </h6></div>
<div class="col-12 form-group">
	<label>NIK</label>
	<input type="number" name="nik" id="nik" class="form-control" required>
</div>
<div class="col-12 form-group">
	<label>Nama</label>
	<input type="text" name="nama" id="nama" class="form-control" required  onfocus="dataKeluarga()">
</div>
<div class="col-6 form-group">
	<label>Tempat Lahir</label>
	<input type="text" name="tempatlahir" id="tempatlahir" class="form-control" required onfocus="dataKeluarga()">
</div>
<div class="col-6 form-group">
	<label>Tanggal Lahir</label>
	<input type="date" name="tanggallahir" id="tanggallahir" class="form-control" required onfocus="dataKeluarga()">
</div>

			<div class="col-12 form-group" >
				<div id="frmAgama1"></div>
				<label>Agama</label>
				 <select class="form-control" name="agama" required="" id="agama">
			                  <option value="Islam">Islam</option>
			                  <option value="Kristen">Kristen</option>
			                  <option value="Katolik">Katolik</option>
			                  <option value="Hindu">Hindu</option>
			                  <option value="Konghucu">Konghucu</option>
			                  <option value="Buddha">Buddha</option>


			     </select>
			</div>
			<div class="col-12 form-group" >
				<div id="frmJK1"></div>
				<label>Jenis Kelamin</label>
				<select class="form-control" id="jeniskelamin" name="jeniskelamin">
					<option value="Laki-laki" selected>Laki - Laki</option>
					<option value="Perempuan">Perempuan</option>
					
				</select>
				
			</div>
<div class="col-12 form-group">
	<label>Pekerjaan</label>
	<input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required onfocus="dataKeluarga()">
</div>
<div class="col-12 form-group">
	<label>Alamat</label>
	<input type="text" name="alamat" id="alamat" class="form-control" required onfocus="dataKeluarga()">
</div>


<div class="col-12">
	 			<hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
</div>
<div class="col-12 text-center"><h2>Diajukan ke :</h2></div>
<div class="col-12 form-group">
	<label>Pengajuan Ke : </label>
	<input type="text" name="pengajuan"  class="form-control" required >
</div>
<div class="col-12 form-group">
	<label>Alasan : </label>
	<textarea name="alasan" required class="form-control"></textarea>
</div>
<div class="col-12">
	<h6> <a href="<?= base_url('asset/docs/contoh_keberatan_warga.docx')?>" target="_BLANK" class="text-primary"><i>Contoh  Pengajuan</i></a></h6>
</div>
<div class="col-12 float-right">
	<input type="submit" name="submit" value="AJUKAN" class="btn btn-primary w-100">
</div>
</div>
</form>