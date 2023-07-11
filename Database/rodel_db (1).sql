-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 01:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rodel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`admin_id`, `admin_email`, `admin_username`, `admin_password`) VALUES
(1, 'admin@email.com', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(3, 'Nike'),
(4, 'Penshoppe');

-- --------------------------------------------------------

--
-- Table structure for table `cart_table`
--

CREATE TABLE `cart_table` (
  `item_id` int(11) NOT NULL,
  `item_code` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` int(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `quantity` int(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `email_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_table`
--

INSERT INTO `cart_table` (`item_id`, `item_code`, `item_name`, `item_price`, `size`, `quantity`, `item_image`, `email_add`) VALUES
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 12, 'topbuds_9.jpg', 'harvs013@gmail.com'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 3, 'topbuds_8.jpg', 'harvs013@gmail.com'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 3, 'topbuds_3.jpg', 'harvs013@gmail.com'),
(142, 3369, 'TPBDS White Round Neck T-Shirt', 350, 'Extra Large', 19, 'topbuds_5.jpg', 'harvs013@gmail.com'),
(143, 9920, 'TPBDS Black Round Neck T-Shirt', 350, 'Medium', 4, 'topbuds_4.jpg', 'harvs013@gmail.com'),
(155, 1818, 'Black No Luck T-Shirt', 350, 'Large', 3, 'topbuds_13.jpg', 'harvs013@gmail.com'),
(156, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Large', 2, 'topbuds_8.jpg', 'mark@yahoo.com'),
(157, 8244, 'Stay Connected Black T-Shirt ', 300, 'Small', 4, 'topbuds_2.jpg', 'mark@yahoo.com'),
(163, 3369, 'TPBDS White Round Neck T-Shirt', 350, 'Medium', 3, 'topbuds_5.jpg', 'harvs013@gmail.com'),
(164, 3369, 'TPBDS White Round Neck T-Shirt', 350, 'Large', 4, 'topbuds_5.jpg', 'harvs013@gmail.com'),
(165, 7690, 'Topbuds Black Round Neck T-Shirt', 300, 'Medium', 2, 'topbuds_1.jpg', 'harvs013@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Mens Clothing'),
(2, 'Womens Clothing');

-- --------------------------------------------------------

--
-- Table structure for table `checkout_items`
--

CREATE TABLE `checkout_items` (
  `check_id` int(11) NOT NULL,
  `check_code` int(255) NOT NULL,
  `check_name` varchar(255) NOT NULL,
  `check_price` int(100) NOT NULL,
  `check_size` varchar(100) NOT NULL,
  `check_quantity` int(255) NOT NULL,
  `total_price` int(255) NOT NULL,
  `check_image` varchar(255) NOT NULL,
  `check_email_add` varchar(255) NOT NULL,
  `temp_id` int(11) NOT NULL,
  `date_ordered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout_items`
--

INSERT INTO `checkout_items` (`check_id`, `check_code`, `check_name`, `check_price`, `check_size`, `check_quantity`, `total_price`, `check_image`, `check_email_add`, `temp_id`, `date_ordered`) VALUES
(138, 6064, 'Embroid \"OG\" Tri-Color Stripe T-Shirt ', 350, 'Medium', 7, 2450, 'topbuds_6.jpg', 'harvs013@gmail.com', 205, '2023-06-30 14:58:28'),
(138, 6064, 'Embroid \"OG\" Tri-Color Stripe T-Shirt ', 350, 'Medium', 7, 2450, 'topbuds_6.jpg', 'harvs013@gmail.com', 206, '2023-06-30 15:45:44'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 207, '2023-06-30 15:45:44'),
(138, 6064, 'Embroid \"OG\" Tri-Color Stripe T-Shirt ', 350, 'Medium', 7, 2450, 'topbuds_6.jpg', 'harvs013@gmail.com', 208, '2023-07-02 01:58:58'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 209, '2023-07-02 01:58:58'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 210, '2023-07-02 01:58:59'),
(138, 6064, 'Embroid \"OG\" Tri-Color Stripe T-Shirt ', 350, 'Medium', 7, 2450, 'topbuds_6.jpg', 'harvs013@gmail.com', 211, '2023-07-02 03:03:24'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 212, '2023-07-02 03:03:25'),
(138, 6064, 'Embroid \"OG\" Tri-Color Stripe T-Shirt ', 350, 'Medium', 7, 2450, 'topbuds_6.jpg', 'harvs013@gmail.com', 213, '2023-07-02 03:49:40'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 214, '2023-07-02 03:49:40'),
(138, 6064, 'Embroid \"OG\" Tri-Color Stripe T-Shirt ', 350, 'Medium', 7, 2450, 'topbuds_6.jpg', 'harvs013@gmail.com', 215, '2023-07-02 04:08:03'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 216, '2023-07-02 04:08:03'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 217, '2023-07-02 04:35:10'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 218, '2023-07-02 04:35:11'),
(138, 6064, 'Embroid \"OG\" Tri-Color Stripe T-Shirt ', 350, 'Medium', 7, 2450, 'topbuds_6.jpg', 'harvs013@gmail.com', 219, '2023-07-02 06:24:30'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 220, '2023-07-02 07:22:11'),
(143, 9920, 'TPBDS Black Round Neck T-Shirt', 350, 'Medium', 4, 1400, 'topbuds_4.jpg', 'harvs013@gmail.com', 221, '2023-07-02 07:22:11'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 222, '2023-07-02 07:23:25'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 223, '2023-07-02 07:23:25'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 224, '2023-07-02 07:25:18'),
(142, 3369, 'TPBDS White Round Neck T-Shirt', 350, 'Extra Large', 2, 700, 'topbuds_5.jpg', 'harvs013@gmail.com', 225, '2023-07-02 07:26:55'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 226, '2023-07-02 07:28:04'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 227, '2023-07-02 07:28:05'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 228, '2023-07-02 07:29:24'),
(143, 9920, 'TPBDS Black Round Neck T-Shirt', 350, 'Medium', 4, 1400, 'topbuds_4.jpg', 'harvs013@gmail.com', 229, '2023-07-02 07:30:51'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 230, '2023-07-02 07:31:35'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 231, '2023-07-02 07:34:17'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 232, '2023-07-02 07:35:38'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 233, '2023-07-02 07:36:35'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 234, '2023-07-02 07:39:21'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 235, '2023-07-02 07:41:13'),
(143, 9920, 'TPBDS Black Round Neck T-Shirt', 350, 'Medium', 4, 1400, 'topbuds_4.jpg', 'harvs013@gmail.com', 236, '2023-07-02 07:41:43'),
(143, 9920, 'TPBDS Black Round Neck T-Shirt', 350, 'Medium', 4, 1400, 'topbuds_4.jpg', 'harvs013@gmail.com', 237, '2023-07-02 07:44:17'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 238, '2023-07-02 07:47:48'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 239, '2023-07-02 07:52:38'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 240, '2023-07-02 07:52:38'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 241, '2023-07-02 07:52:55'),
(142, 3369, 'TPBDS White Round Neck T-Shirt', 350, 'Extra Large', 2, 700, 'topbuds_5.jpg', 'harvs013@gmail.com', 242, '2023-07-02 07:53:17'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 243, '2023-07-02 09:41:01'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 244, '2023-07-02 10:39:50'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 245, '2023-07-02 10:39:50'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 246, '2023-07-02 10:39:50'),
(144, 8244, 'Stay Connected Black T-Shirt ', 300, 'Medium', 2, 600, 'topbuds_2.jpg', 'harvs013@gmail.com', 247, '2023-07-02 10:49:18'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 248, '2023-07-02 10:50:01'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'topbuds_9.jpg', 'harvs013@gmail.com', 249, '2023-07-03 04:07:26'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'topbuds_8.jpg', 'harvs013@gmail.com', 250, '2023-07-03 04:07:26'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 251, '2023-07-03 04:07:26'),
(140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 3, 1800, 'topbuds_8.jpg', 'harvs013@gmail.com', 252, '2023-07-05 03:19:56'),
(141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'topbuds_3.jpg', 'harvs013@gmail.com', 253, '2023-07-05 03:19:57'),
(156, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Large', 2, 1200, 'topbuds_8.jpg', 'mark@yahoo.com', 254, '2023-07-05 05:28:05'),
(157, 8244, 'Stay Connected Black T-Shirt ', 300, 'Small', 4, 1200, 'topbuds_2.jpg', 'mark@yahoo.com', 255, '2023-07-05 05:28:05'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 12, 7200, 'topbuds_9.jpg', 'harvs013@gmail.com', 256, '2023-07-06 01:56:03'),
(139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 12, 7200, 'topbuds_9.jpg', 'harvs013@gmail.com', 257, '2023-07-06 07:39:13'),
(143, 9920, 'TPBDS Black Round Neck T-Shirt', 350, 'Medium', 4, 1400, 'topbuds_4.jpg', 'harvs013@gmail.com', 258, '2023-07-08 09:52:10'),
(163, 3369, 'TPBDS White Round Neck T-Shirt', 350, 'Medium', 3, 1050, 'topbuds_5.jpg', 'harvs013@gmail.com', 259, '2023-07-08 09:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_code` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_price` varchar(100) NOT NULL,
  `sizes_available` varchar(255) NOT NULL,
  `item_description` varchar(200) NOT NULL,
  `item_keyword` varchar(200) NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `item_image1` varchar(255) NOT NULL,
  `item_image2` varchar(255) NOT NULL,
  `item_image3` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `item_status` varchar(255) NOT NULL,
  `num_sold` int(255) NOT NULL,
  `num_left` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_code`, `item_name`, `item_price`, `sizes_available`, `item_description`, `item_keyword`, `item_category`, `item_image1`, `item_image2`, `item_image3`, `date_added`, `item_status`, `num_sold`, `num_left`) VALUES
(22, 7690, 'Topbuds Black Round Neck T-Shirt', '300', 'Small, Medium, Large, Extra Large', 'A T-shirt (also spelled tee-shirt or tee shirt), or tee for short, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline,', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_1.jpg', 'topbuds_1.jpg', 'topbuds_1.jpg', '2023-07-05 13:49:12', 'Available', 27, 117),
(23, 8244, 'Stay Connected Black T-Shirt ', '300', 'Small, Medium, Large, Extra Large', 'A T-shirt (also spelled tee-shirt or tee shirt), or tee for short, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline,', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_2.jpg', 'topbuds_2.jpg', 'topbuds_2.jpg', '2023-07-05 13:49:03', 'Available', 45, 24),
(24, 9064, 'Bad Habits Rose White T-Shirt', '350', 'Small, Medium, Large, Extra Large', 'A T-shirt (also spelled tee-shirt or tee shirt), or tee for short, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline,', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_3.jpg', 'topbuds_3.jpg', 'topbuds_3.jpg', '2023-07-05 13:48:58', 'Available', 63, 78),
(25, 9920, 'TPBDS Black Round Neck T-Shirt', '350', 'Small, Medium, Large, Extra Large', 'A T-shirt (also spelled tee-shirt or tee shirt), or tee for short, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline,', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_4.jpg', 'topbuds_4.jpg', 'topbuds_4.jpg', '2023-07-05 13:48:52', 'Available', 9, 47),
(26, 3369, 'TPBDS White Round Neck T-Shirt', '350', 'Small, Medium, Large, Extra Large', 'A T-shirt (also spelled tee-shirt or tee shirt), or tee for short, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline,', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_5.jpg', 'topbuds_5.jpg', 'topbuds_5.jpg', '2023-07-05 13:48:47', 'Available', 35, 13),
(27, 6064, 'Embroid \"OG\" Tri-Color Stripe T-Shirt ', '350', 'Small, Medium, Large, Extra Large', 'A T-shirt (also spelled tee-shirt or tee shirt), or tee for short, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline,', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_6.jpg', 'topbuds_6.jpg', 'topbuds_6.jpg', '2023-07-05 13:48:41', 'Available', 4, 127),
(28, 9731, 'Topbuds Pizza Maniac Black T-Shirt', '600', 'Small, Medium, Large, Extra Large', 'A T-shirt (also spelled tee-shirt or tee shirt), or tee for short, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline,', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_8.jpg', 'topbuds_8.jpg', 'topbuds_8.jpg', '2023-07-05 13:48:29', 'Available', 16, 76),
(29, 6788, 'Topbuds Pizza Maniac White T-Shirt', '600', 'Small, Medium, Large', 'A T-shirt (also spelled tee shirt), or tee for short, is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a c', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_9.jpg', 'topbuds_9.jpg', 'topbuds_9.jpg', '2023-07-05 13:47:54', 'Out of Stock', 54, 0),
(30, 1818, 'Black TopBuds No Luck T-Shirt', '450', 'Medium, Large', 'The best black T-shirts for men are every stylish guy\'s sneaky-flattering secret weapon. These are the absolute cream of the crop.', 'tshirt, T-shirt, shirt, mens shirt, oversized shirt, oversized', 'Mens T-Shirts', 'topbuds_13.jpg', 'topbuds_13.jpg', 'topbuds_13.jpg', '2023-07-05 14:24:40', 'Available', 27, 113),
(31, 7965, 'Brown Hoodie ', '600', 'Small, Medium, Large, Extra Large', 'Hooded sweatshirt in a heavy Portuguese organic cotton jersey. Comes with an unbrushed loopback inside with a dry hand feel.', 'hoodie, sweatshirt, mens hoodie, brown hoodie', 'Mens Hoodies', 'men_hoodie2.JPG', 'men_hoodie2.JPG', 'men_hoodie2.JPG', '2023-07-05 13:46:24', 'Out of Stock', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mens_categories`
--

CREATE TABLE `mens_categories` (
  `mens_category_id` int(11) NOT NULL,
  `mens_category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mens_categories`
--

INSERT INTO `mens_categories` (`mens_category_id`, `mens_category_name`) VALUES
(4, 'Mens T-Shirts'),
(6, 'Mens Hoodies'),
(7, 'Mens Long Sleeves');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `package_num` bigint(20) NOT NULL,
  `order_id` int(255) NOT NULL,
  `order_item_code` int(255) NOT NULL,
  `order_item_name` varchar(255) NOT NULL,
  `order_item_price` int(255) NOT NULL,
  `order_item_size` varchar(255) NOT NULL,
  `order_item_quantity` int(255) NOT NULL,
  `order_total_price` int(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_item_image` varchar(255) NOT NULL,
  `order_email_add` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`package_num`, `order_id`, `order_item_code`, `order_item_name`, `order_item_price`, `order_item_size`, `order_item_quantity`, `order_total_price`, `payment_method`, `payment_status`, `order_item_image`, `order_email_add`, `order_date`, `order_status`) VALUES
(989325591313, 139, 6788, 'Topbuds Pizza Maniac White T-Shirt', 600, 'Large', 4, 2400, 'GCash', 'Not Paid', 'topbuds_9.jpg', 'harvs013@gmail.com', '2023-07-08 09:21:36', 'Cancelled'),
(989325591313, 140, 9731, 'Topbuds Pizza Maniac Black T-Shirt', 600, 'Medium', 2, 1200, 'GCash', 'Paid', 'topbuds_8.jpg', 'harvs013@gmail.com', '2023-03-08 09:21:36', 'Cancelled'),
(129871308895, 141, 9064, 'Bad Habits Rose White T-Shirt', 350, 'Large', 1, 350, 'Cash on Delivery', 'Not Paid', 'topbuds_3.jpg', 'harvs013@gmail.com', '2023-07-08 09:23:38', 'To Ship'),
(946322475989, 142, 3369, 'TPBDS White Round Neck T-Shirt', 350, 'Extra Large', 2, 700, 'Cash on Delivery', 'Not Paid', 'topbuds_5.jpg', 'harvs013@gmail.com', '2023-07-05 18:06:35', 'Shipping'),
(395422600804, 143, 9920, 'TPBDS Black Round Neck T-Shirt', 350, 'Medium', 4, 1400, 'CoD', 'Not Paid', 'topbuds_4.jpg', 'harvs013@gmail.com', '2023-07-08 09:52:13', 'To Ship'),
(393872429349, 144, 8244, 'Stay Connected Black T-Shirt ', 300, 'Medium', 2, 600, 'Cash on Delivery', 'Not Paid', 'topbuds_2.jpg', 'harvs013@gmail.com', '2023-07-08 09:28:52', 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_add` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `street_number` varchar(100) NOT NULL,
  `citymunicipality` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_add`, `user_password`, `street_number`, `citymunicipality`, `barangay`, `province`, `mobile_number`, `birthday`, `gender`) VALUES
(22, 'Raymond', 'Potenciando', 'raymondpotenciando@yahoo.com', '$2y$10$OWiaBbkdafb0ebobxj7xK.Qq61O4.s1ZrHJ1qg6GWwMTBVaG.pRyS', 'B2, L19, S5, Phase 1', 'Tanza', 'Bagtas', 'Cavite', '09195600314', '2023-02-15', 'Male'),
(24, 'Shaine', 'Betacura', 'shaine16@gmail.com', '$2y$10$Av9LGBTkGg0CV.07A1LOSOsYe8fY6/bhThpAOsXZh60fnNFZCAGFi', 'B2, L19, S5, Phase 1', 'Trece Martires', 'Inocencio', 'Cavite', '09195600314', '2023-02-09', 'Female'),
(25, 'Justine', 'Carbon', 'mariocarbon@yahoo.com', '$2y$10$blZfWafhhiN6bHFYEVffmuxTxbzYn6ARCF2KVI8rntzLinR6fFbLC', 'B2, L45, S1, Phase 1, Gumamela St.', 'Tanza', 'Paradahan II', 'Cavite', '09195600317', '1997-02-17', 'Male'),
(26, 'Joseph', 'Carbon', 'mariocarbon@yahoo.com', '$2y$10$SLgrGTb9s/O73SsJQfRDh.Hlw5bDdO5AigjUJTPc8giV9vclNPYtu', 'B2, L45, S1, Phase 1, Gumamela St.', 'Trece Martires', 'Inocencio', 'Cavite', '09195600314', '2015-06-09', 'Male'),
(27, 'Raymond', 'Marasigan', 'rm@yahoo.com', '$2y$10$o6fXxdy2JWqEzCxTWlfDgerDwk194mw3jM.prxI8hcGfSwf/vJPWa', 'B2, L19, S5', 'Trece Martires', 'Osorio', 'Cavite', '09195600314', '2023-03-08', 'Male'),
(28, 'Alyssa', 'Valdez', 'alyy@yahoo.com', '$2y$10$wxiSa5bqiOHd5aceYBpEGu6.wi4tnBUNtqKwvgYi94GwIMYMwuWGq', 'Himalayan St., Phase 2', 'Tanza', 'Amaya I', 'Cavite', '09195600314', '2023-06-20', 'Female'),
(29, 'jerome', 'irog', 'jeromeirog@gmail.com', '$2y$10$Qbu.WyJ5gtS7TrxHe08A.e7DRF3E0qJGiBDPrxx/F2apLtD5.rCY.', 'blk 4lot4csec10', 'Tanza', 'Bagtas', 'Cavite', '09690841675', '2001-02-06', 'Male'),
(30, 'Harvey', 'Delos Reyes', 'harvs013@gmail.com', '$2y$10$.bWKPN4pGd5rbDx8LtmPuuIABlWArdrTcpHkwZeJ7CPyfjuKSt8xq', 'Pabahay 1, Blk 1 Lot 13', '', '', '', '09052156587', '2003-08-30', 'Male'),
(31, 'Mark', 'Reyes', 'mark@yahoo.com', '$2y$10$1Dj5sJkJlceQLY55YrFYxe2AxE9XKoGkVXHhhA4bVAY.b.gefeRBW', 'Blk 2, Lot 9, Sec 6', 'Tanza', 'Bagtas', 'Cavite', '09690841675', '2023-03-15', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `womens_categories`
--

CREATE TABLE `womens_categories` (
  `womens_category_id` int(11) NOT NULL,
  `womens_category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `womens_categories`
--

INSERT INTO `womens_categories` (`womens_category_id`, `womens_category_name`) VALUES
(7, 'Womens T-Shirts'),
(8, 'Womens Hoodies'),
(10, 'Womens Dresses'),
(11, 'Womens Long Sleeves');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `checkout_items`
--
ALTER TABLE `checkout_items`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `mens_categories`
--
ALTER TABLE `mens_categories`
  ADD PRIMARY KEY (`mens_category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `womens_categories`
--
ALTER TABLE `womens_categories`
  ADD PRIMARY KEY (`womens_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_table`
--
ALTER TABLE `cart_table`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `checkout_items`
--
ALTER TABLE `checkout_items`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `mens_categories`
--
ALTER TABLE `mens_categories`
  MODIFY `mens_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `womens_categories`
--
ALTER TABLE `womens_categories`
  MODIFY `womens_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
