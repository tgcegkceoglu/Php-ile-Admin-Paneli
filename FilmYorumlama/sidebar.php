<div class="col-lg-4">

    <!-- sidebar -->
    <div class="sidebar">
        <div class="widget rounded">
            <div class="widget-header text-center">
                <h3 class="m-0" style="color: #fe4f70;">Kategoriler</h3>
                <img src="images/wave.svg" class="wave" alt="wave" />
            </div>

            <?php
            $kategorisor = $db->prepare("SELECT * FROM kategori ORDER BY kategori_sira ASC");
            $kategorisor->execute();
            while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="widget-content">
                    <!-- post -->
                    <div class="post post-list-sm ">
                        <div class="details clearfix">
                            <h6 class="post-title my-2"><a href="kategoriler.php?kategori_seourl=<?php echo $kategoricek['kategori_seourl'] ?>"><?php echo $kategoricek['kategori_ad'] ?> </a></h6>
                            <hr>
                        </div>
                    </div>
                </div>
            <?php }
            ?>

        </div>
    </div>
</div>