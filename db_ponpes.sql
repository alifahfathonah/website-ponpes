-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 08:10 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ponpes`
--

-- --------------------------------------------------------

--
-- Table structure for table `midtrans_payments`
--

CREATE TABLE `midtrans_payments` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `transaction_id` text NOT NULL,
  `order_id` text NOT NULL,
  `payment_type` text NOT NULL,
  `transaction_status` text NOT NULL,
  `transaction_time` datetime NOT NULL,
  `gross_amount` decimal(10,0) NOT NULL,
  `signature_key` text NOT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `midtrans_payments`
--

INSERT INTO `midtrans_payments` (`id`, `payment_id`, `transaction_id`, `order_id`, `payment_type`, `transaction_status`, `transaction_time`, `gross_amount`, `signature_key`, `token`) VALUES
(1, 14, '74a449c2-7956-4ccf-9a6b-5aa4b6501249', '15977625931371435912', 'bank_transfer', 'pending', '2020-08-18 21:57:25', '600000', 'bb2c5aa2ce2199778bb6f1a2dde883a7fd7f10b995769d03de3cd7835ef53b9f148f1ed71ed65eee09f7ba2e909712afeada6e274f05dcddac0625b47bc362b2', NULL),
(2, 14, '26227242-f037-4ff7-9e0c-40fd73da08f7', '1597762694111985033', 'bank_transfer', 'pending', '2020-08-18 21:58:31', '600000', '435111a6f6aeab73d35de15e41299f1fc10fb5cd7cafcfbfcbb2c9fe2cbfa1d4acdf5a2d29cbd81fc7dbb1fbc60f54375f4cfd1f91365bf8509cb535828c55c8', NULL),
(3, 14, 'e05236e7-1f76-45fc-9874-68878d65b9c7', '159776858150218074', 'bank_transfer', 'pending', '2020-08-18 23:36:29', '600000', 'b848414bc7f8538d3c3439f783a4d62e10ed74fb7dff63399b493c8bced22d289851a4247565ebf475dbd9e2154d4a573ff06d779428467bca93bc3069f45dd9', NULL),
(4, 14, '80f395eb-1f44-48e8-94fb-9a0c4faf129d', '1597770861965984967', 'bank_transfer', 'pending', '2020-08-19 00:14:28', '600000', '6bd15005f1b402835ce7e389b3345e03a100dd15b1d5e64a4311281832b4e8da2c674e397935c0a10b9dc9e102ecb9961037b850a2c6ebd69cbe017290bb6612', '365daa76-9a26-4916-8199-03a167618039'),
(5, 14, 'f8107029-aae0-4c5d-a840-51e811d7df7b', '1597772394216171249', 'bank_transfer', 'pending', '2020-08-19 00:40:02', '600000', '02b9a0d4bcfcae81a8d735d496c820832305c42e45c70e750728ea11fe9c9f8645b5115e50472bbeb72ab7358686b4e35415088185b180bef3b55ba805daf54b', 'b0be8dd4-779a-4cb8-9a2e-cea37ac18e07');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `photo` text NOT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `amount`, `photo`, `is_approved`, `transaction_date`, `created_at`, `updated_at`) VALUES
(8, 8, '1000000', 'uploads/payments/3ba9c7356c88d554736111b8e0fa22ae.jpg', 1, '2020-08-18 20:44:34', '2020-01-27 00:00:00', '2020-01-27 01:00:55'),
(11, 8, '600000', 'uploads/payments/bd053ca1100b5de7ba11898f4698127c.jpg', 1, '2020-08-18 20:44:34', '2020-08-01 00:00:00', '2020-08-01 15:38:34'),
(12, 8, '600000', '', 0, '2020-08-18 20:44:34', '2020-08-08 00:00:00', '2020-08-08 22:32:55'),
(14, 8, '600000', '', 0, '2020-08-18 00:00:00', '2020-08-11 00:00:00', '2020-08-18 19:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `room_type`, `qty`, `created_at`, `updated_at`) VALUES
(3, 4, 4, 2, '2020-01-15 14:04:48', '2020-01-15 14:04:48'),
(4, 6, 3, 4, '2020-01-15 14:05:05', '2020-01-15 14:05:05'),
(5, 7, 3, 2, '2020-01-16 13:42:16', '2020-01-16 13:42:16'),
(6, 3, 6, 4, '2020-01-16 23:18:07', '2020-01-16 23:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Khodijahhhhh', '2020-01-14 16:42:16', '2020-01-14 16:42:16'),
(4, 'Zaenab', '2020-01-14 16:42:22', '2020-01-14 16:42:22'),
(5, 'Jubaedah', '2020-01-16 13:42:32', '2020-01-16 13:42:32'),
(6, 'Nyaman', '2020-01-16 23:17:56', '2020-01-16 23:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `no_identity` varchar(16) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(13) NOT NULL,
  `photo` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `name`, `no_identity`, `address`, `phone`, `photo`, `created_at`, `updated_at`) VALUES
(3, 9, 'Buaya Darat KU', '3302252112970001', 'yogyakarta', '081', 'uploads/foto_profile/39e617ed3be0af56b8eaa617c2185a58.jpg', '2020-01-20 23:54:48', '2020-01-20 23:54:48'),
(8, 19, 'Riko Herlambang', '00000000', 'Perum lucu no 100', '08122992424', 'uploads/foto_profile/11180d36f961ed7ae7057e83fa5695ed.jpg', '2020-01-27 22:09:55', '2020-01-27 22:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `no_identity` varchar(16) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(13) NOT NULL,
  `photo` text DEFAULT NULL,
  `room` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `no_identity`, `address`, `phone`, `photo`, `room`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 18, 'Angel Lelga', '3302252112970001', 'full street address', '08122992424', 'uploads/foto_profile/65d1c2fb6b4cf073882c607160c6895c.png', 4, 1, '2020-01-25 14:42:44', '2020-01-25 14:42:44', NULL),
(9, 20, 'telo123', '0909090', 'Yogya', '9090930', 'uploads/foto_profile/b38bb8dd766f497c978e5b4889df239b.jpg', 4, 0, '2020-01-28 08:38:44', '2020-01-28 08:38:44', NULL),
(11, 24, 'Cakra Amiyantoro', '33022123131232', 'PPPPPP', '012930192301', NULL, NULL, 0, '2020-01-28 16:19:52', '2020-01-28 16:19:52', NULL),
(15, 28, 'NTQx58CSNn', 'posQ8sq01J', 'j4vc5nryAI', 'mwX2IUipGe', NULL, NULL, 0, '2020-01-29 09:28:10', '2020-01-29 09:28:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `email` text DEFAULT NULL,
  `level` int(11) NOT NULL,
  `is_email_verified` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `remember_token` text DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `level`, `is_email_verified`, `status`, `remember_token`, `created_date`, `updated_date`) VALUES
(9, 'cakraa3', '$2y$10$PeHYvQNDdBzAGEyYi.x.uO0vIgowPSdhN.JZrASlnVnlPe.dBJCzq', 'cakraa3@gmail.com', 0, 1, 1, NULL, '2020-01-20 23:54:48', '2020-01-20 23:54:48'),
(18, 'angle', '$2y$10$4XYey.DRQAL4wj0nWQzmy./QBMIW9sTjMdBgaOVgeenoGDB1P8vxy', 'lalal@mailinator.com', 2, 1, 1, NULL, '2020-01-25 14:42:44', '2020-01-25 14:42:44'),
(19, 'rikoherlambang', '$2y$10$PeHYvQNDdBzAGEyYi.x.uO0vIgowPSdhN.JZrASlnVnlPe.dBJCzq', NULL, 1, 1, 1, NULL, '2020-01-27 22:09:55', '2020-01-27 22:09:55'),
(20, 'telo123', '$2y$10$1blrG0bpPX61RgZ23I1dhuFJXjhwXWcKwdCyhjC9ZK6wEbph0Jnne', NULL, 2, 1, 0, NULL, '2020-01-28 08:38:44', '2020-01-28 08:38:44'),
(21, '5Lk3Bw23', '$2y$10$XJ9vBck1Dy5CQAIDGQGHheJhJ0xP4/5jjN7D5/4GfLDyFG7DpZAkO', NULL, 2, 1, 0, NULL, '2020-01-28 08:59:30', '2020-01-28 08:59:30'),
(24, 'cakraa4', '$2y$10$/d7l0s5RWXIYYvNdBOmHCu072PiT559XRQWmEtKLCDEQ0jtXuYOCC', NULL, 2, 1, 0, NULL, '2020-01-28 16:19:52', '2020-01-28 16:19:52'),
(28, 'TzRm3Cd3GP', '$2y$10$JJxXp/6c7ezdbfzVBgu6ieiHIe4d8E2HNftI7Hx7.HCuXFQaHWf1C', 'cakraa3@mailinator.com', 2, 0, 0, 'dbd6c7949da88a6631d9257b6a03f0ff089f5a650cf9b35c83a397f279e88fa4eb479757dc5713105fe585d1230c615497c74c43d6b2591e47259c18cf4de7a4', '2020-01-29 09:28:10', '2020-01-29 09:28:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `midtrans_payments`
--
ALTER TABLE `midtrans_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type` (`room_type`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room` (`room`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `midtrans_payments`
--
ALTER TABLE `midtrans_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`room_type`) REFERENCES `room_types` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`room`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
