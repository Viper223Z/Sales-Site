-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Wrz 10, 2024 at 11:30 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `offers`
--

CREATE TABLE `offers` (
  `id` varchar(50) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `user_id`, `title`, `description`, `price`, `image`) VALUES
('6688445318a1a', '6688442508f95', 'smsa', 'osad', 213.00, 'images.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `delivery_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `first_name`, `last_name`, `phone`, `postal_code`, `address`, `payment_method`, `delivery_method`) VALUES
(3, '6688442508f95', 1704.00, 'wad', 'sad', 'dsad', 'dsa', 'dsad', 'credit_card', 'courier'),
(4, '669d66c06754b2.90646686', 213.00, 'cos', 'cps', '341231', '321321', 'dsadas', 'credit_card', 'courier'),
(5, '669d66c06754b2.90646686', 213.00, 'sda', 'dsa', 'dsa', 'dsa', 'dąs', 'credit_card', 'courier'),
(6, '669d66c06754b2.90646686', 213.00, 'csad', 'dsad', 'dsa', 'dsa', 'dla', 'credit_card', 'courier'),
(7, '669d66c06754b2.90646686', 213.00, 'dsas', 'sdadas', 'dsad', 'sda', 'dsa', 'credit_card', 'courier'),
(8, '669d66c06754b2.90646686', 213.00, 'dsad', 'dsad', 'dsad', 'dsa', 'dsa', 'credit_card', 'courier'),
(9, '669d66c06754b2.90646686', 639.00, 'dsad', 'dsad', 'dsad', 'dsad', 'osad', 'credit_card', 'courier'),
(10, '669d66c06754b2.90646686', 213.00, 'ad', 'dsad', 'dsad', 'dsad', 'dla', 'credit_card', 'courier');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `offer_id` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `offer_id`, `quantity`, `user_id`) VALUES
(3, 3, '6688445318a1a', 8, ''),
(4, 4, '6688445318a1a', 1, ''),
(5, 5, '6688445318a1a', 1, ''),
(6, 6, '6688445318a1a', 1, ''),
(7, 7, '6688445318a1a', 1, ''),
(8, 8, '6688445318a1a', 1, ''),
(9, 9, '6688445318a1a', 3, '669d66c06754b2.90646686'),
(10, 10, '6688445318a1a', 1, '669d66c06754b2.90646686');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `user_surname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `email`, `nick`, `user_surname`, `phone`) VALUES
('6688442508f95', 'tak', '123', 'das@cos.pl', 'tak', '', ''),
('669d66c06754b2.90646686', 'cos', '$2y$10$0fBbCSb5vkWrikJqb4hhauGDVKd/mtoKDgaD4svs7Kp2TTOSvFjMC', 'cos@cos.pl', 'cos', 'cos', '123'),
('669d66ea055ba1.92336251', 'cos', '$2y$10$kyfM3vNSrc7UyDlFmcJMLu7n66KaqHSpstWREP7zlM/39RU7XhKmO', 'cos@cos.pl', 'cos', 'cos', '123');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_orders`
--

CREATE TABLE `user_orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `offer_id` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
