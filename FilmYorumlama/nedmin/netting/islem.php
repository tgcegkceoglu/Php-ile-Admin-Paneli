<?php 
    ob_start();
    session_start();
    include 'baglan.php';
    function seo($str, $options = array())
    {
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

    if(isset($_POST['admingiris'])){
        $kullanici_mail=$_POST['kullanici_mail'];
        $kullanici_password=$_POST['kullanici_password'];
        $kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:kullanici_pasword");
        $kullanicisor->execute(
            array(
            'mail' => $kullanici_mail,
            'kullanici_pasword'=> $kullanici_password
            ));
        $say=$kullanicisor->rowCount();
        if($say==1){
            $_SESSION['kullanici_mail'] = $kullanici_mail;
            header("Location:../anasayfa.php");
        }
        else{
            header("Location:../login.php?durum=no");
            exit;
        }
    }

    if(isset($_POST['kullanicikaydet'])){
        $tmp_name=$_FILES['resim']['tmp_name'];
        $name=$_FILES['resim']['name'];
        $boyut=$_FILES['resim']['size'];
        $tip=$_FILES['resim']['type'];
        $uzanti=substr($name,-4,4);
        if($boyut>1024*1024*2){
            header("Location:../kullanici-ekle.php?size=no");
        }
        elseif($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti !='.jpg'){
            header("Location:../kullanici-ekle.php?uzanti=no");
        }
        else{
            if(!file_exists($name)){
                move_uploaded_file($tmp_name, '../../images/author/' . $name); 
            }
            $ayarkaydet=$db->prepare("INSERT INTO kullanici SET
            kullanici_adsoyad=:kullanici_adsoyad,
            kullanici_mail=:kullanici_mail,
            kullanici_password=:kullanici_password,
            kullanici_durum=:kullanici_durum,
            kullanici_resim=:kullanici_resim"
            );

            $insert=$ayarkaydet->execute(
                array(
                    'kullanici_adsoyad'=> $_POST['kullanici_adsoyad'],
                    'kullanici_mail' => $_POST['kullanici_mail'],
                    'kullanici_password' => $_POST['kullanici_password'],
                    'kullanici_durum' => $_POST['kullanici_durum'],
                    'kullanici_resim' => $name
                )
            );

            if($insert){
                header("Location:../kullanici-ekle.php?durum=ok");
            }
            else{
                header("Location:../kullanici-ekle.php?durum=no");
            }
        }
        
    }

    if(isset($_POST['kullaniciduzenle'])){
        $kullanici_id=$_POST['kullanici_id'];
        if($_FILES['resim']['name']!=null){
            $tmp_name=$_FILES['resim']['tmp_name'];
            $name=$_FILES['resim']['name'];
            $boyut=$_FILES['resim']['size'];
            $tip=$_FILES['resim']['type'];
            $uzanti=substr($name,-4,4);
            if($boyut>1024*1024*2){
                header("Location:../kullanici-duzenle.php?kullanici_id=$kullanici_id&size=no");
            }
            elseif($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti !='.jpg'){
                header("Location:../kullanici-duzenle.php?kullanici_id=$kullanici_id&uzanti=no");
            }
            else{
                if(!file_exists($name)){
                    move_uploaded_file($tmp_name, '../../images/author/' . $name); 
                }
                $ayarkaydet=$db->prepare("UPDATE kullanici SET
                kullanici_resim=:kullanici_resim,
                kullanici_adsoyad=:kullanici_adsoyad,
                kullanici_durum=:kullanici_durum
                WHERE kullanici_id={$_POST['kullanici_id']}"
                );

                $update=$ayarkaydet->execute(
                    array(
                        'kullanici_resim'=> $name,
                        'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
                        'kullanici_durum' => $_POST['kullanici_durum']
                    )
                );

                if($update){
                    header("Location:../kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
                }
                else{
                    header("Location:../kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
                }
            }
        }
        else{
            $ayarkaydet=$db->prepare("UPDATE kullanici SET
            kullanici_adsoyad=:kullanici_adsoyad,
            kullanici_durum=:kullanici_durum
            WHERE kullanici_id={$_POST['kullanici_id']}"
          );
          $update=$ayarkaydet->execute(
            array(
                'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
                'kullanici_durum' => $_POST['kullanici_durum']
            )
        );

            if($update){
                header("Location:../kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");
            }
            else{
                header("Location:../kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
            }   
        }
        
    }    


    if(isset($_POST['menukaydet'])){
        $menu_seourl=seo($_POST["menu_ad"]);
        $ayarkaydet=$db->prepare("INSERT INTO menu SET
          menu_ad=:menu_ad,
          menu_seourl=:menu_seourl,
          menu_url=:menu_url,
          menu_ust=:menu_ust,
          menu_sira=:menu_sira,
          menu_durum=:menu_durum"
        );

        $insert=$ayarkaydet->execute(
            array(
                'menu_ad'=> $_POST['menu_ad'],
                'menu_seourl' => $menu_seourl,
                'menu_url' => $_POST['menu_url'],
                'menu_ust' => $_POST['menu_ust'],
                'menu_sira' => $_POST['menu_sira'],
                'menu_durum' => $_POST['menu_durum']
            )
        );

        if($insert){
            header("Location:../menu-ekle.php?durum=ok");
        }
        else{
            header("Location:../menu-ekle.php?durum=no");
        }
    }

    if(isset($_POST['menuduzenle'])){
        $menu_seourl=seo($_POST["menu_ad"]);
        $menu_id=$_POST['menu_id'];
        $ayarkaydet=$db->prepare("UPDATE menu SET
          menu_ad=:menu_ad,
          menu_seourl=:menu_seourl, 
          menu_url=:menu_url,
          menu_ust=:menu_ust,
          menu_sira=:menu_sira,
          menu_durum=:menu_durum
          WHERE menu_id={$_POST['menu_id']}"
        );

        $update=$ayarkaydet->execute(
            array(
                'menu_ad'=> $_POST['menu_ad'],
                'menu_seourl' => $menu_seourl,
                'menu_url' => $_POST['menu_url'],
                'menu_ust' => $_POST['menu_ust'],
                'menu_sira' => $_POST['menu_sira'],
                'menu_durum' => $_POST['menu_durum']
            )
        );

        if($update){
            header("Location:../menu-duzenle.php?menu_id=$menu_id&durum=ok");
        }
        else{
            header("Location:../menu-duzenle.php?menu_id=$menu_id&durum=no");
        }
    }  
    
    if($_GET['menusil'] == "ok"){
        $sil=$db->prepare("DELETE from menu where menu_id=:id");
        $kontrol=$sil->execute(array(
            'id' => $_GET['menu_id']
        ));
        if($kontrol){
            header("Location:../menu.php?sil=ok");
        }
        else{
            header("Location:../menu.php?sil=no");
        }
    }

    if(isset($_POST['blogkaydet'])){
        if($_POST['blog_editor']==null){ $_POST['blog_editor']=0;}
        if($_POST['blog_trend']==null){ $_POST['blog_trend']=0;}
        $tmp_name=$_FILES['resim']['tmp_name'];
        $name=$_FILES['resim']['name'];
        $boyut=$_FILES['resim']['size'];
        $tip=$_FILES['resim']['type'];
        $uzanti=substr($name,-4,4);
        if($boyut>1024*1024*2){
            header("Location:../blog-ekle.php?size=no");
        }
        elseif($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti !='.jpg'){
            header("Location:../blog-ekle.php?uzanti=no");
        }
        else{
            if(!file_exists($name)){
                move_uploaded_file($tmp_name, '../../images/blog/' . $name); 
            }
            $category_seourl=seo($_POST["category_name"]);
            $blogkaydet=$db->prepare("INSERT INTO blog SET
              blog_photo=:blog_photo,
              blog_editor=:blog_editor,
              blog_trend=:blog_trend,
              blog_title=:blog_title,
              blog_content=:blog_content,
              blog_description=:blog_description,
              blog_author=:blog_author,
              blog_keywords=:blog_keywords,
              category_name=:category_name,
              category_seourl=:category_seourl,
              blog_status=:blog_status
              ");
    
            $insert=$blogkaydet->execute(
                array(
                    'blog_photo'=> $name,
                    'blog_editor'=> $_POST['blog_editor'],
                    'blog_title'=> $_POST['blog_title'],
                    'blog_content' => $_POST['blog_content'],
                    'blog_description' => $_POST['blog_description'],
                    'blog_trend' => $_POST['blog_trend'],
                    'blog_author' => $_POST['blog_author'],
                    'blog_keywords' => $_POST['blog_keywords'],
                    'category_name' => $_POST['category_name'],
                    'category_seourl' => $category_seourl,
                    'blog_status' => $_POST['blog_status']
                )
            );
    
            if($insert){
                header("Location:../blog-ekle.php?blog_id=$blog_id&durum=ok");
            }
            else{
                header("Location:../blog-ekle.php?blog_id=$blog_id&durum=no");
            }
        }
    }


    if(isset($_POST['blogduzenle'])){
        if($_POST['blog_editor']==null){ $_POST['blog_editor']=0;}
        if($_POST['blog_trend']==null){ $_POST['blog_trend']=0;}
        $blog_id=$_POST['blog_id'];
        $category_seourl=seo($_POST["category_name"]);
        if($_FILES['resim']['name']!=null){
            $tmp_name=$_FILES['resim']['tmp_name'];
            $name=$_FILES['resim']['name'];
            $boyut=$_FILES['resim']['size'];
            $tip=$_FILES['resim']['type'];
            $uzanti=substr($name,-4,4);
            if($boyut>1024*1024*2){
               header("Location:../blog-duzenle.php?blog_id=$blog_id&size=no");
            }
            elseif($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti !='.jpg'){
                header("Location:../blog-duzenle.php?blog_id=$blog_id&uzanti=no");
            }
            else{
                if(!file_exists($name)){
                    move_uploaded_file($tmp_name, '../../images/blog/' . $name); 
                }
                $ayarkaydet=$db->prepare("UPDATE blog SET
                blog_photo=:blog_photo,
                blog_title=:blog_title,
                blog_content=:blog_content,
                blog_description=:blog_description,
                blog_editor=:blog_editor,
                blog_trend=:blog_trend,
                blog_author=:blog_author,
                blog_keywords=:blog_keywords,
                category_name=:category_name,
                category_seourl=:category_seourl,
                blog_status=:blog_status
                WHERE blog_id={$_POST['blog_id']}"
                );

                $update=$ayarkaydet->execute(
                    array(
                        'blog_photo'=> $name,
                        'blog_title'=> $_POST['blog_title'],
                        'blog_content' => $_POST['blog_content'],
                        'blog_description' => $_POST['blog_description'],
                        'blog_editor'=> $_POST['blog_editor'],
                        'blog_trend' => $_POST['blog_trend'],                    
                        'blog_author' => $_POST['blog_author'],
                        'blog_keywords' => $_POST['blog_keywords'],
                        'category_name' => $_POST['category_name'],
                        'category_seourl' => $category_seourl,
                        'blog_status' => $_POST['blog_status'],
                    )
                );

                if($update){
                    header("Location:../blog-duzenle.php?blog_id=$blog_id&durum=ok");
                }
                else{
                    header("Location:../blog-duzenle.php?blog_id=$blog_id&durum=no");
                }
            }
        }
        else{
            $ayarkaydet=$db->prepare("UPDATE blog SET
            blog_title=:blog_title,
            blog_content=:blog_content,
            blog_description=:blog_description,
            blog_editor=:blog_editor,
            blog_trend=:blog_trend,
            blog_author=:blog_author,
            blog_keywords=:blog_keywords,
            category_name=:category_name,
            category_seourl=:category_seourl,
            blog_status=:blog_status
            WHERE blog_id={$_POST['blog_id']}"
            );

            $update=$ayarkaydet->execute(
                array(
                    'blog_title'=> $_POST['blog_title'],
                    'blog_content' => $_POST['blog_content'],
                    'blog_description' => $_POST['blog_description'],
                    'blog_editor'=> $_POST['blog_editor'],
                    'blog_trend' => $_POST['blog_trend'],                    
                    'blog_author' => $_POST['blog_author'],
                    'blog_keywords' => $_POST['blog_keywords'],
                    'category_name' => $_POST['category_name'],
                    'category_seourl' => $category_seourl,
                    'blog_status' => $_POST['blog_status'],
                )
            );

            if($update){
                header("Location:../blog-duzenle.php?blog_id=$blog_id&durum=ok");
            }
            else{
                header("Location:../blog-duzenle.php?blog_id=$blog_id&durum=no");
            }   
        }
        
    }

    if($_GET['blogsil'] == "ok"){
        $sil=$db->prepare("DELETE from blog where blog_id=:id");
        $kontrol=$sil->execute(array(
            'id' => $_GET['blog_id']
        ));
        if($kontrol){
            header("Location:../blog.php?sil=ok");
        }
        else{
            header("Location:../blog.php?sil=no");
        }
    }
    
    if(isset($_POST['kategoriekle'])){
        $kategori_seourl=seo($_POST["kategori_ad"]);
        $ayarkaydet=$db->prepare("INSERT INTO kategori SET
          kategori_ad=:kategori_ad,
          kategori_sira=:kategori_sira,
          kategori_ust=:kategori_ust,
          kategori_seourl=:kategori_seourl,
          kategori_durum=:kategori_durum"
        );

        $insert=$ayarkaydet->execute(
            array(
                'kategori_ad'=> $_POST['kategori_ad'],
                'kategori_sira' => $_POST['kategori_sira'],
                'kategori_ust' => $_POST['kategori_ust'],
                'kategori_seourl' =>$kategori_seourl,
                'kategori_durum' => $_POST['kategori_durum']
            )
        );

        if($insert){
            header("Location:../kategori.php?durum=ok");
        }
        else{
            header("Location:../kategori.php?durum=no");
        }
    }



    if(isset($_POST['kategoriduzenle'])){
        $kategori_id=$_POST['kategori_id'];
        $ayarkaydet=$db->prepare("UPDATE kategori SET
          kategori_ad=:kategori_ad,
          kategori_sira=:kategori_sira,
          kategori_ust=:kategori_ust,
          kategori_durum=:kategori_durum
          WHERE kategori_id={$_POST['kategori_id']}"
        );

        $update=$ayarkaydet->execute(
            array(
                'kategori_ad'=> $_POST['kategori_ad'],
                'kategori_sira' => $_POST['kategori_sira'],
                'kategori_ust' => $_POST['kategori_ust'],
                'kategori_durum' => $_POST['kategori_durum']
            )
        );

        if($update){
            header("Location:../kategori-duzenle.php?kategori_id=$kategori_id&durum=ok");
        }
        else{
            header("Location:../kategori-duzenle.php?kategori_id=$kategori_id&durum=no");
        }
    }

    if($_GET['kategorisil'] == "ok"){
        $sil=$db->prepare("DELETE from kategori where kategori_id=:id");
        $kontrol=$sil->execute(array(
            'id' => $_GET['kategori_id']
        ));
        if($kontrol){
            header("Location:../kategori.php?sil=ok");
        }
        else{
            header("Location:../kategori.php?sil=no");
        }
    }

    if($_GET['kullanicisil'] == "ok"){
        $sil=$db->prepare("DELETE from kullanici where kullanici_id=:id");
        $kontrol=$sil->execute(array(
            'id' => $_GET['kullanici_id']
        ));
        if($kontrol){
            header("Location:../kullanici.php?sil=ok");
        }
        else{
            header("Location:../kullanici.php?sil=no");
        }
    }
    //Tablo Güncelleme İşlemi Kodları
    if(isset($_POST['genelayarkaydet'])){
        $ayarkaydet=$db->prepare('UPDATE ayar SET
        ayar_title=:ayar_title,
        ayar_description=:ayar_description,
        ayar_keywords=:ayar_keywords,
        ayar_author=:ayar_author
        WHERE ayar_id=0
        ');

        $update=$ayarkaydet->execute(array(
            'ayar_title' => $_POST['ayar_title'],
            'ayar_description' => $_POST['ayar_description'],
            'ayar_keywords' => $_POST['ayar_keywords'],
            'ayar_author' => $_POST['ayar_author']
        ));

        if($update){
            header("Location:../genel-ayar.php?durum=ok");
        }
        else{
            header("Location:../genel-ayar.php?durum=no");
        }
    }

    if(isset($_POST['iletisimayarkaydet'])){
        $ayarkaydet=$db->prepare('UPDATE ayar SET
        ayar_tel=:ayar_tel,
        ayar_mail=:ayar_mail
        WHERE ayar_id=0
        ');

        $update=$ayarkaydet->execute(array(
            'ayar_tel' => $_POST['ayar_tel'],
            'ayar_mail' => $_POST['ayar_mail']
        ));

        if($update){
            header("Location:../iletisim-ayar.php?durum=ok");
        }
        else{
            header("Location:../iletisim-ayar.php?durum=no");
        }
    }

    if(isset($_POST['sosyalayarkaydet'])){
        $ayarkaydet=$db->prepare('UPDATE ayar SET
        ayar_instagram=:ayar_instagram,
        ayar_twitter=:ayar_twitter,
        ayar_youtube=:ayar_youtube,
        ayar_facebook=:ayar_facebook
        WHERE ayar_id=0
        ');

        $update=$ayarkaydet->execute(array(
            'ayar_instagram' => $_POST['ayar_instagram'],
            'ayar_twitter' => $_POST['ayar_twitter'],
            'ayar_youtube' => $_POST['ayar_youtube'],
            'ayar_facebook' => $_POST['ayar_facebook']
        ));

        if($update){
            header("Location:../sosyal-ayar.php?durum=ok");
        }
        else{
            header("Location:../sosyal-ayar.php?durum=no");
        }
    }
    
    if(isset($_POST['hakkimizdaayarkaydet'])){
        if($_FILES['resim']['name']!=null){
            $tmp_name=$_FILES['resim']['tmp_name'];
            $name=$_FILES['resim']['name'];
            $boyut=$_FILES['resim']['size'];
            $tip=$_FILES['resim']['type'];
            $uzanti=substr($name,-4,4);
            if($boyut>1024*1024*2){
               header("Location:../hakkimizda-ayar.php?size=no");
            }
            elseif($tip != 'image/jpeg' && $tip != 'image/png' && $uzanti !='.jpg'){
                header("Location:../hakkimizda-ayar.php?uzanti=no");
            }
            else{
                if(!file_exists($name)){
                    move_uploaded_file($tmp_name, '../../images/kategori/' . $name); 
                }
                $ayarkaydet=$db->prepare('UPDATE hakkimizda SET
                hakkimizda_baslik=:hakkimizda_baslik,
                hakkimizda_icerik=:hakkimizda_icerik,
                hakkimizda_resim=:hakkimizda_resim,
                hakkimizda_vizyon=:hakkimizda_vizyon,
                hakkimizda_misyon=:hakkimizda_misyon
                WHERE hakkimizda_id=0
                ');
    
                $update=$ayarkaydet->execute(array(
                    'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
                    'hakkimizda_icerik' => $_POST['hakkimizda_icerik'],
                    'hakkimizda_resim' => $name,
                    'hakkimizda_vizyon' => $_POST['hakkimizda_vizyon'],
                    'hakkimizda_misyon' => $_POST['hakkimizda_misyon']
                ));
    
                if($update){
                    header("Location:../hakkimizda-ayar.php?durum=ok");
                }
                else{
                    header("Location:../hakkimizda-ayar.php?durum=no");
                }
            }
        }
        else{
            $ayarkaydet=$db->prepare('UPDATE hakkimizda SET
            hakkimizda_baslik=:hakkimizda_baslik,
            hakkimizda_icerik=:hakkimizda_icerik,
            hakkimizda_vizyon=:hakkimizda_vizyon,
            hakkimizda_misyon=:hakkimizda_misyon
            WHERE hakkimizda_id=0
            ');
    
            $update=$ayarkaydet->execute(array(
                'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
                'hakkimizda_icerik' => $_POST['hakkimizda_icerik'],
                'hakkimizda_vizyon' => $_POST['hakkimizda_vizyon'],
                'hakkimizda_misyon' => $_POST['hakkimizda_misyon']
            ));
    
            if($update){
                header("Location:../hakkimizda-ayar.php?durum=ok");
            }
            else{
                header("Location:../hakkimizda-ayar.php?durum=no");
            }
        }
        
    }
    
?>
