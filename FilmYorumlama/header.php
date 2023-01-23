<?php 
   include 'nedmin/netting/baglan.php';
   $ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
   $ayarsor->execute(
    array(
       'id' => 0
    ));
   $ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

   $menusor=$db->prepare("SELECT * FROM menu WHERE menu_durum=:durum AND menu_ust=:ust ORDER BY menu_sira limit 5");
   $menusor->execute(
	array(
		'durum' => 1,
		'ust' => 0
	)
   );

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $ayarcek['ayar_title']; ?></title>
    <meta name="description" content="<?php echo $ayarcek['ayar_description']; ?>">
    <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords']; ?>">
    <meta name="author" content="<?php echo $ayarcek['ayar_author']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/all.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/slick.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- preloader -->
<div id="preloader">
	<div class="book">
		<div class="inner">
			<div class="left"></div>
			<div class="middle"></div>
			<div class="right"></div>
		</div>
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>

<!-- site wrapper -->
<div class="site-wrapper">

	<div class="main-overlay"></div>

	<!-- header -->
	<header class="header-default">
		<nav class="navbar navbar-expand-lg">
			<div class="container-xl">
				<!-- site logo -->
				<a class="navbar-brand" href="index.php"><img src="images/logo.svg" width="200px" alt="logo"/></a> 

				<div class="collapse navbar-collapse">
					<!-- menus -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown active">
							<a class="nav-link" href="index.php">Ana Sayfa</a>
						</li>
						<?php 
							while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)){
							if($menucek['menu_ust']==0){
								$altmenusor=$db->prepare("SELECT * FROM menu WHERE menu_ust=:menu_ust");
								$altmenusor->execute(
								 array(
									 'menu_ust' => $menucek['menu_id']
								 ));
								$say = $altmenusor->rowCount();
								$kategorisor=$db->prepare("SELECT * FROM kategori WHERE kategori_ust=:kategori_ust  ORDER BY kategori_sira ASC");
								$kategorisor->execute(array(
									'kategori_ust' => $menucek['menu_id']
								));		
								$say1 = $kategorisor->rowCount();				
								if($say==0 && $say1 ==0){ ?>
									<li class="nav-item">
									<a class="nav-link" href="<?php echo !empty($menucek['menu_url']) ?  $menucek['menu_url'] : "menusayfa.php?menu_seourl=".$menucek['menu_seourl'] ?>"><?php echo $menucek['menu_ad']; ?></a>
								    </li>
								<?php }
								else{ 
									?>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="<?php echo !empty($menucek['menu_url']) ?  $menucek['menu_url'] : "menusayfa.php?menu_seourl=".$menucek['menu_seourl'] ?>"><?php echo $menucek['menu_ad'] ?></a>
										<ul class="dropdown-menu">
											<?php 
											if($say!=0){
												while($altmenucek=$altmenusor->fetch(PDO::FETCH_ASSOC)){ ?>
													<li><a class="dropdown-item" href="<?php echo !empty($altmenucek['menu_url']) ? $altmenucek['menu_url'] : "kategoriler.php?kategori_seourl=".$altmenucek['menu_seourl'] ?>"><?php echo $altmenucek['menu_ad']; ?></a></li> 
												<?php } 
											}		
											while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){
												if($kategoricek['kategori_ust']==$menucek['menu_id'])
												{ ?>
													<li><a class="dropdown-item" href="kategoriler.php?kategori_seourl=<?php echo $kategoricek['kategori_seourl'] ?>"><?php echo $kategoricek['kategori_ad']; ?></a></li> 
												<?php } }?>
											
										</ul>
									</li> <?php 
								}
								?>
							<?php 
							}
							}
						?>						
					</ul>
				</div>
			</div>
		</nav>
	</header>