            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Slider</h3>
                 <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/tambah_slider'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Gambar</th>
                      
                       
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($slider->result_array() as $row){
                    ?>
                        <tr><td><?= $no ?></td>
                              <td><a target='_BLANK' href='<?= base_url('asset/slider').'/'.$row[gambar] ?>'><?= $row[gambar]?></a></td>
                            
                            
                              <td><center>
                               <a href="<?= base_url('administrator/edit_slider').'/'.$row['id_gambar']?>"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('administrator/hapus_slider').'/'.$row['id_gambar']?>"><i class="fa fa-trash"></i></a>
                              </center></td>
                      
                          </tr>
                      <?php 
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>