<script>
    $(document).ready(function(){
    $('#appCapsule').removeClass('container');
    $('#appCapsule').css('padding-top','0');
    var menu = " <li id='profileBtn'> "
                    +"<a  class='item'>"
                        +"<div class='in'>"
                            +"<div>Ubah Profil</div>"
                        +"</div>"
                    +"</a>"
                +" </li>"
                + "<li id='sandiBtn'> "
                    +"<a  class='item'>"
                        +"<div class='in'>"
                            +"<div>Ubah Kata sandi</div>"
                        +"</div>"
                    +"</a>"
                +"</li>"
                        
                +"<li>"
                    +"<a href='<?= base_url('auth/logout')?>' class='item'>"
                        +"<div class='in'>"
                            +"<div class='text-danger'>Logout</div>"
                        +"</div>"
                    +"</a>"
                +"</li>";
    $('#menuSetting').html(menu);
    $(document).on('click', '#btnBackPrf', function() {
       
        $('#menuSetting').html(menu);
    });
    $(document).on('click', '#btnBackSnd', function() {
       
       $('#menuSetting').html(menu);
   });
    var html = null;
    $(document).on('submit', '#formProfile', function(e) {
    
        
        e.preventDefault();
        $.ajax({
          
            type: 'POST',
            url:"<?= base_url('profile/editProfile') ?>",

           
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType:'json',
           
         
            beforeSend: function(){
                
                $('#formProfile input').prop('disabled',true);
                $('#loading').css('display','');

               
                $('#formProfile button').prop('disabled',true);
   
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
                    $('#menuSetting').html(menu);
                    getData();

                    $('#DialogIconedDanger').modal('show');
                   
                    $('#titleError').html('Berhasil');
                    $('#dialogError').html(resp.msg);
                    $('#iconError').html('<ion-icon name="shield-checkmark-outline"></ion-icon>');


                }else {
                    

                    $('#DialogIconedDanger').modal('show');
                   
                    $('#titleError').html('Gagal');
                    $('#dialogError').html(resp.msg);
                    $('#iconError').html('<ion-icon name="close-circle-outline"></ion-icon>');
                }
                
             
                
               
            }, 
             complete: function() {
               
                $('#formProfile input').prop('disabled',false);
                $('#loading').css('display','none');
                
                
                $('#formProfile button').prop('disabled',false);
            },
        });
    });
    $(document).on('submit', '#formSandi', function(e) {
    
        
    e.preventDefault();
    $.ajax({
      
        type: 'POST',
        url:"<?= base_url('profile/editPassword') ?>",

       
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'json',
       
     
        beforeSend: function(){
            
            $('#formSandi input').prop('disabled',true);
            $('#loading').css('display','');

           
            $('#formSandi button').prop('disabled',true);

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
                $('#menuSetting').html(menu);
                getData();

                $('#DialogIconedDanger').modal('show');
               
                $('#titleError').html('Berhasil');
                $('#dialogError').html(resp.msg);
                $('#iconError').html('<ion-icon name="shield-checkmark-outline"></ion-icon>');


            }else {
                

                $('#DialogIconedDanger').modal('show');
               
                $('#titleError').html('Gagal');
                $('#dialogError').html(resp.msg);
                $('#iconError').html('<ion-icon name="close-circle-outline"></ion-icon>');
            }
            
         
            
           
        }, 
         complete: function() {
           
            $('#formSandi input').prop('disabled',false);
            $('#loading').css('display','none');
            
            
            $('#formSandi button').prop('disabled',false);
        },
    });
});
    $(document).on('click', '#profileBtn', function() {
        getData();
       html = "<div class='section mt-2 mb-5'>"
                +"<div class='form-group boxed'>"
                    +"<div class='input-wrapper'>"
                        +"<h3>Ubah Data Profil</h3>"
                        
                    +"</div>"
                +"</div>"
                +"<label>Foto Profile</label>"
                +"<div class='custom-file-upload'>"
                    
                    +"<input type='file' name='file' id='fileuploadInput' accept='.png, .jpg, .jpeg'>"
                    +"<label for='fileuploadInput'>"
                        +" <span>"
                            +"<strong>"
                                +"<ion-icon name='cloud-upload-outline' role='img' class='md hydrated' aria-label='cloud upload outline'></ion-icon>"
                                    +"<i>Tap to Upload</i>"
                            +"</strong>"
                        +"</span>"
                    +"</label>"
                +"</div>"
                +"<form id='formProfile'>"
                +"<div class='form-group boxed'>"
                    +"<div class='input-wrapper'>"
                        +"<label>Nama Lengkap</label>"
                        +"<input type='text' class='form-control' id='nama' name='nama_lengkap' required >"
                            +"<i class='clear-input'>"
                                +"<ion-icon name='close-circle' role='img' class='md hydrated' aria-label='close circle'></ion-icon>"
                            +"</i>"
                    +"</div>"
                +"</div>"
                +"<div class='form-group boxed'>"
                    +"<div class='input-wrapper'>"
                        +"<label>Email</label>"
                        +"<input type='email' class='form-control' id='email' name='email' required >"
                            +"<i class='clear-input'>"
                                +"<ion-icon name='close-circle' role='img' class='md hydrated' aria-label='close circle'></ion-icon>"
                            +"</i>"
                    +"</div>"
                +"</div>"
                +"<div class='form-group boxed'>"
                    +"<div class='input-wrapper'>"
                        +"<label>No. Hp</label>"
                        +"<input type='number' class='form-control' id='nohp' name='no_hp' required >"
                            +"<i class='clear-input'>"
                                +"<ion-icon name='close-circle' role='img' class='md hydrated' aria-label='close circle'></ion-icon>"
                            +"</i>"
                    +"</div>"
                +"</div>"
               
                +"<div class='float-left'><button id='btnBackPrf' type='button' class='btn btn-outline-danger'><ion-icon name='return-down-back-outline'></ion-icon></button></div>"
                +"<div class='float-right'><button id='btnSubPRf' type='submit' class='btn btn-outline-info'><ion-icon name='save-outline'></ion-icon></button></div>"

            +"</form></div>";
        $('#menuSetting').html(html);
    });
    $(document).on('click', '#sandiBtn', function() {
        getData();
       html = "<div class='section mt-2 mb-5'>"
                +"<div class='form-group boxed'>"
                    +"<div class='input-wrapper'>"
                        +"<h3>Ubah Kata Sandi</h3>"
                        
                    +"</div>"
                +"</div>"
               
                +"<form id='formSandi'>"
                +"<div class='form-group boxed'>"
                    +"<div class='input-wrapper'>"
                        +"<label>Kata Sandi Baru</label>"
                        +"<input type='password' class='form-control'  name='newpass' required  minlenght=6>"
                            +"<i class='clear-input'>"
                                +"<ion-icon name='close-circle' role='img' class='md hydrated' aria-label='close circle'></ion-icon>"
                            +"</i>"
                    +"</div>"
                +"</div>"
                +"<div class='form-group boxed'>"
                    +"<div class='input-wrapper'>"
                        +"<label>Tulis Ulang Kata Sandi Baru</label>"
                        +"<input type='password' class='form-control' name='repass' required  minlenght=6>"
                            +"<i class='clear-input'>"
                                +"<ion-icon name='close-circle' role='img' class='md hydrated' aria-label='close circle'></ion-icon>"
                            +"</i>"
                    +"</div>"
                +"</div>"
                +"<div class='form-group boxed'>"
                    +"<div class='input-wrapper'>"
                        +"<label>Kata Sandi Lama</label>"
                        +"<input type='password' class='form-control'  name='oldpass' required minlenght=6 >"
                            +"<i class='clear-input'>"
                                +"<ion-icon name='close-circle' role='img' class='md hydrated' aria-label='close circle'></ion-icon>"
                            +"</i>"
                    +"</div>"
                +"</div>"
               
                +"<div class='float-left'><button id='btnBackSnd' type='button' class='btn btn-outline-danger'><ion-icon name='return-down-back-outline'></ion-icon></button></div>"
                +"<div class='float-right'><button id='btnSubSnd' type='submit' class='btn btn-outline-info'><ion-icon name='save-outline'></ion-icon></button></div>"

            +"</form></div>";
        $('#menuSetting').html(html);
    });
    getData();
    function getData(){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('profile/getData'); ?>",
            
            dataType:'json',
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
               var base = '<?= base_url('asset/foto_siswa/') ?>';
               $('#nama').val(resp.nama_lengkap);
               $('#email').val(resp.email);
               $('#nohp').val(resp.no_hp);
               $('#kelas1').val(resp.kelas).change();
               $('#nama_sekolah').val(resp.nama_cabang);
               $('#nama_wali').val(resp.nama_wali);





               $('#img').attr('src',resp.foto);
               $('#nama_lengkap').html(resp.nama_lengkap);
               $('#kelas').html('Kelas ' + resp.kelas);
               $('#sekolah').html(resp.nama_cabang);
            },
            complete: function() {
                
                $('#loading').css('display','none');
            },
        });
    }
    getHis();
    function getHis(){
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('profile/getKuis'); ?>",
            
            
             beforeSend: function(){
                
                
                $('#loading').css('display','');

               
   
            },
            success: function(resp){
               $('#hisKuis').html(resp);
            },
            complete: function() {
                
                $('#loading').css('display','none');
            },
        });
    }
   $(document).on('change', '#fileuploadInput', function(e) {

   e.preventDefault();
   var file_data = $('#fileuploadInput').prop('files')[0];
   var form_data = new FormData();
   

   form_data.append('file', file_data);

            $.ajax({
                url: '<?php echo base_url("profile/updateImage") ?>', // point to server-side PHP script
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data,status){
                    //alert(php_script_response); // display response from the PHP script, if any
                    if (data.status!='error') {
                        $('#fileuploadInput').val('');
                        getData();
                        
                    }else{
                     
                        

                    }
                }
            });
          });
    });
    

</script>
<?php 
    if(file_exists('asset/foto_siswa/'.$row['foto_profile']) OR $row['foto_profile'] != ''){
        $foto = base_url('asset/foto_siswa/').$row['foto_profile'];
    }else{
        $foto = base_url('asset/foto_siswa/profile.svg');
    }
?>
<div class="row  card px-2" >
    <div class='col-12 mt-3'>
        <div class="profile-head">
                    <div class="avatar">
                        <img src="<?= base_url('asset/foto_siswa/profile.svg') ?>" id='img' alt="avatar" class="imaged w64 h64 rounded" style='height:64px'>
                    </div>
                    <div class="in">
                        <h3 class="name text-white" id="nama_lengkap">Person</h3>
                        <h5 class="subtext text-white" id="kelas">Kelas</h5>
                    </div>
        </div>
    </div>
    <div class='col-12 mt-2 mb-2'>
        <div class="profile-info">
                <div class=" bio text-white" id="sekolah">
                    SDN 001 Polewali
                </div>
                
        </div>
    </div>

</div>
<div class="row mb-1 mt-0 " >
    <div class="col-12 full">
        <div class="wide-block transparent p-0">
                <ul class="nav nav-tabs lined iconed" role="tablist">
                   
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kuis" role="tab">
                             <ion-icon name="timer-outline"></ion-icon>
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                            <ion-icon name="settings-outline"></ion-icon>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <!-- tab content -->
        <div class="col-12 full mb-2">
            <div class="tab-content">

             

                <!-- * friends -->
                <div class="tab-pane fade show active" id="kuis" role="tabpanel">
                    <ul class="listview image-listview flush transparent pt-1" id='hisKuis'>
                        <li>
                            <a href="#" class="item">
                                <img src="<?= template()?>/img/sample/avatar/avatar3.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>
                                        Edward Lindgren
                                        <div class="text-muted">532 followers</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                       
                      
                    </ul>
                </div>
                <!-- * friends -->

               
                <!-- settings -->
                <div class="tab-pane fade" id="settings" role="tabpanel" >
                    <ul class="listview image-listview text flush transparent pt-1" id='menuSetting'>
                        
                        
                       
                    </ul>
                </div>
                <!-- * settings -->
            </div>
        </div>
</div>