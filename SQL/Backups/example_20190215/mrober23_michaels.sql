-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2019 at 08:54 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrober23_michaels`
--

-- --------------------------------------------------------

--
-- Table structure for table `core_Department`
--

CREATE TABLE `core_Department` (
  `id_Dept` int(11) NOT NULL,
  `Department` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_Department`
--

INSERT INTO `core_Department` (`id_Dept`, `Department`) VALUES
(1000, 'Manager'),
(1010, 'Cook'),
(1020, 'Waitstaff'),
(1030, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `core_Employee`
--

CREATE TABLE `core_Employee` (
  `id_Emp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_Dept` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_Employee`
--

INSERT INTO `core_Employee` (`id_Emp`, `id_Dept`) VALUES
('mrobertson', 1000),
('jcarman', 1000),
('mrobertson2', 1030),
('arobertson', 1020),
('jsmith', 1010),
('jjohnson', 1010),
('jrobertson', 1030),
('jjackson', 1030),
('jjackson2', 1030),
('jjackson3', 1030),
('q', 1010);

-- --------------------------------------------------------

--
-- Table structure for table `core_EmployeeDetail`
--

CREATE TABLE `core_EmployeeDetail` (
  `id_Row` int(11) NOT NULL,
  `id_Emp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `City` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `State` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Zip` varchar(18) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_EmployeeDetail`
--

INSERT INTO `core_EmployeeDetail` (`id_Row`, `id_Emp`, `Firstname`, `Lastname`, `Address`, `City`, `State`, `Zip`) VALUES
(1, 'mrobertson', 'Michael', 'Robertson', '123 W St.', 'Murrells Inlet', 'SC', '29576'),
(2, 'mrobertson2', 'Matthew', 'Robertson', '123 W St.', 'Murrells Inlet', 'SC', '29576'),
(3, 'arobertson', 'Ashley', 'Robertson', '123 W St.', 'Murrells Inlet', 'SC', '29576'),
(4, 'jsmith', 'James', 'Smith', '455 E St.', 'Myrtle Beach', 'SC', '29577'),
(5, 'jjohnson', 'Jim', 'Johnson', '5675 Main Blvd.', 'Myrtle Beach', 'SC', '29577'),
(6, 'jcarman', 'Jason', 'Carman', '1242 Cold Fusion Way', 'Conway', 'SC', '29526'),
(7, 'jrobertson', 'James', 'Robertson', '5154 Wesley Road', 'Murrells Inlet', 'SC', '29576'),
(8, 'jrobertson', 'James', 'Robertson', '5154 Wesley Road', 'Murrells Inlet', 'SC', '29576'),
(9, 'jjackson', 'James', 'Jackson', '5154 Wesley Road', 'Murrells Inlet', 'SC', '29576'),
(10, 'jjackson2', 'James', 'Jackson', '5154 Wesley Road', 'Murrells Inlet', 'SC', '29576'),
(11, 'jjackson3', 'James', 'Robertson', '5154 Wesley Road', 'Murrells Inlet', 'SC', '29576'),
(12, 'q', 'Q', 'Q', 'q', 'q', 'q', 'q');

-- --------------------------------------------------------

--
-- Table structure for table `core_EmployeeLogin`
--

CREATE TABLE `core_EmployeeLogin` (
  `id_Emp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PermissionLevel` int(11) NOT NULL,
  `isTempPass` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `core_EmployeeLogin`
--

INSERT INTO `core_EmployeeLogin` (`id_Emp`, `Password`, `PermissionLevel`, `isTempPass`) VALUES
('admin', '$2y$10$5qWGHxSaLYSyIt3g8W/1TOHrNLWT0onUcNUNek.Hnvz6B9ys565PG', 2000, 0),
('jrobertson', '$2y$10$bCk/Iy24jmXavspa6EfM4ONrpImMWUgSkrNDzFLLfcEuZ2uWS6XI2', 1030, 1),
('jjackson', '$2y$10$ZFiVo9V1ZAQhdQozuXG1IeeQKGNic3mE71.tVhLiyaVyVyni7RJb2', 1030, 1),
('jjackson2', '$2y$10$TK3IL4dCvIMwqA1erMISg.RxjANAmMeUeaYiloWAh7y3LHXQ5/3VO', 1030, 1),
('jjackson3', '$2y$10$WtI25UXh73TnA4SVbn473uW9cQCYwD/VuWfyyQNfbJEVApWe38J.O', 1030, 1),
('q', '$2y$10$ek/iFXbvxoQdWAG5iLtX3uh1ekQM8bvmYeXauhaFIKR31KUHAugze', 1010, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cust_Contact`
--

CREATE TABLE `cust_Contact` (
  `id_Contact` int(11) NOT NULL,
  `id_Cust` int(11) DEFAULT NULL,
  `Firstname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Comments` text COLLATE utf8_unicode_ci,
  `isMailingList` int(11) NOT NULL,
  `Created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cust_Contact`
--

INSERT INTO `cust_Contact` (`id_Contact`, `id_Cust`, `Firstname`, `Lastname`, `Email`, `Phone`, `Comments`, `isMailingList`, `Created`) VALUES
(45, NULL, 'michael', 'robertson', 'michael.robertson1991@gmail.com', '5079516159', 'Test modal', 0, '2019-02-03 13:42:17'),
(46, NULL, 'michael', 'robertson', 'michael.robertson1991@gmail.com', '5079516159', 'dsa', 0, '2019-02-03 13:42:17'),
(47, NULL, 'michael', 'robertson', 'michael.robertson1991@gmail.com', '5079516159', 'Test checkbox', 1, '2019-02-03 13:42:17'),
(48, NULL, 'michael', 'robertson', 'michael.robertson1991@gmail.com', '5079516159', 'sa', 1, '2019-02-03 13:42:17'),
(49, NULL, 'michael', 'robertson', 'michael.robertson1991@gmail.com', '5079516159', 'fsda', 1, '2019-02-03 13:42:17'),
(50, NULL, 'michael', 'robertson', 'michael.robertson1991@gmail.com', '5079516159', 'yrewtew', 1, '2019-02-03 13:42:57'),
(51, NULL, 'michael', 'robertson', 'michael.robertson1991@gmail.com', '5079516159', '6575643521', 1, '2019-02-03 13:43:23'),
(52, NULL, 'michael', 'robertson', 'michael.robertson1991@gmail.com', '5079516159', 'fdkjl', 1, '2019-02-04 19:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `cust_Customers`
--

CREATE TABLE `cust_Customers` (
  `id_Cust` int(11) NOT NULL,
  `Firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lu_MenuItemType`
--

CREATE TABLE `lu_MenuItemType` (
  `id_MenuItemType` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lu_MenuItemType`
--

INSERT INTO `lu_MenuItemType` (`id_MenuItemType`, `Name`) VALUES
(10, 'Appetizers'),
(20, 'Soups and Salads'),
(30, 'Entrees'),
(40, 'Desserts'),
(50, 'Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `lu_PermisionLevel`
--

CREATE TABLE `lu_PermisionLevel` (
  `id_PermissionLevel` int(11) NOT NULL,
  `PermissionName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lu_PermisionLevel`
--

INSERT INTO `lu_PermisionLevel` (`id_PermissionLevel`, `PermissionName`, `Description`) VALUES
(1000, 'Manager', 'Full-Access except ALTER/DELETE Entities or Schema Changes'),
(1010, 'Waiter', 'Read and Insert - menu and order'),
(1020, 'Cook', 'Read - menu and inventory'),
(1030, 'Support', 'Read - inventory'),
(2000, 'Admin', 'Full-Access');

-- --------------------------------------------------------

--
-- Table structure for table `menu_Inventory`
--

CREATE TABLE `menu_Inventory` (
  `id_MenuItem` int(11) NOT NULL,
  `Inventory` int(11) NOT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isLow` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Tigger:isLowCheck'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_Inventory`
--

INSERT INTO `menu_Inventory` (`id_MenuItem`, `Inventory`, `LastUpdated`, `isLow`) VALUES
(1, 10, '2019-02-07 13:44:13', 0),
(2, 6, '2019-02-07 13:44:48', 0),
(3, 20, '2019-02-07 14:03:37', 0),
(4, 20, '2019-02-07 14:03:37', 0),
(5, 20, '2019-02-07 14:03:37', 0),
(6, 20, '2019-02-07 14:03:37', 0),
(7, 20, '2019-02-07 14:03:37', 0),
(8, 20, '2019-02-07 14:03:37', 0),
(9, 20, '2019-02-07 14:03:37', 0),
(10, 20, '2019-02-07 14:03:37', 0),
(11, 20, '2019-02-07 14:03:37', 0),
(12, 20, '2019-02-07 14:03:37', 0),
(13, 20, '2019-02-07 14:03:37', 0),
(14, 20, '2019-02-07 14:03:37', 0),
(15, 20, '2019-02-07 14:03:37', 0),
(16, 20, '2019-02-07 14:03:37', 0),
(17, 20, '2019-02-07 14:03:37', 0),
(18, 20, '2019-02-07 14:03:37', 0),
(19, 20, '2019-02-07 14:03:37', 0),
(20, 20, '2019-02-07 14:03:37', 0),
(21, 20, '2019-02-07 14:03:37', 0),
(22, 20, '2019-02-07 14:03:37', 0),
(23, 10, '2019-02-07 14:03:37', 0),
(24, 20, '2019-02-07 14:03:37', 0),
(25, 20, '2019-02-07 14:03:37', 0),
(26, 3, '2019-02-07 14:03:37', 1),
(27, 20, '2019-02-07 14:03:37', 0),
(28, 20, '2019-02-07 14:03:37', 0),
(29, 20, '2019-02-07 14:03:37', 0),
(30, 20, '2019-02-07 14:03:37', 0),
(31, 20, '2019-02-07 14:03:37', 0),
(32, 20, '2019-02-07 14:03:37', 0),
(33, 20, '2019-02-07 14:03:37', 0),
(40, 0, '2019-02-07 15:54:35', 1),
(41, 7, '2019-02-07 15:57:46', 0),
(42, 0, '2019-02-14 14:46:15', 1);

--
-- Triggers `menu_Inventory`
--
DELIMITER $$
CREATE TRIGGER `ins_isLowCheck` BEFORE INSERT ON `menu_Inventory` FOR EACH ROW BEGIN
	IF NEW.`Inventory` < 5 THEN
    	SET NEW.`isLow` = 1;
    ELSE
    	SET NEW.`isLow` = 0;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `up_isLowCheck` BEFORE UPDATE ON `menu_Inventory` FOR EACH ROW BEGIN
	IF NEW.`Inventory` < 5 THEN
    	SET NEW.`isLow` = 1;
    ELSE
    	SET NEW.`isLow` = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menu_MenuItems`
--

CREATE TABLE `menu_MenuItems` (
  `id_MenuItem` int(11) NOT NULL,
  `ItemName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ItemPrice` decimal(8,2) NOT NULL,
  `ItemCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_MenuItems`
--

INSERT INTO `menu_MenuItems` (`id_MenuItem`, `ItemName`, `ItemPrice`, `ItemCat`) VALUES
(1, 'Cheese Sticks', '6.95', 20),
(2, 'Deep Fried Pickles', '4.95', 10),
(3, 'Cheese Fries', '5.95', 10),
(4, '10 Wings', '7.95', 10),
(5, '20 Wings', '10.95', 10),
(6, 'Coca-Cola', '1.95', 50),
(7, 'Diet Coke', '1.95', 50),
(8, 'Cherry Coke', '1.95', 50),
(9, 'Coke Zero', '1.95', 50),
(10, 'Pibb', '1.95', 50),
(11, 'Sprite', '1.95', 50),
(12, 'Fanta', '1.95', 50),
(13, 'Dr. Pepper', '1.95', 50),
(14, 'Water', '0.00', 50),
(15, 'Sweet Tea', '1.95', 50),
(16, 'Hot Tea', '1.00', 50),
(17, 'Coffee', '1.00', 50),
(18, 'Cesar Salad', '7.95', 20),
(19, 'House Salad', '6.95', 20),
(20, 'Greek Salad', '8.95', 20),
(21, 'French Onion Soup', '5.95', 20),
(22, 'Tomato Soup', '4.95', 20),
(23, 'Chicken Noodle Soup', '4.95', 20),
(24, 'Hamburger', '7.95', 30),
(25, 'Cheeseburger', '7.95', 30),
(26, 'Michael\'s Burger', '10.95', 30),
(27, 'Grilled Cheese', '5.95', 30),
(28, 'Chicken Burger', '8.95', 30),
(29, 'Hot Dog', '4.95', 30),
(30, 'French Fries', '1.95', 30),
(31, 'Cheese Fries', '2.95', 30),
(32, 'Vanilla Ice Cream', '3.95', 40),
(33, 'Chocolate Ice Cream', '3.95', 40),
(39, 'Test Item', '29.95', 20),
(40, 'Test Item', '100.00', 20),
(41, 'Test Item 2', '20.00', 20),
(42, 'q', '20.00', 10);

--
-- Triggers `menu_MenuItems`
--
DELIMITER $$
CREATE TRIGGER `ins_NewInventory` AFTER INSERT ON `menu_MenuItems` FOR EACH ROW BEGIN
	INSERT INTO `menu_Inventory` (`menu_Inventory`.`id_MenuItem`, `menu_Inventory`.`Inventory`)
    VALUES (NEW.`id_MenuItem`, 0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_Order`
--

CREATE TABLE `order_Order` (
  `id_Order` int(11) NOT NULL,
  `OrderTotal` decimal(8,2) NOT NULL DEFAULT '0.00',
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_Order`
--

INSERT INTO `order_Order` (`id_Order`, `OrderTotal`, `Created`, `CreatedBy`) VALUES
(1, '20.00', '2019-02-09 00:41:14', 'system'),
(2, '20.00', '2019-02-09 01:42:56', 'system'),
(3, '20.00', '2019-02-09 02:13:29', 'system'),
(4, '20.00', '2019-02-09 02:14:23', 'system'),
(5, '20.00', '2019-02-09 02:15:07', 'system'),
(6, '20.00', '2019-02-09 02:16:20', 'system'),
(7, '20.00', '2019-02-09 02:17:25', 'system'),
(8, '20.00', '2019-02-09 02:18:57', 'system'),
(9, '20.00', '2019-02-09 02:19:48', 'system'),
(10, '20.00', '2019-02-09 02:32:07', 'system'),
(11, '20.00', '2019-02-09 02:35:23', 'system'),
(12, '20.00', '2019-02-09 02:37:08', 'system'),
(13, '20.00', '2019-02-09 02:49:47', 'system'),
(14, '20.00', '2019-02-09 02:55:43', 'system'),
(15, '20.00', '2019-02-09 03:58:49', 'system'),
(16, '20.00', '2019-02-09 04:07:39', 'system'),
(17, '42.85', '2019-02-09 04:10:51', 'system'),
(18, '20.00', '2019-02-09 04:16:21', 'system'),
(19, '20.00', '2019-02-09 04:19:55', 'system'),
(20, '20.00', '2019-02-09 04:24:31', 'system'),
(21, '20.00', '2019-02-09 04:25:22', 'system'),
(22, '6.95', '2019-02-09 04:26:10', 'system'),
(23, '20.00', '2019-02-09 04:28:49', 'system'),
(24, '6.95', '2019-02-09 04:39:32', 'system'),
(25, '20.00', '2019-02-09 04:41:27', 'system'),
(26, '20.00', '2019-02-09 04:42:11', 'system'),
(27, '20.00', '2019-02-09 04:44:07', 'system'),
(28, '6.95', '2019-02-09 04:45:37', 'system'),
(29, '38.90', '2019-02-10 07:16:14', 'System'),
(30, '7.90', '2019-02-12 13:21:42', 'System'),
(31, '24.85', '2019-02-14 14:46:44', 'System');

-- --------------------------------------------------------

--
-- Table structure for table `order_OrderDetail`
--

CREATE TABLE `order_OrderDetail` (
  `id_Order` int(11) NOT NULL,
  `id_MenuItem` int(11) NOT NULL,
  `ItemPrice` decimal(8,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_OrderDetail`
--

INSERT INTO `order_OrderDetail` (`id_Order`, `id_MenuItem`, `ItemPrice`) VALUES
(1, 1, '25.00'),
(1, 1, '25.00'),
(10, 1, '6.95'),
(10, 1, '6.95'),
(10, 1, '6.95'),
(10, 1, '6.95'),
(11, 1, '6.95'),
(12, 1, '6.95'),
(12, 1, '6.95'),
(12, 1, '6.95'),
(12, 1, '6.95'),
(12, 29, '4.95'),
(12, 26, '10.95'),
(13, 23, '4.95'),
(13, 39, '29.95'),
(13, 1, '6.95'),
(13, 1, '6.95'),
(14, 20, '8.95'),
(14, 1, '6.95'),
(14, 1, '6.95'),
(15, 1, '6.95'),
(15, 23, '4.95'),
(15, 4, '7.95'),
(15, 31, '2.95'),
(16, 1, '6.95'),
(16, 13, '1.95'),
(16, 9, '1.95'),
(17, 41, '20.00'),
(17, 1, '6.95'),
(17, 2, '4.95'),
(17, 5, '10.95'),
(18, 19, '6.95'),
(18, 10, '1.95'),
(19, 23, '4.95'),
(19, 31, '2.95'),
(19, 23, '4.95'),
(19, 23, '4.95'),
(11, 20, '8.95'),
(20, 16, '1.00'),
(21, 4, '7.95'),
(22, 19, '6.95'),
(23, 22, '4.95'),
(24, 1, '6.95'),
(25, 1, '6.95'),
(26, 22, '4.95'),
(26, 1, '6.95'),
(26, 1, '6.95'),
(27, 19, '6.95'),
(27, 33, '3.95'),
(27, 12, '1.95'),
(28, 1, '6.95'),
(29, 39, '29.95'),
(29, 20, '8.95'),
(30, 22, '4.95'),
(30, 31, '2.95'),
(31, 24, '7.95'),
(31, 5, '10.95'),
(31, 21, '5.95');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core_Department`
--
ALTER TABLE `core_Department`
  ADD PRIMARY KEY (`id_Dept`);

--
-- Indexes for table `core_EmployeeDetail`
--
ALTER TABLE `core_EmployeeDetail`
  ADD PRIMARY KEY (`id_Row`);

--
-- Indexes for table `cust_Contact`
--
ALTER TABLE `cust_Contact`
  ADD PRIMARY KEY (`id_Contact`);

--
-- Indexes for table `cust_Customers`
--
ALTER TABLE `cust_Customers`
  ADD PRIMARY KEY (`id_Cust`);

--
-- Indexes for table `lu_PermisionLevel`
--
ALTER TABLE `lu_PermisionLevel`
  ADD PRIMARY KEY (`id_PermissionLevel`);

--
-- Indexes for table `menu_MenuItems`
--
ALTER TABLE `menu_MenuItems`
  ADD PRIMARY KEY (`id_MenuItem`);

--
-- Indexes for table `order_Order`
--
ALTER TABLE `order_Order`
  ADD PRIMARY KEY (`id_Order`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `core_EmployeeDetail`
--
ALTER TABLE `core_EmployeeDetail`
  MODIFY `id_Row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cust_Contact`
--
ALTER TABLE `cust_Contact`
  MODIFY `id_Contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `cust_Customers`
--
ALTER TABLE `cust_Customers`
  MODIFY `id_Cust` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_MenuItems`
--
ALTER TABLE `menu_MenuItems`
  MODIFY `id_MenuItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_Order`
--
ALTER TABLE `order_Order`
  MODIFY `id_Order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
