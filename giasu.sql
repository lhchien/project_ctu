-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2017 at 12:41 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giasu`
--

-- --------------------------------------------------------

--
-- Table structure for table `caidat`
--

CREATE TABLE `caidat` (
  `cd_ma` int(11) NOT NULL,
  `cd_ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cd_trang` int(11) NOT NULL,
  `cd_mota` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `caidat`
--

INSERT INTO `caidat` (`cd_ma`, `cd_ten`, `cd_trang`, `cd_mota`) VALUES
(1, 'admin', 5, 'So dong du lieu hien thi cho phan admin'),
(2, 'user', 6, 'So bai viet hien thi tren 1 trang cua user');

-- --------------------------------------------------------

--
-- Table structure for table `dangky`
--

CREATE TABLE `dangky` (
  `dk_id` int(11) NOT NULL,
  `dk_gs_id` int(11) NOT NULL,
  `dk_ld_id` int(11) NOT NULL,
  `dk_trangthai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dangky`
--

INSERT INTO `dangky` (`dk_id`, `dk_gs_id`, `dk_ld_id`, `dk_trangthai`) VALUES
(2, 2, 16, -1),
(3, 10, 16, 1),
(4, 10, 21, -2),
(5, 10, 20, -1),
(6, 2, 20, -2),
(7, 2, 21, -1),
(8, 26, 19, -1),
(11, 26, 16, -1),
(12, 26, 17, 0),
(13, 26, 9, 1),
(16, 2, 19, 1),
(17, 11, 18, 1),
(18, 2, 18, -1),
(19, 2, 23, -2),
(20, 2, 24, 1),
(21, 2, 25, 1),
(22, 2, 26, -1),
(23, 10, 26, -2),
(24, 2, 27, 1),
(25, 2, 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `dg_id` int(11) NOT NULL,
  `dg_noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dg_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ld_id` int(11) NOT NULL,
  `tk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`dg_id`, `dg_noidung`, `dg_time`, `ld_id`, `tk_id`) VALUES
(33, 'hello', '2017-05-02 18:50:07', 26, 10),
(34, 'Chào Thầy!', '2017-05-02 18:50:33', 26, 19),
(35, 'Chào em!', '2017-05-02 18:51:55', 20, 2),
(36, 'Chào Cô!', '2017-05-02 18:52:28', 20, 19),
(37, 'Chào Cô BTrang!', '2017-05-02 18:53:26', 23, 21),
(38, 'Cô chào em!', '2017-05-02 18:53:46', 23, 2),
(39, 'Hello', '2017-05-04 10:44:54', 19, 19),
(40, 'Hi', '2017-05-04 10:45:46', 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `daylop`
--

CREATE TABLE `daylop` (
  `dl_id` int(11) NOT NULL,
  `dl_lop` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dl_mon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dl_giatien` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dl_trangthai` int(1) NOT NULL,
  `dl_gs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daylop`
--

INSERT INTO `daylop` (`dl_id`, `dl_lop`, `dl_mon`, `dl_giatien`, `dl_trangthai`, `dl_gs_id`) VALUES
(2, 'Lớp 5', 'Vật lý', '50000', 0, 2),
(3, 'Luyện thi HS giỏi', 'Tiếng Anh', '70000', 0, 2),
(9, 'Luyện thi đại học', 'Tiếng Anh', '100000', 0, 2),
(13, 'Lớp 6', 'Vật lý', '60000', 0, 2),
(17, 'Lớp 9', 'Tiếng Anh', '50000', 0, 10),
(18, 'Lớp 10', 'Tiếng Anh', '50000', 0, 10),
(19, 'Lớp 11', 'Tiếng Anh', '60000', 0, 10),
(20, 'Lớp 12', 'Tiếng Anh', '80000', 0, 10),
(21, 'Luyện thi đại học', 'Toán học', '80000', 0, 11),
(22, 'Luyện thi HS giỏi', 'Toán học', '100000', 0, 11),
(23, 'Lớp 9', 'Vật lý', '60000', 0, 12),
(24, 'Lớp 12', 'Vật lý', '70000', 0, 12),
(25, 'Luyện thi đại học', 'Vật lý', '100000', 0, 12),
(26, 'Luyện thi HS giỏi', 'Vật lý', '100000', 0, 12),
(27, 'Lớp 5', 'Toán học', '50000', 0, 12),
(28, 'Lớp 9', 'Toán học', '60000', 0, 12),
(29, 'Lớp 1', 'Tiếng Anh', '50000', 0, 13),
(30, 'Lớp 2', 'Tiếng Anh', '50000', 0, 13),
(31, 'Lớp 3', 'Tiếng Anh', '50000', 0, 13),
(32, 'Lớp 4', 'Tiếng Anh', '50000', 0, 13),
(33, 'Lớp 5', 'Tiếng Anh', '50000', 0, 13),
(34, 'Luyện thi đại học', 'Sinh học', '80000', 0, 15),
(35, 'Luyện thi HS giỏi', 'Sinh học', '80000', 0, 15),
(36, 'Lớp 12', 'Vật lý', '60000', 0, 24),
(37, 'Lớp 12', 'Toán học', '60000', 0, 24),
(38, 'Lớp 12', 'Tin học', '50000', 0, 26),
(39, 'Luyện thi HS giỏi', 'Tin học', '80000', 0, 26),
(40, 'Luyện thi HS giỏi', 'Tin học', '70000', 0, 29),
(41, 'Lớp 12', 'Tin học', '50000', 0, 29),
(42, 'Lớp 11', 'Tin học', '50000', 0, 29);

-- --------------------------------------------------------

--
-- Table structure for table `giasu`
--

CREATE TABLE `giasu` (
  `gs_tk_id` int(11) NOT NULL,
  `gs_hoten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gs_gioitinh` int(1) NOT NULL,
  `gs_namsinh` int(4) NOT NULL,
  `gs_dienthoai` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `gs_diadiem` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gs_motadiadiem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gs_hinhanh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gs_gioithieu` text COLLATE utf8_unicode_ci,
  `gs_trinhdo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gs_chuyennganh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gs_congviec` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gs_ngayday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gs_gioday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gs_kinhnghiem` int(2) DEFAULT NULL,
  `gs_diachi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gs_trangthai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `giasu`
--

INSERT INTO `giasu` (`gs_tk_id`, `gs_hoten`, `gs_gioitinh`, `gs_namsinh`, `gs_dienthoai`, `gs_diadiem`, `gs_motadiadiem`, `gs_hinhanh`, `gs_gioithieu`, `gs_trinhdo`, `gs_chuyennganh`, `gs_congviec`, `gs_ngayday`, `gs_gioday`, `gs_kinhnghiem`, `gs_diachi`, `gs_trangthai`) VALUES
(2, 'Lê Bảo Trang', 1, 1992, '01655711369', '10.00935347502392,105.72074890136719', 'Trên đường Nguyễn Văn Cừ nối dài', 'img/gs_img/Hydrangeas.jpg', 'Mình là sinh viên năm thứ 4 Khoa Công Nghệ Thông Tin - Đại học Cần Thơ. Đồng thời cũng đang là học viên được thi tuyển chọn đầu vào trong số các sinh viên của trường để học tập tại Trung tâm đào tạo và nghiên cứu Công Nghệ Đài Loan.', 'Đại học', 'Công nghệ thông tin', 'Lập trình viên', 'Thứ 2,Thứ 4,Thứ 6,Chủ nhật', '17 giờ,18 giờ,19 giờ,20 giờ', 1, 'Cần Thơ', 1),
(10, 'Lê Hồng Chiến', 0, 1992, '0123456789', '10.045535777734193,105.77151775360107', 'Hẻm 233 Nguyễn Văn Cừ - Hậu Mậu Thân', 'img/gs_img/tutor-img-chien.jpg', 'Mình là sinh viên năm thứ 4 Khoa Công Nghệ Thông Tin - Đại học Cần Thơ. Đồng thời cũng đang là học viên được thi tuyển chọn đầu vào trong số các sinh viên của trường để học tập tại Trung tâm đào tạo và nghiên cứu Công Nghệ Đài Loan.', 'Đại học', 'Thiết kế đồ họa', 'Thiết kế viên', 'Thứ 2,Thứ 4,Thứ 6', '17 giờ,18 giờ,19 giờ,20 giờ', 2, 'Cần Thơ', 1),
(11, 'Nguyễn Phan Anh', 0, 1992, '0939888999', '10.240030099752413,105.97412109375', 'Thành phố Vĩnh Long', 'img/gs_img/phananh.jpg', 'Thông tin tự giới thiệu bản thân', 'Đại học', 'Sư phạm Toán', 'Giáo viên', 'Thứ 2,Thứ 4,Thứ 5', '7 giờ,8 giờ,9 giờ,10 giờ', 3, 'Vĩnh Long', 1),
(12, 'Hoàng Minh Trung', 0, 1990, '0932775994', '10.038758011483786,105.75966775417328', 'Nguyễn Văn Cừ nối dài', 'img/no_img.jpg', 'Thông tin tự giới thiệu bản thân', 'Thạc sĩ', 'Sư phạm vật lý', 'Giảng viên', 'Thứ 2,Thứ 3,Thứ 4,Thứ 5,Thứ 6,Thứ 7', '19 giờ,20 giờ,21 giờ', 2, 'Cần Thơ', 1),
(13, 'Zhao Li Ying', 1, 1987, '01655111222', '10.026625026332143,105.77079892158508', 'Gần đại học cần thơ', 'img/gs_img/zhaoliying.jpg', '', 'Thạc sĩ', 'Quản trị du lịch', 'Hướng dẫn viên du lịch', 'Thứ 7,Chủ nhật', '13 giờ,14 giờ,15 giờ', 1, 'Cần Thơ', 1),
(15, 'Xiao Long Nu', 1, 1984, '0918666552', '10.04663777034049,105.77679634094238', 'Phạm Ngũ Lão, NK, CT', 'img/gs_img/110422CineMyNuPhimCoTrang22.jpg', '', 'Đại học', 'Công nghệ sinh học', 'Nhân viên phòng nghiên cứu Sinh học', 'Thứ 3,Thứ 5,Thứ 7', '19 giờ,20 giờ,21 giờ', 1, 'Cần Thơ', 2),
(24, 'Li Yi Feng', 0, 1983, '0126763890', '10.031370315706981,105.77986478805542', 'Nguyễn Việt Hồng, gần trung tâm Anh ngữ AMA', 'img/gs_img/ly_dich_phong.jpg', '', 'Thạc sĩ', 'Điện tử - Điện lạnh', 'Giám đốc công ty điện tử ABC', 'Thứ 2,Thứ 4,Thứ 6', '8 giờ,9 giờ,10 giờ,19 giờ,20 giờ,21 giờ', 3, 'Cần Thơ', 1),
(25, '', -1, 0, '', NULL, NULL, 'img/no_img.jpg', NULL, '', '', NULL, NULL, NULL, NULL, 'Long Tuyền, Bình Thủy, Cần Thơ, Việt Nam', 0),
(26, 'Nguyễn Minh Nguyện', 0, 1992, '0123444888', '10.014428359759084,105.75816035270691', 'hẻm 58,đương 3/2 Gần vòng xoay cầu Đầu Sấu', 'img/gs_img/Lighthouse.jpg', 'Hướng dẫn học sinh nhiệt tình, vui vẻ', 'Đại học', 'Công nghệ thông tin', 'Kỹ thuật viên', 'Thứ 7,Chủ nhật', '15 giờ,16 giờ,17 giờ', 0, 'Cần Thơ', 1),
(27, 'David John', 0, 1975, '0964728499', '10.006605433345257,105.77550888061523', 'Gần khu 1 Đại học Cần Thơ', 'img/no_img.jpg', '', 'Thạc sĩ', 'Công nghệ sinh học', '', NULL, NULL, NULL, 'Long Tuyền, Bình Thủy, Cần Thơ, Việt Nam', 0),
(28, '', -1, 0, '', NULL, NULL, 'img/no_img.jpg', NULL, '', '', NULL, 'Thứ 3,Thứ 5,Thứ 7', '13 giờ,14 giờ,15 giờ', 1, 'Long Tuyền, Bình Thủy, Cần Thơ, Việt Nam', 0),
(29, 'Chen Xiao', 0, 1985, '01636889235', '10.044491555391954,105.78160285949707', 'Đường Trần Quang Khải', 'img/gs_img/tran_hieu.jpg', 'Nhiệt tình, năng động, mới mẻ trong giảng dạy.', 'Đại học', 'Công nghệ phần mềm', 'Lập trình viên .Net', 'Thứ 3,Thứ 5,Thứ 7', '18 giờ,19 giờ,20 giờ,21 giờ', 1, 'Cần Thơ', 1),
(30, 'Nguyễn văn D', 0, 1997, '0123456789', NULL, NULL, 'img/no_img.jpg', '', 'Đại học', 'Công nghệ thông tin', 'Giảng viên Đại học.', NULL, NULL, NULL, 'Long Tuyền, Bình Thủy, Cần Thơ, Việt Nam', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

CREATE TABLE `lienhe` (
  `lh_id` int(11) NOT NULL,
  `lh_tk_id` int(11) DEFAULT NULL,
  `lh_ngay` date NOT NULL,
  `lh_gio` time NOT NULL,
  `lh_tieude` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lh_noidung` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `lh_phanhoi` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `lh_trangthai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lienhe`
--

INSERT INTO `lienhe` (`lh_id`, `lh_tk_id`, `lh_ngay`, `lh_gio`, `lh_tieude`, `lh_noidung`, `lh_phanhoi`, `lh_trangthai`) VALUES
(1, 10, '2017-04-15', '00:00:00', 'Ý kiến về lớp dạy.', 'Tôi muốn ý kiến về việc dạy thêm ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', 'khón lạn', 0),
(2, 2, '2017-04-27', '03:04:00', 'Tai sao.', '12324421', '', 0),
(3, 11, '2017-04-10', '05:00:00', 'Why', 'ABCXYZ', '', 0),
(4, 12, '2017-04-04', '06:00:00', 'GGGGG', '123124421', '', 0),
(5, 15, '2017-04-04', '05:00:00', 'Liên hệ', '12345', '', 0),
(6, 19, '0000-00-00', '00:00:00', 'Tao hận', 'sẽ tuột quần thằng admin khóa tao', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lopday`
--

CREATE TABLE `lopday` (
  `ld_id` int(11) NOT NULL,
  `ld_tieude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ld_mon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ld_khoilop` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ld_soluong` int(2) NOT NULL,
  `ld_yeucau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ld_buoiday` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ld_thoigian` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ld_diadiem` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ld_mota_diadiem` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ld_hinhanh` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ld_trangthai` int(1) NOT NULL,
  `ld_diem_cmt` int(1) DEFAULT NULL,
  `ld_noidung_cmt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ph_tk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lopday`
--

INSERT INTO `lopday` (`ld_id`, `ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`, `ld_diem_cmt`, `ld_noidung_cmt`, `ph_tk_id`) VALUES
(9, 'Lớp Tiếng Anh', 'Tiếng Anh', 'Lớp 4', 2, 'Giáo viên có kinh nghiệm luyện thi đại học                            ', 'Thứ 2,Thứ 4,Thứ 6', '01:01', '10.038758011483786,105.75966775417328', 'Đường lê bình                            ', 'img/class_img/SJ10.jpg', 1, 4, 'Nói hơi nhanh', 19),
(16, 'Tìm gia sư Toán học', 'Toán học', 'Lớp 10', 5, 'Giao vien nữ', 'Thứ 2,Thứ 4,Thứ 6', '01:01', '10.060811476952429,105.72452545166016', '  ', 'img/ld_img/toan.jpg', 1, 5, 'Nhiệt tình, dạy thực tiễn', 20),
(17, 'Tìm gia sư Vật lý 12', 'Vật lý', 'Lớp 12', 1, 'Giáo viên có kinh nghiệm luyện thi đại học', 'Thứ 2,Thứ 4,Thứ 6', '01:01', '10.033090725931306,105.66204071044922', 'Cần thơ.', 'img/ld_img/vatly.jpg', 1, NULL, NULL, 20),
(18, 'Tìm gia sư luyện thi lớp chuyên', 'Hóa học', 'Lớp 10', 1, 'Gia sư có kinh nghiệm', 'Thứ 2,Thứ 4', '5', '10.060811476952429,105.72452545166016', NULL, 'img/ld_img/hoahoc.jpg', 1, 4, 'Vui vẻ, nhiệt tình, có nhiều kinh nghiệm hay', 21),
(19, 'Cần mở lớp Tin học buổi tối', 'Tin học', 'Lớp 10', 5, 'Cần giáo viên khiêm tốn, thật thà, dũng cảm                            ', 'Thứ 2,Thứ 4,Thứ 6', '18:30', '10.030132578730601,105.75229167938232', ' Đường Nguyễn Văn Cừ nối dài                            ', 'img/class_img/SJ35.jpg', 1, 5, 'rfreg', 19),
(20, 'Tìm gia sư dạy tiếng Pháp buổi tối', 'Tiếng Pháp', 'Lớp 12', 5, 'Giáo viên bản xứ càng tốt, tiền bạc không thành vẫn đề', 'Thứ 7,CN', '18:30', '10.013820024911292,105.75598239898682', 'Hẻm 132 đường 3/2', 'img/class_img/tiengphap.jpg', 1, 4, 'Gia sư dễ thương thật', 19),
(21, 'Cần gia sử dạy kèm môn Hóa 12', 'Hóa học', 'Lớp 12', 2, 'Sinh viên cũng được', 'Thứ 3,Thứ 5,Thứ 7', '18:30', '10.017200932495667,105.73362350463867', 'Dạy tại nhà.                                                                           ', 'img/class_img/zhaoliying.jpg', 1, 5, 'Gia sư dạy dễ hiểu', 19),
(23, 'Tìm gia sư Toán Học luyện thi ĐH', 'Toán học', 'Luyện thi đại học', 3, 'Có kinh nghiệm luyện thi ĐH', 'Thứ 2', '00:00', '9.967159907804849,105.6749153137207', '  ', 'img/no_img.jpg', 0, 5, 'ok\r\n', 21),
(24, 'Tìm gia sư anh văn', 'Tiếng Anh', 'Luyện thi đại học', 2, 'Nói Tiếng Anh lưu loát', 'Thứ 2,Thứ 4,Thứ 6', '10:00', '10.019229460132442,105.73293685913086', '  ', 'img/no_img.jpg', 0, 5, 'Nhiệt tình', 21),
(25, 'Tìm GS Toán lớp 1', 'Toán học', 'Lớp 1', 2, 'Có kinh nghiệm dạy trẻ', 'Thứ 7,CN', '18:30', '10.045599163869646,105.71474075317383', 'Dạy tại nhà', 'img/no_img.jpg', 1, 4, 'Kiến thức tốt, dạy hơi nhanh', 21),
(26, 'Tìm GS toán lớp 8', 'Toán học', 'Lớp 8', 13, 'Có kinh nghiệm ít nhất 1 năm', 'Thứ 7,CN', '09:09', '10.049317795405159,105.71645736694336', '  ', 'img/no_img.jpg', 1, 3, 'ghvgyt', 19),
(27, 'Tìm gia sư dạy Tin học', 'Tin học', 'Luyện thi HS giỏi', 1, 'Có kiến thức về lập trình nâng cao', 'Thứ 2,Thứ 4,Thứ 6', '17:00', '10.025653047262292,105.84606170654297', '  ', 'img/no_img.jpg', 1, 5, 'Tốt', 20),
(28, 'Tìm người dạy kèm môn Sinh lớp 7', 'Sinh học', 'Lớp 7', 2, 'Có thể là sinh viên', 'Thứ 7,CN', '02:02', '10.0381617725496,105.71817398071289', 'Dạy tại nhà', 'img/ld_img/SJ29.jpg', 1, NULL, NULL, 21),
(29, 'Tìm GS dạy tiếng Pháp luyện thi', 'Tiếng Pháp', 'Lớp 12', 1, '                            ', 'Thứ 2,Thứ 4,Thứ 6', '18:30', '10.009593840893755,105.77473640441895', '                                ', 'img/class_img/SJ11.jpg', 1, NULL, NULL, 22),
(30, 'Lớp Hóa học cho học sinh giỏi', 'Hóa học', 'Luyện thi HS giỏi', 1, 'GS có kinh nghiệm', 'Thứ 7,CN', '08:00', '10.134834485531682,105.90116500854492', '  ', 'img/class_img/SJ30.jpg', 1, NULL, NULL, 23);

-- --------------------------------------------------------

--
-- Table structure for table `nhansu`
--

CREATE TABLE `nhansu` (
  `ns_tk_id` int(11) NOT NULL,
  `ns_hoten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ns_gioitinh` int(1) NOT NULL,
  `ns_dienthoai` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ns_trangthai` int(1) NOT NULL,
  `ns_diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ns_hinhanh` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhansu`
--

INSERT INTO `nhansu` (`ns_tk_id`, `ns_hoten`, `ns_gioitinh`, `ns_dienthoai`, `ns_trangthai`, `ns_diachi`, `ns_hinhanh`) VALUES
(1, 'Anh Nguyễn', 1, '01299535007', 1, 'Cần Thơ', 'img/ns_img/chi2.png'),
(34, 'Thanh Lữ', 0, '0169773409', 1, 'Cần Thơ', 'img/ns_img/thanh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `phuhuynh`
--

CREATE TABLE `phuhuynh` (
  `ph_tk_id` int(11) NOT NULL,
  `ph_hoten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ph_gioitinh` int(1) NOT NULL,
  `ph_dienthoai` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ph_trangthai` int(1) NOT NULL,
  `ph_diadiem` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ph_hinhanh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ph_trinhdo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phuhuynh`
--

INSERT INTO `phuhuynh` (`ph_tk_id`, `ph_hoten`, `ph_gioitinh`, `ph_dienthoai`, `ph_trangthai`, `ph_diadiem`, `ph_hinhanh`, `ph_trinhdo`) VALUES
(19, 'Trần Thanh Đoàn', 0, '0123444555', 1, 'Cần Thơ', 'img/ph_img/ST5.jpg', 'Đại học'),
(20, 'Nguyễn Minh Anh', 1, '01636777666', 1, 'Kiên Giang', 'img/ph_img/ST7.jpg', 'Đại học nhi đồng'),
(21, 'Lê Phạm Ngọc Xuyên', 1, '0936111888', 1, 'Hậu Giang', 'img/no_img.jpg', 'Trung cấp'),
(22, 'Trần Thế Hiển', 0, '0123444888', 1, 'Cần Giờ', 'img/ph_img/ST1.jpg', NULL),
(23, 'Nguyễn Hoàng Anh Thư', 1, '0939555888', 2, 'Hậu Giang', 'img/ph_img/ST12.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `tk_id` int(11) NOT NULL,
  `tk_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tk_matkhau` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tk_quyen` int(1) NOT NULL,
  `tk_trangthai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`tk_id`, `tk_email`, `tk_matkhau`, `tk_quyen`, `tk_trangthai`) VALUES
(1, 'admin@gmail.com', '96e79218965eb72c92a549dd5a330112', 1, 1),
(2, 'gsemail1@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(10, 'gsemail2@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(11, 'gsemail3@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(12, 'gsemail4@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(13, 'gsemail5@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(15, 'gsemail6@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(19, 'phuhuynh1@gmail.com', '96e79218965eb72c92a549dd5a330112', 3, 1),
(20, 'phuhuynh2@gmail.com', '96e79218965eb72c92a549dd5a330112', 3, 1),
(21, 'phuhuynh3@gmail.com', '96e79218965eb72c92a549dd5a330112', 3, 1),
(22, 'phuhuynh4@gmail.com', '96e79218965eb72c92a549dd5a330112', 3, 1),
(23, 'phuhuynh5@gmail.com', '96e79218965eb72c92a549dd5a330112', 3, 1),
(24, 'gsemail7@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(25, 'gsemail8@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(26, 'gsemail9@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(27, 'gsemail10@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(28, 'gsemail11@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(29, 'gsemail12@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(30, 'gsemail13@gmail.com', '96e79218965eb72c92a549dd5a330112', 2, 1),
(34, 'mod@gmail.com', '96e79218965eb72c92a549dd5a330112', -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `thongbao`
--

CREATE TABLE `thongbao` (
  `tb_id` int(11) NOT NULL,
  `tb_noidung` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tb_ngay` date NOT NULL,
  `tb_tk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thongbao`
--

INSERT INTO `thongbao` (`tb_id`, `tb_noidung`, `tb_ngay`, `tb_tk_id`) VALUES
(16, 'vi phạm quy chế', '2017-04-24', 15),
(17, 'Tài khoản spam.', '2017-04-26', 20),
(18, 'Spam ', '2017-04-26', 21),
(19, 'abc\'', '2017-05-02', 19),
(21, 'Spam', '2017-05-04', 23);

-- --------------------------------------------------------

--
-- Table structure for table `tinh`
--

CREATE TABLE `tinh` (
  `ID_TINH` int(15) NOT NULL,
  `TENTINH` varchar(255) NOT NULL,
  `MATUYENSINHT` varchar(20) NOT NULL,
  `GHICHU` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tinh`
--

INSERT INTO `tinh` (`ID_TINH`, `TENTINH`, `MATUYENSINHT`, `GHICHU`) VALUES
(68, 'Hà Nội', '01', '21.0227804,105.801944'),
(69, 'Hồ Chí Minh', '02', '10.819480296033161,106.62918090820312'),
(70, 'Hải Phòng', '03', '20.8468135,106.663727'),
(71, 'Đà Nẵng', '04', '16.047515,108.17122'),
(72, 'Hà Giang', '05', '22.806228, 104.999029'),
(73, 'Cao Bằng', '06', '22.6505334,106.1925787,12'),
(74, 'Lai Châu', '07', '22.397397, 103.441383'),
(75, 'Lào Cai', '08', '22.3603044,103.519035,9'),
(76, 'Tuyên Quang', '09', '21.789068, 105.228560'),
(77, 'Lạng Sơn', '10', '21.855550, 106.762451'),
(78, 'Bắc Cạn', '11', '22.131724, 105.839707'),
(79, 'Thái Nguyên', '12', '21.562870, 105.824382'),
(80, 'Yên Bái', '13', '21.718608, 104.903337'),
(81, 'Sơn La', '14', '21.324992, 103.900620'),
(82, 'Phú Thọ', '15', '21.342797, 105.372745'),
(83, 'Vĩnh Phúc', '16', '21.296983, 105.612301'),
(84, 'Quảng Ninh', '17', '21.066473, 107.301094'),
(85, 'Bắc Giang', '18', '21.293183, 106.220609'),
(86, 'Bắc Ninh', '19', '21.179175, 106.063747'),
(87, 'Hà Tây', '20', '14.299878, 108.140225'),
(88, 'Hải Dương', '21', '20.942195, 106.288128'),
(89, 'Hưng Yên', '22', '20.648228, 106.069256'),
(90, 'Hòa Bình', '23', '20.828892, 105.373628'),
(91, 'Hà Nam', '24', '20.547911, 105.935065'),
(92, 'Nam Định', '25', '20.439631, 106.165179'),
(93, 'Thái Bình', '26', '20.442590, 106.346877'),
(94, 'Ninh Bình', '27', '20.255413, 105.965950'),
(95, 'Thanh Hóa', '28', '19.843386, 105.785099'),
(96, 'Nghệ An', '29', '18.663053, 105.705230'),
(97, 'Hà Tĩnh', '30', '18.353640, 105.820221'),
(98, 'Quảng Bình', '31', '17.457214, 106.615236'),
(99, 'Quảng Trị', '32', '16.804771, 107.056596'),
(100, 'Thừa thiên-Huế', '33', '16.450503, 107.563531'),
(101, 'Quảng Nam', '34', '15.873415, 108.347796'),
(102, 'Quảng Ngãi', '35', '15.117998, 108.788112'),
(103, 'KonTum', '36', '14.348855, 107.991781'),
(104, 'Bình Định', '37', '13.764118, 109.133260'),
(105, 'Gia Lai', '38', '13.969484, 108.020047'),
(106, 'Phú Yên', '39', '13.112392, 109.251709'),
(107, 'Đắc Lắc', '40', '12.685546, 107.984157'),
(108, 'Khánh Hòa', '41', '12.232344, 109.250114'),
(109, 'Lâm Đồng', '42', '11.942141, 108.412355'),
(110, 'Bình Phước', '43', '11.538010, 106.902230'),
(111, 'Bình Dương', '44', '11.012249, 106.664821'),
(112, 'Ninh Thuận', '45', '11.587182, 108.955076'),
(113, 'Tây Ninh', '46', '11.367756, 106.114987'),
(114, 'Bình Thuận', '47', '10.977807, 108.269624'),
(115, 'Đồng Nai', '48', '10.962495, 106.867860'),
(116, 'Long An', '49', '10.538431, 106.411256'),
(117, 'Đồng Tháp', '50', '10.305872, 105.748765'),
(118, 'An Giang', '51', '10.674621, 105.100603'),
(119, 'BàRịa-VT', '52', '10.413672, 107.151545'),
(120, 'Tiền Giang', '53', '10.386184, 106.348442'),
(121, 'Kiên Giang', '54', '10.017778, 105.115000'),
(122, 'Cần Thơ', '55', '10.044602, 105.748086'),
(123, 'Bến Tre', '56', '10.240531, 106.386561'),
(124, 'Vĩnh Long', '57', '10.256434, 105.955326'),
(125, 'Trà Vinh', '58', '9.948226, 106.326362'),
(126, 'Sóc Trăng', '59', '9.602773, 106.011569'),
(127, 'Bạc Liêu', '60', '9.256579, 105.747760'),
(128, 'Cà Mau', '61', '9.148707, 105.125413'),
(129, 'Điện Biên', '62', '21.456684, 103.074018'),
(130, 'Đăk Nông', '63', '11.997587, 107.751167'),
(131, 'Hậu Giang', '64', '9.775683, 105.456500'),
(132, 'TP Hà nội cũ', '01A', ''),
(133, 'Tỉnh Hà tây cũ', '01B', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caidat`
--
ALTER TABLE `caidat`
  ADD PRIMARY KEY (`cd_ma`);

--
-- Indexes for table `dangky`
--
ALTER TABLE `dangky`
  ADD PRIMARY KEY (`dk_id`),
  ADD KEY `dk_gs_id` (`dk_gs_id`),
  ADD KEY `dk_ld_id` (`dk_ld_id`);

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`dg_id`),
  ADD KEY `ld_id` (`ld_id`),
  ADD KEY `tk_id` (`tk_id`);

--
-- Indexes for table `daylop`
--
ALTER TABLE `daylop`
  ADD PRIMARY KEY (`dl_id`),
  ADD KEY `dl_gs_id` (`dl_gs_id`);

--
-- Indexes for table `giasu`
--
ALTER TABLE `giasu`
  ADD PRIMARY KEY (`gs_tk_id`);

--
-- Indexes for table `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`lh_id`),
  ADD KEY `lh_tk_id` (`lh_tk_id`);

--
-- Indexes for table `lopday`
--
ALTER TABLE `lopday`
  ADD PRIMARY KEY (`ld_id`),
  ADD KEY `ph_tk_id` (`ph_tk_id`);

--
-- Indexes for table `nhansu`
--
ALTER TABLE `nhansu`
  ADD PRIMARY KEY (`ns_tk_id`);

--
-- Indexes for table `phuhuynh`
--
ALTER TABLE `phuhuynh`
  ADD PRIMARY KEY (`ph_tk_id`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`tk_id`);

--
-- Indexes for table `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`tb_id`),
  ADD KEY `tb_tk_id` (`tb_tk_id`);

--
-- Indexes for table `tinh`
--
ALTER TABLE `tinh`
  ADD PRIMARY KEY (`ID_TINH`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caidat`
--
ALTER TABLE `caidat`
  MODIFY `cd_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dangky`
--
ALTER TABLE `dangky`
  MODIFY `dk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `dg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `daylop`
--
ALTER TABLE `daylop`
  MODIFY `dl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `lh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lopday`
--
ALTER TABLE `lopday`
  MODIFY `ld_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `tk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `tb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tinh`
--
ALTER TABLE `tinh`
  MODIFY `ID_TINH` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dangky`
--
ALTER TABLE `dangky`
  ADD CONSTRAINT `dangky_ibfk_2` FOREIGN KEY (`dk_ld_id`) REFERENCES `lopday` (`ld_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dangky_ibfk_3` FOREIGN KEY (`dk_gs_id`) REFERENCES `giasu` (`gs_tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`tk_id`) REFERENCES `taikhoan` (`tk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `danhgia_ibfk_2` FOREIGN KEY (`ld_id`) REFERENCES `lopday` (`ld_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `daylop`
--
ALTER TABLE `daylop`
  ADD CONSTRAINT `daylop_ibfk_1` FOREIGN KEY (`dl_gs_id`) REFERENCES `giasu` (`gs_tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `giasu`
--
ALTER TABLE `giasu`
  ADD CONSTRAINT `giasu_ibfk_1` FOREIGN KEY (`gs_tk_id`) REFERENCES `taikhoan` (`tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lienhe`
--
ALTER TABLE `lienhe`
  ADD CONSTRAINT `lienhe_ibfk_1` FOREIGN KEY (`lh_tk_id`) REFERENCES `taikhoan` (`tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lopday`
--
ALTER TABLE `lopday`
  ADD CONSTRAINT `lopday_ibfk_1` FOREIGN KEY (`ph_tk_id`) REFERENCES `phuhuynh` (`ph_tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nhansu`
--
ALTER TABLE `nhansu`
  ADD CONSTRAINT `nhansu_ibfk_1` FOREIGN KEY (`ns_tk_id`) REFERENCES `taikhoan` (`tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phuhuynh`
--
ALTER TABLE `phuhuynh`
  ADD CONSTRAINT `phuhuynh_ibfk_1` FOREIGN KEY (`ph_tk_id`) REFERENCES `taikhoan` (`tk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thongbao`
--
ALTER TABLE `thongbao`
  ADD CONSTRAINT `thongbao_ibfk_1` FOREIGN KEY (`tb_tk_id`) REFERENCES `taikhoan` (`tk_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
