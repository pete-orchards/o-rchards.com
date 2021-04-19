-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- ホスト: mysql146.phy.lolipop.lan
-- 生成日時: 2020 年 11 月 26 日 23:49
-- サーバのバージョン: 5.6.23-log
-- PHP のバージョン: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `LAA0915260-orchards`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `mis`
--

CREATE TABLE IF NOT EXISTS `mis` (
  `mi_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `body` varchar(10000) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mi_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- テーブルのデータのダンプ `mis`
--

INSERT INTO `mis` (`mi_id`, `post_id`, `user_id`, `title`, `body`, `post_time`, `updated_time`) VALUES
(1, 5, 2, 'テストです', 'かきくけこ', '2020-10-12 00:30:08', '2020-10-12 00:30:08'),
(2, 6, 2, 'テストです', 'かきくけこ', '2020-10-12 00:30:49', '2020-10-12 00:30:49'),
(3, 9, 2, 'てすと', 'あああ', '2020-10-12 00:57:11', '2020-10-12 00:57:11');

-- --------------------------------------------------------

--
-- テーブルの構造 `mi_costs`
--

CREATE TABLE IF NOT EXISTS `mi_costs` (
  `mi_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  PRIMARY KEY (`mi_id`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `mi_costs`
--

INSERT INTO `mi_costs` (`mi_id`, `num`, `name`, `amount`, `volume`) VALUES
(1, 1, '400', 50, 20),
(2, 1, '400', 50, 20),
(3, 1, 'い', 50, 3);

-- --------------------------------------------------------

--
-- テーブルの構造 `mi_imgs`
--

CREATE TABLE IF NOT EXISTS `mi_imgs` (
  `mi_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mi_id`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `mi_imgs`
--

INSERT INTO `mi_imgs` (`mi_id`, `num`, `img`) VALUES
(2, 1, '2ad0fe54a29e33b076b8aa5e5421c4c7ac4db546.jpeg');

-- --------------------------------------------------------

--
-- テーブルの構造 `mi_incomes`
--

CREATE TABLE IF NOT EXISTS `mi_incomes` (
  `mi_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  PRIMARY KEY (`mi_id`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `mi_incomes`
--

INSERT INTO `mi_incomes` (`mi_id`, `num`, `name`, `amount`, `volume`) VALUES
(1, 1, '5', 200, 3),
(2, 1, '5', 200, 3),
(3, 1, 'あ', 100, 5);

-- --------------------------------------------------------

--
-- テーブルの構造 `naes`
--

CREATE TABLE IF NOT EXISTS `naes` (
  `nae_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `body` varchar(1200) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nae_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- テーブルのデータのダンプ `naes`
--

INSERT INTO `naes` (`nae_id`, `post_id`, `user_id`, `title`, `body`, `post_time`, `updated_time`) VALUES
(1, 3, 2, 'テスト', 'テストです', '2020-10-12 00:19:56', '2020-10-12 00:19:56'),
(2, 4, 2, 'テストテスト', 'テスト', '2020-10-12 00:26:05', '2020-10-12 00:26:05'),
(3, 8, 2, 'てすと', 'てすと', '2020-10-12 00:55:44', '2020-10-12 00:55:44'),
(4, 11, 2, 'テスト', 'うまくいってそうです。\r\nとりあえずいい感じ', '2020-10-12 06:51:14', '2020-10-12 06:51:14'),
(5, 12, 2, 'レトロシリーズ', '◼️オリジナルの収納家具シリーズを製作販売する。\r\n現状試作を進めている段階。\r\n\r\n◼️まず、ある程度の数の人に実際に使ってもらうことから\r\n販売に繋げていきたい。\r\n\r\n◼️【方法】\r\n・試作品として引出しセット5セット、トレーセット20セットを製作。\r\n・モニターを募集する(=告知①)\r\n・感想を集める\r\n・感想をもとに商品の改良\r\n・販売開始(=告知②)\r\n・販売\r\n\r\n\r\n◼️【商品説明、特徴】\r\n○意匠性：懐かしさを感じるレトロな雰囲気\r\n○機能性：コピー用紙サイズを基本とした寸法体系\r\n○拡張性：組み合わせで使い方が広がる\r\n\r\n◼️今回はA5サイズ(便箋サイズ)で試す\r\n試してもらうのは以下の商品\r\n○【トレーセット20人】\r\n・A5用紙トレー：1個\r\n・1×1：2個\r\n・1×2 : 2個\r\n費用→650\r\n・木材ー150\r\n・塗料ー300\r\n・送料ー200\r\n\r\n○【引出しセット5人】\r\n・引出しユニット：1個\r\n・A5用紙トレー：4個\r\n・1×1：7個\r\n・1×2：3個\r\n・1×3：1個\r\n・2×2：1個\r\n材料費→2020円\r\n・木材ー720円\r\n・塗料ー1500÷3=500\r\n・送料ー800\r\n\r\n◼️売上見込み\r\n・モニター応募人数：100\r\n・100RTから派生するインプレッション数：36000\r\n・インプレッション数の内商品リンクへ飛ぶ割合3%\r\n・商品ページに来る数：1080\r\n・購入に至る割合1%\r\n・購入する数：10.8\r\n・客単価：3000\r\n・売上見込み：3000×10.8=32400円\r\n\r\n\r\n', '2020-10-12 09:14:14', '2020-10-12 09:14:14'),
(6, 13, 2, 'テストです', 'オリジナルの収納家具シリーズを製作販売する。\r\n現状試作を進めている段階。\r\n\r\nまず、ある程度の数の人に実際に使ってもらうことから\r\n販売に繋げていきたい。\r\n\r\n【方法】\r\n・試作品として引出しセット5セット、トレーセット20セットを製作。\r\n・モニターを募集する(=告知①)\r\n・感想を集める\r\n・感想をもとに商品の改良\r\n・販売開始(=告知②)\r\n・販売\r\n\r\n\r\n【商品説明、特徴】\r\n意匠性：懐かしさを感じるレトロな雰囲気\r\n機能性：コピー用紙サイズを基本とした寸法体系\r\n拡張性：組み合わせで使い方が広がる\r\n\r\n今回はA5サイズ(便箋サイズ)で試す\r\n試してもらうのは以下の商品\r\n【トレーセット20人】\r\n・A5用紙トレー：1個\r\n・1×1：2個\r\n・1×2 : 2個\r\n費用→650\r\n・木材ー150\r\n・塗料ー300\r\n・送料ー200\r\n\r\n【引出しセット5人】\r\n・引出しユニット：1個\r\n・A5用紙トレー：4個\r\n・1×1：7個\r\n・1×2：3個\r\n・1×3：1個\r\n・2×2：1個\r\n材料費→2020円\r\n・木材ー720円\r\n・塗料ー1500÷3=500\r\n・送料ー800\r\n\r\n◼️売上見込み\r\n・モニター応募人数：100\r\n・100RTから派生するインプレッション数：36000\r\n・インプレッション数の内商品リンクへ飛ぶ割合3%\r\n・商品ページに来る数：1080\r\n・購入に至る割合1%\r\n・購入する数：10.8\r\n・客単価：3000\r\n・売上見込み：3000×10.8=32400円\r\n\r\n\r\n', '2020-10-12 09:15:11', '2020-10-12 09:15:11'),
(7, 15, 2, 'インプレッション数確保のための修正', '◼️応募要件の変更\r\n100件の応募があるのはリアリティがない気がする。\r\n・RTで応募→画像付きでSNSへ投稿\r\nそれに対しいいねやコメント、シェアを行う\r\n◼️インプレッション数再計算\r\n・25件の投稿がある。\r\n・二人でシェアすると3000くらいのインプレッションがある\r\n→3000×25=75000インプレッション\r\n・クリック率を変更ー3%→1.5%\r\nすると75000×1.5%=1125件のアクセス\r\n・購入に至る割合1%とすると\r\n1125×11.25人\r\n・客単価3000円とすると\r\n11.25×3000=33750\r\n\r\n\r\nーーーーーー\r\n・インプレッション数はほぼ倍増すると同時に確実性があがる\r\n・クリック率を3%から1.5%に変更したため、売上はほぼ変わらない。\r\n(ちなみに、3%のままで計算すれば、売上は67500円、手元に残るのが44400円となる)\r\n\r\n', '2020-10-14 01:57:10', '2020-10-14 01:57:10'),
(8, 16, 2, 'クリック率の検討', '繰り返しこの商品に関する情報に触れることになるので、\r\nもしかしたらクリック率はアップするかもしれない。\r\n\r\n3%→5%となれば、\r\n75000×5%×1%×3000円=11万2500円の売上(手元に残るのは89400円)となる。\r\n\r\n\r\nーーーー\r\nどの計算が、もっとも適切かは実際にやってみないことにはわからない・・・\r\n\r\n', '2020-10-14 02:09:09', '2020-10-14 02:09:09'),
(9, 22, 2, 'おが屑を燻製用のチップとして販売', '木工製作の副産物として出るおが屑を「燻製用のチップ」として販売する。\r\n一個300円で10個売ったらどのくらいの儲けになるのか計算してみた。\r\n\r\n【必要なもの】\r\n・おが屑(木工してて出るものなので０円)\r\n・ジップロック(10枚110円)\r\n・A4封筒(10枚110円)\r\n\r\n【配送方法】\r\n・クリックポスト(198円)\r\n\r\n【販売方法】\r\n・BASEにて\r\n\r\n【告知】\r\n・各種SNS\r\n\r\n【その他】\r\n・BASE決済手数料 300÷100×3+40=49\r\n・サービス手数料300÷10×3=9\r\n\r\nほぼプラマイゼロでした笑\r\n改善の可能性は\r\n・角４封筒でおくる(198→120)\r\n・直売にする(手数料58円→0円)\r\n\r\nすると一個あたり、150～160円くらいの利益になりそう？', '2020-10-18 07:21:05', '2020-10-18 07:21:05'),
(10, 23, 2, '燻製チップ修正その１', '・配送時方法の修正\r\nクリックポスト(198円)→角４封筒(120)\r\n・直売にすると色々面倒なのでそこはBASEをつかうことにした。\r\nその分販売価格を50円あげてみる。\r\n\r\nすると一個当たり150円の利益になる。\r\n', '2020-10-18 10:40:03', '2020-10-18 10:40:03'),
(11, 24, 2, '燻製チップ修正その１', '・配送時方法の修正\r\nクリックポスト(198円)→角４封筒(120)\r\n・直売にすると色々面倒なのでそこはBASEをつかうことにした。\r\nその分販売価格を50円あげてみる。\r\n\r\nすると一個当たり150円の利益になる。\r\n', '2020-10-18 10:40:50', '2020-10-18 10:40:50'),
(12, 25, 2, '燻製チップ修正その１', '・配送時方法の修正\r\nクリックポスト(198円)→角４封筒(120)\r\n・直売にすると色々面倒なのでそこはBASEをつかうことにした。\r\nその分販売価格を50円あげてみる。\r\n\r\nすると一個当たり150円の利益になる。\r\n', '2020-10-18 10:41:07', '2020-10-18 10:41:07'),
(13, 26, 2, '燻製チップ修正その１', '・配送時方法の修正\r\nクリックポスト(198円)→角４封筒(120)\r\n・直売にすると色々面倒なのでそこはBASEをつかうことにした。\r\nその分販売価格を50円あげてみる。\r\n\r\nすると一個当たり150円の利益になる。\r\n', '2020-10-18 10:42:55', '2020-10-18 10:42:55'),
(14, 27, 2, '燻製チップ修正その１', '・配送時方法の修正\r\nクリックポスト(198円)→角４封筒(120)\r\n・直売にすると色々面倒なのでそこはBASEをつかうことにした。\r\nその分販売価格を50円あげてみる。\r\n\r\nすると一個当たり150円の利益になる。\r\n', '2020-10-18 10:43:15', '2020-10-18 10:43:15'),
(15, 36, 2, 'ニワトリを飼って卵を頂く', 'ニワトリを飼って卵をいただく。\r\n\r\n鶏は生後120日から2歳(約生後700日)ごろの期間でだいたい300～400個の卵を産むそうです。だいたい１日に１つ産むか産まないかという感じみたいですね。\r\n\r\nスーパーでは10個で128円で売ってるので、\r\n300個で128×30=3840円\r\n400個で128×40=5120円\r\nということになります。\r\n毎日卵を食べたいので、ここでは２話飼うことにします。\r\nすると、浮くであろう金額は２年間で7000～1万円くらいという計算になります。\r\n\r\n掛かるお金は\r\n・ニワトリ２羽：2000円×2=4000円(生後120日)\r\n・鶏小屋：基本的に廃材を利用してつくる。6000円\r\n・エサは野菜屑をあげる。\r\n', '2020-10-21 20:37:53', '2020-10-21 20:37:53');

-- --------------------------------------------------------

--
-- テーブルの構造 `nae_costs`
--

CREATE TABLE IF NOT EXISTS `nae_costs` (
  `nae_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  PRIMARY KEY (`nae_id`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `nae_costs`
--

INSERT INTO `nae_costs` (`nae_id`, `num`, `name`, `amount`, `volume`) VALUES
(1, 1, 'か', 300, 5),
(1, 2, 'き', 400, 10),
(1, 3, 'く', 300, 200),
(1, 4, 'け', 200, 6),
(1, 5, 'こ', 105, 6),
(2, 1, 'K', 300, 200),
(3, 1, 'い', 300, 5),
(4, 1, '400', 10000, 50),
(5, 1, '引出し(材料+送料)', 2020, 5),
(5, 2, 'トレー(材料費+送料', 650, 20),
(6, 1, 'G', 200, 0),
(7, 1, '送料、材料費', 23100, 1),
(8, 1, '材料、送料', 23100, 1),
(9, 1, 'ジップロック', 110, 1),
(9, 2, '封筒', 110, 1),
(9, 3, '送料', 198, 10),
(9, 4, '決済手数料', 49, 10),
(9, 5, 'サービス利用料', 9, 10),
(10, 1, '封筒', 110, 1),
(10, 2, '送料', 120, 10),
(10, 3, 'ジップロック', 110, 1),
(10, 4, 'ベイス手数料', 58, 10),
(11, 1, '封筒', 110, 1),
(11, 2, '送料', 120, 10),
(11, 3, 'ジップロック', 110, 1),
(11, 4, 'ベイス手数料', 58, 10),
(12, 1, '封筒', 110, 1),
(12, 2, '送料', 120, 10),
(12, 3, 'ジップロック', 110, 1),
(12, 4, 'ベイス手数料', 58, 10),
(13, 1, '封筒', 110, 1),
(13, 2, '送料', 120, 10),
(13, 3, 'ジップロック', 110, 1),
(13, 4, 'ベイス手数料', 58, 10),
(14, 1, '封筒', 110, 1),
(14, 2, '送料', 120, 10),
(14, 3, 'ジップロック', 110, 1),
(14, 4, 'ベイス手数料', 58, 10),
(15, 1, '鶏(生後120日)', 2000, 2),
(15, 2, '鶏小屋', 6000, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `nae_imgs`
--

CREATE TABLE IF NOT EXISTS `nae_imgs` (
  `nae_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nae_id`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `nae_imgs`
--

INSERT INTO `nae_imgs` (`nae_id`, `num`, `img`) VALUES
(3, 1, 'd2d6f6fa7f848237b79d67c611d3b6a0de2f1880.jpeg'),
(5, 1, 'a68a0b2b788aaad74dc311788b37e14e95c199e3.jpeg'),
(5, 2, '5fc40f8c06b502c767670fd24b2a0ce1fdcd4e9c.jpeg'),
(5, 3, '4eb4344b34165ce8f419989b7f74863de906e594.jpeg'),
(5, 4, 'c9ee48f96ff17bc916d60534339c1a6a43b3cb17.jpeg'),
(9, 1, 'd11dbb625e65cddb57002497b0771bcd7f7136ef.jpeg');

-- --------------------------------------------------------

--
-- テーブルの構造 `nae_incomes`
--

CREATE TABLE IF NOT EXISTS `nae_incomes` (
  `nae_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  PRIMARY KEY (`nae_id`,`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `nae_incomes`
--

INSERT INTO `nae_incomes` (`nae_id`, `num`, `name`, `amount`, `volume`) VALUES
(1, 1, 'あ', 300, 3),
(1, 2, 'い', 200, 4),
(1, 3, 'う', 1000, 6),
(1, 4, 'え', 800, 5),
(1, 5, 'お', 750, 700),
(2, 1, 'な', 100, 13),
(3, 1, 'あ', 500, 5),
(4, 1, '参加費', 500, 10000),
(5, 1, '売上', 3000, 11),
(6, 1, 'テストです', 300, 20),
(7, 1, '売上', 3000, 11),
(8, 1, '売上', 3000, 38),
(9, 1, '売上', 300, 10),
(10, 1, '売上', 350, 10),
(11, 1, '売上', 350, 10),
(12, 1, '売上', 350, 10),
(13, 1, '売上', 350, 10),
(14, 1, '売上', 350, 10),
(15, 1, '卵を買うはずのお金', 128, 80);

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delete_flg` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `type`, `user_id`, `delete_flg`) VALUES
(1, 'tane', 2, 0),
(2, 'tane', 2, 0),
(3, 'nae', 2, 0),
(4, 'nae', 2, 0),
(5, 'mi', 2, 0),
(6, 'mi', 2, 0),
(7, 'tane', 2, 0),
(8, 'nae', 2, 0),
(9, 'mi', 2, 0),
(10, 'tane', 3, 0),
(11, 'nae', 2, 0),
(12, 'nae', 2, NULL),
(13, 'nae', 2, 0),
(14, 'tane', 2, NULL),
(15, 'nae', 2, NULL),
(16, 'nae', 2, NULL),
(17, 'tane', 2, NULL),
(18, 'tane', 2, 0),
(19, 'tane', 2, NULL),
(20, 'tane', 8, NULL),
(21, 'tane', 2, NULL),
(22, 'nae', 2, NULL),
(23, 'nae', 2, NULL),
(24, 'nae', 2, 0),
(25, 'nae', 2, 0),
(26, 'nae', 2, 0),
(27, 'nae', 2, 0),
(28, 'tane', 9, 0),
(29, 'tane', 9, NULL),
(30, 'tane', 2, NULL),
(31, 'tane', 2, NULL),
(32, 'tane', 2, NULL),
(33, 'tane', 8, NULL),
(34, 'tane', 8, NULL),
(35, 'tane', 2, 0),
(36, 'nae', 2, NULL),
(37, 'tane', 2, NULL),
(38, 'tane', 3, NULL),
(39, 'tane', 3, NULL),
(40, 'tane', 2, 0),
(41, 'tane', 2, 0),
(42, 'tane', 8, NULL),
(43, 'tane', 2, NULL),
(44, 'tane', 2, NULL),
(45, 'tane', 2, 0),
(46, 'tane', 8, NULL),
(47, 'tane', 2, NULL),
(48, 'tane', 2, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `post_goods`
--

CREATE TABLE IF NOT EXISTS `post_goods` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `post_goods`
--

INSERT INTO `post_goods` (`user_id`, `post_id`, `post_time`) VALUES
(2, 2, '2020-10-12 00:17:51'),
(2, 3, '2020-10-12 00:20:59'),
(2, 6, '2020-10-12 00:56:38'),
(2, 12, '2020-10-17 19:43:25'),
(2, 13, '2020-10-12 13:12:54'),
(2, 16, '2020-10-17 19:42:51'),
(2, 17, '2020-10-17 21:28:02'),
(2, 19, '2020-10-17 21:28:48'),
(2, 22, '2020-10-19 02:15:58'),
(2, 31, '2020-10-19 02:12:38'),
(2, 32, '2020-10-19 16:03:39'),
(2, 36, '2020-10-24 17:58:26'),
(2, 37, '2020-10-24 17:58:24'),
(2, 43, '2020-11-07 14:05:56'),
(2, 44, '2020-11-11 11:22:27'),
(3, 10, '2020-10-12 06:52:41'),
(3, 38, '2020-10-30 18:30:29'),
(8, 20, '2020-10-17 22:17:10'),
(8, 42, '2020-10-31 11:27:14'),
(8, 46, '2020-11-13 20:34:32'),
(9, 29, '2020-10-18 11:13:46');

-- --------------------------------------------------------

--
-- テーブルの構造 `post_references`
--

CREATE TABLE IF NOT EXISTS `post_references` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ancestor_id` int(11) DEFAULT NULL,
  `descendant_id` int(11) DEFAULT NULL,
  `path_length` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ancestor_id` (`ancestor_id`),
  KEY `descendant_id` (`descendant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- テーブルのデータのダンプ `post_references`
--

INSERT INTO `post_references` (`id`, `ancestor_id`, `descendant_id`, `path_length`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 0),
(3, 3, 3, 0),
(4, 4, 4, 0),
(5, 5, 5, 0),
(6, 6, 6, 0),
(7, 6, 7, 1),
(8, 7, 7, 0),
(9, 7, 8, 2),
(10, 7, 8, 1),
(11, 8, 8, 0),
(12, 6, 9, 1),
(13, 9, 9, 0),
(14, 10, 10, 0),
(15, 10, 11, 1),
(16, 11, 11, 0),
(17, 12, 12, 0),
(18, 13, 13, 0),
(19, 12, 14, 1),
(20, 14, 14, 0),
(21, 12, 15, 1),
(22, 15, 15, 0),
(23, 15, 16, 2),
(24, 15, 16, 1),
(25, 16, 16, 0),
(26, 17, 17, 0),
(27, 18, 18, 0),
(28, 19, 19, 0),
(29, 20, 20, 0),
(30, 21, 21, 0),
(31, 22, 22, 0),
(32, 22, 23, 1),
(33, 23, 23, 0),
(34, 22, 24, 1),
(35, 24, 24, 0),
(36, 22, 25, 1),
(37, 25, 25, 0),
(38, 22, 26, 1),
(39, 26, 26, 0),
(40, 22, 27, 1),
(41, 27, 27, 0),
(42, 28, 28, 0),
(43, 29, 29, 0),
(44, 29, 30, 1),
(45, 30, 30, 0),
(46, 31, 31, 0),
(47, 20, 32, 1),
(48, 32, 32, 0),
(49, 20, 33, 2),
(50, 32, 33, 1),
(51, 33, 33, 0),
(52, 22, 34, 2),
(53, 23, 34, 1),
(54, 34, 34, 0),
(55, 35, 35, 0),
(56, 31, 36, 1),
(57, 36, 36, 0),
(58, 37, 37, 0),
(59, 20, 38, 3),
(60, 32, 38, 2),
(61, 33, 38, 1),
(62, 38, 38, 0),
(63, 37, 39, 1),
(64, 39, 39, 0),
(65, 40, 40, 0),
(66, 41, 41, 0),
(67, 20, 42, 4),
(68, 32, 42, 3),
(69, 33, 42, 2),
(70, 38, 42, 1),
(71, 42, 42, 0),
(72, 43, 43, 0),
(73, 44, 44, 0),
(74, 45, 45, 0),
(75, 46, 46, 0),
(76, 46, 47, 1),
(77, 47, 47, 0),
(78, 48, 48, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `post_types`
--

CREATE TABLE IF NOT EXISTS `post_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- テーブルのデータのダンプ `post_types`
--

INSERT INTO `post_types` (`id`, `type`) VALUES
(3, 'mi'),
(2, 'nae'),
(1, 'tane');

-- --------------------------------------------------------

--
-- テーブルの構造 `tanes`
--

CREATE TABLE IF NOT EXISTS `tanes` (
  `tane_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `body` varchar(140) NOT NULL,
  `post_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tane_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- テーブルのデータのダンプ `tanes`
--

INSERT INTO `tanes` (`tane_id`, `post_id`, `user_id`, `title`, `body`, `post_time`) VALUES
(1, 1, 2, 'テスト', 'テスト', '2020-10-11 22:50:40'),
(2, 2, 2, 'テストその②', 'てすとてすと', '2020-10-12 00:17:32'),
(3, 7, 2, 'たねー', 'たねです', '2020-10-12 00:54:14'),
(4, 10, 3, 'aaa', 'てすとだよー', '2020-10-12 00:59:31'),
(5, 14, 2, '追記', '・応募要件に「ビフォー・アフターの画像付きでSNSに投稿してくれる方」というのをいれる。それに対し、いいね、コメント、シェアを行う。', '2020-10-14 01:41:27'),
(6, 17, 2, 'サツマイモ長者', 'そろそろサツマイモの収穫...\r\nいっぱいとれたら販売してみようかな', '2020-10-17 21:07:52'),
(7, 18, 2, 'サツマイモ長者', 'そろそろサツマイモの収穫...\r\nいっぱいとれたら販売してみようかな', '2020-10-17 21:08:16'),
(8, 19, 2, 'ユズネードを売る', '地元特産のユズを使ったユズネードを売ってみる。\r\n何か許可必要なのかな。', '2020-10-17 21:09:56'),
(9, 20, 8, '自転車移動中にできること', '自転車で片道30分、1週間で3,4時間くらいは漕いでるかもしれません。1ヶ月で大学の講義2単位分くらい。\r\nその間に何かうまく学んだりできれば、すごく活用できそう。', '2020-10-17 21:59:32'),
(10, 21, 2, 'おが屑の活用', '桜とかウォルナットのおが屑が大量に出る。\r\n燻製用のチップとして使えるみたいだけど他に何かつかい道ないかな？', '2020-10-18 06:58:09'),
(11, 28, 9, 'お米の需要を増やす', '米の需要が減っていて、耕作放棄地が増えるとか色々問題があるらしい。米よりパンっていう人が増えているなら、米粉にしてパンをつくったらいいんじゃないかな？手始めに、たくさんとれて余っているお米をもらって、米粉パンにして返すとか面白そう。好評なら売りはじめてみるとか。', '2020-10-18 10:52:39'),
(12, 29, 9, 'お米をパンにしては？', '米の需要が減っていて、耕作放棄地が増えるとか色々問題があるらしい。米よりパンっていう人が増えているなら、米粉にしてパンをつくったらいいんじゃないかな？手始めに、たくさんとれて余っているお米をもらって、米粉パンにして返すとか面白そう。好評なら売りはじめてみるとか。', '2020-10-18 10:53:39'),
(13, 30, 2, '米粉のパン', 'なんかよさそうですね。\r\n９月頃になると、去年のお米余ってるけどいる？と言われることがあるので、\r\nそういうのでやってみたら面白そう。\r\n\r\n参考になるかわかりませんが、米粉のクレープの記事ありました\r\nhttps://nowinformation.xyz/290.html', '2020-10-18 11:01:16'),
(14, 31, 2, 'ニワトリ作戦', 'ニワトリを飼って卵をいただく', '2020-10-18 13:00:55'),
(15, 32, 2, 'Re:自動車移動中にできること', '円周率を覚えるのはどうでしょう', '2020-10-18 13:30:06'),
(16, 33, 8, 'Re: 自転車移動中にできること', '場所と桁数を結びつけて暗記したら捗るかも？\r\n円周率全然覚えようとしたことないから、いつかやってみたいなとは思ってた。', '2020-10-19 02:12:26'),
(17, 34, 8, 'Re: 薫製チップ修正その1', '配送料の分を価格に入れてもいい気はしますが、確かに350円はかなり安くて手が出しやすいかも。', '2020-10-19 02:20:57'),
(18, 35, 2, '初期ユーザー獲得の方法', 'どうやったらいいんだろう・・・', '2020-10-19 06:49:39'),
(19, 37, 2, '大学生向け家具のレンタルサービス', '一人暮らしの大学生向けに家具のレンタルサービスはどうだろう。\r\n卒業して引っ越す時の手間を考えたら所有するよりもレンタルの方が楽なんじゃないか', '2020-10-23 00:00:20'),
(20, 38, 3, '自転車を宣伝につかう', '暗記とか考え事しながら運転するのは個人的に怖いので、\r\n自転車に広告をつけて走る。個人営業の小さいお店とか。広告代をもらう。', '2020-10-24 13:36:13'),
(21, 39, 3, 'レンタルホニャララ', 'レンタル家具使ったことあります。引っ越し時、廃棄の手間がないので便利です。\r\n家具以外にも、短期間必要なものを貸し出すサービスは需要ありそうですね。\r\n教科書とか？', '2020-10-24 13:38:03'),
(22, 40, 2, 'テスト', 'トレー', '2020-10-24 17:47:07'),
(23, 41, 2, 'ポケットティッシュケース', '木でポケットティッシュケースをつくる。', '2020-10-25 15:08:31'),
(24, 42, 8, '自転車宣伝カー', '広告を募集\r\n→掲載してほしい画像を送ってもらう\r\n→プリンタでステッカーに印刷\r\n→車体に貼って走行(車体直は嫌なら、アクリル板を設置して貼るとか...)\r\n通勤みたいに定期的に同じ場所を走っているなら、応募する側も宣伝効果を試算しやすそう。', '2020-10-30 18:30:19'),
(25, 43, 2, 'サツマイモ', '食べきれない', '2020-11-01 17:22:37'),
(26, 44, 2, '麦茶のサブスク', '世のお母さん方は、夏場に麦茶を大量生産するのが大変だという話を聞いた。\r\nウォーターサーバーみたいな感じで麦茶のタンクが家に送られてくる、麦茶のサブスクはどうだろう', '2020-11-07 22:19:11'),
(27, 45, 2, 'テスト', 'テスト\r\nテスト', '2020-11-07 22:19:33'),
(28, 46, 8, '年賀状', '今年は例年よりも人に会えていないから、年賀状を出そうという人が増えているらしいですね', '2020-11-13 01:55:07'),
(29, 47, 2, 'Re:年賀状', 'ハガキにイラストを書いて販売するとかどうでしょう。', '2020-11-21 18:59:59'),
(30, 48, 2, '薫製ブロガー', '色んな樹種のチップでで薫製して味をレポートするブログ', '2020-11-21 19:04:10');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `u_id` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_id` (`u_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `u_id`, `email`, `pass`, `login_time`, `created_date`) VALUES
(1, 'ピート@', 'pete_orchards', 'shotta1026@gmail.com', '$2y$10$dHyFgAvsJjXfs/gAiMFDF.qqRpRFiDjajWibGBNtAz4/i3YoPQIXG', '2020-10-11 01:28:55', '2020-10-11 01:28:55'),
(2, '太田潤  | 猫の皿', 'junota', 'junnoota@gmail.com', '$2y$10$yxiQrUbrOZliMGXLEZrIkugLYGz/haMAzlW9OtyO316WCvxUqkK86', '2020-10-11 07:47:42', '2020-10-11 07:47:42'),
(3, 'おすし', 'osushi0510', 'nao2010ok@gmail.com', '$2y$10$e2iPDdQeIdTWn2Oi7SNqGOHlnLGICnl.rSGpbDETRxP4cW4i26BTu', '2020-10-12 00:58:44', '2020-10-12 00:58:44'),
(4, 'Orchards公式', 'orchards', 'Info@o-rchards.com', '$2y$10$3egh.A3PubsIgL7DesNjAuA2AYyW1dDyM/RJxVVDSLgQpob.Oomau', '2020-10-17 19:37:28', '2020-10-17 19:37:28'),
(8, 'ピート@Orchards', 'pete', 's_art_hot@ezweb.ne.jp', '$2y$10$oiniBt/HNFFl5ADB8KLEaOLBOOLf40raNdeT9vHkXTmwf2SY/jdRu', '2020-10-17 21:23:40', '2020-10-17 21:23:40'),
(9, 'ミカ', 'myiukzau', 'mika.pen.32@gmail.com', '$2y$10$q49sB/Y/t1CXjqAnu9MeJuwC559XZlPjCGcOHW3OBjtB1xIjha29i', '2020-10-17 22:22:10', '2020-10-17 22:22:10');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_baskets`
--

CREATE TABLE IF NOT EXISTS `user_baskets` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user_baskets`
--

INSERT INTO `user_baskets` (`user_id`, `post_id`, `post_time`) VALUES
(2, 12, '2020-10-17 19:43:28'),
(2, 44, '2020-11-11 11:23:05');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL,
  `prof_comment` varchar(255) DEFAULT NULL,
  `prof_img` varchar(255) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `user_details`
--

INSERT INTO `user_details` (`user_id`, `prof_comment`, `prof_img`, `location`, `url`, `tel`, `birthday`) VALUES
(1, NULL, 'e055a8c7341f3915efc1b6e3b55af5aae554a58c.png', NULL, NULL, NULL, NULL),
(2, 'Orchards運営のひとりです。\r\n「猫の皿」という名前で木工品の製作販売をしています。\r\n岐阜県恵那市でゆるい田舎暮らしを満喫中。\r\n', '87ea8309843f8967afe80f1b68107908eb62a334.jpeg', '岐阜県恵那市', 'http://neco-sara.com', NULL, NULL),
(3, '絵を描いたりします。\r\nwebデザイン勉強中。\r\n好きな寿司は赤貝です。', '66e5694db076220557eb85bed92907909d8e56c8.png', '', 'https://mobile.twitter.com/anyway_osushi', NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '絵描き、プログラミング、楽器...etc\r\n最近だとオリジナルエコバッグを作って販売したり。', 'e055a8c7341f3915efc1b6e3b55af5aae554a58c.png', '東京', 'https://twitter.com/s_hottea', NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `mis`
--
ALTER TABLE `mis`
  ADD CONSTRAINT `mis_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mis_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `mi_costs`
--
ALTER TABLE `mi_costs`
  ADD CONSTRAINT `mi_costs_ibfk_1` FOREIGN KEY (`mi_id`) REFERENCES `mis` (`mi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `mi_imgs`
--
ALTER TABLE `mi_imgs`
  ADD CONSTRAINT `mi_imgs_ibfk_1` FOREIGN KEY (`mi_id`) REFERENCES `mis` (`mi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `mi_incomes`
--
ALTER TABLE `mi_incomes`
  ADD CONSTRAINT `mi_incomes_ibfk_1` FOREIGN KEY (`mi_id`) REFERENCES `mis` (`mi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `naes`
--
ALTER TABLE `naes`
  ADD CONSTRAINT `naes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `naes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `nae_costs`
--
ALTER TABLE `nae_costs`
  ADD CONSTRAINT `nae_costs_ibfk_1` FOREIGN KEY (`nae_id`) REFERENCES `naes` (`nae_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `nae_imgs`
--
ALTER TABLE `nae_imgs`
  ADD CONSTRAINT `nae_imgs_ibfk_1` FOREIGN KEY (`nae_id`) REFERENCES `naes` (`nae_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `nae_incomes`
--
ALTER TABLE `nae_incomes`
  ADD CONSTRAINT `nae_incomes_ibfk_1` FOREIGN KEY (`nae_id`) REFERENCES `naes` (`nae_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`type`) REFERENCES `post_types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `post_goods`
--
ALTER TABLE `post_goods`
  ADD CONSTRAINT `post_goods_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_goods_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `post_references`
--
ALTER TABLE `post_references`
  ADD CONSTRAINT `post_references_ibfk_1` FOREIGN KEY (`ancestor_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `post_references_ibfk_2` FOREIGN KEY (`descendant_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- テーブルの制約 `tanes`
--
ALTER TABLE `tanes`
  ADD CONSTRAINT `tanes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `user_baskets`
--
ALTER TABLE `user_baskets`
  ADD CONSTRAINT `user_baskets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_baskets_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- テーブルの制約 `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
