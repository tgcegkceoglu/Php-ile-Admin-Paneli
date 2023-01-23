<?php
    include 'header.php';
    $kategorisor=$db->prepare("SELECT * FROM kategori ORDER BY kategori_ad ASC");
    $kategorisor->execute();

    $menusor=$db->prepare("SELECT * FROM menu ORDER BY menu_ad ASC");
    $menusor->execute();

    $kullanicisor=$db->prepare("SELECT * FROM kullanici ORDER BY kullanici_adsoyad ASC");
    $kullanicisor->execute();

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
</style>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                            Blog Ekleme
                            <small class="float-right">
                                 <?php      
                                  if(isset($_GET['durum']))    {
                                    if($_GET['durum'] == "ok"){ 
                                        ?>
                                            <b class="btn btn-success">İşlem Başarılı</b>
                                                
                                        <?php }
                                        elseif($_GET['durum'] == "no"){ 
                                            ?>
                                                <b class="btn btn-danger">İşlem Başarısız</b>                                         
                                            <?php }
                                 }
                                  if(isset($_GET['size']))    {
                                    if($_GET['size'] == "no"){ 
                                        ?>
                                            <b class="btn btn-danger">Fotoğrafın Boyutu 2MB Büyük Olamaz</b>
                                        <?php }
                                  }
                                  if(isset($_GET['uzanti']))    {
                                    if($_GET['uzanti'] == "no"){ 
                                        ?>
                                            <b class="btn btn-danger">Fotoğraf sadece .jpeg veya .png formatında olmalıdır.</b>
                                        <?php }
                                  }?>    
                                      
                            </small>
                        </div>
                        <form class="user" action="netting/islem.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input required type="file" name="resim" />
                            </div>
                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Blog Başlık</label>
                                <input required type="text" class="form-control form-user font-weight-bold"  name="blog_title" id="blog_title" placeholder="Blog Başlığı">
                            </div>
                            
                           <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Kategori</label>
                                <div>
                                    <select id="heard" class="form-control" name="category_name">
                                        <?php 
                                        while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){ ?>
                                          <option value="<?php echo $kategoricek['kategori_ad'] ?>" ><?php echo $kategoricek['kategori_ad'] ?></option>

                                      <?php } 
                                      while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)){ ?>
                                          <option value="<?php echo $menucek['menu_ad'] ?>" ><?php echo $menucek['menu_ad'] ?></option>

                                      <?php } ?>  
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Blog İçerik</label>
                                <textarea  id="editor" name="blog_content"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Description</label>
                                <input required type="text" class="form-control form-user font-weight-bold"name="blog_description" id="blog_description" placeholder="Description">
                            </div>

                            <div class="form-group">
                                <div class="d-flex align-items-center mb-2"> 
                                    <label  class="text-sm font-weight-bold text-primary mb-0 mr-2 ">Anahtar Kelimeler</label>
                                    <div class='alert alert-info mb-0 p-0 px-1'>Anahtar Kelimleri Virgül Koyarak Ayırınız!</div>
                                </div>
                                <input  required  type="text" class="form-control form-user font-weight-bold "name="blog_keywords" id="blog_keywords" placeholder="Anahtar Kelime">
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="blog_editor" id="blog_editor" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Editörün Seçimi
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="blog_trend" id="blog_trend" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Trendlere Ekle
                                </label>
                            </div>
                            
                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Author</label>
                                <div>
                                    <select id="heard" class="form-control" name="blog_author">
                                        <?php 
                                        while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){ ?>
                                          <option value="<?php echo $kullanicicek['kullanici_id'] ?>" ><?php echo $kullanicicek['kullanici_adsoyad'] ?></option>

                                      <?php } ?>  
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Durum</label>
                                <div>
                                    <select id="heard" class="form-control" name="blog_status">
                                        <option value="1">Aktif</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Pasif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary float-right" type="submit" name="blogkaydet" type="submit">Kaydet</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>

