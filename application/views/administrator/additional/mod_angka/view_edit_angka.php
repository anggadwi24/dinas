<?php 

    $tgl = date('Y-m-d',strtotime($rows['date']));
    $start = date('H:i',strtotime($rows['start']));
    $end = date('H:i',strtotime($rows['end']));
    if($rows['status']=='2'):
      $active = 'selected';
    elseif($rows['status']=='3'):
      $active ='selected';
    elseif($rows['status']=='4'):
      $active ='selected';
    else:
      $active = '';
    endif;
    
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Tebak Angka</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_angka',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_angka]'>
                    <tr><th width='120px' scope='row'>Angka</th>    <td><input type='text' class='form-control' name='angka' value='$rows[angka]' required></td></tr>
                    <tr><th width='120px' scope='row'>Tanggal</th>    <td><input type='date' class='form-control' name='tgl' required value='$tgl'></td></tr>
                     <tr><th width='120px' scope='row'>Start</th>    <td><input type='time' class='form-control' value='$start' name='start' required></td></tr>
                      <tr><th width='120px' scope='row'>End</th>    <td><input type='time' class='form-control' value='$end' name='end' required></td></tr>
                       <tr><th width='120px' scope='row'>Tipe</th>   
                        <td> ";
                    ?>
                        <select name='tipe' class='form-control'>
                          <option value='2' <?php if($rows[status] == '2') {echo "selected";} ?> >2 Angka</option>
                            <option value='3' <?php if($rows[status] == '3') {echo "selected";} ?> >3 Angka</option>
                              <option value='4' <?php if($rows[status] == '4') {echo "selected";} ?>  >4 Angka</option>


                        </select>
                       </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='<?= base_url('administrator/angka')?>'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";

