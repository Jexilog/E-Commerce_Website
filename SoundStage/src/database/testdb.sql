-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 01:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items_tbl`
--

CREATE TABLE `cart_items_tbl` (
  `CartItem_ID` int(11) NOT NULL,
  `Cart_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Qty` int(11) NOT NULL DEFAULT 1,
  `Unit_price` decimal(10,2) NOT NULL,
  `Total_price` decimal(10,2) NOT NULL,
  `Added_AT` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE `cart_tbl` (
  `Cart_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Total_price` decimal(10,2) NOT NULL,
  `Added_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `Category_ID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryDesc` text NOT NULL,
  `Created_AT` datetime NOT NULL,
  `Icon_URL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`Category_ID`, `CategoryName`, `CategoryDesc`, `Created_AT`, `Icon_URL`) VALUES
(1, 'IEM', 'In-Ear Monitors', '0000-00-00 00:00:00', '/AudioHub/src/assets/icons/iem-icon.png'),
(2, 'Accessories', 'Audio Accessories', '0000-00-00 00:00:00', '/AudioHub/src/assets/icons/accessory-icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_tbl`
--

CREATE TABLE `checkout_tbl` (
  `Checkout_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Cart_ID` int(11) NOT NULL,
  `Total_Amount` decimal(10,2) NOT NULL,
  `PaymentMet` varchar(50) NOT NULL,
  `TransactionStat` varchar(50) NOT NULL,
  `CheckoutTstamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `Product_ID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Category_ID` int(11) DEFAULT NULL,
  `Brand` varchar(100) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Stock_QTY` int(11) DEFAULT 0,
  `Image_URL` varchar(255) DEFAULT NULL,
  `Added_AT` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`Product_ID`, `ProductName`, `Description`, `Category_ID`, `Brand`, `Price`, `Stock_QTY`, `Image_URL`, `Added_AT`) VALUES
(1, 'Moondrop Aria 2', 'Ceramic-coated dynamic driver for smooth sound.', 1, 'Moondrop', 5119.00, 10, '../../assets/uploads/68416699eec5b_moondrop-aria-2.webp', '2025-06-05 00:00:00'),
(2, 'Moondrop Blessing 3', 'Hybrid driver IEM with reference-grade tuning.', 1, 'Moondrop', 19990.00, 10, '../../assets/uploads/684166d5e74ce_moondrop-blessing-3.jpg', '2025-06-05 00:00:00'),
(3, 'Moondrop Kato', 'Durable, stage-ready IEM with punchy bass and detachable cables.', 1, 'Moondrop', 8999.00, 10, '../../assets/uploads/6841673581f8c_moondrop-kato.webp', '2025-06-05 00:00:00'),
(4, 'Moondrop Variations', 'Tribrid electrostatic driver IEM for high-resolution audio.', 1, 'Moondrop', 28999.00, 10, '../../assets/uploads/684167f005340_moondrop-variation.webp', '2025-06-05 00:00:00'),
(5, 'Moondrop CHU II', 'Budget-friendly dynamic driver IEM with detachable cable.', 1, 'Moondrop', 1059.00, 10, '../../assets/uploads/6841682dcc958_moondrop-chu-2.webp', '2025-06-05 00:00:00'),
(6, 'Shure SE215', 'Single dynamic driver with sound isolation for clear audio and deep bass.', 1, 'Shure', 1624.00, 10, '../../assets/uploads/6841689317279_new-se215.avif', '2025-06-05 00:00:00'),
(7, 'Shure SE535', 'Triple balanced armature drivers for rich, detailed sound.', 1, 'Shure', 2211.00, 10, '../../assets/uploads/684168c5a0f6b_new-se535.avif', '2025-06-05 00:00:00'),
(8, 'Shure SE846', 'Quad-driver IEM with professional-grade sound and deep bass.', 1, 'Shure', 44990.00, 10, '../../assets/uploads/684169013f50a_new-se846.avif', '2025-06-05 00:00:00'),
(9, 'Shure AONIC 215', 'Wireless IEM with sound isolation and dynamic drivers.', 1, 'Shure', 6380.00, 10, '../../assets/uploads/6841694d07b59_new-aonic215.avif', '2025-06-05 00:00:00'),
(10, 'Shure AONIC 4', 'Dual-driver hybrid earphone designed for warm, detailed sound with sound isolation.', 1, 'Shure', 9083.00, 10, '../../assets/uploads/68416991c883f_new-aonic4.avif', '2025-06-05 00:00:00'),
(11, 'Sennheiser IE 900', 'Flagship dynamic driver IEM with ultra-low distortion.', 1, 'Sennheiser', 69990.00, 10, '../../assets/uploads/684169d465bcc_ie_900.webp', '2025-06-05 00:00:00'),
(12, 'Sennheiser IE 300', 'Single dynamic driver tuned for warm, detailed sound.', 1, 'Sennheiser', 12990.00, 10, '../../assets/uploads/68416a0e351e7_new-ie300.webp', '2025-06-05 00:00:00'),
(13, 'Sennheiser CX SPORT', 'The Sennheiser CX SPORT is a lightweight, sweat-resistant wireless headset with secure fit and advanced Bluetooth for high-quality sound on the move.', 1, 'Sennheiser', 107737.00, 10, '../../assets/uploads/68416a5bcbd06_new-cxsport.webp', '2025-06-05 00:00:00'),
(14, 'Sennheiser CX 80S', 'The wired CX 80S earphones from Sennheiser deliver a pleasant listening experience with elegant design and durable build quality.', 1, 'Sennheiser', 995.00, 10, '../../assets/uploads/68416aa322def_new-cx80s.png', '2025-06-05 00:00:00'),
(15, 'Sennheiser IE 600', 'The Sennheiser IE 600 offers balanced sound with ultra-resilient amorphous metal housing for lasting durability.', 1, 'Sennheiser', 28245.00, 10, '../../assets/uploads/68416ae7e35de_new-ie600.webp', '2025-06-05 00:00:00'),
(16, 'Audio-Technica ATH-E40', 'Dual-phase push-pull drivers for accurate sound reproduction.', 1, 'Audio-Technica', 5550.00, 10, '../../assets/uploads/68416b31645af_ath-e40.jpg', '2025-06-05 00:00:00'),
(17, 'Audio-Technica ATH-E50', 'Single balanced armature driver for precise audio.', 1, 'Audio-Technica', 7500.00, 10, '../../assets/uploads/68416b70bf8cf_ath-e50.jpg', '2025-06-05 00:00:00'),
(18, 'Audio-Technica ATH-E70', 'Triple balanced armature drivers for studio-quality sound.', 1, 'Audio-Technica', 12500.00, 10, '../../assets/uploads/68416bb3bf858_ath-e70.webp', '2025-06-05 00:00:00'),
(19, 'Audio-Technica ATH-IEX1', 'The ATH-IEX1 features a hybrid multidriver system in solid titanium housing for smooth, natural Hi-Res Audio.', 1, 'Audio-Technica', 82855.00, 10, '../../assets/uploads/68416bf0c7a81_new-ath-iex1.jpg', '2025-06-05 00:00:00'),
(20, 'Audio-Technica ATH LS300iS', 'Wireless in-ear monitor system with wide UHF coverage.', 1, 'Audio-Technica', 26088.00, 10, '../../assets/uploads/68416c220436c_new-ath-ls300iS.jpg', '2025-06-05 00:00:00'),
(21, 'FiiO FD3', 'Single dynamic driver with interchangeable nozzles for tuning.', 1, 'FiiO', 5876.00, 10, '../../assets/uploads/68416c5e9947a_fd3.webp', '2025-06-05 00:00:00'),
(22, 'FiiO FH3', 'Hybrid IEM with beryllium-plated dynamic driver and BA drivers.', 1, 'FiiO', 4500.00, 10, '../../assets/uploads/68416ca94b0b5_fh3.jpg', '2025-06-05 00:00:00'),
(23, 'FiiO FD11', 'Budget-friendly dynamic driver IEM with detachable cable.', 1, 'FiiO', 2500.00, 10, '../../assets/uploads/68416cda58199_fd11.webp', '2025-06-05 00:00:00'),
(24, 'FiiO FH5', 'Quad-driver hybrid IEM with Knowles BA drivers.', 1, 'FiiO', 8500.00, 10, '../../assets/uploads/68416d0e8102b_fh5.jpg', '2025-06-05 00:00:00'),
(25, 'FiiO FA7', 'Quad balanced armature drivers for detailed sound.', 1, 'FiiO', 7999.00, 10, '../../assets/uploads/68416d4352749_fa7.jpg', '2025-06-05 00:00:00'),
(26, 'FiiO KA1 USB Dongle', 'Portable DAC/amp for high-quality audio on the go.', 2, 'FiiO', 2200.00, 10, '../../assets/uploads/6841751179db1_fiio-ka1.webp', '2025-06-05 00:00:00'),
(27, 'Moondrop Dawn USB Dongle', 'Upgrade your IEMs with this high-quality, tangle-free cable.', 2, 'Moondrop', 4000.00, 10, '../../assets/uploads/68417544bb2cf_moondrop-dawn.jpg', '2025-06-05 00:00:00'),
(28, 'Tripowin Zonie', 'Upgrade your IEMs with this high-quality, tangle-free cable.', 2, 'Tripowin', 850.00, 10, '../../assets/uploads/68417584b7ee0_Tripowin_Zonie.webp', '2025-06-05 00:00:00'),
(29, 'Tripowin Grace', 'High-quality silver-plated copper cable for enhanced sound quality.', 2, 'Tripowin', 1200.00, 10, '../../assets/uploads/684175beece72_TRIPOWINGrace.webp', '2025-06-05 00:00:00'),
(30, 'DD Hifi Carrying Case', 'Compact and stylish carrying case for your IEMs and accessories.', 2, 'ddHiFi', 1000.00, 10, '../../assets/uploads/684176154b8d5_ddhifi-c100.webp', '2025-06-05 00:00:00'),
(31, 'Moondrop Leather Carrying Case', 'Stylish and durable pouch for your IEMs.', 2, 'Moondrop', 850.00, 10, '../../assets/uploads/6841763d4a874_moondrop-space-travel-leather-case.webp', '2025-06-05 00:00:00'),
(32, 'SpinFit CP145 Eartips', 'Premium silicone eartips for a comfortable and secure fit.', 2, 'SpinFit', 1200.00, 10, '../../assets/uploads/6841767ec9506_spinfit-eartips.webp', '2025-06-05 00:00:00'),
(33, 'FiiO 2.5mm-3.5mm Adapter', 'Adapter for connecting 2.5mm balanced cables to 3.5mm jacks.', 2, 'FiiO', 350.00, 10, '../../assets/uploads/684176b8e678a_FiiO-BL35.webp', '2025-06-05 00:00:00'),
(34, 'MOONDROP DISCDREAM2 Portable CD Player', 'Moondrop DiscDream 2 – Premium portable CD player with audiophile-grade sound.', 2, 'Moondrop', 10040.00, 10, '../../assets/uploads/6844242c0e3ff_discdream2.avif', '2025-06-07 00:00:00'),
(35, 'MOONDROP LITTLEWHITE Bluetooth Neckband', 'Moondrop LittleWhite – HiFi Bluetooth neckband with premium sound and ENC.', 2, 'Moondrop', 5578.00, 10, '../../assets/uploads/684424ad088e9_littlewhite-neckband.avif', '2025-06-07 00:00:00'),
(36, 'MOONDROP ECHO-A 32Bit/384kHz', 'Moondrop Echo-A – Compact 32Bit/384kHz USB-C DAC/AMP with high-resolution audio.', 2, 'Moondrop', 1226.00, 10, '../../assets/uploads/684425b4d9e85_echo-a.avif', '2025-06-07 00:00:00'),
(37, 'Tripowin GranVia', 'Tripowin GranVia is a premium oxygen-free copper headphone cable with 26AWG Litz structure, offering enhanced sound quality, smooth bass, and high-frequency precision, designed for Sennheiser, HIFIMAN, and other high-end headphones to deliver an immersive HiFi experience.', 2, 'Tripowin', 2733.00, 7, '../../assets/uploads/684426b7e0c39_TRIPOWINGrace1.webp', '2025-06-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `recent_activity`
--

CREATE TABLE `recent_activity` (
  `id` int(11) NOT NULL,
  `activity_desc` varchar(255) NOT NULL,
  `activity_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `User_ID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email_Add` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Created_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('active','inactive','banned','unbanned','pending') NOT NULL,
  `Verification_Code` varchar(255) DEFAULT NULL,
  `OTP` timestamp NULL DEFAULT NULL,
  `Reset_Token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`User_ID`, `FirstName`, `LastName`, `Email_Add`, `Password`, `Created_AT`, `Updated_AT`, `Status`, `Verification_Code`, `OTP`, `Reset_Token`) VALUES
(1, 'Carlos', 'Reyes', 'carlosemmanuelreyes15@gmail.com', '$2y$10$0YdmZDSuJYfh6l1lbjZc1Ohm9fxh1suo4/DlRjbzW3HCiTD9rPag.', '2025-06-04 07:38:08', '2025-06-04 07:38:08', 'active', NULL, NULL, NULL),
(2, 'Justine', 'Valdez', 'justinevaldez@gmail.com', '$2y$10$ndaSEFtfRBbJhnnhmXF1DujtELiACm0w80.yQiwHNXuU.wXtmlzAC', '2025-06-05 09:29:36', '2025-06-05 09:29:36', 'active', NULL, NULL, NULL),
(3, 'Zynnah', 'Ladines', 'kenn27.ladines27@gmail.com', '$2y$10$dUGOrhrU1lPlsaBavDfne.k8fktAFbq1.j93cInfz4aGSAmkDW8Vq', '2025-06-05 10:17:03', '2025-06-05 10:17:03', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

CREATE TABLE `user_history` (
  `History_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Last_Login` timestamp NULL DEFAULT NULL,
  `Last_Logout` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `Wishlist_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Added_At` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`Wishlist_ID`, `User_ID`, `Product_ID`, `Added_At`) VALUES
(1, 3, 31, '2025-06-06 16:27:56'),
(2, 3, 29, '2025-06-06 16:28:04'),
(3, 1, 5, '2025-06-06 16:28:59'),
(4, 1, 2, '2025-06-06 16:29:06'),
(5, 1, 25, '2025-06-06 16:29:13'),
(6, 2, 22, '2025-06-06 17:14:51'),
(7, 2, 3, '2025-06-06 17:15:00'),
(8, 2, 7, '2025-06-06 17:15:10'),
(9, 3, 30, '2025-06-07 18:56:58'),
(10, 3, 28, '2025-06-07 18:57:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items_tbl`
--
ALTER TABLE `cart_items_tbl`
  ADD PRIMARY KEY (`CartItem_ID`),
  ADD KEY `fk_cart_items_cart` (`Cart_ID`),
  ADD KEY `fk_cart_items_product` (`Product_ID`);

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`Cart_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `checkout_tbl`
--
ALTER TABLE `checkout_tbl`
  ADD PRIMARY KEY (`Checkout_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`),
  ADD UNIQUE KEY `Cart_ID` (`Cart_ID`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `fk_category` (`Category_ID`);

--
-- Indexes for table `recent_activity`
--
ALTER TABLE `recent_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Email_Add` (`Email_Add`);

--
-- Indexes for table `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`History_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`Wishlist_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Product_ID` (`Product_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items_tbl`
--
ALTER TABLE `cart_items_tbl`
  MODIFY `CartItem_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `Cart_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `checkout_tbl`
--
ALTER TABLE `checkout_tbl`
  MODIFY `Checkout_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `recent_activity`
--
ALTER TABLE `recent_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_history`
--
ALTER TABLE `user_history`
  MODIFY `History_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `Wishlist_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items_tbl`
--
ALTER TABLE `cart_items_tbl`
  ADD CONSTRAINT `fk_cart_items_cart` FOREIGN KEY (`Cart_ID`) REFERENCES `cart_tbl` (`Cart_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_items_product` FOREIGN KEY (`Product_ID`) REFERENCES `product_tbl` (`Product_ID`) ON DELETE CASCADE;

--
-- Constraints for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD CONSTRAINT `cart_tbl_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_accounts` (`User_ID`);

--
-- Constraints for table `checkout_tbl`
--
ALTER TABLE `checkout_tbl`
  ADD CONSTRAINT `checkout_tbl_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_accounts` (`User_ID`),
  ADD CONSTRAINT `checkout_tbl_ibfk_2` FOREIGN KEY (`Cart_ID`) REFERENCES `cart_tbl` (`Cart_ID`);

--
-- Constraints for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`Category_ID`) REFERENCES `category_tbl` (`Category_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_history`
--
ALTER TABLE `user_history`
  ADD CONSTRAINT `user_history_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_accounts` (`User_ID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_accounts` (`User_ID`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`Product_ID`) REFERENCES `product_tbl` (`Product_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
