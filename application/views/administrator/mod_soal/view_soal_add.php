  
  <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Form Soal</h5>
                            </div>
                            <div class="card-body">
                                
                                <form class="needs-validation"  id="formAdd">
                                  <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                      <label for="validationCustom01">Soal</label>
                                      <textarea id="summernote" name="soal"></textarea>

                                      
                                    </div>
                                    <div class="col-md-12 mb-3">
                                      <label for="validationCustom02">Image</label>
                                      <input type="file" class="form-control" name="file"  id="validationCustom07"   >
                                      
                                    </div>
                                    <div class="col-md-12 mb-3">
                                      <label for="validationCustomUsername">Answer A</label>
                                     
                                       <textarea class="summernote" name="answer_a" required></textarea>
                                        
                                      
                                    </div>
                                    <div class="col-md-12 mb-3">
                                      <label for="validationCustomUsername">Answer B</label>
                                     
                                       <textarea class="summernote" name="answer_b" required></textarea>
                                        
                                      
                                    </div>
                                    <div class="col-md-12 mb-3">
                                      <label for="validationCustomUsername">Answer C</label>
                                     
                                       <textarea class="summernote" name="answer_c" required></textarea>
                                        
                                      
                                    </div>
                                    <div class="col-md-12 mb-3">
                                      <label for="validationCustomUsername">Answer D</label>
                                     
                                       <textarea class="summernote" name="answer_d" required></textarea>
                                        
                                      
                                    </div>
                                    <div class="col-md-12">
                                      <label>Jawaban Benar</label>
                                      <select class="form-control " name="answer" required>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>

                                      </select>
                                    </div>
                                    
                                     <div class="col-md-12 mb-3">
                                      <label for="validationCustomUsername">Correction</label>
                                     
                                       <textarea class="summernote" name="correction" required></textarea>
                                        
                                      
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="kelas">Kelas</label>
                                      <select name="kelas" class="form-control" id="kelas" required >
                                          
                                      <option disabled selected></option>
                                      <option value="I">I</option>
                                      <option value="II">II</option>
                                      <option value="III">III</option>
                                      <option value="IV">IV</option>
                                      <option value="V">V</option>
                                      <option value="VI">VI</option>
                                      <option value="VII">VII</option>
                                      <option value="VIII">VIII</option>
                                      <option value="IX">IX</option>
                                      <option value="X">X</option>
                                      <option value="XI">XI</option>
                                      
                                      <option value="XII">XII</option>

                                      </select>
                                     
                                     
                                    </div>
                                    <div class="col-md-6 form-group">
                                      <label for="">Mata Pelajaran</label>
                                      <select name="mata_pelajaran" id="mapel" class="form-control">
                                        <option disabled selected></option>
                                      </select>
                                    </div>

                                  </div>
                                  
                                
                                  <button class="btn btn-primary float-right" id="btnAdd" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>

<script type="text/javascript">
  $(document).on('change','#kelas',function(){
    var kelas = $(this).val();
    $.ajax({
      type:'POST',
      url:'<?= base_url('administrator/seeMapel') ?>',
      data:{kelas:kelas},
      success:function(resp){
        $('#mapel').html(resp);
      }
    })
  })
     $("#formAdd").on('submit', function(e){
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:'<?= base_url('administrator/doAddSoal') ?>',

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'json',
           
         
            beforeSend: function(){
                
                $('#formAdd input').prop('disabled',true);
                $('textarea').prop('disabled',true);

                $('#btnAdd').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading....');
                $('#btnAdd').prop('disabled',true);
   
            },
             error:function(){
             
                 Swal.fire({

                  title: '404',
                  text: 'Something error!',
                   customClass: 'swal-wide',
                   type:'error',
                  
                })
               
            },
          
            success: function(resp){
               
              if(resp.status == true){
                
                $('#formAdd input').val('');
               $('.summernote').summernote('insertText', '');
               $('#summernote').summernote('insertText', '');


                     swal({
                      title: 'Data Berhasil Diinput',
                      text: 'Tetap dihalaman ini atau kembali?',
                      type: 'success',
                      showCancelButton: true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Kembali',
                      cancelButtonText: 'Tetap'
                    }).then(result => {
                     
                        // handle confirm
                        window.location ='<?= base_url('administrator/soal') ?>';
                      
                    });
              }
               
            }, 
             complete: function() {
               $('#formAdd input').prop('disabled',false);
                $('textarea').prop('disabled',false);

               $('#btnAdd').html('Submit');
                $('#btnAdd').prop('disabled',false);
            },
        });
    });
</script>

        <script type="text/javascript">
// Use any event to append the code
$(document).ready(function() 
{
  var link = '<?= theme()?>/plugins/summernote/summernote-bs4.css'
    var s = document.createElement("link");
    s.rel = "stylesheet";
    s.src =link;
    // Use any selector
    $("head").append(s);


     var c = document.createElement("script");
    c.type = "text/javascript";
    c.src = "<?= theme()?>/plugins/summernote/summernote-bs4.min.js";
    // Use any selector
    $("head").append(c);
});
</script>