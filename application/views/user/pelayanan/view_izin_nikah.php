<form action="<?= base_url('home/add_izin_nikah')?>" method="POST">
<div class="row justfiy-content-center">
<div class="col-12">
	<div class="section-title">
	<h2>FORM IZIN NIKAH</h2>
</div>
</div>
<div class="col-12">
	<h5>Yang bertanda tangan dibawah ini menjelaskan dengan sesungguhnya bahwa:</h5>
</div>
<div class="col-12 form-group">
	<h6>Yang bertanda tangan : </h6>
	<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="statusTTD" id="inlineRadio12" value="suami" checked>
  <label class="form-check-label" for="inlineRadio12">Calon Suami</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="statusTTD" id="inlineRadio22" value="istri">
  <label class="form-check-label" for="inlineRadio22">Calon Istri</label>
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
<div class="col-12">
	 <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
</div>
<div class="col-12">
	<div class="row">
		<div class="col-6">
			<div class="col-12"><h6>Adalah benar anak dari perkawinan seorang pria	:</h6></div>
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
					<option value="Laki-laki">Laki - Laki</option>
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
			<div class="col-12"><h6>Dengan seorang wanita</h6></div>
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
					<option value="Perempuan">Perempuan</option>
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
<div class="col-12">
	<h5>Calon  :</h5>

	
	<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="statusTo" id="inlineRadio1" value="suami" >
  <label class="form-check-label" for="inlineRadio1">Suami</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="statusTo" id="inlineRadio2" value="istri" checked>
  <label class="form-check-label" for="inlineRadio2"> Istri</label>
</div>

</div>
</div>
<div class="col-12 form-group">
	<label>NIK</label>
	<input type="number" name="nik_c" id="nik_c" class="form-control" required>
</div>
<div class="col-12 form-group">
	<label>Nama</label>
	<input type="text" name="nama_c" id="nama_c" class="form-control" required  onfocus="dataAnggotaC()">
</div>
<div class="col-6 form-group">
	<label>Tempat Lahir</label>
	<input type="text" name="tempatlahir_c" id="tempatlahir_c" class="form-control" required onfocus="dataAnggotaC()">
</div>
<div class="col-6 form-group">
	<label>Tanggal Lahir</label>
	<input type="date" name="tanggallahir_c" id="tanggallahir_c" class="form-control" required onfocus="dataAnggotaC()">
</div>
<div class="col-6 form-group" >
	<div id="frmAgama"></div>
	<label>Agama</label>
	 <select class="form-control" name="agama_c" required="" id="agama_c">
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Konghucu">Konghucu</option>
                  <option value="Buddha">Buddha</option>


     </select>
</div>
<div class="col-6 form-group" >
	<div id="frmJK3"></div>
	<label>Jenis Kelamin</label>
	<select class="form-control" id="jeniskelamin_c" name="jeniskelamin_c">
		<option value="Laki-laki">Laki - Laki</option>
		<option value="Perempuan">Perempuan</option>
	</select>
	
</div>
<div class="col-12 form-group">
	<label>Pekerjaan</label>
	<input type="text" name="pekerjaan_c" id="pekerjaan_c" class="form-control" required onfocus="dataAnggotaC()">
</div>
<div class="col-12 form-group">
	<label>Alamat</label>
	<input type="text" name="alamat_c" id="alamat_c" class="form-control" required onfocus="dataAnggotaC()">
</div>

<div class="col-12 form-group" >
	<div id="frmStatus3"></div>
	<label>Status</label>
	<select name="status_c" class="form-control" id="status_c">
		<option value="kawin">Kawin</option>
		<option value="belum kawin">Belum Kawin</option>
		<option value="cerai hidup">Cerai Hidup</option>
		<option value="cerai mati">Cerai Mati</option>
	</select>
</div>
<div class="col-12">
	 <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
</div>
<div class="col-12 form-group">
	<label>Waktu Nikah</label>
	<input type="datetime-local" name="waktu_nikah"  class="form-control" required >
</div>
<div class="col-12 form-group">
	<label>Tempat Nikah</label>
	<input type="text" name="tempat_nikah"  class="form-control" required >
</div>

<div class="col-12 form-group">
	<label>Wali</label>
	<select name="izin" id="izin" class="form-control" required onchange="waliPernikahan(this)">
	
		<option value="ibu&ayah">Ayah & Ibu</option>
		<option value="wali">Wali</option>
		<option value="ayah">Ayah</option>
		<option value="ibu">Ibu</option>
	</select>
</div>
<div class="col-12">
	<div class="row" id="dataIzin"></div>
</div>
<div class="col-12">
	<input type="submit" name="submit" class="btn btn-primary w-100" value="AJUKAN">
</div>
</form>