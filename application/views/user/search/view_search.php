 <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $judul ?></h2>
          <hr style="width: 50%;border-top: 3px solid #f9ad4a; ">
          
        </div>
     
        <div class="row justify-content-center" >
           
            <div class="form-group col-12" >
              <label>Bidang</label>
              <select class="form-control" name="pelayanan" id="search_pel">
                  <option></option>
                <?php foreach ($pelayanan as $row): ?>
                  <option value="<?= $row['id_pelayanan']?>"> <?= $row['pelayanan']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div  class="form-group col-12">
              <label>Jenis</label>
              <select class="form-control" name="sub_pelayanan" id="search_sub">
                <option>
                  
                </option>
              </select>
            </div>
            <div  class="form-group col-12" id="formNIK">
              <label>NIK</label>
              <input type="text" name="nik" id="nik" class="form-control">
            </div>
            <div class="col-12 float-right mt-3 ">
              <button class="btn btn-primary w-100" id="search_btn">CARI</button>
            </div>

        </div>
        
        <div class="mt-5" id="dataPelayanan">


        </div>
                
      
        
      </div>
  </section>
<script type="text/javascript">
  $("#search_btn").on('click',function(){
          var link = $('#search_sub').val();
          var nik = $('#nik').val();
          $.ajax({
            type:"POST",
            url:link,
            data:"nik="+nik,
            success: function(response){
              $('#dataPelayanan').html(response);
            }
          })
        
       });
</script>