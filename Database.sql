-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 08:08 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbnienluan`
--
CREATE DATABASE IF NOT EXISTS `dbnienluan` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `dbnienluan`;

-- --------------------------------------------------------

--
-- Table structure for table `canbo`
--

DROP TABLE IF EXISTS `canbo`;
CREATE TABLE `canbo` (
  `MACB` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MADV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HOTENCB` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NSCB` text COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CHUCVU` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `canbo`
--

INSERT INTO `canbo` (`MACB`, `MADV`, `HOTENCB`, `NSCB`, `EMAIL`, `CHUCVU`) VALUES
('A01', 'DI', 'Phạm Tuấn Anh', '18-2-1987', 'pdkhang@yahoo.com', 'Giảng viên'),
('A02', 'KT', 'Nguyễn Hoàng Long', '18-2-1987', 'Longnh@vlute.edu.vn', 'Giảng viên'),
('A03', 'KT', 'Tạ Văn Ninh', '18-2-1987', 'ninh@vlute.edu.vn', 'Kế toán'),
('A033', 'KT', 'Phạm Duy Khang', '01-12-1996', 'khangb1400562@student.ctu.edu.vn', 'Kế toán'),
('A04', 'DI', 'Lưu Thị Dung', '18-2-1987', 'khangb1400562@student.ctu.edu.vn', 'Giảng viên'),
('A05', 'PDT', 'Vũ Duy Sáng', '18-2-1987', 'sang@vlute.edu.vn', 'Trưởng phòng'),
('A06', 'PDT', 'Nguyễn Thị Châm', '18-2-1987', 'chamnt@vlute.edu.vn', 'Trưởng khoa'),
('A07', 'KT', 'Nguyễn Đức Hữu', '18-2-1987', 'khangy9a1@gmail.com', 'Quản trị'),
('A10', 'DI', 'Phạm Duy Khang', '22-12-1996', 'khangy9a1@gmail.com', ''),
('A32', 'DI', 'La Ngọc Nguyên', '30-03-1996', 'nguyenb1400647@student.ctu.edu.vn', 'Trưởng phòng'),
('B08', 'PDT', 'Nguyễn Văn Quyết', '18-2-1987', 'pdkhang@gmail.com', 'Kế toán'),
('B09', 'KT', 'Trần Thị Vân', '18-2-1987', 'anb1400562@student.ctu.edu.vn', 'Trưởng phòng'),
('B10', 'DI', 'Nguyễn Đức Thuấn', '18-2-1987', 'thuannd@vlute.edu.vn', 'Quản trị'),
('C12', 'DI', 'Pham Văn Phi', '22-12-1998', 'ninh@vlute.edu.vn', 'Quản trị'),
('E02', 'DI', 'Lâm Nhật Hạ', '', 'haln@localhos', NULL),
('L1', 'PDT', 'ádasdasd', '01-12-1996', 'khangy9a1@gmail.com', 'Giảng viên'),
('M02', 'PDT', 'Phạm Duy Khang', '02-01-1995', 'khangb1400562@gmail.com', 'Quản trị'),
('S01', 'KT', 'Phạm Hồng Thuận', '30-03-1996', 'thuans01@gmail.com', 'Trưởng phòng'),
('T01', 'DI', 'Phạm Duy Khang', '30-03-1996', 'khangb1400562@student.ctu.edu.vn', 'Quản trị');

-- --------------------------------------------------------

--
-- Table structure for table `cauhinhemail`
--

DROP TABLE IF EXISTS `cauhinhemail`;
CREATE TABLE `cauhinhemail` (
  `stt` int(11) NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `SMTPSecure` text COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `server` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cauhinhemail`
--

INSERT INTO `cauhinhemail` (`stt`, `username`, `password`, `SMTPSecure`, `port`, `server`) VALUES
(1, 'pkhangdk@gmail.com', 'a01669503067', 'tls', 587, 'smtp.gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

DROP TABLE IF EXISTS `chucvu`;
CREATE TABLE `chucvu` (
  `macv` int(3) NOT NULL,
  `TenChucVu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Url` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`macv`, `TenChucVu`, `Url`) VALUES
(1, 'Quản trị', 'Admin/Adminlogin.php'),
(2, 'Kế toán', 'KeToan/KetoanLogin.php'),
(3, 'Trưởng phòng', 'GiangVien/QLlogin.php'),
(4, 'Trưởng Khoa', 'GiangVien/QLlogin.php'),
(5, 'Giảng viên', 'GiangVien/GianVienLogin.php'),
(6, 'Nhân viên', 'GiangVien/GianVienLogin.php');

-- --------------------------------------------------------

--
-- Table structure for table `donvi`
--

DROP TABLE IF EXISTS `donvi`;
CREATE TABLE `donvi` (
  `MADV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TENDV` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donvi`
--

INSERT INTO `donvi` (`MADV`, `TENDV`) VALUES
('DI', 'Khoa CNTT'),
('KT', 'Kinh tế'),
('PDT', 'Phòng đào tạo'),
('PTV', 'Phòng tài vụ');

-- --------------------------------------------------------

--
-- Table structure for table `luongchitiet`
--

DROP TABLE IF EXISTS `luongchitiet`;
CREATE TABLE `luongchitiet` (
  `MABL` int(11) NOT NULL,
  `MACB` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `LUONGCOBAN` decimal(10,0) NOT NULL,
  `ANTRUA` decimal(10,0) DEFAULT NULL,
  `DIENTHOAI` decimal(10,0) DEFAULT NULL,
  `XANGXE/DILAI` decimal(10,0) DEFAULT NULL,
  `NUOICON` decimal(10,0) DEFAULT NULL,
  `PCTN` decimal(10,0) DEFAULT NULL,
  `TONGLUONG` decimal(10,0) NOT NULL,
  `NGAYCONG` decimal(3,0) NOT NULL,
  `TONGTHU` decimal(10,0) NOT NULL,
  `TNCN` decimal(10,0) NOT NULL,
  `BHXH` decimal(10,0) NOT NULL,
  `CPBHXH` decimal(10,0) NOT NULL,
  `CPBHYT` decimal(10,0) NOT NULL,
  `CPBHTN` decimal(10,0) NOT NULL,
  `KPCD` decimal(10,0) NOT NULL,
  `TONGCP` decimal(10,0) NOT NULL,
  `LNV_BHXH` decimal(10,0) NOT NULL,
  `LNV_BHYT` decimal(10,0) NOT NULL,
  `LNV_BHTN` decimal(10,0) NOT NULL,
  `LNV_CONG` decimal(10,0) NOT NULL,
  `GTBANTHAN` decimal(10,0) DEFAULT NULL,
  `GTNGUOIPT` decimal(10,0) DEFAULT NULL,
  `THUNHAPBITINHTNCN` decimal(10,0) DEFAULT NULL,
  `THUETNCN` decimal(10,0) DEFAULT NULL,
  `TAMUNG` decimal(10,0) DEFAULT NULL,
  `THUCLINH` decimal(10,0) DEFAULT NULL,
  `curday` date DEFAULT NULL,
  `Thang` int(10) DEFAULT NULL,
  `Nam` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `luongchitiet`
--

INSERT INTO `luongchitiet` (`MABL`, `MACB`, `LUONGCOBAN`, `ANTRUA`, `DIENTHOAI`, `XANGXE/DILAI`, `NUOICON`, `PCTN`, `TONGLUONG`, `NGAYCONG`, `TONGTHU`, `TNCN`, `BHXH`, `CPBHXH`, `CPBHYT`, `CPBHTN`, `KPCD`, `TONGCP`, `LNV_BHXH`, `LNV_BHYT`, `LNV_BHTN`, `LNV_CONG`, `GTBANTHAN`, `GTNGUOIPT`, `THUNHAPBITINHTNCN`, `THUETNCN`, `TAMUNG`, `THUCLINH`, `curday`, `Thang`, `Nam`) VALUES
(129, 'A01', '6000000', '730000', '3000000', '3000000', '3000000', '2000000', '17730000', '27', '18411923', '14681923', '8000000', '1440000', '240000', '80000', '160000', '1920000', '640000', '120000', '80000', '840000', '9000000', '3600000', '1241923', '62096', NULL, '17509827', '2017-11-22', 1, 2017),
(130, 'A02', '5500000', '730000', '2000000', '3000000', '3000000', '1500000', '15730000', '27', '16335000', '13605000', '7000000', '1260000', '210000', '70000', '140000', '1680000', '560000', '105000', '70000', '735000', '9000000', '3600000', '270000', '13500', NULL, '15586500', '2017-11-22', 1, 2017),
(131, 'A03', '5500000', '730000', '1000000', '1000000', '1000000', '1000000', '10230000', '26', '10230000', '8500000', '6500000', '1170000', '195000', '65000', '130000', '1560000', '520000', '97500', '65000', '682500', '9000000', '3600000', '0', NULL, NULL, '9547500', '2017-11-22', 1, 2017),
(132, 'M02', '10000000', '900000', '1200000', '600000', NULL, NULL, '12700000', '26', '12700000', '10600000', '10000000', '1800000', '300000', '100000', '200000', '2400000', '800000', '150000', '100000', '1050000', NULL, NULL, '9550000', NULL, NULL, '11650000', '2017-11-22', 1, 2017),
(133, 'A04', '70000000', '600000', '300000', '200000', NULL, NULL, '71100000', '26', '71100000', '70200000', '70000000', '12600000', '2100000', '700000', '1400000', '16800000', '5600000', '1050000', '700000', '7350000', '9000000', NULL, '53850000', NULL, NULL, '63750000', '2017-11-22', 1, 2017),
(134, 'A05', '4500000', '600000', '300000', '200000', NULL, NULL, '5600000', '26', '5600000', '4700000', '4500000', '810000', '135000', '45000', '90000', '1080000', '360000', '67500', '45000', '472500', '9000000', NULL, '0', NULL, NULL, '5127500', '2017-11-22', 1, 2017),
(135, 'A06', '4200000', '600000', '300000', '200000', NULL, NULL, '5300000', '26', '5300000', '4400000', '4200000', '756000', '126000', '42000', '84000', '1008000', '336000', '63000', '42000', '441000', '9000000', NULL, '0', NULL, NULL, '4859000', '2017-11-22', 1, 2017),
(136, 'A07', '4100000', '500000', '200000', '200000', NULL, NULL, '5000000', '25', '4807692', '4107692', '4100000', '738000', '123000', '41000', '82000', '984000', '328000', '61500', '41000', '430500', '9000000', NULL, '0', NULL, NULL, '4377192', '2017-11-22', 1, 2017),
(137, 'B08', '5000000', '700000', '2000000', '1000000', '500000', '1000000', '10200000', '26', '10200000', '7500000', '6000000', '1080000', '180000', '60000', '120000', '1440000', '480000', '90000', '60000', '630000', '9000000', '3600000', '0', NULL, '2000000', '7570000', '2017-11-22', 1, 2017),
(138, 'B09', '4500000', '600000', '300000', '200000', NULL, NULL, '5600000', '24', '5169231', '4269231', '4500000', '810000', '135000', '45000', '90000', '1080000', '360000', '67500', '45000', '472500', '9000000', NULL, '0', NULL, NULL, '4696731', '2017-11-22', 1, 2017),
(139, 'A32', '12522222', '660000', '1562442', '1533255', NULL, NULL, '16277919', '29', '18156140', '15933698', '12522222', '2254000', '375667', '125222', '250444', '3005333', '1001778', '187833', '125222', '1314833', NULL, NULL, NULL, NULL, NULL, '16841307', '2017-11-22', 1, 2017),
(140, 'B10', '4100000', '500000', '200000', '200000', NULL, NULL, '5000000', '26', '5000000', '4300000', '4100000', '738000', '123000', '41000', '82000', '984000', '328000', '61500', '41000', '430500', '9000000', NULL, '0', NULL, NULL, '4569500', '2017-11-22', 1, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `stt`
--

DROP TABLE IF EXISTS `stt`;
CREATE TABLE `stt` (
  `stt` int(2) NOT NULL,
  `TrangThai` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stt`
--

INSERT INTO `stt` (`stt`, `TrangThai`) VALUES
(0, 'Khóa'),
(1, 'Sử dụng');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

DROP TABLE IF EXISTS `taikhoan`;
CREATE TABLE `taikhoan` (
  `MATK` int(10) NOT NULL,
  `MACB` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `USERNAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TRANGTHAI` int(11) NOT NULL,
  `CAPDO` int(11) NOT NULL,
  `NGAYTAO` date NOT NULL,
  `NgayUpDate` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`MATK`, `MACB`, `USERNAME`, `PASSWORD`, `TRANGTHAI`, `CAPDO`, `NGAYTAO`, `NgayUpDate`) VALUES
(10, 'A01', 'anha01', 'e10adc3949ba59abbe56e057f20f883e', 1, 5, '2017-10-08', '2017-11-22'),
(11, 'A02', 'longa02', 'e10adc3949ba59abbe56e057f20f883e', 1, 2, '2017-10-08', NULL),
(13, 'A04', 'dunga04', 'e10adc3949ba59abbe56e057f20f883e', 1, 5, '2017-10-08', '2017-10-27'),
(14, 'A05', 'sanga05', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, '2017-10-08', NULL),
(15, 'A06', 'chama06', 'e10adc3949ba59abbe56e057f20f883e', 1, 4, '2017-10-08', NULL),
(16, 'A07', 'huua07', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2017-10-08', '2017-10-16'),
(17, 'B08', 'quyetab08', 'e10adc3949ba59abbe56e057f20f883e', 1, 2, '2017-10-08', NULL),
(18, 'B09', 'vanb09', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, '2017-10-08', NULL),
(19, 'B10', 'thuanb10', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2017-10-08', NULL),
(21, 'M02', 'khangm02', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2017-10-10', '2017-10-16'),
(26, 'A32', 'nguyen303', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, '2017-10-13', '2017-11-07'),
(27, 'S01', 'thuans01', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, '2017-10-13', NULL),
(28, 'C12', 'phic12', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2017-10-04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canbo`
--
ALTER TABLE `canbo`
  ADD PRIMARY KEY (`MACB`),
  ADD UNIQUE KEY `CANBO_PK` (`MACB`),
  ADD KEY `CB_KHOA_FK` (`MADV`);

--
-- Indexes for table `cauhinhemail`
--
ALTER TABLE `cauhinhemail`
  ADD PRIMARY KEY (`stt`);

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`macv`);

--
-- Indexes for table `donvi`
--
ALTER TABLE `donvi`
  ADD PRIMARY KEY (`MADV`),
  ADD UNIQUE KEY `KHOA_PK` (`MADV`);

--
-- Indexes for table `luongchitiet`
--
ALTER TABLE `luongchitiet`
  ADD UNIQUE KEY `BANGLUONG_PK` (`MABL`),
  ADD KEY `BL_CB_FK` (`MACB`);

--
-- Indexes for table `stt`
--
ALTER TABLE `stt`
  ADD PRIMARY KEY (`stt`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MATK`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`),
  ADD UNIQUE KEY `TAIKHOAN_PK` (`MATK`),
  ADD UNIQUE KEY `MACB` (`MACB`),
  ADD KEY `CB_TK2_FK` (`MACB`),
  ADD KEY `TRANGTHAI` (`TRANGTHAI`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cauhinhemail`
--
ALTER TABLE `cauhinhemail`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `macv` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `luongchitiet`
--
ALTER TABLE `luongchitiet`
  MODIFY `MABL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MATK` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `canbo`
--
ALTER TABLE `canbo`
  ADD CONSTRAINT `FK_CANBO_CANBO_THU_DONVI` FOREIGN KEY (`MADV`) REFERENCES `donvi` (`MADV`);

--
-- Constraints for table `luongchitiet`
--
ALTER TABLE `luongchitiet`
  ADD CONSTRAINT `FK_LUONGCHI_CANBO_LUO_CANBO` FOREIGN KEY (`MACB`) REFERENCES `canbo` (`MACB`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `FK_TAIKHOAN_CANBO_TAI_CANBO` FOREIGN KEY (`MACB`) REFERENCES `canbo` (`MACB`),
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`TRANGTHAI`) REFERENCES `stt` (`stt`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
