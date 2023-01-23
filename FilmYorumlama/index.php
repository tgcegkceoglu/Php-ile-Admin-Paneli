<?php include 'header.php';

$query = "SELECT * FROM blog where blog_status=:blog_status  ORDER BY blog_date DESC";
$goster = $db->prepare($query);
$goster->execute(array(
	'blog_status' => 1
)); 
$toplamSatirSayisi = $goster->rowCount();
$tumSonuclar = $goster->fetchAll();

$query1 = "SELECT * FROM blog where blog_editor=:blog_editor AND blog_status=:blog_status ORDER BY blog_id DESC";
$goster1 = $db->prepare($query1);
$goster1->execute(array(
	'blog_editor' => 1,
	'blog_status' => 1
));


$toplamSatirSayisi1 = $goster1->rowCount();
$tumSonuclar1 = $goster1->fetchAll();

$query2 = "SELECT * FROM blog where blog_trend=:blog_trend AND blog_status=:blog_status ORDER BY blog_id DESC";
$goster2 = $db->prepare($query2);
$goster2->execute(array(
	'blog_trend' => 1,
	'blog_status' => 1
));
$toplamSatirSayisi2 = $goster2->rowCount();
$tumSonuclar2 = $goster2->fetchAll();


$query3 = "SELECT * FROM kullanici";
$goster3 = $db->prepare($query3);
$goster3->execute(array());
$toplamSatirSayisi3 = $goster3->rowCount();
$tumSonuclar3 = $goster3->fetchAll();


if($toplamSatirSayisi !=0){
?>

	<!-- hero section -->
	<section id="hero">

		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">
					<?php 
					for($i=0;$i<$toplamSatirSayisi3; $i++){
						if($tumSonuclar[0]['blog_author']== $tumSonuclar3[$i]['kullanici_id']){
							$tumSonuclar[0]['blog_author']=$tumSonuclar3[$i]['kullanici_adsoyad'];
						}
					}
					?>
					<!-- featured post large -->
					<div class="post featured-post-lg">
						<div class="details clearfix">
							<a href="category.html" class="category-badge"><?php  echo $tumSonuclar[0]['category_name'] ?></a>
							<h2 class="post-title"><a href="blog.php?blog_id=<?php echo $tumSonuclar[0]['blog_id']?>"><?php echo $tumSonuclar[0]['blog_title'] ?></a></h2>
							<ul class="meta list-inline mb-0">
								<li class="list-inline-item"><a href="#"><?php echo $tumSonuclar[0]['blog_author'] ?></a></li>
								<?php $zaman=explode(" ",$tumSonuclar[0]['blog_date']);
								$zaman = str_replace('/', '-', $zaman[0]);
								$zaman = date('d.m.Y', strtotime($zaman)); ?>
								<li class="list-inline-item"><?php echo $zaman ?></li>
							</ul>
						</div>
						<a href="blog.php?blog_id=<?php echo $tumSonuclar[0]['blog_id']?>">
							<div class="thumb rounded">
								<div class="inner data-bg-image" data-bg-image="images/blog/<?php echo $tumSonuclar[0]['blog_photo']?>"></div>
							</div>
						</a>
					</div>
					
					<div class="spacer" data-height="50"></div>
                    <?php if($toplamSatirSayisi1 !=0){ ?>
					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title main-content">Editörün Seçimi</h3>
						<img src="images/wave.svg" class="wave" alt="wave" />
					</div>

					<div class="padding-30 rounded bordered">
						<div class="row gy-5">
							  <?php if($toplamSatirSayisi1==1){
								$resim;
								for($i=0;$i<$toplamSatirSayisi3; $i++){
									if($tumSonuclar1[0]['blog_author']== $tumSonuclar3[$i]['kullanici_id']){
										$tumSonuclar1[0]['blog_author']=$tumSonuclar3[$i]['kullanici_adsoyad'];
										$resim=$tumSonuclar3[$i]['kullanici_resim'];
									}
								}
								$zaman=explode(" ",$tumSonuclar1[0]['blog_date']);
								$zaman = str_replace('/', '-', $zaman[0]);
								$zaman = date('d.m.Y', strtotime($zaman)); 
								?>
								<div class="col-sm-12">
								<!-- post -->
									<div class="post">
										<div class="thumb rounded">
											<a href="category.html" class="category-badge position-absolute"><?php  echo $tumSonuclar1[0]['category_name'] ?></a>
											<a href="blog.php?blog_id=<?php echo $tumSonuclar1[0]['blog_id'] ?>l">
												<div class="inner">
													<img src="images/blog/<?php  echo $tumSonuclar1[0]['blog_photo'] ?>" style="width: 100%; height: 300px; object-fit: cover;" alt="post-title" />
												</div>
											</a>
										</div>
										<ul class="meta list-inline mt-4 mb-0">
											<li class="list-inline-item "><a href="#"><img src="images/author/<?php  echo $resim ?>" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" class="author" alt="author"/><?php  echo $tumSonuclar1[0]['blog_author'] ?></a></li>
											<li class="list-inline-item"><?php  echo $zaman ?></li>
										</ul>
										<h5 class="post-title mb-3 mt-3"><a href="blog.php?blog_id=<?php echo $tumSonuclar[0]['blog_id'] ?>"><?php  echo $tumSonuclar1[0]['blog_title'] ?></a></h5>
										<p class="excerpt mb-0"><?php  echo substr($tumSonuclar1[0]['blog_description'],0,250)."..."  ?></p>
									</div>
							    </div>
								<?php }
								   else if($toplamSatirSayisi1>1){
									$sayac=0;
									for($i=0; $i<$toplamSatirSayisi1; $i++){
										if($sayac<4){
										$zaman=explode(" ",$tumSonuclar1[$i]['blog_date']);
										$zaman = str_replace('/', '-', $zaman[0]);
										$zaman = date('d.m.Y', strtotime($zaman)); 

										$resim;
										for($j=0;$j<$toplamSatirSayisi3; $j++){
											if($tumSonuclar1[$i]['blog_author']== $tumSonuclar3[$j]['kullanici_id']){
												$tumSonuclar1[$i]['blog_author']=$tumSonuclar3[$j]['kullanici_adsoyad'];
												$resim=$tumSonuclar3[$j]['kullanici_resim'];
											}
										}
									?>
									<div class="col-sm-6">
										<div class="post">
											<div class="thumb rounded">
												<a href="category.html" class="category-badge position-absolute"><?php  echo $tumSonuclar1[$i]['category_name'] ?></a>
												<a href="blog.php?blog_id=<?php echo $tumSonuclar[$i]['blog_id'] ?>">
													<div class="inner">
														<img style="width: 100%; height: 300px; object-fit: cover;" src="images/blog/<?php  echo $tumSonuclar1[$i]['blog_photo'] ?>" alt="post-title" />
													</div>
												</a>
											</div>
											<ul class="meta list-inline mt-4 mb-0">
												<li class="list-inline-item"><a href="#"><img src="images/author/<?php  echo $resim ?>" class="author" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" alt="author"/><?php  echo $tumSonuclar1[$i]['blog_author'] ?></a></li>
												<li class="list-inline-item"><?php  echo $zaman ?></li>
											</ul>
											<h5 class="post-title mb-3 mt-3 word-wrap:break-word;"><a href="blog.php?blog_id=<?php echo $tumSonuclar[$i]['blog_id'] ?>"><?php  echo $tumSonuclar1[$i]['blog_title'] ?></a></h5>
											<p class="excerpt mb-0" style="word-wrap:break-word;"><?php  echo substr($tumSonuclar1[$i]['blog_description'],0,250)."..."  ?></p>
										</div>
							  		 </div>
									   <?php } $sayac++; } } ?>
								
						</div>

					</div> <?php } ?>

					<div class="spacer" data-height="50"></div>
					<?php if($toplamSatirSayisi2 !=0){?>
					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title main-content">Trendler</h3>
						<img src="images/wave.svg" class="wave" alt="wave" />
					</div>
					<div class="padding-30 rounded bordered">
						<div class="row gy-5">
								<?php if($toplamSatirSayisi2==1){
									$zaman=explode(" ",$tumSonuclar2[0]['blog_date']);
									$zaman = str_replace('/', '-', $zaman[0]);
									$zaman = date('d.m.Y', strtotime($zaman)); 

									$resim;
									for($i=0;$i<$toplamSatirSayisi3; $i++){
										if($tumSonuclar2[0]['blog_author']== $tumSonuclar3[$i]['kullanici_id']){
											$tumSonuclar2[0]['blog_author']=$tumSonuclar3[$i]['kullanici_adsoyad'];
											$resim=$tumSonuclar3[$i]['kullanici_resim'];
										}
									}
									?>
								<div class="col-sm-12">
									<!-- post large -->
									<div class="post">
										<div class="thumb rounded">
											<a href="category.html" class="category-badge position-absolute"><?php  echo $tumSonuclar2[0]['category_name'] ?></a>
											<a href="blog.php?blog_id=<?php echo $tumSonuclar2[0]['blog_id'] ?>">
												<div class="inner">
													<img src="images/blog/<?php  echo $tumSonuclar2[0]['blog_photo'] ?>" style="width: 100%; height: 300px; object-fit: cover;" alt="post-title" />
												</div>
											</a>
										</div>
										<ul class="meta list-inline mt-4 mb-0">
										<li class="list-inline-item "><a href="#"><img src="images/author/<?php  echo $resim ?>" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" class="author" alt="author"/><?php  echo $tumSonuclar2[0]['blog_author'] ?></a></li>
											<li class="list-inline-item"><?php  echo $zaman ?></li>
										</ul>
										<h5 class="post-title mb-3 mt-3"><a href="blog.php?blog_id=<?php echo $tumSonuclar[0]['blog_id'] ?>"><?php  echo $tumSonuclar2[0]['blog_title'] ?></a></h5>
										<p class="excerpt mb-0"><?php  echo substr($tumSonuclar2[0]['blog_description'],0,150)."..."  ?></p>
									</div>
								</div>
								<?php } ?>

							<?php if($toplamSatirSayisi2==2){
								for($i=0; $i<$toplamSatirSayisi2; $i++){
									$zaman=explode(" ",$tumSonuclar2[$i]['blog_date']);
									$zaman = str_replace('/', '-', $zaman[0]);
									$zaman = date('d.m.Y', strtotime($zaman)); 

									$resim;
									for($j=0;$j<$toplamSatirSayisi3; $j++){
										if($tumSonuclar2[0]['blog_author']== $tumSonuclar3[$j]['kullanici_id']){
											$tumSonuclar2[0]['blog_author']=$tumSonuclar3[$j]['kullanici_adsoyad'];
											$resim=$tumSonuclar3[$j]['kullanici_resim'];
										}
									}
									
									?>
									<div class="col-sm-6">
										<!-- post large -->
										<div class="post">
											<div class="thumb rounded">
												<a href="category.html" class="category-badge position-absolute"><?php  echo $tumSonuclar2[$i]['category_name'] ?></a>
												<a href="blog.php?blog_id=<?php echo $tumSonuclar2[$i]['blog_id'] ?>">
													<div class="inner">
														<img src="images/blog/<?php  echo $tumSonuclar2[$i]['blog_photo'] ?>" style="width: 100%; height: 300px; object-fit: cover;" alt="post-title" />
													</div>
												</a>
											</div>
											<ul class="meta list-inline mt-4 mb-0">
												<li class="list-inline-item"><a href="#"><img src="images/author/<?php  echo $resim ?>"  style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" class="author" alt="author"/><?php  echo $tumSonuclar2[0]['blog_author'] ?></a></li>
												<li class="list-inline-item"><?php  echo $zaman ?></li>
											</ul>
											<h5 class="post-title mb-3 mt-3"><a href="blog.php?blog_id=<?php echo $tumSonuclar[$i]['blog_id'] ?>"><?php  echo $tumSonuclar2[$i]['blog_title'] ?></a></h5>
											<p class="excerpt mb-0"><?php  echo substr($tumSonuclar2[$i]['blog_description'],0,150)."..."  ?></p>
										</div>
									</div>
							
							<?php } } ?>

							<?php if($toplamSatirSayisi2>2){
								for($i=0; $i<$toplamSatirSayisi2; $i++){
									$zaman=explode(" ",$tumSonuclar2[$i]['blog_date']);
									$zaman = str_replace('/', '-', $zaman[0]);
									$zaman = date('d.m.Y', strtotime($zaman)); 

									$resim;
									for($j=0;$j<$toplamSatirSayisi3; $j++){
										if($tumSonuclar2[0]['blog_author']== $tumSonuclar3[$j]['kullanici_id']){
											$tumSonuclar2[0]['blog_author']=$tumSonuclar3[$j]['kullanici_adsoyad'];
											$resim=$tumSonuclar3[$j]['kullanici_resim'];
										}
									}
									if($i<2){?>
										<div class="col-sm-6">
											<!-- post large -->
											<div class="post">
												<div class="thumb rounded">
													<a href="category.html" class="category-badge position-absolute"><?php  echo $tumSonuclar2[$i]['category_name'] ?></a>
													<span class="post-format">
														<i class="icon-picture"></i>
													</span>
													<a href="blog.php?blog_id=<?php echo $tumSonuclar2[$i]['blog_id'] ?>">
														<div class="inner">
															<img src="images/blog/<?php  echo $tumSonuclar2[$i]['blog_photo'] ?>" style="width: 100%; height: 300px; object-fit: cover;"alt="post-title" />
														</div>
													</a>
												</div>
												<ul class="meta list-inline mt-4 mb-0">
													<li class="list-inline-item"><a href="#"><img src="images/author/<?php  echo $resim ?>"  style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" class="author" alt="author"/><?php  echo $tumSonuclar2[0]['blog_author'] ?></a></li>
													<li class="list-inline-item"><?php  echo $zaman ?></li>
												</ul>
												<h5 class="post-title mb-3 mt-3"><a href="blog.php?blog_id=<?php echo $tumSonuclar2[$i]['blog_id'] ?>"><?php  echo $tumSonuclar2[$i]['blog_title'] ?></a></h5>
												<p class="excerpt mb-0"><?php  echo substr($tumSonuclar2[$i]['blog_description'],0,150)."..."  ?></p>
											</div>	
										</div>
									<?php } else{?>
										  <!-- post -->
										    <div class="col-sm-12">
												<div class="post post-list-sm square before-seperator">
													<div class="thumb rounded">
														<a href="blog.php?blog_id=<?php echo $tumSonuclar2[$i]['blog_id'] ?>">
															<div class="inner">
																<img src="images/blog/<?php  echo $tumSonuclar2[$i]['blog_photo'] ?>" style="object-fit: cover;" alt="post-title" />
															</div>
														</a>
													</div>
													<div class="details clearfix">
														<h6 class="post-title my-0"><a href="blog.php?blog_id=<?php echo $tumSonuclar2[$i]['blog_id'] ?>"><?php  echo $tumSonuclar2[$i]['blog_title'] ?></a></h6>
														<p class="post-title my-0"><a href="blog.php?blog_id=<?php echo $tumSonuclar2[$i]['blog_id'] ?>"><?php  echo substr($tumSonuclar2[$i]['blog_description'],0,250)."..." ?></a></p>
														<ul class="meta list-inline mt-1 mb-0">
															<li class="list-inline-item"><?php  echo $zaman ?></li>
														</ul>
													</div>
												</div>
										 	</div>
									<?php } ?>
							<?php } } ?>
						</div></div>
						<?php  } ?>
					<div class="spacer" data-height="50"></div>

					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title main-content">Son Gönderimler</h3>
						<img src="images/wave.svg" class="wave" alt="wave" />
					</div>

					<div class="padding-30 rounded bordered">

						<div class="row">
                            <?php
							
							for($i=0; $i<4; $i++){
								$resim;
								for($j=0;$j<$toplamSatirSayisi3; $j++){
									if($tumSonuclar[$i]['blog_author']== $tumSonuclar3[$j]['kullanici_id']){
										$tumSonuclar[$i]['blog_author']=$tumSonuclar3[$j]['kullanici_adsoyad'];
										$resim=$tumSonuclar3[$j]['kullanici_resim'];
									}
								}

								$zaman=explode(" ",$tumSonuclar[$i]['blog_date']);
								$zaman = str_replace('/', '-', $zaman[0]);
								$zaman = date('d.m.Y', strtotime($zaman));
								?>
								<div class="col-md-12 col-sm-6">
								<!-- post -->
									<div class="post post-list clearfix">
										<div class="thumb rounded">
											<a href="blog.php?blog_id=<?php echo $tumSonuclar[$i]['blog_id'] ?>">
												<div class="inner">
													<img src="images/blog/<?php echo $tumSonuclar[$i]['blog_photo'] ?>" style="width: 300px; object-fit: cover; height: 280px;" alt="post-title" />
												</div>
											</a>
										</div>
										<div class="details">
											<ul class="meta list-inline mb-3">
												<li class="list-inline-item"><a href="#"><img src="images/author/<?php  echo $resim ?>" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;" class="author" alt="author"/><?php  echo $tumSonuclar[$i]['blog_author'] ?></a></li>
												<li class="list-inline-item"><a href="#"><?php  echo $tumSonuclar[$i]['category_name'] ?></a></li>
												<li class="list-inline-item"><?php  echo $zaman ?></li>
											</ul>
											<h5 class="post-title"><a href="blog.php?blog_id=<?php echo $tumSonuclar[$i]['blog_id'] ?>"><?php  echo $tumSonuclar[$i]['blog_title'] ?></a></h5>
											<p class="excerpt mb-0"><?php  echo substr($tumSonuclar[$i]['blog_description'],0,250)."..."?></p>
											<div class="post-bottom clearfix d-flex align-items-center">
												<?php include 'share.php' ?>
												<div class="more-button float-end">
													<a href="blog.php?blog_id=<?php echo $tumSonuclar[$i]['blog_id'] ?>"><span class="icon-options"></span></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							?>
							
						</div>
						<!-- load more button -->
						<div class="text-center">
							<button class="btn btn-simple"><a href="kategoriler.php">Daha Fazla</a></button>
						</div>

					</div>

				</div>
				<?php include 'sidebar.php' ?>

				

			</div>

		</div>

	</section>
<?php include 'footer.php'; } else{ include 'veribulunamadi.php'; }  ?>