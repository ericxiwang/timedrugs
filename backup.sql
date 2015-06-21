-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-06-14 20:57:09
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- 表的结构 `menu_category`
--

CREATE TABLE IF NOT EXISTS `menu_category` (
`id` int(255) NOT NULL,
  `menu_cate_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `keyword` varchar(100) CHARACTER SET latin1 NOT NULL,
  `reserve` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `menu_category`
--

INSERT INTO `menu_category` (`id`, `menu_cate_name`, `keyword`, `reserve`) VALUES
(34, '心脏保健', '', ''),
(43, '青年系列', '', ''),
(45, '保健系列', '', ''),
(46, '美容系列', '', ''),
(47, '补钙系列', '', ''),
(53, '儿童营养', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ord_product`
--

CREATE TABLE IF NOT EXISTS `ord_product` (
`id` int(40) NOT NULL,
  `pro_uuid` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pro_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pro_img` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pro_amount` varchar(10) CHARACTER SET utf8 NOT NULL,
  `pro_price` varchar(50) CHARACTER SET utf8 NOT NULL,
  `pro_quantity` int(10) NOT NULL,
  `ord_uuid` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `ord_product`
--

INSERT INTO `ord_product` (`id`, `pro_uuid`, `pro_name`, `pro_img`, `pro_amount`, `pro_price`, `pro_quantity`, `ord_uuid`) VALUES
(1, '25345ED5-8F06-6F07-949D-C9562E147C55', '测试1', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '9.99', '9.99', 1, 'A22410E6-2984-3A62-6EC6-46C78912C3E1'),
(2, '44046AC4-572B-1B5D-54ED-3C65BA1FAE06-1429394517', '测试药品', 'image/pro_img/44046AC4-572B-1B5D-54ED-3C65BA1FAE06', '0', '0', 1, 'A22410E6-2984-3A62-6EC6-46C78912C3E1'),
(3, 'D938B0AB-AB4D-954A-226A-DCFB67B74800-1429394550', 'ceshi', 'image/pro_img/D938B0AB-AB4D-954A-226A-DCFB67B74800', '0', '0', 1, 'A22410E6-2984-3A62-6EC6-46C78912C3E1'),
(4, '78267AE2-7FDA-567B-2398-3D336D960F67-1429399131', '测试药品', 'image/pro_img/78267AE2-7FDA-567B-2398-3D336D960F67', '0', '0', 1, 'A22410E6-2984-3A62-6EC6-46C78912C3E1'),
(5, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '5', '5', 1, 'A22410E6-2984-3A62-6EC6-46C78912C3E1'),
(6, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '5', '5', 1, '269669B4-EC41-EE01-39B4-9886C8DFEA99'),
(7, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '200', '100', 2, '269669B4-EC41-EE01-39B4-9886C8DFEA99'),
(8, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '63', '21', 3, '269669B4-EC41-EE01-39B4-9886C8DFEA99'),
(9, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '5', '5', 1, 'FBE40A44-E9A4-9EC4-D7B8-51B766A206C5'),
(10, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '200', '100', 2, 'FBE40A44-E9A4-9EC4-D7B8-51B766A206C5'),
(11, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '63', '21', 3, 'FBE40A44-E9A4-9EC4-D7B8-51B766A206C5'),
(12, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '5', '5', 1, '6662BC91-0FCC-8CE6-D3B0-2B0D0060FE78'),
(13, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '200', '100', 2, '6662BC91-0FCC-8CE6-D3B0-2B0D0060FE78'),
(14, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '63', '21', 3, '6662BC91-0FCC-8CE6-D3B0-2B0D0060FE78'),
(15, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '5', '5', 1, '3E58EC44-4ADE-C766-19D3-74FD5FB9B49B'),
(16, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '200', '100', 2, '3E58EC44-4ADE-C766-19D3-74FD5FB9B49B'),
(17, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '63', '21', 3, '3E58EC44-4ADE-C766-19D3-74FD5FB9B49B'),
(18, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '15', '5', 3, '3E58EC44-4ADE-C766-19D3-74FD5FB9B49B'),
(19, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '5', '5', 1, '470FD9D6-6210-DC9B-55E5-D5710F423189'),
(20, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '200', '100', 2, '470FD9D6-6210-DC9B-55E5-D5710F423189'),
(21, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '63', '21', 3, '470FD9D6-6210-DC9B-55E5-D5710F423189'),
(22, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '15', '5', 3, '470FD9D6-6210-DC9B-55E5-D5710F423189'),
(23, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '200', '100', 2, 'CC3B935E-FAEB-A46C-E953-A7FF4FA75C2D'),
(24, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '63', '21', 3, 'CC3B935E-FAEB-A46C-E953-A7FF4FA75C2D'),
(25, '86CE0DA4-7B4E-9FA1-E79E-FF18FA2C8CC3-1425345872', '测试4', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6', '32', '32', 1, 'CC3B935E-FAEB-A46C-E953-A7FF4FA75C2D'),
(26, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '200', '100', 2, '3E5896CD-7445-4831-1349-B854E0CF5CE8'),
(27, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '63', '21', 3, '3E5896CD-7445-4831-1349-B854E0CF5CE8'),
(28, '86CE0DA4-7B4E-9FA1-E79E-FF18FA2C8CC3-1425345872', '测试4', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '32', '32', 1, '3E5896CD-7445-4831-1349-B854E0CF5CE8'),
(29, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '200', '100', 2, '42999F85-66D7-8697-AF03-C3CD6860BAB2'),
(30, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '63', '21', 3, '42999F85-66D7-8697-AF03-C3CD6860BAB2'),
(31, '86CE0DA4-7B4E-9FA1-E79E-FF18FA2C8CC3-1425345872', '测试4', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '32', '32', 1, '42999F85-66D7-8697-AF03-C3CD6860BAB2'),
(32, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '5', '5', 1, '42999F85-66D7-8697-AF03-C3CD6860BAB2'),
(33, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', '测试2', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '200', '100', 2, '36089624-FFB8-38ED-BF6B-5B99E7668B1A'),
(34, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', '测试3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '63', '21', 3, '36089624-FFB8-38ED-BF6B-5B99E7668B1A'),
(35, '86CE0DA4-7B4E-9FA1-E79E-FF18FA2C8CC3-1425345872', '测试4', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '32', '32', 1, '36089624-FFB8-38ED-BF6B-5B99E7668B1A'),
(36, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', '重复测试', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '5', '5', 1, '36089624-FFB8-38ED-BF6B-5B99E7668B1A'),
(37, '25345ED5-8F06-6F07-949D-C9562E147C55', '测试1', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '29.97', '9.99', 3, '36089624-FFB8-38ED-BF6B-5B99E7668B1A'),
(38, '25345ED5-8F06-6F07-949D-C9562E147C55', '测试1', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '29.97', '9.99', 3, '36089624-FFB8-38ED-BF6B-5B99E7668B1A'),
(39, '25345ED5-8F06-6F07-949D-C9562E147C55', '测试1', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '9.99', '9.99', 1, 'C381ADEB-EA72-745C-3132-4F49C1D0DC2C');

-- --------------------------------------------------------

--
-- 表的结构 `ord_record`
--

CREATE TABLE IF NOT EXISTS `ord_record` (
`id` int(20) NOT NULL,
  `ord_uuid` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ord_datetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `ord_amount` float NOT NULL,
  `ord_status` varchar(10) CHARACTER SET utf8 NOT NULL,
  `ord_payment` varchar(10) CHARACTER SET utf8 NOT NULL,
  `ord_user` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ord_shipping_fee` double NOT NULL,
  `ord_email` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `ord_record`
--

INSERT INTO `ord_record` (`id`, `ord_uuid`, `ord_datetime`, `ord_amount`, `ord_status`, `ord_payment`, `ord_user`, `ord_shipping_fee`, `ord_email`) VALUES
(1, '11111', '2015-05-17 17:41:16', 111, '1111', '111', '11', 0, ''),
(2, 'A400EF00-0FFD-1E3B-19D0-284704F9BDD3', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(3, '481DF638-D7BB-B536-8D1D-6D7A558F8065', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(4, 'FF9C6819-033E-4709-8108-66E806F39762', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(5, 'D36B931D-66EF-3520-45F8-C01C261FC547', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(6, '0EC6094C-B823-A30C-109A-F9DC57224228', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(7, '5FE7BB85-EF29-C11E-BA88-ABEBA2BAD090', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(8, 'BAFB4294-2AFC-D20C-4877-CD033F1A6DBE', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(10, 'F1746446-11C4-4EBA-604C-98A23DF63EA7', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(11, '706EE434-BBC6-139E-8187-F3BE3F88DCCB', '0000-00-00 00:00:00', 9.99, 'new', '', 'wangxi ', 0, ''),
(12, 'AA24DE7C-0670-E769-C62D-00E2810C40EF', '0000-00-00 00:00:00', 9.99, 'new', '', 'wang xi ', 0, ''),
(13, '422C0DB0-1055-BBBE-A2B2-71C8BB1BADCA', '2015-05-22 06:18:53', 9.99, 'new', '', 'wang xi ', 0, ''),
(14, '991E173D-F0FB-AF30-290F-5714464E8638', '2015-05-24 18:51:31', 14.99, 'new', '', 'wang xi ', 0, ''),
(15, 'A9D6400B-BEF3-E7D0-4E5D-1D00923A00DE', '2015-05-24 18:56:49', 14.99, 'new', '', 'wang xi ', 0, ''),
(16, '2A91BFF8-90E7-97F0-23E4-4B07C1125E8E', '2015-05-24 18:58:55', 14.99, 'new', '', 'wang xi ', 0, ''),
(17, '700C20AD-F82A-5A34-5DA9-6C1FE2CB2549', '2015-05-24 19:05:01', 14.99, 'new', '', 'wang xi ', 0, ''),
(18, 'FEADA73D-6425-513B-4A98-0DD0059DDB58', '2015-05-24 19:05:19', 14.99, 'new', '', 'wang xi ', 0, ''),
(19, '1024E2DE-305D-A4E2-403F-3BAB42825CF7', '2015-05-24 19:06:10', 14.99, 'new', '', 'wang xi ', 0, ''),
(20, '28951195-D970-2699-963D-F968811107A2', '2015-05-24 19:06:39', 14.99, 'new', '', 'wang xi ', 0, ''),
(21, '6E0C506E-06EF-28CD-CEF2-23017EF647A1', '2015-05-24 19:07:23', 14.99, 'new', '', 'wang xi ', 0, ''),
(22, 'F92A3A61-36FF-A5B0-32E3-FACB0B740607', '2015-05-24 19:13:35', 14.99, 'new', '', 'wang xi ', 0, ''),
(23, 'A91889EB-3FD1-CEDC-D4BC-72ECD4CC0803', '2015-05-24 19:18:11', 14.99, 'new', '', 'wang xi ', 0, ''),
(24, '0D915DDC-8E16-6B49-107B-C34991168CB2', '2015-05-24 19:20:25', 14.99, 'new', '', 'wang xi ', 0, ''),
(25, 'A22410E6-2984-3A62-6EC6-46C78912C3E1', '2015-05-24 20:36:59', 14.99, 'new', '', 'wang xi ', 0, ''),
(26, '269669B4-EC41-EE01-39B4-9886C8DFEA99', '2015-05-25 04:16:39', 268, 'new', '', 'wang xi ', 0, ''),
(27, 'FBE40A44-E9A4-9EC4-D7B8-51B766A206C5', '2015-05-25 04:22:33', 268, 'new', '', 'wang xi ', 0, ''),
(28, '6662BC91-0FCC-8CE6-D3B0-2B0D0060FE78', '2015-05-25 04:24:32', 268, 'new', '', 'wang xi ', 0, ''),
(29, '3E58EC44-4ADE-C766-19D3-74FD5FB9B49B', '2015-05-25 04:26:56', 283, 'new', '', 'wang xi ', 0, 'gowest.wang@gmail.com'),
(30, '470FD9D6-6210-DC9B-55E5-D5710F423189', '2015-05-25 04:27:55', 283, 'new', '', 'wang xi ', 0, 'gowest.wang@gmail.com'),
(31, 'CC3B935E-FAEB-A46C-E953-A7FF4FA75C2D', '2015-05-26 04:59:46', 295, 'new', '', 'wang xi ', 0, 'gowest.wang@gmail.com'),
(32, '3E5896CD-7445-4831-1349-B854E0CF5CE8', '2015-05-26 05:39:59', 295, 'new', '', 'wang xi ', 0, 'gowest.wang@gmail.com'),
(33, '42999F85-66D7-8697-AF03-C3CD6860BAB2', '2015-05-27 05:15:46', 300, 'new', '', 'wang xi ', 0, 'gowest.wang@gmail.com'),
(34, '36089624-FFB8-38ED-BF6B-5B99E7668B1A', '2015-06-02 05:29:12', 359.94, 'new', '', 'wang xi ', 0, 'gowest.wang@gmail.com'),
(35, 'C381ADEB-EA72-745C-3132-4F49C1D0DC2C', '2015-06-11 05:46:22', 9.99, 'new', '', 'wang xi ', 0, 'gowest.wang@gmail.com');

-- --------------------------------------------------------

--
-- 表的结构 `product_info`
--

CREATE TABLE IF NOT EXISTS `product_info` (
`id` int(100) NOT NULL,
  `pro_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pro_brand` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pro_category` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pro_img` varchar(9999) CHARACTER SET utf8 NOT NULL,
  `pro_description` text CHARACTER SET utf8 NOT NULL,
  `pro_o_price` float NOT NULL,
  `pro_code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pro_onsell` int(10) NOT NULL DEFAULT '1',
  `promotion_id` text CHARACTER SET utf8 NOT NULL,
  `promotion_enabled` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `product_info`
--

INSERT INTO `product_info` (`id`, `pro_name`, `pro_brand`, `pro_category`, `pro_img`, `pro_description`, `pro_o_price`, `pro_code`, `pro_onsell`, `promotion_id`, `promotion_enabled`) VALUES
(1, '测试1', 'brand_1', '3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '', 9.99, '25345ED5-8F06-6F07-949D-C9562E147C55', 0, '1', 1),
(2, '测试2', 'brand_1', '3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '', 100, 'DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', 1, '1', 1),
(3, '测试3', 'brand_1', '3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '', 21, '3E734DDC-59E5-0E9E-1931-29125E13574D-1425341665', 1, '1', 1),
(4, '测试4', 'brand_1', '3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '', 32, '86CE0DA4-7B4E-9FA1-E79E-FF18FA2C8CC3-1425345872', 1, '1', 1),
(5, '测测是是', 'brand_1', '3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '', 34, 'D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956', 1, '11', 1),
(6, '重复测试', 'brand_1', '3', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', '', 5, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', 1, '11', 1),
(9, '测试药品', 'brand_2', '6', 'image/pro_img/44046AC4-572B-1B5D-54ED-3C65BA1FAE06-1429394517.jpg', '', 11, '44046AC4-572B-1B5D-54ED-3C65BA1FAE06-1429394517', 1, '11', 1),
(10, 'ceshi', 'brand_1', '6', 'image/pro_img/D938B0AB-AB4D-954A-226A-DCFB67B74800-1429394550.jpg', '', 12, 'D938B0AB-AB4D-954A-226A-DCFB67B74800-1429394550', 1, '3', 1),
(11, '测试药品', 'brand_3', '4', 'image/pro_img/78267AE2-7FDA-567B-2398-3D336D960F67-1429399131.jpg', '', 13, '78267AE2-7FDA-567B-2398-3D336D960F67-1429399131', 1, '3', 1),
(12, '测试药品', 'brand_3', '4', 'image/pro_img/78267AE2-7FDA-567B-2398-3D336D960F67-1429399131.jpg', '', 14, '78267AE2-7FDA-567B-2398-3D336D960F67-1429399131', 1, '3', 1),
(13, '测试药品', 'brand_3', '4', 'image/pro_img/78267AE2-7FDA-567B-2398-3D336D960F67-1429399131.jpg', '', 15, '78267AE2-7FDA-567B-2398-3D336D960F67-1429399131', 1, '3', 1),
(14, '1111111', 'brand_2', '4', 'image/pro_img/2AA02150-7FE4-D74E-70C0-52BF493CD934-1431883607.jpg', '', 16, '2AA02150-7FE4-D74E-70C0-52BF493CD934-1431883607', 1, '3', 1),
(15, '11111', 'brand_2', '4', 'image/pro_img/11A57EF9-3339-EDE0-90D8-4EBF3560B6EC-1434000838.jpg', '', 0, '11A57EF9-3339-EDE0-90D8-4EBF3560B6EC-1434000838', 1, '3', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pro_brand_list`
--

CREATE TABLE IF NOT EXISTS `pro_brand_list` (
`id` int(11) NOT NULL,
  `pro_brand_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `brand_des` varchar(500) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `pro_brand_list`
--

INSERT INTO `pro_brand_list` (`id`, `pro_brand_name`, `brand_des`) VALUES
(1, '力达', ''),
(2, '宝力', ''),
(3, 'aaa', ''),
(4, 'haha', '');

-- --------------------------------------------------------

--
-- 表的结构 `pro_buy_get`
--

CREATE TABLE IF NOT EXISTS `pro_buy_get` (
`id` int(11) NOT NULL,
  `promotion_id` text COLLATE utf8_bin NOT NULL,
  `pro_buy` int(11) NOT NULL,
  `pro_get` int(11) NOT NULL,
  `pro_start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pro_end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pro_endless` int(11) NOT NULL,
  `pro_enabled` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `pro_buy_get`
--

INSERT INTO `pro_buy_get` (`id`, `promotion_id`, `pro_buy`, `pro_get`, `pro_start_time`, `pro_end_time`, `pro_endless`, `pro_enabled`) VALUES
(1, '1', 3, 1, '2015-06-10 07:00:00', '2015-06-30 07:00:00', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pro_category`
--

CREATE TABLE IF NOT EXISTS `pro_category` (
  `pro_cate_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `upper_cate` varchar(100) CHARACTER SET utf8 NOT NULL,
  `keyword` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `reserve` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
`id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `pro_category`
--

INSERT INTO `pro_category` (`pro_cate_name`, `upper_cate`, `keyword`, `reserve`, `id`) VALUES
('抗癌药', '34', NULL, NULL, 3),
('免疫增强', '34', NULL, NULL, 4),
('血管疏通', '34', NULL, NULL, 6),
('肌肉增长系列', '43', NULL, NULL, 7),
('关节保护系列', '43', NULL, NULL, 8),
('蛋白粉', '45', NULL, NULL, 9),
('肌酸', '45', NULL, NULL, 10),
('皮肤美白', '46', NULL, NULL, 11),
('去除色斑', '46', NULL, NULL, 12),
('液体钙系列', '47', NULL, NULL, 13),
('维生素D', '47', NULL, NULL, 14),
('儿童奶粉', '53', NULL, NULL, 15),
('果味维生素', '53', NULL, NULL, 16);

-- --------------------------------------------------------

--
-- 表的结构 `pro_discount`
--

CREATE TABLE IF NOT EXISTS `pro_discount` (
`id` int(50) NOT NULL,
  `promotion_id` text CHARACTER SET utf8 NOT NULL,
  `discount_value` int(10) DEFAULT NULL,
  `pro_buy` int(11) DEFAULT NULL,
  `pro_get` int(11) DEFAULT NULL,
  `pro_type` int(11) NOT NULL,
  `dis_start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dis_end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dis_endless` int(11) NOT NULL,
  `dis_enabled` int(11) NOT NULL,
  `pro_price` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `pro_discount`
--

INSERT INTO `pro_discount` (`id`, `promotion_id`, `discount_value`, `pro_buy`, `pro_get`, `pro_type`, `dis_start_time`, `dis_end_time`, `dis_endless`, `dis_enabled`, `pro_price`) VALUES
(1, '11', 80, 0, 0, 1, '2015-06-11 06:47:02', '2015-10-22 07:00:00', 1, 1, 0),
(2, '1', 0, 3, 1, 2, '2015-06-10 07:00:00', '2015-06-30 07:00:00', 1, 1, 0),
(3, '3', NULL, 0, 0, 3, '2015-06-11 07:00:00', '2015-06-30 07:00:00', 1, 1, 20);

-- --------------------------------------------------------

--
-- 表的结构 `pro_extra_info`
--

CREATE TABLE IF NOT EXISTS `pro_extra_info` (
`id` int(100) NOT NULL,
  `pro_code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pro_r_price` float NOT NULL,
  `pro_keyword` varchar(100) CHARACTER SET utf8 NOT NULL,
  `preferential_enable` tinyint(1) NOT NULL DEFAULT '0',
  `buy_quantity` int(11) NOT NULL,
  `get_quantity` int(11) NOT NULL,
  `get_price` float NOT NULL,
  `pro_weight` float NOT NULL,
  `specification` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `pro_img` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `pro_extra_info`
--

INSERT INTO `pro_extra_info` (`id`, `pro_code`, `pro_r_price`, `pro_keyword`, `preferential_enable`, `buy_quantity`, `get_quantity`, `get_price`, `pro_weight`, `specification`, `pro_img`) VALUES
(1, '66C7E4F7-E319-FED1-6AD0-A09F15C51984-1425346373', 0, '', 0, 3, 1, 0, 0, '', 'image/pro_img/66C7E4F7-E319-FED1-6AD0-A09F15C51984-1425346373.jpg'),
(2, '933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440', 0, '', 0, 4, 1, 0, 0, '', 'image/pro_img/933C94C9-7361-0A6E-301C-8FD8DEE8A7A6-1425346440.jpg'),
(3, '541648DD-ADCC-C21C-AC0D-A2393F7F1DBE-1429394071', 0, '', 0, 3, 2, 0, 0, '', 'image/pro_img/541648DD-ADCC-C21C-AC0D-A2393F7F1DBE-1429394071.jpg'),
(4, '0A1708D3-F218-F05C-E569-99EEE10F5F79-1429394328', 0, '', 0, 1, 1, 0, 0, '', 'image/pro_img/0A1708D3-F218-F05C-E569-99EEE10F5F79-1429394328.jpg'),
(5, '44046AC4-572B-1B5D-54ED-3C65BA1FAE06-1429394517', 0, '', 0, 0, 0, 0, 0, '', 'image/pro_img/44046AC4-572B-1B5D-54ED-3C65BA1FAE06-1429394517.jpg'),
(6, 'D938B0AB-AB4D-954A-226A-DCFB67B74800-1429394550', 0, '', 0, 0, 0, 0, 0, '', 'image/pro_img/D938B0AB-AB4D-954A-226A-DCFB67B74800-1429394550.jpg'),
(7, '78267AE2-7FDA-567B-2398-3D336D960F67-1429399131', 0, '', 0, 0, 0, 0, 0, '', 'image/pro_img/78267AE2-7FDA-567B-2398-3D336D960F67-1429399131.jpg'),
(8, '2AA02150-7FE4-D74E-70C0-52BF493CD934-1431883607', 0, '', 0, 0, 0, 0, 0, '', 'image/pro_img/2AA02150-7FE4-D74E-70C0-52BF493CD934-1431883607.jpg'),
(9, '11A57EF9-3339-EDE0-90D8-4EBF3560B6EC-1434000838', 0, '', 0, 0, 0, 0, 0, '', 'image/pro_img/11A57EF9-3339-EDE0-90D8-4EBF3560B6EC-1434000838.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `pro_img`
--

CREATE TABLE IF NOT EXISTS `pro_img` (
  `pro_uuid` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pro_pic` varchar(100) CHARACTER SET utf8 NOT NULL,
`id` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `pro_img`
--

INSERT INTO `pro_img` (`pro_uuid`, `pro_pic`, `id`) VALUES
('DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', 1),
('DBEC3FB5-F942-F440-664A-4B2A16A4C80A1425341635', 'image/pro_img/D43B8EFB-D6DD-A2F2-C0F3-10B3082D6AC6-1425345956.jpg', 2);

-- --------------------------------------------------------

--
-- 表的结构 `user_extra_info`
--

CREATE TABLE IF NOT EXISTS `user_extra_info` (
`id` int(100) NOT NULL,
  `user_country` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_province` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_postcode` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_mailing_address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user_extra_info`
--

INSERT INTO `user_extra_info` (`id`, `user_country`, `user_province`, `user_postcode`, `user_mailing_address`, `user_email`) VALUES
(1, 'China', 'beijing', '100037', 'aaajflsjfldsfdsf', 'gowest.wang@gmail.com');

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
`id` int(100) NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_group` varchar(100) CHARACTER SET utf8 NOT NULL,
  `actived` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`id`, `first_name`, `last_name`, `email`, `user_password`, `user_group`, `actived`) VALUES
(1, 'aaa', 'bbb', 'aaa@aaa.com', '', '', NULL),
(2, 'xi ', 'wang', 'gowest.wang@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', NULL),
(3, 'zhang ', 'tingting', '123@234.com', 'e10adc3949ba59abbe56e057f20f883e', '', NULL),
(4, 'qqq ', 'qqq', 'qqq@qqq.com', 'e10adc3949ba59abbe56e057f20f883e', '', NULL),
(5, 'uuu ', 'uuu', 'uuu@uuu.com', 'e10adc3949ba59abbe56e057f20f883e', '', NULL),
(6, 'bbbb ', 'aaa', 'eeee@eee.com', 'e3ceb5881a0a1fdaad01296d7554868d', '', NULL),
(7, '1111 ', 'qqqq', 'ad@ada.com', '96e79218965eb72c92a549dd5a330112', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ord_product`
--
ALTER TABLE `ord_product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ord_record`
--
ALTER TABLE `ord_record`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_brand_list`
--
ALTER TABLE `pro_brand_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_buy_get`
--
ALTER TABLE `pro_buy_get`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_category`
--
ALTER TABLE `pro_category`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `pro_discount`
--
ALTER TABLE `pro_discount`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_extra_info`
--
ALTER TABLE `pro_extra_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_img`
--
ALTER TABLE `pro_img`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_extra_info`
--
ALTER TABLE `user_extra_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `ord_product`
--
ALTER TABLE `ord_product`
MODIFY `id` int(40) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `ord_record`
--
ALTER TABLE `ord_record`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `pro_brand_list`
--
ALTER TABLE `pro_brand_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pro_buy_get`
--
ALTER TABLE `pro_buy_get`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pro_category`
--
ALTER TABLE `pro_category`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `pro_discount`
--
ALTER TABLE `pro_discount`
MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pro_extra_info`
--
ALTER TABLE `pro_extra_info`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pro_img`
--
ALTER TABLE `pro_img`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_extra_info`
--
ALTER TABLE `user_extra_info`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
