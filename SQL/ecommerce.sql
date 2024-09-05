-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 25 Ağu 2024, 20:34:32
-- Sunucu sürümü: 10.3.39-MariaDB
-- PHP Sürümü: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sonseshaber_tolga`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `aboneler`
--

CREATE TABLE `aboneler` (
  `abone_id` int(50) NOT NULL,
  `abone_mail` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `abone_ip` varchar(250) NOT NULL,
  `abone_tarih` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `aboneler`
--

INSERT INTO `aboneler` (`abone_id`, `abone_mail`, `abone_ip`, `abone_tarih`) VALUES
(32, '', '188.57.140.40', '2024-01-10 12:57:20');

--
-- Tetikleyiciler `aboneler`
--
DELIMITER $$
CREATE TRIGGER `mailmarketing` AFTER INSERT ON `aboneler` FOR EACH ROW BEGIN
	INSERT INTO mailmarketing SET mail = NEW.abone_mail;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `admins_id` int(11) NOT NULL,
  `admins_namesurname` varchar(50) NOT NULL,
  `admins_file` varchar(50) NOT NULL,
  `admins_username` varchar(50) NOT NULL,
  `admins_pass` varchar(50) NOT NULL,
  `admins_status` enum('0','1') NOT NULL,
  `admins_createDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`admins_id`, `admins_namesurname`, `admins_file`, `admins_username`, `admins_pass`, `admins_status`, `admins_createDate`) VALUES
(21, 'Tolgahan Toros', 'banner-05-5fce8e888d6ad.jpg', 'tolgahantoros', 'c4ca4238a0b923820dcc509a6f75849b', '1', '2020-10-10 01:58:09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `affiliate`
--

CREATE TABLE `affiliate` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(250) NOT NULL,
  `oran` int(11) NOT NULL,
  `bakiye` int(11) NOT NULL,
  `referans` int(11) NOT NULL,
  `ziyaret` int(11) NOT NULL,
  `durum` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anasayfa_banner`
--

CREATE TABLE `anasayfa_banner` (
  `id` int(11) NOT NULL,
  `baslik` varchar(250) NOT NULL,
  `aciklama` varchar(250) NOT NULL,
  `buton` varchar(250) NOT NULL,
  `url` varchar(500) NOT NULL DEFAULT '#',
  `banner_file` varchar(550) NOT NULL,
  `durum` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `anasayfa_banner`
--

INSERT INTO `anasayfa_banner` (`id`, `baslik`, `aciklama`, `buton`, `url`, `banner_file`, `durum`) VALUES
(2, 'Kadın', 'En yeni kadın modelleri 2024', 'ürünleri incele', 'http://tolgahantoros.com.tr/kadin', 'banner-01-5fce7d2215c58.jpg', '1'),
(3, 'Erkek', '2024 Erkek modelleri', 'İNCELE', 'http://tolgahantoros.com.tr/erkek', 'banner-05-5fcea434e1950.jpg', '1'),
(4, 'Aksesuarlar', 'En yeni aksesuarlar', 'HEMEN SATIN AL', 'http://tolgahantoros.com.tr/ayakkabi', 'banner-03-5fce9f192f20a.jpg', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banka`
--

CREATE TABLE `banka` (
  `banka_id` int(11) NOT NULL,
  `banka_ad` varchar(50) NOT NULL,
  `banka_iban` varchar(50) NOT NULL,
  `banka_hesapadsoyad` varchar(50) NOT NULL,
  `banka_durum` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `banka`
--

INSERT INTO `banka` (`banka_id`, `banka_ad`, `banka_iban`, `banka_hesapadsoyad`, `banka_durum`) VALUES
(7, 'torosbank', 'TR123456789', 'Tolgahan Toros', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogs`
--

CREATE TABLE `blogs` (
  `blogs_id` int(11) NOT NULL,
  `blogs_title` varchar(120) NOT NULL,
  `blogs_keywords` varchar(140) NOT NULL,
  `blogs_description` varchar(255) NOT NULL,
  `blogs_makale` text NOT NULL,
  `blogs_file` varchar(250) NOT NULL,
  `blogs_must` int(2) NOT NULL,
  `blogs_seourl` varchar(250) NOT NULL,
  `blogs_yazar` varchar(100) NOT NULL,
  `blogs_kategori` varchar(50) NOT NULL,
  `blogs_etiket` varchar(250) NOT NULL,
  `blogs_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `blogs_onecikar` enum('0','1') NOT NULL,
  `blogs_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `blogs`
--

INSERT INTO `blogs` (`blogs_id`, `blogs_title`, `blogs_keywords`, `blogs_description`, `blogs_makale`, `blogs_file`, `blogs_must`, `blogs_seourl`, `blogs_yazar`, `blogs_kategori`, `blogs_etiket`, `blogs_tarih`, `blogs_onecikar`, `blogs_status`) VALUES
(46, 'test blog', 'test valla', '250 Harfi geçmesin.', '&lt;p&gt;Bir gün Temel ile Dursun balık tutmaya gitmişler. Göl kenarına vardıklarında, Temel&amp;#39;in elinde sadece bir oltası varmış, Dursun ise tüm malzemeleriyle gelmiş.&lt;/p&gt;\r\n\r\n&lt;p&gt;Dursun: &amp;quot;Temel, neden sadece bir oltan var? Balıkları nasıl tutacaksın?&amp;quot; demiş.&lt;/p&gt;\r\n\r\n&lt;p&gt;Temel gülerek cevap vermiş: &amp;quot;Dursun, benim için önemli olan oltadan ziyade, balıkların yaklaşmasını sağlayacak mükemmel fıkralar anlatmak. Sonra balıklar gülerken onları yakalarım!&amp;quot;&lt;/p&gt;\r\n', 'trollface-non-free-659c4a58679cf.png', 0, 'test-blog', 'mahmut tuncer', 'fıkra', 'blog işte', '2024-01-08 22:15:36', '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_yorum`
--

CREATE TABLE `blog_yorum` (
  `id` int(11) NOT NULL,
  `yorum` text NOT NULL,
  `ad` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `blogs_id` int(11) NOT NULL,
  `yorum_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_adresi` varchar(50) NOT NULL,
  `users_id` int(11) NOT NULL,
  `durum` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `footer_baslik` varchar(250) NOT NULL,
  `footer_ad` varchar(250) NOT NULL,
  `footer_url` varchar(500) NOT NULL DEFAULT '#',
  `footer_durum` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `footer`
--

INSERT INTO `footer` (`id`, `footer_baslik`, `footer_ad`, `footer_url`, `footer_durum`) VALUES
(13, 'İletişim', 'İletişim sayfamızdaki bilgilerden 7/24 bize ulaşabilirsiniz. MEÜCENG Yazılım her zaman size en iyi hizmeti vermeyi hedefler!', '/', '1'),
(14, 'Hakkımızda', 'Biz kimiz?', 'hakkimizda', '1'),
(15, 'Hakkımızda', 'Kariyer', 'kariyer', '1'),
(16, 'Hakkımızda', 'Bize Ulaş', '/iletisim', '1'),
(17, 'Kampanyalar', 'İndirimli Kadın Ürünleri', '/kadin-ve-indirim', '1'),
(18, 'Kampanyalar', 'İndirimli Erkek Ürünleri', '/erkek-ve-indirim', '1'),
(19, 'Kampanyalar', 'Tüm İndirimli Ürünler', '/indirim', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `footerbaslik`
--

CREATE TABLE `footerbaslik` (
  `id` int(11) NOT NULL,
  `footer_baslik` varchar(250) NOT NULL,
  `footer_durum` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `footerbaslik`
--

INSERT INTO `footerbaslik` (`id`, `footer_baslik`, `footer_durum`) VALUES
(1, 'Hakkımızda', '1'),
(2, 'Kampanyalar', '1'),
(3, 'İLETİŞİM', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `footer_abone`
--

CREATE TABLE `footer_abone` (
  `id` int(11) NOT NULL,
  `baslik` varchar(250) NOT NULL,
  `icerik` varchar(250) NOT NULL,
  `buton` varchar(250) NOT NULL,
  `durum` enum('0','1','','') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `footer_abone`
--

INSERT INTO `footer_abone` (`id`, `baslik`, `icerik`, `buton`, `durum`) VALUES
(1, 'ABONE BÜLTENİ', 'İndirimleri kaçırmayın!', 'ABONE OL!', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `id` int(11) NOT NULL,
  `icerik` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hakkimizda`
--

INSERT INTO `hakkimizda` (`id`, `icerik`) VALUES
(1, '<p>Yıllardır Google&#39;da arattığınız haber ve soruların cevapları i&ccedil;in tıkladığınız zaman uğradığınız hayal kırıklığı ve vakit kaybını ortadan kaldırmak isteyen kişileriz.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Hedefimiz</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>İlk hedefimiz sitemize istikrarlı bir bi&ccedil;imde yılmadan ve s&uuml;rekli olarak doğru ve g&uuml;venilir i&ccedil;erik girişi yapmak.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Vizyonumuz</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Boş i&ccedil;eriklerle kullanıcıların vaktini &ccedil;alan ve zihnini bulandıran siteleri geride bırakmak.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Misyonumuz</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tek amacı para kazanmak olan ve bunun uğruna kullanıcıların zamanını &ccedil;alan siteleri yola getirmek.</p>\r\n'),
(2, '<p><strong>A. Giriş</strong></p>\r\n\r\n<ol>\r\n	<li>İnternet sitesi ziyaret&ccedil;ilerimizin gizliliği bizim i&ccedil;in &ccedil;ok &ouml;nemlidir ve kendimizi onu korumaya adadık. Bu ilke, kişisel bilgileriniz ile ne yapacağımızı a&ccedil;ıklar.</li>\r\n	<li>Sitemizi ilk ziyaretinizde bu ilke kapsamında &ccedil;erezleri kullanmamıza izin vermeniz, internet sitemizi her ziyaret ettiğinizde &ccedil;erezlerin kullanılmasına izin verir.</li>\r\n</ol>\r\n\r\n<p><strong>B. Kaynak</strong></p>\r\n\r\n<p><br />\r\nBu dok&uuml;man Altın Gramı Y&ouml;netimi tarafından oluşturulmuştur.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>C. Kişisel bilgilerin toplanması</strong></p>\r\n\r\n<p>Aşağıdaki t&uuml;rden kişisel bilgiler toplanabilir, saklanabilir ve kullanılabilir:</p>\r\n\r\n<ol>\r\n	<li>IP adresi, coğrafi konum, tarayıcı t&uuml;r&uuml; ve versiyonu ile işletim sistemi dahil bilgisayarınız hakkında bilgiler;</li>\r\n	<li>referans kaynak, ziyaret s&uuml;resi, sayfa g&ouml;r&uuml;nt&uuml;lemeleri ve sitede gezinme yolları dahil siteyi ziyaretiniz ve kullanımınız ile ilgili bilgiler;</li>\r\n	<li>sitemize kayıt olmak i&ccedil;in verdiğiniz e-posta adresiniz gibi bilgiler;</li>\r\n	<li>&ouml;rneğin adınız, profil resminiz, cinsiyetiniz, doğum g&uuml;n&uuml;n&uuml;z, ilişki durumunuz, ilgi alanlarınız ve hobileriniz, eğitim ve &ccedil;alışma durumunuz gibi, sitemizde profil oluştururken verdiğiniz bilgiler;</li>\r\n	<li>e-postalarımız ve/veya b&uuml;ltenlerimize abone olurken verdiğiniz ad ve e-posta adresi gibi bilgiler;</li>\r\n	<li>sitemizdeki hizmetleri kullanırken girdiğiniz bilgiler;</li>\r\n	<li>ne zaman, ne sıklıkta ve hangi koşullarda kullandığınız dahil, sitemizi kullanırken oluşturulan bilgiler;</li>\r\n	<li>adınız, adresiniz, telefon numaranız, e-posta adresiniz ve kredi kartı bilgileriniz dahil, sitemiz &uuml;zerinden satın aldığınız herhangi bir şey, kullandığınız bir hizmet veya ger&ccedil;ekleştirdiğiniz bir aktarım ile ilgili bilgiler;</li>\r\n	<li>kullanıcı adınız, profil resminiz ve g&ouml;nderinizin i&ccedil;eriği dahil, sitemizi kullanarak internette paylaşmak amacıyla sitemize g&ouml;nderdiğiniz bilgiler;</li>\r\n	<li>iletişim i&ccedil;erikleri ve &uuml;st veriler dahil, sitemiz veya e-posta yoluyla g&ouml;nderdiğiniz her t&uuml;rl&uuml; iletişim i&ccedil;erikleri;</li>\r\n	<li>bize g&ouml;nderdiğiniz diğer t&uuml;m kişisel bilgiler.</li>\r\n</ol>\r\n\r\n<p>Bize başka bir kişinin kişisel bilgilerini iletmeden &ouml;nce, o kişinin bilgilerin paylaşılacağına ve bu ilkeye uygun olarak işleneceğine dair onayını almanız gerekir.</p>\r\n\r\n<p><strong>D. Kişisel bilgilerinizin kullanılması</strong></p>\r\n\r\n<p>Sitemiz &uuml;zerinden bize g&ouml;nderilen kişisel bilgiler bu ilkede veya sitenin ilgili sayfalarında belirtilen ama&ccedil;lar i&ccedil;in kullanılacaktır. Kişisel bilgilerinizi şu ama&ccedil;lar i&ccedil;in kullanabiliriz:</p>\r\n\r\n<ol>\r\n	<li>sitemizi ve işletmemizi y&ouml;netmek;</li>\r\n	<li>sitemizi sizin i&ccedil;in kişiselleştirmek;</li>\r\n	<li>sitemizdeki hizmetleri kullanmanızı sağlamak;</li>\r\n	<li>sitemizden satın aldığınız &uuml;r&uuml;nleri size g&ouml;ndermek;</li>\r\n	<li>sitemizden satın alınan hizmetleri temin etmek;</li>\r\n	<li>size bildirim, fatura ve &ouml;deme hatırlatıcıları g&ouml;ndermek ve sizden &ouml;deme almak;</li>\r\n	<li>sizinle pazarlama harici ticari iletişim kurmak;</li>\r\n	<li>size &ouml;zellikle talep ettiğiniz e-posta bildirimlerini g&ouml;ndermek;</li>\r\n	<li>talep ettiyseniz size e-posta b&uuml;ltenimizi g&ouml;ndermek (b&uuml;lteni istemiyorsanız bize her an bildirebilirsiniz);</li>\r\n	<li>size işletmemiz veya &ouml;zenle se&ccedil;ilmiş &uuml;&ccedil;&uuml;nc&uuml; taraf işletmeler tarafından, işinize yarayacağını d&uuml;ş&uuml;nd&uuml;ğ&uuml;m&uuml;z pazarlama i&ccedil;eriklerini &ouml;zellikle kabul ettiğiniz takdirde posta, e-posta veya benzer teknolojilerle g&ouml;ndermek (pazarlama i&ccedil;eriklerini istemiyorsanız bize her an bildirebilirsiniz);</li>\r\n	<li>&uuml;&ccedil;&uuml;nc&uuml; taraflara kullanıcılarımız hakkında istatistiksel bilgiler sunmak (ancak bu &uuml;&ccedil;&uuml;nc&uuml; taraflar bu bilgileri kullanarak hi&ccedil;bir kullanıcının kimliğini belirleyemezler);</li>\r\n	<li>sitemizle ilgili sizin tarafınızdan veya sizinle ilgili yapılan şikayetleri ve talepleri &ccedil;&ouml;zmek;</li>\r\n	<li>sitemizi g&uuml;venli tutmak ve dolandırıcılığı &ouml;nlemek;</li>\r\n	<li>internet sitemizin, ilgili şartlar ve koşullara uygun olarak kullanıldığını doğrulamak (sitemizdeki &ouml;zel mesaj hizmeti ile g&ouml;nderilen mesajları izlemek dahil) ve</li>\r\n	<li>diğer ama&ccedil;lar i&ccedil;in.</li>\r\n</ol>\r\n\r\n<p>Sitemizde yayınlanması i&ccedil;in kişisel bilgiler g&ouml;nderirseniz, bu bilgileri yayınlarız veya bize sunduğunuz lisans kapsamında kullanabiliriz.</p>\r\n\r\n<p>Gizlilik ayarlarınız sitemizde bilgilerinizin yayınlanmasını sınırlandırabilir ve sitedeki gizlilik kontrolleri &uuml;zerinden değiştirilebilir.</p>\r\n\r\n<p>A&ccedil;ık&ccedil;a izin vermediğiniz s&uuml;rece kişisel bilgilerinizi hi&ccedil;bir &uuml;&ccedil;&uuml;nc&uuml; tarafa veya diğer &uuml;&ccedil;&uuml;nc&uuml; tarafların doğrudan pazarlama b&ouml;l&uuml;mlerine iletmeyeceğiz.</p>\r\n\r\n<p><strong>E. Kişisel bilgilerin paylaşılması</strong></p>\r\n\r\n<p>Kişisel bilgilerinizi &ccedil;alışanlarımıza, g&ouml;revlilerimize, sigortacılarımıza, profesyonel danışmanlarımıza, ajanslarımıza, tedarik&ccedil;ilerimize veya taşeronlarımıza, bu ilkede belirtilen ama&ccedil;lar gerektirdiği s&uuml;rece iletebiliriz.</p>\r\n\r\n<p>Kişisel bilgilerinizi şirketler grubumuzun t&uuml;m &uuml;yelerine (iştiraklerimiz, &uuml;st holding şirketimiz ve onun iştirakleri anlamına gelir), bu ilkede belirtilen ama&ccedil;lar gerektirdiği s&uuml;rece iletebiliriz.</p>\r\n\r\n<p>Kişisel bilgilerinizi şu durumlarda paylaşabiliriz:</p>\r\n\r\n<ol>\r\n	<li>yasal olarak gerektiği durumlarda;</li>\r\n	<li>devam eden veya olası yasal s&uuml;re&ccedil;lerle ilgili olarak;</li>\r\n	<li>kendi yasal haklarımızı korumak, uygulamak ve savunmak i&ccedil;in (dolandırıcılığı &ouml;nleme ve kredi riskini azaltmak amacıyla bilgileri diğerlerine iletmek dahil);</li>\r\n	<li>sattığımız (veya satmayı d&uuml;ş&uuml;nd&uuml;ğ&uuml;m&uuml;z) t&uuml;m işletme ve varlıkların alıcılarına (veya potansiyel alıcılarına) ve</li>\r\n	<li>kişisel bilgilerin a&ccedil;ıklanması i&ccedil;in mahkemeye başvurabileceğine inandığımız bir kişiye, başvurması halinde mahkemenin veya yetkili kişi ve kurumların kişisel bilgilerin a&ccedil;ıklanması y&ouml;n&uuml;nde karar vereceğine dair makul g&ouml;r&uuml;şlerimiz olması halinde.</li>\r\n</ol>\r\n\r\n<p>Bu ilkede belirtilen durumlar haricinde, kişisel bilgilerinizi &uuml;&ccedil;&uuml;nc&uuml; taraflarla paylaşmayız.</p>\r\n\r\n<p><strong>F. Uluslararası veri transferleri</strong></p>\r\n\r\n<ol>\r\n	<li>Topladığımız bilgiler, bu ilkede belirtilen ama&ccedil;lar doğrultusunda kullanılmak &uuml;zere faaliyet g&ouml;sterdiğimiz &uuml;lkeler arasında aktarılabilir, bu &uuml;lkelerde saklanabilir ve işlenebilir.</li>\r\n	<li>Topladığımız bilgiler, Avrupa Ekonomik B&ouml;lgesi&rsquo;ndekine denk veri koruma yasaları olmayan şu &uuml;lkelere aktarılabilir: Amerika Birleşik Devletleri, Rusya, Japonya, &Ccedil;in ve Hindistan.</li>\r\n	<li>İnternet sitemizde paylaştığınız veya paylaşılması i&ccedil;in g&ouml;nderdiğiniz bilgilere internet sitemiz &uuml;zerinden t&uuml;m d&uuml;nyadan erişilebilir. Bu bilgilerin diğerleri tarafından istismar edilmesini &ouml;nleyemeyiz.</li>\r\n	<li>B&ouml;l&uuml;m F&rsquo;de belirtilen kişisel bilgilerin aktarılmasını a&ccedil;ık&ccedil;a kabul etmiş sayılırsınız.</li>\r\n</ol>\r\n\r\n<p><strong>G. Kişisel bilgilerin saklanması</strong></p>\r\n\r\n<ol>\r\n	<li>B&ouml;l&uuml;m G, kişisel bilgilerin saklanması ve silinmesi ile ilgili yasal y&uuml;k&uuml;ml&uuml;l&uuml;klerimizi yerine getirdiğimizden emin olmak i&ccedil;in tasarlanan veri saklama ilkeleri ve prosed&uuml;rlerini belirtir.</li>\r\n	<li>İşlediğimiz kişisel bilgiler, belirtilen ama&ccedil; veya ama&ccedil;ların gerektirdiğinden daha uzun s&uuml;re saklanamaz.</li>\r\n	<li>Madde G-2&rsquo;yi etkilememek &uuml;zere, aşağıda belirtilen kategorilere dahil olan verileri kişisel bilgileri genellikle aşağıda belirtilen tarih/saatte sileriz:\r\n	<ol>\r\n		<li>kişisel veri t&uuml;r&uuml; {TARİH/SAAT GİRİN} tarihinde ve</li>\r\n		<li>{EK TARİH/SAAT GİRİN} silinecektir.</li>\r\n	</ol>\r\n	</li>\r\n	<li>B&ouml;l&uuml;m G&rsquo;deki diğer h&uuml;k&uuml;mlere bağlı olmaksızın kişisel veri i&ccedil;eren dok&uuml;manları (elektronik dok&uuml;manlar dahil) saklarız:\r\n	<ol>\r\n		<li>yasal olarak gerektiği durumlarda;</li>\r\n		<li>dok&uuml;manların s&uuml;ren veya olası yasal s&uuml;re&ccedil;lerle ilgili olduğunu d&uuml;ş&uuml;nd&uuml;ğ&uuml;m&uuml;z hallerde ve</li>\r\n		<li>kendi yasal haklarımızı korumak, uygulamak ve savunmak i&ccedil;in (dolandırıcılığı &ouml;nleme ve kredi riskini azaltmak amacıyla bilgileri diğerlerine iletmek dahil).</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p><strong>H. Kişisel bilgilerinizin g&uuml;venliği</strong></p>\r\n\r\n<ol>\r\n	<li>Kişisel verilerinizin kaybolması, istismar edilmesi veya değiştirilmesini &ouml;nlemek i&ccedil;in makul teknik ve organizasyonel &ouml;nlemler alırız.</li>\r\n	<li>T&uuml;m kişisel bilgilerinizi g&uuml;venli (şifre ve g&uuml;venlik duvarı korumalı) sunucularda saklarız.</li>\r\n	<li>Sitemiz &uuml;zerinden ger&ccedil;ekleştirilen t&uuml;m finansal aktarımlar şifreleme teknolojisi ile korunmaktadır.</li>\r\n	<li>İnternet &uuml;zerinden veri aktarımının internetin doğası gereği g&uuml;venli olmadığını ve internet &uuml;zerinden g&ouml;nderilen verilerin g&uuml;venliğini garanti edemeyeceğimizi kabul etmiş sayılırsınız.</li>\r\n	<li>Sitemize erişmek i&ccedil;in kullandığınız şifreyi gizli tutmak sizin sorumluluğunuzdadır, sizden şifrenizi vermenizi istemeyiz (sitemize giriş yapmanız haricinde).</li>\r\n</ol>\r\n\r\n<p><strong>I. Değişiklikler</strong></p>\r\n\r\n<p>Bu ilkeyi zaman zaman değiştirerek yeni versiyonu internet sitemizde yayımlayabiliriz. Bu ilkedeki olası değişiklikleri anladığınızdan emin olmak i&ccedil;in bu sayfayı zaman zaman kontrol etmelisiniz. Bu ilkedeki değişiklikleri size e-posta veya sitemizdeki &ouml;zel mesajlaşma sistemi yoluyla bildirebiliriz.</p>\r\n\r\n<p><strong>J. Haklarınız</strong></p>\r\n\r\n<p>Sizin hakkınızda sakladığımız bilgileri size iletmemizi talep edebilirsiniz; bu bilgileri temin etmek i&ccedil;in aşağıdakiler gereklidir:</p>\r\n\r\n<ol>\r\n	<li>&uuml;cret &ouml;denmesi {GEREKLİYSE &Uuml;CRET GİRİN} ve</li>\r\n	<li>kimliğinizi kanıtlayan belgeler sunmanız ({İLKENİZİ YANSITAN METNİ GİRİN bu ama&ccedil;la genellikle pasaportunuzun noter onaylı bir kopyasını ve mevcut adresinizi g&ouml;steren bir faturayı kabul ederiz}).</li>\r\n</ol>\r\n\r\n<p>Talep ettiğiniz bilgileri yasaların izin verdiği &ouml;l&ccedil;&uuml;de saklayabiliriz.</p>\r\n\r\n<p>Bize, herhangi bir anda kişisel bilgilerinizi pazarlama ama&ccedil;ları ile kullanmamamız talimatını verebilirsiniz.</p>\r\n\r\n<p>Pratikte, kişisel bilgilerinizi pazarlama ama&ccedil;ları ile kullanmamızı &ouml;nceden a&ccedil;ık&ccedil;a kabul etmiş olursunuz ya da biz size kişisel bilgilerinizi pazarlama ama&ccedil;larıyla kullanılmamasını tercih etme se&ccedil;eneği sunarız.</p>\r\n\r\n<p><strong>K. &Uuml;&ccedil;&uuml;nc&uuml; taraf internet siteleri</strong></p>\r\n\r\n<p>Sitemizde &uuml;&ccedil;&uuml;nc&uuml; taraf sitelere bağlantılar ve detaylar bulunur. &Uuml;&ccedil;&uuml;nc&uuml; tarafların gizlilik ilkeleri ve uygulamaları &uuml;zerinde herhangi bir kontrol yetkimiz yoktur ve bunlardan sorumlu tutulamayız.</p>\r\n\r\n<p><strong>L. Bilgilerin g&uuml;ncellenmesi</strong></p>\r\n\r\n<p>Hakkınızdaki kişisel bilgilerin d&uuml;zeltilmesi veya g&uuml;ncellenmesi gerektiğinde l&uuml;tfen bize bildirin.</p>\r\n\r\n<p><strong>M. &Ccedil;erezler</strong></p>\r\n\r\n<p>İnternet sitemiz &ccedil;erezleri kullanır. &Ccedil;erez, ağ sunucusu tarafından sunucuya g&ouml;nderilen ve sunucuda saklanan, tanımlayıcı (harfler ve sayılardan oluşan bir kod dizisi) i&ccedil;eren bir dosyadır. Daha sonra tarayıcı sunucudan her sayfa talep ettiğinde tanımlayıcı sunucuya geri g&ouml;nderilir. &Ccedil;erezler &ldquo;kalıcı&rdquo; veya &ldquo;oturum&rdquo; &ccedil;erezleri olabilir: Kalıcı &ccedil;erez, kullanıcı tarafından son kullanım tarihine kadar silinmediği takdirde tarayıcı tarafından saklanır ve son kullanım tarihinde silinir; oturum &ccedil;erezi ise kullanıcı oturumunun sonunda tarayıcı kapatıldığında silinir. &Ccedil;erezler kullanıcıyı tanımlamakta kullanılabilecek bilgileri i&ccedil;ermezler, ancak sizin hakkınızda sakladığımız bilgiler, &ccedil;erezlerdeki veriler ile ilişkilendirilebilir. {UYGUN İFADEYİ SE&Ccedil;İN İnternet sitemizde sadece oturum &ccedil;erezleri / sadece kalıcı &ccedil;erezleri / hem kalıcı hem oturum &ccedil;erezlerini kullanırız.}</p>\r\n\r\n<ol>\r\n	<li>İnternet sitemizde kullandığımız &ccedil;erezlerin adları ve kullanım ama&ccedil;ları aşağıda belirtilmiştir:\r\n	<ol>\r\n		<li>kullanıcı {SİTENİZDE &Ccedil;EREZLERİN KULLANILDIĞI T&Uuml;M KULLANIMLARI BELİRTİN internet sitesini ziyaret ettiğinde / kullanıcıları sitede gezinirken izleme / internet sitesinde alışveriş sepeti kullanımını sağlama / sitenin kullanılabilirliğini geliştirme / internet sitesinin kullanımını analiz etme / dolandırıcılığı &ouml;nleme ve sitenin g&uuml;venliğini arttırma / internet sitesini her kullanıcıya g&ouml;re &ouml;zelleştirme / belirli kullanıcıların ilgi alanlarına y&ouml;nelik reklamları g&ouml;sterme / ama&ccedil;(lar)ı tanımlama};</li>\r\n	</ol>\r\n	</li>\r\n	<li>&Ccedil;oğu tarayıcı &ccedil;erez kullanımını reddetmenizi sağlar. &Ouml;rneğin:\r\n	<ol>\r\n		<li>Internet Explorer&rsquo;da (s&uuml;r&uuml;m 10), &ldquo;Ara&ccedil;lar&rdquo;, &ldquo;İnternet Se&ccedil;enekleri&rdquo;, &ldquo;Gizlilik&rdquo; ve ardından &ldquo;Gelişmiş&rdquo; &uuml;zerine tıklayarak &ccedil;erez kullanımını ge&ccedil;ersiz kılma &ouml;zelliği ile &ccedil;erezleri engelleyebilirsiniz;</li>\r\n		<li>Firefox&rsquo;ta (s&uuml;r&uuml;m 24), &ldquo;Ara&ccedil;lar&rdquo;, &ldquo;Se&ccedil;enekler&rdquo;, &ldquo;Gizlilik&rdquo; &uuml;zerine tıkladıktan sonra a&ccedil;ılır men&uuml;den &ldquo;Ge&ccedil;miş i&ccedil;in &ouml;zel ayarları kullan&rdquo; se&ccedil;eneğini se&ccedil;tikten sonra &ldquo;Sitelerden &ccedil;erezleri kabul et&rdquo; onay kutucuğundaki işareti kaldırarak t&uuml;m &ccedil;erezleri engelleyebilirsiniz ve</li>\r\n		<li>Chrome&rsquo;da (s&uuml;r&uuml;m 29) &ldquo;&Ouml;zelleştirme ve kontrol&rdquo; men&uuml;s&uuml;ne eriştikten sonra &ldquo;Ayarlar&rdquo;, &ldquo;Gelişmiş ayarları g&ouml;ster&rdquo; ve &ldquo;İ&ccedil;erik ayarları&rdquo; &uuml;zerine tıklayıp, &ldquo;&Ccedil;erezler&rdquo; başlığı altında &ldquo;Sitelerin veri ayarlamasını engelle&rdquo; se&ccedil;eneğini se&ccedil;erek t&uuml;m &ccedil;erezleri engelleyebilirsiniz.</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p>T&uuml;m &ccedil;erezleri engellemek, bir&ccedil;ok internet sitesinin kullanılabilirliğini kısıtlayacaktır. &Ccedil;erezleri engellerseniz, sitemizdeki &ouml;zelliklerin t&uuml;m&uuml;n&uuml; kullanamazsınız.</p>\r\n\r\n<ol>\r\n	<li>Bilgisayarınızda saklanan &ccedil;erezleri silebilirsiniz. &Ouml;rneğin:\r\n	<ol>\r\n		<li>Internet Explorer&rsquo;da (s&uuml;r&uuml;m 10) &ccedil;erez dosyalarını manuel olarak silmeniz gerekir (bununla ilgili talimatları&nbsp;<a href=\"http://support.microsoft.com/kb/278835\">http://support.microsoft.com/kb/278835</a>&nbsp;adresinde bulabilirsiniz);</li>\r\n		<li>Firefox&rsquo;ta (s&uuml;r&uuml;m 24) &ldquo;Ara&ccedil;lar&rdquo;, &ldquo;Se&ccedil;enekler&rdquo; ve &ldquo;Gizlilik&rdquo; &uuml;zerine tıkladıktan sonra &ldquo;Ge&ccedil;miş i&ccedil;in &ouml;zel ayarları kullan&rdquo; se&ccedil;eneğini se&ccedil;ip &ldquo;&Ccedil;erezleri g&ouml;ster&rdquo; ve ardından &ldquo;T&uuml;m &ccedil;erezleri sil&rdquo; &uuml;zerine tıklayarak t&uuml;m &ccedil;erezleri silebilirsiniz.</li>\r\n		<li>Chrome&rsquo;da (s&uuml;r&uuml;m 29) &ldquo;&Ouml;zelleştirme ve kontrol&rdquo; men&uuml;s&uuml;ne eriştikten sonra &ldquo;Ayarlar&rdquo;, &ldquo;Gelişmiş ayarları g&ouml;ster&rdquo; ve &ldquo;Tarama verilerini temizle&rdquo; &uuml;zerine tıkladıktan sonra &ldquo;&Ccedil;erezleri ve diğer site eklenti verilerini sil&rdquo; se&ccedil;eneğini se&ccedil;ip &ldquo;Tarama verilerini temizle&rdquo; &uuml;zerine tıklayarak t&uuml;m &ccedil;erezleri silebilirsiniz.</li>\r\n	</ol>\r\n	</li>\r\n	<li>&Ccedil;erezleri silmek, bir&ccedil;ok internet sitesinin kullanılabilirliğini kısıtlayacaktır.</li>\r\n</ol>\r\n'),
(3, '<p>Sitemizin istatistiklerini inceleyebilmek i&ccedil;in &ccedil;erez(cookie) kullanıyoruz. Sitemizi kullanan herkes bu &ccedil;erezleri kabul etmiş varsayılır.</p>\r\n\r\n<p><strong><a href=\"https://www.altingrami.net/\">Altın Gramı</a>&nbsp;</strong>sizlere haber,anlık altın ve d&ouml;viz kurları bilgilerini sağlarken sizden herhangi bir &uuml;cret talep etmez.</p>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `icerik_sayilari`
--

CREATE TABLE `icerik_sayilari` (
  `id` int(11) NOT NULL,
  `alan` varchar(250) NOT NULL,
  `Ad` varchar(250) NOT NULL,
  `sayi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `icerik_sayilari`
--

INSERT INTO `icerik_sayilari` (`id`, `alan`, `Ad`, `sayi`) VALUES
(1, 'ana_sayfa', 'Ana Sayfada', 18),
(2, 'shop', 'Alışveriş Sayfasında', 36),
(3, 'blog', 'Blog Sayfasında', 2),
(4, 'onerilen_urun', 'Ürün Detay Sayfasında Önerilenler Kısmında', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `indirim`
--

CREATE TABLE `indirim` (
  `id` int(11) NOT NULL,
  `aciklama` varchar(500) NOT NULL,
  `sure` datetime NOT NULL,
  `buton_adi` varchar(250) NOT NULL,
  `buton_link` varchar(500) NOT NULL,
  `durum` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `indirim`
--

INSERT INTO `indirim` (`id`, `aciklama`, `sure`, `buton_adi`, `buton_link`, `durum`) VALUES
(1, '', '0000-00-00 00:00:00', '', '', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_ad` varchar(100) NOT NULL,
  `kategori_urunsayisi` int(11) NOT NULL,
  `kategori_ust` int(2) NOT NULL,
  `kategori_title` varchar(255) NOT NULL,
  `kategori_description` varchar(500) NOT NULL,
  `kategori_keyword` varchar(500) NOT NULL,
  `kategori_seourl` varchar(250) NOT NULL,
  `kategori_sira` int(2) NOT NULL,
  `kategori_durum` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_ad`, `kategori_urunsayisi`, `kategori_ust`, `kategori_title`, `kategori_description`, `kategori_keyword`, `kategori_seourl`, `kategori_sira`, `kategori_durum`) VALUES
(9, 'Nike', 0, 0, '', '', '', 'nike', 1, '1'),
(10, 'Adidas', 0, 0, '', '', '', 'adidas', 2, '1'),
(11, 'Puma', 0, 0, '', '', '', 'puma', 3, '1'),
(12, 'Versace', 0, 0, '', '', '', 'versace', 4, '1'),
(13, 'Guess', 0, 0, '', '', '', 'guess', 5, '1'),
(14, 'Rolex', 0, 0, '', '', '', 'rolex', 5, '1'),
(15, 'Beymen', 0, 0, '', '', '', 'beymen', 6, '1'),
(16, 'Luis Vatson', 0, 0, '', '', '', 'luis-vatson', 8, '1'),
(17, 'Bilgisayar', 0, 0, 'bilgisayar', 'bilgisayar', 'biligsayar', 'bilgisayar', 10, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kodekle`
--

CREATE TABLE `kodekle` (
  `id` varchar(50) NOT NULL,
  `kod` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kodekle`
--

INSERT INTO `kodekle` (`id`, `kod`) VALUES
('footer', '<!-- Bu bir yorum satırıdır. Bu alana footer kodlarının altına yazılacak eklenti,javascript kodları vs. ekleyebilirsiniz. Yorum satırı kullanmaya ve kodlamada hata yapmamaya dikkat ediniz. -->'),
('header', '<!-- Bu bir yorum satırıdır. Bu alana HEAD tagları arasına yazılacak olan google analytics, google meta onay kodu, yandex meta onay kodu, sitenize eklemek istediğiniz meta kodları, CDN vb head tagları arasına yazılabilecek tüm kodları yazabilirsiniz. Yorum satırı kullanmaya ve kodlamada hata yapmamaya dikkat ediniz. -->');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kupon_kodu`
--

CREATE TABLE `kupon_kodu` (
  `id` int(11) NOT NULL,
  `kupon_kodu` varchar(50) NOT NULL,
  `indirim_orani` varchar(10) NOT NULL,
  `indirim_kosulu` varchar(11) NOT NULL,
  `indirim_kosulu2` enum('1','0') NOT NULL DEFAULT '0',
  `kupon_sayisi` varchar(11) NOT NULL,
  `kupon_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `kupon_sontarih` datetime NOT NULL,
  `kupon_durum` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kupon_kodu`
--

INSERT INTO `kupon_kodu` (`id`, `kupon_kodu`, `indirim_orani`, `indirim_kosulu`, `indirim_kosulu2`, `kupon_sayisi`, `kupon_tarih`, `kupon_sontarih`, `kupon_durum`) VALUES
(7, 'ensevdigimizhocamiz', '99', '1', '0', '100', '2024-01-09 11:53:58', '2024-01-31 23:59:00', '1'),
(8, 'canimhocam100verin', '99', '0', '1', '99', '2024-01-10 13:06:44', '2024-01-15 23:59:00', '1'),
(9, 'finasunum', '99', '10', '0', '9', '2024-01-10 13:11:03', '2025-12-15 22:00:00', '1'),
(10, 'canimhocamfinalden100', '99', '0', '1', '19', '2024-01-10 14:51:09', '2026-02-15 23:50:00', '1'),
(11, 'hocam60ort', '60', '0', '0', '499', '2024-02-02 13:50:09', '2024-02-04 13:49:00', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mailmarketing`
--

CREATE TABLE `mailmarketing` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `durum` enum('0','1') NOT NULL DEFAULT '1',
  `tarih` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `mailmarketing`
--

INSERT INTO `mailmarketing` (`id`, `ad_soyad`, `mail`, `durum`, `tarih`) VALUES
(17, '', '', '1', '2024-01-10 12:57:20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mail_ayar`
--

CREATE TABLE `mail_ayar` (
  `id` int(11) NOT NULL,
  `mail_adres` varchar(250) NOT NULL,
  `mail_adsoyad` varchar(250) NOT NULL,
  `mail_host` varchar(250) NOT NULL,
  `mail_pass` varchar(250) NOT NULL,
  `mail_smtp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `mail_ayar`
--

INSERT INTO `mail_ayar` (`id`, `mail_adres`, `mail_adsoyad`, `mail_host`, `mail_pass`, `mail_smtp`) VALUES
(1, 'info@tolgahantoros.com.tr', 'Meü Ceng', 'mail.tolgahantoros.com.tr', '2a2eatolgaxde!%', 587);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_ad` varchar(250) NOT NULL,
  `menu_ust` int(11) NOT NULL,
  `menu_icon` varchar(250) NOT NULL,
  `menu_url` varchar(250) NOT NULL,
  `menu_sira` int(11) NOT NULL,
  `menu_durum` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_ad`, `menu_ust`, `menu_icon`, `menu_url`, `menu_sira`, `menu_durum`) VALUES
(1, 'Ana Sayfa', 0, '', 'http://tolgahantoros.com.tr/', 1, '1'),
(2, 'İletişim', 5, '', 'http://tolgahantoros.com.tr/iletisim.php', 0, '1'),
(5, 'Kurumsal', 0, '', 'http://tolgahantoros.com.tr/hakkimizda', 3, '1'),
(6, 'Hakkımızda', 5, '3', 'http://tolgahantoros.com.tr/hakkimizda.php', 1, '1'),
(7, 'Gizlilik Politikası', 5, '3', 'http://tolgahantoros.com.tr/gizlilik.php', 2, '1'),
(8, 'Şartlar ve Koşullar', 5, '3', 'http://tolgahantoros.com.tr/sartlar-ve-kosullar.php', 3, '1'),
(9, 'Erkek', 0, 'İNDİRİM', 'http://tolgahantoros.com.tr/erkek', 2, '1'),
(10, 'Kadın', 0, 'YENİ', 'http://tolgahantoros.com.tr/kadin', 2, '1'),
(16, 'Tüm Ürünler', 0, '', 'http://tolgahantoros.com.tr/shop', 1, '1'),
(17, 'Sepet', 0, '', 'http://tolgahantoros.com.tr/sepet', 5, '1'),
(18, 'Blog', 0, '', 'http://tolgahantoros.com.tr/blog', 8, '1'),
(19, 'Ayakkabı', 9, '', 'http://tolgahantoros.com.tr/ayakkabi-ve-erkek', 1, '1'),
(20, 'Saat', 9, '', 'http://tolgahantoros.com.tr/saat-ve-erkek', 2, '1'),
(21, 'Takım', 9, '', 'http://tolgahantoros.com.tr/takim-ve-erkek', 3, '1'),
(22, 'Gözlük', 9, '', 'http://tolgahantoros.com.tr/gozluk-ve-erkek', 4, '1'),
(23, 'Ayakkabı', 10, '', 'http://tolgahantoros.com.tr/ayakkabi-ve-kadin', 1, '1'),
(24, 'Elbise', 10, '', 'http://tolgahantoros.com.tr/elbise-ve-kadin', 1, '1'),
(25, 'Gözlük', 10, '', '/gozluk-ve-kadin', 3, '1'),
(26, 'Çanta', 10, '', '/canta-ve-kadin', 4, '1'),
(27, 'Saat', 10, '', '/saat-ve-kadin', 5, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `mesaj_id` int(11) NOT NULL,
  `mesaj_adsoyad` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_email` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_telefon` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_icerik` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `mesaj_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `mesaj_durum` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `mesajlar`
--

INSERT INTO `mesajlar` (`mesaj_id`, `mesaj_adsoyad`, `mesaj_email`, `mesaj_telefon`, `mesaj_icerik`, `mesaj_ip`, `mesaj_tarih`, `mesaj_durum`) VALUES
(28, 'asdas asdasd', 'asdasd@sadasd.com', 'asdas', 'asdasd', '78.180.12.142', '2024-01-09 23:48:39', '1'),
(27, 'asdasd asd', 'asdasd@sadasd', 'asdasd', 'asdasdasd', '78.180.12.142', '2024-01-09 23:48:25', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `referans`
--

CREATE TABLE `referans` (
  `referans_id` int(11) NOT NULL,
  `referans_ad` varchar(500) NOT NULL,
  `referans_file` varchar(500) NOT NULL,
  `referans_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reset_pw`
--

CREATE TABLE `reset_pw` (
  `id` int(11) NOT NULL,
  `reset_pw` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `sure` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resimgaleri`
--

CREATE TABLE `resimgaleri` (
  `id` int(11) NOT NULL,
  `resim_ad` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `id` int(11) NOT NULL,
  `users_id` varchar(250) NOT NULL,
  `urunler_id` varchar(1000) NOT NULL,
  `sepet_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `sepet_durum` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sepet`
--

INSERT INTO `sepet` (`id`, `users_id`, `urunler_id`, `sepet_tarih`, `sepet_durum`) VALUES
(20, '34', '{\n    &quot;117&quot;: 1\n}', '2024-01-10 14:51:29', '1'),
(21, '42', '{\n    &quot;115&quot;: 1\n}', '2024-01-09 22:37:08', '1'),
(22, '44', 'null', '2024-02-02 14:05:00', '1'),
(23, '46', '{\n    &quot;112&quot;: &quot;1&quot;,\n    &quot;106&quot;: &quot;1&quot;,\n    &quot;109&quot;: 1\n}', '2024-01-10 14:33:15', '1'),
(24, '49', '{\n    &quot;117&quot;: &quot;1&quot;\n}', '2024-01-14 17:36:23', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `settings_description` varchar(255) NOT NULL,
  `settings_key` varchar(50) NOT NULL,
  `settings_value` text NOT NULL,
  `settings_type` varchar(50) NOT NULL,
  `settings_must` int(4) NOT NULL,
  `settings_delete` enum('0','1') NOT NULL,
  `settings_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`settings_id`, `settings_description`, `settings_key`, `settings_value`, `settings_type`, `settings_must`, `settings_delete`, `settings_status`) VALUES
(1, 'Site başlığı', 'title', 'Meü Ceng', 'text', 0, '0', '1'),
(2, 'Site Açıklama', 'description', 'Ödev', 'text', 0, '0', '1'),
(3, 'Site logo', 'logo', 'images-659d8858e73b0.png', 'file', 0, '0', '1'),
(4, 'Fav icon', 'icon', '5ea779038eae3.jpg', 'file', 0, '0', '1'),
(5, 'Site anahtar kelimeler', 'keywords', 'Yazılım,admin panel,panel', 'text', 0, '0', '1'),
(6, 'Telefon numarası', 'phone', '0545 571 33 31', 'text', 0, '0', '1'),
(7, 'Mail', 'email', 'tolgahantoros@gmail.com', 'text', 0, '0', '1'),
(8, 'İlçe', 'ilce', 'Merkez', 'text', 0, '0', '1'),
(9, 'İl', 'il', 'Mersin', 'text', 0, '0', '1'),
(10, 'Açık adres', 'adres', 'Mersin/Merkez', 'textarea', 0, '0', '1'),
(11, 'İnstagram hesabı', 'instagram', 'www.instagram.com/tolgahantrs', 'text', 0, '0', '1'),
(12, 'Çalışma saatleri', 'work_hours', 'Hafta içi 09:00 - 17:00', 'text', 0, '0', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(11) NOT NULL,
  `users_id` varchar(250) NOT NULL,
  `urunler_id` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `siparis_indirim_miktari` int(11) NOT NULL,
  `siparis_toplam` int(11) NOT NULL,
  `siparis_adres` varchar(1000) NOT NULL,
  `siparis_ip` varchar(50) NOT NULL,
  `siparis_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `siparis_teslimtarih` datetime DEFAULT NULL,
  `siparis_odeme` enum('0','1') DEFAULT '0',
  `siparis_islem_no` int(15) NOT NULL,
  `affiliate_id` int(11) NOT NULL,
  `kargo_takip` varchar(500) NOT NULL,
  `siparis_durum` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `users_id`, `urunler_id`, `siparis_indirim_miktari`, `siparis_toplam`, `siparis_adres`, `siparis_ip`, `siparis_tarih`, `siparis_teslimtarih`, `siparis_odeme`, `siparis_islem_no`, `affiliate_id`, `kargo_takip`, `siparis_durum`) VALUES
(1, '34', '{\n    &quot;113&quot;: &quot;3&quot;\n}', 0, 0, '', '', '2024-01-09 21:48:11', NULL, '0', 0, 0, '', '1'),
(2, '34', '{\n    &quot;113&quot;: &quot;3&quot;\n}', 0, 6588, 'www', '46.106.87.24', '2024-01-09 21:48:53', NULL, '0', 0, 0, '', '1'),
(3, '42', '{\n    &quot;115&quot;: &quot;1&quot;\n}', 0, 15, 'Mersin', '31.155.182.34', '2024-01-09 22:37:22', NULL, '0', 0, 0, '', '1'),
(4, '43', '{\n    &quot;114&quot;: &quot;1&quot;\n}', 0, 0, '', '', '2024-01-09 23:03:40', NULL, '0', 0, 0, '', '1'),
(5, '43', '{\n    &quot;114&quot;: &quot;1&quot;\n}', 0, 0, '', '', '2024-01-09 23:03:48', NULL, '0', 0, 0, '', '1'),
(6, '43', '{\n    &quot;114&quot;: &quot;1&quot;\n}', 900, 5100, 'Ldosls', '159.146.40.93', '2024-01-09 23:04:01', NULL, '0', 0, 0, '', '1'),
(7, '43', '{\n    &quot;114&quot;: &quot;1&quot;\n}', 900, 5100, 'Ldosls', '159.146.40.93', '2024-01-09 23:04:14', NULL, '0', 0, 0, '', '1'),
(8, '44', '{\n    &quot;116&quot;: &quot;1&quot;\n}', 0, 0, '', '', '2024-01-10 13:00:26', NULL, '0', 0, 0, '', '0'),
(9, '44', '{\n    &amp;quot;116&amp;quot;: &amp;quot;1&amp;quot;\n}', 0, 50, 'asdasdasdsdas', '176.33.99.127', '2024-01-10 13:00:59', '0000-00-00 00:00:00', '1', 21525594, 0, '', '1'),
(10, '44', '{\n    &quot;112&quot;: &quot;1&quot;\n}', 0, 2000, 'sadasdasdasasd', '176.33.99.127', '2024-01-10 13:08:16', NULL, '0', 0, 0, '', '0'),
(11, '46', '{\n    &quot;112&quot;: &quot;1&quot;,\n    &quot;106&quot;: &quot;1&quot;,\n    &quot;109&quot;: &quot;1&quot;\n}', 2981, 4017, 'mersin', '176.90.138.235', '2024-01-10 14:36:26', NULL, '0', 0, 0, '', '1'),
(12, '46', '{\n    &quot;112&quot;: &quot;1&quot;,\n    &quot;106&quot;: &quot;1&quot;,\n    &quot;109&quot;: &quot;1&quot;\n}', 2981, 4017, 'asdasdas', '176.90.138.235', '2024-01-10 14:41:00', NULL, '0', 0, 0, '', '1'),
(13, '34', '{\n    &quot;117&quot;: &quot;1&quot;\n}', 9900, 100, 'asdasdsad', '176.90.138.235', '2024-01-10 14:53:18', NULL, '0', 0, 0, '', '1'),
(14, '49', '{\n    &quot;117&quot;: &quot;1&quot;\n}', 0, 0, '', '', '2024-01-14 17:36:26', NULL, '0', 0, 0, '', '0'),
(15, '49', '{\n    &quot;117&quot;: &quot;1&quot;\n}', 0, 10000, 'Kfksod', '159.146.40.93', '2024-01-14 17:36:40', NULL, '0', 0, 0, '', '0'),
(16, '50', '{\n    &quot;116&quot;: &quot;1&quot;,\n    &quot;115&quot;: &quot;1&quot;\n}', 0, 0, '', '', '2024-01-19 12:23:23', NULL, '0', 0, 0, '', '0'),
(17, '50', '{\n    &quot;116&quot;: &quot;1&quot;,\n    &quot;115&quot;: &quot;1&quot;\n}', 0, 0, '', '', '2024-01-19 12:23:47', NULL, '0', 0, 0, '', '0'),
(18, '50', '{\n    &quot;116&quot;: &quot;1&quot;,\n    &quot;115&quot;: &quot;1&quot;\n}', 0, 65, 'mersin yenişehir belediyesi mustafa baysan erkek yurdu', '178.241.161.150', '2024-01-19 12:25:20', NULL, '0', 0, 0, '', '1'),
(19, '44', '{\n    &amp;quot;117&amp;quot;: &amp;quot;1&amp;quot;\n}', 6000, 4000, 'fghjkalsfajsfokl', '178.246.116.166', '2024-02-02 13:52:32', '0000-00-00 00:00:00', '1', 21649369, 0, '', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_ad` varchar(250) NOT NULL,
  `slider_file` varchar(500) NOT NULL,
  `slider_yazi` text NOT NULL,
  `slider_sira` int(11) NOT NULL,
  `slider_buton` varchar(250) NOT NULL,
  `slider_link` varchar(500) NOT NULL,
  `slider_durum` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_ad`, `slider_file`, `slider_yazi`, `slider_sira`, `slider_buton`, `slider_link`, `slider_durum`) VALUES
(3, 'AYAKKABILARDAKİ BÜYÜK İNDİRİMİ KAÇIRMAYIN!', 'slide-02-5fd915a468ac6.jpg', '&lt;p&gt;AYAKKABILARDA EFSANE İNDİRİMLER!&lt;/p&gt;\r\n', 2, 'İLETİŞİM', '/iletisim', '1'),
(4, 'AÇILIŞA ÖZEL %10 İNDİRİM!', 'slide-05-5fadb48d8ff41.jpg', '&lt;p&gt;İNDİRİM FIRSATINI KAÇIRMAYIN&lt;/p&gt;\r\n', 1, 'ALIŞVERİŞE BAŞLA', '/shop.php', '1'),
(5, 'YENİ SEZONDA EFSANE İNDİRİMLER', 'slide-06-5fadb4b2dcce6.jpg', '&lt;p&gt;İNDİRİMLERİ KAÇIRMA&lt;/p&gt;\r\n', 5, 'FIRSATLARI YAKALA', '/shop', '1'),
(7, 'ŞUBAT AYI İNDİRİMLERİ BAŞLADI', 'slide-03-5fcea092f1529.jpg', '&lt;p&gt;ŞUBATA ÖZEL İNDİRİMLERİ KAÇIRMA!&lt;/p&gt;\r\n', 4, 'ALIŞVERİŞE BAŞLA', '/shop', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyalmedya`
--

CREATE TABLE `sosyalmedya` (
  `id` int(11) NOT NULL,
  `ad` varchar(250) NOT NULL,
  `url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sosyalmedya`
--

INSERT INTO `sosyalmedya` (`id`, `ad`, `url`) VALUES
(1, 'facebook', 'https://www.facebook.com/'),
(2, 'instagram', 'https://www.instagram.com/'),
(3, 'youtube', 'https://www.youtube.com/'),
(4, 'googleplus', 'https://www.google.com/'),
(5, 'pinterest', 'https://www.pinterest.com/'),
(6, 'twitter', 'https://www.twitter.com/'),
(7, 'linkedin', 'https://www.linkedin.com/');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sss`
--

CREATE TABLE `sss` (
  `id` int(11) NOT NULL,
  `soru` text NOT NULL,
  `cevap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sss`
--

INSERT INTO `sss` (`id`, `soru`, `cevap`) VALUES
(1, 'Neden?', '<p>Ne neden?</p>\r\n'),
(2, 'Kim', '<p>Kim kim?</p>\r\n'),
(3, 'Nasıl?', '&lt;p&gt;Ne nasıl?&lt;/p&gt;\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tema_header_ustu`
--

CREATE TABLE `tema_header_ustu` (
  `id` int(11) NOT NULL,
  `ad` varchar(250) NOT NULL,
  `baslik` varchar(250) NOT NULL,
  `url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tema_header_ustu`
--

INSERT INTO `tema_header_ustu` (`id`, `ad`, `baslik`, `url`) VALUES
(1, 'sol', '100₺ ve üzeri alışverişlerinizde kargo ücretsiz', ''),
(2, 'sag', 'S.S.S', 'sss');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `urun_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `varyant_id` int(11) NOT NULL,
  `urun_tur` int(11) NOT NULL,
  `urun_zaman` timestamp NOT NULL DEFAULT current_timestamp(),
  `urun_ad` varchar(400) NOT NULL,
  `urun_seourl` varchar(450) NOT NULL,
  `urun_title` varchar(100) NOT NULL,
  `urun_description` varchar(250) NOT NULL,
  `urun_detay` text NOT NULL,
  `urun_cinsiyet` enum('erkek','kadın','unisex','') NOT NULL,
  `urun_fiyat` int(11) NOT NULL,
  `urun_indirim` tinyint(2) NOT NULL,
  `urun_keyword` varchar(250) NOT NULL,
  `urun_barkod` varchar(250) NOT NULL,
  `urun_file` varchar(500) NOT NULL,
  `urun_stok` varchar(11) DEFAULT '0',
  `urun_durum` enum('0','1') NOT NULL DEFAULT '1',
  `urun_onecikar` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`urun_id`, `kategori_id`, `varyant_id`, `urun_tur`, `urun_zaman`, `urun_ad`, `urun_seourl`, `urun_title`, `urun_description`, `urun_detay`, `urun_cinsiyet`, `urun_fiyat`, `urun_indirim`, `urun_keyword`, `urun_barkod`, `urun_file`, `urun_stok`, `urun_durum`, `urun_onecikar`) VALUES
(101, 11, 0, 7, '2024-01-08 14:21:57', 'Rıfkı', 'Rifki-p-5596236914', 'Puma', 'Rıfkı iyidir Rıfkı Güzeldir', '&lt;p&gt;Rıfkı iyi gibi Rıfkıdan devam ederiz&lt;/p&gt;\r\n', 'erkek', 14999, 0, 'Rıfkı,Köpek,Puma,Takım,Erkek', '20155817', 'rifki-659c050503d1d.jpg', '1', '1', '0'),
(103, 15, 0, 8, '2024-01-08 18:22:51', 'kısa kollu mavi gömlek', 'kisakollugomlek-p-5234006284', 'kısa kollu gömlek', 'kısa kollu erkek mavi gömlek', '&lt;p&gt;xl beden&lt;/p&gt;\r\n', 'erkek', 150, 5, 'gömlek', '13131313131313', 'kisa-kollu-mavi-gomlek-659c3d7b63b3b.jpg', '1', '1', '1'),
(105, 10, 0, 1, '2024-01-08 18:30:16', 'adidas  spor ayakkabı siyah ', 'adidasayakkabi-p-6997065807', 'ayakkabı abibas', 'adidas kadın spor ayakkabı', '&lt;p&gt;36.5 numara&lt;/p&gt;\r\n', 'kadın', 2099, 10, 'adidas', '31313131313131', 'adidas-spor-ayakkabi-siyah-659c3f3837fab.jpg', '1', '1', '1'),
(106, 14, 0, 4, '2024-01-08 18:34:43', 'zincir askılı baguette çanta', 'canta-p-5442191040', 'zincir askılı baget çanta', 'çanta', '&lt;p&gt;çanta işte&lt;/p&gt;\r\n', 'kadın', 299, 0, 'çanta', '5258624896235', 'zincir-askili-baguette-canta-659c40744f1cb.jpg', '1', '1', '1'),
(107, 10, 0, 4, '2024-01-08 18:37:29', 'siyah erkek çanta', 'cantaerkek-p-4757583656', 'siyah erkek çanta', 'çanta erkek', '&lt;p&gt;emekli öğretmenlerimiz için biçilmiş deri kaftan&lt;/p&gt;\r\n', 'erkek', 1000, 1, 'çanta', '214789257526599', 'siyah-erkek-canta-659c412176046.jpg', '1', '1', '1'),
(108, 12, 0, 8, '2024-01-08 18:41:24', 'Mavi Sırt Dekolte Mini Elbise', 'elbisekadin-p-8532187770', 'Mavi Sırt Dekolte Mini Elbise', 'Mavi Sırt Dekolte Mini Elbise', '&lt;p&gt;m beden&lt;/p&gt;\r\n', 'kadın', 699, 0, 'elbise', '963852741', 'mavi-sirt-dekolte-mini-elbise-659c41d481b35.jpg', '1', '1', '1'),
(109, 12, 0, 5, '2024-01-08 18:44:00', 'rayban kadın gözlük', 'raybangozluk-p-7478398919', 'rayban kadın gözlük', 'rayban kadın gözlük', '&lt;p&gt;sarı güneş gözlüğü&lt;/p&gt;\r\n', 'kadın', 4699, 15, 'gözlük', '61651674165165', 'rayban-kadin-gozluk-659c4512b9e2e.jpg', '1', '1', '1'),
(110, 16, 0, 5, '2024-01-08 18:46:32', 'Salvatore Ferragamo Erkek Güneş Gözlüğü SF145SL 15', 'SalvatoreFerragamo -p-9964298496', 'Salvatore Ferragamo Erkek Güneş Gözlüğü SF145SL 15', 'Salvatore Ferragamo Erkek Güneş Gözlüğü SF145SL 15', '&lt;p&gt;erkek gözlük&lt;/p&gt;\r\n', 'erkek', 12645, 0, 'gözlük', '9816498451648664', 'salvatore-ferragamo-erkek-gunes-gozlugu-sf145sl-15-659c4308250d2.jpg', '1', '1', '1'),
(111, 14, 0, 6, '2024-01-08 18:47:58', 'Rolex DateJust Çift Renk Gold Kadran Erkek Kol Saati L-1369', 'rolexerkek-p-4733569032', 'Rolex DateJust Çift Renk Gold Kadran Erkek Kol Saati L-1369', 'Rolex DateJust Çift Renk Gold Kadran Erkek Kol Saati L-1369', '&lt;p&gt;rolex saat&lt;/p&gt;\r\n', 'erkek', 3138, 0, 'rolex', '54896514984', 'rolex-datejust-cift-renk-gold-kadran-erkek-kol-saati-l-1369-659c44c02187d.jpg', '1', '1', '1'),
(112, 12, 0, 6, '2024-01-08 18:49:54', 'Zyros Sarı Çelik Kordon Kadın Kol Saati', 'zyrossaat-p-8038242034', 'Zyros Sarı Çelik Kordon Kadın Kol Saati', 'Zyros Sarı Çelik Kordon Kadın Kol Saati', '&lt;h1&gt;zyros kadın kol saati&lt;/h1&gt;\r\n', 'kadın', 2000, 0, 'saat', '18468641516784', 'zyros-sari-celik-kordon-kadin-kol-saati-659c43d23e7e2.jpg', '1', '1', '1'),
(113, 15, 0, 7, '2024-01-08 18:51:33', 'Erkek Regular Fit 6 Drop Takım Elbise MAVİ', 'erkektaim-p-6527004945', 'Erkek Regular Fit 6 Drop Takım Elbise MAVİ', 'Erkek Regular Fit 6 Drop Takım Elbise MAVİ', '&lt;p&gt;yakışırrrrrr&lt;/p&gt;\r\n', 'erkek', 2196, 0, 'takım elbise', '1618646168', 'erkek-regular-fit-6-drop-takim-elbise-mavi-659c4435b0fcd.jpg', '1', '1', '1'),
(114, 15, 0, 7, '2024-01-08 18:52:45', 'MARİSKA YEŞİL TAKIM ELBİSE', 'mariskaelbisetakim-p-5602830320', 'MARİSKA YEŞİL TAKIM ELBİSE', 'MARİSKA YEŞİL TAKIM ELBİSE', '&lt;p&gt;yakışırrrrrrr her türlü&lt;/p&gt;\r\n', 'kadın', 6000, 15, 'takım elbise', '845148946851', 'mari-ska-yesi-l-takim-elbi-se-659c447ddbf1c.jpg', '1', '0', '0'),
(115, 15, 0, 7, '2024-01-08 18:57:30', 'sek erkek kombini', 'kombin-p-8501899594', 'sek erkek kombini', 'sek erkek kombini', '&lt;p&gt;delikanlı abilerimize %10 indirim. yanında safir tesbih hediye&lt;/p&gt;\r\n', 'erkek', 15, 0, 'kombin', '85148651', 'sek-erkek-kombini-659d078a25b8f.png', '1', '1', '1'),
(116, 15, 0, 1, '2024-01-09 08:43:58', 'kundura', 'kundura-p-7783064374', 'erkek kundura', 'kundura', '&lt;p&gt;41 numara&lt;/p&gt;\r\n', 'erkek', 50, 0, 'kundura', '84956289456231', 'kundura-659d07bc33c57.jpg', '1', '1', '0'),
(117, 17, 0, 9, '2024-01-10 11:47:53', 'laptop', 'bilgisayar-p-1262251241', 'Bilgisayar', 'bilgisayarlaptop', '&lt;p&gt;bilgisayar&lt;/p&gt;\r\n', 'unisex', 10000, 0, 'biligsayar', '123456789', 'laptop-659e83e9d0183.jpg', '1', '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunfoto`
--

CREATE TABLE `urunfoto` (
  `urunfoto_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `urunfoto_resimyol` varchar(255) NOT NULL,
  `urunfoto_sira` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `urunfoto`
--

INSERT INTO `urunfoto` (`urunfoto_id`, `urun_id`, `urunfoto_resimyol`, `urunfoto_sira`) VALUES
(81, 16, 'dimg/urun/296062177124809318143.jpg', 0),
(82, 18, 'dimg/urun/22972253852646020509IMG-20200301-WA0071.jpg', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_seo`
--

CREATE TABLE `urun_seo` (
  `id` int(1) NOT NULL,
  `urun_title` varchar(250) NOT NULL,
  `urun_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urun_seo`
--

INSERT INTO `urun_seo` (`id`, `urun_title`, `urun_description`) VALUES
(1, 'Fiyatı ve Özellikleri', 'en iyi fiyatla satın alın! Şimdi indirimli fiyatla sipariş verin, ayağınıza gelsin!');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_turleri`
--

CREATE TABLE `urun_turleri` (
  `id` int(11) NOT NULL,
  `urun_turu` varchar(500) NOT NULL,
  `urun_turu_seourl` varchar(500) NOT NULL,
  `urun_turu_durum` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urun_turleri`
--

INSERT INTO `urun_turleri` (`id`, `urun_turu`, `urun_turu_seourl`, `urun_turu_durum`) VALUES
(1, 'Ayakkabı', 'ayakkabi', '1'),
(4, 'Çanta', 'canta', '1'),
(5, 'Gözlük', 'gozluk', '1'),
(6, 'Saat', 'saat', '1'),
(7, 'Takım', 'takim', '1'),
(8, 'Elbise', 'elbise', '1'),
(9, 'Bilgisayar', 'bilgisayar', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_yorumlar`
--

CREATE TABLE `urun_yorumlar` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `yorum` varchar(1000) NOT NULL,
  `puan` int(1) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `yorum_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_adresi` varchar(50) NOT NULL,
  `yorum_durumu` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urun_yorumlar`
--

INSERT INTO `urun_yorumlar` (`id`, `users_id`, `yorum`, `puan`, `urun_id`, `yorum_tarih`, `ip_adresi`, `yorum_durumu`) VALUES
(10, 39, 'yeni yorum testi', 4, 100, '2024-01-08 17:26:47', '176.33.109.138', '1'),
(11, 39, 'yeni yorum testi', 4, 100, '2024-01-08 17:27:21', '176.33.109.138', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_namesurname` varchar(50) NOT NULL,
  `users_file` varchar(50) NOT NULL,
  `users_mail` varchar(250) NOT NULL,
  `users_phone` varchar(250) NOT NULL,
  `users_gender` enum('kadin','erkek','unisex') NOT NULL,
  `users_address` varchar(1000) NOT NULL,
  `users_birth` date NOT NULL,
  `users_membership` datetime NOT NULL DEFAULT current_timestamp(),
  `users_pass` varchar(50) NOT NULL,
  `users_mail_status` varchar(255) NOT NULL,
  `users_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`users_id`, `users_namesurname`, `users_file`, `users_mail`, `users_phone`, `users_gender`, `users_address`, `users_birth`, `users_membership`, `users_pass`, `users_mail_status`, `users_status`) VALUES
(34, 'tt tt', '', 'tolgahantoros@gmail.com', '0(545)-555-5555', 'erkek', '', '0000-00-00', '2024-01-07 22:05:09', '81dc9bdb52d04dc20036dbd8313ed055', 'LGG2XqHKCwpCMM0BHSKvCR8eJumWUAbUDkBXflhP3ofnxRs1hXyTfl4BGs2ZC6lzmqVSvWBvNJGEiLuuQGhRa6stRRytc4LgPuKKSm7Wx6fc8VQrJkCd9F6U08ZLIOowpEJPQ5fYXeyT2mkYOEY4aMHabnFTlzdZ174ij7pnvVtjqrJy81N6iZh2zd5W3b7b3dy2wd1xDScEpltOz7I5icF9jmB43IVP5aTDe3pAk1rZQK95NUAHeNVjiethgzg', '1'),
(38, 'Egemen Kağan Duman', '', 'egokagodumo@gmail.com', '0(507)-439-0345', 'erkek', '', '0000-00-00', '2024-01-08 11:58:46', 'f68f68afdae64e0c852a8fa8b3e68de5', 'Y932pCLvV0qYxn2gPescSgTRyjnoYwqdtF8X7OcAzJJjUwkB4KG9khDdmLlN6cZSPOoKy9PC5prVdnH1Lyhbc6XY0EmBJsNNXlYWiHrKa8yHItICEaQKEOQeWTNtHH2sbdp9gnIvGjzlo7bkaMI0ZzL14TBfzC4u1RpAfohfgxnU8Af7LidyPGZVlwRArxUfIP2hmG2g6WQMzO3h3JaeS1m5Fvx5GF785FMARFtk6QeD4sBbv0OiK7RSXiZsWUM', '1'),
(42, 'Gürkan The Hacker', '', 'gurkanthehacker@sagolera.com', '0(531)-313-1313', 'unisex', '', '0000-00-00', '2024-01-09 22:36:36', '25f9e794323b453885f5181f1b624d0b', '9XAhanOKAHBvs1tLFSyqRSFF1ZlXSJZfsl49TxM6xY3bKsh1RtuXJaGvdRYum0EnWN8xjMFHl1WnTf2qzCBEOjz7JFQsyS6p3Z1PY5VA2wgRbIH0W624dCXd0BWfDozEK7NeBEMC6e4wtSWQC4DZvU85umNQkDAmywIUiapL3mjI7OgTe4f0uimEAxpYqiPDcgoiUyyQGjV2KJbhjc36rDQenskPrkpqPfxXnNGGv9rHctwhCzbutoLI7lG9hOO', '1'),
(43, 'Dpwls', '', 'tolga@tolga.tolga', '5(555)-555-5555', 'erkek', '', '0000-00-00', '2024-01-09 23:03:27', '9559abc957211086589d26975ff1e21c', 'HtOwCgYi01GgKZEjcLhOja1kugzc2cug6F4DK93SDZX7p6ovOdPsLb9e2yIZsYdzSurGMwvJA67vfnByiUqXRN3hsYm4D2CC5v0P0IwlKr6IKiaPeeoNQglbwakejU7HuMRFWfSRrdpoKJ8y3583NxO0DzYxV5pqaJ1yCABxCVl7T4925qnEfnrbtvjQlIkXpW7M1xQFDW3ZqjVtBcuU5PXx8LOsrJBNHaRGGAAz9HwQTzFXm1AWf4diSmo8FkT', '1'),
(44, 'deniz dede', '', 'deniz@gmail.com', '0(531)-313-1158', 'kadin', '', '0000-00-00', '2024-01-10 12:59:11', 'c69ab11f9856819585c082914be62f8e', 'WtbLsGDDaifRomkNvGRkObMt1bHmzZvhre2PPE6tHQ5djGVuTeI1BD80PJppGPuCNgAsuMVFOw8W9i9MnmKxcSowH0Qfhn23e27tTXIVF3c2UeamyXs4nKTmLoqEtBlHxqujQx4cj8K5YASBbS0MCg0FbgUwFA36DZ4LlQgoDdf5rSd9RgNqT8aY1faViUYE7p3IvXyYBlel7WXKfFRzzunPJ19NkZJkqBZdq7T5ykiRpCWsC4wJjN8WyXsvxoz', '1'),
(45, 'Mahmut snape', '', 'hellokittymahmut@hotmail.com', '0(544)-513-6784', 'erkek', '', '0000-00-00', '2024-01-10 13:03:12', '827ccb0eea8a706c4c34a16891f84e7b', 'ppjs6SR9QdV8LioQOoejRbADWxGR6Dkrw7OZ7LtNiXw4f8HsoBVmyWM5040N4wBmelB2YSgaC43ThyT0f4BWc12mEzZK5XcIENjdarq9H91iqWrUEt8DQFngEtVVRSsT3GdGsU75DlwYA02mCUirBz2bX9hNZkWu5XMfSuhHbcvkKl8YPAfxUqstoHeYebXk15ghvj8e93uFTFjyZJ0N7qTCGPIha23VqJcEMpxCg6LyupOYFLKpAFJPM66z1a7', '1'),
(46, 'Esra Gündoğan', '', 'esra@gmail.com', '0(555)-555-5555', 'kadin', '', '0000-00-00', '2024-01-10 14:31:16', 'f48ca6674ab0bcf1674d1036c2132af7', '6XXoOtuimt2mYIEt4Zygpi1Fjr6hpudQzJJAfsEVDaMB3Ym15vG6W3TbEljXZA47NgUfNUK8UCTTkPecAg0brqHzF0VDMijbWI1k3dW0rcPnCNcUqeYA82WBpu7vGxKVRhDiKKqBhAfGayOStpQfoLIogF9znqOxO1n5MOS0PyQR8FhtSz9em0uBqnwTcYMSI45bysxNHY4DZJuRwvEzrioQXk3Ndm9nHJ822HkIhw6S9aTJ59LKWQwxEpswLPC', '1'),
(49, 'Ysısız', '', 'test21@hotmail.com', '0(543)-167-3164', 'unisex', '', '0000-00-00', '2024-01-14 17:35:17', '098f6bcd4621d373cade4e832627b4f6', 'alGJeDg0OoZsIgjdGOzrcui9lXdOx8Sy4kATpa8ezPljTk96S5kbvDOuEQq1hfyxBGS24JYprTbqhuZNEV2axYfP7Qannqm6KPjXvpoyU6kwriPzNeixMCJefsNlMHjYB3wK3fjtfxWGaIgFWbG3nYQHXHvqpw58JcZMmcWEmVAspCEBJ9D0LoNbF5oywO0yudtK4L1gD8wIMuvlLAZIhAt2r7rULKX0Xev7gN5UcdVt3C81s3V4Tn5MYT0S4s2', '1'),
(50, 'emin hezer', '', 'eminhezer254@gmail.com', '0(505)-045-4826', 'erkek', '', '0000-00-00', '2024-01-19 12:22:58', '7b3ff33f66a175b61808b06de7f7e5eb', 'SQTLlsY20RgZn1SyI5bmos4YTjD851UFfyo7laQkMg5kQvu1iT8WYcROmI3M1fZX23sxBXGUt00PlHYKxvDowgCuSRVqJHdEwry4uStpjiTGGc97fEBtOANdjMDNoeNmV1j8JhGMpoOJg3LesB4y0LPh9kilwtKrXDln3DUIebC7n9b8h0EmFUYdeanCjOzQxzNKxvpWwf8K5A27PHkgtIvZhbiwW9a7E6qBWA2XzJazU2JIFv5Ec6zPHFrKRqB', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `varyant`
--

CREATE TABLE `varyant` (
  `id` int(11) NOT NULL,
  `ad` varchar(250) NOT NULL,
  `deger` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `videogaleri`
--

CREATE TABLE `videogaleri` (
  `id` int(11) NOT NULL,
  `video_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `aboneler`
--
ALTER TABLE `aboneler`
  ADD PRIMARY KEY (`abone_id`),
  ADD UNIQUE KEY `abone_mail` (`abone_mail`);

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admins_id`),
  ADD UNIQUE KEY `admins_username` (`admins_username`);

--
-- Tablo için indeksler `affiliate`
--
ALTER TABLE `affiliate`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `anasayfa_banner`
--
ALTER TABLE `anasayfa_banner`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `banka`
--
ALTER TABLE `banka`
  ADD PRIMARY KEY (`banka_id`);

--
-- Tablo için indeksler `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogs_id`);

--
-- Tablo için indeksler `blog_yorum`
--
ALTER TABLE `blog_yorum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `footerbaslik`
--
ALTER TABLE `footerbaslik`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `footer_abone`
--
ALTER TABLE `footer_abone`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hakkimizda`
--
ALTER TABLE `hakkimizda`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `icerik_sayilari`
--
ALTER TABLE `icerik_sayilari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `indirim`
--
ALTER TABLE `indirim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `kodekle`
--
ALTER TABLE `kodekle`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kupon_kodu`
--
ALTER TABLE `kupon_kodu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kupon_kodu` (`kupon_kodu`);

--
-- Tablo için indeksler `mailmarketing`
--
ALTER TABLE `mailmarketing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Tablo için indeksler `mail_ayar`
--
ALTER TABLE `mail_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`mesaj_id`);

--
-- Tablo için indeksler `referans`
--
ALTER TABLE `referans`
  ADD PRIMARY KEY (`referans_id`);

--
-- Tablo için indeksler `reset_pw`
--
ALTER TABLE `reset_pw`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `resimgaleri`
--
ALTER TABLE `resimgaleri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Tablo için indeksler `sosyalmedya`
--
ALTER TABLE `sosyalmedya`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sss`
--
ALTER TABLE `sss`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tema_header_ustu`
--
ALTER TABLE `tema_header_ustu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`urun_id`);

--
-- Tablo için indeksler `urunfoto`
--
ALTER TABLE `urunfoto`
  ADD PRIMARY KEY (`urunfoto_id`);

--
-- Tablo için indeksler `urun_seo`
--
ALTER TABLE `urun_seo`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun_turleri`
--
ALTER TABLE `urun_turleri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `urun_turu_seourl` (`urun_turu_seourl`),
  ADD UNIQUE KEY `urun_turu` (`urun_turu`);

--
-- Tablo için indeksler `urun_yorumlar`
--
ALTER TABLE `urun_yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_mail` (`users_mail`),
  ADD UNIQUE KEY `users_phone` (`users_phone`);

--
-- Tablo için indeksler `varyant`
--
ALTER TABLE `varyant`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `videogaleri`
--
ALTER TABLE `videogaleri`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `aboneler`
--
ALTER TABLE `aboneler`
  MODIFY `abone_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `admins_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Tablo için AUTO_INCREMENT değeri `affiliate`
--
ALTER TABLE `affiliate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `anasayfa_banner`
--
ALTER TABLE `anasayfa_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `banka`
--
ALTER TABLE `banka`
  MODIFY `banka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Tablo için AUTO_INCREMENT değeri `blog_yorum`
--
ALTER TABLE `blog_yorum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `footerbaslik`
--
ALTER TABLE `footerbaslik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `hakkimizda`
--
ALTER TABLE `hakkimizda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `icerik_sayilari`
--
ALTER TABLE `icerik_sayilari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `kupon_kodu`
--
ALTER TABLE `kupon_kodu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `mailmarketing`
--
ALTER TABLE `mailmarketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `mail_ayar`
--
ALTER TABLE `mail_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `mesaj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tablo için AUTO_INCREMENT değeri `referans`
--
ALTER TABLE `referans`
  MODIFY `referans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `reset_pw`
--
ALTER TABLE `reset_pw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `resimgaleri`
--
ALTER TABLE `resimgaleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `sosyalmedya`
--
ALTER TABLE `sosyalmedya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `sss`
--
ALTER TABLE `sss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `tema_header_ustu`
--
ALTER TABLE `tema_header_ustu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `urun`
--
ALTER TABLE `urun`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Tablo için AUTO_INCREMENT değeri `urunfoto`
--
ALTER TABLE `urunfoto`
  MODIFY `urunfoto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Tablo için AUTO_INCREMENT değeri `urun_turleri`
--
ALTER TABLE `urun_turleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `urun_yorumlar`
--
ALTER TABLE `urun_yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Tablo için AUTO_INCREMENT değeri `varyant`
--
ALTER TABLE `varyant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `videogaleri`
--
ALTER TABLE `videogaleri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
