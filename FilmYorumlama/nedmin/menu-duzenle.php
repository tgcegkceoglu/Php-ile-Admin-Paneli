<?php include 'header.php';
$menusor = $db->prepare("SELECT * FROM menu where menu_id=:id");
$menusor->execute(
    array(
        'id' => $_GET['menu_id']
    )
);
$menucek = $menusor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card border-bottom-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                            Menü Düzenleme
                            <small class="float-right">
                                <?php
                                if (isset($_GET['durum'])) {
                                    if ($_GET['durum'] == "ok") {
                                ?>
                                        <b class="btn btn-success">İşlem Başarılı</b>

                                    <?php } elseif ($_GET['durum'] == "no") {
                                    ?>
                                        <b class="btn btn-danger">İşlem Başarısız</b>
                                <?php }
                                }      ?>
                            </small>
                        </div>
                        <form class="user" action="netting/islem.php" method="POST">
                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Ad</label>
                                <input type="text" class="form-control form-user font-weight-bold" value="<?= $menucek['menu_ad'] ?>" name="menu_ad" id="menu_ad" placeholder="Ad">
                            </div>
                            
                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Sıra</label>
                                <input type="text" class="form-control form-user font-weight-bold" value="<?= $menucek['menu_sira'] ?>" name="menu_sira" id="menu_sira" placeholder="Sıra">
                            </div>

                            <div class="form-group">
                                 <label class="text-sm font-weight-bold text-primary">Üst Kategori</label>
                                 <div>
                                    <select id="heard" class="form-control" name="menu_ust">
                                        <?php 
                                        $ustmenusor = $db->prepare("SELECT * FROM menu");
                                        $ustmenusor->execute();
                                        if($menucek['menu_ust']==0){ ?>
                                           <option value="0" selected >Üst Kategori Yok</option> <?php
                                        }
                                        else{ ?>
                                            <option value="0">Üst Kategori Yok</option>
                                      <?php }
                                        while($ustmenucek = $ustmenusor->fetch(PDO::FETCH_ASSOC)){ ?>
                                           <option value="<?php echo $ustmenucek['menu_id'] ?>" <?php echo $menucek['menu_ust'] == $ustmenucek['menu_id']  ? 'selected=""' : ''; ?>><?php echo $ustmenucek['menu_ad'] ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Url</label>
                                <input type="text" class="form-control form-user font-weight-bold" value="<?= $menucek['menu_url'] ?>" name="menu_url" id="menu_url" placeholder="Url">
                            </div>

                            <div class="form-group">
                                <label class="text-sm font-weight-bold text-primary">Durum</label>
                                <div>
                                    <select id="heard" class="form-control" name="menu_durum" required>
                                        <option value="1" <?php echo $menucek['menu_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                                        <option value="0" <?php echo $menucek['menu_durum'] == '0' ? 'selected=""' : ''; ?>>Pasif</option>
                                    </select>
                                </div>
                            </div>


                            <input type="hidden" name="menu_id" value="<?php echo $menucek['menu_id'] ?>">
                            <div class="form-group">
                                <button class="btn btn-primary float-right" type="submit" name="menuduzenle" type="submit">Güncelle</button>
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