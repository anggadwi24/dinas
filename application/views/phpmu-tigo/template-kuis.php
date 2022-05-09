<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title><?= $title ?></title>
    <meta name="description" content="Kuis beasiswa">
    <meta name="keywords" content="sdn Polewali kuis beasiswa" />
    <link rel="icon" type="image/png" href="<?= base_url()?>asset/images/favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>asset/images/apple-touch-icon.png">
    <link rel="stylesheet" href="<?= template()?>/css/style.css">
    <link rel="manifest" href="<?= template()?>/__manifest.json">
    <script src="<?= template()?>/js/lib/jquery-3.4.1.min.js"></script>
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <div id="loading" style="display:none;">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Header -->
    
    <!-- * App Header -->

    <!-- Search Component -->
  
    <!-- * Search Component -->

    <!-- App Capsule -->
    <div id="appCapsule1" >
        
        

        


        

        <?= $contents ?>


        <!-- app footer -->
        
        <!-- * app footer -->

    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
  
    <!-- * App Sidebar -->

    <!-- welcome notification  -->
    <?php if($this->session->flashdata('notif')){?>
    <div id="notification-welcome" class="notification-box">
        <div class="notification-dialog android-style">
            <div class="notification-header">
                <div class="in">
                    <img src="<?= template()?>/img/icon/72x72.png" alt="image" class="imaged w24">
                    <strong>Mobilekit</strong>
                    <span>just now</span>
                </div>
                <a href="#" class="close-button">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="notification-content">
                <div class="in">
                    <h3 class="subtitle">Welcome to Mobilekit</h3>
                    <div class="text">
                        Mobilekit is a PWA ready Mobile UI Kit Template.
                        Great way to start your mobile websites and pwa projects.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <div class="modal fade dialogbox" id="DialogBasic" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleNotif"></h5>
                    </div>
                    <div class="modal-body" id="dialogNotif">
                        
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <button class="btn btn-text-secondary" id="btnCancel"  data-dismiss="modal">CLOSE</button>

                            
                            <button class="btn btn-text-primary" id="btnNotif"></button>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade modalbox" id="ModalBasic" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"></h5> 
                        <button class="btn btn-text-success float-right" id="btnLanjut1">LANJUT</button>
                    </div>
                    <div class="modal-body" id="dialogWrong">
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade dialogbox" id="modalCek" data-backdrop="static" tabindex="-1"
            role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Peringatan</h5>
                    </div>
                    <div class="modal-body">
                        Anda Harus Menyelesaikan Semua Soal!
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <button class="btn btn-text-secondary" data-dismiss="modal">
                                
                                OK
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade dialogbox" id="DialogIconedSuccess" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon text-success">
                        <img src="<?= base_url('asset/images/iconic.png')?>" class='img-fluid' style='height: 120px;width: 80px;'>
                       
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Benar</h5>
                    </div>
                    <div class="modal-body" id="dialogLanjut">
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <button class="btn btn-text-success" id="btnLanjut">LANJUT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade dialogbox" id="modalImg" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <img src="<?= template() ?>/img/sample/photo/1.jpg" class='img-fluid' id='imgModal' alt="">
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-secondary" data-dismiss="modal">CLOSE</a>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="modal fade dialogbox" id="DialogIconedDanger" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-icon text-danger" id='iconError'>
                        
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleError"></h5>
                    </div>
                    <div class="modal-body" id="dialogError">
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                           <button class="btn btn-text-secondary" id="btnClose">CLOSE</button>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- * welcome notification -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script>
         var music = new Audio("<?= base_url('asset/backsound/backsound.mp3')?>");
        playmusic(music);
        function playmusic(music) {
            music.controls = false;
            music.loop = true;
            music.autoplay = true;
        
            document.body.appendChild(music)
        }
    </script>
    <!-- Bootstrap-->
    <script src="<?= template()?>/js/lib/popper.min.js"></script>
    <script src="<?= template()?>/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="<?= template()?>/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="<?= template()?>/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="<?= template()?>/js/base.js"></script>


    <script>
        setTimeout(() => {
            notification('notification-welcome', 5000);
        }, 2000);
    </script>

</body>

</html>