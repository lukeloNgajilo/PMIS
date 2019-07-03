-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2019 at 09:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `general_information`
--

CREATE TABLE `general_information` (
  `Proj_code` varchar(30) NOT NULL,
  `Proj_name` varchar(255) NOT NULL,
  `Procurement_code` varchar(30) NOT NULL,
  `Procurement_type` varchar(255) NOT NULL,
  `Funding` varchar(255) NOT NULL,
  `AppearsIn_BussPlan` varchar(3) NOT NULL,
  `DateOf_initiation` date NOT NULL,
  `CostAt_initiation` varchar(30) NOT NULL,
  `Proj_implementer` varchar(255) NOT NULL,
  `Proj_manager` varchar(255) NOT NULL,
  `Proj_coordinator` varchar(255) NOT NULL,
  `Purpose` text NOT NULL,
  `Scope` text NOT NULL,
  `DateOf_contract` date NOT NULL,
  `Planned_costing` varchar(30) NOT NULL,
  `Current_costing` varchar(30) NOT NULL,
  `Planned_completion` int(11) NOT NULL,
  `Impl_StartDate` date NOT NULL,
  `Impl_EndDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_information`
--

INSERT INTO `general_information` (`Proj_code`, `Proj_name`, `Procurement_code`, `Procurement_type`, `Funding`, `AppearsIn_BussPlan`, `DateOf_initiation`, `CostAt_initiation`, `Proj_implementer`, `Proj_manager`, `Proj_coordinator`, `Purpose`, `Scope`, `DateOf_contract`, `Planned_costing`, `Current_costing`, `Planned_completion`, `Impl_StartDate`, `Impl_EndDate`) VALUES
('C-P 001', 'Supply of IT spares', 'C-PC 001', 'Contract', 'Capex', 'YES', '0000-00-00', '$37,999', 'BuseTECH.Inc', 'Manager ICT', 'ANGELO P', '   This is a small trick which I want to share with you all where instead of printing an entire window we can print a section from the page.   ', '  This is a small trick which I want to share with you all where instead of printing an entire window we can print a section from the page.  ', '0000-00-00', '$37,733 VAT inclusive', '$37,733 VAT inclusive', 1, '2018-04-26', '2018-05-25'),
('C-P 002', 'Supply of IT spares ..........', 'C-PC 006', 'Contract', 'Capex', 'NO', '2018-03-16', '$37,9996', 'BuseTECH.Inc', 'Manager ICT', 'ANGELO THOMAS', '        iiioio        ', '        kiiii        ', '2018-03-24', '$37,733 VAT inclusive', '$37,733 VAT inclusive', 1, '2018-04-20', '2018-04-21'),
('C-P 0029', 'Building two Dispensaries', 'C-PC 009', 'Contract', 'Capex', 'YES', '0000-00-00', '$37,999', 'V-Constructors', 'Manager ICT', 'ANGELO THOMAS', '  mwsasneeekkeene  ', '  kekeejjeeenn  ', '2018-04-01', '$27,999 VAT inclusive', '$37,733 VAT inclusive', 1, '2018-05-25', '2018-06-13'),
('C-P 0034', 'Building two Dispensaries', 'C-PC 031', 'Contract', 'Capex', 'YES', '2018-04-12', 'Tsh3,337,999', 'V-Constructors', 'Manager V-Constructors', 'XMDM', '   DDDDDDDDDDCEEcxddddddddddddddddd   ', '   cdadddddddddddccca   ', '2018-04-19', '$27,999 VAT inclusive', '$27,999 VAT inclusive', 15, '2018-04-30', '2018-05-16'),
('C-P 006', 'Construction of a bridge', 'C-PC 011', 'Contract', 'Capex', 'YES', '2018-03-29', '$27,999', 'V-Constructors', 'Manager V-Constructors', 'AYOUB KONDO', '    Construction of a bridge along Kilo-River    ', '     kkkkkkkkkk ffff  ', '2018-03-31', '$27,999 VAT inclusive', '$27,999 VAT inclusive', 1, '2018-04-28', '2018-04-28'),
('C-P 007', 'Building two Dispensaries', 'C-PC 010', 'LPO', 'Support Programme', 'YES', '2018-04-11', 'Tsh3,337,999', 'X-Constructors', 'Manager X-Constructors', 'Ismail Abdul', 'Buildin two dispensaries in Kilivo village in Kondoa', 'Rescue young children and mothers', '2018-04-18', 'Tsh2,337,999', 'Tsh2,337,999', 38, '2018-05-24', '2018-05-24'),
('C-P 0097', 'Building two Dispensaries', 'C-PC 013', 'LPO', 'Support Programme', 'NO', '2018-04-10', '$27,999', 'BuseTECH.Inc', 'Manager V-Constructors', 'Chenko Dafz', 'xxxxxxxxxxxxxxxxxxxxxxxxxxaXAXWW', 'FFFFFFFFFVDFS', '2018-04-12', '$27,999 VAT inclusive', '$37,733 VAT inclusive', 44, '2018-04-25', '2018-04-25'),
('C-P 011', 'Building two Dispensaries', 'C-PC 016', 'LPO', 'Capex', 'NO', '2018-04-28', '$27,999', 'V-Constructors', 'Manager V-Constructors', 'Chenko Dafz', 'kkmnmomk', 'mklÃ¦', '2018-04-20', 'Tsh2,337,999', '$27,999 VAT inclusive', 45, '2018-06-06', '2018-06-06'),
('C-P 014', 'Building two Dispensaries', 'C-PC 011', 'LPO', 'Support Programme', 'YES', '2018-04-25', 'Tsh3,337,999', '', '', '', '', '', '0000-00-00', '', '', 1, '0000-00-00', '0000-00-00'),
('C-P 016', 'Supply of Desktop computers', 'C-PC 033', 'Contract', 'Support Programme', 'YES', '2018-04-10', '$7,997', 'BuseTECH.Inc', 'Manager ICT', 'Dr. AYOUB KONDO', 'To supply twenty (20) categories of items. The lis..', 'To provide network spares and tools for the CAA ne..', '2018-04-11', '$7,997', '$7,997', 5, '2018-04-20', '2018-04-20'),
('C-P 018', 'Construction of a hospital', 'C-PC 0063', 'LPO', 'Support Programme', 'NO', '2018-04-10', '$27,999', 'BuseTECH.Inc', 'Manager V-Constructors', 'Chenko Dafz', '', '', '2018-04-18', '$27,999 VAT inclusive', '$27,999 VAT inclusive', 60, '2018-04-10', '2018-04-10'),
('C-P 067', 'Building two Dispensaries', 'C-PC 019', 'LPO', 'Capex', 'NO', '0000-00-00', '$37,999', '', '', '', '', '', '0000-00-00', '', '', 1, '0000-00-00', '0000-00-00'),
('P-00-01', 'LAN Installation', 'PR-00-01', 'LPO', 'Support Programme', 'YES', '2019-06-14', '$2300', 'Angelo Thomas', 'Lukello Ngajiro', 'Ronald Chaula', 'Installation of LANS in all offices', 'Installation of LANS in all offices', '2019-06-07', '$2200', '$2200', 20, '2019-08-24', '2019-08-24'),
('P-00-02', 'WAN Installation', 'PR-00-02', 'LPO', 'Support Programme', 'YES', '2019-06-14', '$2400', 'Angelo Thomas', 'Lukello', 'Ronald', 'Connect WANS accross all offices', 'WAN implementaion', '2019-06-15', '$2223', '$2500', 14, '2019-06-21', '2019-06-21'),
('P-00-03', 'Trouble shooting all computers', 'PR-00-03', 'LPO', 'Support Programme', 'NO', '2019-06-28', '$230', 'Buse', 'Thomas', 'Ronald Chaula', 'Make sure all fault computers are repaired', 'Make sure all fault computers are repaired', '2019-07-11', '$216', '$217', 19, '2019-07-12', '2019-07-12'),
('P-00-04', 'Providing internet accross all corporate offices', 'PR-00-04', 'Contract', 'Capex', 'YES', '2019-04-12', '$2300', 'Angelo Thomas', 'Thomas', 'Ronald Chaula', 'Providing internet accross all corporate offices', 'Providing internet accross all corporate offices', '2019-05-31', '$2200', '$2500', 29, '2019-06-30', '2019-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `implementation_status`
--

CREATE TABLE `implementation_status` (
  `Proj_code` varchar(30) NOT NULL,
  `Impl_code` varchar(30) NOT NULL,
  `Impl_status` varchar(255) NOT NULL,
  `Proj_status` varchar(255) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `Action_required` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `implementation_status`
--

INSERT INTO `implementation_status` (`Proj_code`, `Impl_code`, `Impl_status`, `Proj_status`, `Remarks`, `Action_required`) VALUES
('C-P 001', 'IMP-03', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Stalled', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between '),
('C-P 002', 'IMP-01', 'The project is completed', 'Completed', 'Good work', 'No action required'),
('C-P 0029', 'IMP-04', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Running', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between '),
('C-P 0034', 'IMP-05', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Terminated', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between '),
('C-P 006', 'IMP-06', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Stalled', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between '),
('C-P 007', 'IMP-07', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Terminated', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between '),
('C-P 0097', 'IMP-07', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Terminated', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'No'),
('C-P 011', 'IMP-08', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Running', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between '),
('C-P 014', 'IMP-09', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Completed', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between '),
('C-P 016', 'IMP-10', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Stalled', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between '),
('P-00-01', 'IMP-02', 'The project is still running', 'Running', 'The project should be finished within the given time', 'No action required'),
('P-00-02', 'IMP-12', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Terminated', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ', 'Scientific Transfer of Technology is the transfer of findings and information between organizations for development and commercialization. It can be either horizontal (one operational environment and another like different countries) or vertical (between ');

-- --------------------------------------------------------

--
-- Table structure for table `profileimg`
--

CREATE TABLE `profileimg` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `name` varchar(20) NOT NULL,
  `size` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `content` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`name`, `size`, `type`, `content`) VALUES
('INTRODUCTION.docx', '17272', 'application/vnd.open', 'PK\0\0\0\0\0!\0ß¤ÒlZ'),
('INTRODUCTION.docx', '17272', 'application/vnd.open', 'PK\0\0\0\0\0!\0ß¤ÒlZ'),
('INTRODUCTION.docx', '17272', 'application/vnd.open', 'PK\0\0\0\0\0!\0ß¤ÒlZ'),
('INTRODUCTION.pdf', '344701', 'application/pdf', '%PDF-1.5\r\n%µµµµ\r\n1 0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(17) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `telephone_no` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(12) DEFAULT NULL,
  `userimg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `department`, `role`, `email_address`, `gender`, `telephone_no`, `username`, `password`, `userimg`) VALUES
('100-01-01', 'Angelo Thomas', 'ICT department', 'User', 'angelobusee@gmail.com', 'Male', 928772622, 'thomas', '81dc9bdb52d0', ''),
('100-01-02', 'Lukello Ngajiro', 'Sales Department', 'User', 'lukelo@gmail.com', 'Male', 928772929, 'lukello', '81dc9bdb52d0', ''),
('100-01-03', 'Lukello Ngajiro', 'Sales Department', 'User', 'lukelo@gmail.com', 'Male', 928772929, 'lukel9', '6886badb36b2', ''),
('100-01-04', 'Chaula Ronald', 'ict_dp', 'user', 'chaula@gmail.com', 'Male', 928772622, 'chaula', '123', ''),
('100-01-05', 'Rakim', 'sales_dp', 'admin', 'rakim@gmail.com', 'male', 727272, 'rakim', '123', ''),
('100-01-06', 'Lukello Ngajiro', 'Sales Department', 'User', 'angelobusee@gmail.com', 'Male', 928772622, 'bm', '123', ''),
('100-01-07', 'Lukello Ngajiro', 'Sales Department', 'User', 'lukelo@gmail.com', 'Male', 928772622, 'lk', '202cb962ac59', ''),
('100-01-08', 'Lukello Ngajiro', 'Sales Department', 'User', 'lukelo@gmail.com', 'Male', 928772929, 'lukel99', 'a0a080f42e6f', ''),
('12122222', 'ronald', 'ict_dp', 'admin', 'ronald.chaula@gmail.com', 'male', 2147483647, 'gentile', '123', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `general_information`
--
ALTER TABLE `general_information`
  ADD PRIMARY KEY (`Proj_code`);

--
-- Indexes for table `implementation_status`
--
ALTER TABLE `implementation_status`
  ADD PRIMARY KEY (`Proj_code`,`Impl_code`),
  ADD UNIQUE KEY `Proj_code` (`Proj_code`);

--
-- Indexes for table `profileimg`
--
ALTER TABLE `profileimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profileimg`
--
ALTER TABLE `profileimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `implementation_status`
--
ALTER TABLE `implementation_status`
  ADD CONSTRAINT `implementation_status_ibfk_1` FOREIGN KEY (`Proj_code`) REFERENCES `general_information` (`Proj_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
