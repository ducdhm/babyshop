-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2013 at 10:21 PM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bobkhin_babyshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Xe đạp'),
(6, 'Xe đẩy'),
(7, 'Xe 3 bánh trẻ em'),
(8, 'Xe lắc'),
(9, 'Xe tập đi'),
(10, 'Xe trượt'),
(11, 'Tủ nhựa'),
(12, 'Nôi & võng'),
(13, 'Giường gấp'),
(14, 'Đồ chơi'),
(15, 'Đồ gỗ'),
(16, 'học tập'),
(17, 'ôtô trẻ em');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `name`, `address`, `phone`, `email`, `website`) VALUES
(1, 'Anh Minh', 'Ki-ốt 12 & 13, Cổng bắc, chợ Quán Toan, Quán Toan, Hồng Bàng, Hải Phòng', '0164 899 3689', 'info@babyshop.ws', 'www.babyshop.ws');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cate_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `photo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=115 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cate_id`, `price`, `photo`) VALUES
(1, 'Xe đạp', 5, 670000, 'product_1351665734_993883696'),
(4, 'Xe đạp', 5, 480000, 'product_1351666350_863737583'),
(5, 'Xe đạp', 5, 480000, 'product_1351666382_305827103'),
(6, 'Xe đạp', 5, 480000, 'product_1351666407_1877818074'),
(7, 'Xe đạp', 5, 480000, 'product_1351666439_455881911'),
(8, 'Xe đạp', 5, 590000, 'product_1351666477_864437391'),
(9, 'Xe đạp', 5, 460000, 'product_1351666543_663076564'),
(10, 'Xe đạp', 5, 460000, 'product_1351666572_1356939233'),
(11, 'Xe đạp', 5, 460000, 'product_1351666592_1192851048'),
(12, 'Xe đạp', 5, 665000, 'product_1351666627_1625492758'),
(13, 'Xe 3 bánh gấu Pooh', 7, 295000, 'product_1351667136_230783540'),
(14, 'Xe 3 bánh bò sữa có nhạc', 7, 580000, 'product_1351667233_1876816102'),
(15, 'Xe 3 bánh bò sữa', 7, 630000, 'product_1351667685_247919006'),
(16, 'Xe 3 bánh hình chuột mickey có nhạc', 7, 430000, 'product_1351668234_1170902401'),
(17, 'Xe 3 bánh hình mèo Kitty ', 7, 380000, 'product_1351668364_1347773435'),
(18, 'xe 3 bánh hình con vịt Donald', 7, 380000, 'product_1351668397_1847974324'),
(19, 'Xe 3 bánh @', 7, 630000, 'product_1351668481_231461449'),
(20, 'Xe 3 bánh @', 7, 630000, 'product_1351668529_2111481945'),
(21, 'Xe 3 bánh mèo', 7, 520000, 'product_1351668552_168188163'),
(22, 'Xe kiến', 7, 250000, 'product_1351668801_230071807'),
(23, 'Xe thỏ', 7, 190000, 'product_1351668855_899209570'),
(24, 'Xe đẩy lưới(S686)', 6, 520000, 'product_1351669017_294303132'),
(25, 'Xe đẩy lưới(808)', 6, 760000, 'product_1351669062_1585386919'),
(26, 'Xe đẩy trẻ em 2 chiều (3017B)', 6, 7400000, 'product_1351669100_961878762'),
(27, 'Xe lắc hình con ong xanh dương', 8, 385000, 'product_1351669288_1744960861'),
(28, 'Xe lắc hình ôtô(3388)', 8, 375000, 'product_1351669947_1891575951'),
(29, 'Xe lắc có nhạc', 8, 375000, 'product_1351669549_109755111'),
(30, 'Xe lắc(2268)', 8, 270000, 'product_1351680089_1618744400'),
(31, 'Xe lắc đèn', 8, 340000, 'product_1351669800_1060987558'),
(32, 'Xe lắc ong', 8, 385000, 'product_1351669846_1883583029'),
(33, 'Xe lắc hình ôtô(3388)', 8, 375000, 'product_1351680202_620047253'),
(34, 'Xe trượt', 10, 310000, 'product_1351680537_467412017'),
(35, 'tập đi gỗ', 9, 310000, 'product_1351680894_115530894'),
(36, 'Xe tập đi(817)', 9, 265000, 'product_1351681281_848476574'),
(37, 'Xe tập đi (thỏ bập bênh)', 9, 640000, 'product_1351681353_1477580488'),
(38, 'Xe tập đi (314B)', 9, 280000, 'product_1351681392_1791941981'),
(39, 'Xe tập đi (817)', 9, 265000, 'product_1351681424_1291310726'),
(40, 'Xe tập đi (817)', 9, 265000, 'product_1351681449_620415139'),
(41, 'Xe tập đi (thỏ bập bênh)', 9, 640000, 'product_1351681479_998090356'),
(43, 'Tủ Dại Đồng Tiến (T707)', 11, 1150000, 'product_1351681661_187596674'),
(44, 'Tủ Nhựa Duy Tân 5 tầng', 11, 1320000, 'product_1351681728_753149679'),
(45, 'Nôi (2 sao)', 12, 995000, 'product_1351681920_787385423'),
(46, 'Nôi (1 sao)', 12, 915000, 'product_1351681954_944899963'),
(47, 'tủ ĐẠI ĐỒNG TIẾN (TỦ vic T 740 )', 11, 1350000, 'product_1351913587_1737297301'),
(48, 'TỦ ĐẠI ĐỒNG TIẾN (VIC )', 11, 1150000, 'product_1351913885_1375433021'),
(49, 'TỦ ĐẠI ĐỒNG TIẾN ( TỦ VIC T707 )', 11, 1150000, 'product_1351914019_1397029309'),
(50, 'TỦ ĐẠI ĐỒNG TIẾN ( TỦ VIC T707 )', 11, 1150000, 'product_1351914142_749638408'),
(51, 'tủ ĐẠI ĐỒNG TIẾN (TỦ vic T 740 )', 11, 1350000, 'product_1351914261_1527570841'),
(52, 'tủ ĐẠI ĐỒNG TIẾN (TỦ vic T 740 )', 11, 1350000, 'product_1351914346_887200570'),
(53, 'TỦ DUY TÂN (taby 4 tầng )', 11, 1100000, 'product_1351914469_644896754'),
(54, 'TỦ DUY TÂN (taby 4 tầng )', 11, 1100000, 'product_1351914710_1794949696'),
(55, 'tủ DUY TÂN ( taby 5 tầng )', 11, 1320000, 'product_1351914797_1101578608'),
(56, 'Tủ DUY TÂN ( taby 5 tầng )', 11, 1320000, 'product_1351914973_274429310'),
(57, 'Tủ DUY TÂN ( taby 5 tầng )', 11, 1320000, 'product_1351915013_1272733547'),
(58, 'Tủ DUY TÂN (taby 3 tầng )', 11, 820000, 'product_1351915067_109809730'),
(59, 'NÔI ĐIỆN ( 3 sao )', 12, 1350000, 'product_1351916198_1979327106'),
(60, 'VÕNG XẾP DUY LỢI ( LOẠI NHỎ )', 12, 825000, 'product_1351916600_1564149168'),
(61, 'GIƯỜNG GẤP', 13, 320000, 'product_1351916965_585055145'),
(62, 'Tủ DUY TÂN (taby 3 tầng )', 11, 820000, 'product_1351928062_270130173'),
(63, 'TỦ VIỆT NHẬT (3 tầng )', 11, 540000, 'product_1352083124_1884222513'),
(64, 'tủ DUY TÂN ( taby 5 tầng )', 11, 1320000, 'product_1352083477_1207053079'),
(65, 'tủ VIỆT NHẬT ( 5 ngăn )', 11, 1220000, 'product_1352083609_1098792120'),
(67, 'XE ĐẠP 114 kitty', 5, 540000, 'product_1352095447_183236512'),
(68, 'Ngựa bập bênh', 14, 510000, 'product_1352096129_1806384823'),
(69, 'thú nhún', 14, 130000, 'product_1352096719_839649533'),
(70, 'thú nhún', 14, 130000, 'product_1352096856_1736165814'),
(71, 'thú nhún', 14, 130000, 'product_1352096894_1450651237'),
(72, 'xe lưới bé', 14, 60000, 'product_1352097347_2141788811'),
(73, 'ôtô khiển (3393 )', 14, 155000, 'product_1352098116_1520448482'),
(74, 'Đồng hồ con vật', 15, 75000, 'product_1352099095_221359505'),
(75, 'đồng hồ con vật', 15, 75000, 'product_1352099175_79311194'),
(76, 'otô gỗ', 15, 160000, 'product_1352099291_201697678'),
(77, 'Nhà thả số', 15, 210000, 'product_1352099354_1052489346'),
(78, 'Đàn kéo', 15, 145000, 'product_1352099400_830066902'),
(79, 'bảng chữ cái', 15, 210000, 'product_1352099465_1873721337'),
(80, 'bảng số', 15, 50000, 'product_1352099512_111745608'),
(81, 'chữ điện tử', 16, 75000, 'product_1352176569_495087138'),
(82, 'Máy học tiếng anh - việt', 16, 155000, 'product_1352176633_95255098'),
(83, 'máy học tiếng việt', 16, 95000, 'product_1352176696_1947613632'),
(84, 'máy học tiếng anh - việt', 16, 155000, 'product_1352176771_1739412342'),
(85, 'Ôtô đẩy ( 3111 )', 7, 540000, 'product_1352178400_259179421'),
(86, 'Xe đạp 12 thái', 5, 690000, 'product_1352450587_2085628949'),
(87, 'XE 106 F', 7, 640000, 'product_1352450699_1817369123'),
(88, 'Lắcmáy bay', 8, 360000, 'product_1352877007_670910532'),
(89, 'xe đạp cốp', 5, 640000, 'product_1352878138_1808909844'),
(90, 'xe đạp 1281', 5, 670000, 'product_1352878435_2098731658'),
(91, 'xe đạp 1281', 5, 670000, 'product_1352878620_1475317477'),
(92, 'Lắc vịt', 8, 470000, 'product_1352879094_1342662875'),
(93, 'xe lắc 8016', 8, 390000, 'product_1353041773_1760250076'),
(94, 'tủ song long 4 tầng T111', 11, 670000, 'product_1353042906_412077210'),
(95, 'song long lớn 4 tầng M4T', 11, 850000, 'product_1353043224_1675139179'),
(96, 'võng duy phương ( nhỏ )', 12, 420000, 'product_1353044709_1948305362'),
(97, 'võng duy phương ( lớn )', 12, 450000, 'product_1353045408_1927473363'),
(98, 'võng duy phương ( lớn )', 12, 925000, 'product_1353303728_1898468833'),
(99, 'tủ sumi DUY TÂN 5 tầng', 11, 1280000, 'product_1353472263_98468469'),
(100, 'Tủ RôNa DUY TÂN 5 Tầng ', 11, 1300000, 'product_1353472825_841449816'),
(101, 'tủ sumi DUY TÂN 5 tầng', 11, 1280000, 'product_1353476651_887551574'),
(102, 'tủ pan da Song Long 5 tầng', 11, 1280000, 'product_1354258343_699775979'),
(103, 'Tập đi vịt ', 9, 330000, 'product_1354515107_2124443542'),
(104, 'tập đi gấu', 9, 330000, 'product_1354515448_433295333'),
(105, 'may bay T154', 14, 90000, 'product_1355215577_1237829616'),
(106, 'may bay khach', 14, 105000, 'product_1355728302_753798060'),
(107, 'xe 106 F', 7, 640000, 'product_1355728711_2120483121'),
(108, 'Xe day 737 E', 6, 920000, 'product_1355729166_2095186191'),
(109, 'ôtô bộ đội xanh', 17, 2950000, 'product_1362882220_1016889753'),
(110, 'ôtô 88', 17, 1850000, 'product_1362882468_46786985'),
(111, 'ôtô bộ đội đỏ', 17, 2950000, 'product_1362882587_14256538'),
(112, 'ôtô 38 vàng', 17, 1850000, 'product_1362882996_2055303784'),
(113, 'ôtô 68 đỏ', 17, 2050000, 'product_1362883106_1071994778'),
(114, 'ôtô 19 đỏ', 17, 2350000, 'product_1362883188_1797201563');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '192e7e7c3ae7428ba924c5c34fd2923e'),
(2, 'vanminh', '7e19156721119a9ca94276b32ff64f69');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
         