<?php
include 'nedmin/netting/baglan.php';
$hakkimizdasor = $db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id");
$hakkimizdasor->execute(
	array(
		'id' => 0
	)
);
$hakkimizdacek = $hakkimizdasor->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'header.php' ?>
<!-- page header -->
<section class="page-header">
	<div class="container-xl">
		<div class="text-center">
			<h1 class="mt-0 mb-2">Hakkımızda</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="index.php">Ana Sayfa</a></li>
					<li class="breadcrumb-item active" aria-current="page">Hakkımızda</li>
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

					<img src="images/kategori/<?php echo $hakkimizdacek['hakkimizda_resim'] ?>"  class="rounded mb-4" />
					<p> <?= $hakkimizdacek['hakkimizda_icerik'] ?> </p>
					<h4> Misyon</h4>
					<p> <?= $hakkimizdacek['hakkimizda_misyon'] ?></p>
					<h4> Vizyon</h4>
					<p> <?= $hakkimizdacek['hakkimizda_vizyon'] ?></p>
				</div>

			</div>
			<?php include 'sidebar.php' ?>

		</div>

	</div>

	</div>
</section>
<?php include 'footer.php' ?>