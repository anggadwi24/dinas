<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login - <?= title() ?></title>
    <!-- Fevicon -->
    <link rel="icon" type="image/png" href="<?= base_url()?>asset/images/favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>asset/images/apple-touch-icon.png">
    <!-- Start css -->
    <link href="<?= theme()?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= theme()?>/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= theme()?>/css/style.css" rel="stylesheet" type="text/css">
    <!-- End css -->
</head>
<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box login-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-8 col-lg-8">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-head mt-5">
                                                <a href="" class="logo"><img src="<?= base_url('asset/images')?>/logo.png" class="img-fluid" alt="logo"></a>
                                            </div>       
                                        </div>
                                        <div class="col-6">
                                        <?=   form_open($this->uri->segment(1).'/index');?>
                                                                       
                                                                       <h4 class="text-primary my-4"> <?= title()?></h4>
                                                                       <?php 
                                                                           echo $this->session->flashdata('message');
                                                                           
                                                                       ?>
                                                                       <div class="form-group">
                                                                           <input type="text" class="form-control" name='a' id="username" placeholder="Enter Username here" required>
                                                                       </div>
                                                                       <div class="form-group">
                                                                           <input type="password" class="form-control" name='b' id="password" placeholder="Enter Password here" required>
                                                                       </div>
                                                                       <div class="form-row mb-3">
                                                                           <div class="col-sm-6">
                                                                               <div class="custom-control custom-checkbox text-left">
                                                                                 <input type="checkbox" class="custom-control-input" id="rememberme">
                                                                                 <label class="custom-control-label font-14" for="rememberme">Remember Me</label>
                                                                               </div>                                
                                                                           </div>
                                                                           <div class="col-sm-6">
                                                                             <div class="forgot-psw"> 
                                                                               <a id="forgot-psw" href="user-forgotpsw.html" class="font-14">Forgot Password?</a>
                                                                             </div>
                                                                           </div>
                                                                       </div>                          
                                                                     <button type="submit" name="submit" class="btn btn-success btn-lg btn-block font-18">Log in</button>
                                        </div>
                                    </div>
                                   
                                   
                                    
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="<?= theme()?>/js/jquery.min.js"></script>
    <script src="<?= theme()?>/js/popper.min.js"></script>
    <script src="<?= theme()?>/js/bootstrap.min.js"></script>
    <script src="<?= theme()?>/js/modernizr.min.js"></script>
    <script src="<?= theme()?>/js/detect.js"></script>
    <script src="<?= theme()?>/js/jquery.slimscroll.js"></script>
    <!-- End js -->
</body>
</html>