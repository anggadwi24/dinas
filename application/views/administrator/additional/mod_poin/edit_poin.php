<?php 

  $time = date('Y-m-d H:i');
  $date = date('Y-m-d\TH:i:s',strtotime($row['mulai']));
  $end = date('Y-m-d\TH:i:s', strtotime($row['selesai']));

?>
<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Poin Tambahan </h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_poin',$attributes); 

          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                   
                    <tr><th scope='row' width='100px'>Judul</th><td><input type='text' required name='judul' class='form-control' value='$row[judul]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>              <td><input type='text' required name='keterangan' class='form-control' value='$row[keterangan]'></td></tr>
                    <tr><th scope='row'>Poin</th>              <td><input type='number' required name='poin' class='form-control' value='$row[poin]'></td></tr>
                    <tr><th scope='row'>Link</th>              <td><input type='text' required name='link' class='form-control' value='$row[link]'></td></tr>
                    <tr><th scope='row'>Tombol</th>              <td><input type='text' required name='tombol' class='form-control' value='$row[tombol]'></td></tr>

                    <tr><th scope='row'>Status</th>          <td>
                    ";
                    ?>


                    <label><input type='radio' name='status' value='50' <?php if($row['status'] == '50'){echo "checked";}?> > 50 Soal</label>
                    <label><input type='radio' name='status' value='80' <?php if($row['status'] == '80'){echo "checked";}?> > 80 Soal</label>
                    <label><input type='radio' name='status' value='100' <?php if($row['status'] == '100'){echo "checked";}?>> 100 Soal</label>
                   </td></tr>
                   <tr><th scope='row'>Jenis</th>
                       <td>
                       <select name='jenis' class='form-control'>
                          <option value='tautan' <?php if($row['jenis']=='tautan'){echo"selected";}?> >Tautan</option>
                          <option value='video' <?php if($row['jenis']=='video'){echo"selected";}?> >Video</option>

                       </select>
                       </td>
                    </tr>
                       <tr><th scope='row'>Mulai Tampil</th>              <td><input type='datetime-local' required name='mulai' class='form-control' value='<?= $date?>'></td></tr>
                   <tr><th scope='row'>Selesai Tampil</th>              <td><input type='datetime-local' required name='selesai' value='<?= $end ?>' class='form-control'></td></tr>
                  
                 <?php echo "
                    
                   
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Ubah</button>
                    <a href='".base_url().$this->uri->segment(1)."/poin'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>
            <input type='hidden' required name='id' class='form-control' value='$row[id_poin]'>";

            echo form_close();
