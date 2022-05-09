<?php 
if ($this->session->level==''){
    redirect(base_url());
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $title ?></title>
    <!-- Fevicon -->
    <link rel="icon" type="image/png" href="<?= base_url()?>asset/images/favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>asset/images/apple-touch-icon.png">
    <!-- Start css -->
    <!-- Switchery css -->
    
    <!-- Apex css -->
   
    <!-- Slick css -->
    
    <link href="<?= theme()?>/plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="<?= theme()?>/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="<?= theme() ?>/plugins/switchery/switchery.min.css" rel="stylesheet">
    <!-- Summernote css -->
    <link href="<?= theme() ?>/plugins/summernote/summernote-bs4.css" rel="stylesheet">
    <!-- Code Mirror css -->
    <link href="<?= theme() ?>/plugins/code-mirror/codemirror.css" rel="stylesheet">
    <link href="<?= theme() ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= theme() ?>/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= theme() ?>/css/flag-icon.min.css" rel="stylesheet" type="text/css">
    <link href="<?= theme() ?>/css/style.css" rel="stylesheet" type="text/css">
    <script src="<?= theme() ?>/js/jquery.min.js"></script>
    <script src="<?= theme()?>/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <!-- End css -->
</head>
<body class="vertical-layout">    
    <!-- Start Infobar Setting Sidebar -->
  
    <div class="infobar-settings-sidebar-overlay"></div>
    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->
        <?php include "main-menu.php";?>
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
           <?php include "header.php";?>
            <!-- End Topbar -->
            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title"><?= $page?></h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('')?>">Home</a></li>
                                 <?= $breadcumb1?>
                                 <?= $breadcumb2?>
                                 <?= $breadcumb3?>


                               
                            </ol>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
                        </div>                        
                    </div> -->
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">                
                <!-- Start row -->
                <div class="row">    
                  <div class="col-lg-12">              
                    <!-- Start col -->
                      <?= $contents?>
                  </div>
                </div>
                <!-- End row -->
                <!-- Start row -->
               
                <!-- End row -->
            </div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            <?php include "footer.php"; ?>
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
   <?php if($this->session->flashdata('message')){ ?>
    <script type="text/javascript">
         swal(
                'Gagal',
                '<?= $this->session->flashdata('message')?>',
                'error'
                )
    </script>
    <?php }?>
     <?php if($this->session->flashdata('success')){ ?>
    <script type="text/javascript">
         swal(
                'Berhasil',
                '<?= $this->session->flashdata('success')?>',
                'success'
                )
    </script>
    <?php }?>
    
    <script src="<?= theme() ?>/js/popper.min.js"></script>
    <script src="<?= theme() ?>/js/bootstrap.min.js"></script>
    <script src="<?= theme() ?>/js/modernizr.min.js"></script>
    <script src="<?= theme() ?>/js/detect.js"></script>
    <script src="<?= theme() ?>/js/jquery.slimscroll.js"></script>
    <script src="<?= theme() ?>/js/vertical-menu.js"></script>
    <!-- Switchery js -->
    <script src="<?= theme() ?>/plugins/switchery/switchery.min.js"></script>
    <!-- Wysiwig js -->
    <script src="<?= theme() ?>/plugins/tinymce/tinymce.min.js"></script>
    <!-- Summernote JS -->
    <script src="<?= theme() ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Code Mirror JS -->
    <script src="<?= theme() ?>/plugins/code-mirror/codemirror.js"></script>
    <script src="<?= theme() ?>/plugins/code-mirror/htmlmixed.js"></script>
    <script src="<?= theme() ?>/plugins/code-mirror/css.js"></script>
    <script src="<?= theme() ?>/plugins/code-mirror/javascript.js"></script>
    <script src="<?= theme() ?>/plugins/code-mirror/xml.js"></script>
    <script src="<?= theme() ?>/js/custom/custom-form-editor.js"></script>    
    <!-- Core js -->
    <script src="<?= theme() ?>/js/core.js"></script>
    <!-- End js -->
    <script type="text/javascript">
        $('.summernote').summernote({
          popover: {
          image: [
            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
            ['float', ['floatLeft', 'floatRight', 'floatNone']],
            ['remove', ['removeMedia']]
          ],
          link: [
            ['link', ['linkDialogShow', 'unlink']]
          ],
          table: [
            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
          ],
          air: [
            ['color', ['color']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']]
          ]
        }
    });
        $('textarea#body').summernote({
            height: '300px'
        });
    </script>
</body>
</html>
<?php } ?>
