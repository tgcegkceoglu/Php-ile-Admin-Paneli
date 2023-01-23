
<?php 
	include 'header.php'; 
	$blogsor = $db->prepare("SELECT * FROM blog where blog_id=:id");
	$blogsor->execute(
		array(
			'id' => $_GET['blog_id']
		)
	);
	$blogcek = $blogsor->fetch(PDO::FETCH_ASSOC);
?>
	<section class="main-content mt-3">
		<div class="container-xl">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="kategoriler.php">Kategoriler</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $blogcek['blog_title'] ?></li>
                </ol>
            </nav>

			<div class="row gy-4">

				<div class="col-lg-8">
					<!-- post single -->
                    <div class="post post-single">
						<div class="post-content clearfix">
						    <?php echo $blogcek['blog_content'];  ?>
						</div>
						<!-- post bottom section -->
						<div class="post-bottom">
							<div class="row d-flex align-items-center">
								<div class="col-md-12 col-12 text-center text-md-start">
									<!-- tags -->
									<?php 
									$split = explode(",", $blogcek['blog_keywords']);
									for($i=0; $i<count($split); $i++){?>
										<a href="#" class="tag"><?php echo $split[$i] ?></a>	
									<?php } ?>
								</div>
							</div>
						</div>

                    </div>
                </div>
                <?php include 'sidebar.php' ?>

			</div>

		</div>
	</section>
<?php include 'footer.php' ?>