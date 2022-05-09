<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= title() ?></title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="<?= theme()?>/images/favicon.ico">
    <!-- Start CSS -->
    <link href="<?= theme()?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= theme()?>/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= theme()?>/css/style.css" rel="stylesheet" type="text/css">
    <!-- End CSS -->
</head>
<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box error-box">
                <!-- Start row -->
                 <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-8 col-lg-6">
                        <div class="text-center">
                            
                            <img src="<?= theme()?>/images/error/404.svg" class="img-fluid error-image" alt="404">
                            <h4 class="error-subtitle mb-4">Oops! Page not Found</h4>
                            <p class="mb-4">We did not find the page you are looking for. Please return to previous page or visit home page. </p>
                            <a onclick=goBack() class="btn btn-primary font-16 text-white"><i class="feather icon-home mr-2"></i> Kembali</a>
                        </div>
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
    <script>
        function goBack() {
        window.history.back();
        }
    </script>
    <!-- End js -->
</body>
</html>