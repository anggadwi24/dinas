   

                          <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tambah Video</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   <a href="<?= base_url('administrator/videowebsite')?>" class="btn btn-primary mt-2 mb-5">KEMBALI</a>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-lg-12 form-group">
                            <h6>Video</h6>
                            <video width="320" height="240" controls>
                                                  <source src="<?= base_url('asset/video/').$row['video'] ?>" type="video/mp4">
                                               
                                                </video>
                          </div>
                          <div class="col-lg-12 form-group">
                            <label>Ganti Video :</label>
                            <input type="file" name="file" id="fileInput" class='form-control' accept="video/mp4,video/mkv,video/avi">
                          </div>
                         <div class="col-lg-12">
                                        <div class="progress" style="height:30px;">
                                                <div class="progress-bar" ></div>
                                            </div>
                                            <div id="uploadStatus"></div>
                                   </div>
                                   
                          

                                   <div class="col-md-12">
                                    <input type="hidden" name="id" value="<?= $row['id_video']?>">
                                    <input type="hidden" name="video" value="<?= $row['video']?>">
                                    <button class="btn btn-primary " style="width:100%" id="btnAdd">UBAH</button>
                                  
                                   
                                   </div>
                        </div>
                       

                    </form>
              
              </div>


    <script>
    $(document).ready(function(){
      
        $('.progress').hide();
        // File upload via Ajax
        $("#uploadForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.ceil(((evt.loaded / evt.total) * 100));
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete+'%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: '<?= base_url('administrator/editVideo')?>',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.progress').show();
                    $(".progress-bar").width('0%');

                    $('#btnAdd').hide();
                   
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
                     $('#uploadForm')[0].reset();
                    if(resp == 1){
                       
                          Swal.fire({

                                title: 'Success',
                                text: 'Video berhasil diubah!',
                                 customClass: 'swal-wide',
                                 type:'success',
                                
                              }).then(function() {
                        window.location = "<?= base_url('administrator/videowebsite')?>";
                    });
                    }else if(resp == 0){
                        Swal.fire({

                          title: 'Peringatan',
                          text: 'File Video Melebihi Kapasitas!',
                           customClass: 'swal-wide',
                           type:'error',
                          
                        })
                    }
                    else{
                        Swal.fire({

                          title: 'Peringatan',
                          text: 'File Video Melebihi Kapasitas!',
                           customClass: 'swal-wide',
                           type:'error',
                          
                        })
                    }
                }, 
                 complete: function() {
                    $('.progress').hide();
                    $('#btnAdd').show();
                },
            });
        });
        
        // File type validation
        $("#fileInput").change(function(){
            var allowedTypes = ['video/avi', 'video/mkv', 'video/mp4'];
            var file = this.files[0];
            var fileType = file.type;
            if(!allowedTypes.includes(fileType)){
              Swal.fire({

                          title: 'Peringatan',
                          text: 'Format Video Harus AVI,MKV,MP4',
                           customClass: 'swal-wide',
                           type:'error',
                          
                 })
                $("#fileInput").val('');
                return false;
            }
        });
    });
    </script>