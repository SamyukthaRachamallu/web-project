-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 04:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pets_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `Id` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`Id`, `UserID`, `Address`) VALUES
(0, 2, 'check'),
(1, 2, '4/11,tata value homes,chennai');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PetID` int(11) DEFAULT NULL,
  `Service` varchar(100) DEFAULT NULL,
  `Type` varchar(100) DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `AppointmentTime` time DEFAULT current_timestamp(),
  `Amount` int(11) DEFAULT NULL,
  `PickupAddress` varchar(200) DEFAULT NULL,
  `IsInCart` bit(1) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `confirmed` bit(11) DEFAULT NULL,
  `Hospital` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `UserID`, `PetID`, `Service`, `Type`, `AppointmentDate`, `AppointmentTime`, `Amount`, `PickupAddress`, `IsInCart`, `status`, `confirmed`, `Hospital`) VALUES
(10, 2, 2, 'Veterinary', 'Female', '2023-11-17', '00:20:23', 3999, '', NULL, 0, b'00000000001', ''),
(14, 4, 2, 'Training', 'Female', '2023-11-17', '00:20:23', 999, '4/11,tata value homes,chennai', NULL, 0, b'00000000001', ''),
(15, 4, 2, 'Training', 'Female', '2023-11-17', '00:20:23', 999, '4/11,tata value homes,chennai', NULL, 0, b'00000000000', ''),
(17, 4, 2, 'Walking', 'Female', '2023-11-17', '00:20:23', 3499, '4/11,tata value homes,chennai', NULL, 0, b'00000000000', 'ABC Hospital'),
(64, 2, 2, 'Veterinary', 'Anti Tick Treatment', '2023-12-29', '00:00:04', 1499, 'chennai', b'1', 0, NULL, 'ABC Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `isAdmin` bit(1) DEFAULT b'0',
  `designation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`UserID`, `Name`, `Email`, `PhoneNumber`, `Password`, `isAdmin`, `designation`) VALUES
(1, 'samyuktha', 'admin@gmail.com', '1234567890', '123', b'1', 0),
(2, 'Geetha Sridhar', 'user@gmail.com', '1234567890', '012', b'0', 0),
(3, 'deeksha tha', 'deekshi@gmail.com', '1234567890', '234', b'0', 1),
(4, 'hoax', 'vasa', 'caxca', 'casa', b'0', 0),
(7, 'rgawrg', 'wef@gmail.com', '4564276', '267', b'0', 0),
(8, 'rgae', 'regrseh@gmail.com', '1234567876', '567', b'0', 1),
(9, 'kelly', 'kelly@gmail.com', '1234567898', '298', b'0', 2),
(10, 'krishna', 'krishn@gmail.com', '9876543218', 'krishna', b'0', 0),
(11, 'Radhika', 'ra@gmail.com', '6748837378', 'ra123', b'0', 3),
(12, 'keerthi', 'keer@gmail.com', '5678987654', '987', b'0', 3);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `Id` int(11) NOT NULL,
  `dest` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`Id`, `dest`) VALUES
(2, 'ABC Hospital'),
(3, 'UVW Hospital'),
(6, 'POR Hospital'),
(7, 'KMN Hospital'),
(4, 'SWK Hospital'),
(10, 'GSG Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `user_id` varchar(150) NOT NULL,
  `payment_id` varchar(150) NOT NULL,
  `amount` varchar(150) NOT NULL,
  `product_id` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `PetID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PetName` varchar(50) DEFAULT NULL,
  `PetType` text DEFAULT NULL,
  `PetGender` text DEFAULT NULL,
  `Breed` text DEFAULT NULL,
  `BirthDay` date DEFAULT NULL,
  `Weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`PetID`, `UserID`, `PetName`, `PetType`, `PetGender`, `Breed`, `BirthDay`, `Weight`) VALUES
(1, 2, 'shiro', 'Dog', 'male', 'husky', '2022-12-10', NULL),
(2, 2, 'hulk', 'dog', 'male', 'rotwiller', '2022-11-07', NULL),
(14, 2, 'Cat', 'cat', 'female', 'rotwiller', '2023-01-11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `PetType` text DEFAULT NULL,
  `Service` text NOT NULL,
  `Type` text NOT NULL,
  `Amount` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Info` varchar(1000) NOT NULL,
  `Image` blob NOT NULL,
  `Image_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `PetType`, `Service`, `Type`, `Amount`, `Rating`, `Info`, `Image`, `Image_type`) VALUES
(1, 'Dog', 'Veterinary', 'General Consultation', 49, 4, 'If your pet is suffering from major conditions you might consider upgrading to the other packages we have to offer. Skin problems, Ear diseases, Urinary tract infections, Vomiting, Diarrhea, Parasites, Dental issues, Obesity, Arthritis, Poisoning, etc.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f372e6a706567, ''),
(2, 'Dog', 'Veterinary', 'Dog Vaccination Pack', 2999, 5, 'This package provides essential vaccinations, such as DHPPIL Booster, Corona Booster, and Anti-Rabies Booster, safeguarding your dog against common diseases, administered by licensed veterinarians.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f31312e6a706567, ''),
(4, 'Dog', 'Veterinary', 'Anti Tick Treatment', 1499, 4, 'Keep your dog healthy and comfortable by using vet-approved anti-tick treatment, which eliminates and prevents tick infestations, protecting against diseases with regular use.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32382e6a706567, ''),
(5, 'Dog', 'Veterinary', 'Corona virus Vaccination', 1298, 5, 'The dog coronavirus vaccine, given by vets, helps prevent a specific virus, reducing symptoms and transmission; making regular vaccinations important for your dog\'s health.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32342e6a706567, ''),
(6, 'Dog', 'Veterinary', 'Home Visit Consultation', 999, 5, 'Veterinary home visits bring personalized care to your dog at home. A licensed vet checks your pet, gives advice, and addresses concerns, making healthcare convenient and stress-free, especially for older or anxious dogs.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f392e6a706567, ''),
(7, 'Dog', 'Training', 'Obedience Store', 499, 5, 'The dog obedience program is a structured training led by pros, focusing on commands, leash manners, and social skills. Using positive reinforcement, it aims to build good behavior and enhance the bond between owner and dog for well-behaved companions.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f332e6a706567, ''),
(9, 'Dog', 'Training', 'Guarding & IPO Protection Program', 999, 4, 'The Guarding and IPO Protection Training program teaches dogs to excel in obedience, tracking, and protection tasks, preparing them for security or law enforcement roles through specialized, disciplined training.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f382e6a706567, ''),
(10, 'Dog', 'Training', 'Aggression & Behaviour Modification', 999, 4, 'The Aggression and Behavior Modification training helps dogs overcome aggression issues through positive reinforcement, guided by skilled trainers for a more positive and well-behaved pet.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f31372e6a706567, ''),
(12, 'Dog', 'Grooming', 'Wash-n-Dash', 899, 5, 'Wash-n-Dash is a fast grooming service for dogs, ensuring a quick and clean bath for a fresh-smelling pup. Perfect for busy pet owners.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f392e6a706567, ''),
(15, 'Dog', 'Walking', 'Demo Walk', 0, 5, 'Demo Walk', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f31302e6a706567, ''),
(16, 'Dog', 'Walking', '1 Time Walk', 999, 5, '1 Time Walk', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f31382e6a706567, ''),
(17, 'Dog', 'Walking', '2 Time Walk', 1999, 4, '2 Time Walk', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f31372e6a706567, ''),
(18, 'Cat', 'Veterinary', 'General Consultation', 49, 4, 'If your pet is suffering from major conditions you might consider upgrading to the other packages we have to offer. Skin problems, Ear diseases, Urinary tract infections, Vomiting, Diarrhea, Parasites, Dental issues, Obesity, Arthritis, Poisoning, etc.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32322e6a706567, ''),
(19, 'Cat', 'Veterinary', 'Cat Vaccination Pack', 2999, 5, 'This package provides essential vaccinations, such as DHPPIL Booster, Corona Booster, and Anti-Rabies Booster, safeguarding your dog against common diseases, administered by licensed veterinarians.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32352e6a706567, ''),
(21, 'Cat', 'Veterinary', 'Anti Tick Treatment', 1499, 4, 'Keep your dog healthy and comfortable by using vet-approved anti-tick treatment, which eliminates and prevents tick infestations, protecting against diseases with regular use.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32382e6a706567, ''),
(22, 'Cat', 'Veterinary', 'Corona virus Vaccination', 1298, 5, 'The dog coronavirus vaccine, given by vets, helps prevent a specific virus, reducing symptoms and transmission; making regular vaccinations important for your dog\'s health.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32342e6a706567, ''),
(23, 'Cat', 'Veterinary', 'Home Visit Consultation', 999, 5, 'Veterinary home visits bring personalized care to your cat at home. A licensed vet checks your pet, gives advice, and addresses concerns, making healthcare convenient and stress-free, especially for older or anxious cats.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f372e6a706567, ''),
(26, 'Cat', 'Training', 'Guarding & IPO Protection Program', 999, 4, 'The Guarding and IPO Protection Training program teaches dogs to excel in obedience, tracking, and protection tasks, preparing them for security or law enforcement roles through specialized, disciplined training', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f382e6a706567, ''),
(27, 'Cat', 'Training', 'Aggression & Behaviour Modification', 999, 4, 'The Aggression and Behavior Modification training helps dogs overcome aggression issues through positive reinforcement, guided by skilled trainers for a more positive and well-behaved pet.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32352e6a706567, ''),
(28, 'Cat', 'Training', 'ADVANCE Obedience Program', 999, 5, 'The Advanced Obedience Program refines a cat\'s training with advanced commands and off-leash skills, led by experienced trainers for a disciplined and responsive companion.', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32332e6a706567, ''),
(29, 'Cat', 'Grooming', 'Wash-n-Dash', 899, 5, 'Wash-n-Dash is a fast grooming service for cats, ensuring a quick and clean bath for a fresh-smelling pup. Perfect for busy pet owners', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32322e6a706567, ''),
(33, 'Cat', 'Walking', '1 Time Walk', 999, 5, '1 Time Walk', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32302e6a706567, ''),
(34, 'Cat', 'Walking', '2 Time Walk', 1999, 4, '2 Time Walk', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32322e6a706567, ''),
(35, 'Cat', 'Walking', 'Demo', 0, 0, '', 0x687474703a2f2f3137322e31372e35312e34322f706574696f732f696d616765732f32312e6a706567, ''),
(41, '', '', '', 0, 0, '', '', ''),
(42, '', '', '', 0, 0, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PetID` (`PetID`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`PetID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `PetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer_details` (`UserID`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`PetID`) REFERENCES `pets` (`PetID`);

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer_details` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
