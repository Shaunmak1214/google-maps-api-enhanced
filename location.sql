-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2021 at 03:11 AM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mMIOP5Me5n`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationId` int(11) NOT NULL,
  `stayId` int(11) DEFAULT NULL,
  `hotelId` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `stayType` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationId`, `stayId`, `hotelId`, `address`, `lat`, `lng`, `stayType`) VALUES
(9001, 4001, NULL, 'Jalan Macalister, George Town, 10400 George Town, Penang, Malaysia', 5.417554, 100.321350, 'homestay'),
(9002, 4002, NULL, 'Hang Tuah Jaya, Puncak Muzaffar, Jalan MH Utama, Taman Muzaffar Heights, 75450 Ayer Keroh, Malacca.', 2.253585, 102.281471, 'homestay'),
(9003, 4003, NULL, 'Jalan Teknokrat 1, Cyberjaya, 63000 Cyberjaya, Selangor.', 2.948717, 101.654617, 'homestay'),
(9004, 4004, NULL, 'Jalan Tun Razak, Titiwangsa, 50400 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur.', 3.171470, 101.710106, 'homestay'),
(9005, 4005, NULL, 'Jalan, Mukim, Kampung Baru Pantai, 71770 Seremban, Negeri Sembilan.', 2.800870, 102.015205, 'homestay'),
(9006, 4006, NULL, 'Kompleks Baitulhilal, Lot 4506 Batu, 8, Jalan Pantai, 71050 Port Dickson, Negeri Sembilan.', 2.445402, 101.855080, 'homestay'),
(9007, 4007, NULL, 'Jalan Syed Abdul Aziz, Taman Melaka Raya, 75000 Melaka.', 2.182513, 102.260246, 'homestay'),
(9008, 4008, NULL, 'Jalan Padang Golf, Kampung Tun Abdul Razak, 44000 Kuala Kubu Baru, Selangor.', 3.571286, 101.644211, 'homestay'),
(9009, 4009, NULL, 'Jalan Padang Gaong, 07000 Kuah, Kedah.', 6.330279, 99.822594, 'homestay'),
(9010, 4010, NULL, 'Lorong Burma, 10250 George Town, Pulau Pinang.', 5.432878, 100.314827, 'homestay'),
(9011, NULL, 3001, 'Batu Ferringhi Beach, 11100 Batu Ferringhi, Pulau Pinang.', 5.467695, 100.241554, 'hotel'),
(9012, NULL, 3002, 'Persiaran Lagoon, Bandar Sunway, 47500 Selangor Darul Ehsan.', 3.072099, 101.608505, 'hotel'),
(9013, NULL, 3003, '2, Hala Datuk 5, Kampung Kuchai, 31650 Ipoh, Perak.', 4.588397, 101.077751, 'hotel'),
(9014, NULL, 3004, 'G8, Jalan PM 7, Plaza Mahkota, Melaka Raya, 75000 Melaka.', 2.189257, 102.245773, 'hotel'),
(9015, NULL, 3005, 'No. 33A-0, Blok G, Platinum Walk, Jalan Langkawi Danau Kota No. 33A-0, Blok G, 53300 Kuala Lumpur.', 3.205636, 101.719475, 'hotel'),
(9016, NULL, 3006, '12th Mile, Jalan Pantai, Pasir Panjang 71250 Port Dickson, Negeri Sembilan.', 2.418491, 101.873878, 'hotel'),
(9017, NULL, 3007, 'No 8, Persiaran Sukan, Seksyen 13, Shah Alam City Center, 40100 Shah Alam, Selangor.', 3.089329, 101.548004, 'hotel'),
(9018, NULL, 3008, '18 & 20, Jalan SS 22/25, Damansara Jaya, 47400 Petaling Jaya, Kuala Lumpur.', 3.127693, 101.617569, 'hotel'),
(9019, NULL, 3009, 'Sepang Goldcoast, No. 67, Jalan Pantai Bagan Lalang, Kg. Bagan Lalang, 43950 Sepang, Selangor.', 2.600669, 101.687378, 'hotel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9020;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
