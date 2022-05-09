<form action="<?= base_url('home/add_wali_pernikahan')?>" method="POST">
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h2>FORM KETERANGAN WALI PERNIKAHAN</h2>
</div>
</div>
			<div class="col-12">
				<label>Saya yang bertanda tangan (mertua) : </label>
			</div>
			<div class="col-12 form-group">
				<label>NIK</label>
				<input type="number" name="nik" id="nik" class="form-control" required>
			</div>
			<div class="col-12 form-group">
				<label>Nama</label>
				<input type="text" name="nama" id="nama" class="form-control" required  onfocus="dataAnggotaNew()">
			</div>
			<div class="col-12 form-group">
				<label>Tempat Lahir</label>
				<input type="text" name="tempatlahir" id="tempatlahir" class="form-control" required onfocus="dataAnggotaNew()">
			</div>
			<div class="col-12 form-group">
				<label>Tanggal Lahir</label>
				<input type="date" name="tanggallahir" id="tanggallahir" class="form-control" required onfocus="dataAnggotaNew()">
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
					<option value="Laki-laki">Laki - Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
				
			</div>
			<div class="col-12 form-group">
				<label>Pekerjaan</label>
				<input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required onfocus="dataAnggotaNew()">
			</div>
			<div class="col-12 form-group">
				<label>Alamat</label>
				<input type="text" name="alamat" id="alamat" class="form-control" required onfocus="dataAnggotaNew()">
			</div>

			<div class="col-12">
	 			<hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
			</div>
			<div class="col-12">
				<label>Menantu : </label>
			</div>
			<div class="col-12 form-group">
				<label>NIK</label>
				<input type="number" name="nik1" id="nik1" class="form-control" required>
			</div>
			<div class="col-12 form-group">
				<label>Nama</label>
				<input type="text" name="nama1" id="nama1" class="form-control" required  onfocus="dataAnggotaNew1()">
			</div>
			<div class="col-12 form-group">
				<label>Tempat Lahir</label>
				<input type="text" name="tempatlahir1" id="tempatlahir1" class="form-control" required onfocus="dataAnggotaNew1()">
			</div>
			<div class="col-12 form-group">
				<label>Tanggal Lahir</label>
				<input type="date" name="tanggallahir1" id="tanggallahir1" class="form-control" required onfocus="dataAnggotaNew1()">
			</div>
			<div class="col-12 form-group" >
				<div id="frmAgama2"></div>
				<label>Agama</label>
				 <select class="form-control" name="agama1" required="" id="agama1">
			                  <option value="Islam">Islam</option>
			                  <option value="Kristen">Kristen</option>
			                  <option value="Katolik">Katolik</option>
			                  <option value="Hindu">Hindu</option>
			                  <option value="Konghucu">Konghucu</option>
			                  <option value="Buddha">Buddha</option>


			     </select>
			</div>
			<div class="col-12 form-group" >
				<div id="frmJK2"></div>
				<label>Jenis Kelamin</label>
				<select class="form-control" id="jeniskelamin1" name="jeniskelamin1">
					<option value="Laki-laki">Laki - Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
				
			</div>
			<div class="col-12 form-group">
				<label>Pekerjaan</label>
				<input type="text" name="pekerjaan1" id="pekerjaan1" class="form-control" required onfocus="dataAnggotaNew1()">
			</div>
			<div class="col-12 form-group">
				<label>Alamat</label>
				<input type="text" name="alamat1" id="alamat1" class="form-control" required onfocus="dataAnggotaNew1()">
			</div>
			<div class="col-12 form-group">
				<label>Hubungan Perwalian</label>
				<select class="form-control" name="hubungan" required>
					<option></option>
					<option value="Ayah Kandung">Ayah Kandung</option>
					<option value="Ibu Kandung"> Ibu Kandung</option>
					<option value="Saudara/Saudari">Saudara/Saudari</option>
					<option value="Ayah Tiri">Ayah Tiri</option>
					<option value="Ibu Tiri">Ibu Tiri</option>
					<option value="Saudara/Saudari Tiri">Saudara/Saudari Tiri</option>
					<option value="Paman">Paman</option>
					<option value="Bibi">Bibi</option>
				</select>
			</div>


<div class="col-12 float-right">
	<input type="submit" name="submit" value="AJUKAN" class="btn btn-primary w-100">
</div>
</div>
</form>