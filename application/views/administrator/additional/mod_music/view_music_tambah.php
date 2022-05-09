<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Music</h3>
                </div>
              <div class='box-body'>
                <?php 
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_music',$attributes); 
              ?>
          <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Music</th>    <td><input type='text' class='form-control' name='music' required></td></tr>
                    <tr><th>File </th><td><input type="file" name="file" class="form-control" required="required"></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
          </form>