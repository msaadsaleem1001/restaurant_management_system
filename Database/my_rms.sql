-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 07:04 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `confirm_orders`
--

CREATE TABLE `confirm_orders` (
  `S_No` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Dishes` text NOT NULL,
  `prices` text NOT NULL,
  `quantities` text NOT NULL,
  `subtotals` text NOT NULL,
  `grand_total` int(10) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Order_type` text NOT NULL,
  `Status` text NOT NULL,
  `Method` text NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `chef_username` text NOT NULL,
  `paid` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `confirm_orders`
--

INSERT INTO `confirm_orders` (`S_No`, `username`, `Dishes`, `prices`, `quantities`, `subtotals`, `grand_total`, `Date`, `Order_type`, `Status`, `Method`, `order_no`, `chef_username`, `paid`) VALUES
(20, 'Bilal02137', 'Fish Pakora, Chiken Karahi, Roti, Coke Teen pack, ', '1500, 700, 10, 100, ', '3, 2, 10, 3, ', '4500, 1400, 100, 300, ', 6300, '2022-06-08 20:28:42', 'Meal, Meal, Meal, Drinks, ', 'Served', 'Dine Here and table no: 15', 'Bilal02137#894', 'ahmadmakki', 'Request'),
(22, 'Nabeel000', 'Pizza Medium, Large Pizza, ', '600, 900, ', '2, 3, ', '1200, 2700, ', 3900, '2022-06-09 06:57:37', 'Fast Food, Fast Food, ', 'Served', 'Parcel', 'Nabeel000#2248', 'kashif2133', 'Paid'),
(23, 'Shahzad103', 'Sohan Halwa plate, Dew Teen pack, Donuts, ', '500, 100, 200, ', '3, 3, 1, ', '1500, 300, 200, Home Delivery Charges: 100rs.', 2100, '2022-06-09 07:06:29', 'Desserts, Drinks, Desserts, ', 'Delivered', 'Home Delivery at: Street no:10, home no.12', 'Shahzad103#2719', 'ahmadmakki', NULL),
(24, 'Hamza0231', 'Chiken Karahi, Roti, Pepsi Teen pack, ', '700, 10, 100, ', '2, 20, 4, ', '1400, 200, 400, ', 2000, '2022-06-09 07:14:54', 'Meal, Meal, Drinks, ', 'Served', 'Dine Here and table no: 20', 'Hamza0231#448', 'nabeel@chef', 'Paid'),
(25, 'Kashif0693', 'Mutton Karahi, Roti, ', '1850, 10, ', '1, 10, ', '1850, 100, ', 1950, '2022-06-09 07:21:44', 'Meal, Meal, ', 'Served', 'Dine Here and table no: 30', 'Kashif0693#169', 'nabeel@chef', 'Paid'),
(27, 'Mishal4321', 'Finger Chips, Small Pizza, ', '200, 350, ', '2, 2, ', '400, 700, Home Delivery Charges: 100rs.', 1200, '2022-06-09 07:30:12', 'Fast Food, Fast Food, ', 'Delivered', 'Home Delivery at: home', 'Mishal4321#886', 'msaleemjoiya', 'Paid'),
(28, 'Hamdan2112', 'Shami Kabab, Burger, Coke Teen pack, ', '200, 100, 100, ', '2, 4, 4, ', '400, 400, 400, ', 1200, '2022-06-09 07:33:06', 'Fast Food, Fast Food, Drinks, ', 'Served', 'Dine Here and table no: 50', 'Hamdan2112#635', 'msaleemjoiya', 'Paid'),
(29, 'Saleem1013', 'Kheer Plate, Beaf plao, ', '100, 600, ', '2, 2, ', '200, 1200, ', 1400, '2022-06-09 07:36:51', 'Desserts, Meal, ', 'Served', 'Parcel', 'Saleem1013#828', 'ahmadmakki', NULL),
(30, 'Dawood1030', 'White korma, Roti, Sprite teen pack, ', '570, 10, 100, ', '3, 10, 2, ', '1710, 100, 200, ', 2010, '2022-06-09 07:39:58', 'Meal, Meal, Drinks, ', 'Served', 'Dine Here and table no: 15', 'Dawood1030#475', 'kashif2133', NULL),
(31, 'Bilal02137', 'Rayta bowl, Kaleji , Chinease rice, ', '100, 500, 500, ', '2, 3, 4, ', '200, 1500, 2000, ', 3700, '2022-06-14 18:33:23', 'Meal, Meal, Meal, ', 'Canceled', 'Dine Here and table no: 30', 'Bilal02137#1559', '', NULL),
(32, 'Mishal4321', 'Chiken Roast, Mutton Karahi, ', '800, 1850, ', '1, 1, ', '800, 1850, ', 2650, '2022-06-17 18:15:16', 'Meal, Meal, ', 'Pending', 'Dine Here and table no: 15', '#32', '', NULL),
(33, 'Mishal4321', 'Fish Pakora, Chiken Roast, ', '1500, 800, ', '1, 1, ', '1500, 800, ', 2300, '2022-06-17 18:29:56', 'Meal, Meal, ', 'Pending', 'Parcel', '#33', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacttbl`
--

CREATE TABLE `contacttbl` (
  `Serial` int(11) NOT NULL,
  `First Name` text NOT NULL,
  `Last Name` text NOT NULL,
  `E-Mail` varchar(50) NOT NULL,
  `City Name` varchar(100) NOT NULL,
  `Description` varchar(1500) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacttbl`
--

INSERT INTO `contacttbl` (`Serial`, `First Name`, `Last Name`, `E-Mail`, `City Name`, `Description`, `Date`) VALUES
(26, 'Talha', 'Masood', 'talha@mukdi.com', 'Rahimyarkhan', 'I amTalha', '2022-06-13 09:54:56'),
(27, 'Kashif', 'Bhutta', 'kashif@mukdi.com', 'Bahawalpur', 'I am Kashif.', '2022-06-13 10:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `Serial_no` int(11) NOT NULL,
  `Dish_Type` text NOT NULL,
  `Dish_Name` text NOT NULL,
  `Required_Minutes` int(30) NOT NULL,
  `Price` int(10) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory_items`
--

INSERT INTO `inventory_items` (`Serial_no`, `Dish_Type`, `Dish_Name`, `Required_Minutes`, `Price`, `Image`) VALUES
(100, 'Meal', 'Beaf karahi', 20, 1000, 'uploaded_images/beaf.jfif'),
(101, 'Meal', 'Rayta bowl', 5, 100, 'uploaded_images/rayta.webp'),
(102, 'Meal', 'Fish Pakora', 30, 1500, 'uploaded_images/fish.jpg'),
(103, 'Meal', 'Chiken Roast', 15, 800, 'uploaded_images/roast.jfif'),
(104, 'Meal', 'Mutton Keema', 30, 2000, 'uploaded_images/mutton_keema.webp'),
(105, 'Meal', 'Kaleji ', 15, 500, 'uploaded_images/kaleji.jpg'),
(106, 'Meal', 'Beaf plao', 15, 600, 'uploaded_images/plao.jpg'),
(107, 'Meal', 'Chicken Biryani', 10, 300, 'uploaded_images/biryani.jpg'),
(108, 'Meal', 'Chinease rice', 10, 500, 'uploaded_images/chineas_rice.jpg'),
(109, 'Meal', 'Roti', 2, 10, 'uploaded_images/roti.jpg'),
(110, 'Meal', 'White korma', 10, 570, 'uploaded_images/white_corma.jpg'),
(111, 'Meal', 'Mutton Karahi', 20, 1850, 'uploaded_images/mutton.webp'),
(112, 'Meal', 'Chiken Karahi', 15, 700, 'uploaded_images/chicken.jpg'),
(113, 'Fast Food', 'Dehi Balle', 5, 150, 'uploaded_images/dehi_balle.jpg'),
(114, 'Fast Food', 'Goal Gappe plate', 5, 100, 'uploaded_images/goal_gappe.jfif'),
(115, 'Fast Food', 'Finger Chips', 5, 200, 'uploaded_images/finger_chips.jfif'),
(116, 'Fast Food', 'Dubble Shawarma deal', 5, 300, 'uploaded_images/dubble_shawarma_deal.jfif'),
(117, 'Fast Food', 'Burger', 5, 100, 'uploaded_images/zinger_burger.jpg'),
(118, 'Fast Food', 'Zinger burger, Finger chips, Drink, Shawarma', 5, 650, 'uploaded_images/zinger_finger_drink_deal.avif'),
(119, 'Fast Food', 'Shami Kabab', 5, 200, 'uploaded_images/shami_kabab.jpeg'),
(120, 'Fast Food', 'Pizza Medium', 10, 600, 'uploaded_images/medium_pizza.webp'),
(121, 'Fast Food', 'Large Pizza', 10, 900, 'uploaded_images/large_pizza.webp'),
(122, 'Fast Food', 'Small Pizza', 10, 350, 'uploaded_images/small_pizza.webp'),
(123, 'Desserts', 'Donuts', 10, 200, 'uploaded_images/donuts.webp'),
(124, 'Desserts', 'Rass gulle plate', 10, 200, 'uploaded_images/Sweat_rasgully.jpg'),
(125, 'Desserts', 'Desserts Special Dish (Biscuits)', 10, 500, 'uploaded_images/special_.jpg'),
(126, 'Desserts', 'Custurd Double Cup', 10, 300, 'uploaded_images/custurd.jpg'),
(127, 'Desserts', 'Strobery barries plate', 10, 200, 'uploaded_images/stroberry_dessert.jfif'),
(128, 'Desserts', 'Sohan Halwa plate', 10, 500, 'uploaded_images/sohan_halwa.jpg'),
(129, 'Desserts', 'Cake (Vinella flavor)2 pond', 10, 600, 'uploaded_images/vinala_cake.jpg'),
(130, 'Desserts', 'Cake Choco Flavor(1 pond)', 10, 300, 'uploaded_images/choco_cake.webp'),
(131, 'Desserts', 'Choco Cup', 10, 200, 'uploaded_images/choco_cup.jpg'),
(132, 'Desserts', 'Kheer Plate', 10, 100, 'uploaded_images/Kheer.jfif'),
(133, 'Drinks', 'Mango Shake ', 5, 100, 'uploaded_images/mango_shake.jpg'),
(134, 'Drinks', 'Apple Shake', 5, 100, 'uploaded_images/apple_shake.webp'),
(135, 'Drinks', 'Banana Shake', 5, 100, 'uploaded_images/banana_shake.png'),
(136, 'Drinks', 'Choco Shake', 5, 100, 'uploaded_images/chco_shake.jpg'),
(137, 'Drinks', 'Strobery Shake', 5, 100, 'uploaded_images/strobery_shake.jpg'),
(138, 'Drinks', 'Dew Teen pack', 5, 100, 'uploaded_images/dew_teen.jpg'),
(139, 'Drinks', 'Pepsi Teen pack', 5, 100, 'uploaded_images/pespsi_teen.png'),
(140, 'Drinks', 'Sprite teen pack', 5, 100, 'uploaded_images/sprite_teen.jfif'),
(141, 'Drinks', 'Coke Teen pack', 5, 100, 'uploaded_images/coke_teen.jfif'),
(142, 'Drinks', 'Can Coke Pack', 5, 100, 'uploaded_images/cann_coke.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders_in_process`
--

CREATE TABLE `orders_in_process` (
  `S_No` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dish_type` text NOT NULL,
  `dish` text NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reported-issues`
--

CREATE TABLE `reported-issues` (
  `Sr` int(11) NOT NULL,
  `Description-report` varchar(250) NOT NULL,
  `Adress-mail` varchar(50) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reported-issues`
--

INSERT INTO `reported-issues` (`Sr`, `Description-report`, `Adress-mail`, `Date`) VALUES
(22, 'prblem', 'saad@mukdi.com', '2022-06-05 11:09:54'),
(23, 'prblem ha', 'saad@mukdi.com', '2022-06-05 11:12:05'),
(24, 'prblem ha', 'saad@mukdi.com', '2022-06-05 11:12:59'),
(25, 'yeah ha problem', 'saad@mukdi.com', '2022-06-05 11:13:24'),
(26, 'employer', 'saad@mukdi.com', '2022-06-05 11:19:33'),
(27, 'MCS project almost ready.', 'saad@mukdi.com', '2022-06-13 10:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `serial_no` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `first_name` text NOT NULL,
  `Last_Name` text NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `e_mail` text NOT NULL,
  `post` text NOT NULL,
  `Speciality` text NOT NULL,
  `Date_of_join` date NOT NULL DEFAULT current_timestamp(),
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`serial_no`, `username`, `password`, `first_name`, `Last_Name`, `contact_no`, `e_mail`, `post`, `Speciality`, `Date_of_join`, `Status`) VALUES
(16, 'saad101', '$2y$10$FhcWcrWNV05AFZuRHvDRl.Jqmucrxbj1X4bPD4dAuXTdYLOtplza6', 'Saad', 'Saleem', '03119686104', ' saad@mukdi.com', 'Admin', 'Administrate', '2022-06-07', 'Active'),
(17, 'bilal2137', '$2y$10$V7f6zQWuBLYCPz5hVoAE1.6SF627dyX5YtUCXK4fh.wBNxncEKb3K', 'Bilal', 'Rasheed', '03095756395', ' bilal@mukdi.com', 'Manager', 'Mangement', '2022-06-07', 'Deactive'),
(18, 'ahsan1001', '$2y$10$4JDdb/31eHcjlGDVWybyn.4PdaPioEiIZpkgvTjUQljRRnPUTqSva', 'Ahsan', 'Mustafa', '03004565490', ' ahsan1001@mukdi.com', 'Head Chef', 'Mangement', '2022-06-07', 'Deactive'),
(19, 'faizan@delivery', '$2y$10$N793LvAleJTEDMyhDs96WObK95461CxKzRrXVsXfvPBcwS2LZNg0q', 'Faizan', 'Sagheer', '03115648234', ' faizan@mukdi.com', 'Delivery Boy', 'Fast Delivery Service', '2022-06-07', 'Deactive'),
(20, 'nabeel@chef', '$2y$10$mmQjiGf.GzvSjAm98FAl7.nCGeq/NgYMsSjrmNSJzMB7.9X.SnYPi', 'Nabeel', 'Arshad', '03442211456', ' nabeel@mukdi.com', 'Chef', 'Meal', '2022-06-07', 'Deactive'),
(21, 'msaleemjoiya', '$2y$10$WU7z3t5A/z372qWRNuOFyuoD/v1W/0GBxLrT4sgN3dHZ.2IXOJxZC', 'Saleem', 'Joiya', '03451234567', 'saleem@mukdi.com', 'Chef', 'Fast Food', '2022-06-07', 'Deactive'),
(22, 'ahmadmakki', '$2y$10$4jSeMb5GTmcfEhpPTpagb.mvwil.IemY0DrH.ijtxdvGhfolcT/1.', 'Ahmad', 'Makki', '03461234567', 'makki@mukdi.com', 'Chef', 'Desserts', '2022-06-07', 'Deactive'),
(23, 'kashif2133', '$2y$10$L7wrjQeX2CDaLQkqOkzvM.ksKmHBBgXDjAG17V51gTenyws6yg1dy', 'Kashif', 'M.Kashif', '03126758897', 'kashif@mukdi.com', 'Chef', 'Drinks', '2022-06-07', 'Deactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_for_tables`
--

CREATE TABLE `tbl_for_tables` (
  `Sr_no` int(11) NOT NULL,
  `table_no` int(10) NOT NULL,
  `status_tbl` text NOT NULL,
  `tbl_capacity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_for_tables`
--

INSERT INTO `tbl_for_tables` (`Sr_no`, `table_no`, `status_tbl`, `tbl_capacity`) VALUES
(3, 20, 'Available', 12),
(4, 30, 'Reserved', 2),
(6, 50, 'Available', 8),
(7, 40, 'Available', 4),
(8, 15, 'Reserved', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `pass_word` varchar(255) NOT NULL,
  `e_mail` varchar(80) NOT NULL,
  `add_ress` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_name`, `pass_word`, `e_mail`, `add_ress`) VALUES
(15, 'Bilal', 'Rasheed', 'Bilal02137', '$2y$10$DCieZWWI7fg9dEglE7/dPeJaKCj9vaMCvgA8Is7IIktYstObusYae', 'bilal2137@mukdi.com', 'Haroonabad'),
(16, 'Saad', 'Saleem', 'saad101', '$2y$10$gk1g8NSjAWrIoe3S5DWka..EsFG44Qv2Tt14Dcymq2mwyheGt202G', ' saad@mukdi.com', '0311968610'),
(17, 'Shehzad', 'Aslam', 'Shahzad103', '$2y$10$gd/41jl0Zqgc4whiSKMn1.XOAkAHsj0z1MxaekjSYC3aTACdFlIOC', 'shehzad@mukdi.com', 'khichiwala'),
(18, 'Hamza', 'Batti', 'Hamza0231', '$2y$10$dnoWWS0oXLClm0Kcc1jIE.mS7u1KYjDLHBfM6jU0c3DkiucXo257y', 'hamza@mukdi.com', 'Ahmadpur'),
(19, 'Kashif', 'Rasheed', 'Kashif0693', '$2y$10$KZ8KA7mHFYfIOegIRm1FnOCo1kQKu4wRD7b6WToKeXX0R9rr4UnvW', 'kashif@mukdi.com', 'Kahrorhpakka'),
(20, 'Mehtab', 'Saleem', 'Mehtab1093', '$2y$10$qpkqYl3N00MXJcGi8q2NFeQdzxFtLHZWht84UhO34BwxJ91rmHqDO', 'mehtab@mukdi.com', 'Yazman'),
(21, 'Mishal', 'Mehtab', 'Mishal4321', '$2y$10$OlnrFeKXWvz31uK6cXi5K.LoHwhQmJYc.2l2nndxkfPC4Trx99YZW', 'mishal@mukdi.com', 'Yazman'),
(22, 'Hamdan', 'Mehtab', 'Hamdan2112', '$2y$10$wv4am8YJ8avWl6/02vb/leEP0wOQVR.T2hHAUSDQ3IJJ56mA3cP0i', 'hamdan@mukdi.com', 'Yazman'),
(23, 'Saleem', 'Sadeeq', 'Saleem1013', '$2y$10$obd03kA8l27xEoSV1s6J0.1Tv2T15jwfORr5J9ItYww9G9h4V8lES', 'saleem@mukdi.com', 'Chak no. 101/D.B'),
(24, 'Dawood', 'Abid', 'Dawood1030', '$2y$10$79fHtW0Po5ve5FdQUVvW0eWK8eDLv4rDjlwKhHYPkERF8YtOiGiFC', 'dawood@mukdi.com', 'Chak no.103/D.B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `confirm_orders`
--
ALTER TABLE `confirm_orders`
  ADD PRIMARY KEY (`S_No`),
  ADD UNIQUE KEY `order_no` (`order_no`);

--
-- Indexes for table `contacttbl`
--
ALTER TABLE `contacttbl`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`Serial_no`);

--
-- Indexes for table `orders_in_process`
--
ALTER TABLE `orders_in_process`
  ADD PRIMARY KEY (`S_No`);

--
-- Indexes for table `reported-issues`
--
ALTER TABLE `reported-issues`
  ADD PRIMARY KEY (`Sr`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`serial_no`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_for_tables`
--
ALTER TABLE `tbl_for_tables`
  ADD PRIMARY KEY (`Sr_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `confirm_orders`
--
ALTER TABLE `confirm_orders`
  MODIFY `S_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contacttbl`
--
ALTER TABLE `contacttbl`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `Serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `orders_in_process`
--
ALTER TABLE `orders_in_process`
  MODIFY `S_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `reported-issues`
--
ALTER TABLE `reported-issues`
  MODIFY `Sr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_for_tables`
--
ALTER TABLE `tbl_for_tables`
  MODIFY `Sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
