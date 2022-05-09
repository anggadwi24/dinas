<style type="text/css">
  input[readonly="readonly"] {
      outline: 0;border-width: 0 0 2px;border-color: #f9ad4a;background-color: white!important;
}
<?php  
    $sub = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$this->session->sub_bagian))->row_array();
?>
</style>
 <section id="about" class="about">
      <div class="container-fluid" data-aos="fade-up" >

              
            

             <form action="<?= base_url('pegawai/pengaduan')?>" method="POST" enctype="multipart/form-data" onsubmit="$('#loader').show();">
              <div class="row">
                <div class="col-12">
                  <h1 class="text-center" style="color:#f9ad4a;">Form Pengaduan</h1>
                   <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
                </div>
               
                <div class="col-12">
                <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d')?>" required>
              </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" id="ckeditor" rows="6" name="keterangan" required></textarea>
              </div>
              </div>
              
               <div class="col-md-12">
                <div class="form-group">
                 <label>Foto</label>
                <input type="file" name="file" class="form-control" accept="image/*" capture>
                </div>
              </div>
             
             
           

            


            <div class="col-md-12">
             <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-warning col-12 my-3 text-light">AJUKAN</button>
              </div>
              </div>
              </div>

            </form>

            </div>
        
  </section>

  <script type="text/javascript">

    setDate();
    function setDate(){
    var dari = document.getElementById("dari").value;
    document.getElementById('sampai').setAttribute("min", dari);
    }

  </script>
  <script type="text/javascript">
     $(document).ready(function() {
      $("#sakit").hide();
      $("#ijin").show();
         $('#formSelect').change(function(){
          var form = $('#formSelect').val();
          if(form == 'sakit'){
             $("#sakit").show();
              $("#ijin").hide();
          }else{
             $("#sakit").hide();
      $("#ijin").show();
          }

        });
      } );
  </script>