-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2017 at 03:54 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newcgdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_cnfm`
--

CREATE TABLE `acc_cnfm` (
  `id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `rqst_date` datetime DEFAULT NULL,
  `registered` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_cnfm`
--

INSERT INTO `acc_cnfm` (`id`, `token`, `code`, `email`, `pass`, `rqst_date`, `registered`) VALUES
(1, 'qwerty', 'as', 'as', 'as', NULL, NULL),
(2, 'qq', 'qq', 'qq', 'qq', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acc_level`
--

CREATE TABLE `acc_level` (
  `acc_level` int(10) UNSIGNED NOT NULL,
  `acc_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_level`
--

INSERT INTO `acc_level` (`acc_level`, `acc_name`) VALUES
(1, 'user'),
(2, 'clg_admin'),
(3, 'site_admin');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(10) UNSIGNED NOT NULL,
  `add_for` enum('users','clg') NOT NULL,
  `n_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `add_for`, `n_id`, `address`, `state`, `country`, `pin`) VALUES
(1, 'users', 1, 'This is the address for user 1', 'U.P', 'India', 274402),
(2, 'clg', 1, 'This is the address for college 1', 'Punjab', 'India', 144011);

-- --------------------------------------------------------

--
-- Table structure for table `branch_group`
--

CREATE TABLE `branch_group` (
  `b_id` int(10) UNSIGNED NOT NULL,
  `b_name` varchar(255) DEFAULT NULL,
  `clg_id` int(11) NOT NULL,
  `b_pic` varchar(255) DEFAULT NULL,
  `b_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_group`
--

INSERT INTO `branch_group` (`b_id`, `b_name`, `clg_id`, `b_pic`, `b_desc`) VALUES
(1, 'Chemical Engineering', 1, NULL, 'This is the che branch');

-- --------------------------------------------------------

--
-- Table structure for table `clg_fests`
--

CREATE TABLE `clg_fests` (
  `f_id` int(10) UNSIGNED NOT NULL,
  `clg_id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_desc` text NOT NULL,
  `f_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clg_fests`
--

INSERT INTO `clg_fests` (`f_id`, `clg_id`, `f_name`, `f_desc`, `f_pic`) VALUES
(1, 1, 'Techniti', 'This is the technical fest of nitj.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clg_info`
--

CREATE TABLE `clg_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `clg_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `u_id` int(10) UNSIGNED NOT NULL,
  `verified` enum('0','1') NOT NULL DEFAULT '0',
  `stream` enum('b.tech','m.tech','msc','mba','phd') NOT NULL DEFAULT 'b.tech',
  `b_id` int(10) UNSIGNED NOT NULL,
  `h_id` int(10) UNSIGNED NOT NULL,
  `type` enum('student','allumni','faculty') NOT NULL,
  `clg_joined` year(4) NOT NULL,
  `clg_left` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clg_info`
--

INSERT INTO `clg_info` (`id`, `clg_id`, `u_id`, `verified`, `stream`, `b_id`, `h_id`, `type`, `clg_joined`, `clg_left`) VALUES
(1, 1, 1, '0', 'b.tech', 1, 3, 'student', 2015, NULL),
(2, 1, 2, '0', 'b.tech', 1, 3, 'allumni', 2007, NULL),
(3, 1, 3, '0', 'b.tech', 1, 3, 'faculty', 2005, NULL),
(4, 1, 9, '0', 'b.tech', 1, 20, 'student', 2016, 2014),
(5, 1, 10, '0', 'b.tech', 1, 20, 'student', 2014, 2014),
(6, 1, 11, '0', 'b.tech', 1, 20, 'student', 2014, 2012);

-- --------------------------------------------------------

--
-- Table structure for table `clg_oprtr`
--

CREATE TABLE `clg_oprtr` (
  `id` int(11) NOT NULL,
  `clg_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `type` enum('branch','hostel','society','fest','other') DEFAULT NULL,
  `n_id` int(11) NOT NULL,
  `comments` text,
  `frm` year(4) NOT NULL,
  `upto` year(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clg_profile`
--

CREATE TABLE `clg_profile` (
  `clg_id` int(10) UNSIGNED NOT NULL,
  `clg_name` varchar(255) DEFAULT NULL,
  `clg_pic` varchar(255) DEFAULT NULL,
  `clg_add_id` int(10) UNSIGNED NOT NULL,
  `clg_mission` text,
  `clg_vision` text,
  `clg_about` text,
  `contact_info` text,
  `clg_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clg_profile`
--

INSERT INTO `clg_profile` (`clg_id`, `clg_name`, `clg_pic`, `clg_add_id`, `clg_mission`, `clg_vision`, `clg_about`, `contact_info`, `clg_email`) VALUES
(1, 'Dr B R Ambedkar National Institute of technology', NULL, 2, 'Mission goes here....', 'Vision goes here...', 'About the college goes here....', 'Contact info of college....', 'Email id of the college');

-- --------------------------------------------------------

--
-- Table structure for table `club_members`
--

CREATE TABLE `club_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `s_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `type` enum('member','admin','faculty') NOT NULL,
  `comments` text,
  `frm` year(4) NOT NULL,
  `upto` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_members`
--

INSERT INTO `club_members` (`id`, `s_id`, `u_id`, `type`, `comments`, `frm`, `upto`) VALUES
(1, 2, 1, 'member', 'I am a member.', 2015, NULL),
(2, 2, 3, 'faculty', 'Faculty of nitj', 2010, NULL),
(3, 2, 2, 'member', 'Allumni member of nitj', 2012, NULL),
(4, 5, 1, 'admin', 'sdaf', 2015, NULL),
(5, 5, 9, 'member', '', 2021, 0000);

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `clg_id` int(10) UNSIGNED NOT NULL,
  `clgusername` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`clg_id`, `clgusername`, `password`, `admin`) VALUES
(1, 'abc@nitj.ac.in', 'nitj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cm_id` int(10) UNSIGNED NOT NULL,
  `cm_for` enum('post','video','notes','item','event') NOT NULL,
  `p_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `cm_text` text NOT NULL,
  `cm_date` datetime NOT NULL,
  `cm_upd` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cm_id`, `cm_for`, `p_id`, `u_id`, `cm_text`, `cm_date`, `cm_upd`) VALUES
(1, 'post', 1, 1, 'This is first comment on 1 post', '2017-06-26 00:00:00', NULL),
(2, 'video', 1, 1, 'cmnt by usr 1 on vid 1', '2017-07-10 00:00:00', NULL),
(3, 'video', 1, 2, 'cmnt by user 2 on video 1', '2017-07-10 00:00:00', NULL),
(4, 'video', 2, 1, 'cmnt by usr 1 on vid 2', '2017-07-10 00:00:00', NULL),
(5, 'video', 1, 3, 'cmnt 3', '2017-07-11 00:00:00', NULL),
(6, 'post', 1, 1, 'Comment 1', '2017-07-15 23:39:07', NULL),
(7, 'event', 1, 1, 'hello', '2017-07-29 10:03:43', NULL),
(8, 'post', 11, 1, 'spep', '2017-08-05 13:21:59', NULL),
(9, 'post', 14, 1, 'dsfsfs', '2017-08-06 20:44:18', NULL),
(10, 'post', 14, 1, 'sfda', '2017-08-06 20:52:23', NULL),
(11, 'post', 14, 1, 'sfda', '2017-08-06 20:52:54', NULL),
(12, 'post', 3, 1, 'sdsds', '2017-08-06 20:55:30', NULL),
(13, 'post', 3, 1, 'sdsds', '2017-08-06 20:56:30', NULL),
(14, 'post', 3, 1, 'sadfascf', '2017-08-06 20:57:40', NULL),
(15, 'post', 3, 1, 'dsd', '2017-08-06 20:59:14', NULL),
(16, 'post', 14, 1, 'dewdw', '2017-08-06 20:59:24', NULL),
(17, 'post', 14, 1, 'wdw', '2017-08-06 20:59:28', NULL),
(18, 'video', 8, 1, 'dsadcasdsa', '2017-08-06 21:00:16', NULL),
(19, 'post', 11, 1, 'azza', '2017-08-06 21:01:56', NULL),
(20, 'event', 1, 1, 'sdfsdg', '2017-08-06 21:25:17', NULL),
(21, 'post', 9, 1, 'Sta', '2017-08-06 21:26:34', NULL),
(22, 'item', 9, 1, 'dsdsf', '2017-08-06 21:28:28', NULL),
(23, 'item', 9, 1, 'dghsdhg', '2017-08-06 21:28:32', NULL),
(24, 'item', 1, 1, 'dhfgdh', '2017-08-06 21:29:18', NULL),
(25, 'item', 1, 1, 'ocieties can', '2017-08-06 21:29:39', NULL),
(26, 'notes', 1, 1, 'dgdhd', '2017-08-06 21:30:05', NULL),
(27, 'notes', 1, 1, 'dfsgsd', '2017-08-06 21:30:08', NULL),
(28, 'notes', 1, 1, 'aaa', '2017-08-06 21:30:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `pf_id` int(10) UNSIGNED NOT NULL,
  `o_id` int(10) UNSIGNED NOT NULL,
  `d_frm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `pf_id`, `o_id`, `d_frm`) VALUES
(1, 1, 2, '2017-06-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ev_id` int(10) UNSIGNED NOT NULL,
  `ev_type` enum('society','fest') NOT NULL DEFAULT 'society',
  `n_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `ev_name` varchar(255) NOT NULL,
  `ev_desc` text,
  `ev_on` date NOT NULL,
  `ev_pic` varchar(255) DEFAULT NULL,
  `d_upl` datetime NOT NULL,
  `d_mod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ev_id`, `ev_type`, `n_id`, `u_id`, `ev_name`, `ev_desc`, `ev_on`, `ev_pic`, `d_upl`, `d_mod`) VALUES
(1, 'society', 2, 1, 'Event 1', 'This is the first event by c&s 1', '2017-07-26', NULL, '2017-06-26 00:00:00', NULL),
(2, 'society', 5, 1, 'ds', 'asda', '2017-07-17', '', '2017-07-17 20:57:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fest_organisers`
--

CREATE TABLE `fest_organisers` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `comments` text,
  `for_year` varchar(100) NOT NULL,
  `type` enum('member','admin','faculty') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fest_organisers`
--

INSERT INTO `fest_organisers` (`id`, `f_id`, `u_id`, `comments`, `for_year`, `type`) VALUES
(1, 4, 1, 'Fest organiser 1 of fest 1', '2015-2016', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `follow_rqsts`
--

CREATE TABLE `follow_rqsts` (
  `id` int(10) UNSIGNED NOT NULL,
  `snd_id` int(10) UNSIGNED NOT NULL,
  `rcv_id` int(10) UNSIGNED NOT NULL,
  `cur_sts` enum('0','1') NOT NULL,
  `d_snd` datetime NOT NULL,
  `d_acpt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow_rqsts`
--

INSERT INTO `follow_rqsts` (`id`, `snd_id`, `rcv_id`, `cur_sts`, `d_snd`, `d_acpt`) VALUES
(1, 1, 2, '1', '2017-06-26 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grp`
--

CREATE TABLE `grp` (
  `g_id` int(11) NOT NULL,
  `clg_id` int(11) NOT NULL,
  `g_type` enum('branch','society','hostel','fest') DEFAULT NULL,
  `g_name` varchar(100) NOT NULL,
  `g_pic` varchar(100) DEFAULT NULL,
  `g_desc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grp`
--

INSERT INTO `grp` (`g_id`, `clg_id`, `g_type`, `g_name`, `g_pic`, `g_desc`) VALUES
(1, 1, 'branch', 'Chemical engineering', NULL, NULL),
(2, 1, 'society', '1st society grp', NULL, NULL),
(3, 1, 'hostel', '1st hostel grp', NULL, NULL),
(4, 1, 'fest', '1st fest grp', 'IMAGES/group/66b70dbg-pic22.jpg', 'This is first grp'),
(5, 1, 'society', '2nd society', 'IMAGES/group/30578ebg-pic22.jpg', 'this is 2nd'),
(6, 1, 'branch', '2nd branch', NULL, '2nd branch'),
(7, 1, 'society', 'Basketball', 'images/group/basketball.jpg', 'THE OFFICIAL CLUB OF THE COLLEGE THAT MAKES ALL THE EVENTS OF BASKETBALL IN NIT JALANDHAR POSSIBLE AND PROVIDES ALL THE LATEST INFORMATION.\nBASKETBALL MAKES US GLOW IN DARKNESS OF THIS WORLD!'),
(8, 1, 'society', 'Bawre', 'images/group/bawre.jpg', 'winners of many stage play and street play competetions at various cultural fests .\nA group of Enthusiastic Theatre performers of NIT JALANDHAR.'),
(9, 1, 'society', 'Ecell', 'images/group/ecell.jpg', NULL),
(10, 1, 'society', 'LADS', 'images/group/lads.jpg', 'The L.A.D.S. Official Page by the students of N.I.T. Jalandhar\n\nThis page updates its readers with the activities of the LITERARY AND DEBATING SOCIETY of NIT Jalandhar. Also it keeps them abreast with the vocabulary by its \'WORD OF THE DAY\' and also provides good reading material by its \'ARTICLE OF THE WEEK\' which is posted every Monday.\n\nMission\nTo build up the intellect and interactive skills of the readers and also improve vocabulary.\n'),
(11, 1, 'society', 'Movie Club', 'images/group/movie.jpg', 'Known for its original and different events, Movie Club NITJ, founded in 2007 witnessed mass participation and huge following in the coming years. Through this page we would like to bring back the excitement, fun, cinema appreciation and much more.\nThe club organises various events, namely: Movie Freak, Imagineers, Adgineers, Distortia, Climax, Mimicry, Showcase, Cineaste, Wrong Song etc. during ScreeNIT, techNITi (Techno-Managerial fest of NIT Jalandhar) and Utkansh (Cultural fest of NIT Jalandhar) every year.\nSociety Heads-\nPawan Kumar Bashishth\nFinal year BT (+91-86998-05153)\n\nPrakhar Agnihotri\nFinal year Mining (+91-85911-40968)\n'),
(12, 1, 'society', 'Photography Club', 'images/group/photography.jpg', 'We are a group of Photography loving enthusiasts and this is a common platform for all photography lovers.\n\n" We are a group of Photography loving enthusiasts and this is a common platform for all photography lovers. Feel free to post photos, suggestions and latest advancements in the field of photography"\n'),
(13, 1, 'society', 'SARC', 'images/group/sarc.jpg', 'The Students Alumni Relation Cell is an initiative to establish a medium of interaction between the college and the alumini. It also makes an effort to connect students of the college, both present and past.\n\nMission\nThe mission of the program is two fold:\n*To furnish alumni with a platform to interact with the students on a one to one basis and connect them with the Institute.\n*To provide students with career and academic advice and prepare themselves for the graduation and to face the real world.\n\n\nVision\nThe Program emphasizes on:\n*Providing students a platform for one to one interaction with their esteemed alumni.\n*Rendering students with career guidance and tailoring them for their future endeavours.\n*Catering to the betterment of alumni-student relationships by engaging them in fruitful.'),
(14, 1, 'society', 'Volleyball', 'images/group/volleyball.jpg', 'group of volleyball enthusiasts of NIT jalandhar responsible for organising and promotion of volleyball tournaments and events in nitj.\nPlayers turn their sweat to winning streak.Players who practise hard,may fall but rise again and prosper'),
(15, 1, 'hostel', 'Hostel No 1', 'images/group/h1.jpg', NULL),
(16, 1, 'hostel', 'Hostel No 2', 'images/group/h2.jpg', NULL),
(17, 1, 'hostel', 'Hostel No 3', 'images/group/h3.jpg', NULL),
(18, 1, 'hostel', 'Hostel No 4', 'images/group/h4.jpg', NULL),
(19, 1, 'hostel', 'Hostel No 5', 'images/group/h5.jpg', NULL),
(20, 1, 'hostel', 'Hostel No 6', 'images/group/h6.jpg', NULL),
(21, 1, 'hostel', 'Hostel No 7', 'images/group/h7.jpg', NULL),
(22, 1, 'hostel', 'MBH-A ', 'images/group/mbha.jpg', NULL),
(23, 1, 'hostel', 'MBH-B', 'images/group/mbhb.jpg', NULL),
(24, 1, 'hostel', 'MBH-F', 'images/group/mbhf.jpg', NULL),
(25, 1, 'hostel', 'G Hostel No 1', 'images/group/gh1.jpg', NULL),
(26, 1, 'hostel', 'G Hostel No 2', 'images/group/gh2.jpg', NULL),
(27, 1, 'hostel', 'MGH', 'images/group/mgh.jpg', NULL),
(28, 1, 'fest', 'Techniti', 'images/group/techniti.jpg', NULL),
(29, 1, 'fest', 'Utkansh', 'images/group/utkansh.jpg', NULL),
(30, 1, 'fest', 'Bharat Dhwani', 'images/group/bharatdhwani.jpg', NULL),
(31, 1, 'society', 'Team Avishkar', 'images/group/avishkar.jpg', 'We are Team AVISHKAR having 25+ enthusiastic members who represent NIT-Jalandhar in National level competition BAJA SAE INDIA organized by Society of Automated Engineers.\n\nMission\nWe want to transform every good idea into reality, whether it\'s our\'s or your\'s\nSatyam\nAwards\nENDURO STUDENT INDIA 2017:\nWINNER of Championship\n1st in Lightest Vehicle Award\n1st in Cost Event\n1st in Maneuverability Event\n1st in Sprint Event\n2nd in Acceleration Event\n2nd in Design Event\n\nBAJA SAEINDIA 2016:\n1st in Build Quality\n1st in Hill Climb\n1st in Raftar Award\n4th in Acceleration.\n\nBAJA SAEINDIA 2015:\n10th in Acceleration\n16th Overall.\n\nBAJA SAEINDIA 2014:\n3rd in Acceleration.\n9th Overall.\n\nBAJA SAEINDIA 2013:\n86th overall.\n\nProducts\nAVR 113 - BAJA SAEINDIA 2013\nAVR 214 - BAJA SAEINDIA 2014\nAVR 315 - BAJA SAEINDIA 2015\nAVR 416 - BAJA SAEINDIA 2016\nAVR 517 - ENDURO STUDENT INDIA 2017, BAJA SAEINDIA 2017'),
(32, 1, 'society', 'Team Daksh', 'images/group/daksh.png', 'Team-Daksh consists of 35 young innovative minds, striving day and night to achieve excellence .We are one of the most promising teams of NIT-J .\n\nWe not only believe in setting challenges but in overcoming them. \n\nWe work under the esteemed leadership of our faculty advisor Dr. Anish Sachdeva, head of SAE NITJ .\n\n\n\nWe believe making impossible possible .......\n\nAccelerating Talent, speeding up innovation.\n\nProducts\nIn 2011, \nTeam competed for the first time in the Shell Eco-marathon, ASIA. The vehicle set the record of 300km/l. \n\n\nIn 2012,\nTeam came up with an electric car which delivered a mileage of 65km/kWh.\n\n\nIn 2013,\nTeam participated in SAENIS Efficycle and attended main event held at UIET Chandigarh.\n\n\nIn 2014 ,\nTeam represented India under the category of Diesel Prototype in Shell Eco Marathon Asia 2014 in Manila ,Philippines \n\nIn 2016,\nTeam bagged 2nd position in SAE UIET Effi- Cars, Chandigarh'),
(33, 1, 'society', 'Fine Arts Society', 'images/group/fas.jpg', 'Everyone of us has love for Art and Creativity - maybe inherent or extrinsic\n\nFine Arts Society- An inhouse NIT Jalandhar Society- aims to tickle the Artist within an engineer. With some marvelous events and excellent event management, Fine Arts Society has till now been successful in being the front runner as participating events during the College Festivals. \n\nFine Arts Society nurtures Art-i-Culture and aims at being the most creative society through its events and artistic ideas.\n\nWe look forward to participation from everyone.\nCome and Be a part of our motto- \n""Life is a great big canvas, and you should throw all the paint on it you can....:):)"\n\nWorld is a Beautiful Place to Live In - Lets Spread Smiles !!'),
(34, 1, 'society', 'Team Perianth', 'images/group/perianth.jpg', 'We simulate engineering design projects and their related challenges.\n\nour team works on various aspects of automotive engineering.\nmotto of this page is to SHARE AND GAIN..!!!\nFIRST ORCV:-\n\nhttps://www.facebook.com/photo.php?fbid=232784083421546&set=a.149481028418519.23419.149479375085351&type=1&theater\n\nFIRST GO KART:-\n\nhttps://www.facebook.com/photo.php?fbid=232787183421236&set=a.149481028418519.23419.149479375085351&type=1&theater\n\nloads of many others concept vehicles have been made...!!!\n\nTEAM MANAGERS:-\nNaveen garg ( 9478458288)\nAman jindal (9463372400)\nAmit (9530538669)\n\nTECHNICAL HEAD:-\n\nVarun katha (8054595985)\nYashpal (7837667608)\nAmandeep (8437949864)'),
(35, 1, 'society', 'Rajbhasha', 'images/group/rajbhasha.jpg', 'This page provide a forum to do something for your own National Language and love HINDI irrespective of state you belong or what\'s your local language. It never matter from where you come only matter how and what you do for HINDI. Join your hands with us and become a torch bearer to promote HINDI.'),
(36, 1, 'society', 'R-tist', 'images/group/rtist.jpg', 'R-tist (Robotics Club of NIT Jalandhar) is an active society that works solely in the field of robotics and wholeheartedly for promoting the spirit of growing technology.....\n'),
(37, 1, 'society', 'DroneEpic', NULL, NULL),
(38, 1, 'society', 'Nitovators', NULL, NULL),
(39, 1, 'society', 'TCA', NULL, NULL),
(40, 1, 'society', 'Bhangra', NULL, NULL),
(41, 1, 'society', 'Prayas', NULL, NULL),
(42, 1, 'society', 'Kalakar', NULL, NULL),
(43, 1, 'society', 'Football', NULL, NULL),
(44, 1, 'society', 'Cricket', NULL, NULL),
(45, 1, 'society', 'Table Tennis', NULL, NULL),
(46, 1, 'society', 'Badminton', NULL, NULL),
(47, 1, 'society', 'Chess', NULL, NULL),
(48, 1, 'society', 'Nitj Athletics', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hostel_grp`
--

CREATE TABLE `hostel_grp` (
  `h_id` int(10) UNSIGNED NOT NULL,
  `clg_id` int(10) UNSIGNED NOT NULL,
  `h_name` varchar(255) NOT NULL,
  `h_pic` varchar(255) DEFAULT NULL,
  `h_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_grp`
--

INSERT INTO `hostel_grp` (`h_id`, `clg_id`, `h_name`, `h_pic`, `h_desc`) VALUES
(1, 1, 'Hostel 1', NULL, 'This is hostel 1');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `l_id` int(10) UNSIGNED NOT NULL,
  `l_for` enum('post','video','notes','item','event') NOT NULL,
  `p_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `d_upl` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`l_id`, `l_for`, `p_id`, `u_id`, `d_upl`) VALUES
(2, 'video', 1, 1, '2017-07-10 00:00:00'),
(3, 'video', 1, 2, '2017-07-12 00:00:00'),
(4, 'video', 2, 1, '2017-07-10 00:00:00'),
(5, 'video', 2, 2, '2017-07-10 00:00:00'),
(6, 'video', 2, 3, NULL),
(8, 'video', 3, 1, '2017-07-31 16:46:44'),
(10, 'post', 1, 1, '2017-07-31 16:50:47'),
(13, 'notes', 2, 1, '2017-08-02 07:01:05'),
(16, 'event', 2, 1, '2017-08-02 18:40:15'),
(23, 'post', 13, 1, '2017-08-05 13:00:14'),
(24, 'post', 8, 1, '2017-08-06 19:12:53'),
(25, 'post', 14, 1, '2017-08-06 20:54:18'),
(26, 'post', 11, 1, '2017-08-06 21:01:52'),
(27, 'event', 1, 1, '2017-08-06 21:25:15'),
(28, 'post', 9, 1, '2017-08-06 21:26:27'),
(29, 'item', 9, 1, '2017-08-06 21:26:40'),
(30, 'item', 7, 1, '2017-08-06 21:29:02'),
(31, 'item', 1, 1, '2017-08-06 21:29:14'),
(32, 'post', 3, 1, '2017-08-09 14:49:38'),
(33, 'notes', 1, 1, '2017-08-28 02:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `id` int(10) UNSIGNED NOT NULL,
  `snd_id` int(10) UNSIGNED NOT NULL,
  `rcv_id` int(10) UNSIGNED NOT NULL,
  `type` enum('users','clg') NOT NULL,
  `text` text NOT NULL,
  `d_upl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`id`, `snd_id`, `rcv_id`, `type`, `text`, `d_upl`) VALUES
(1, 1, 2, 'users', 'This is msg by user 1 to usr 2', '2017-06-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `fr` enum('branch','all') DEFAULT NULL,
  `fr_year` varchar(255) DEFAULT NULL,
  `fr_branch` varchar(255) DEFAULT NULL,
  `n_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(60) NOT NULL,
  `files` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `n_desc` text,
  `d_upl` datetime NOT NULL,
  `d_mod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `u_id`, `fr`, `fr_year`, `fr_branch`, `n_id`, `title`, `files`, `pic`, `n_desc`, `d_upl`, `d_mod`) VALUES
(1, 1, 'branch', NULL, NULL, 1, 'Notes1', 'This is the file to be downloaded', '', 'thus is notes by user 1 for branch 1', '2017-06-26 00:00:00', NULL),
(2, 1, NULL, NULL, NULL, NULL, 'Notesqnsbc', '', 'IMAGES/notes/963f85bg-pic22.jpg', 'nsxsjbcsj', '2017-07-17 21:23:46', NULL),
(3, 1, NULL, NULL, NULL, NULL, 'dgsdg', '', 'IMAGES/notes/544b50bg.jpg', 'sdgfdsfhsdf', '2017-08-06 21:34:36', NULL),
(10, 1, NULL, '1st', 'bt', NULL, '1', '3da8c4764-7686552.pdf', NULL, 'wewdw', '2017-08-27 23:48:18', NULL),
(11, 1, NULL, '1st', 'che', NULL, 'weqe', '9282f6764-7686552.pdf', NULL, 'cxzvs', '2017-08-28 00:31:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `snd_id` int(10) UNSIGNED NOT NULL,
  `for` enum('branch','users') NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `d_upl` datetime NOT NULL,
  `d_mod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `snd_id`, `for`, `for_id`, `text`, `d_upl`, `d_mod`) VALUES
(1, 1, 'users', 1, 'This is notice by clg 1 to user 1', '2017-06-26 00:00:00', '2017-06-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pg_id` int(10) UNSIGNED NOT NULL,
  `clg_id` int(10) UNSIGNED NOT NULL,
  `pg_name` varchar(255) NOT NULL,
  `pg_type` enum('confession','other') NOT NULL,
  `pg_desc` text,
  `pg_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pg_id`, `clg_id`, `pg_name`, `pg_type`, `pg_desc`, `pg_pic`) VALUES
(1, 1, 'Confession', 'confession', 'This is the confession page of clg 1', NULL),
(2, 1, 'Memes', 'confession', 'This is the meme page.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `placements`
--

CREATE TABLE `placements` (
  `id` int(11) NOT NULL,
  `upl_by` int(11) NOT NULL,
  `placed_id` int(11) DEFAULT NULL,
  `placed_name` varchar(100) DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `comp_name` varchar(100) NOT NULL,
  `lpa` varchar(100) DEFAULT NULL,
  `d_upl` datetime NOT NULL,
  `d_edit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `p_id` int(10) UNSIGNED NOT NULL,
  `p_from` enum('grp','page') DEFAULT NULL,
  `n_id` int(10) UNSIGNED DEFAULT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `p_text` text,
  `p_pic` varchar(255) DEFAULT NULL,
  `d_upl` datetime NOT NULL,
  `d_mod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `p_from`, `n_id`, `u_id`, `p_text`, `p_pic`, `d_upl`, `d_mod`) VALUES
(1, 'grp', 1, 1, 'This is the post 1 of branch 1 by user 1', NULL, '2017-06-26 00:00:00', NULL),
(2, 'grp', 1, 1, 'This is post 2 of brnch 1 by user 1', NULL, '2017-06-27 00:00:00', NULL),
(3, 'grp', 2, 1, 'this is the post 3 of group 1 by user 1', NULL, '2017-06-27 00:00:00', NULL),
(4, 'grp', NULL, 1, '1 post from form by usr 1', '', '2017-07-15 23:24:58', NULL),
(5, 'grp', NULL, 1, '2 post from form by usr 1', '', '2017-07-15 23:26:42', NULL),
(6, 'grp', NULL, 1, '2 post from form by usr 1', '', '2017-07-15 23:30:43', NULL),
(7, 'grp', 1, 1, 'posting', '', '2017-07-15 23:34:54', NULL),
(8, 'grp', 1, 1, 'smbsbs', '', '2017-07-28 17:15:22', NULL),
(9, 'grp', 3, 1, 'Hello hostelers', '', '2017-07-29 09:55:12', NULL),
(10, 'grp', 4, 1, 'Hello everyone', '', '2017-07-29 09:58:20', NULL),
(11, 'grp', 5, 1, 'Hello members', '', '2017-07-29 10:00:27', NULL),
(12, 'page', 1, 1, 'hroug', '', '2017-08-05 12:59:54', NULL),
(13, 'grp', 5, 1, 'Through', '', '2017-08-05 13:00:11', NULL),
(14, 'page', 1, 1, 'ffgsd', '', '2017-08-06 20:41:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pr`
--

CREATE TABLE `pr` (
  `id` int(11) NOT NULL,
  `clg_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `for-year` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sharing`
--

CREATE TABLE `sharing` (
  `sh_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `fr` enum('sale','share') NOT NULL,
  `item_type` enum('book','other') NOT NULL,
  `name` varchar(255) NOT NULL,
  `s_desc` text,
  `pic` varchar(255) DEFAULT NULL,
  `d_upl` datetime NOT NULL,
  `d_mod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sharing`
--

INSERT INTO `sharing` (`sh_id`, `u_id`, `fr`, `item_type`, `name`, `s_desc`, `pic`, `d_upl`, `d_mod`) VALUES
(1, 1, 'share', 'book', 'Book 1', 'this is the book 1 to be shared', NULL, '2017-06-26 00:00:00', NULL),
(2, 1, 'sale', 'book', 'item 2', 'want to sell book', NULL, '2017-06-28 00:00:00', NULL),
(3, 1, 'sale', 'other', 'Item 3', 'selling other item', NULL, '2017-06-28 10:00:00', NULL),
(4, 1, 'share', 'other', 'item 4', 'sharing other item', NULL, '2017-06-28 03:00:00', NULL),
(5, 2, 'sale', 'book', 'Item 5', 'seliing book by allumni', NULL, '2017-06-28 16:00:00', NULL),
(6, 2, 'share', 'book', 'item 6', 'sharing book by allumni', NULL, '2017-06-28 20:00:00', NULL),
(7, 2, 'sale', 'other', 'item 7', 'selling other by allumni', NULL, '2017-06-29 00:00:00', NULL),
(8, 2, 'share', 'other', 'Item 8', 'sharing other by allumni', NULL, '2017-06-29 04:00:00', NULL),
(9, 1, 'sale', 'book', 'ac', 'casdca', '', '2017-07-17 21:34:50', NULL),
(10, 1, 'sale', 'book', 'dfas', 'safasdcgd', '', '2017-08-06 21:33:56', NULL),
(11, 1, 'share', 'book', 'adada', 'wdsad', '', '2017-08-06 21:34:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `society`
--

CREATE TABLE `society` (
  `s_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `clg_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_pic` varchar(255) DEFAULT NULL,
  `s_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `society`
--

INSERT INTO `society` (`s_id`, `clg_id`, `s_name`, `s_pic`, `s_desc`) VALUES
(0000000001, 1, 'Ecell', NULL, 'This is entreneurship cell a.k.a E-cell of nitj. Stay tund to get notifications');

-- --------------------------------------------------------

--
-- Table structure for table `tagged_events`
--

CREATE TABLE `tagged_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `ev_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `comments` text,
  `d_upl` datetime NOT NULL,
  `d_mod` datetime DEFAULT NULL,
  `status` enum('participants','winner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagged_events`
--

INSERT INTO `tagged_events` (`id`, `ev_id`, `u_id`, `comments`, `d_upl`, `d_mod`, `status`) VALUES
(1, 1, 1, NULL, '2017-06-26 00:00:00', NULL, 'participants');

-- --------------------------------------------------------

--
-- Table structure for table `test_auto_complete`
--

CREATE TABLE `test_auto_complete` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `media` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_auto_complete`
--

INSERT INTO `test_auto_complete` (`uid`, `username`, `email`, `media`, `country`) VALUES
(1, 'satya', 'sasa', 'sasgsfhgsyg', 'sgasgas'),
(2, 'satyamsndrm', NULL, 'sdcsdg', 'gfdhdg'),
(3, 'S', 'asasdf', 'dafdasc', 'fsfdad');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(10) UNSIGNED NOT NULL,
  `usename` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `acc_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `usename`, `password`, `acc_level`) VALUES
(1, 'satya', 'satya', 1),
(2, 'allumni', 'allumni', 1),
(3, 'faculty', 'faculty', 1),
(9, 'satst', '99875401d16283b911c70b1ddbc25ac40836367f', 1),
(10, 'satst', '99875401d16283b911c70b1ddbc25ac40836367f', 1),
(11, 'AS', 'df211ccdd94a63e0bcb9e6ae427a249484a49d60', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `u_id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `u_pic` varchar(255) DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `sex` enum('M','F') DEFAULT NULL,
  `add_id` int(10) UNSIGNED DEFAULT NULL,
  `abt_me` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`u_id`, `f_name`, `l_name`, `u_pic`, `age`, `sex`, `add_id`, `abt_me`) VALUES
(1, 'Satyam', 'Sundaram', 'IMAGES/profile/5ed843IMG_20170313_121023.jpg', '21', 'M', 1, 'to you.'),
(2, 'Allimni', 'Of NITj', NULL, NULL, 'M', 2, 'I am the allumni of clg 1'),
(3, 'Faculty', 'of nitj', NULL, NULL, 'M', 1, NULL),
(9, 'sa', 'tya', NULL, NULL, 'M', NULL, NULL),
(10, 'qq', 'qq', NULL, NULL, 'M', NULL, NULL),
(11, 'as', 'as', NULL, NULL, 'M', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `v_id` int(11) NOT NULL,
  `frm` enum('user','society') DEFAULT NULL,
  `n_id` int(11) DEFAULT NULL,
  `u_id` int(11) NOT NULL,
  `v_link` varchar(255) NOT NULL,
  `v_txt` text,
  `d_upl` datetime NOT NULL,
  `d_mod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`v_id`, `frm`, `n_id`, `u_id`, `v_link`, `v_txt`, `d_upl`, `d_mod`) VALUES
(1, 'user', NULL, 1, 'https://www.youtube.com/embed/lY2yjAdbvdQ', 'this is frst video', '2017-07-10 00:00:00', NULL),
(2, 'user', NULL, 1, 'https://www.youtube.com/embed/XGSy3_Czz8k', 'dsdaca', '2017-07-10 03:00:00', NULL),
(3, 'user', NULL, 2, 'https://www.youtube.com/embed/lY2yjAdbvdQ', 'sascdasdfaddf', '2017-07-10 07:00:00', NULL),
(4, 'user', NULL, 1, 'sdfgs', 'sgfsdf', '2017-07-17 21:39:07', NULL),
(5, 'user', NULL, 1, 'https://www.youtube.com/watch?v=M6tn4k12Jjk', 'sdaddfadsc', '2017-07-17 21:59:12', NULL),
(6, 'user', NULL, 1, 'https://www.youtube.com/watch?v=C8eAKT-zQXk', 'scvsfgsfds', '2017-07-17 22:04:39', NULL),
(7, 'user', NULL, 1, 'https://www.youtube.com/embed/C8eAKT-zQXk', 'gfghxcnxc', '2017-07-17 22:05:55', NULL),
(8, 'user', NULL, 1, 'https://www.youtube.com/embed/2NjtWgM4Rt8', '', '2017-08-01 17:14:36', NULL),
(9, 'user', NULL, 1, 'https://www.youtube.com/embed/tDce2J2Kmxg', '', '2017-08-08 19:20:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workinfo`
--

CREATE TABLE `workinfo` (
  `w_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `w_type` enum('placed','intern','working','worked') NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_type` varchar(255) DEFAULT NULL,
  `joined` year(4) DEFAULT NULL,
  `left` year(4) DEFAULT NULL,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workinfo`
--

INSERT INTO `workinfo` (`w_id`, `u_id`, `w_type`, `c_name`, `c_type`, `joined`, `left`, `comments`) VALUES
(1, 1, 'intern', 'Oyo rooms', NULL, 2015, NULL, NULL),
(2, 1, 'placed', '2nd cmp', NULL, 2015, NULL, 'My 2nd comp'),
(3, 1, 'worked', 'acsd', NULL, 2021, 2021, 'fdasfd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_cnfm`
--
ALTER TABLE `acc_cnfm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_level`
--
ALTER TABLE `acc_level`
  ADD PRIMARY KEY (`acc_level`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_group`
--
ALTER TABLE `branch_group`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `clg_fests`
--
ALTER TABLE `clg_fests`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `clg_info`
--
ALTER TABLE `clg_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clg_oprtr`
--
ALTER TABLE `clg_oprtr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clg_profile`
--
ALTER TABLE `clg_profile`
  ADD PRIMARY KEY (`clg_id`);

--
-- Indexes for table `club_members`
--
ALTER TABLE `club_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueness` (`s_id`,`u_id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`clg_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cm_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ev_id`);

--
-- Indexes for table `fest_organisers`
--
ALTER TABLE `fest_organisers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_rqsts`
--
ALTER TABLE `follow_rqsts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grp`
--
ALTER TABLE `grp`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `hostel_grp`
--
ALTER TABLE `hostel_grp`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pg_id`);

--
-- Indexes for table `placements`
--
ALTER TABLE `placements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharing`
--
ALTER TABLE `sharing`
  ADD PRIMARY KEY (`sh_id`);

--
-- Indexes for table `society`
--
ALTER TABLE `society`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `tagged_events`
--
ALTER TABLE `tagged_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `workinfo`
--
ALTER TABLE `workinfo`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_cnfm`
--
ALTER TABLE `acc_cnfm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `acc_level`
--
ALTER TABLE `acc_level`
  MODIFY `acc_level` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `branch_group`
--
ALTER TABLE `branch_group`
  MODIFY `b_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clg_fests`
--
ALTER TABLE `clg_fests`
  MODIFY `f_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clg_info`
--
ALTER TABLE `clg_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `clg_oprtr`
--
ALTER TABLE `clg_oprtr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clg_profile`
--
ALTER TABLE `clg_profile`
  MODIFY `clg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `club_members`
--
ALTER TABLE `club_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `clg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ev_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fest_organisers`
--
ALTER TABLE `fest_organisers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `follow_rqsts`
--
ALTER TABLE `follow_rqsts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `grp`
--
ALTER TABLE `grp`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `hostel_grp`
--
ALTER TABLE `hostel_grp`
  MODIFY `h_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `l_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `msgs`
--
ALTER TABLE `msgs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pg_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `placements`
--
ALTER TABLE `placements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pr`
--
ALTER TABLE `pr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sharing`
--
ALTER TABLE `sharing`
  MODIFY `sh_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `society`
--
ALTER TABLE `society`
  MODIFY `s_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tagged_events`
--
ALTER TABLE `tagged_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `u_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `workinfo`
--
ALTER TABLE `workinfo`
  MODIFY `w_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
