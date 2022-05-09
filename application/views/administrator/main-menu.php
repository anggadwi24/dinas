 <div class="leftbar">
            <!-- Start Sidebar -->
            <div class="sidebar">
                <!-- Start Logobar -->
                <div class="logobar">
                    <a href="<?= base_url('administrator')?>" class="logo logo-large"><img src="<?= base_url('asset/images')?>/logolong.png" class="img-fluid" alt="logo" style="widht:75px !important"></a>
                    <a href="<?= base_url('administrator')?>" class="logo logo-small"><img src="<?= base_url('asset/images')?>/logosmall.png" class="img-fluid" alt="logo"></a>
                </div>
                <!-- End Logobar -->
                <!-- Start Navigationbar -->
                <div class="navigationbar">
                    <ul class="vertical-menu">
                       
                        <li>
                            <a href="<?= base_url('administrator/home')?>">
                              <img src="<?= theme()?>/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span>Dashboard</span>
                            </a>
                           
                        </li>
                          <?php 
                        $id = $this->session->id_session;
                        $umod = $this->db->query("SELECT * FROM users_modul a JOIN modul b on a.id_modul = b.id_modul WHERE a.id_session = '".$id."'  GROUP BY a.id_modul  ORDER BY b.urutan");
                        foreach($umod->result_array() as $menu){
                            $sbmenu = $this->db->query("SELECT * FROM users_modul a JOIN submodul b on a.id_sm = b.id_sm WHERE a.id_session = '".$id."' AND a.id_modul = ".$menu['id_modul']." AND b.publish ='y'  ORDER BY b.id_sm");
                            if($sbmenu->num_rows() > 0){
                        ?>
                        <li>
                            <a href="javaScript:void();">
                                 <i class='<?= $menu['icon']?>'></i><span><?= $menu['nama_modul']?></span>
                            </a>
                            <ul class="vertical-submenu">
                                <?php foreach($sbmenu->result_array() as $sm){?>
                                     <li><a href="<?= base_url().$sm['link']?>"><?= $sm['submodul']?></a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <?php
                            }else{
                        ?>
                         <li>
                            <a href="<?= base_url('').$menu['link']?>">
                              <i class='<?= $menu['icon']?>'></i><span><?= $menu['nama_modul']?></span>
                            </a>
                           
                        </li>
                        <?php
                            }
                        }
                        ?>
                                     
                    </ul>
                </div>
                <!-- End Navigationbar -->
            </div>
            <!-- End Sidebar -->
        </div>