 <style type="text/css">
.custom-file-upload {
  border: 1px solid #ccc;
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
}
 </style>

 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $judul ?></h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
        <form action="<?= base_url('home/add_pengaduan')?>" method="POST" enctype="multipart/form-data">
        <div class="row justify-content-center" >
            
            <div class="col-12 form-group">
              <label>Kategori Pengaduan</label>
              <div class="row justify-content-between">
                <div class="col-5 border border-primary p-3 ml-3">
               <div class="form-check form-check-inline  ">
                  <input class="form-check-input" type="radio" name="pengaduan" id="inlineRadio1" value="pengaduan" checked>
                  <label class="form-check-label" for="inlineRadio1">Pengaduan</label>
                </div>
                </div>
                <div class="col-5 border border-primary p-3 mr-3">
                    <div class="form-check form-check-inline box">
                    <input class="form-check-input" type="radio" name="pengaduan" id="inlineRadio2" value="aspirasi">
                    <label class="form-check-label" for="inlineRadio2">Aspirasi</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 form-group">
              <label>NIK</label>
              <input type="number" name="nik" id="nik" class="form-control" required>
            </div>
            <div class="col-12 form-group">
              <label>Judul Laporan</label>
              <input type="text" name="judul_laporan"  class="form-control" style="height: 80px;" required>
            </div>
            <div class="col-12 form-group">
              <label>Isi Laporan</label>
              <textarea name="isi_laporan" id="ckeditor" ></textarea>
            </div>
             <div class="col-12 form-group">
              <label>Tanggal Laporan</label>
              <input type="date" name="tanggal_laporan"  class="form-control" value="<?= date('Y-m-d')?>"  required>
            </div>
            `<div class="col-12 form-group">
               <label for="file-upload" class="custom-file-upload w-100">
                <i class="ri-upload-cloud-line" style="font-size: 15px;margin-top: 1000px !important;"></i> Upload Image
              </label>
              <input id="file-upload" name='file' type="file" style="display:none;">
            </div>
            <div class="col-12">
              <input type="submit" name="submit" value="AJUKAN" class="btn btn-primary w-100">
            </div>
        </form>     
     
        
      </div>
  </section>
<script type="text/javascript">
$('#file-upload').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload')[0].files[0].name;
  $(this).prev('label').text(file);
});
</script>