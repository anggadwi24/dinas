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

              <div class="row"> 
                <div class="col-12">
                  <div class="form-group">
                    <label> Pilih Form</label>
                    <select id="formSelect" class="form-control">
                      <option value="ijin"> Ijin </option>
                      <option value="sakit"> Sakit </option>
                    </select>
                  </div>
                  <div> <hr style="width: 100%;border-top: 1px solid #f9ad4a; "></div>
                </div>
              </div>
              <form method="post" action="<?= base_url('pegawai/do_form')?>" enctype="multipart/form-data" onsubmit="$('#loader').show();" id="sakit">
              <div class="row">
                <div class="col-12">
                   <h1 class="text-center" style="color:#f9ad4a;">Form Sakit</h1>
                   <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
                </div>

                <div class="col-6">
                <div class="form-group">
                  <label>Dari</label>
                  <input type="hidden" name="status" value="sakit">
                  <input type="date" name="dari" id="dari" class="form-control" min="<?php echo date('Y-m-d'); ?>" required value="<?= date('Y-m-d')?>">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Sampai</label>
                  <input type="date" name="sampai" id="sampai" class="form-control" required value="<?= date('Y-m-d',strtotime("+1 Days"))?>">
                </div>
              </div>
              
               <div class="col-md-12">
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan" required></textarea>
                </div>
             </div>
             
             
              <div class="col-md-12">
              <div class="form-group">
                <label>Foto</label>
               
                 
                  <input type="file"  class="form-control"  required accept="image/*"  name='files[]' capture multiple>
                 
                 
                </div>
               
             
              </div>
           

            


            <div class="col-md-12">
             <div class="form-group">
                  <button type="submit" class="btn btn-warning col-12 my-3 text-light">AJUKAN</button>
              </div>
              </div>
              </div>

            </form>

             <form method="post" action="<?= base_url('pegawai/do_form')?>" enctype="multipart/form-data" onsubmit="$('#loader').show();" id="ijin">
              <div class="row">
                <div class="col-12">
                  <h1 class="text-center" style="color:#f9ad4a;">Form Ijin</h1>
                   <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
                </div>
                <!--  <div class="col-12">
                  <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="a" value="<?= $this->session->nama_lengkap?>" class="form-control" style=" " readonly="readonly">
                   </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                        <label>No KTP</label>
                        <input type="text" name="a" value="<?= $this->session->no_ktp?>" class="form-control" style=" " readonly="readonly">
                   </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                        <label>Sub Bagian</label>
                        <input type="text" name="a" value="<?= $sub[nama_sub_bagian]?>" class="form-control" style=" " readonly="readonly">
                   </div>
                </div> -->
                <div class="col-6">
                <div class="form-group">
                  <label>Dari</label>
                    <input type="hidden" name="status" value="izin">
                  <input type="date" name="dari" id="dari" class="form-control" min="<?php echo date('Y-m-d'); ?>" required value="<?= date('Y-m-d')?>">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Sampai</label>
                  <input type="date" name="sampai" id="sampai" class="form-control" required value="<?= date('Y-m-d',strtotime("+1 Days"))?>">
                </div>
              </div>
              
               <div class="col-md-12">
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan" required></textarea>
                </div>
              </div>
             
             
           

            


            <div class="col-md-12">
             <div class="form-group">
                  <button type="submit" class="btn btn-warning col-12 my-3 text-light">AJUKAN</button>
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