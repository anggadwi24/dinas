<form action="<?= base_url('home/add_jampersal')?>" method="POST">
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h2>FORM SURAT KETERANGAN TIDAK MAMPU</h2>
</div>
</div>

<div class="col-12 form-group">
	<label>NIK</label>
	<input type="number" name="nik" id="nik" class="form-control" required>
</div>
<div class="col-12 form-group">
	<label>Nama</label>
	<input type="text" name="nama" id="nama" class="form-control" required  onfocus="dataAnggota2()">
</div>
<div class="col-6 form-group">
	<label>Tempat Lahir</label>
	<input type="text" name="tempatlahir" id="tempatlahir" class="form-control" required onfocus="dataAnggota2()">
</div>
<div class="col-6 form-group">
	<label>Tanggal Lahir</label>
	<input type="date" name="tanggallahir" id="tanggallahir" class="form-control" required onfocus="dataAnggota2()">
</div>
<div class="col-6 form-group" >
	<div id="frmAgama"></div>
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
<div class="col-6 form-group" >
	<div id="frmJK"></div>
	<label>Jenis Kelamin</label>
	<select class="form-control" id="jeniskelamin" name="jeniskelamin">
		<option value="Laki-laki">Laki - Laki</option>
		<option value="Perempuan">Perempuan</option>
	</select>
	
</div>
<div class="col-12 form-group">
	<label>Pekerjaan</label>
	<input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required onfocus="dataAnggota2()">
</div>
<div class="col-12 form-group">
	<label>Alamat</label>
	<input type="text" name="alamat" id="alamat" class="form-control" required onfocus="dataAnggota2()">
</div>

<div class="col-12 form-group" >
	<div id="frmStatus"></div>
	<label>Status</label>
	<select name="status" class="form-control" id="status">
		<option value="kawin">Kawin</option>
		<option value="belum kawin">Belum Kawin</option>
		<option value="cerai hidup">Cerai Hidup</option>
		<option value="cerai mati">Cerai Mati</option>
	</select>
</div>

<div class="col-12 form-group">
	<label>Keperluan</label>
	<input type="text" name="untuk" id="untuk" class="form-control" required >
</div>
<div class="col-12">
	 <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
</div>

<div class="col-12 float-right">
	<input type="submit" name="submit" value="AJUKAN" class="btn btn-primary float-right">
</div>
</div>
</form>