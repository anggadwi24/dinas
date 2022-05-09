<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="origin-trial" content="AhjIzi5TzrSkOouJpsGzGS1mVIFGCFWSQeRAeagD8J8k0Uoleihz1SFcs9uXB/iKTB1MQ7n/XakEXg5jbL+LWgsAAABeeyJvcmlnaW4iOiJodHRwOi8vbG9jYWxob3N0OjgwIiwiZmVhdHVyZSI6IlVucmVzdHJpY3RlZFNoYXJlZEFycmF5QnVmZmVyIiwiZXhwaXJ5IjoxNjU4ODc5OTk5fQ==" />
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
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.1.0/css/bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.1.0/css/react-select.css" />
    <script src="<?= template()?>/js/lib/jquery-3.4.1.min.js"></script>
</head>

<body>
    <style>/* To hide */
#zmmtg-root {
  display: none;
}

/* To show */
#zmmtg-root {
  display: block;
}</style>
    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <div id="loading" style="display:none;">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

 
            <!-- App Header -->
            <div class="appHeader <?= $head?>">
                <?php if($left != ''){?>
                <div class="left pageTitle">
                    <?= $left?>
                </div>
                <?php }?>
                <?php if($center != ''){?>
                <div class="pageTitle">
                    <?= $center?>
                </div>
                <?php }?>
                <?php if($right != ''){?>
                <div class="right">
                    <?= $right?>
                   
                       
                </div>
                <?php }?>
            </div>
            <div id="search" class="appHeader">
            <form class="search-form">
                <div class="form-group searchbox">
                    <input type="text" class="form-control" id="key" placeholder="Search..." style="color:black">
                    <i class="input-icon">
                        <ion-icon name="search-outline"></ion-icon>
                    </i>
                    <a href="javascript:;" class="ml-1 close toggle-searchbox">
                        <ion-icon name="close-circle"></ion-icon>
                    </a>
                </div>
            </form>
            </div>
            <!-- * App Header -->
        

    <!-- App Capsule -->
    <div id="appCapsule" class="container" style="	padding: 56px 0 !important;">
        
        

        


        

        <?= $contents ?>


        <!-- app footer -->
        
        <!-- * app footer -->

    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="<?= base_url('main')?>" class="item">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
            </div>
        </a>
      
        <a href="<?= base_url('chat')?>" class="item">
            <div class="col">
                <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                <span class="badge badge-danger" id='totChat'>5</span>
            </div>
        </a>
        <a href="<?= base_url('diskusi')?>" class="item">
            <div class="col">
                <ion-icon name="chatbubbles-outline"></ion-icon>
               
            </div>
        </a>
        <a href="<?= base_url('kelas')?>" class="item">
            <div class="col">
                    <ion-icon name="people-outline"></ion-icon>
               
            </div>
        </a>
        <a href="<?= base_url('peringkat')?>" class="item">
            <div class="col">
                 <ion-icon name="ribbon-outline"></ion-icon>
            </div>
        </a>
        <a href="<?= base_url('profile') ?>" class="item" >
            <div class="col">
                <ion-icon name="person-circle-outline"></ion-icon>
            </div>
        </a>
    </div>
    <script>
        $(document).ready(function(){
        setInterval( function() { setRefresh(); }, 10000 );
        setRefresh();
     function setRefresh(){
      
        $.ajax({
            type:"POST",
            url:"<?php echo base_url('chat/countAllChat'); ?>",
            
            dataType:'json',
          
            success: function(resp){
                
                $('#totChat').html(resp);
               
   
            },
        }) 
    }
        });
    </script>
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
   
        <div class="modal fade dialogbox" id="modalSuccess" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon text-success">
                        <ion-icon name="checkmark-circle"></ion-icon>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                    </div>
                    <div class="modal-body" id="textSuccess">
                        
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade dialogbox" id="modalInfo" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon text-info">
                        <ion-icon name="information-circle-outline"></ion-icon>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Perhatian</h5>
                    </div>
                    <div class="modal-body" id="textInfo">
                        
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade dialogbox" id="modalError" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon text-danger">
                        <ion-icon name="close-circle"></ion-icon>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                    </div>
                    <div class="modal-body" id="textError">
                       
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
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
    <script src="https://source.zoom.us/2.1.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.1.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.1.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.1.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/2.1.0/lib/vendor/lodash.min.js"></script>

    <!-- For Client View -->
    <script src="https://source.zoom.us/zoom-meeting-2.1.0.min.js"></script>

    <!-- For Component View -->
    <script src="https://source.zoom.us/2.1.0/zoom-meeting-embedded-2.1.0.min.js"></script>
    <script>
        const KJUR = require('jsrsasign')
// https://www.npmjs.com/package/jsrsasign
function generateSignature(sdkKey, sdkSecret, meetingNumber, role) {

  const iat = Math.round((new Date().getTime() - 30000) / 1000)
  const exp = iat + 60 * 60 * 2
  const oHeader = { alg: 'HS256', typ: 'JWT' }

  const oPayload = {
    sdkKey: sdkKey,
    mn: meetingNumber,
    role: role,
    iat: iat,
    exp: exp,
    appKey: sdkKey,
    tokenExp: iat + 60 * 60 * 2
  }

  const sHeader = JSON.stringify(oHeader)
  const sPayload = JSON.stringify(oPayload)
  const signature = KJUR.jws.JWS.sign('HS256', sHeader, sPayload, sdkSecret)
  return signature
}

console.log(generateSignature(process.env.ZOOM_SDK_KEY, process.env.ZOOM_SDK_SECRET, 123456789, 0))
        ZoomMtg.preLoadWasm()
        ZoomMtg.prepareWebSDK()
        // loads language files, also passes any error messages to the ui
        ZoomMtg.i18n.load('en-US')
        ZoomMtg.i18n.reload('en-US')
        ZoomMtg.setZoomJSLib('https://source.zoom.us/2.1.0/lib', '/av')
        ZoomMtg.init({
            leaveUrl: 'http://localhost/kelas/',
            success: (success) => {
                console.log(success)

                ZoomMtg.join({
                sdkKey: sdkKey,
                signature: signature, // role in SDK Signature needs to be 0
                meetingNumber: meetingNumber,
                passWord: passWord,
                userName: userName,
                success: (success) => {
                    console.log(success)
                },
                error: (error) => {
                    console.log(error)
                }
                })
            },
            error: (error) => {
                console.log(error)
            }
        })
        const zoomMeetingSDK = document.getElementById('zmmtg-root')

// To hide
        zoomMeetingSDK.style.display = 'none';

        // To show
        zoomMeetingSDK.style.display = 'block';
    </script>
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
    <?php if($this->session->flashdata('error')){
        echo "<script>
                $('#modalError').modal('show');
                $('#textError').html('".$this->session->flashdata('error')."');
        </script>";
    }?>
    <?php if($this->session->flashdata('success')){
        echo "<script>
                $('#modalSuccess').modal('show');
                $('#textSuccess').html('".$this->session->flashdata('success')."');
        </script>";
    }?>

    <script>
        setTimeout(() => {
            notification('notification-welcome', 5000);
        }, 2000);
    </script>

</body>

</html>