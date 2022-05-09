            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Popup Iklan </h3>
                 <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/tambahPopUp'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>File</th>
                        <th>Type</th>
                       
                     
                       
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    ?>
                        <tr><td><?= $no ?></td>
                              <td><a target='_BLANK' href='<?= base_url('asset/popup/').$row[file] ?>'><?= $row[file]?></a></td>
                              <td><?= ucfirst($row['type'])?></td>
                            
                        
                            
                              <td><center>
                               <a href="<?= base_url('administrator/editPopUp').'/'.$row['id_popup']?>"><i class="fa fa-edit text-warning"></i></a>
                                  <a href="<?= base_url('administrator/deletePopUp').'/'.$row['id_popup']?>"><i class="fa fa-trash text-danger"></i></a>
                              </center></td>
                      
                          </tr>
                      <?php 
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>