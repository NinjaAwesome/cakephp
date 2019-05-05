-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2018 at 01:14 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homsavvy`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `title`, `created`, `modified`) VALUES
(1, 'Service Provider', '2018-06-26 10:49:19', '2018-06-26 10:49:19'),
(2, 'Customer', '2018-06-26 10:49:19', '2018-06-26 10:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fake_pass` varchar(250) DEFAULT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `login_count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `mobile`, `dob`, `email`, `password`, `fake_pass`, `profile_photo`, `status`, `is_verified`, `login_count`, `created`, `modified`) VALUES
(1, 'Jed Harvey', '+2748832990213', '1939-12-14', 'elijah32@hoppe.biz', '$2y$10$sFrM9vw7aQwQm64slqev5OJhWdRmKXmFrZG0wUY0NM2rHNtD/.NU2', '+BO&6P@Dw]b:5^#ha3il', 'uploads/admin_users/photos/2c36c6872a42daac642fae85ffffd8c7.jpg', 1, 1, 23, '1980-12-16 19:52:05', '2018-08-07 06:32:11'),
(2, 'Hope Kertzmann', '+1850521959918', '1930-04-20', 'vandervort.justine@hotmail.com', '$2y$10$JYGINvrWsQ0429Qt1XObR.Mf1UdQyQAsFuQeRehIBlqgAGa3b.8UO', ')&X-WYqNBBQv_VF:Y?\'T', 'fb4ba6fde28c063179ab7f5c3a1d085b.jpg', 0, 0, 0, '1984-07-24 10:31:55', '1984-07-24 10:31:55'),
(3, 'Karolann O\'Conner', '+9856168499102', '1975-02-22', 'dgibson@gmail.com', '$2y$10$KaOI864lNkLeVi1rCXpfFuz06LKWP6UAoVEDLsxuiGINcKzvIn.Zy', '!(kM>cvLF8', 'f5ce95cc77bd530b0a7eb4b03b7c8a57.jpg', 0, 1, 0, '2014-11-30 19:03:59', '2014-11-30 19:03:59'),
(4, 'Gudrun Rohan', '+4584789510142', '1980-12-22', 'aurelio.dooley@quigley.com', '$2y$10$EqsH.inrWC/J4kNfHmF7XOJCajyXhtEBPyAmNXXN9po.UZoEW0yWS', 'GQa@J=Oaz', 'fc5ed5ca3bc29bddc1ba0afe63428749.jpg', 0, 0, 0, '2014-03-09 22:49:53', '2014-03-09 22:49:53'),
(5, 'Nikita Robel', '+3366119829240', '1939-07-14', 'sonia.abshire@gmail.com', '$2y$10$znyVJFSSTzcP48UHHFo53Oa3WVAzIloX/Gz9p7U5HZTbrvseM2CjC', 'vK@Nt?#\\/2HRKTor(', '78f51d87ec8fa737353e0a90827cc9ec.jpg', 1, 0, 0, '1977-03-20 16:16:56', '1977-03-20 16:16:56'),
(7, 'Meaghan Gleichner', '+6658188784181', '1959-07-12', 'kuhlman.elliott@hotmail.com', '$2y$10$w4RasTO0HNtp6r0sQvOVWO3RAs8.ok9F6YDf71ruN44M5b5CxpzSO', 'hsA%he3,)1ss!', '8d3943cf2171e9a390b221c6e7bf5602.jpg', 0, 0, 0, '1989-06-21 03:55:38', '1989-06-21 03:55:38'),
(8, 'Meaghan Stoltenberg', '+1536722567718', '1965-05-13', 'hessel.anya@yahoo.com', '$2y$10$qBN9sO15khG6X20l6PoAEuyOUNGyTxA56pSyDPYAyM7Iky2zzYRsq', 'oBbHg3w42+gm_Zlzg', '2c36c6872a42daac642fae85ffffd8c7.jpg', 0, 0, 0, '1980-02-28 23:46:32', '1980-02-28 23:46:32'),
(9, 'Aurelia VonRueden', '+4734581404509', '1921-10-03', 'hanumanprasad.yadav@dotsquares.com', '$2y$10$v3zZ6RazKKep7o8Pc26tl.c5sAmbaiIlXkrQVaPdQbEvSCpBNi4Ky', '|fO9TS/:7e{[s$', '746cff2e5647e17f2530149e0c23e89a.jpg', 1, 1, 0, '1994-09-25 12:35:14', '2018-07-26 13:24:48'),
(10, 'Sanford Jones', '+4193131587789', '2009-08-31', 'rbaumbach@prohaska.org', '$2y$10$Y0JMAWNklzX22boJx0n64OB92SAnflCCUjhZVn4yzSHhzwULBHKdG', 'Uiz,g{C\'IU|~3`Y', '0064a28d08b8de9c76e4f43a13ed0d0a.jpg', 0, 0, 0, '1984-06-03 22:28:47', '2018-07-03 10:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users_roles`
--

CREATE TABLE `admin_users_roles` (
  `id` int(11) NOT NULL,
  `role_id` int(5) NOT NULL,
  `admin_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users_roles`
--

INSERT INTO `admin_users_roles` (`id`, `role_id`, `admin_user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 1, 5),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_manager_phinxlog`
--

CREATE TABLE `admin_user_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user_manager_phinxlog`
--

INSERT INTO `admin_user_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171222172507, 'CreateRoles', '2018-06-26 05:16:52', '2018-06-26 05:16:52', 0),
(20171222174928, 'CreateAdminUsers', '2018-06-26 05:16:52', '2018-06-26 05:16:52', 0),
(20171222175250, 'CreateAdminUsersRoles', '2018-06-26 05:16:53', '2018-06-26 05:16:53', 0),
(20171223170901, 'AddFakePassToAdminUsers', '2018-06-26 05:16:53', '2018-06-26 05:16:53', 0),
(20180312140710, 'CreateUserTokens', '2018-06-26 05:16:53', '2018-06-26 05:16:53', 0),
(20180417095907, 'AddIsDefaultToRoles', '2018-06-26 05:16:53', '2018-06-26 05:16:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `attribute_group_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_groups`
--

CREATE TABLE `attribute_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `status`, `sort_order`, `created`, `modified`) VALUES
(1, 'Home', 1, 1, '2018-07-03 10:34:31', '2018-07-03 10:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

CREATE TABLE `banner_images` (
  `id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `external_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_images`
--

INSERT INTO `banner_images` (`id`, `banner_id`, `title`, `description`, `external_link`, `image`, `sort_order`, `created`, `modified`) VALUES
(1, 1, 'lipsum', 'fgdr', 'https://projects.dotsquares.com', 'uploads/admin_users/photos/e3f0eed4ef5435fe0049b34ef0ff4471.jpg', 1, '2018-07-03 10:34:31', '2018-07-03 10:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `banner_manager_phinxlog`
--

CREATE TABLE `banner_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner_manager_phinxlog`
--

INSERT INTO `banner_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180423103116, 'CreateBanners', '2018-07-03 05:00:57', '2018-07-03 05:00:57', 0),
(20180423103125, 'CreateBannerImages', '2018-07-03 05:00:57', '2018-07-03 05:00:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `catalog_manager_phinxlog`
--

CREATE TABLE `catalog_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catalog_manager_phinxlog`
--

INSERT INTO `catalog_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180201094038, 'CreateOptions', '2018-07-30 04:11:14', '2018-07-30 04:11:14', 0),
(20180201094453, 'CreateOptionValues', '2018-07-30 04:11:14', '2018-07-30 04:11:14', 0),
(20180203053511, 'CreateAttributeGroups', '2018-07-30 04:11:14', '2018-07-30 04:11:14', 0),
(20180203053529, 'CreateAttributes', '2018-07-30 04:11:14', '2018-07-30 04:11:14', 0),
(20180205124355, 'CreateTags', '2018-07-30 04:11:14', '2018-07-30 04:11:15', 0),
(20180205124538, 'CreateStockStatuses', '2018-07-30 04:11:15', '2018-07-30 04:11:15', 0),
(20180205124555, 'CreateProducts', '2018-07-30 04:11:15', '2018-07-30 04:11:15', 0),
(20180205124607, 'CreateProductsCategories', '2018-07-30 04:11:15', '2018-07-30 04:11:15', 0),
(20180205124616, 'CreateProductImages', '2018-07-30 04:11:15', '2018-07-30 04:11:15', 0),
(20180205124741, 'CreateProductDiscounts', '2018-07-30 04:11:15', '2018-07-30 04:11:15', 0),
(20180205124758, 'CreateProductSpecials', '2018-07-30 04:11:15', '2018-07-30 04:11:15', 0),
(20180205124834, 'CreateRelatedProducts', '2018-07-30 04:11:15', '2018-07-30 04:11:15', 0),
(20180205124848, 'CreateProductOptions', '2018-07-30 04:11:15', '2018-07-30 04:11:16', 0),
(20180205124859, 'CreateProductOptionValues', '2018-07-30 04:11:16', '2018-07-30 04:11:16', 0),
(20180205124919, 'CreateProductsTags', '2018-07-30 04:11:16', '2018-07-30 04:11:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category_manager_phinxlog`
--

CREATE TABLE `category_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_manager_phinxlog`
--

INSERT INTO `category_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180201064636, 'CreateCategories', '2018-07-27 00:58:20', '2018-07-27 00:58:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_manager_phinxlog`
--

CREATE TABLE `cms_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_manager_phinxlog`
--

INSERT INTO `cms_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171223181406, 'CreatePages', '2018-06-26 05:18:55', '2018-06-26 05:18:55', 0),
(20171223181416, 'CreateNavigations', '2018-06-26 05:18:55', '2018-06-26 05:18:55', 0),
(20171223181425, 'CreateModules', '2018-06-26 05:18:55', '2018-06-26 05:18:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_manager_phinxlog`
--

CREATE TABLE `contact_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_manager_phinxlog`
--

INSERT INTO `contact_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180118115647, 'CreateInquiries', '2018-07-03 05:02:22', '2018-07-03 05:02:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_hooks`
--

CREATE TABLE `email_hooks` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_hooks`
--

INSERT INTO `email_hooks` (`id`, `title`, `slug`, `description`, `status`, `created`, `modified`) VALUES
(1, 'Welcome Email', 'welcome-email', 'when user has been registered then send welcome email for verify account.', 1, '2018-06-26 10:48:28', '2018-06-26 10:48:28'),
(2, 'Forgot Password Email', 'forgot-password-email', 'when user has forgot password.', 1, '2018-06-26 10:48:28', '2018-06-26 10:48:28'),
(3, 'Contact us', 'contact-us', 'when guest user send inquiry from contact us form.', 1, '2018-06-26 10:48:28', '2018-06-26 10:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `email_manager_phinxlog`
--

CREATE TABLE `email_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_manager_phinxlog`
--

INSERT INTO `email_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171218082425, 'CreateEmailPreferences', '2018-06-26 05:18:17', '2018-06-26 05:18:17', 0),
(20171218082436, 'CreateEmailHooks', '2018-06-26 05:18:17', '2018-06-26 05:18:17', 0),
(20171218083809, 'CreateEmailTemplates', '2018-06-26 05:18:17', '2018-06-26 05:18:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_preferences`
--

CREATE TABLE `email_preferences` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `layout_html` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_preferences`
--

INSERT INTO `email_preferences` (`id`, `title`, `layout_html`, `status`, `created`, `modified`) VALUES
(1, 'Main Email Layout', '<html>\n<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /></head>\n<body><div>\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid #dddddd;\" width=\"650\">\n	<tbody>\n		<tr>\n			<td>\n			<table cellpadding=\"0\" cellspacing=\"0\" style=\"background:#ffffff; border-bottom:1px solid #dddddd; padding:15px;\" width=\"100%\">\n				<tbody>\n					<tr>\n						<td><a href=\"##BASE_URL##\" target=\"_blank\"><img alt=\"\" border=\"0\" src=\"##SYSTEM_LOGO##\" /></a></td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"background:#ffffff; padding:15px;\">\n			<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n				<tbody>\n					<tr>\n						<td style=\"font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; color:#000000; font-size:16px;\">\n							##EMAIL_CONTENT##\n						</td>\n					</tr>\n					<tr>\n						<td style=\"font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; color:#043f8d; font-size:16px; vertical-align:middle; text-align:left; padding-top:20px;\">\n						##EMAIL_FOOTER##\n						</td>\n					</tr>\n				</tbody>\n			</table>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"background:#043f8d; border-top:1px solid #dddddd; text-align:center; font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; color:#ffffff; padding:12px; font-size:12px; text-transform:uppercase; font-weight:normal;\">##COPYRIGHT_TEXT##</td>\n		</tr>\n	</tbody>\n</table>\n</div>\n</body>\n</head>\n</html>', 1, '2018-06-26 10:48:36', '2018-06-26 10:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `email_hook_id` int(11) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `footer_text` text NOT NULL,
  `email_preference_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_hook_id`, `subject`, `description`, `footer_text`, `email_preference_id`, `status`, `created`, `modified`) VALUES
(1, 1, '##USER_NAME##, a very warm welcome to the ##SYSTEM_APPLICATION_NAME##', '<p>We&rsquo;re so happy to have you with us.</p>\n\n<p>Please click on the button below to confirm we got the right email address.</p>\n\n<p><a href=\"##verify_n_password##\">VERIFY MY EMAIL</a></p>\n\n<p>Or copy and paste the link below.</p>\n\n<p>##verify_n_password##</p>\n\n<p>##USER_INFO##</p>', '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>', 1, 1, '2018-06-26 10:48:46', '2018-06-26 10:48:46'),
(2, 2, '##USER_NAME##, to set your new password…', '<p>You Recently requested to reset your password for your admin account. Click the button below to reset it.</p>\n\n<p><a href=\"##USER_RESET_LINK##\">Reset Password</a></p>\n\n<p>if you ignore this message, your password won&#39;t be changed.</p>', '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>', 1, 1, '2018-06-26 10:48:46', '2018-06-26 10:48:46'),
(3, 3, 'Hello Administrtor, ##USER_NAME## want\'s to contact you', '<p>Hello Administrator,</p>\n\n<p>&nbsp;</p>\n\n<p>Name :&nbsp;##USER_NAME##</p>\n\n<p>Email :&nbsp;##USER_EMAIL##</p>\n\n<p>Phone No. :&nbsp;##USERE_MOBILE##</p>\n\n<p>##MESSAGE##</p>', '<strong>Thanks and Regards,</strong><p>##SYSTEM_APPLICATION_NAME##</p>', 1, 1, '2018-06-26 10:48:46', '2018-06-26 10:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `message` tinytext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `plugin` varchar(120) NOT NULL,
  `controller` varchar(120) NOT NULL,
  `action` varchar(100) NOT NULL,
  `json_path` varchar(400) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(300) NOT NULL,
  `meta_description` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `plugin`, `controller`, `action`, `json_path`, `banner`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `created`, `modified`) VALUES
(1, 'Hpme', '', 'Pages', 'display', '{\"plugin\":null,\"controller\":\"Pages\",\"action\":\"display\"}', '', '', '', '', 1, '2018-07-27 06:19:15', '2018-07-27 06:19:15'),
(2, 'Contact us', 'ContactManager', 'Inquiries', 'index', '{\"plugin\":\"ContactManager\",\"controller\":\"Inquiries\",\"action\":\"index\"}', '', '', '', '', 1, '2018-07-27 06:20:02', '2018-07-27 06:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_link` varchar(255) NOT NULL,
  `is_nav_type` int(2) NOT NULL,
  `lft` int(11) NOT NULL,
  `rght` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `is_top` tinyint(1) DEFAULT NULL,
  `is_bottom` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`id`, `title`, `slug`, `parent_id`, `menu_link`, `is_nav_type`, `lft`, `rght`, `sort_order`, `is_top`, `is_bottom`, `status`, `created`, `modified`) VALUES
(1, 'Home', 'home', 0, '{\"plugin\":null,\"controller\":\"Pages\",\"action\":\"display\"}', 3, 1, 2, 1, 1, 0, 1, '2018-07-27 06:21:17', '2018-07-27 06:21:17'),
(2, 'Contact Us', 'contact-us', 0, '{\"plugin\":\"ContactManager\",\"controller\":\"Inquiries\",\"action\":\"index\"}', 3, 3, 4, 2, 1, 0, 1, '2018-07-27 06:22:28', '2018-07-27 06:22:28'),
(3, 'About Us', 'about-us', 0, '{\"plugin\":\"CmsManager\",\"controller\":\"Pages\",\"action\":\"detail\",\"slug\":\"about-us\"}', 1, 5, 6, 3, 1, 1, 1, '2018-07-27 06:24:03', '2018-07-27 06:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option_type` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_type`, `title`, `image`, `sort_order`, `created`, `modified`) VALUES
(1, 'select', 'Bungalow', '', 1, '2018-07-30 09:47:22', '2018-07-30 09:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `option_values`
--

CREATE TABLE `option_values` (
  `id` int(11) NOT NULL,
  `option_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `option_values`
--

INSERT INTO `option_values` (`id`, `option_id`, `title`, `image`, `sort_order`, `created`, `modified`) VALUES
(1, '1', 'Red', '', 1, '2018-07-30 09:47:22', '2018-07-30 09:47:22'),
(2, '1', 'Blue', '', 2, '2018-07-30 09:47:22', '2018-07-30 09:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `sub_title` varchar(150) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `short_description` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `banner` varchar(200) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(300) NOT NULL,
  `meta_description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `sub_title`, `slug`, `short_description`, `description`, `banner`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `created`, `modified`) VALUES
(1, 'About Us', '', 'about-us', 'h', '<p>gdfhth</p>\r\n', '', 'fgr', 'grg', 'rgre', 1, '2018-07-27 06:23:44', '2018-07-27 06:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `model` varchar(61) NOT NULL,
  `sku` varchar(64) DEFAULT NULL,
  `upc` varchar(64) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(4) NOT NULL,
  `minimum_quantity` int(4) NOT NULL,
  `stock_status_id` int(11) DEFAULT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products_tags`
--

CREATE TABLE `products_tags` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL,
  `priority` int(5) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `is_required` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_option_values`
--

CREATE TABLE `product_option_values` (
  `id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `options_value_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL,
  `subtract` tinyint(1) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `price_prefix` char(1) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `weight_prefix` char(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_specials`
--

CREATE TABLE `product_specials` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `priority` int(5) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `related_products`
--

CREATE TABLE `related_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `is_default`, `created`, `modified`) VALUES
(1, 'Administration', NULL, '2018-06-26 10:47:23', '2018-06-26 10:47:23'),
(2, 'Admin', NULL, '2018-06-26 10:47:23', '2018-06-26 10:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `config_value` text NOT NULL,
  `manager` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `slug`, `config_value`, `manager`, `field_type`, `created`, `modified`) VALUES
(1, 'Website Name', 'SYSTEM_APPLICATION_NAME', 'Dotsquares', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(2, 'Admin Email', 'ADMIN_EMAIL', 'hanumanprasad.yadav@dotsquares.com', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(3, 'From Email', 'FROM_EMAIL', 'hanumanprasad.yadav@dotsquares.com', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(4, 'Owner Name', 'WEBSITE_OWNER', 'Hanuman Yadav', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(5, 'Telephone', 'TELEPHONE', '+91-7665880635', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(6, 'Admin Page Limit', 'ADMIN_PAGE_LIMIT', '20', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(7, 'Front Page Limit', 'FRONT_PAGE_LIMIT', '20', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(8, 'Admin Date Format', 'ADMIN_DATE_FORMAT', 'd F, Y', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(9, 'Admin Date Time Format', 'ADMIN_DATE_TIME_FORMAT', 'd F, Y H:i A', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(10, 'Front Date Format', 'FRONT_DATE_FORMAT', 'd F, Y', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(11, 'Front Date Time Format', 'FRONT_DATE_TIME_FORMAT', 'd F, Y', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(12, 'Reset URL expired in hours', 'RESET_URL_EXPIRED', '24', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(13, 'Development Mode', 'DEVELOPMENT_MODE', '1', 'general', 'checkbox', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(14, 'Default currency', 'DEFAULT_CURRENCY', 'USD', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(15, 'Contact us text', 'CONTACT_US_TEXT', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(16, 'Google Map Api Key', 'GOOGLE_MAP_KEY', 'AIzaSyD9pg6_fzfgDHJFSW0wkrIcuCOw_V9qOfM', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(17, 'Office Address', 'ADDRESS', '6-Kha-9, Jawahar Nagar, <br> Jaipur, Rajasthan - 302004, India', 'general', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(18, 'Main Logo', 'MAIN_LOGO', 'uploads/ds.jpg', 'theme_images', 'text', '2018-06-26 10:48:08', '2018-06-26 11:11:02'),
(19, 'Main Favicon', 'MAIN_FAVICON', 'uploads/dots-.png', 'theme_images', 'text', '2018-06-26 10:48:08', '2018-06-26 11:11:02'),
(20, 'SMTP Allow', 'SMTP_ALLOW', '1', 'smtp', 'checkbox', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(21, 'SMTP Email Host', 'SMTP_EMAIL_HOST', 'mail.dotsquares.com', 'smtp', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(22, 'SMTP Username', 'SMTP_USERNAME', 'wwwsmtp@dotsquares.com', 'smtp', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(23, 'SMTP Password', 'SMTP_PASSWORD', 'dsmtp909#', 'smtp', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(24, 'SMTP Port', 'SMTP_PORT', '25', 'smtp', 'text', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(25, 'SMTP Tls', 'SMTP_TLS', '0', 'smtp', 'checkbox', '2018-06-26 10:48:08', '2018-06-26 10:48:08'),
(26, 'Default Banner', 'DEFAULT_BANNER', '1', 'general', 'text', '2018-07-03 10:33:57', '2018-07-03 10:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `setting_manager_phinxlog`
--

CREATE TABLE `setting_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting_manager_phinxlog`
--

INSERT INTO `setting_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171220071130, 'CreateSettings', '2018-06-26 05:17:08', '2018-06-26 05:17:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_statuses`
--

CREATE TABLE `stock_statuses` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fake_pass` varchar(250) NOT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `login_count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `mobile`, `dob`, `email`, `password`, `fake_pass`, `profile_photo`, `status`, `is_verified`, `login_count`, `created`, `modified`) VALUES
(1, 'Monika', 'jain', '', '2018-02-06', 'monila@gmail.com', '$2y$10$PPPvCOPa6csQ2RLxUFRlPuf.FhAtjo6mOR1Mhk4RiYo6.5Tbxah3a', '', 'uploads/admin_users/photos/0064a28d08b8de9c76e4f43a13ed0d0a.jpg', 0, 0, 0, '2018-06-26 10:56:12', '2018-07-26 13:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `users_account_types`
--

CREATE TABLE `users_account_types` (
  `id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `account_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_account_types`
--

INSERT INTO `users_account_types` (`id`, `user_id`, `account_type_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_manager_phinxlog`
--

CREATE TABLE `user_manager_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_manager_phinxlog`
--

INSERT INTO `user_manager_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20180109130834, 'CreateUsers', '2018-06-26 05:19:05', '2018-06-26 05:19:05', 0),
(20180109130848, 'CreateAccountTypes', '2018-06-26 05:19:05', '2018-06-26 05:19:05', 0),
(20180109130857, 'CreateUsersAccountTypes', '2018-06-26 05:19:05', '2018-06-26 05:19:05', 0),
(20180109131012, 'AddFakePassToUsers', '2018-06-26 05:19:05', '2018-06-26 05:19:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `token_type` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `user_type`, `token_type`, `token`, `status`, `created`, `modified`) VALUES
(1, 1, 'users', 'account_confirmation', '35b5c7cd-578d-43e4-9d71-948ee5d205e6', 0, '2018-06-26 10:56:12', '2018-06-26 10:56:12'),
(2, 9, 'admin_user', 'account_confirmation', '92a9f29f-88c2-4be0-8fcc-d2df0eef5fc7', 0, '2018-07-26 13:24:48', '2018-07-26 13:24:48'),
(3, 9, 'admin_user', 'forgot', '6f3f38fc-4b47-4c72-939c-d7dbf7c70b34', 0, '2018-07-26 13:25:45', '2018-07-26 13:25:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EMAIL_INDEX` (`email`);

--
-- Indexes for table `admin_users_roles`
--
ALTER TABLE `admin_users_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_ROLE_ID` (`role_id`),
  ADD KEY `BY_ADMIN_USER_ID` (`admin_user_id`);

--
-- Indexes for table `admin_user_manager_phinxlog`
--
ALTER TABLE `admin_user_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_ATTRIBUTE_GROUP_ID` (`attribute_group_id`);

--
-- Indexes for table `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_images`
--
ALTER TABLE `banner_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_BANNER_ID` (`banner_id`);

--
-- Indexes for table `banner_manager_phinxlog`
--
ALTER TABLE `banner_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `catalog_manager_phinxlog`
--
ALTER TABLE `catalog_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`),
  ADD KEY `BY_PARENT_ID` (`parent_id`);

--
-- Indexes for table `category_manager_phinxlog`
--
ALTER TABLE `category_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `cms_manager_phinxlog`
--
ALTER TABLE `cms_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `contact_manager_phinxlog`
--
ALTER TABLE `contact_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `email_hooks`
--
ALTER TABLE `email_hooks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`);

--
-- Indexes for table `email_manager_phinxlog`
--
ALTER TABLE `email_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `email_preferences`
--
ALTER TABLE `email_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_EMAIL_HOOK_ID` (`email_hook_id`),
  ADD KEY `BY_EMAIL_PREFERENCE_ID` (`email_preference_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`),
  ADD KEY `BY_PARENT_ID` (`parent_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_values`
--
ALTER TABLE `option_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_OPTION_ID` (`option_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`),
  ADD KEY `fk_product_stock_statuses` (`stock_status_id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_products_categories` (`product_id`),
  ADD KEY `fk_category_products_categories` (`category_id`);

--
-- Indexes for table `products_tags`
--
ALTER TABLE `products_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_PRODUCT_ID` (`product_id`);

--
-- Indexes for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_PRODUCT_ID` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_product_images` (`product_id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_PRODUCT_ID` (`product_id`);

--
-- Indexes for table `product_option_values`
--
ALTER TABLE `product_option_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_PRODUCT_OPTION_ID` (`product_option_id`);

--
-- Indexes for table `product_specials`
--
ALTER TABLE `product_specials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_PRODUCT_ID` (`product_id`);

--
-- Indexes for table `related_products`
--
ALTER TABLE `related_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_PRODUCT_ID` (`product_id`),
  ADD KEY `fk_releted_related_products` (`related_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_SLUG` (`slug`),
  ADD KEY `manager` (`manager`);

--
-- Indexes for table `setting_manager_phinxlog`
--
ALTER TABLE `setting_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `stock_statuses`
--
ALTER TABLE `stock_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EMAIL_INDEX` (`email`);

--
-- Indexes for table `users_account_types`
--
ALTER TABLE `users_account_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BY_USER_ID` (`user_id`),
  ADD KEY `BY_ACCOUNT_TYPE_ID` (`account_type_id`);

--
-- Indexes for table `user_manager_phinxlog`
--
ALTER TABLE `user_manager_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admin_users_roles`
--
ALTER TABLE `admin_users_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_groups`
--
ALTER TABLE `attribute_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_images`
--
ALTER TABLE `banner_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_hooks`
--
ALTER TABLE `email_hooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_preferences`
--
ALTER TABLE `email_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `option_values`
--
ALTER TABLE `option_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_tags`
--
ALTER TABLE `products_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_option_values`
--
ALTER TABLE `product_option_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_specials`
--
ALTER TABLE `product_specials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `related_products`
--
ALTER TABLE `related_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `stock_statuses`
--
ALTER TABLE `stock_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_account_types`
--
ALTER TABLE `users_account_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `fk_attribute_group_id` FOREIGN KEY (`attribute_group_id`) REFERENCES `attribute_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_stock_statuses` FOREIGN KEY (`stock_status_id`) REFERENCES `stock_statuses` (`id`);

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `fk_category_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_products_categories` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD CONSTRAINT `fk_product_product_discounts` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_product_images` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_options`
--
ALTER TABLE `product_options`
  ADD CONSTRAINT `fk_product_product_options` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_specials`
--
ALTER TABLE `product_specials`
  ADD CONSTRAINT `fk_product_product_specials` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `related_products`
--
ALTER TABLE `related_products`
  ADD CONSTRAINT `fk_product_related_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_releted_related_products` FOREIGN KEY (`related_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
