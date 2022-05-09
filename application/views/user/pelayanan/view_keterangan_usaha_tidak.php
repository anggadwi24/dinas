<form action="<?= base_url('home/add_keterangan_usaha_tidak')?>" method="POST">
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h2>FORM KETERANGAN USAHA TIDAK BERJALAN </h2>
</div>
</div>

<div class="col-12 form-group">
	<label>NIK</label>
	<input type="number" name="nik" id="nik" class="form-control" required>
</div>
<div class="col-12 form-group">
	<label>Nama</label>
	<input type="text" name="nama" id="nama" class="form-control" required  onfocus="dataAnggota1()">
</div>
<div class="col-6 form-group">
	<label>Tempat Lahir</label>
	<input type="text" name="tempatlahir" id="tempatlahir" class="form-control" required onfocus="dataAnggota1()">
</div>
<div class="col-6 form-group">
	<label>Tanggal Lahir</label>
	<input type="date" name="tanggallahir" id="tanggallahir" class="form-control" required onfocus="dataAnggota1()">
</div>
<div class="col-6 form-group">
	<label>Agama</label>
	<input type="text" name="agama" id="agama" class="form-control" required onfocus="dataAnggota1()">
</div>
<div class="col-6 form-group">
	<label>Jenis Kelamin</label>
	<input type="text" name="jeniskelamin" id="jeniskelamin" class="form-control" required onfocus="dataAnggota1()">
</div>
<div class="col-12 form-group">
	<label>Pekerjaan</label>
	<input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required onfocus="dataAnggota1()">
</div>
<div class="col-12 form-group">
	<label>Alamat</label>
	<input type="text" name="alamat" id="alamat" class="form-control" required onfocus="dataAnggota1()">
</div>

<div class="col-12 form-group" id="kep">
	<label>Keperluan</label>
	<input type="text" name="keperluan" id="keperluan" class="form-control" required >
</div>

<div class="col-12">
	 <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
</div>
<div class="col-12 form-group" id="usaha">
	<label>Nama Usaha</label>
	<input type="text" name="nama_usaha" id="nama_usaha1" class="form-control" required  >
</div>
<div class="col-12 form-group" id="JenUs">
	<label>Jenis Usaha</label>
	<input type="text" name="jenis_usaha" id="jenis_usaha1" class="form-control" required >
</div>
<div class="col-12 form-group" id="AlUs">
	<label>Alamat Usaha</label>
	<input type="text" name="alamat_usaha" id="alamat_usaha1" class="form-control" required >
</div>
<div class="col-12 form-group" id="tglBer">
	<label>Tanggal Berdiri</label>
	<input type="date" name="tanggal_berdiri" id="tanggal_berdiri1" class="form-control" required >
</div>
<div class="col-12 form-group" id="tglBerh">
	<label>Tanggal Berhenti</label>
	<input type="date" name="tanggal_berhenti" id="tanggal_berhenti1" class="form-control" required >
</div>
<div class="col-12 float-right" id="btnUs">
	<input type="submit" name="submit" id="btnAjukan" value="AJUKAN" class="btn btn-primary float-right">
</div>
</div>
</form>

