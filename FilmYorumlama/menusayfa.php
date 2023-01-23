<?php include 'header.php';
if(isset($_GET["menu_seourl"])){
    $ust=0;
    $menu_seourl=$_GET["menu_seourl"];
    $menusor=$db->prepare("SELECT * FROM menu where menu_seourl=:menu_seourl");
    $menusor->execute(array(
        'menu_seourl' => $menu_seourl
    ));
    $menucek = $menusor->fetch(PDO::FETCH_ASSOC);
    $kategorisor = $db->prepare("SELECT * FROM kategori where kategori_ust=:kategori_ust");
    $kategorisor->execute(
        array(
            'kategori_ust' => $menucek['menu_id']
        )
    );
    $uzunluk=$kategorisor->rowCount();
    if($uzunluk ==0){
       $ust=1;
       $blogsor = $db->prepare("SELECT * FROM blog where category_seourl=:category_seourl ORDER BY blog_id DESC");
       $blogsor->execute(array(
            'category_seourl' => $menu_seourl
        ));
    }
}
else{
    include 'veribulunamadi.php';
}

?>
<section class="page-header">
	<div class="container-xl">
		<div class="text-center">
			<h1 class="mt-0 mb-2"><?php echo $menucek['menu_ad'] ?></h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="index.php">Ana Sayfa</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?php echo $menucek['menu_ad'] ?></li>
				</ol>
			</nav>
		</div>
	</div>
</section>
<!-- section main content -->
<section class="main-content">
	<div class="container-xl">

		<div class="row gy-4">

			<div class="col-lg-8">

				<div class="row gy-4">
					<?php
                    if($ust==0){
                        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                            $kategori_seourl = $kategoricek['kategori_seourl'];
                            $blogsor = $db->prepare("SELECT * FROM blog where category_seourl=:category_seourl ORDER BY blog_id DESC");
                            $blogsor->execute(array(
                                'category_seourl' => $kategori_seourl
                            ));
                            while ($blogcek = $blogsor->fetch(PDO::FETCH_ASSOC)) {
                               ?>
                                <div class="col-sm-6">
                                    <!-- post -->
                                    <div class="post post-grid rounded bordered">
                                        <div class="post post-grid rounded">
                                            
                                            <div class="thumb top-rounded">
                                                    <a href="kategoriler.php" class="category-badge position-absolute"><?php echo $blogcek['category_name'] ?></a>
                                                <a href="blog.php?blog_id=<?php echo $blogcek['blog_id'] ?>">
                                                    <div class="inner">
                                                        <img class="bordered" style="width:100%; height:300px; object-fit: cover; object-position: center;" src="images/blog/<?php echo $blogcek['blog_photo'] ?>" alt="post-title" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="details">
                                                <h5 class="post-title mb-3"><?php echo $blogcek['blog_title'] ?></a></h5>
                                                <p class="excerpt mb-0"><?php echo substr($blogcek['blog_description'],0,250)."..."?></p>
                                            </div>
                                            <div class="post-bottom clearfix d-flex align-items-center">
                                                <div class="social-share me-auto">
                                                    <button class="toggle-button icon-share"></button>
                                                    <ul class="icons list-unstyled list-inline mb-0">
                                                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                        <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                        <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                                        <li class="list-inline-item"><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                                                        <li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="more-button float-end">
                                                    <a href="blog.php?blog_id=<?php echo $blogcek['blog_id'] ?>"><span class="icon-options"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } 
                        }    
                    } 
                    else{
                        while ($blogcek = $blogsor->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="col-sm-6">
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="post post-grid rounded">
                                        
                                        <div class="thumb top-rounded">
                                                <a href="kategoriler.php" class="category-badge position-absolute"><?php echo $blogcek['category_name'] ?></a>
                                            <a href="blog.php?blog_id=<?php echo $blogcek['blog_id'] ?>">
                                                <div class="inner">
                                                    <img class="bordered" style="width:100%; height:300px; object-fit: cover; object-position: center;" src="images/blog/<?php echo $blogcek['blog_photo'] ?>" alt="post-title" />
                                                </div>
                                            </a>
                                        </div>
                                        <div class="details">
                                            <h5 class="post-title mb-3"><?php echo $blogcek['blog_title'] ?></a></h5>
                                            <p class="excerpt mb-0"><?php echo substr($blogcek['blog_description'],0,250)."..."?></p>
                                        </div>
                                        <div class="post-bottom clearfix d-flex align-items-center">
                                            <div class="social-share me-auto">
                                                <button class="toggle-button icon-share"></button>
                                                <ul class="icons list-unstyled list-inline mb-0">
                                                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i class="far fa-envelope"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="more-button float-end">
                                                <a href="blog.php?blog_id=<?php echo $blogcek['blog_id'] ?>"><span class="icon-options"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }  ?>
                   
				</div>
			</div>
			<?php include 'sidebar.php' ?>

		</div>

	</div>
</section>
<?php include 'footer.php' ?>