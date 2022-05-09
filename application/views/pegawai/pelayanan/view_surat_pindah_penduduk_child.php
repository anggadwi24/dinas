 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $judul ?></h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
        <div class="row">
          <div class="col-12 form-group">
            <label>NAMA KEPALA</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $parent['nama_lengkap']?>">
          </div>
           <div class="col-12 form-group">
            <label>NIK KEPALA</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $parent['nik']?>">
          </div>
       
        <?php 

          $dari =  $this->db->query("SELECT *,a.nama as nama_prov, b.nama as nama_kab, c.nama as nama_kec, d.nama as nama_kel FROM provinsi a JOIN kabupaten b ON a.id_prov = b.id_prov JOIN kecamatan c ON b.id_kab = c.id_kab JOIN kelurahan d ON c.id_kec = d.id_kec WHERE d.id_kel = ".$parent['kelurahan']."")->row_array();
        ?>
        <div class="col-12"><h6>Dari : </h6></div>
        <div class="col-12 form-group">
            <label>ALAMAT</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $parent['alamat']?>">
        </div>
        <div class="col-12 form-group">
            <label>PROVINSI</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $dari['nama_prov']?>">
        </div>
        <div class="col-12 form-group">
            <label>KABUPATEN</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $dari['nama_kab']?>">
        </div>
        <div class="col-12 form-group">
            <label>KECAMATAN</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $dari['nama_kec']?>">
        </div>
        <div class="col-12 form-group">
            <label>KELURAHAN</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $dari['nama_kel']?>">
        </div>
         <div class="col-12"><h6>Ke : </h6></div>
         <div class="col-12 form-group">
            <label>ALAMAT</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $row['alamat_pindah']?>">
        </div>
        <div class="col-12 form-group">
            <label>PROVINSI</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $loc['nama_prov']?>">
        </div>
        <div class="col-12 form-group">
            <label>KABUPATEN</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $loc['nama_kab']?>">
        </div>
        <div class="col-12 form-group">
            <label>KECAMATAN</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $loc['nama_kec']?>">
        </div>
        <div class="col-12 form-group">
            <label>KELURAHAN</label>
            <input type="text" name="asd" readonly="" class="form-control" value="<?= $loc['nama_kel']?>">
        </div>

      </div>

        <div class="row justify-content-center" >
           
           <div class="col-6"><h6>Tambah Anggota Keluarga : </h6></div><div class="col-6"><div class="form-inline float-right"><div class="form-group mx-sm-3 mb-2"><label for="inputPassword2" class="sr-only">Password</label><input type="number" class="form-control" id="jumlah" value="1"></div><span  class="btn btn-primary mb-2" id="sbmTot">TAMBAH</span></div></div>

        </div>
        <form action="<?= base_url('home/add_child_pindah_penduduk')?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_sp" value="<?= $row['id_sp'] ?>">
        <input type="hidden" name="provinsi" value="<?= $parent['provinsi']?>">
        <input type="hidden" name="kabupaten" value="<?= $parent['kabupaten']?>">
        <input type="hidden" name="kecamatan" value="<?= $parent['kecamatan']?>">
        <input type="hidden" name="kelurahan" value="<?= $parent['kelurahan']?>">
        <input type="hidden" name="alamat" value="<?= $parent['alamat']?>">

        <input type="hidden" name="provinsi_pindah" value="<?= $row['provinsi_pindah']?>">
        <input type="hidden" name="kabupaten_pindah" value="<?= $row['kabupaten_pindah']?>">
        <input type="hidden" name="kecamatan_pindah" value="<?= $row['kecamatan_pindah']?>">
        <input type="hidden" name="kelurahan_pindah" value="<?= $row['kelurahan_pindah']?>">
        <input type="hidden" name="alamat_pindah" value="<?= $row['alamat_pindah']?>">
        <input type="hidden" name="tanggal" value="<?= $row['tanggal']?>">
        <input type="hidden" name="alasan" value="<?= $row['alasan']?>">

        <div class="row" id="dataPelayanan">
       

        </div>
        <div class="col-12">
          <input type="submit" name="submit" value="AJUKAN" class="btn btn-primary w-100">
        </div>
      </form>
      
        
      </div>

     <script type="text/javascript">
       $( document ).ready(function() {
     

      $( "#sbmTot" ).click(function() {
       var jumlah = $('#jumlah').val();
      
        var jml = jumlah - tot;
       
        inputVoc(jml);
      });
       var tot = $('#jumlah').val();
      var html = "";
      inputVoc(tot);


      function inputVoc(tot){
         
          var tgl = ("<?= date('Y-m-d',strtotime("+1 Year"))?>");
       
     
          for (let i = 0; i < tot; i++) {
              html += '   <div class="col-12 form-group"><label>NIK</label><input type="number" name="nik[]" id="nik" class="form-control" required></div>'
                   +'<div class="col-12 form-group"><label>Nama</label><input type="text" name="nama[]" id="nama" class="form-control" required  onfocus="dataAnggota2()"></div>'
                  + '<div class="col-6 form-group"><label>Tempat Lahir</label><input type="text" name="tempatlahir[]" id="tempatlahir" class="form-control" required onfocus="dataAnggota2()"></div>'
                  + '<div class="col-6 form-group"><label>Tanggal Lahir</label><input type="date" name="tanggallahir[]" id="tanggallahir" class="form-control" required onfocus="dataAnggota2()"></div>'
                  + '<div class="col-6 form-group" ><div id="frmAgama"></div><label>Agama</label><select class="form-control" name="agama[]" required="" id="agama"><option value="Islam">Islam</option><option value="Kristen">Kristen</option><option value="Katolik">Katolik</option><option value="Hindu">Hindu</option><option value="Konghucu">Konghucu</option><option value="Buddha">Buddha</option></select></div>'
                  + '<div class="col-6 form-group" ><div id="frmJK"></div><label>Jenis Kelamin</label><select class="form-control" id="jeniskelamin" name="jeniskelamin[]"><option value="Laki-laki">Laki - Laki</option><option value="Perempuan">Perempuan</option></select></div>'
                  + '<div class="col-12 form-group"><label>Pekerjaan</label><input type="text" name="pekerjaan[]" id="pekerjaan" class="form-control" required onfocus="dataAnggota2()"></div>'
                 
                  + '<div class="col-12 form-group" ><div id="frmStatus"></div><label>Status</label><select name="status[]" class="form-control" id="status" required=""><option value="kawin">Kawin</option><option value="belum kawin">Belum Kawin</option><option value="cerai hidup">Cerai Hidup</option><option value="cerai mati">Cerai Mati</option></select></div>'
                  + '<div class="col-12 form-group"><label>Status Hubungan</label><select class="form-control" name="status_hubungan[]" id="status_hubungan" required=""> <option >   PILIH   </option>  <option value="kepala keluarga">KEPALA KELUARGA</option>                            <option value="suami" >SUAMI</option>                            <option value="istri">ISTRI </option>                            <option value="anak">ANAK</option>                            <option value="menantu">MENANTU</option>                            <option value="cucu">CUCU</option>                            <option value="orang tua">ORANG TUA</option>                            <option value="mertua">MERTUA</option>                            <option value="famili lain">FAMILI LAIN</option>                            <option value="pembantu">PEMBANTU</option>                            <option value="lainnya">LAINNYA</option> </select> </div>'
                  + '<div class="col-12"> <hr style="width: 50%;border-top: 3px solid #f9ad4a; "> </div>';

          }
          $('#dataPelayanan').append(html);

      }
  });

     </script>
