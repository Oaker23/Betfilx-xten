-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2021 at 01:40 PM
-- Server version: 5.6.43
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp671429_ufavip1688`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `alert` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fname`, `phone`, `alert`, `status`) VALUES
(7, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admi_ufa168', 'admi_ufa168', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `code_itme`
--

CREATE TABLE `code_itme` (
  `id` int(11) NOT NULL,
  `date_check` varchar(200) NOT NULL,
  `date_give` varchar(200) DEFAULT NULL,
  `code` varchar(200) NOT NULL,
  `credit` varchar(200) NOT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `turnover` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `code_itme`
--

INSERT INTO `code_itme` (`id`, `date_check`, `date_give`, `code`, `credit`, `phone`, `turnover`, `status`) VALUES
(427, '24/08/2021', NULL, 'ad6w5i2s3wtxcjz0f5v5cuvoiqvlsdic4g7lykuj', '100', '0643064192', '1000', 1),
(428, '24/08/2021', NULL, 'r5opmds6ydkyv5efhqmld75sh05r6x08s12mp62r', '100', '0809254108', '1000', 1),
(497, '28/08/2021', NULL, 'k3sd4hukm0qtvt48qpcho46hvhkwvmwquwrqbqvw', '10', NULL, '300', 0),
(498, '28/08/2021', NULL, '1uj0oqwr1lps8pojfpmf6o6hjovngn7i0a6hhfst', '10', NULL, '300', 0),
(499, '28/08/2021', NULL, 'kqav49d56fq8twvrh8z13fl4lsjwes66is9m1fmh', '10', NULL, '300', 0),
(500, '28/08/2021', NULL, 'zvmldvx4gfaef5s06n51k9xlqmsp6tdwqnbrlbe0', '10', NULL, '300', 0),
(501, '28/08/2021', NULL, '0w0l4i3euxa6shamelkjzwxb0e35ww12q5vwf7oa', '10', NULL, '300', 0),
(502, '28/08/2021', NULL, 'b9l8b8agqzufa1jysrvlltxwpi79gojhjczekoaj', '10', NULL, '300', 0),
(503, '28/08/2021', NULL, 'ijmq227wllures9cy1952tt544bud8la310jugvv', '10', NULL, '300', 0),
(504, '28/08/2021', NULL, 'ay2zumr9fv8f4lz5qwqmylwaarfbk5yhvbr1q3tf', '10', NULL, '300', 0),
(505, '28/08/2021', NULL, 'beccejaaywegxd0z2bxyw9kbq9hcon50f6x7235a', '10', NULL, '300', 0),
(506, '28/08/2021', NULL, 'm8xmlaquq5wf9y5ffiumbzsaaqj98civ905t5in7', '10', NULL, '300', 0),
(507, '29/08/2021', NULL, 'y7vic09rn29rdcr2vbukmz3sxcje3lnq8adqx9b3', '20', NULL, '100', 0),
(508, '29/08/2021', NULL, 'xgeyu8vutr857asr8ihb6xgvztg0ah0yozxuqmjd', '20', NULL, '100', 0),
(509, '29/08/2021', NULL, 'jqnb2dhb7qgsh3b2hvl6hbagwmjcremnt39ufbz4', '20', NULL, '100', 0),
(510, '29/08/2021', NULL, 'zwd52cxromw2kj9r0cp9lojyula482gtv7n9yyal', '20', NULL, '100', 0),
(511, '29/08/2021', NULL, '3p908goj4xpaq754nftg92r3ejawtmiodah74ofh', '20', NULL, '100', 0),
(512, '02/09/2021', NULL, 'wxfijojhfkbayht5jj310m05uqv2wjhcbh9k70pp', '50', NULL, '100', 0),
(513, '02/09/2021', NULL, 'svj5dsv8ee5y8t3aa1nk1ox16zz4ppq466t0fun8', '50', NULL, '100', 0),
(514, '02/09/2021', NULL, '28hq4c1xsmbz0cb5cug38958qzagfak79olhmzhv', '50', NULL, '100', 0),
(515, '02/09/2021', NULL, 'xgovm62wghvdm42dbt9ndtr25xzwmu9cccmd3cd0', '50', NULL, '100', 0),
(516, '02/09/2021', NULL, 'd9y8764sv9vyxwy4s6puppxirs8698jflfxrvppw', '50', NULL, '100', 0);

-- --------------------------------------------------------

--
-- Table structure for table `config_wheel`
--

CREATE TABLE `config_wheel` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `point` int(11) NOT NULL,
  `percent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config_wheel`
--

INSERT INTO `config_wheel` (`id`, `type`, `point`, `percent`) VALUES
(1, 'ไม่ถูกรางวัล', 0, 40),
(2, 'พ้อยท์ 25', 25, 30),
(3, 'พ้อยท์ 50', 50, 20),
(4, 'พ้อยท์ 150', 120, 5),
(5, 'พ้อยท์ 300', 300, 5),
(6, 'จำนวนพ้อยที่หักตอนกดเล่น', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_affliliate`
--

CREATE TABLE `history_affliliate` (
  `id` int(11) NOT NULL,
  `date_check` varchar(200) NOT NULL,
  `time_check` varchar(200) NOT NULL,
  `credit` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_affliliate`
--

INSERT INTO `history_affliliate` (`id`, `date_check`, `time_check`, `credit`, `phone`) VALUES
(1, '27/08/2021', '20:21:57', '5.5', '0643064192');

-- --------------------------------------------------------

--
-- Table structure for table `history_promotion`
--

CREATE TABLE `history_promotion` (
  `id` int(11) NOT NULL,
  `date_check` varchar(200) NOT NULL,
  `time_check` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `promotion` varchar(200) NOT NULL,
  `credit` varchar(200) NOT NULL,
  `turnover` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_promotion`
--

INSERT INTO `history_promotion` (`id`, `date_check`, `time_check`, `name`, `phone`, `promotion`, `credit`, `turnover`) VALUES
(6, '22/08/2021', '04:03:07', 'โปรรายวัน', '0643064192', '1000', '100', '10000'),
(7, '22/08/2021', '04:17:43', 'โปรสมัาชิกใหม่', '0643064192', '300', '100', '1000'),
(8, '23/08/2021', '12:17:53', 'โปรรายวัน', '0643064192', '300', '30', '1000'),
(9, '23/08/2021', '12:22:53', 'โปรรายวัน', '0643064192', '300', '30', '1000'),
(10, '27/08/2021', '12:50:53', 'โปรสมัาชิกใหม่', '0643064192', '300', '100', '1000'),
(11, '27/08/2021', '15:38:01', 'โปรรายวัน', '0643064192', '300', '30', '1000'),
(12, '28/08/2021', '12:44:35', 'ฝากครั้งแรกของวัน', '0643064192', '300', '50', '1000'),
(13, '29/08/2021', '10:37:15', 'ฝากครั้งแรกของวัน', '0971545962', '300', '50', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `history_refund`
--

CREATE TABLE `history_refund` (
  `id` int(11) NOT NULL,
  `date_check` varchar(200) NOT NULL,
  `time_check` varchar(200) NOT NULL,
  `credit` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_refund`
--

INSERT INTO `history_refund` (`id`, `date_check`, `time_check`, `credit`, `phone`) VALUES
(4, '21/08/2021', '17:37:13', '3.5', '0942597774'),
(6, '21/08/2021', '23:22:10', '2', '0809254108'),
(7, '27/08/2021', '04:04:34', '5.6', '0643064192');

-- --------------------------------------------------------

--
-- Table structure for table `history_wheel`
--

CREATE TABLE `history_wheel` (
  `id` int(11) NOT NULL,
  `date_check` varchar(500) NOT NULL,
  `time_check` varchar(500) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `bet` int(11) NOT NULL,
  `credit` varchar(200) NOT NULL,
  `status` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_wheel`
--

INSERT INTO `history_wheel` (`id`, `date_check`, `time_check`, `phone`, `bet`, `credit`, `status`) VALUES
(4, '28/08/2021', '12:53', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(5, '28/08/2021', '12:54', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(7, '28/08/2021', '01:08', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(9, '28/08/2021', '01:09', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(10, '28/08/2021', '01:09', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(11, '28/08/2021', '01:09', '0643064192', 0, '300', 'ได้รางวัล'),
(12, '28/08/2021', '01:09', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(13, '28/08/2021', '01:10', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(14, '28/08/2021', '01:11', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(15, '28/08/2021', '01:11', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(16, '28/08/2021', '01:11', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(17, '28/08/2021', '01:11', '0643064192', 0, '50', 'ได้รางวัล'),
(18, '28/08/2021', '08:00', '0643064192', 0, '50', 'ได้รางวัล'),
(19, '28/08/2021', '11:20', '0643064192', 0, '25', 'ได้รางวัล'),
(20, '28/08/2021', '11:20', '0643064192', 0, '25', 'ได้รางวัล'),
(21, '28/08/2021', '11:26', '0643064192', 0, '300', 'ได้รางวัล'),
(22, '28/08/2021', '11:26', '0643064192', 0, '25', 'ได้รางวัล'),
(23, '28/08/2021', '11:26', '0643064192', 0, '25', 'ได้รางวัล'),
(24, '28/08/2021', '11:26', '0643064192', 0, '25', 'ได้รางวัล'),
(25, '28/08/2021', '11:28', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(26, '28/08/2021', '11:28', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(27, '28/08/2021', '11:28', '0643064192', 0, '', 'ได้รางวัล'),
(28, '28/08/2021', '11:28', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(29, '28/08/2021', '11:28', '0643064192', 0, '50', 'ได้รางวัล'),
(30, '28/08/2021', '11:43', '0643064192', 0, '25', 'ได้รางวัล'),
(31, '29/08/2021', '12:05', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(32, '29/08/2021', '12:06', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(33, '29/08/2021', '12:06', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(34, '29/08/2021', '04:50', '0643064192', 0, '0', 'ไม่ได้รางวัล'),
(36, '29/08/2021', '11:51', '0971545962', 0, '0', 'ไม่ได้รางวัล'),
(37, '30/08/2021', '05:46', '0643064192', 20, '', 'ได้รางวัล'),
(38, '30/08/2021', '05:46', '0643064192', 20, '', 'ได้รางวัล'),
(39, '30/08/2021', '05:46', '0643064192', 20, '0', 'ไม่ได้รางวัล'),
(40, '30/08/2021', '05:47', '0643064192', 20, '0', 'ไม่ได้รางวัล'),
(41, '30/08/2021', '05:47', '0643064192', 20, '0', 'ไม่ได้รางวัล'),
(42, '30/08/2021', '05:47', '0643064192', 20, '300', 'ได้รางวัล'),
(43, '30/08/2021', '05:50', '0643064192', 20, '0', 'ไม่ได้รางวัล'),
(44, '30/08/2021', '05:55', '0643064192', 20, '0', 'ไม่ได้รางวัล'),
(45, '02/09/2021', '00:58:32', '0643064192', 20, '25', 'ได้รางวัล'),
(46, '02/09/2021', '00:09:33', '0643064192', 20, '0', 'ไม่ได้รางวัล'),
(47, '02/09/2021', '00:20:33', '0643064192', 20, '', 'ได้รางวัล'),
(48, '02/09/2021', '00:23:33', '0643064192', 20, '0', 'ไม่ได้รางวัล'),
(49, '02/09/2021', '10:16:20', '0643064192', 20, '0', 'ไม่ได้รางวัล');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `date_check` varchar(200) NOT NULL,
  `time_check` varchar(200) NOT NULL,
  `username_game` varchar(200) DEFAULT NULL,
  `password_game` varchar(200) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `fname` varchar(200) DEFAULT NULL,
  `bank_number` varchar(200) DEFAULT NULL,
  `bank_name` varchar(200) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `credit` varchar(200) NOT NULL DEFAULT '0',
  `credit_refund` varchar(200) DEFAULT NULL,
  `pro_turnover` varchar(200) NOT NULL DEFAULT '0',
  `last_turnover` varchar(200) NOT NULL DEFAULT '0',
  `last_withdraw` varchar(200) DEFAULT NULL,
  `last_refund` varchar(200) DEFAULT NULL,
  `last_login` varchar(200) DEFAULT NULL,
  `refid` varchar(200) DEFAULT NULL,
  `commission_credit` varchar(200) NOT NULL DEFAULT '0',
  `last_commission` varchar(200) NOT NULL DEFAULT '0',
  `date_commission` varchar(200) DEFAULT NULL,
  `status_turnover` int(11) NOT NULL DEFAULT '1',
  `status_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `date_check`, `time_check`, `username_game`, `password_game`, `password`, `fname`, `bank_number`, `bank_name`, `phone`, `credit`, `credit_refund`, `pro_turnover`, `last_turnover`, `last_withdraw`, `last_refund`, `last_login`, `refid`, `commission_credit`, `last_commission`, `date_commission`, `status_turnover`, `status_user`) VALUES
(2, '19/08/2021', '06:05:29', 'vwe4e', 'Aa414277', '56d64c801373d1b9f95dda812ceeeb11', 'นาย ณัฐพงษ์ เชิดสุพรรณ์', '4732082323', 'กสิกรไทย', '0643064192', '101', '0', '200', '', '29/08/2021', '26/08/2021', '02/09/2021', '', '0', '5.5', '27/08/2021', 1, 3),
(35, '02/09/2021', '13:30:36', NULL, NULL, 'a22d511c22e7775f6349c0f1d7f3cf94', NULL, '4723587415', 'กสิกรไทย', '0643064193', '0', NULL, '0', '0', '02/09/2021', '02/09/2021', NULL, '', '0', '0', '02/09/2021', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`id`, `name`, `token`) VALUES
(1, 'สมาชิก สมัครใหม่', 'kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL'),
(2, 'สมาชิก ฝากเงิน', 'kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL'),
(3, 'สมาชิก ถอนเงิน', 'kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL'),
(5, 'แอดมิน ถอนเงิน', 'kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL'),
(6, 'สมาชิก รับยอดเสีย', 'kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL'),
(7, 'สมาชิก รับโบนัส', 'kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL'),
(8, 'สมาชิก เติมโค้ด', 'kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL'),
(9, 'สมาชิก ถอนเงินแนะนำเพื่อน', 'kuFx34n4S4WyxJ86Ee7PAATEcsp1gflmRTNkwc4daiL');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `p_deposit` varchar(200) NOT NULL,
  `p_credit` varchar(200) NOT NULL,
  `turnover` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`p_id`, `p_name`, `p_deposit`, `p_credit`, `turnover`, `image`) VALUES
(24, 'โปรสมัาชิกใหม่', '600.00', '500.00', '5.00', 'upload/img_bonus/6128be5d254e7.jpg'),
(25, 'โปรสมัาชิกใหม่', '1000', '2000.00', '5.00', 'https://cdn.slotgame6666.com/storage/app/public/bonus/htMM3ZPzffxI9JXmlkHNI9QmUMmRWY7HHP7bRzWr.jpeg'),
(33, 'ฝากครั้งแรกของวัน', '300', '50', '1000', 'upload/img_bonus/6128c8be8e758.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `refill`
--

CREATE TABLE `refill` (
  `id` int(11) NOT NULL,
  `refill_id` varchar(200) DEFAULT NULL,
  `date_check` varchar(500) DEFAULT NULL,
  `time_check` varchar(200) DEFAULT NULL,
  `amount` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `buyerBank` varchar(200) DEFAULT NULL,
  `buyerName` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `info` varchar(200) NOT NULL DEFAULT 'AUTO',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `report_game`
--

CREATE TABLE `report_game` (
  `id` int(11) NOT NULL,
  `date_check` varchar(200) NOT NULL,
  `provider` varchar(200) NOT NULL,
  `turnover` varchar(200) NOT NULL,
  `valid_amount` varchar(200) NOT NULL,
  `winloss` varchar(200) NOT NULL,
  `total` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_game`
--

INSERT INTO `report_game` (`id`, `date_check`, `provider`, `turnover`, `valid_amount`, `winloss`, `total`, `phone`) VALUES
(190, '29/08/2021', 'sexy', '20.0000', '20.0000', '-20.0000', '-20.0000', '0643064192'),
(192, '29/08/2021', 'sexy', '20.0000', '20.0000', '-20.0000', '-20.0000', '0971545962'),
(193, '30/08/2021', 'sexy', '20.0000', '20.0000', '-20.0000', '-20.0000', '0643064192'),
(194, '30/08/2021', 'sexy', '20.0000', '20.0000', '-20.0000', '-20.0000', '55555'),
(195, '31/08/2021', 'sexy', '20.0000', '20.0000', '-20.0000', '-20.0000', '0643064192');

-- --------------------------------------------------------

--
-- Table structure for table `scb_info`
--

CREATE TABLE `scb_info` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `banknumber` varchar(200) NOT NULL,
  `bankname` varchar(200) NOT NULL,
  `balance` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scb_info`
--

INSERT INTO `scb_info` (`id`, `fname`, `banknumber`, `bankname`, `balance`, `status`) VALUES
(1, 'ภูวเดช น้อยศิริ', '4130982419', 'ไทยพาณิชย์', '365.72', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testMember`
--

CREATE TABLE `testMember` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `point` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testMember`
--

INSERT INTO `testMember` (`id`, `username`, `point`) VALUES
(1, 'poomttc', 250.00),
(2, '0643064192', 250.00);

-- --------------------------------------------------------

--
-- Table structure for table `turnover`
--

CREATE TABLE `turnover` (
  `id` int(11) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `turnover` varchar(200) NOT NULL,
  `date_check` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `turnover`
--

INSERT INTO `turnover` (`id`, `phone`, `turnover`, `date_check`) VALUES
(1, '0643064192', '80', '25/08/2021'),
(3, '0643064192', '110', '26/08/2021'),
(5, '0643064192', '77', '27/08/2021'),
(6, '0643064192', '', '28/08/2021'),
(7, '', '', '28/08/2021'),
(8, '', '', '29/08/2021'),
(9, '0971545962', '', '29/08/2021'),
(10, '', '0', '02/09/2021'),
(11, '0643064195', '0', '02/09/2021');

-- --------------------------------------------------------

--
-- Table structure for table `user_stock`
--

CREATE TABLE `user_stock` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_stock`
--

INSERT INTO `user_stock` (`id`, `username`, `password`) VALUES
(5147, 'd1wqj', 'Aa193829'),
(5148, 'gssh8', 'Aa580100'),
(5149, 'cmi72', 'Aa756971'),
(5150, 'wmx3j', 'Aa473671'),
(5151, 'c8ooz', 'Aa065687'),
(5152, 'x6pvh', 'Aa163726'),
(5153, 'pzgsg', 'Aa244858'),
(5154, 'jf248', 'Aa840432'),
(5155, 'oivpn', 'Aa096499'),
(5156, 'e0p1z', 'Aa275793'),
(5157, 'i4bnw', 'Aa225172'),
(5158, 'sc12w', 'Aa344160'),
(5159, 'yiw88', 'Aa428148'),
(5160, 'ssyow', 'Aa469280'),
(5161, 'odqyj', 'Aa415382'),
(5162, 'y6fe2', 'Aa348392'),
(5163, '6ttqg', 'Aa601617'),
(5164, '9gpgl', 'Aa331075'),
(5165, 'z8l9x', 'Aa319962');

-- --------------------------------------------------------

--
-- Table structure for table `wait_refill`
--

CREATE TABLE `wait_refill` (
  `id` int(11) NOT NULL,
  `ref` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wait_refill`
--

INSERT INTO `wait_refill` (`id`, `ref`, `price`, `phone`) VALUES
(279, 'YAI136805886', '7', '0889422928'),
(280, 'YAI182135377', '50', '0889422928'),
(281, 'YAI116659861', '1', '0889422928'),
(285, 'YAI182588575', '100', '0888629009'),
(286, 'YAI121473300', '120', '0888629009'),
(290, 'YAI198438886', '100', '0989471798'),
(296, 'YAI112258369', '10', '0955890966'),
(297, 'YAI132448655', '100', '0992676250'),
(301, 'YAI154656637', '100', '0942597774'),
(354, 'YAI124436529', '20', '0643064192'),
(355, 'YAI161001583', '1', '0971545962');

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `keyword` varchar(200) NOT NULL,
  `domain` varchar(200) NOT NULL,
  `line_id` varchar(200) NOT NULL,
  `agent_username` varchar(200) NOT NULL,
  `refund_credit` varchar(1000) NOT NULL,
  `affliliate` varchar(200) NOT NULL,
  `minimum_deposit` varchar(200) NOT NULL DEFAULT '0',
  `minimum_withdraw` varchar(200) NOT NULL DEFAULT '0',
  `max_withdraw` varchar(200) NOT NULL DEFAULT '0',
  `min_refund` varchar(200) NOT NULL DEFAULT '0',
  `min_affliliate` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `logo`, `title`, `keyword`, `domain`, `line_id`, `agent_username`, `refund_credit`, `affliliate`, `minimum_deposit`, `minimum_withdraw`, `max_withdraw`, `min_refund`, `min_affliliate`) VALUES
(1, 'upload/img_logo/613040f615912.jpg', 'UFA168-VIP.COM เกมส์คาสิโนออนไลน์', 'บาคาร่าออนไลน์,ระบบจ่ายAUTO', 'UFA168-VIP.COM', '@UFA168-VIP', 'brkbi', '5%', '5%', '100.00', '300.00', '100000.00', '300.00', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `time_withdraw` varchar(200) NOT NULL,
  `date_withdraw` varchar(200) NOT NULL,
  `credit` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT '1',
  `bank_number` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `info` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code_itme`
--
ALTER TABLE `code_itme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_wheel`
--
ALTER TABLE `config_wheel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_affliliate`
--
ALTER TABLE `history_affliliate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_promotion`
--
ALTER TABLE `history_promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_refund`
--
ALTER TABLE `history_refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_wheel`
--
ALTER TABLE `history_wheel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `refill`
--
ALTER TABLE `refill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_game`
--
ALTER TABLE `report_game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scb_info`
--
ALTER TABLE `scb_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testMember`
--
ALTER TABLE `testMember`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `turnover`
--
ALTER TABLE `turnover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_stock`
--
ALTER TABLE `user_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wait_refill`
--
ALTER TABLE `wait_refill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `code_itme`
--
ALTER TABLE `code_itme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;

--
-- AUTO_INCREMENT for table `config_wheel`
--
ALTER TABLE `config_wheel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `history_affliliate`
--
ALTER TABLE `history_affliliate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history_promotion`
--
ALTER TABLE `history_promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `history_refund`
--
ALTER TABLE `history_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `history_wheel`
--
ALTER TABLE `history_wheel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `refill`
--
ALTER TABLE `refill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `report_game`
--
ALTER TABLE `report_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `scb_info`
--
ALTER TABLE `scb_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testMember`
--
ALTER TABLE `testMember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `turnover`
--
ALTER TABLE `turnover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_stock`
--
ALTER TABLE `user_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5166;

--
-- AUTO_INCREMENT for table `wait_refill`
--
ALTER TABLE `wait_refill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;

--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
