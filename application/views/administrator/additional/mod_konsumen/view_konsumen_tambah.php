 <?php if(validation_errors()){?><div class="alert alert-danger"><center><?=  validation_errors();?></center></div><?php }?>
<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Konsumen</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_konsumen',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th scope='row'>No Hp</th>                        <td><input class='form-control' type='number' name='k'></td></tr>
                    <tr><th scope='row'>Password</th>                     <td><input class='form-control' type='password' name='a'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>                 <td><input class='form-control' type='text' name='b'></td></tr>
                   
                  
                    
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
