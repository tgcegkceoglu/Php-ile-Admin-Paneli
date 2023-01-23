<?php include 'header.php';
$blogsor = $db->prepare("SELECT * FROM blog where blog_id=:id");
$blogsor->execute(
    array(
        'id' => $_GET['blog_id']
    )
);
$uzunluk=$blogsor->rowCount();
$blogcek = $blogsor->fetch(PDO::FETCH_ASSOC);
$kategorisor=$db->prepare("SELECT * FROM kategori ORDER BY kategori_ad ASC");
$kategorisor->execute();

$menusor=$db->prepare("SELECT * FROM menu ORDER BY menu_ad ASC");
$menusor->execute();

?>
<style>
    input[type=file]::file-selector-button {
        margin-right: 20px;
        border: none;
        background: #476dda;
        padding: 10px 20px;
        border-radius: 10px;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease-in-out;
    }
    input[type=file]{
        color: transparent;
    }
</style>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                            Blog Düzenleme
                            <small class="float-right">
                                <?php
                                if (isset($_GET['durum'])) {
                                    if ($_GET['durum'] == "ok") {?>
                                        <b class="btn btn-success">İşlem Başarılı</b> <?php 
                                    }
                                    elseif ($_GET['durum'] == "no"){?>
                                        <b class="btn btn-danger">İşlem Başarısız</b> <?php 
                                    }
                                }
                                
                                if(isset($_GET['size']))    {
                                    if($_GET['size'] == "no"){ 
                                        ?>
                                            <b class="btn btn-danger">Fotoğrafın Boyutu 2MB Büyük Olamaz</b>
                                        <?php 
                                    }
                                }
                                
                                if(isset($_GET['uzanti']))    {
                                if($_GET['uzanti'] == "no"){ 
                                    ?>
                                        <b class="btn btn-danger">Fotoğraf sadece .jpeg veya .png formatında olmalıdır.</b>
                                    <?php 
                                }
                                } ?>
                            </small>
                        </div>
                        <form class="user" action="netting/islem.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <img style="width: 150px; height: 150px; object-fit: cover;" src="http://localhost/SunucuTabanliProgramlama/FilmYorumlama/images/blog/<?php echo $blogcek['blog_photo'] ?>" id="imgshow">
                                <input type="file" name="resim" id="resim" />
                            </div>
 
                            <div class="form-group">
                                <label class="text-sm text-primary">Blog Başlık</label>
                                <input type="text" class="form-control form-user"  value="<?php echo  $blogcek['blog_title']; ?>" name="blog_title" id="blog_title" placeholder="Ad">
                            </div>

                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Kategori</label>
                                <select id="heard" class="form-control" name="category_name">
                                    <?php 
                                    while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <option value="<?php echo $kategoricek['kategori_ad'] ?>" <?php echo mb_strtolower($kategoricek['kategori_ad']) == mb_strtolower($blogcek['category_name'])  ? 'selected=""' : ''; ?> ><?php echo $kategoricek['kategori_ad'] ?></option>

                                    <?php } 
                                    while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <option value="<?php echo $menucek['menu_ad'] ?>" <?php echo mb_strtolower($menucek['menu_ad']) == mb_strtolower($blogcek['category_name'])  ? 'selected=""' : ''; ?> ><?php echo $menucek['menu_ad'] ?></option>

                                    <?php } ?>  
                                </select>
                            </div>
                            <div class="form-group ">
                                <label class="text-sm text-primary">Blog İçerik</label>
                                <textarea id="editor" name="blog_content"><?= $blogcek['blog_content'] ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label class="text-sm text-primary">Description</label>
                                <input type="text" class="form-control form-user"  value="<?= $blogcek['blog_description'] ?>" name="blog_description" id="blog_description" placeholder="Description">
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="blog_editor" id="blog_editor" <?php echo $blogcek['blog_editor'] == '1' ? 'checked=""' : ''; ?>>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Editörün Seçimi
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="blog_trend" id="blog_trend" <?php echo $blogcek['blog_trend'] == '1' ? 'checked=""' : ''; ?>>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Trendlere Ekle
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="text-sm text-primary">Author</label>
                                <input type="text" class="form-control form-user"  value="<?= $blogcek['blog_author'] ?>" name="blog_author" id="blog_author" placeholder="Author">
                            </div>

                            <div class="form-group">
                                <label class="text-sm text-primary">Anahtar Kelimeler</label>
                                <input type="text" class="form-control form-user"  value="<?= $blogcek['blog_keywords'] ?>" name="blog_keywords" id="blog_keywords" placeholder="Anahtar Kelimeler">
                            </div>

                            <div class="form-group">
                                <label class="text-sm text-primary">Durum</label>
                                <div>
                                    <select id="heard" class="form-control" name="blog_status" required>
                                        <option value="1" <?php echo $blogcek['blog_status'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                                        <option value="0" <?php echo $blogcek['blog_status'] == '0' ? 'selected=""' : ''; ?>>Pasif</option>
                                    </select>
                                </div>
                            </div>


                            <input type="hidden" name="blog_id" value="<?php echo $blogcek['blog_id'] ?>">
                            <div class="form-group">
                                <button class="btn btn-primary float-right" id="button" type="submit" name="blogduzenle" type="submit">Güncelle</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('document').ready(function () {
    $("#resim").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $("#button").click(function(){
        console.log($_FILES['resim']);
    });
});
</script>
<!-- End of Main Content -->
<?php include 'footer.php' ?>