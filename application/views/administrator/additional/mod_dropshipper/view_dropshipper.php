            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Semua Transaksi Dropshipper</h3>
             <!--      <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_reseller'>Tambahkan Data</a> -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#waiting' id='waiting-tab' role='tab' data-toggle='tab' aria-controls='waiting' aria-expanded='true'>Dropshipper Menunggu Persetujuan </a></li>
                      <li role='presentation' class=''><a href='#approve' role='tab' id='approve-tab' data-toggle='tab' aria-controls='approve' aria-expanded='false'>Dropshipper Sudah Disetujui</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='waiting' aria-labelledby='waiting-tab'>
                        <table  class="table table-hovered">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        
                        <th>Nama Dropshipper</th>
                        <th>No Telpon</th>
                        <th>User Login</th>
                       
                        <th style='width:120px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){

                     if($row[kode_dropshipper] == NULL){?>

                    <tr>
                   
                    <td><?= $no ?></td>
                              <td><?= $row[nama_dropshipper] ?></td>
                              <td><?= $row[no_hp]?> </td>
                           
                              <td><?= $row[nama_lengkap] ?></td>
                     
                              <td><center>
                                <a class='btn btn-success btn-xs passingID' title='Detail Data' href='#' data-toggle="modal" data-target="#appModal" data-id="<?php echo $row[id_dropshipper]  ?> " ><span class='glyphicon glyphicon-ok-sign'></span> Approve</a>
                               
                              </center>

                             
                            </td>
                          </tr>
                     <?php $no++;
                    }
                  }
                  ?>
                  </tbody>
                </table>
                </div>
            <div role='tabpanel' class='tab-pane fade' id='approve' aria-labelledby='approve-tab'>
                             <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        
                        <th>Nama Dropshipper</th>
                        <th>No Telpon</th>
                        <th>Kode Dropshipper</th>
                        <th>User Login</th>
                       
                        <th style='width:150px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){

                     if($row[kode_dropshipper] != NULL){?>

                    <tr>
                   
                    <td><?= $no ?></td>
                              <td><?= $row[nama_dropshipper] ?></td>
                              <td><?= $row[no_hp]?> </td>
                              <td><?= $row[kode_dropshipper] ?></td>
                              <td><?= $row[nama_lengkap] ?></td>
                     
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Detail Data' href="<?php echo  base_url().'administrator/detail_dropshipper/'.$row[id_dropshipper]?> "><span class='glyphicon glyphicon-search'></span> Detail</a>
                       

                                <a class='btn btn-warning btn-xs passsEdit' title='Edit Data' href='".base_url()."administrator/edit_reseller/$row[id_reseller]'  data-toggle="modal" data-id="<?php echo $row[id_dropshipper]?>" data-nama="<?php echo $row[nama_dropshipper]?>" data-ktp="<?php echo $row[no_ktp]?>" data-rek="<?php echo $row[no_rekening]?>"  data-hp="<?php echo $row[no_hp] ?>" data-alamat="<?php echo $row[alamat]?>" data-kota="<?= $row[kota_id]?>" data-kecamatan="<?= $row[kecamatan] ?>" data-target="#editModal"><span class='glyphicon glyphicon-edit'></span></a>

                                <a class='btn btn-danger btn-xs' title='Delete Data' href="<?php echo base_url().'administrator/delete_dropshipper/'.$row[id_dropshipper]?>" onclick="return confirm('Apa anda yakin untuk hapus Data ini?')"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>
                     <?php $no++;
                    }
                  }
                  ?>
                  </tbody>
                </table>
            </div>
            
            
           </div>
           
                

                  </div>
                  
              </div>
          <div class="modal fade" id="appModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Approve Dropshipper</h5>
                                  </div>
                                  <form action="<?php echo base_url('administrator/appdropshipper')?>" method="post">

                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label>Kode Dropshipper</label><br>
                                      <input type="text" name="kode" class="form-control">
                                    </div>
                                 <input type="hidden" name="id_dropshipper" id="id" value="<?php echo $row[id_dropshipper]?>">

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            <!-- modal edit -->
                             <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Edit Dropshipper</h3>
                                  </div>
                                  <form action="<?php echo base_url('administrator/edit_dropshipper')?>" method="post">

                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label>Nama Dropshipper</label><br>
                                      <input type="text" name="nama" id="nama" class="form-control" required >
                                    </div>
                                     <div class="form-group">
                                      <label>No HP</label><br>
                                      <input type="text" name="nohp" id="nohp" class="form-control" required>
                                    </div>
                                     <div class="form-group">
                                      <label>Provinsi</label><br>
                                       <?php echo "<select  class='form-control' name='provinsi' id='proveditdrop' required>
                                            <option value=''>- Pilih -</option>";
                                            foreach ($provinsi as $prov) {
                                                echo "<option value='$prov[provinsi_id]'>$prov[nama_provinsi]</option>";
                                            }
                                        echo "</select>"; ?>
                                    </div>
                                     <div class="form-group">
                                      <label>Kota</label><br>
                                        <select  class='form-control' name='kota' id='citydropedit' required>
                                                <option value=''>- Pilih -</option>
                                        </select>                                    </div>
                                     <div class="form-group">
                                      <label>Kecamatan</label><br>
                                      <input type="text" name="kecamatan" id="kecamatan" class="form-control" required>
                                    </div>

                                     <div class="form-group">
                                      <label>Alamat</label><br>
                                      <textarea cols="5" rows="5" class="form-control" id="alamat" name="alamat"></textarea>
                                    </div>
                                     <div class="form-group">
                                      <label>No KTP</label><br>
                                      <input type="text" name="noktp" id="noktp" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>No Rek</label><br>
                                      <input type="text" name="norek" id="norek" class="form-control">
                                    </div>
                                 <input type="hidden" name="id_dropshipper" id="id" >

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Save">
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>                  

  <script>
    $(document).on("click", ".passingID", function () {
     var ids = $(this).attr('data-id');
     $(".modal-body #id").val( ids );
    });

      $(document).on("click", ".passsEdit", function () {
     var ids = $(this).attr('data-id');
     var nama = $(this).attr('data-nama');
     var nohp = $(this).attr('data-hp');
     var alamat = $(this).attr('data-alamat');
     var kota = $(this).attr('data-kota');
     var kecamatan = $(this).attr('data-kecamatan');
     var norek = $(this).attr('data-rek');
     var ktp = $(this).attr('data-ktp');
     $(".modal-body #id").val( ids );
     $(".modal-body #nama").val( nama );
     $(".modal-body #nohp").val( ids );
     $(".modal-body #nohp").val( nohp );
     $(".modal-body #alamat").val( alamat );
     $(".modal-body #kecamatan").val( kecamatan );
     $(".modal-body #norek").val( norek );
     $(".modal-body #noktp").val( ktp );


    });
         $(document).ready(function(){
        $('#proveditdrop').change(function(){
          var state_id = $(this).val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('auth/city'); ?>",
            data:"stat_id="+state_id,
            success: function(response){
              $('#citydropedit').html(response);
            }
          })
        })
      })
  </script>