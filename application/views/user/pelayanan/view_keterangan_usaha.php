<form action="<?= base_url('home/add_keterangan_usaha')?>" method="POST">
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h2>FORM KETERANGAN USAHA</h2>
</div>
</div>

<div class="col-12 form-group">
	<label>NIK</label>
	<input type="number" name="nik" id="nik" class="form-control" required>
</div>
<div class="col-12 form-group">
	<label>Nama</label>
	<input type="text" name="nama" id="nama" class="form-control" required  onfocus="dataAnggota()">
</div>
<div class="col-6 form-group">
	<label>Tempat Lahir</label>
	<input type="text" name="tempatlahir" id="tempatlahir" class="form-control" required onfocus="dataAnggota()">
</div>
<div class="col-6 form-group">
	<label>Tanggal Lahir</label>
	<input type="date" name="tanggallahir" id="tanggallahir" class="form-control" required onfocus="dataAnggota()">
</div>
<div class="col-6 form-group">
	<label>Agama</label>
	<input type="text" name="agama" id="agama" class="form-control" required onfocus="dataAnggota()">
</div>
<div class="col-6 form-group">
	<label>Jenis Kelamin</label>
	<input type="text" name="jeniskelamin" id="jeniskelamin" class="form-control" required onfocus="dataAnggota()">
</div>
<div class="col-12 form-group">
	<label>Pekerjaan</label>
	<input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required onfocus="dataAnggota()">
</div>
<div class="col-12 form-group">
	<label>Alamat</label>
	<input type="text" name="alamat" id="alamat" class="form-control" required onfocus="dataAnggota()">
</div>

<div class="col-12 form-group">
	<label>Keperluan</label>
	<input type="text" name="keperluan" id="keperluan" class="form-control" required >
</div>
<div class="col-12">
	 <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
</div>
<div class="col-12 form-group">
	<label>Nama Usaha</label>
	<input type="text" name="nama_usaha" id="nama_usaha" class="form-control" required >
</div>
<div class="col-12 form-group">
	<label>Jenis Usaha</label>
	<input type="text" name="jenis_usaha" id="jenis_usaha" class="form-control" required >
</div>
<div class="col-12 form-group">
	<label>Alamat Usaha</label>
	<input type="text" name="alamat_usaha" id="alamat_usaha" class="form-control" required >
</div>
<div class="col-12 form-group">
	<label>Tanggal Berdiri</label>
	<input type="date" name="tanggal_berdiri" id="tanggal_berdiri" class="form-control" required >
</div>
<div class="col-12 float-right">
	<input type="submit" name="submit" value="AJUKAN" class="btn btn-primary float-right">
</div>
</div>
</form>