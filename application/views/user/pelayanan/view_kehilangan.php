<form action="<?= base_url('home/add_kehilangan')?>" method="POST">
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h2>FORM KETERANGAN HILANG/TERCECER</h2>
</div>
</div>

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

<div class="col-12 form-group">
	<label>Provinsi</label>
	<div id="frmProv"></div>
	<select class="form-control" name="provinsi" id="prov" onchange="getkab(this)">
		<option></option>
		<?php 

			foreach($provinsi as $prv){
				echo "<option value='".$prv['id_prov']."'>".$prv['nama']."</option>";
			}
		?>
	</select>
	
</div>
<div class="col-12 form-group">
	<div id="frmKab"></div>
	<label>Kabupaten</label>
	<select class="form-control" name="kabupaten" id="kab" onchange="getkec(this)">
		<option></option>
	</select>
</div>
<div class="col-12 form-group">
	<div id="frmKec"></div>
	<label>Kecamatan</label>
	<select class="form-control" name="kecamatan" id="kec"  onchange="getkel(this)">
		<option></option>
	</select>
</div>
<div class="col-12 form-group">
	<div id="frmKel"></div>
	<label>Kelurahan</label>
	<select class="form-control" name="kelurahan" id="kel">
		<option></option>
	</select>
</div>


<div class="col-12 form-group">
	<label>Maksud </label>
	<input type="text" name="maksud"  class="form-control" required >
</div>
<div class="col-12 form-group">
	<label>Kehilangan  </label>
	<textarea name="kehilangan" required class="form-control"></textarea>
	
</div>
<div class="col-12 float-right">
	<input type="submit" name="submit" value="AJUKAN" class="btn btn-primary w-100">
</div>
</div>
</form>