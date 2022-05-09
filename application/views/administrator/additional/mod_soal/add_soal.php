<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Soal </h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_soal',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                   
                    <tr><th scope='row' width='100px'>Soal</th>             <td><textarea id='editor1' class='form-control' name='soal' style='height:260px' required></textarea></td></tr>
                    <tr><th scope='row'>Jawaban A</th>              <td><textarea class='form-control' name='a' required> </textarea></td></tr>
                    <tr><th scope='row'>Jawaban B</th>              <td><textarea class='form-control' name='b' required> </textarea></td></tr>
                    <tr><th scope='row'>Jawaban C</th>              <td><textarea class='form-control' name='c' required> </textarea></td></tr>
                    <tr><th scope='row'>Jawaban D</th>              <td><textarea class='form-control' name='d' required> </textarea></td></tr>

                    <tr><th scope='row'>Jawaban</th>          <td><input type='radio' name='answer' value='A' checked> A
              <input type= 'radio' name='answer' value='B'> B 
              <input type='radio' name='answer' value='C'> C
              <input type='radio' name='answer' value='D'> D </td></tr>
                  
                 
                    <tr><th scope='row'>Gambar</th>                 <td><input type='file' class='form-control' name='foto'><i style='color:red;'>Extensi : JPG,JPEG,PNG,GIF || Max Size : 10MB</i></td></tr>
                   
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/soal'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
