<div class="header">
            <h1>Portal Berita Mahasiswa</h1>
            <p>Berita terkini dan terupdate dikalangan mahasiswa</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="index.php" title="Home">Beranda</a></li>
                <li><a href="#" title="Berita">Berita</a></li>
                <li><a href="#" title="Kontak Kami">Kontak Kami</a></li>
                <?php
                $sesiadmin = $_SESSION['member'];
                if(isset($sesiadmin)){
                    $anggota = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_anggota WHERE id_anggota = '$sesiadmin'"));
                        ?>
                        <li><a href="#">Login : <?= $anggota['nama'];?> </a></li>
                        <?php
                }else{
                        ?>
                        <li><a href="anggota/index.php" title="Login">Login Anggota</a></li>
                        <?php
                }

                ?>
                
            </ul>
        </div>