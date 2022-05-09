<form action="<?= base_url('home/add_surat_kelahiran')?>" method="POST">
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h2>FORM SURAT KELAHIRAN</h2>
</div>
</div>
<div class="col-12">
	<div class="row">
		<div class="col-6">
			<div class="col-12"><h6>Ayah	:</h6></div>
			<div class="col-12 form-group">
				<label>NIK</label>
				<input type="number" name="nik_ayah" id="nik_ayah" class="form-control" required>
			</div>
			<div class="col-12 form-group">
				<label>Nama</label>
				<input type="text" name="nama_ayah" id="nama_ayah" class="form-control" required  onfocus="dataAnggotaA()">
			</div>
			<div class="col-12 form-group">
				<label>Tempat Lahir</label>
				<input type="text" name="tempatlahir_ayah" id="tempatlahir_ayah" class="form-control" required onfocus="dataAnggotaA()">
			</div>
			<div class="col-12 form-group">
				<label>Tanggal Lahir</label>
				<input type="date" name="tanggallahir_ayah" id="tanggallahir_ayah" class="form-control" required onfocus="dataAnggotaA()">
			</div>
			<div class="col-12 form-group" >
				<div id="frmAgama1"></div>
				<label>Agama</label>
				 <select class="form-control" name="agama_ayah" required="" id="agama_ayah">
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
				<select class="form-control" id="jeniskelamin_ayah" name="jeniskelamin_ayah">
					<option value="Laki-laki" selected>Laki - Laki</option>
					<option value="Perempuan">Perempuan</option>
					
				</select>
				
			</div>
			<div class="col-12 form-group">
				<label>Pekerjaan</label>
				<input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control" required onfocus="dataAnggotaA()">
			</div>
			<div class="col-12 form-group">
				<label>Alamat</label>
				<input type="text" name="alamat_ayah" id="alamat_ayah" class="form-control" required onfocus="dataAnggotaA()">
			</div>
		</div>
		<div class="col-6">
			<div class="col-12"><h6>Ibu :</h6></div>
			<div class="col-12 form-group">
				<label>NIK</label>
				<input type="number" name="nik_ibu" id="nik_ibu" class="form-control" required>
			</div>
			<div class="col-12 form-group">
				<label>Nama</label>
				<input type="text" name="nama_ibu" id="nama_ibu" class="form-control" required  onfocus="dataAnggotaI()">
			</div>
			<div class="col-12 form-group">
				<label>Tempat Lahir</label>
				<input type="text" name="tempatlahir_ibu" id="tempatlahir_ibu" class="form-control" required onfocus="dataAnggotaI()">
			</div>
			<div class="col-12 form-group">
				<label>Tanggal Lahir</label>
				<input type="date" name="tanggallahir_ibu" id="tanggallahir_ibu" class="form-control" required onfocus="dataAnggotaI()">
			</div>
			<div class="col-12 form-group" >
				<div id="frmAgama2"></div>
				<label>Agama</label>
				 <select class="form-control" name="agama_ibu" required="" id="agama_ibu">
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
				<select class="form-control" id="jeniskelamin_ibu" name="jeniskelamin_ibu">
					<option value="Laki-laki">Laki - Laki</option>
					<option value="Perempuan" selected>Perempuan</option>
				</select>
				
			</div>
			<div class="col-12 form-group">
				<label>Pekerjaan</label>
				<input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control" required onfocus="dataAnggotaI()">
			</div>
			<div class="col-12 form-group">
				<label>Alamat</label>
				<input type="text" name="alamat_ibu" id="alamat_ibu" class="form-control" required onfocus="dataAnggotaI()">
			</div>
		</div>
	</div>
</div>
<div class="col-12">
	 <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
</div>
<div class="col-12 text-center"><h6>Melahirkan seorang anak : </h6></div>
		<div class="col-12 form-group">
			<label>Anak Ke : </label>
			<input type="number" name="anak" value="1" class="form-control" required>
		</div>
		<div class="col-12 form-group">
			<label>Nama : </label>
			<input type="text" name="nama" class="form-control" required>
		</div>
		<div class="col-12 form-group">
			<label>Tanggal : </label>
			<input type="date" name="tanggal" class="form-control" required>
		</div>
		<div class="col-12 form-group">
			<label>Jenis Kelamin : </label>
			<select class="form-control" name="jk" required="">
				<option></option>
				<option value="Laki-laki">Laki - Laki</option>
				<option value="Perempuan">Perempuan</option>
			</select>
		</div>
		<div class="col-12 form-group">
			<label>Alamat : </label>
			<input type="text" name="alamat" class="form-control" required>
		</div>

<div class="col-12">
	<input type="submit" name="submit" class="btn btn-primary w-100" value="AJUKAN">
</div>
	
</div>
</form>