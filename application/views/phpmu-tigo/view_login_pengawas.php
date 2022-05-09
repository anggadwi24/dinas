<!DOCTYPE HTML>
<html lang = "en">
<head> 
<script data-ad-client="ca-pub-1374426766822072" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<title><?php echo $title; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="robots" content="index, follow">
  <meta name="description" content="<?php echo $description; ?>">
  <meta name="keywords" content="<?php echo $keywords; ?>">
  <meta name="author" content="phpmu.com">
  <meta name="robots" content="all,index,follow">
  <meta http-equiv="Content-Language" content="id-ID">
  <meta NAME="Distribution" CONTENT="Global">
  <meta NAME="Rating" CONTENT="General">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 

  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />

  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/style.css">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/plugins/datatables/dataTables.bootstrap.css">

  <script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/jscript/jquery-latest.min.js"></script>
</javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/slide/js/slide.js"></script>

  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<style type="text/css">
:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: .75rem;
}
  body {
  background: #fff;

}

.card-signin {
  border: 0;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.card-signin .card-title {
  margin-bottom: 2rem;
  font-weight: 300;
  font-size: 1.5rem;
}

.card-signin .card-body {
  padding: 2rem;
}

.form-signin {
  width: 100%;
}

.form-signin .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  transition: all 0.2s;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group input {
  height: auto;
  border-radius: 2rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

.btn-google {
  color: white;
  background-color: #ea4335;
}

.btn-facebook {
  color: white;
  background-color: #3b5998;
}

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input::-ms-input-placeholder {
    color: #777;
  }
}

/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input:-ms-input-placeholder {
    color: #777;
 
</style>
<body>
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto mt-5">
        <div class="card card-signin mt-5">
          <div class="card-body">
            <h5 class="card-title text-center"><?= $title?></h5>
            <form class="form-signin" method="post" action="<?php echo base_url(); ?>pengawas/login" role="form" id='formku'>
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" placeholder="Nama Pengguna.." name="a" required autofocus>
                <label for="inputEmail">Username</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required placeholder="******" name="b">
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login">Masuk</button>

              <hr class="my-4">
             
            
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/jscript/jquery-3.2.1.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<?php if($this->session->flashdata('message')){ ?>

    <script type="text/javascript">
            Swal.fire({

  title: 'Mohon Maaf',
  text: '<?php echo $this->session->flashdata('message'); ?>',
   customClass: 'swal-wide',
    imageUrl: "<?= base_url('asset/images/iconic.jpg')?>",
  imageClass:'img-responsive ',  
 
  imageWidth:'200px',
  imageHeight:'300px',  
  
})
    </script>
<?php }?>
</body>