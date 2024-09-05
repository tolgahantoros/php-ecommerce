<?php 
ob_start();
session_start();
require_once 'setconfig.php';
?>
<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.php"
                    aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                    class="hide-menu">Ana Sayfa</span></a></li>
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">SİTE YÖNETİMİ</span></li>


                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="settings.php"
                        aria-expanded="false"><i  class="fas fa-cogs"></i><span
                        class="hide-menu">Ayarlar
                    </span></a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item"><a href="settings.php" class="sidebar-link"><i  class="fas fa-cog"></i><span
                           class="hide-menu">Seo - Genel</span></a>
                       </li>
                       <li class="sidebar-item"><a href="menuayar.php" class="sidebar-link"><i  class="fas fa-bars"></i><span
                           class="hide-menu">Menü Ayarları</span></a>
                       </li>
                       <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="#"
                        aria-expanded="false"><i  class="fab fa-facebook-f"></i><span
                        class="hide-menu">Footer Ayar
                    </span></a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line">
                        <li class="sidebar-item"><a href="footerurlekle.php" class="sidebar-link"><i  class="fas fa-link"></i><span
                         class="hide-menu">URL Ekle</span></a>
                     </li>
                     <li class="sidebar-item"><a href="footerbaslikekle.php" class="sidebar-link"><i  class="fas fa-plus"></i><span
                         class="hide-menu">Başlık Ekle</span></a>
                     </li>
                     <li class="sidebar-item"><a href="footer_abone.php" class="sidebar-link"><i  class="fas fa-at"></i><span
                         class="hide-menu">Bülten Ayarı</span></a>
                     </li>
                 </ul>
             </li>
             <li class="sidebar-item"> <a class="sidebar-link" href="slider.php"
                aria-expanded="false"><i  class="fas fa-sliders-h"></i><span
                class="hide-menu">Slider</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="hakkimizda.php"
                aria-expanded="false"><i  class="fas fa-pencil-alt"></i><span
                class="hide-menu">Hakkımızda</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="gizlilik-politikasi.php"
                aria-expanded="false"><i  class="fas fa-user-secret"></i><span
                class="hide-menu">Gizlilik Politikası</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="sartlar-ve-kosullar.php"
                aria-expanded="false"><i  class="fas fa-exclamation"></i><span
                class="hide-menu">Şartlar-Koşullar</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="sosyalmedya.php"
                aria-expanded="false"><i  class="fab fa-stripe-s"></i><span
                class="hide-menu">Sosyal Medya</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="header-ustu-tema.php"
                aria-expanded="false"><i  class="fas fa-paint-brush"></i><span
                class="hide-menu">Temada Header ayarı</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="sss.php"
                aria-expanded="false"><i  class="fas fa-question"></i><span
                class="hide-menu">S.S.S</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="indirim.php"
                aria-expanded="false"><i  class="fas fa-clock"></i><span
                class="hide-menu">İndirim Kartı</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="icerik_yoneticisi.php"
                aria-expanded="false"><i  class="fas fa-dolly-flatbed"></i><span
                class="hide-menu">İçerik Sayı Ayarları</span></a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="kodekleheader.php"
        aria-expanded="false"><i  class="fas fa-code"></i><span
        class="hide-menu">Kod Ekle
    </span>
</a>
<ul aria-expanded="false" class="collapse first-level base-level-line">
    <li class="sidebar-item"><a href="kodekleheader.php" class="sidebar-link"><i  class="fas fa-file-code"></i><span
     class="hide-menu">Header</span></a></li>
     <li class="sidebar-item"> <a class="sidebar-link" href="kodeklefooter.php"
        aria-expanded="false"><i  class="fas fa-file-code"></i><span
        class="hide-menu">Footer</span></a>
    </li>
</ul>
</li>
<li class="sidebar-item"> <a class="sidebar-link has-arrow" href="mailmarketing.php"
    aria-expanded="false"><i  class="fas fa-envelope"></i><span
    class="hide-menu">EMAIL MARKETING
</span></a>
<ul aria-expanded="false" class="collapse first-level base-level-line">
    <li class="sidebar-item"><a href="mailmarketing.php" class="sidebar-link"><i  class="fas fa-paper-plane"></i><span
     class="hide-menu">Mail Gönder</span></a>
 </li>
 <li class="sidebar-item"><a href="mailekle.php" class="sidebar-link"><i  class="fas fa-plus"></i><span
     class="hide-menu">Mail Ekle</span></a>
 </li>
 <li class="sidebar-item"> <a class="sidebar-link" href="mailkaraliste.php"
    aria-expanded="false"><i  class="fas fa-times"></i><span
    class="hide-menu">Karaliste</span></a></li> 
    <li class="sidebar-item"> <a class="sidebar-link" href="mail_ayar.php"
        aria-expanded="false"><i  class="fas fa-cogs"></i><span
        class="hide-menu">Site Mail Ayarları</span></a>
    </li>
</ul>
</li>
<li class="sidebar-item"> <a class="sidebar-link has-arrow" href="affiliate.php"
    aria-expanded="false"><i  class="fas fa-euro-sign"></i><span
    class="hide-menu">Affiliate
</span></a>
<ul aria-expanded="false" class="collapse first-level base-level-line">
    <li class="sidebar-item"><a href="affiliate.php" class="sidebar-link"><i  class="fas fa-code-branch"></i><span
        class="hide-menu">Ortaklıklar</span></a></li>
        <li class="sidebar-item"><a href="affiliate-istatistik.php" class="sidebar-link"><i  class="fas fa-question"></i><span
         class="hide-menu">Bilgi</span></a></li> 
     </ul>
 </li>
 <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="resimgaleri.php"
    aria-expanded="false"><i  class="fas fa-file-image"></i><span
    class="hide-menu">Galeri</span></a>
    <ul aria-expanded="false" class="collapse first-level base-level-line">
        <li class="sidebar-item"><a href="resimgaleri.php" class="sidebar-link"><i  class="fas fa-images"></i><span
         class="hide-menu">Resim Galerisi</span></a></li>
         <li class="sidebar-item"><a href="videogaleri.php" class="sidebar-link"><i  class="fas fa-video"></i><span
             class="hide-menu">Video Galerisi</span></a>
         </li>
     </ul>
 </li>

 <li class="list-divider"></li>
 <li class="nav-small-cap"><span class="hide-menu">TİCARET</span></li>
 <li class="sidebar-item"> <a class="sidebar-link" href="toplu_fiyat_islemleri.php"
    aria-expanded="false"><i class="fas fa-hand-holding-usd"></i><span
    class="hide-menu">Toplu Fiyat İşlemleri
</span></a>
</li>
<li class="sidebar-item"> <a class="sidebar-link" href="urunler.php"
    aria-expanded="false"><i class="fas fa-box-open"></i><span
    class="hide-menu">Ürünler
</span></a>
</li>
<li class="sidebar-item"> <a class="sidebar-link" href="urunturleri.php"
    aria-expanded="false"><i class="fas fa-boxes"></i><span
    class="hide-menu">Ürün Türleri
</span></a>
</li>
<li class="sidebar-item"> <a class="sidebar-link" href="urunseo.php"
    aria-expanded="false"><i class="fas fa-search-plus"></i><span
    class="hide-menu">Ürün Seo
</span></a>
</li>
<li class="sidebar-item"> <a class="sidebar-link" href="kategoriler.php"
    aria-expanded="false"><i class="fas fa-th-list"></i><span
    class="hide-menu">Kategoriler
</span></a>
</li>
<li class="sidebar-item"> <a class="sidebar-link" href="kupon-kodlari.php"
    aria-expanded="false"><i class="fab fa-creative-commons"></i><span
    class="hide-menu">Kupon Kodları
</span></a>
</li>
<li class="sidebar-item"> <a class="sidebar-link" href="bankahesaplari.php"
    aria-expanded="false"><i class="fas fa-credit-card"></i><span
    class="hide-menu">Banka Hesapları
</span></a>
</li>
<li class="sidebar-item"> <a class="sidebar-link has-arrow" href="siparisler.php"
    aria-expanded="false"><i  class="fas fa-shopping-cart"></i><span
    class="hide-menu">Siparişler
</span></a>
<ul aria-expanded="false" class="collapse first-level base-level-line">
    <li class="sidebar-item"><a href="siparisler.php" class="sidebar-link"><i  class="fas fa-clipboard-list"></i><span
        class="hide-menu">Siparişler</span></a></li>
        <li class="sidebar-item"><a href="siparisler-onaylanan.php" class="sidebar-link"><i  class="fas fa-clipboard-check"></i><span
            class="hide-menu">Onaylananlar</span></a></li> 
            <li class="sidebar-item"><a href="siparisler-iade.php" class="sidebar-link"><i  class="fas fa-calendar-times"></i><span
                class="hide-menu">İadeler</span></a></li> 
            </ul>
        </li>

    </span></a>

    <li class="sidebar-item"> <a class="sidebar-link" href="sepetler.php"
        aria-expanded="false"><i class="fas fa-shopping-basket"></i><span
        class="hide-menu">Müşteri Sepetleri
    </span></a>
</li>

<li class="list-divider"></li>
<li class="nav-small-cap"><span class="hide-menu">HESAPLAR</span></li>
<li class="sidebar-item"> <a class="sidebar-link" href="admins.php"
    aria-expanded="false"><i  class="fas fa-user-md"></i><span
    class="hide-menu">Yöneticiler
</span></a>
<li class="sidebar-item"> <a class="sidebar-link" href="users.php"
    aria-expanded="false"><i class="fas fa-users"></i><span
    class="hide-menu">Kullanıcılar
</span></a>

<li class="list-divider"></li>
<li class="nav-small-cap"><span class="hide-menu">YAZI - İÇERİK İŞLERİ</span></li>
<li class="sidebar-item"> <a class="sidebar-link" href="blogs.php"
    aria-expanded="false"><i  class="fas fa-pencil-alt"></i><span
    class="hide-menu">Bloglar - Haberler
</span></a> 
<li class="sidebar-item"> <a class="sidebar-link has-arrow" href="urun-yorumlari.php"
    aria-expanded="false"><i  class="fas fa-comments"></i><span
    class="hide-menu">Yorumlar
</span></a>
<ul aria-expanded="false" class="collapse first-level base-level-line">
    <li class="sidebar-item"><a href="urun-yorumlari.php" class="sidebar-link"><i  class="fas fa-comment"></i><span
        class="hide-menu">Ürün Yorumları</span></a></li>
        <li class="sidebar-item"><a href="blog-yorumlari.php" class="sidebar-link"><i  class="fas fa-comment"></i><span
         class="hide-menu">Blog Yorumları</span></a></li> 
     </ul>
 </li>



 <li class="nav-small-cap"><span class="hide-menu">MESAJLAR - ABONELER</span></li>
 <li class="sidebar-item"> <a class="sidebar-link" href="mesajlar.php"
    aria-expanded="false"><i  class="fas fa-comment-alt"></i><span
    class="hide-menu">Mesajlar
</span></a>
<li class="sidebar-item"> <a class="sidebar-link" href="aboneler.php"
    aria-expanded="false"><i  class="fas fa-at"></i><span
    class="hide-menu">Aboneler
</span></a>

<br><br> 
</ul>
</nav>
</div>
</aside>