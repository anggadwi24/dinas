<?php
 if(checkImage($row['rk_icon'])){
    $img = $row['rk_icon'];
}else{
    $img = base_url('asset/upload_sekolah/blank.png');
}
$peserta = $this->model_app->view_where('ruang_kelas_siswa',array('rks_rk_id'=>$row['rk_id'],'rks_approved'=>'y'));
$meeting = $this->model_app->view_where('ruang_kelas_meeting',array('rkm_rk_id'=>$row['rk_id']));
$mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$row['rk_mapel']))->row_array();
$guru = $this->model_app->view_where('guru',array('id_guru'=>$row['rk_id_guru']))->row_array();
 ?>
 <style>
        .on{
          position:absolute ;
         right: 0.5rem;
         
         border: 1px solid white;
          height: 14px;
          width: 14px;
          background-color: #5be571;
          border-radius: 50%;
          display: inline-block;
    }
    .off{
       
          position:absolute ;
         right: 0.5rem;
         
         border: 1px solid white;
          height: 14px;
          width: 14px;
          background-color: grey;
          border-radius: 50%;
          display: inline-block;
    
    }
 </style>
        <div class="section mt-2">
            <div class="profile-head">
                <div class="avatar">
                    <img src="<?=$img?>" alt="<?=$row['rk_title'] ?>" class="imaged w64 h64 rounded">
                </div>
                <div class="in">
                    <h3 class="name"><?= $row['rk_title']?></h3>
                    <h5 class="subtext"><?= $guru['nama_guru'] ?></h5>
                </div>
            </div>
        </div>
        <div class="section full mt-2">
            <div class="profile-stats pl-2 pr-2">
                <a href="#" class="item">
                    <strong><?=$peserta->num_rows()?></strong>siswa
                </a>
                <a href="#" class="item">
                    <strong><?=$meeting->num_rows()?></strong>meeting
                </a>
                <a href="#" class="item">
                    <strong><?= $row['rk_kelas']?></strong>kelas
                </a>

                <a href="#" class="item">
                    <strong><?= $mapel['mapel']?></strong>mata pelajaran
                </a>
            </div>
        </div>
        <div class="section mt-1 mb-2">
            <div class="profile-info">
                <div class=" bio">
                <?= $row['rk_desc']?>
                </div>
                
            </div>
        </div>
        <div class="section full">
            <div class="wide-block transparent p-0">
                <ul class="nav nav-tabs lined iconed" role="tablist">
                    <li class="nav-item" id="meetingTab">
                        <a class="nav-link active" data-toggle="tab" href="#meeting" role="tab">
                            <ion-icon name="grid-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="nav-item" id="materiTab">
                        <a class="nav-link " data-toggle="tab" href="#materi" role="tab">
                            <ion-icon name="book-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="nav-item" id="participantTab">
                        <a class="nav-link" data-toggle="tab" href="#participant" role="tab">
                            <ion-icon name="people-outline"></ion-icon>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="section full mb-2">
            <div class="tab-content">

                <!-- feed -->
                <div class="tab-pane fade show active" id="meeting" role="tabpanel">
                </div>
                <div class="tab-pane fade" id="materi" role="tabpanel">
                </div>
                <div class="tab-pane fade" id="participant" role="tabpanel">
                </div>
                
            </div>
        </div>
<script>
    $(document).ready(function(){
        meeting();
        
        function meeting(){
            var id = '<?= encode($row['rk_id']) ?>';
            $.ajax({
                url: '<?=base_url('kelas/meeting')?>',
                type: 'POST',
                data: {id: id},
                dataType:'json',
                success: function(resp){
                    if(resp.status == true){
                        $('#meeting').html(resp.output);
                    }else{
                        $('#modalError').modal('show');
                        $('#textError').html(resp.msg);
                    }
                    
                }
            });
        }
        function participant(){
            var id = '<?= encode($row['rk_id']) ?>';
            $.ajax({
                url: '<?=base_url('kelas/participant')?>',
                type: 'POST',
                data: {id: id},
                dataType:'json',
                success: function(resp){
                    if(resp.status == true){
                        $('#participant').html(resp.output);
                    }else{
                        $('#modalError').modal('show');
                        $('#textError').html(resp.msg);
                    }
                    
                }
            });
        }
        function materi(){
            var id = '<?= encode($row['rk_id']) ?>';
            $.ajax({
                url: '<?=base_url('kelas/materi')?>',
                type: 'POST',
                data: {id: id},
                dataType:'json',
                success: function(resp){
                    if(resp.status == true){
                        $('#materi').html(resp.output);
                    }else{
                        $('#modalError').modal('show');
                        $('#textError').html(resp.msg);
                    }
                    
                }
            });
        }
        $(document).on('click','.joinmeet',function(){
            var id = $(this).attr('data-id');
            $.ajax({
                type:'POST',
                url:'<?=base_url('kelas/joinMeeting')?>',
                data:{id:id},
                dataType:'json',
                success:function(resp){
                    if(resp.status == true){
                       window.location = '<?= base_url('kelas/conference?meet=')?>'+resp.redirect;
                    }else{
                        $('#modalError').modal('show');
                        $('#textError').html(resp.msg);
                    }
                }

            })
        })
            
        
        $('#meetingTab').click(function(){
           meeting();
        });
        $('#participantTab').click(function(){
            participant();
        });
        $('#materiTab').click(function(){
            materi();
        });
        
    });

</script>