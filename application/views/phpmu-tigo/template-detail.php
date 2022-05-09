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
	

    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="<?= base_url('chat')?>" class="headerButton">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"><?= $page ?></div>
        <div class="right">
            
        </div>
    </div>
    
    <!-- * loader -->

    <!-- App Header -->
    
    <!-- * App Header -->

    <!-- Search Component -->
  
    <!-- * Search Component -->

    <!-- App Capsule -->
	<style>
		#appCapsule{
			padding: 56px 0 !important;
		}
		body{
			background:#F9F9F9 !important;
		}
	</style>
    <div id="appCapsule" >
        
        

        


        

    <div class="message-divider">
            Friday, Sep 20, 10:40 AM
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar1.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">John</div>
                <div class="bubble">
                    Hi everyone, how are you?
                </div>
                <div class="footer">8:40 AM</div>
            </div>
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar2.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">Marry</div>
                <div class="bubble">
                    I'm fine, how are you today john, do you feel good?
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-item user">
            <div class="content">
                <div class="bubble">
                    Would you please repost the photo you sent yesterday?
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-divider">
            Friday, Sep 20, 10:40 AM
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar2.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">Marry</div>
                <div class="bubble">
                    <img src="<?= template()?>/img/sample/photo/1.jpg" alt="photo" class="imaged w160">
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar4.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">Katie</div>
                <div class="bubble">
                    Nice photo !
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-item">
            <img src="<?= template()?>/img/sample/avatar/avatar2.jpg" alt="avatar" class="avatar">
            <div class="content">
                <div class="title">Marry</div>
                <div class="bubble">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae nisl et nibh iaculis
                    sagittis. In hac habitasse platea dictumst. Sed eu massa lacinia, interdum ex et, sollicitudin elit.
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>

        <div class="message-item user">
            <div class="content">
                <div class="bubble">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae nisl et nibh iaculis
                    sagittis. In hac habitasse platea dictumst. Sed eu massa lacinia, interdum ex et, sollicitudin elit.
                </div>
                <div class="footer">10:40 AM</div>
            </div>
        </div>


       
    </div>
    <!-- * App Capsule -->
    <div class="modal fade action-sheet inset" id="addActionSheet" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share</h5>
                </div>
                <div class="modal-body">
                    <ul class="action-button-list">
                        <li>
                            <a href="#" class="btn btn-list" data-dismiss="modal">
                                <span>
                                    <ion-icon name="camera-outline"></ion-icon>
                                    Take a photo
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-list" data-dismiss="modal">
                                <span>
                                    <ion-icon name="videocam-outline"></ion-icon>
                                    Video
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-list" data-dismiss="modal">
                                <span>
                                    <ion-icon name="image-outline"></ion-icon>
                                    Upload from Gallery
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-list" data-dismiss="modal">
                                <span>
                                    <ion-icon name="document-outline"></ion-icon>
                                    Documents
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-list" data-dismiss="modal">
                                <span>
                                    <ion-icon name="musical-notes-outline"></ion-icon>
                                    Sound file
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- * Share Action Sheet -->

    <!-- chat footer -->
    <div class="chatFooter">
        <form>
            <a href="javascript:;" class="btn btn-icon btn-secondary rounded" data-toggle="modal" data-target="#addActionSheet">
                <ion-icon name="add"></ion-icon>
            </a>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" placeholder="Type a message...">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>
            <button type="button" class="btn btn-icon btn-primary rounded">
                <ion-icon name="send"></ion-icon>
            </button>
        </form>
    </div>

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
                        <h5 class="modal-title">Jawaban Anda Salah</h5>
                        <button class="btn btn-text-success" id="btnLanjut1">LANJUT</button>
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
                        <ion-icon name="checkmark-circle"></ion-icon>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
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
    <!-- * welcome notification -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    
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