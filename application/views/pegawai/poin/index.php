<div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
        
        <div class="d-flex justify-content-center font-aur">
        <h2>TAMBAHAN POIN</h2>
        </div>
       
      
      </div>
 
    </div>
    
  </div>
  <?php foreach($poin->result_array() as $row){?>

    <?php if($row['jenis']=='tautan'){?>
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
        
        <div class="d-flex justify-content-center font-aur">
            <h2><?= $row['judul']?></h2>
        </div>
        <div class="d-flex justify-content-center font-aur">

            <?php $cek = $this->model_app->view_where('poin_history',array('id_poin'=>$row[id_poin]))->num_rows();?>

            <?php if($cek>0){?>
              <span>Anda sudah mengklaim poin tambahan ini</span>
            <?php }else{?>
           <input type="hidden" name="id_poin" value="<?= $row[id_poin]?>">
            <input type="hidden" name="poin" value="<?= $row[poin]?>">
            <input type="hidden" name="id_konsumen" value="<?= $this->session->id_konsumen?>">
          <a href="<?= $row[link]?>"  onclick="window.open('<?= $row[link]?>', 
                         'newwindow', 
                         'width=480,height=720'); 
              return false;" id="button" data-id="<?= $row[id_poin] ?>" data-konsumen="<?= $this->session->id_konsumen?> ?>" data-poin="<?= $row[poin]?>" data-status = <?= $row['status']?>>

            <button class="sbm-color bergetar"  > <?= $row['tombol']?>           

            </button>
          </a>
        <?php }?>

        </div>
        <div class="d-flex justify-content-center font-aur">
           <label><?= $row[keterangan]?></label>
        </div>
       
      
      </div>
 
    </div>
    
  </div>
<?php }elseif($row['jenis']=='video'){?>
     <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
        
        <div class="d-flex justify-content-center font-aur">
            <h2><?= $row['judul']?></h2>
        </div>
        <div class="d-flex justify-content-center font-aur">

            <?php $cek = $this->model_app->view_where('poin_history',array('id_poin'=>$row[id_poin]))->num_rows();?>

            <?php if($cek>0){?>
              <span>Anda sudah mengklaim poin tambahan ini</span>
            </div>
            <?php }else{?>
           <input type="hidden" name="id_poin" id="id_poin" value="<?= $row[id_poin]?>">
            <input type="hidden" name="poin" id="poin" value="<?= $row[poin]?>">
            <input type="hidden" name="id_konsumen" id="id_konsumen" value="<?= $this->session->id_konsumen?>">
             <input type="hidden" name="status" id="status" value="<?= $row[status]?>">


            <div id="video"></div>
          </div>
          <div class="d-flex justify-content-center font-aur " style="margin-top: 50px;">
              <button class="sbm-color bergetar" onclick="myFunction();return false;" id="btnplay"> <?= $row['tombol']?>           

            </button>
          </div>
        
 
       
            
        <?php }?>

        

        <div class="d-flex justify-content-center font-aur">

           <label><?= $row[keterangan]?></label>
        </div>
       
      
      </div>
 
    </div>
    
  </div>
<?php }?>
<?php }?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>


       <script>

        function myFunction() {
                document.getElementById("video").innerHTML = "<div id='player'></div>";
                document.getElementById("btnplay").style.display = 'none';
                // 2. This code loads the IFrame Player API code asynchronously.
                var tag = document.createElement('script');

                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            }

            // 3. This function creates an <iframe> (and YouTube player)
            //    after the API code downloads.
            var player;
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    height: '390',
                    width: '640',
                    videoId: '<?= $row['link']?>',
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            // 4. The API will call this function when the video player is ready.
            function onPlayerReady(event) {
                event.target.playVideo();
            }

            // 5. The API calls this function when the player's state changes.
            //    The function indicates that when playing a video (state=1),
            //    the player should play for six seconds and then stop.
            var done = false;
            var id_poin = document.getElementById("id_poin").value;
            var poin = document.getElementById("poin").value;
            var id_konsumen = document.getElementById("id_konsumen").value;
            var status = document.getElementById("status").value;
            function onPlayerStateChange(event) {
                 if(event.data === 0) {          
                window.location.href = "<?= base_url('poin/get_poinvideo/') ?>"+id_poin+'/'+poin+'/'+id_konsumen+'/'+status;
            }
            }
            function stopVideo() {
                player.stopVideo();
            }
        </script>

  
<script type="text/javascript">

  $("#button").on('click',function(){
            var id_poin = $(this).data("id");
            var id_konsumen = $(this).data("konsumen");
            var poin = $(this).data("poin"); 
            var status = $(this).data("status");
            

            
           
           
            $.ajax({
                url: '<?php echo base_url(); ?>poin/get_poin',
                type: 'POST',
                data: {id_poin:id_poin,id_konsumen:id_konsumen,poin:poin,status:status},
                success: function(data){
                     
                   Swal.fire({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Selamat Anda Berhasil Mendapatkan '+poin+ 'Poin',
                     customClass: 'swal-wide',
                    
                  }).then(function(){ 
                     location.reload();
                     }
                  );

                   
              
            }
                
            })
 
        });

      </script>
      <?php if($this->session->flashdata('message')){ ?>



<script type="text/javascript">
       Swal.fire({
  type: 'success',
  title: 'Selamat',
  text: '<?php echo $this->session->flashdata('message'); ?>',
   customClass: 'swal-wide',
  
})

</script>


<?php }?>

