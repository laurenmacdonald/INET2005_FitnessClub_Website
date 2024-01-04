-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 09:12 PM
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
-- Database: `fitnessclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(150) NOT NULL,
  `lastName` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `passwordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `email`, `phone`, `address`, `passwordHash`) VALUES
(1, 'John', 'Doe', 'john.doe@gmail.com', '145678123', '123 Main Street', '$2y$10$KOlftlbEZTO5.6oNUoNjr.5dLFeiHroSzQ2OHwQy5Y1ow51FO5Jna');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `classId` int(11) DEFAULT NULL,
  `trainerId` int(11) NOT NULL,
  `memberId` int(11) NOT NULL DEFAULT 0,
  `memberAttendance` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `date`, `startTime`, `endTime`, `classId`, `trainerId`, `memberId`, `memberAttendance`) VALUES
(1, '2023-12-01', '08:00:00', '09:30:00', 3, 2, 17, NULL),
(2, '2023-12-02', '10:15:00', '11:45:00', 6, 3, 0, NULL),
(3, '2023-12-03', '13:30:00', '15:00:00', 4, 1, 17, NULL),
(4, '2023-12-04', '09:00:00', '10:30:00', 2, 4, 0, NULL),
(5, '2023-12-05', '14:45:00', '16:15:00', 5, 2, 0, NULL),
(6, '2023-12-06', '11:30:00', '13:00:00', 7, 3, 0, NULL),
(7, '2023-12-07', '08:30:00', '10:00:00', 1, 1, 0, NULL),
(8, '2023-12-08', '12:15:00', '13:45:00', 3, 4, 0, NULL),
(9, '2023-12-09', '15:45:00', '17:15:00', 6, 2, 0, NULL),
(10, '2023-12-10', '10:00:00', '11:30:00', 4, 3, 0, NULL),
(11, '2023-12-11', '13:00:00', '14:30:00', 7, 1, 0, NULL),
(12, '2023-12-12', '08:45:00', '10:15:00', 2, 4, 0, NULL),
(13, '2023-12-13', '12:30:00', '14:00:00', 5, 2, 0, NULL),
(14, '2023-12-14', '09:15:00', '10:45:00', 6, 3, 0, NULL),
(15, '2023-12-15', '14:00:00', '15:30:00', 1, 1, 0, NULL),
(16, '2023-12-16', '11:45:00', '13:15:00', 3, 4, 0, NULL),
(17, '2023-12-17', '16:15:00', '17:45:00', 4, 2, 0, NULL),
(18, '2023-12-18', '10:30:00', '12:00:00', 7, 3, 0, NULL),
(19, '2023-12-19', '13:30:00', '15:00:00', 2, 1, 0, NULL),
(20, '2023-12-20', '08:15:00', '09:45:00', 5, 4, 0, NULL),
(21, '2023-12-21', '12:00:00', '13:30:00', 6, 2, 0, NULL),
(22, '2023-12-22', '09:45:00', '11:15:00', 1, 3, 0, NULL),
(23, '2023-12-23', '14:30:00', '16:00:00', 3, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classtemplate`
--

CREATE TABLE `classtemplate` (
  `id` int(11) NOT NULL,
  `className` varchar(150) NOT NULL,
  `classDescription` text NOT NULL,
  `classImgPath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classtemplate`
--

INSERT INTO `classtemplate` (`id`, `className`, `classDescription`, `classImgPath`) VALUES
(1, 'Zumba', 'Zumba is a dynamic, dance-inspired workout that combines Latin rhythms with aerobic movements. It\'s a high-energy class where participants groove to lively music, incorporating elements of salsa, merengue, hip-hop, and more. Zumba is not just a workout; it\'s a joyful, party-like atmosphere that gets everyone moving and sweating while having fun.', 'zumbaImg'),
(2, 'Spin', 'Spin, also known as indoor cycling, is a high-intensity cardio workout performed on stationary bikes. Led by an instructor, participants pedal through varying intensities, simulating sprints, hill climbs, and endurance rides. The focus on music, resistance, and speed creates a challenging and exhilarating full-body workout.', 'spinImg'),
(3, 'Bootcamp', 'Bootcamp classes are intense, military-style workouts that combine strength training, cardiovascular exercises, and agility drills. These sessions often use bodyweight exercises, plyometrics, and interval training to improve overall fitness, strength, and endurance. Bootcamp workouts are designed to push participants to their limits and foster a sense of camaraderie among participants.', 'bootImg'),
(4, 'CrossFit', 'CrossFit is a high-intensity fitness program that incorporates elements of weightlifting, gymnastics, and cardiovascular exercises. It focuses on functional movements performed at high intensity, often in a competitive or group setting. CrossFit workouts are varied and aim to improve strength, flexibility, and overall fitness through constantly varied movements and challenges.', 'crossImg'),
(5, 'Pilates', 'Pilates is a low-impact exercise method that emphasizes core strength, flexibility, and muscular endurance. It involves precise movements and controlled breathing patterns to improve posture, balance, and overall body awareness. Pilates exercises often target specific muscle groups while promoting a mind-body connection.', 'pilatesImg'),
(6, 'Yoga', 'Yoga is a centuries-old practice that combines physical postures (asanas), breathing techniques (pranayama), and meditation. It aims to improve flexibility, strength, and relaxation. Yoga classes can vary widely, from gentle and restorative to more vigorous and dynamic styles.', 'yogaImg'),
(7, 'HIIT', 'HIIT involves short bursts of intense exercises alternated with brief periods of rest or lower-intensity activity. It\'s designed to maximize calorie burn, improve cardiovascular fitness, and boost metabolism in a shorter amount of time. HIIT workouts can include a wide range of exercises, such as jumping jacks, burpees, sprints, and strength-based movements.', 'hiitImg');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `firstName` varchar(150) NOT NULL,
  `lastName` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `passwordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `firstName`, `lastName`, `email`, `phone`, `address`, `passwordHash`) VALUES
(1, 'William', 'Taylor', 'william@example.com', '45678912', '456 Elm Ave', '$2y$10$9Hb8eS7F/xp4BFTbsLLb.ub2/7TM3JxtgQwEOH4j9/5LWCakHvMe6'),
(2, 'Olivia', 'Brown', 'olivia@example.com', '45678912', '789 Oak Ave', '$2y$10$L5tYwNPuCINqAMGXhDIUyO/on0E3LzAIbmmFQ3oXxqifyabS0CASi'),
(3, 'James', 'Martinez', 'james@example.com', '123456789', '789 Spring Ave', '$2y$10$4V2hSb8owZlcWE9GZeo8p.rVB6BJCocpfKDgn6fMUe3ZAjWnme6de'),
(4, 'Charlotte', 'Carter', 'charlotte@example.com', '123456789', '784 Queens Ave', '$2y$10$iY9q/3hYrarEhMh8PNGkrOWg0dOfiKepfAZ9UzQKVwGIL6yDT4/X2'),
(5, 'Lucas', 'Barnes', 'lucas@example.com', '45678912', '745 King Ave', '$2y$10$E8eEc6b/3oXPWUttBd1O8eGdpnmeTjBeIySjC9GkXtLExvPEOvkPW'),
(6, 'Luna', 'Carter', 'luna@example.com', '45612378', '124 Carmen Road', '$2y$10$6VdsB97z.y8UGWikCNpJN.8zGeKsixF2/YaiG0q6Ta8Vb0BnyneIy'),
(7, 'Zoe', 'Cook', 'zoe@example.com', '45612378', '124 Carmen Road', '$2y$10$VUt6lGKq/hMSXpqWrPB2uOSyBnI4XpLnz0gdHzPPxBP9glpSSuRQS'),
(8, 'Avery', 'Martin', 'avery@example.com', '63524178', '2 Moore Street', '$2y$10$o9TojG7H6SEj3Py0Vzwq0.ppbSCY8pXeXYP0LPOxuaZw5zKrVBKq6'),
(9, 'Scarlett', 'Kim', 'scarlett@example.com', '1112223334', '3 London Street', '$2y$10$/wgXDTE05U8MnErUiHW9QeXb8p9ec/lf6Gff5MgCDQY0yQwG27v5m'),
(10, 'Aria', 'Sullivan', 'aria@example.com', '44551122', '14 Richmond Road', '$2y$10$R1FrNs35UY3f0UjT5KrnNORVHIykkT1nu.2pI.3jmWWcNjxwtWnpO'),
(11, 'Amelia', 'Begso', 'amelia@example.com', '12345653', '123 Main Ave', '$2y$10$REn.RA/SpTvJSweo2NfVZuhi7dMLbwbCI1R.Hskxq6N1ydvScv.wm'),
(12, 'Henry', 'Kim', 'henry@example.com', '123456789', '123 Lunenburg Street', '$2y$10$gRl7cHOeJrJ.74wXExUw2udXpYwtEXm4vN9Rw7aGKGzaosvdqNFWS'),
(13, 'Layla', 'Stewart', 'layla@example.com', '4561237', '123 Mahone Street', '$2y$10$n3Fknv7ZIL4zxiyqz26XgeVG2C.o9rvqLl2MOqaU/j4KGa84UPItG'),
(14, 'Mila', 'Nguyen', 'mila@example.com', '4561237', '123 Mahone Street', '$2y$10$aBaoGUUGutSAufWanL3MyuL1e5MBqDo9bsI1flrdh22BapyyVejCK'),
(15, 'Benjamin', 'Lee', 'ben@example.com', '4561237', '123 Mahone Street', '$2y$10$/vThk4CmE/P5u8ld7mV7quj7U3eh9dJNt78P8H8x9dvZHwkiuwf/W'),
(16, 'Alexander', 'Anderson', 'alex@example.com', '4561237', '123 Mahone Street', '$2y$10$RZd/BfriBB840xuIbnhiIuYeUwNrDsv5BJnWs7dadRQ/uR8Tb8z8i'),
(17, 'Bela', 'Lugosi', 'bela@example.com', '1234560', '123 University Ave', '$2y$10$0WCLUvImuh15/EEfu04yxuiRJe69uBTow4WUsXU.Cv6iYFFCSOW0u'),
(18, 'New', 'Person', 'new@example.com', '12341523', '123 Main Street', '$2y$10$5OQ1qAITnpUyy/53B5D4hOBTEaoiKEDhF0W/u/Q5BDd/Xtv01Taoy'),
(19, 'Naomi', 'Steinbeck', 'naomi@example.com', '12315675', '789 South Park St', '$2y$10$NeNROojOGab8IcqrWxnAsOpJVSaDY/Dv7FuWB350SZiCArMWwegqW'),
(20, 'Scotty', 'Steinbeck', 'scottie@example.com', '123489762', '789 South Street', '$2y$10$q2YqnG1..7PbXI7wjO/55.MCdJFwhDxR4mHl.H8NuIQ0.BWAnM0Dq'),
(21, 'Johnny', 'Cool', 'johnny@example.com', '4521785', '435 University Ave', '$2y$10$pTindD61mQ8fdC1CEXnI5uws3sqjSPisMNIqaCG71I74uo88CSxMW'),
(22, 'Jon', 'Duckett', 'jon@example.com', '45612378', '987 Morris Street', '$2y$10$LftxVkQAx6OHfaOEXsilFOW3ck4xkZjF8PL6lUUmMrphL7d8Go7oe'),
(23, 'ghesrlkh', 'glrkeh', 'jim2@example.com', '5465983', 'dehilsder', '$2y$10$4zfGJW3i72JDts.IOBycUuG6hgHjv8ubYPohQep4HVr1gN7GRV/cW'),
(24, 'John', 'Doe', 'john.doe@example.com', '1234505', '435 University Ave', '$2y$10$W5gyI0AzvYjYxOmAtYlLHOcqQrj5VVs7rbQReHUp1/WxiAdjbSIFq');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `id` int(11) NOT NULL,
  `firstName` varchar(150) NOT NULL,
  `lastName` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `passwordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`id`, `firstName`, `lastName`, `email`, `phone`, `address`, `description`, `imgPath`, `passwordHash`) VALUES
(1, 'Alice', 'Smyth', 'alice@example.com', '21345670', '123 Main St', 'Alice is a calming presence in the fitness realm, emphasizing mindfulness and balance in her teaching. With a background in yoga and meditation, she weaves elements of Yoga and HIIT into her classes, fostering strength and inner peace. Her focus on breathwork and alignment creates an atmosphere where participants can find harmony between body and mind.', 'aliceImg', '$2y$10$Nb8ZHU1e9qV.M0S89KXd5e4cXQkCMIkmSpJ7/KjAatNpRssLV2RDe'),
(2, 'Michael', 'Johnson', 'michael@example.com', '4561237', '123 University Ave', 'Mike is the epitome of determination and resilience. As a former athlete turned fitness trainer, he brings a no-nonsense approach to his classes. His Spin and CrossFit sessions are intense and challenging, designed to push participants beyond their limits. Mike\'s dedication to achieving peak performance inspires everyone to embrace the grind and strive for their personal best.', 'mikeImg', '$2y$10$lOODdEqx8e8xivhsRqiy1.0sbuLXlpUbzsZsCmjjO8mgGKZFirphK'),
(3, 'Emily', 'Davis', 'emily@example.com', '123456789', '123 Jones St', 'Emily is a vibrant force in the fitness world, known for her infectious energy and passion for holistic wellness. With a background in dance and fitness instruction, she seamlessly blends Zumba and Pilates into dynamic, rhythm-infused workouts. Her classes are a celebration of movement and joy, always leaving participants feeling uplifted and rejuvenated.', 'emilyImg', '$2y$10$MNYWceos33GohBNxWa.d6Oa3sixqe5a1EsmHGH5J1oGfZbyHe6u5m'),
(4, 'Sophia', 'Wilson', 'sophia@example.com', '45678912', '123 Queen St', 'Sophia is a powerhouse of motivation, renowned for her empowering coaching style. A fitness enthusiast with a knack for pushing boundaries, she leads high-energy Bootcamp and intense CrossFit sessions. Her dynamic approach to fitness challenges participants to break barriers and discover their untapped potential.', 'sophiaImg', '$2y$10$lq8dJOdXhlC.b/BWpBp7Q.b.BqV6TU2fwt4wiY16zqr.dLEWA4NAa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classtemplate`
--
ALTER TABLE `classtemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `classtemplate`
--
ALTER TABLE `classtemplate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
