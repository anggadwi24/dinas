 <section id="about" class="about">
      <div class="container" >

        <div class="section-title">
        
         <h5><?= $menu?></h5>
          
        </div>
     
        <div class="row mt-3 justify-content-center"  >
         
          <div class="col-11 form-group">
            <label>No KK</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-bank-card-2-fill"></i></div>
                </div>
                <input type="number" class="form-control" id="no_kk" placeholder=""  required="">
              </div>
          </div>
          <div class="col-11 form-group">
              <label>Nama Kepala Keluarga</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-user-fill"></i></div>
                </div>
                <input type="text" class="form-control"  placeholder="" id="nama_kepala_keluarga" required="">
              </div>
          </div>
          <div class="col-11 form-group">
              <label>Provinsi</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-earth-fill"></i></div>
                </div>
                <select class="form-control" id="prov">
                  <option>   Pilih   </option>
                  <?php 
                      foreach($provinsi as $prov){
                        echo "<option value='".$prov['id_prov']."'>".$prov['nama']."</option>";
                      }

                  ?>
                </select>
              </div>
          </div>
          <div class="col-11 form-group">
              <label>Kabupaten</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-earth-fill"></i></div>
                </div>
                <select class="form-control" id="kab">
                  <option>   Pilih   </option>
                  
                </select>
              </div>
          </div>
           <div class="col-11 form-group">
              <label>Kecamatan</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-earth-fill"></i></div>
                </div>
                <select class="form-control" id="kec">
                  <option>   Pilih   </option>
                  
                </select>
              </div>
          </div>
           <div class="col-11 form-group">
              <label>Kelurahan</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-earth-fill"></i></div>
                </div>
                <select class="form-control" id="kel">
                  <option>   Pilih   </option>
                  
                </select>
              </div>
          </div>
           <div class="col-11 form-group">
              <label>Alamat</label>
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" ><i class="ri-earth-fill"></i></div>
                </div>
                <textarea class="form-control" id="alamat" required></textarea>
              </div>
          </div>
          
          
           <div class="col-5 form-group ">
           
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" >Kode Pos</div>
                </div>
                <input type="number" class="form-control"  placeholder="" id="kode_pos" ">
              </div>
          </div>
          <div class="col-3 form-group ">
           
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" >RT</div>
                </div>
                <input type="number" class="form-control"  placeholder="" id="rt" ">
              </div>
          </div>
          <div class="col-3 form-group ">
           
             <label class="sr-only" for="rupiah">Nominal Pemasukan</label>
              <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text text-dark bg-white" >RW</div>
                </div>
                <input type="number" class="form-control"  placeholder="" id="rw" ">
              </div>
          </div>
           
          <div class="col-11">
            <button id="btnNext" class="btn btn-primary w-100">NEXT</button>
          </div>
          
        </div>
         
        
      </div>
  </section>

  <script type="text/javascript">


      $("#btnNext").click(function(){
      var no_kk = $("#no_kk").val();
      var nama_kepala_keluarga = $("#nama_kepala_keluarga").val();
      var prov = $("#prov").val();
      var kab = $("#kab").val();
      var kec = $("#kec").val();
      var kel = $( "#kel" ).val();
      var alamat = $('textarea#alamat').val();
      var kode_pos = $("#kode_pos").val();
      var rt = $("#rt").val();
      var rw = $( "#rw" ).val();

       $.ajax({
         type: "POST",
         url: "<?= base_url('pegawai/do_addkk')?>", 
         data:{no_kk:no_kk, nama_kepala_keluarga:nama_kepala_keluarga,prov:prov,kab:kab,kec:kec,kel:kel,alamat:alamat,kode_pos:kode_pos,rt:rt,rw:rw},
         dataType: "text",  
         cache:false,
         success: function(data){
            if(data == 0){
              Swal.fire({

              title: 'Success',
              text: 'Kartu Keluarga Berhasil Dibuat',
               customClass: 'swal-wide',
               type:'success',
              
            }).then(function() {
                window.location = "<?= base_url('pegawai/detail_kk/')?>"+no_kk;
            });
            }else{
              $("#no_kk").focus();
               Swal.fire({

              title: 'Error',
              text: 'No KK Sudah Dipakai',
               customClass: 'swal-wide',
               type:'error',
              
            });

            }
                //window.location.href = "<?= base_url('pegawai/kas/') ?>";
          
          }
          });// you have missed this bracket

    });

   
  </script>