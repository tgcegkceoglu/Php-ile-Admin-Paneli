<?php
include 'nedmin/netting/baglan.php';
$menusor = $db->prepare("SELECT * FROM menu where menu_id=:id");
$menusor->execute(
	array(
		'id' => 0
	)
);
$menucek = $menusor->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'header.php' ?>
<!-- page header -->
<section class="page-header">
	<div class="container-xl">
		<div class="text-center">
			<h1 class="mt-0 mb-2">Menü</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="index.php">Ana Sayfa</a></li>
					<li class="breadcrumb-item active" aria-current="page">Menü</li>
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

				<div class="page-content bordered rounded padding-30">

					<img src="images/logo.webp" alt="Katen Doe" class="rounded mb-4" />
					<p> <?= $menucek['menu_icerik'] ?> </p>
					<h4> Misyon</h4>
					<p> <?= $menucek['menu_misyon'] ?></p>
					<h4> Vizyon</h4>
					<p> <?= $menucek['menu_vizyon'] ?></p>
					<h4> Tanıtım Videosu </h4>
					<iframe width="560" class="rounded" height="315" src="https://www.youtube.com/embed/9YcwFYrM0JM"></iframe>

					<hr class="my-4" />
					<ul class="social-icons list-unstyled list-inline mb-0">
						<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
					</ul>

				</div>

			</div>
			<?php include 'sidebar.php' ?>

		</div>

	</div>

	</div>
</section>

<!-- instagram feed -->
<div class="instagram">
	<div class="container-xl">
		<!-- button -->
		<a href="#" class="btn btn-default btn-instagram">@Katen on Instagram</a>
		<!-- images -->
		<div class="instagram-feed d-flex flex-wrap">
			<div class="insta-item col-sm-2 col-6 col-md-2">
				<a href="#">
					<img src="images/insta/insta-1.jpg" alt="insta-title" />
				</a>
			</div>
			<div class="insta-item col-sm-2 col-6 col-md-2">
				<a href="#">
					<img src="images/insta/insta-2.jpg" alt="insta-title" />
				</a>
			</div>
			<div class="insta-item col-sm-2 col-6 col-md-2">
				<a href="#">
					<img src="images/insta/insta-3.jpg" alt="insta-title" />
				</a>
			</div>
			<div class="insta-item col-sm-2 col-6 col-md-2">
				<a href="#">
					<img src="images/insta/insta-4.jpg" alt="insta-title" />
				</a>
			</div>
			<div class="insta-item col-sm-2 col-6 col-md-2">
				<a href="#">
					<img src="images/insta/insta-5.jpg" alt="insta-title" />
				</a>
			</div>
			<div class="insta-item col-sm-2 col-6 col-md-2">
				<a href="#">
					<img src="images/insta/insta-6.jpg" alt="insta-title" />
				</a>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>