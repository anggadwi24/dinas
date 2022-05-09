 <?php $me = $this->model_app->view_where('users',array('username'=>$this->session->username))->row_array();
    if(checkImage($me['foto']) == false){
        $foto = base_url('asset/foto_user/profile.svg');
    }else{
        $foto = $me['foto'];
    }
 ?>

 <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href="<?= base_url()?>" class="mobile-logo"><img src="<?= base_url('asset/images')?>/logo.png" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="topbar-toggle-icon">
                                        <a class="topbar-toggle-hamburger" href="javascript:void();">
                                            <img src="<?= theme()?>/images/svg-icon/horizontal.svg" class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                            <img src="<?= theme()?>/images/svg-icon/verticle.svg" class="img-fluid menu-hamburger-vertical" alt="verticle">
                                         </a>
                                     </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                            <img src="<?= theme()?>/images/svg-icon/collapse.svg" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                            <img src="<?= theme()?>/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Topbar -->
            <div class="topbar">
                <!-- Start row -->
                <div class="row align-items-center">
                    <!-- Start col -->
                    <div class="col-md-12 align-self-center">
                        <div class="togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                           <img src="<?= theme()?>/images/svg-icon/collapse.svg" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                           <img src="<?= theme()?>/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close">
                                         </a>
                                     </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="searchbar">
                                        <!-- <form>
                                            <div class="input-group">
                                              <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                              <div class="input-group-append">
                                                <button class="btn" type="submit" id="button-addon2"><img src="<?= theme()?>/images/svg-icon/search.svg" class="img-fluid" alt="search"></button>
                                              </div>
                                            </div>
                                        </form> -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="infobar">
                            <ul class="list-inline mb-0">
                               
                                <!-- <li class="list-inline-item">
                                    <div class="notifybar">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle infobar-icon" href="#" role="button" id="notoficationlink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= theme()?>/images/svg-icon/notifications.svg"  srcset="" class="img-fluid" alt="notifications">
                                            <span class="live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notoficationlink">
                                                <div class="notification-dropdown-title">
                                                    <h4>Notifications</h4>                            
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </li>                                 -->
                               
                                <li class="list-inline-item my-2">
                                    <div class="profilebar">
                                        <div class="dropdown">
                                          <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= $foto ?>" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                <div class="dropdown-item">
                                                    <div class="profilename">
                                                      <h5><?= ucfirst($me['nama_lengkap'])?></h5>
                                                    </div>
                                                </div>
                                                <div class="userbox">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="media dropdown-item">
                                                            <a href="<?php echo base_url().$this->uri->segment(1); ?>/edit_manajemenuser/<?php echo $this->session->username; ?>" class="profile-icon"><img src="<?= theme()?>/images/svg-icon/user.svg" class="img-fluid" alt="user">My Profile</a>
                                                        </li>
                                                                                                               
                                                        <li class="media dropdown-item">
                                                            <a href="<?= base_url('administrator/logout')?>" class="profile-icon"><img src="<?= theme()?>/images/svg-icon/logout.svg" class="img-fluid" alt="logout">Logout</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End col -->
                </div> 
                <!-- End row -->
            </div>