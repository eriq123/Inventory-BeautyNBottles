-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2019 at 02:11 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beautynbottles_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Crystal/Pearl/Acid'),
(2, 'Laundry/Detergent'),
(3, 'Bath gel/Shampoo/Soap'),
(4, 'Extract'),
(5, 'Liquid'),
(6, 'Organic Oil'),
(7, 'Tubes'),
(8, 'Glass Container'),
(9, 'Roller Bottle'),
(10, 'Plastic Lab Tool'),
(11, 'Shrink Wrap'),
(12, 'Shrink Wrap Roll'),
(13, 'Shrink Band'),
(14, 'Closure'),
(15, 'Vial/Sampler'),
(19, 'Pet Bottle'),
(20, 'Cosmetic Tool'),
(21, 'Plastic Container'),
(22, 'Others'),
(23, 'Tin Can'),
(24, 'Essential Oil');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_image` longtext COLLATE utf8mb4_unicode_ci,
  `selling_price` int(11) NOT NULL DEFAULT '0',
  `purchase_price` int(11) NOT NULL DEFAULT '0',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_limit` int(11) NOT NULL DEFAULT '0',
  `item_quantity` int(11) NOT NULL DEFAULT '0',
  `item_unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_description`, `item_image`, `selling_price`, `purchase_price`, `category_id`, `sub_category_id`, `item_limit`, `item_quantity`, `item_unit`) VALUES
(1, 'Acti-Stem Cell', '5ml', NULL, 13000, 12000, 4, NULL, 100, 50, 'ml'),
(2, 'Acti-Stem Cell', '10ml', NULL, 20500, 19500, 4, NULL, 200, 100, 'ml'),
(3, 'Acti-Stem Cell', '15ml', NULL, 28000, 27000, 4, NULL, 300, 150, 'ml'),
(4, 'Acti-Stem Cell', '30ml', NULL, 48000, 47000, 4, NULL, 600, 300, 'ml'),
(5, 'Pore Min', '5ml', '2-201908271855-PicsArt_05-24-02.27.39.jpg', 9500, 8500, 4, NULL, 100, 50, 'ml'),
(6, 'Pore Min', '10ml', NULL, 18000, 17000, 4, NULL, 200, 100, 'ml'),
(7, 'Pore Min', '15ml', NULL, 25500, 24500, 4, NULL, 300, 135, 'ml'),
(8, 'Pore Min', '30ml', NULL, 42000, 41000, 4, NULL, 600, 300, 'ml'),
(9, 'AF 24 (anti-acne and pimple treatment ingredient)', '5ml', NULL, 10000, 9000, 4, NULL, 100, 50, 'ml'),
(10, 'Acti-Stem Cell', '10ml', NULL, 18000, 17000, 4, NULL, 200, 80, 'ml'),
(11, 'AF 24 (anti-acne and pimple treatment ingredient)', '15ml', NULL, 25500, 24500, 4, NULL, 300, 150, 'ml'),
(12, 'AF 24 (anti-acne and pimple treatment ingredient)', '30ml', NULL, 42500, 41500, 4, NULL, 600, 300, 'ml'),
(13, 'Bust-Up (water based)', '5ml', NULL, 10000, 9000, 4, NULL, 100, 100, 'ml'),
(14, 'Bust-up (water-based)', '10ml', NULL, 18000, 17000, 4, NULL, 200, 100, 'ml'),
(15, 'Bust-up (water-based)', '30ml', NULL, 25000, 24000, 4, NULL, 600, 270, 'ml'),
(16, 'Carrot Extract', '10ml', NULL, 6000, 5000, 4, NULL, 200, 100, 'ml'),
(17, 'Carrot Extract', '30ml', NULL, 15000, 14000, 4, NULL, 600, 240, 'ml'),
(18, 'Carrot Extract', '50ml', NULL, 25000, 24000, 4, NULL, 1000, 500, 'ml'),
(19, 'Snail Extract', '10ml', NULL, 18000, 17000, 4, NULL, 200, 90, 'ml'),
(20, 'Aloe Vera Extract', '30ml, oil-soluble', NULL, 16000, 15000, 4, NULL, 600, 300, 'ml'),
(21, 'Aloe Vera Extract', '30ml, water-soluble', NULL, 16000, 15000, 4, NULL, 600, 300, 'ml'),
(22, 'Aloe Vera Extract', '100ml, oil-soluble', NULL, 40000, 39000, 4, NULL, 2000, 1000, 'ml'),
(23, 'Aloe Vera Extract', '100ml, water-soluble', NULL, 40000, 39000, 4, NULL, 2000, 1000, 'ml'),
(24, 'Multifruit Extract', '30ml', NULL, 29500, 28500, 4, NULL, 600, 150, 'ml'),
(25, 'Papaya Extract', '30ml', NULL, 13000, 12000, 4, NULL, 600, 60, 'ml'),
(26, 'Witch Hazel Extract', '30ml', NULL, 13000, 12000, 4, NULL, 600, 2580, 'ml'),
(27, 'Bearberry Extract', '30ml', NULL, 13000, 12000, 4, NULL, 600, 30, 'ml'),
(28, 'Cucumber Extract', '30ml', NULL, 13000, 12000, 4, NULL, 600, 2940, 'ml'),
(29, 'Tomato Extract', '30ml', NULL, 16000, 15000, 4, NULL, 600, 1350, 'ml'),
(30, 'Tomato Extract', '100ml', NULL, 45000, 44000, 4, NULL, 2000, 4900, 'ml'),
(31, 'Calamansi Extract (water-soluble)', '10ml', NULL, 6500, 5500, 4, NULL, 200, 650, 'ml'),
(32, 'Calamansi Extract (water-soluble)', '30ml', NULL, 15000, 14000, 4, NULL, 600, 240, 'ml'),
(33, 'Calamansi Extract (water-soluble)', '50ml', NULL, 25000, 24000, 4, NULL, 1000, 500, 'ml'),
(34, 'BTMS-50 (Bhentrimonium Methosulfate)', '50g', NULL, 13000, 12000, 3, NULL, 2000, 4250, 'gms'),
(35, 'BTMS-50 (Bhentrimonium Methosulfate)', '100g', NULL, 23000, 22000, 3, NULL, 4000, 17700, 'ml'),
(36, 'Glycerin Soap Base', '1Kg, White', NULL, 28000, 27000, 3, NULL, 5, 17, 'kgs'),
(37, 'Glycerin Soap Base', '1Kg, Clear', NULL, 28000, 27000, 3, NULL, 5, 7, 'kgs'),
(38, 'D-Panthenol (Pro Vitamin B5)', '10g, Clear', NULL, 14500, 13500, 3, NULL, 1000, 120, 'gms'),
(39, 'D-Panthenol (Pro Vitamin B5)', '30g, Clear', NULL, 36000, 35000, 3, NULL, 3000, 2490, 'grams'),
(40, 'Cetyl Alcohol', '100g', NULL, 10000, 9000, 3, NULL, 2000, 9100, 'gms'),
(41, 'Cetyl Alcohol', '250g', NULL, 21000, 20000, 3, NULL, 5000, 24250, 'gms'),
(42, 'Cetyl Alcohol', '500g', NULL, 36000, 35000, 3, NULL, 10000, 47000, 'gms'),
(43, 'Menthol Crystals', '20g', NULL, 11000, 10000, 1, NULL, 400, 520, 'gms'),
(44, 'Menthol Crystals', '50g', NULL, 22000, 21000, 1, NULL, 1000, 2750, 'gms'),
(45, 'Salicylic Acid (diy cosmetic)', '10g', NULL, 3000, 2000, 1, NULL, 200, 200, 'gms'),
(46, 'Salicylic Acid (diy cosmetic)', '25g', NULL, 5500, 4500, 1, NULL, 500, 500, 'gms'),
(47, 'Salicylic Acid (diy cosmetic)', '50g', NULL, 9000, 8000, 1, NULL, 1000, 500, 'gms'),
(48, 'Salicylic Acid (diy cosmetic)', '100g', NULL, 12500, 11500, 1, NULL, 2000, 1000, 'gms'),
(49, 'Dead Sea Salt', '50g, Coarse', NULL, 6000, 5000, 1, NULL, 1000, 500, 'gms'),
(50, 'Dead Sea Salt', '50g, FIne', NULL, 6000, 5000, 1, NULL, 1000, 500, 'gms'),
(51, 'Dead Sea Salt', '100g, Coarse', NULL, 9500, 8500, 1, NULL, 2000, 500, 'gms'),
(52, 'Dead Sea Salt', '100g, Fine', NULL, 9500, 8500, 1, NULL, 2000, 500, 'gms'),
(53, 'Dead Sea Salt', '250g, Coarse', NULL, 22000, 21000, 1, NULL, 5000, 500, 'gms'),
(54, 'Dead Sea Salt', '250g, Fine', NULL, 22000, 21000, 1, NULL, 5000, 750, 'gms'),
(55, 'Argan Oil', '30ml', NULL, 18000, 17000, 6, NULL, 300, 7560, 'ml'),
(56, 'Argan Oil', '50ml', NULL, 25000, 24000, 6, NULL, 500, 13100, 'ml'),
(57, 'Argan Oil', '100ml', NULL, 40000, 38000, 6, NULL, 1000, 27000, 'ml'),
(58, 'Rosehip Oil', '15ml', NULL, 12000, 11000, 6, NULL, 150, 645, 'ml'),
(59, 'Rosehip Oil', '50ml', NULL, 29500, 28500, 6, NULL, 500, 3050, 'ml'),
(60, 'Rosehip Oil', '100ml', NULL, 45000, 44000, 6, NULL, 1000, 9600, 'ml'),
(61, 'Sunflower Oil', '100ml', NULL, 12000, 11000, 6, NULL, 1000, 7900, 'ml'),
(62, 'Pet Jar', 'double wall jar with washer + natural cap', NULL, 2200, 1200, 21, 8, 50, 100, '30g'),
(63, 'Pet Jar', 'single wall jar with washer + natural cap', NULL, 2500, 1500, 21, 8, 50, 100, '100g'),
(64, 'Pet Jar', 'single wall jar + cap with liner', NULL, 2800, 2000, 21, 8, 50, 200, '250g'),
(65, 'Pet Jar', 'with handele single wall jar + cap with liner', NULL, 2900, 2100, 21, 8, 25, 100, '250g with handle'),
(66, 'Pet Jar', 'with handle single wall jar + cap with liner', NULL, 3000, 2500, 21, 8, 50, 100, '500g'),
(67, 'Pet Jar', 'with handle single wall jar + cap with liner', NULL, 3200, 2500, 21, 8, 50, 100, '500g with handle'),
(68, 'Tubs Jar', 'White plastic jar + cap', NULL, 1100, 600, 21, 8, 25, 150, '10g white'),
(69, 'Tubs Jar', 'natural plastic jar + cap', NULL, 1100, 600, 21, 8, 25, 100, '10g natural'),
(70, 'Tubs Jar', 'white plastic jar + cap', NULL, 1600, 900, 21, 8, 50, 95, '50g white'),
(71, 'Tubs Jar', 'natural plastic jar + cap', NULL, 1600, 900, 21, 8, 100, 100, '50g natural'),
(72, 'Tubs Jar', 'white plastic jar + cap', NULL, 1700, 1100, 21, 8, 50, 100, '100g white'),
(73, 'Tubs Jar', 'Natural plastic Jar + cap', NULL, 1700, 1100, 21, 8, 50, 100, '100g natural'),
(74, 'Tubs Jar', 'black plastic jar + cap', NULL, 1600, 1100, 21, 8, 50, 100, '100g black'),
(75, 'Tubs Jar', 'black plastic jar + cap', NULL, 1600, 900, 21, 8, 50, 100, '50g black'),
(76, 'Bart Jar', 'single wall clear jar + cap with liner', NULL, 2200, 1500, 21, 9, 50, 100, '50g'),
(77, 'Bart Jar', 'single wall clear jar with tray inside + cap with liner', NULL, 2200, 1500, 21, 9, 50, 100, '30g'),
(78, 'Bart Jar', 'single wall clear jar with tray inside + cap with liner', NULL, 2200, 1500, 21, 9, 50, 100, '15g'),
(79, 'Square Jar', 'Opaque white jar with tray inside + cap', NULL, 2400, 1600, 21, 9, 50, 100, '30g'),
(80, 'Square Jar', 'opaque white jar with tray inside + cap', NULL, 2400, 1600, 21, 9, 50, 100, '15g'),
(81, '5g lipbalm', '40 microns\r\n70mm x 27mm', NULL, 6500, 2000, 11, 10, 25, 100, 'bundle'),
(82, '10ml liptint', '40 microns\r\n112mm x 31mm', NULL, 8800, 3300, 11, 10, 25, 100, 'bundle'),
(83, '10ml spray', '40 microns\r\n35mm x 114mm', NULL, 9800, 3300, 11, 10, 25, 100, 'bundle'),
(84, '30ml pet sw', '40 microns\r\n116mm x 45mm', NULL, 10800, 4300, 11, 10, 25, 100, 'bundle'),
(85, '10ml /5ml eo sw', '40 microns\r\n79mm x 41mm', NULL, 8800, 2800, 11, 10, 25, 100, 'bundle'),
(86, '15ml glass dropper sw', '40 microns\r\n101mmx 50mm', NULL, 10800, 4100, 11, 10, 25, 100, 'bundle'),
(87, '30ml amber glass sw', '40 microns\r\n140mm x 60mm', NULL, 11800, 5400, 11, 10, 25, 100, 'bundle'),
(88, '50ml/60ml pet sw', '40 microns\r\n150mm x 55mm', NULL, 12800, 5900, 11, 10, 25, 100, 'bundle'),
(89, '100ml pet sw', '40 microns\r\n168mm x 65mm', NULL, 13500, 6200, 11, 10, 25, 100, 'bundle'),
(90, '120ml pet sw', '40 microns\r\n180mm x 70mm', NULL, 14000, 6500, 11, 10, 25, 100, 'bundle'),
(91, '160ml foamer sw', '40 microns\r\n200mm x 78mm', NULL, 17800, 8800, 11, 10, 25, 100, 'bundle'),
(92, '250ml pet sw', '40 microns\r\n233mm x 82mm', NULL, 19800, 10800, 11, 10, 25, 100, 'bundle'),
(93, '2\" sw', '25 microns\r\npvc type', NULL, 6000, 2500, 11, 11, 10, 100, '10yards'),
(94, '2.5\" sw', '25 microns pvc', NULL, 6500, 3300, 11, 11, 10, 100, '10yards'),
(95, '3\" sw', '25 microns pvc', NULL, 8500, 3200, 11, 11, 10, 100, '10yards'),
(96, '4\" sw', '25 microns pvc', NULL, 9800, 2500, 11, 11, 10, 100, '10 yards'),
(97, '5\" sw', '25 microns pvc', NULL, 10800, 3500, 11, 11, 10, 100, '10 yards'),
(98, '6\" sw', '25 microns pvc', NULL, 13800, 4400, 11, 11, 10, 100, '10 yards'),
(99, '7\" sw', '25 microns pvc', NULL, 14800, 5000, 11, 11, 10, 100, '10 yards'),
(100, '8\" sw', '25 microns pvc', '2-201908271844-received_522055421923800.jpeg', 16800, 5500, 11, 11, 10, 100, '10 yards'),
(101, '9\" sw', '25 microns pvc', NULL, 18800, 6000, 11, 11, 10, 100, '10 yards'),
(102, '10\" sw', '25 microns pvc', NULL, 19800, 6500, 11, 11, 10, 100, '10 yards'),
(103, '62mm x 3mm shrink band', '40 microns (100pcs)\r\nfit for 10g cream jar', NULL, 5800, 2500, 11, 12, 10, 100, '1 bundle'),
(104, '115mm x 30mm', '40 microns\r\nfor 50g tubs jar', NULL, 8800, 2900, 11, 12, 10, 100, '1 bundle'),
(105, '132mm x 30mm', '40 microns\r\nfit for 100g tubs', NULL, 9800, 3200, 11, 12, 10, 100, 'bundle'),
(106, '166mm x 30mm', '40 microns\r\nfit for 200g tubs jar', NULL, 12800, 4000, 11, 12, 10, 100, 'bundle'),
(107, 'Clear Vinyl', '80gms a4 size x 10pcs', NULL, 16000, 9000, 22, NULL, 25, 100, 'pack'),
(108, 'White Vinyl Sticker', '80gms a4 size x 10pcs', NULL, 16000, 9000, 22, NULL, 25, 100, 'pack'),
(109, 'Photo Top', 'Glossy A4 Size', NULL, 1000, 400, 22, NULL, 25, 100, 'piece'),
(110, 'Cube Jar', 'clear cube jar', NULL, 1200, 700, 21, 9, 50, 100, '5g'),
(111, 'Cream Jar', 'cream jar (all clear)', NULL, 1200, 700, 21, 9, 50, 100, '10g'),
(112, 'Rose Jar', 'Rose Jar Acrylic', NULL, 2800, 1600, 21, 9, 10, 100, '10g'),
(113, 'Rose Jar', 'Rose Jar Acrylic', NULL, 3800, 2500, 21, 9, 10, 100, '15g'),
(114, 'Rose Jar', 'Rose Jar Acrylic', NULL, 4800, 3500, 21, 9, 10, 100, '30g'),
(115, 'EO Bottle White Cap', 'Amber', NULL, 1700, 700, 8, 14, 50, 200, '5ml'),
(116, 'EO Bottle White Cap', 'Amber', NULL, 1800, 900, 8, 14, 100, 500, '10ml'),
(117, 'EO Bottle White Cap', 'Amber', NULL, 1900, 1000, 8, 14, 50, 200, '15ml'),
(118, 'EO Bottle White Cap', 'Amber', NULL, 2200, 1100, 8, 14, 50, 300, '30ml'),
(119, 'EO Bottle White Cap', 'Amber', NULL, 2500, 1500, 8, 14, 50, 200, '50ml'),
(120, 'EO Bottle White Cap', 'Amber', NULL, 2700, 1600, 8, 14, 50, 200, '100ml'),
(121, 'EO Bottle White Cap', 'Cobalt Blue', NULL, 1800, 900, 8, 14, 50, 200, '10ml'),
(122, 'EO Bottle White Cap', 'Cobalt Blue', NULL, 2000, 1100, 8, 14, 25, 100, '20ml'),
(123, 'EO Bottle White Cap', 'Cobalt Blue', NULL, 2200, 1200, 8, 14, 25, 100, '30ml'),
(124, 'EO Bottle White Cap', 'Cobalt Blue', NULL, 2500, 1500, 8, 14, 25, 100, '50ml'),
(125, 'EO Bottle White Cap', 'Cobalt Blue', NULL, 2800, 1700, 8, 14, 25, 100, '100ml'),
(126, 'EO Bottle White Cap', 'Green', NULL, 2000, 1100, 8, 14, 25, 100, '20ml'),
(127, 'EO Bottle White Cap', 'Green', NULL, 2500, 1600, 8, 14, 25, 100, '50ml'),
(128, 'EO Bottle White Cap', 'Green', NULL, 2800, 1700, 8, 14, 25, 100, '100ml'),
(129, 'EO Bottle Black Cap', 'Amber', NULL, 1700, 700, 8, 14, 100, 200, '5ml'),
(130, 'EO Bottle Black Cap', 'Amber', NULL, 1800, 900, 8, 14, 100, 200, '10ml'),
(131, 'EO Bottle Black Cap', 'Amber', NULL, 1900, 1000, 8, 14, 50, 200, '15ml'),
(132, 'EO Bottle Black Cap', 'Amber', NULL, 2200, 1200, 8, 14, 50, 200, '30ml'),
(133, 'EO Bottle Black Cap', 'Amber', NULL, 2500, 1600, 8, 14, 25, 200, '50ml'),
(134, 'EO Bottle Black Cap', 'Amber', NULL, 2800, 1700, 8, 14, 500, 200, '100ml'),
(135, 'EO Bottle Black Cap', 'Cobalt Blue', NULL, 1800, 900, 8, 14, 50, 200, '10ml'),
(136, 'EO Bottle Black Cap', 'Cobalt Blue', NULL, 2000, 1100, 8, 14, 25, 100, '20ml'),
(137, 'EO Bottle Black Cap', 'Cobalt Blue', NULL, 2200, 1200, 8, 14, 50, 100, '30ml'),
(138, 'EO Bottle Black Cap', 'Cobalt Blue', NULL, 2500, 1600, 8, 14, 25, 100, '50ml'),
(139, 'EO Bottle Black Cap', 'Cobalt Blue', NULL, 2800, 1700, 8, 14, 20, 100, '100ml'),
(140, 'EO Bottle Black Cap', 'Green', NULL, 2000, 1100, 8, 14, 25, 100, '20ml'),
(141, 'EO Bottle Black Cap', 'Green', NULL, 2500, 1600, 8, 14, 20, 100, '50ml'),
(142, 'EO Bottle Black Cap', 'Green', NULL, 2800, 1700, 8, 14, 20, 100, '100ml'),
(143, 'Short Ziplock', '14cm x 16cm', NULL, 1800, 1200, 20, 5, 25, 100, 'piece'),
(144, 'Long Ziplock', '13.5 cm x 20cm', NULL, 2000, 1200, 20, 5, 25, 100, 'piece'),
(145, 'Mini Funnel', 'Plastic', NULL, 1400, 700, 20, NULL, 25, 200, 'piece'),
(146, 'Cusion Puff', 'Round', NULL, 3500, 2000, 20, NULL, 5, 50, 'piece'),
(147, 'Brush Applicator', 'white', NULL, 4500, 2500, 20, NULL, 5, 50, 'piece'),
(148, 'DIY Beauty Tool', '5in1 set', NULL, 12500, 8000, 20, NULL, 5, 20, 'piece'),
(149, 'Mushroom Fliptop Bottle', 'All Clear', NULL, 1200, 700, 21, 7, 50, 200, '20ml'),
(150, 'Mushroom Fliptop Bottle', 'All Clear (tubular)', NULL, 1200, 700, 21, 7, 50, 200, '30ml'),
(151, 'Mushroom Fliptop Bottle', 'Boston - All Clear', NULL, 1400, 800, 21, 7, 25, 200, '50ml'),
(152, 'Mushroom Fliptop Bottle', 'Boston - All Clear', NULL, 1500, 800, 21, 7, 25, 100, '100ml'),
(153, 'Mushroom Fliptop Bottle', 'Boston - All Clear', NULL, 2000, 1100, 21, 7, 25, 100, '250ml'),
(154, 'Mushroom Fliptop Bottle', 'Amber Bottle + bronze cap', NULL, 1200, 700, 21, 7, 50, 100, '30ml'),
(155, 'Mushroom Fliptop Bottle', 'Amber Bottle + bronze cap', NULL, 1400, 800, 21, 7, 50, 100, '50ml'),
(156, 'Mushroom Fliptop Bottle', 'Amber Bottle + bronze cap', NULL, 1500, 800, 21, 7, 50, 100, '100ml'),
(157, 'Mushroom Fliptop Bottle', 'Amber Bottle + bronze cap', NULL, 2000, 1100, 21, 7, 10, 50, '250ml'),
(158, 'Mushroom Fliptop Bottle', 'Cobalt Blue + Black Cap', NULL, 2000, 1100, 21, 7, 10, 50, '250ml'),
(159, 'Mushroom Fliptop Bottle', 'Dark Green', NULL, 2000, 1100, 21, 7, 10000, 50, '250ml'),
(160, 'Mushroom Fliptop Bottle', 'Dark Red + Black cap', NULL, 2000, 1100, 21, 7, 10, 50, '250ml'),
(161, 'Mushroom Fliptop Bottle', 'Green Leaf + black cap', NULL, 20000, 1100, 21, 7, 10, 50, '250ml'),
(162, 'AFC Bottle', 'All Clear', NULL, 1200, 700, 21, 7, 25, 100, '20ml'),
(163, 'AFC Bottle', 'All Clear', NULL, 1200, 700, 21, 7, 25, 100, '30ml'),
(164, 'AFC Bottle', 'All Clear', NULL, 1400, 800, 21, 7, 25, 100, '50ml'),
(165, 'AFC Bottle', 'All Clear', NULL, 1500, 800, 21, 7, 25, 100, '100ml'),
(166, 'AFC Bottle', 'All Clear', NULL, 1900, 1100, 21, 7, 10, 50, '250ml'),
(167, 'Trigger Spray Bottle', 'All Clear', NULL, 2500, 1900, 21, 7, 25, 100, '50ml'),
(168, 'Trigger Spray Bottle', 'All Clear', NULL, 2600, 1900, 21, 7, 25, 100, '100ml'),
(169, 'Trigger Spray Bottle', 'All Clear', NULL, 3200, 2200, 21, 7, 25, 100, '250ml'),
(170, 'Trigger Spray Bottle', 'All Clear', NULL, 4200, 2600, 21, 7, 200, 200, '500ml'),
(171, 'Trigger Spray Bottle', 'Clear Bottle + Black Trigger Spray', NULL, 3200, 2200, 21, 7, 25, 200, '250ml'),
(172, 'Trigger Spray Bottle', 'Clear Bottle + Black Trigger Spray', NULL, 4200, 2600, 21, 7, 25, 200, '500ml'),
(173, 'Trigger Spray Bottle', 'Clear Bottle + Black Trigger Spray', NULL, 4800, 3400, 21, 7, 10, 50, '1000ml'),
(174, 'Lotion Pump Bottle', 'All Clear', NULL, 2300, 1300, 21, 7, 25, 100, '50ml'),
(175, 'Lotion Pump Bottle', 'Clear Bottle + Black Trigger Spray', NULL, 2400, 1300, 21, 7, 25, 100, '100ml'),
(176, 'Lotion Pump Bottle', 'Clear Bottle + Black Trigger Spray', NULL, 2800, 1700, 21, 7, 25, 100, '250ml'),
(177, 'Lotion Pump Bottle', 'Clear Bottle + Black Trigger Spray', NULL, 3500, 2100, 21, 7, 10, 100, '500ml'),
(178, 'Lotion Pump Bottle', 'All Clear', NULL, 4500, 2700, 21, 7, 10, 50, '1000ml'),
(179, 'Lotion Pump Bottle', 'Clear Bottle + Black Lotion Pump', NULL, 2300, 1300, 21, 7, 25, 100, '50ml'),
(180, 'Lotion Pump Bottle', 'Clear Bottle + Black Lotion Pump', NULL, 2400, 1300, 21, 7, 25, 100, '100ml'),
(181, 'Lotion Pump Bottle', 'Clear Bottle + Black Lotion Pump', NULL, 2800, 1700, 21, 7, 25, 100, '250ml'),
(182, 'Lotion Pump Bottle', 'Clear Bottle + Black Lotion Pump', NULL, 3500, 2100, 21, 7, 25, 100, '500ml'),
(183, 'Lotion Pump Bottle', 'Amber Bottle + Black Lotion Pump', NULL, 2300, 1300, 21, 7, 25, 100, '50ml'),
(184, 'Lotion Pump Bottle', 'Amber Bottle + Black Lotion Pump', NULL, 2400, 1300, 21, 7, 25, 100, '100ml'),
(185, 'Lotion Pump Bottle', 'Amber Bottle + Black Lotion Pump', NULL, 2800, 1700, 21, 7, 25, 100, '250ml'),
(186, 'Gelpump Bottle', 'All Clear', NULL, 1800, 1200, 21, 7, 25, 100, '30ml'),
(187, 'Gelpump Bottle', 'All Clear', NULL, 1800, 1200, 21, 7, 20, 100, '20ml'),
(188, 'Gelpump Bottle', 'All Clear', NULL, 2000, 1300, 21, 7, 25, 100, '50ml'),
(189, 'Gelpump Bottle', 'All Clear', NULL, 2100, 1300, 21, 7, 25, 100, '100ml'),
(190, 'Gelpump Bottle', 'Clear Bottle + Black Gelpump', NULL, 1800, 1200, 21, 7, 25, 100, '30ml'),
(191, 'Gelpump Bottle', 'Clear Bottle + Black Gelpump', NULL, 1800, 1200, 21, 7, 25, 100, '20ml'),
(192, 'Gelpump Bottle', 'Clear Bottle + Black Gelpump', NULL, 2000, 1300, 21, 7, 25, 100, '50ml'),
(193, 'Gelpump Bottle', 'Clear Bottle + Black Gelpump', NULL, 2100, 1300, 21, 7, 25, 100, '100ml'),
(194, 'Gelpump Bottle', 'Amber Bottle + Black Gelpump', NULL, 2000, 1300, 21, 7, 25, 100, '50ml'),
(195, 'Gelpump Bottle', 'Amber Bottle + Black Gelpump', NULL, 2100, 1300, 21, 7, 25, 100, '100ml'),
(196, 'Pump Spray Bottle', 'All Clear', NULL, 1700, 1200, 21, 7, 25, 100, '10ml'),
(197, 'Pump Spray Bottle', 'All Clear', NULL, 1600, 1000, 21, 7, 25, 100, '20ml'),
(198, 'Pump Spray Bottle', 'All Clear', NULL, 1600, 1000, 21, 7, 25, 100, '30ml'),
(199, 'Amber Glass with Regular Screw Cap', 'White Cap', NULL, 1200, 500, 8, NULL, 50, 200, '15ml'),
(200, 'Amber Glass with Regular Screw Cap', 'Black Cap', NULL, 1200, 500, 8, NULL, 50, 200, '15ml'),
(201, 'Amber Glass with Regular Screw Cap', 'White Cap', NULL, 1300, 600, 8, NULL, 50, 300, '30ml'),
(202, 'Amber Glass with Regular Screw Cap', 'White Cap', NULL, 1400, 600, 8, NULL, 50, 200, '60ml'),
(203, 'Amber Glass with Regular Screw Cap', 'White Cap', NULL, 1600, 700, 8, NULL, 50, 200, '120ml'),
(204, 'Amber Glass with Regular Screw Cap', 'White Cap', NULL, 2500, 900, 8, NULL, 50, 200, '250ml'),
(205, 'Amber Glass with Regular Screw Cap', 'White Cap', NULL, 3600, 1700, 8, NULL, 50, 200, '500ml'),
(206, 'Trigger Spray Bottle', 'Amber Glass + Black Trigger Spray', NULL, 7500, 2200, 8, NULL, 50, 200, '250ml'),
(207, 'Trigger Spray Bottle', 'Amber Glass + Black Trigger Spray', NULL, 8500, 2900, 8, NULL, 50, 300, '500ml'),
(208, 'Bubble Wrap', '40 inches x 30 inches', NULL, 2500, 900, 22, NULL, 25, 500, 'piece'),
(209, 'Milk Bottle', 'Clear Bottle + White Cap', NULL, 1700, 1000, 21, 7, 25, 300, '300ml'),
(210, 'Milk Bottle', 'Clear Bottle + Black Cap', NULL, 1700, 1000, 21, 7, 25, 200, '300ml'),
(211, 'Square Milk Bottle', 'Clear Bottle + Natural Cap', NULL, 1300, 800, 21, 7, 25, 100, '250ml'),
(212, 'Square Milk Bottle', 'Clear Bottle + Natural Cap', NULL, 1400, 800, 21, 7, 25, 100, '300ml'),
(213, 'Square Milk Bottle', 'Clear Bottle +Black Cap', NULL, 1300, 800, 21, 7, 25, 100, '250ml'),
(214, 'Square Milk Bottle', 'Clear Bottle +Black Cap', NULL, 1400, 800, 21, 7, 25, 100, '300ml'),
(215, 'Medicine Bottle', 'Clear Bottle + White Cap', NULL, 1600, 1000, 21, 7, 25, 200, '100ml'),
(216, 'Medicine Bottle', 'Clear Bottle + Black Cap', NULL, 1600, 1000, 21, 7, 25, 100, '100ml'),
(217, 'Medicine Bottle', 'Clear Bottle + White Cap', NULL, 1500, 700, 21, 7, 20, 100, '50ml'),
(218, 'Medicine Bottle', 'All White', NULL, 1500, 700, 21, 7, 10, 50, '50ml'),
(219, 'Ardent Bottle', 'All Clear', NULL, 1200, 700, 21, 7, 25, 100, '20ml'),
(220, 'Ardent Bottle', 'All Clear', NULL, 1200, 700, 21, 7, 25, 100, '30ml'),
(221, 'Ardent Bottle', 'Clear Bottle + Black Cap', NULL, 1200, 700, 21, 7, 25, 100, '20ml'),
(222, 'Ardent Bottle', 'Clear Bottle + Black Cap', NULL, 1200, 700, 21, 7, 25, 100, '30ml'),
(223, 'Cusion Case', 'Round - Complete Set', NULL, 12800, 9000, 20, NULL, 2, 10, 'piece'),
(224, 'Disposable Mascara Applicator', 'Pink Bristle', NULL, 600, 300, 20, NULL, 5, 40, 'piece'),
(225, 'Disposable Mascara Applicator', 'Blue Bristle', NULL, 600, 300, 20, NULL, 5, 40, 'piece'),
(227, 'Spatula', 'Clear', NULL, 600, 300, 20, NULL, 10, 100, 'piece'),
(228, 'Spatula', 'White Small', NULL, 500, 300, 20, NULL, 100, 100, 'piece'),
(229, 'Spatula', 'White Big', NULL, 700, 400, 20, NULL, 10, 100, 'piece'),
(230, 'Ibiza', 'Gold', NULL, 5500, 4200, 8, 24, 10, 100, '30ml'),
(231, 'Ibiza', 'Silver', NULL, 5500, 4200, 8, 24, 10, 100, '30ml'),
(232, 'Bullet', 'Clear with silver cap', NULL, 4800, 3400, 8, 24, 10, 100, '25ml');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_07_17_220210_create_permission_tables', 1),
(2, '2019_07_17_220211_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', NULL, NULL),
(2, 'Assistant', 'web', NULL, NULL),
(3, 'Employee', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slr_logs`
--

CREATE TABLE `slr_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `sub_category_name`) VALUES
(5, 20, 'Ziplock Travel Pouch'),
(7, 21, 'Plastic Bottle'),
(8, 21, 'Plastic Jar'),
(9, 21, 'Acrylic Jar'),
(10, 11, 'Pre-cut'),
(11, 11, 'sw roll'),
(12, 11, 'Shrink Band'),
(13, 8, 'Amber with regular screw cap'),
(14, 8, 'Colored Glass with dripulator + evident cap'),
(15, 8, 'Colored Glass with silver dropper'),
(16, 8, 'Colored Glass with black dropper'),
(17, 8, 'Colored Glass with Gelpump Fancy'),
(18, 23, 'Round'),
(19, 23, 'Slide Box'),
(20, 23, 'Box (makapal)'),
(21, 21, 'Metal Ball Roll-On'),
(22, 8, 'Metal Ball Roll-On'),
(23, 8, 'Plastic Ball Roll-On'),
(24, 8, 'Perfume Spray Bottle');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` longtext COLLATE utf8mb4_unicode_ci,
  `active` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `profile_image`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'Admin', '$2y$10$D212HrU7DxSV3K3CNN0ln.0y6qhWIzO1Bhw3PSAM8Y/MmBnMvVgvu', '1-201908291746-avatar-02.jpg', 1, NULL, NULL, '2019-08-29 09:21:46'),
(2, 'Assistant', 'Assistant', 'asst', '$2y$10$6CVnc1q7QEy0GrvcsD.XQ.HSniA/BG3zVW9Sg8wEDyIAI3RotUQoO', NULL, 1, NULL, NULL, NULL),
(3, 'Employee', 'Employee', 'emp', '$2y$10$Uzw9pLb4lo/UJogSe4dGV.kKjA0/T07JJJrL9YFMYJLB.KNiOZ/vm', NULL, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`),
  ADD KEY `items_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `slr_logs`
--
ALTER TABLE `slr_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slr_logs_item_id_foreign` (`item_id`),
  ADD KEY `slr_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slr_logs`
--
ALTER TABLE `slr_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slr_logs`
--
ALTER TABLE `slr_logs`
  ADD CONSTRAINT `slr_logs_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `slr_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
