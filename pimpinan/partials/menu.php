<div class="header_responsive_admin" onclick="show_box_menu_pimpinan()">
    <i class="fas fa-bars"></i>
    <p>Menu Pimpinan</p>
</div>
<div class="box_menu_admin" id="box_menu_admin">
    <div class="menu_admin">
        <div class="menu_profile_admin">
            <img src="<?php echo $url; ?>assets/image/profile/<?php echo $profile_pimpinan['foto']; ?>">
            <p><?php echo $profile_pimpinan['nama_lengkap']; ?></p>
        </div>
       <div class="menu_list">
            <a href="<?php echo $url; ?>admin">
                <div class="<?php if ($page_admin == 'dashboard') {
                                echo 'menu_list_isi_active';
                            } else {
                                echo 'menu_list_isi';
                            } ?>">
                    <div class="box_icon_menu_list_isi">

                    </div>
 
                </div>
            </a>






            <a href="<?php echo $url; ?>pimpinan/laporan.php"> <!-- Sesuaikan dengan alamat file laporan.php -->
    <div class="<?php if ($page_pimpinan == 'laporan') {
                    echo 'menu_list_isi_active';
                } else {
                    echo 'menu_list_isi';
                } ?>">
        <div class="box_icon_menu_list_isi">
            <i class="fas fa-chart-bar"></i> <!-- Ganti ikon sesuai dengan ikon laporan yang sesuai -->
        </div>
        <p>Laporan</p>
    </div>
</a>



            <a href="<?php echo $url; ?>system/pimpinan/logout">
                <div class="menu_list_isi">
                    <div class="box_icon_menu_list_isi">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <p>Log Out</p>
                </div>
            </a>
        </div>


<script src="<?php echo $url; ?>assets/js/pimpinan/menu.js"></script>