-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 02:37 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_academicyear`
--

CREATE TABLE `tbl_academicyear` (
  `AcademicYearID` int(11) NOT NULL,
  `AcademicYear` varchar(7) NOT NULL,
  `AcademicYearCreatedAt` date NOT NULL,
  `AcademicYearEndAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_academicyear`
--

INSERT INTO `tbl_academicyear` (`AcademicYearID`, `AcademicYear`, `AcademicYearCreatedAt`, `AcademicYearEndAt`) VALUES
(1, '2019-20', '2021-10-21', NULL),
(36, '2021-22', '2021-10-20', NULL),
(66, '2021-24', '2021-11-22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `AdminID` int(11) NOT NULL,
  `AdminFname` varchar(30) NOT NULL,
  `AdminMname` varchar(30) NOT NULL,
  `AdminLname` varchar(30) NOT NULL,
  `AdminPhoto` varchar(256) DEFAULT NULL,
  `AdminGender` char(1) NOT NULL,
  `AdminDOB` date NOT NULL,
  `AdminlLocalAddress` varchar(255) DEFAULT NULL,
  `AdminPermenantAddress` varchar(255) NOT NULL,
  `AdminCast` varchar(10) NOT NULL,
  `AdminSubCast` varchar(10) NOT NULL,
  `AdminBloodGroup` varchar(3) DEFAULT NULL,
  `AdminEmail` varchar(320) NOT NULL,
  `AdminContactNo` bigint(10) NOT NULL,
  `AdminCity` varchar(255) NOT NULL,
  `AdminState` varchar(255) NOT NULL,
  `AdminMaritalStatus` int(1) NOT NULL,
  `AdminSpouse` varchar(70) DEFAULT NULL,
  `AdminDisablity` varchar(255) DEFAULT NULL,
  `AdminAadharcardNo` bigint(12) NOT NULL,
  `AdminHighestQulification` varchar(70) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`AdminID`, `AdminFname`, `AdminMname`, `AdminLname`, `AdminPhoto`, `AdminGender`, `AdminDOB`, `AdminlLocalAddress`, `AdminPermenantAddress`, `AdminCast`, `AdminSubCast`, `AdminBloodGroup`, `AdminEmail`, `AdminContactNo`, `AdminCity`, `AdminState`, `AdminMaritalStatus`, `AdminSpouse`, `AdminDisablity`, `AdminAadharcardNo`, `AdminHighestQulification`, `UserID`) VALUES
(2, 'Urvish', 'Vipulbhai', 'Sojitra', 'uplode/admin.png', 'M', '2002-05-13', 'GUJRAT SURAT BARDOLI', 'c-300 valkeshwer residency motavarachha,surat-394101', 'patel', 'hindu leva', 'O+', '19bmiit036@gmail.com', 7698583771, 'Surat', 'Gujrat', 1, 'fiyancy', NULL, 123456781278, 'msc(it) pass', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `AttendanceID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `AttendanceMasterID` int(11) NOT NULL,
  `AttendanceStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendancemaster`
--

CREATE TABLE `tbl_attendancemaster` (
  `AttendanceMasterID` int(11) NOT NULL,
  `SemesterSubjectID` int(11) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  `AttendanceDate` date NOT NULL,
  `FromTime` time DEFAULT NULL,
  `ToTime` time DEFAULT NULL,
  `ClassScheduleID` int(11) NOT NULL,
  `Topic` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `CityID` int(11) NOT NULL,
  `CityName` varchar(255) NOT NULL,
  `StateID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`CityID`, `CityName`, `StateID`) VALUES
(1, 'surat', 1),
(2, 'Anjar', 1),
(3, 'Angul', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_classschedule`
--

CREATE TABLE `tbl_classschedule` (
  `ClassScheduleID` int(11) NOT NULL,
  `FacultyAllocationID` int(11) NOT NULL,
  `ClassScheduleDay` varchar(3) NOT NULL,
  `LectureFromTime` time NOT NULL,
  `LectureToTime` time NOT NULL,
  `ClassScheduleStartedDate` date NOT NULL,
  `ClassScheduleEndedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counselorallocation`
--

CREATE TABLE `tbl_counselorallocation` (
  `CounselorAllocationID` int(11) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `AllocatedDate` date NOT NULL,
  `DeallocatedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(20) NOT NULL,
  `CourseDescription` varchar(50) NOT NULL,
  `CourseCreatedAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`CourseID`, `CourseName`, `CourseDescription`, `CourseCreatedAt`) VALUES
(1, 'MSc(IT)', '2 Year Cource', '2021-10-10'),
(2, 'Bsc(IT)', '3 Year Cource', '2021-10-10'),
(11, 'B.com', 'hrelle', '2021-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_semester`
--

CREATE TABLE `tbl_course_semester` (
  `CourseSemesterID` int(11) NOT NULL,
  `AcademicYearID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SemesterDivitionID` int(11) NOT NULL,
  `SemesterCreatedDate` date NOT NULL,
  `SemesterEndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_course_semester`
--

INSERT INTO `tbl_course_semester` (`CourseSemesterID`, `AcademicYearID`, `CourseID`, `SemesterDivitionID`, `SemesterCreatedDate`, `SemesterEndDate`) VALUES
(1, 1, 2, 2, '2021-10-10', NULL),
(4, 36, 2, 2, '2021-10-13', NULL),
(5, 66, 1, 2, '2021-11-11', NULL),
(6, 1, 11, 2, '2021-11-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `FacultyID` int(11) NOT NULL,
  `FacultyFname` varchar(30) NOT NULL,
  `FacultyMname` varchar(30) NOT NULL,
  `FacultyLname` varchar(30) NOT NULL,
  `FacultyPhoto` varchar(256) DEFAULT NULL,
  `FacultyGender` char(1) NOT NULL,
  `FacultyDOB` date NOT NULL,
  `FacultylLocalAddress` varchar(255) DEFAULT NULL,
  `FacultyPermenantAddress` varchar(255) NOT NULL,
  `FacultyCast` varchar(15) NOT NULL,
  `FacultySubCast` varchar(20) NOT NULL,
  `FacultyBloodGroup` varchar(3) DEFAULT NULL,
  `FacultyEmail` varchar(320) NOT NULL,
  `FacultyContactNo` bigint(10) NOT NULL,
  `FacultyStateCityID` int(11) DEFAULT NULL,
  `FacultyMaritalStatus` int(1) NOT NULL,
  `FacultySpouse` varchar(70) DEFAULT NULL,
  `FacultyDisablity` varchar(255) DEFAULT NULL,
  `FacultyAadharcardNo` bigint(12) NOT NULL,
  `FacultyHighestQulification` varchar(70) NOT NULL,
  `AcademicYearID` int(11) NOT NULL,
  `FacultyCourseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`FacultyID`, `FacultyFname`, `FacultyMname`, `FacultyLname`, `FacultyPhoto`, `FacultyGender`, `FacultyDOB`, `FacultylLocalAddress`, `FacultyPermenantAddress`, `FacultyCast`, `FacultySubCast`, `FacultyBloodGroup`, `FacultyEmail`, `FacultyContactNo`, `FacultyStateCityID`, `FacultyMaritalStatus`, `FacultySpouse`, `FacultyDisablity`, `FacultyAadharcardNo`, `FacultyHighestQulification`, `AcademicYearID`, `FacultyCourseID`, `UserID`) VALUES
(25, 'vipul', 'Vipulbhai', 'Sojitra', 'uplode/', 'M', '2021-11-05', 'c-303 royal recidency motavarachha,surat-394101', '', 'asdasd', 'asdasda', 'A+', 'sojitraurvish0@gmail.com', 9089786778, 1, 0, '', 'no', 567876545643, 'Mscit', 36, 1, 37),
(26, 'Urvish', 'virsing', 'Sojitra', 'uplode/WhatsApp Image 2021-10-12 at 11.50.35 AM.jpeg', 'M', '2021-11-11', '3-502 cg recendancy bardoli-456890', 'sadaas', 'asdasd', 'asdasda', 'A+', 'jayrakholia17@gmail.com', 8978678979, 1, 0, '', 'no', 567876242323, 'Mscit', 1, 2, 38);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty_subject_allocation`
--

CREATE TABLE `tbl_faculty_subject_allocation` (
  `FacultyAllocationId` int(11) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  `SemesterSubjectID` int(11) NOT NULL,
  `SemesterCreatedDate` date NOT NULL,
  `SemesterEndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_faculty_subject_allocation`
--

INSERT INTO `tbl_faculty_subject_allocation` (`FacultyAllocationId`, `FacultyID`, `SemesterSubjectID`, `SemesterCreatedDate`, `SemesterEndDate`) VALUES
(1, 26, 2, '2021-11-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester_divition`
--

CREATE TABLE `tbl_semester_divition` (
  `SemesterDivitionID` int(11) NOT NULL,
  `SemesterName` int(2) NOT NULL,
  `DivitionName` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_semester_divition`
--

INSERT INTO `tbl_semester_divition` (`SemesterDivitionID`, `SemesterName`, `DivitionName`) VALUES
(2, 1, 'A'),
(7, 1, 'B'),
(13, 2, 'A'),
(14, 2, 'B'),
(15, 3, 'A'),
(16, 3, 'B'),
(17, 4, 'A'),
(18, 4, 'B'),
(19, 5, 'A'),
(20, 5, 'B'),
(21, 6, 'A'),
(22, 6, 'B'),
(23, 7, 'A'),
(24, 7, 'B'),
(25, 8, 'A'),
(26, 8, 'B'),
(27, 9, 'A'),
(28, 9, 'B'),
(29, 10, 'A'),
(30, 10, 'B'),
(31, 11, 'A'),
(32, 11, 'B'),
(33, 12, 'A'),
(34, 12, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semester_subject`
--

CREATE TABLE `tbl_semester_subject` (
  `SemesterSubjectID` int(11) NOT NULL,
  `CourseSemesterID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `SubjectCode` varchar(10) NOT NULL,
  `SubjectDescription` varchar(50) NOT NULL,
  `SubjectType` varchar(3) NOT NULL,
  `SubjectCreatedDate` date DEFAULT NULL,
  `SubjectEndDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_semester_subject`
--

INSERT INTO `tbl_semester_subject` (`SemesterSubjectID`, `CourseSemesterID`, `SubjectID`, `SubjectCode`, `SubjectDescription`, `SubjectType`, `SubjectCreatedDate`, `SubjectEndDate`) VALUES
(2, 1, 2, 'IT4002', 'xyz', 'Pr', '2021-11-23', NULL),
(4, 4, 2, 'IT4004', 'tyty', 'Pr', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `StateID` int(11) NOT NULL,
  `StateName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`StateID`, `StateName`) VALUES
(1, 'Gujrat'),
(2, 'Odisha');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `StudentID` int(11) NOT NULL,
  `StudentEnrollmentNo` bigint(15) NOT NULL,
  `StudentFname` varchar(30) NOT NULL,
  `StudentMname` varchar(30) NOT NULL,
  `StudentLname` varchar(30) NOT NULL,
  `StudentPhoto` varchar(256) DEFAULT NULL,
  `StudentGender` char(1) NOT NULL,
  `StudentDOB` date NOT NULL,
  `StudentLocalAddress` varchar(255) DEFAULT NULL,
  `StudentPermanentAddress` varchar(255) NOT NULL,
  `StudentFatherName` varchar(70) NOT NULL,
  `StudentFatherContactNo` bigint(10) NOT NULL,
  `StudentMotherName` varchar(70) NOT NULL,
  `StudentMotherContactNo` bigint(10) DEFAULT NULL,
  `StudentCast` varchar(10) NOT NULL,
  `StudentSubCast` varchar(10) NOT NULL,
  `StudentBloodGroup` varchar(3) DEFAULT NULL,
  `StudentEmail` varchar(320) NOT NULL,
  `StudentContactNo` bigint(10) DEFAULT NULL,
  `StudentStateCityID` int(11) DEFAULT NULL,
  `StudentAadharcardNo` bigint(12) NOT NULL,
  `StudentHighestQulification` varchar(70) NOT NULL,
  `EnrollYear` varchar(2) NOT NULL,
  `AcademicYearID` int(11) NOT NULL,
  `CourseSemesterID` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `SubjectID` int(11) NOT NULL,
  `SubjectName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`SubjectID`, `SubjectName`) VALUES
(2, 'english'),
(4, 'maths');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(320) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Usertype` char(1) NOT NULL,
  `UserStatus` int(1) NOT NULL,
  `UserCreatedAt` date NOT NULL,
  `UserDeletedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`UserID`, `Username`, `Password`, `Usertype`, `UserStatus`, `UserCreatedAt`, `UserDeletedAt`) VALUES
(1, 'Admin@gmail.com', '$2y$10$PCE79C9XegxIRBtlhH6nUu58G4.uw7VCBZGIP5sEb1EmCacQqf7Se', 'A', 1, '2021-10-03', NULL),
(37, 'sojitraurvish0@gmail.com', '$2y$10$lR4VohiQL/kxIe03/bTI.uj4.ky//Dktg3q22sbSKMBuyTUxhO9.G', 'F', 1, '2021-11-11', NULL),
(38, 'jayrakholia17@gmail.com', '$2y$10$DNk6W/07WFyJ6ZjuYSeI8uYVvwN8pZE.su1VNJjNV0njpMi8o1GEG', 'F', 1, '2021-11-10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_academicyear`
--
ALTER TABLE `tbl_academicyear`
  ADD PRIMARY KEY (`AcademicYearID`),
  ADD UNIQUE KEY `AcademicYear` (`AcademicYear`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `AdminEmail` (`AdminEmail`),
  ADD UNIQUE KEY `AdminContactNo` (`AdminContactNo`),
  ADD UNIQUE KEY `AdminAadharcardNo` (`AdminAadharcardNo`),
  ADD KEY `FK_User_Admin` (`UserID`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`AttendanceID`),
  ADD KEY `FK_AttendanceMaster_Attendance` (`AttendanceMasterID`),
  ADD KEY `FK_Student_Attendance` (`StudentID`);

--
-- Indexes for table `tbl_attendancemaster`
--
ALTER TABLE `tbl_attendancemaster`
  ADD PRIMARY KEY (`AttendanceMasterID`),
  ADD KEY `FK_SemesterSubject_AttendanceMaster` (`SemesterSubjectID`),
  ADD KEY `FK_Faculty_AttendanceMaster` (`FacultyID`),
  ADD KEY `FK_ClassSchedule_AttendanceMaster` (`ClassScheduleID`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`CityID`),
  ADD KEY `FK_STATE_CITY` (`StateID`);

--
-- Indexes for table `tbl_classschedule`
--
ALTER TABLE `tbl_classschedule`
  ADD PRIMARY KEY (`ClassScheduleID`),
  ADD KEY `FK_Faculty_ClassSchedule` (`FacultyAllocationID`);

--
-- Indexes for table `tbl_counselorallocation`
--
ALTER TABLE `tbl_counselorallocation`
  ADD PRIMARY KEY (`CounselorAllocationID`),
  ADD KEY `FK_Faculty_ConselorAllocation` (`FacultyID`),
  ADD KEY `FK_Student_ConselorAllocation` (`StudentID`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`CourseID`),
  ADD UNIQUE KEY `CourseName` (`CourseName`);

--
-- Indexes for table `tbl_course_semester`
--
ALTER TABLE `tbl_course_semester`
  ADD PRIMARY KEY (`CourseSemesterID`),
  ADD KEY `FK_YEAR_CS` (`AcademicYearID`),
  ADD KEY `Fk_COURSE_CS` (`CourseID`),
  ADD KEY `FK_SEMSTERDIVITION_CS` (`SemesterDivitionID`);

--
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`FacultyID`),
  ADD UNIQUE KEY `FacultyEmail` (`FacultyEmail`),
  ADD UNIQUE KEY `FacultyContactNo` (`FacultyContactNo`),
  ADD UNIQUE KEY `FacultyAadharcardNo` (`FacultyAadharcardNo`),
  ADD KEY `Fk_Year_Faculty` (`AcademicYearID`),
  ADD KEY `Fk_Course_Faculty` (`FacultyCourseID`),
  ADD KEY `Fk_User_Faculty` (`UserID`);

--
-- Indexes for table `tbl_faculty_subject_allocation`
--
ALTER TABLE `tbl_faculty_subject_allocation`
  ADD PRIMARY KEY (`FacultyAllocationId`),
  ADD KEY `FK_FACULTY_FACULTY_SUBJECT_ALLOCATION` (`FacultyID`),
  ADD KEY `FK_SEMESTER_SUBJECT_FACULTY_SUBJECT_ALLOCATION` (`SemesterSubjectID`);

--
-- Indexes for table `tbl_semester_divition`
--
ALTER TABLE `tbl_semester_divition`
  ADD PRIMARY KEY (`SemesterDivitionID`),
  ADD UNIQUE KEY `SemesterName` (`SemesterName`,`DivitionName`);

--
-- Indexes for table `tbl_semester_subject`
--
ALTER TABLE `tbl_semester_subject`
  ADD PRIMARY KEY (`SemesterSubjectID`),
  ADD UNIQUE KEY `CourceSemesterID` (`CourseSemesterID`,`SubjectID`,`SubjectCode`,`SubjectType`),
  ADD UNIQUE KEY `CourseSemesterID` (`CourseSemesterID`,`SubjectID`,`SubjectCode`,`SubjectType`),
  ADD KEY `FK_S_SS` (`SubjectID`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`StateID`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `StudentFatherContactNo` (`StudentFatherContactNo`),
  ADD UNIQUE KEY `StudentEmail` (`StudentEmail`),
  ADD UNIQUE KEY `FacultyAadharcardNo` (`StudentAadharcardNo`),
  ADD UNIQUE KEY `StudentMotherContactNo` (`StudentMotherContactNo`),
  ADD UNIQUE KEY `ContactNo` (`StudentContactNo`),
  ADD KEY `FK_Year_Student` (`AcademicYearID`),
  ADD KEY `Fk_User_Student` (`UserID`),
  ADD KEY `FK_STATE_CITY_STUDENT` (`StudentStateCityID`),
  ADD KEY `FK_CourceSemeater_Student` (`CourseSemesterID`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`SubjectID`),
  ADD UNIQUE KEY `SubjectName` (`SubjectName`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_academicyear`
--
ALTER TABLE `tbl_academicyear`
  MODIFY `AcademicYearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_attendancemaster`
--
ALTER TABLE `tbl_attendancemaster`
  MODIFY `AttendanceMasterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `CityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_classschedule`
--
ALTER TABLE `tbl_classschedule`
  MODIFY `ClassScheduleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_counselorallocation`
--
ALTER TABLE `tbl_counselorallocation`
  MODIFY `CounselorAllocationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_course_semester`
--
ALTER TABLE `tbl_course_semester`
  MODIFY `CourseSemesterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  MODIFY `FacultyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_faculty_subject_allocation`
--
ALTER TABLE `tbl_faculty_subject_allocation`
  MODIFY `FacultyAllocationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_semester_divition`
--
ALTER TABLE `tbl_semester_divition`
  MODIFY `SemesterDivitionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_semester_subject`
--
ALTER TABLE `tbl_semester_subject`
  MODIFY `SemesterSubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `StateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `FK_User_Admin` FOREIGN KEY (`UserID`) REFERENCES `tbl_user` (`UserID`);

--
-- Constraints for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD CONSTRAINT `FK_AttendanceMaster_Attendance` FOREIGN KEY (`AttendanceMasterID`) REFERENCES `tbl_attendancemaster` (`AttendanceMasterID`),
  ADD CONSTRAINT `FK_Student_Attendance` FOREIGN KEY (`StudentID`) REFERENCES `tbl_student` (`StudentID`);

--
-- Constraints for table `tbl_attendancemaster`
--
ALTER TABLE `tbl_attendancemaster`
  ADD CONSTRAINT `FK_ClassSchedule_AttendanceMaster` FOREIGN KEY (`ClassScheduleID`) REFERENCES `tbl_classschedule` (`ClassScheduleID`),
  ADD CONSTRAINT `FK_Faculty_AttendanceMaster` FOREIGN KEY (`FacultyID`) REFERENCES `tbl_faculty` (`FacultyID`),
  ADD CONSTRAINT `FK_SemesterSubject_AttendanceMaster` FOREIGN KEY (`SemesterSubjectID`) REFERENCES `tbl_semester_subject` (`SemesterSubjectID`);

--
-- Constraints for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD CONSTRAINT `FK_STATE_CITY` FOREIGN KEY (`StateID`) REFERENCES `tbl_state` (`StateID`);

--
-- Constraints for table `tbl_classschedule`
--
ALTER TABLE `tbl_classschedule`
  ADD CONSTRAINT `FK_Faculty_ClassSchedule` FOREIGN KEY (`FacultyAllocationID`) REFERENCES `tbl_faculty` (`FacultyID`);

--
-- Constraints for table `tbl_counselorallocation`
--
ALTER TABLE `tbl_counselorallocation`
  ADD CONSTRAINT `FK_Faculty_ConselorAllocation` FOREIGN KEY (`FacultyID`) REFERENCES `tbl_faculty` (`FacultyID`),
  ADD CONSTRAINT `FK_Student_ConselorAllocation` FOREIGN KEY (`StudentID`) REFERENCES `tbl_student` (`StudentID`);

--
-- Constraints for table `tbl_course_semester`
--
ALTER TABLE `tbl_course_semester`
  ADD CONSTRAINT `FK_SEMSTERDIVITION_CS` FOREIGN KEY (`SemesterDivitionID`) REFERENCES `tbl_semester_divition` (`SemesterDivitionID`),
  ADD CONSTRAINT `FK_YEAR_CS` FOREIGN KEY (`AcademicYearID`) REFERENCES `tbl_academicyear` (`AcademicYearID`),
  ADD CONSTRAINT `Fk_COURSE_CS` FOREIGN KEY (`CourseID`) REFERENCES `tbl_course` (`CourseID`);

--
-- Constraints for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD CONSTRAINT `Fk_Course_Faculty` FOREIGN KEY (`FacultyCourseID`) REFERENCES `tbl_course` (`CourseID`),
  ADD CONSTRAINT `Fk_User_Faculty` FOREIGN KEY (`UserID`) REFERENCES `tbl_user` (`UserID`),
  ADD CONSTRAINT `Fk_Year_Faculty` FOREIGN KEY (`AcademicYearID`) REFERENCES `tbl_academicyear` (`AcademicYearID`);

--
-- Constraints for table `tbl_faculty_subject_allocation`
--
ALTER TABLE `tbl_faculty_subject_allocation`
  ADD CONSTRAINT `FK_FACULTY_FACULTY_SUBJECT_ALLOCATION` FOREIGN KEY (`FacultyID`) REFERENCES `tbl_faculty` (`FacultyID`),
  ADD CONSTRAINT `FK_SEMESTER_SUBJECT_FACULTY_SUBJECT_ALLOCATION` FOREIGN KEY (`SemesterSubjectID`) REFERENCES `tbl_semester_subject` (`SemesterSubjectID`);

--
-- Constraints for table `tbl_semester_subject`
--
ALTER TABLE `tbl_semester_subject`
  ADD CONSTRAINT `FK_CS_SS` FOREIGN KEY (`CourseSemesterID`) REFERENCES `tbl_course_semester` (`CourseSemesterID`),
  ADD CONSTRAINT `FK_S_SS` FOREIGN KEY (`SubjectID`) REFERENCES `tbl_subject` (`SubjectID`);

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `FK_CourceSemeater_Student` FOREIGN KEY (`CourseSemesterID`) REFERENCES `tbl_course_semester` (`CourseSemesterID`),
  ADD CONSTRAINT `FK_STATE_CITY_STUDENT` FOREIGN KEY (`StudentStateCityID`) REFERENCES `tbl_city` (`CityID`),
  ADD CONSTRAINT `FK_Year_Student` FOREIGN KEY (`AcademicYearID`) REFERENCES `tbl_academicyear` (`AcademicYearID`),
  ADD CONSTRAINT `Fk_User_Student` FOREIGN KEY (`UserID`) REFERENCES `tbl_user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
