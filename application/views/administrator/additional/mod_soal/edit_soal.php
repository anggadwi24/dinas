<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Soal </h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_soal',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                   
                    <tr><th scope='row' width='100px'>Soal</th>             <td><textarea id='editor1' class='form-control' name='soal' style='height:260px' required>$rows[quiz]</textarea></td></tr>
                    <tr><th scope='row'>Jawaban A</th>              <td><textarea class='form-control' name='a' required>$rows[answer_a] </textarea></td></tr>
                    <tr><th scope='row'>Jawaban B</th>              <td><textarea class='form-control' name='b' required> $rows[answer_b]</textarea></td></tr>
                    <tr><th scope='row'>Jawaban C</th>              <td><textarea class='form-control' name='c' required> $rows[answer_c]</textarea></td></tr>
                    <tr><th scope='row'>Jawaban D</th>              <td><textarea class='form-control' name='d' required> $rows[answer_c]</textarea></td></tr>
";
?>
              
              
              <tr><th scope='row'>Jawaban</th>          
              <td><input type='radio' name='answer' value='A'  <?php if($rows['answer']=='A'){echo "checked";} ?>> A
              <input type= 'radio' name='answer' value='B' <?php if($rows['answer']=='B'){echo "checked";} ?>> B 
              <input type='radio' name='answer' value='C'  <?php if($rows['answer']=='C'){echo "checked";} ?> > C
              <input type='radio' name='answer' value='D'  <?php if($rows['answer']=='D'){echo "checked";} ?> > D </td></tr>
                  
                 
                    <tr><th scope='row'>Gambar</th>                
                    <td><input type='file' class='form-control' name='foto'>
                      <i style='color:red;'>Extensi : JPG,JPEG,PNG,GIF || Max Size : 10MB</i>
                      <br>
                      <?php if($rows['image'] != ""){
                        echo "<i><a href='".base_url('asset/foto_soal')."/$rows[image]' target='_BLANK'>$rows[image]</a></i>";
                      } ?>
                    </td></tr>
                   
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <input type="hidden" name="id" value="<?= $rows[id_quiz]?>">
                    <button type='submit' name='submit' class='btn btn-info'>Edit</button>
                    <a href='<?= base_url().$this->uri->segment(1)?>"/soal'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>
        </form>