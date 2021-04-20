-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 12:01 PM
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
-- Database: `balance`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `user_id`, `sort_order`) VALUES
(5, NULL, NULL),
(6, 11, NULL),
(7, 11, NULL),
(8, 14, NULL),
(9, 2, 1),
(11, 2, 3345678),
(12, 2, 8),
(13, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category_description`
--

CREATE TABLE `category_description` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` longtext CHARACTER SET utf8 DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_description`
--

INSERT INTO `category_description` (`category_id`, `language_id`, `title`, `description`) VALUES
(11, 1, 'Best of all', 'Best of all'),
(11, 2, 'شكرا لكل هذا.', 'شكرا لكل هذا.'),
(11, 3, '感谢所有这些。', '感谢所有这些。'),
(11, 4, 'Merci pour tout ça', 'Merci pour tout ça'),
(11, 5, 'Спасибо за все этоuououoououououou', 'Спасибо за все этоmememememem'),
(11, 6, 'Gracias por todo eso', 'Gracias por todo eso'),
(12, 1, 'hjk', 'hjk'),
(12, 2, 'ol', 'ol'),
(12, 3, 'huio', 'gfd'),
(12, 4, 'huio', 'huio'),
(12, 5, 'hiop', 'hiop'),
(12, 6, 'hjkl', 'hjkl'),
(13, 1, 'engilish data', 'engilish data'),
(13, 2, 'شكرا لكل هذا.', 'شكرا لكل هذا.'),
(13, 3, '感谢所有这些。', '感谢所有这些。'),
(13, 4, 'french  data', 'french  data'),
(13, 5, 'russian  data', 'russian  data'),
(13, 6, 'spanish  data', 'spanish  data'),
(14, 1, 'update data', 'update data'),
(14, 2, 'شكرا لكل هذا.', 'شكرا لكل هذا.'),
(14, 3, '感谢所有这些。', '感谢所有这些。'),
(14, 4, 'french  data', 'french  data'),
(14, 5, 'russian  data', 'russian  data'),
(14, 6, 'spanish  data', 'spanish  data');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `message`, `status`) VALUES
(1, 'First_client', '6789', 'ghulamali5230@gmail.com', 'hgjkl', 'done'),
(3, 'rtyuio', '567890', 'ghulamali5230@gmail.com', 'ghjk', 'done'),
(4, 'fg', '456789', 'ghulamali5230@gmail.com', 'fghjk', 'done'),
(6, 'tyuio', '567890', 'ghulamali5230@gmail.com', 'gjk', 'done'),
(8, 'a', '56432', 'ghulamali5230@gmail.com', 'fd', NULL),
(10, 'Ashraf', '+923076069760', 'engineerlfe021@gmail.com', 'gdsa', 'done'),
(11, 'Ghulam', '03076069760', 'engineerlife021@gmail.com', 'ghjkl', 'done'),
(12, 'Qasim', '03076069760', 'engineerlfe021@gmail.com', 'dsa', NULL),
(13, 'Ghulam', '03076069760', 'engineerlife021@gmail.com', 'fdsa', 'done'),
(14, 'Ghulam', '03076069760', 'engineerlife021@gmail.com', 'hgfd', NULL),
(15, 'Ghulam', '03076069760', 'engineerlife021@gmail.com', 'fgjkl;', NULL),
(16, 'Ghulam', '03076069760', 'engineerlife021@gmail.com', 'gfds', NULL),
(17, 'Ghulam', '03076069760', 'engineerlife021@gmail.com', 'fghjkl', NULL),
(18, 'ghjkqhjk', '67896557890', 'engineerlife021@gmail.com', 'yuio', NULL),
(19, 'ghjk', '+923076069760', 'engineerlife021@gmail.com', 'fhgjkl;', NULL),
(20, 'ghjk', '90900909909', 'engineerlife021@gmail.com', 'tyuio', NULL),
(21, 'ghjk', '03076069760', 'engineerlife021@gmail.com', 'ghkl', NULL),
(22, 'e', '9099999999', 'a@gmail.com', 'uytrew', NULL),
(23, 'Ghulam', '03076069760', 'engineerlfe021@gmail.com', 'hgf', NULL),
(24, 'Ghulam', '+923076069760', 'engineerlfe021@gmail.com', 'gfd', NULL),
(25, 'Ghulam', '03076069760', 'engineerlfe021@gmail.com', 'hgf', NULL),
(27, 'Ghulam', '03076069760', 'engineerlife021@gmail.com', 'hg', NULL),
(29, 'Ghulam', '3456789', 'engineerlife021@gmail.com', 'rtyui', 'done'),
(32, 'Ghulam Ali', '03076069760', 'engineerlfe021@gmail.com', 'jhg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort_order` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `sort_order`) VALUES
(3, 'Abc'),
(6, '7'),
(7, 'morning'),
(9, '9'),
(10, '4'),
(11, '4'),
(12, '4'),
(13, '4');

-- --------------------------------------------------------

--
-- Table structure for table `faq_description`
--

CREATE TABLE `faq_description` (
  `faq_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq_description`
--

INSERT INTO `faq_description` (`faq_id`, `language_id`, `question`, `answer`) VALUES
(9, 1, 'Lorem ipsum dolor sit?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>'),
(9, 2, 'هذا كل شيء عن الأسئلة الشائعة', '<p>هذا كل شيء عن الأسئلة الشائعةهذا كل شيء عن الأسئلة الشائعةهذا كل شيء عن الأسئلة الشائعةهذا كل شيء عن الأسئلة الشائعةهذا كل شيء عن الأسئلة الشائعةهذا كل شيء عن الأسئلة الشائعةهذا كل شيء عن الأسئلة الشائعةهذا كل شيء عن الأسئلة الشائعة</p>'),
(9, 3, '这就是常见问题解答', '<p>这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答这就是常见问题解答</p>'),
(9, 4, 'Tout est question de FAQ', '<p>Tout est question de FAQ&nbsp;Tout est question de FAQTout est question de FAQTout est question de FAQTout est question de FAQTout est question de FAQTout est question de FAQTout est question de FAQ</p>'),
(9, 5, 'Это все о часто задаваемых вопросах', '<p>Это Это все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахЭто все о часто задаваемых вопросахвсе о часто задаваемых вопросах</p>'),
(9, 6, 'Eso es todo sobre preguntas frecuentes', '<p>Eso es todo sobre preguntas frecuentes&nbsp;Eso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentesEso es todo sobre preguntas frecuentes</p>'),
(10, 1, 'Now that you\'ve seen the map of your trip?', '<p>Now that you&#39;ve seen the map of your trip. You may want to know the distances fromNow that you&#39;ve seen the map of your trip. You may want to know the distances fromNow that you&#39;ve seen the map of your trip. You may want to know the distances fromNow that you&#39;ve seen the map of your trip. You may want to know the distances from this city.</p>'),
(10, 2, 'بعد أن رأيت خريطة رحلتك', '<pre>\r\nيبدأ مسار الخريطة من سرغودا في باكستان وينتهي في بير محل بباكستان. الآن بعد أن رأيت خريطة رحلتك. قد ترغب في معرفة المسافات من يبدأ مسار الخريطة من سرغودا في باكستان وينتهي في بير محل بباكستان. الآن بعد أن رأيت خريطة رحلتك. قد ترغب في معرفة المسافات من</pre>'),
(10, 3, '合作委员会营销', '<p>网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>'),
(10, 4, 'Il suffit de définir le message flash et de rediriger vers', '<p>Il suffit de d&eacute;finir le message flash et de rediriger versIl suffit de d&eacute;finir le message flash et de rediriger versIl suffit de d&eacute;finir le message flash et de rediriger vers</p>'),
(10, 5, 'функции вашего контроллера', '<p>функции вашего контроллерафункции вашего контроллерафункции вашего контроллерафункции вашего контроллерафункции вашего контроллера</p>'),
(10, 6, 'Mensaje flash y redirija hacia', '<p>Mensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija hacia</p>'),
(12, 1, 'Mus sit mattis purus?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>'),
(12, 2, 'شكرا لكل هذا.', '<p>شكرا شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.لكل هذا.</p>'),
(12, 3, '感谢所有这些。', '<p>感谢感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。所有这些。</p>'),
(12, 4, 'Rediriger versIl suffit de', '<p>Suffit de d&amp;eacute;finir le message flash et de rediriger versIl suffit de d&amp;eacute;finir le message flash et de rediriger versIl suffit de d&amp;eacute;finir le message flash et de rediriger vers</p>'),
(12, 5, 'контроллерафункции вашего', '<p>функции вашего контроллерафункции вашего контроллерафункции вашего контроллерафункции вашего контроллерафункции вашего контроллера</p>'),
(12, 6, 'Mensaje flash y redirija haciaMensaje', '<p>Mensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija hacia</p>'),
(13, 1, 'Consectetur adipiscing elit', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>'),
(13, 2, 'هذا. هذا. هذا.', '<p>شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.شكرا لكل هذا.</p>'),
(13, 3, '感谢所有这些。', '<p>感谢感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。感谢所有这些。所有这些。</p>'),
(13, 4, 'Suffit de d&eacute', '<p>Suffit de d&amp;eacute;finir le message flash et de rediriger versIl suffit de d&amp;eacute;finir le message flash et de rediriger versIl suffit de d&amp;eacute;finir le message flash et de rediriger vers</p>'),
(13, 5, 'контроллерафункции вашего контроллера', '<p>функции вашего контроллерафункции вашего контроллерафункции вашего контроллерафункции вашего контроллерафункции вашего контроллера</p>'),
(13, 6, 'HaciaMensaje flash', '<p>Mensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija haciaMensaje flash y redirija hacia</p>'),
(14, 1, 'asdfghjo', 'asdfghjo'),
(14, 2, 'شكرا لكل هذا.', 'شكرا لكل هذا.'),
(14, 3, '感谢所有这些。', '感谢所有这些。'),
(14, 4, 'french data', 'french data'),
(14, 5, 'russain data', 'russain data'),
(14, 6, 'spanish data', 'spanish data');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id`, `sort_order`, `image`) VALUES
(65, 1, '86739.png'),
(66, 3, NULL),
(67, 5, NULL),
(68, 5, NULL),
(69, 3, NULL),
(70, 9, NULL),
(71, 3, NULL),
(72, 3, NULL),
(73, 3, NULL),
(74, 39, NULL),
(75, 6, NULL),
(76, 1, NULL),
(77, 12, '34400.png'),
(78, 3, NULL),
(80, 3, NULL),
(81, 3, NULL),
(83, 3, '50704.png'),
(84, 3, '23427.png'),
(85, 9, '60728.png'),
(86, 5, '34960.png'),
(87, 8, '66779.png'),
(88, 6, '4600.png');

-- --------------------------------------------------------

--
-- Table structure for table `feature_description`
--

CREATE TABLE `feature_description` (
  `feature_id` int(10) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_description`
--

INSERT INTO `feature_description` (`feature_id`, `language_id`, `title`, `description`) VALUES
(65, 1, 'Track Daily Expense', '<p>we are studends in 22222222222222</p>'),
(65, 2, 'نحن ترصيع في عام', '<p>نحن ترصيع في عام 2010</p>'),
(65, 3, '我们是年的朋友', '<p>我们是年的朋友</p>'),
(65, 4, 'nous sommes étudiants en', '<p>nous sommes &eacute;tudiants en 1</p>'),
(65, 5, 'мы учимся в году', '<p>мы учимся в &nbsp;году</p>'),
(65, 6, 'Nosotras somos estudiantes', '<p>Nosotras somos estudiantes</p>'),
(77, 1, 'Budget Management', '<p>array validation in laravel</p>'),
(77, 2, 'التحقق من مجموعة في', '<p>التحقق من مجموعة في</p>'),
(77, 3, '中的数组验证', '<p>中的数组验证</p>'),
(77, 4, 'validation de tableau', '<p>validation de tableau dans laravel</p>'),
(77, 5, 'проверка массива в', '<p>проверка массива в Laravel</p>'),
(77, 6, 'validación de matriz', '<p>validaci&oacute;n de matriz en laravel</p>'),
(79, 1, 'Shafqt mehmod', 'announcement about uni'),
(83, 1, 'Data security', '<p>Data<br />\r\nsecurity</p>'),
(83, 2, 'أنا طفلأنا طفل', '<p>أنا طفلأنا طفل</p>'),
(83, 3, '我们是年的朋友', '<p>我们是年的朋友</p>'),
(83, 4, 'validation de tableau dans', '<p>validation de tableau dans</p>'),
(83, 5, 'проверка массива в', '<p>проверка массива в</p>'),
(83, 6, 'validación de matriz', '<p>validaci&oacute;n de matriz</p>'),
(84, 1, 'Track Daily Expense', '<p>Track Daily Expense</p>'),
(84, 2, 'نحن ترصيع في عام', '<p>نحن ترصيع في عام</p>'),
(84, 3, '我们是年的朋友', '<p>我们是年的朋友</p>'),
(84, 4, 'nous sommes étudiants', '<p>nous sommes &eacute;tudiants&nbsp;</p>'),
(84, 5, 'мы учимся в  году', '<p>мы учимся в &nbsp;году</p>'),
(84, 6, 'Nosotras somos estudiantes en', '<p>Nosotras somos estudiantes en</p>'),
(85, 1, 'Budget Management', '<p>Budget Management</p>'),
(85, 2, 'التحقق من مجموعة في', '<p>التحقق من مجموعة في</p>'),
(85, 3, '中的数组验证', '<p>中的数组验证</p>'),
(85, 4, 'validation de tableau', '<p>проверка массива в</p>'),
(85, 5, 'проверка массива в', '<p>russia</p>'),
(85, 6, 'validación de matriz', '<p>span</p>'),
(86, 1, 'Account Management', '<p>Account Management</p>'),
(86, 2, 'التحقق من مجموعة في', '<p>التحقق من مجموعة في</p>'),
(86, 3, '然地跟踪您的资金', '<p>一目了然地跟踪您的资金</p>'),
(86, 4, 'Gardez une trace de', '<p>Gardez une trace de votre argent en un coup d&#39;&oelig;il</p>'),
(86, 5, 'Следите за своими', '<p>Следите за своими</p>'),
(86, 6, 'Realice un seguimiento', '<p>Realice un seguimiento</p>'),
(87, 1, 'Data security', '<p>Data security</p>'),
(87, 2, 'أنا طفلأنا طفل', '<p>أنا طفلأنا طفل</p>'),
(87, 3, '我们是年的朋友', '<p>我们是年的朋友</p>'),
(87, 4, 'validation de tableau dans', '<p>validation de tableau dans</p>'),
(87, 5, 'проверка массива в', '<p>проверка массива в</p>'),
(87, 6, 'validación de matriz', '<p>validaci&oacute;n de matriz</p>'),
(88, 1, 'Account Management', '<p>Account Management</p>'),
(88, 2, 'نحن ترصيع في عام', '<p>نحن ترصيع في عام</p>'),
(88, 3, '我们是年的朋友', '<p>我们是年的朋友</p>'),
(88, 4, 'nous sommes étudiants en', '<p>nous sommes &eacute;tudiants en</p>'),
(88, 5, 'мы учимся в году', '<p>мы учимся в году</p>'),
(88, 6, 'Nosotras somos estudiantes', '<p>Nosotras somos estudiantes</p>');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `name`, `directory`, `status`) VALUES
(1, 'English', 'english', 1),
(2, 'Arabic', 'arabic', 1),
(3, 'Chinese', 'chinese', 1),
(4, 'French', 'french', 1),
(5, 'Russian', 'russian', 1),
(6, 'Spanish', 'spanish', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_19_121435_create_contact_us_table', 1),
(5, '2020_11_19_121507_create_testimonials_table', 1),
(6, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(7, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(8, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(9, '2016_06_01_000004_create_oauth_clients_table', 2),
(10, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(11, '2021_01_06_105022_create_feature_translations_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `name`
--

CREATE TABLE `name` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `skype` varchar(250) NOT NULL,
  `linkedin` varchar(250) NOT NULL,
  `position` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `id` int(250) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_letters`
--

INSERT INTO `news_letters` (`id`, `name`, `email`) VALUES
(1, 'Akram Ali', 'user.wholesaler@gmail.com'),
(2, 'Ghulam Ali', 'admin@admin.com'),
(3, 'Ghulam Ali', 'admin@admin.com'),
(4, 'Ghulam Ali', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0b5c743f4b9569d200b60f964a8d898a8e2fb7b723459879920b167df936050cd3239e78a2e9d96c', 9, 1, 'MyApp', '[]', 0, '2021-01-03 11:52:35', '2021-01-03 11:52:35', '2022-01-03 16:52:35'),
('1bb0d6695b88de3c34310c3c3135ecc84ecff59019d1dcb33fee89cb75b46f950e03137cdc9daff9', 12, 1, 'MyApp', '[]', 0, '2021-01-05 01:05:20', '2021-01-05 01:05:20', '2022-01-05 06:05:20'),
('2a2cc8da07b597bffec734d7d921cb199d41cfbfdd2621a6ec34091243ba1aa8b96d4d09f1319438', 11, 1, 'MyApp', '[]', 0, '2021-01-04 12:01:19', '2021-01-04 12:01:19', '2022-01-04 17:01:19'),
('2c978a8f69ae31275f2b2d6d7e194049f26e011ec513aac4e03f1bf08b637fa8229180405606adde', 8, 1, NULL, '[]', 0, '2021-01-03 11:36:04', '2021-01-03 11:36:04', '2022-01-03 16:36:04'),
('361dd781f9b7a6c286a644e1a123297693a9f31a5ccc0f69ae190260607094b91fb13b01808cda54', 14, 1, 'MyApp', '[]', 0, '2021-01-05 01:07:00', '2021-01-05 01:07:00', '2022-01-05 06:07:00'),
('3935eac7bcf201cf51bb5b669714963583cb66e5fdcf6344cb7c853570e95f207aa5fc2e9efe849e', 14, 1, 'MyApp', '[]', 0, '2021-01-05 01:08:12', '2021-01-05 01:08:12', '2022-01-05 06:08:12'),
('5b80922152e5d6e23f82ba03196aa2eaa0ac981dcc67a6c4fb156f0b044c3f14442f6c90f6095147', 14, 1, 'MyApp', '[]', 0, '2021-01-05 01:06:46', '2021-01-05 01:06:46', '2022-01-05 06:06:46'),
('6160ed84d45dbb35f278785cc5b915a6fe12424ed6a8ecde1e1cb50205ecb0e31cbea0aba9575a26', 2, 1, NULL, '[]', 0, '2021-01-03 10:52:22', '2021-01-03 10:52:22', '2022-01-03 15:52:22'),
('66c8c514b3dbe0a3fea6d904fb88e84be90305d259e4504fb888e8ac565eb0717709caf494e8a319', 2, 1, NULL, '[]', 0, '2021-01-03 08:45:38', '2021-01-03 08:45:38', '2022-01-03 13:45:38'),
('a5253b59a4f2282d6955aed278e3f44fd5899efa1241ff352568591fc451c598c49069db828da8b5', 6, 1, NULL, '[]', 0, '2021-01-03 11:33:51', '2021-01-03 11:33:51', '2022-01-03 16:33:51'),
('c4f9703f5115eaf1bcde546cbb4c65740eb76f09d45a7fcf8fdc44ca6e42f2f60c17628b221d624e', 10, 1, 'MyApp', '[]', 0, '2021-01-04 09:29:07', '2021-01-04 09:29:07', '2022-01-04 14:29:07'),
('c7c4e37922c20e992118a48826ca824cda137db6dc96dcdaa727bffca25543c9adab0529674d8cc4', 11, 1, 'MyApp', '[]', 0, '2021-01-05 01:01:38', '2021-01-05 01:01:38', '2022-01-05 06:01:38'),
('ceaed1c86157ee2343800f72ee86403a4ec83ac3dbfdfd4c57d15fda1ba68f2fca9925dc4f341a0a', 11, 1, 'MyApp', '[]', 0, '2021-01-04 12:03:10', '2021-01-04 12:03:10', '2022-01-04 17:03:10'),
('d486d06474db7d35b0c82a3bc9cb5e375d151281d3cc91bf89021476ae341d2c7f2bfc3a3fa4f14c', 12, 1, 'MyApp', '[]', 0, '2021-01-05 01:04:25', '2021-01-05 01:04:25', '2022-01-05 06:04:25'),
('daf86ac2c32b1cf0fe50d9e2ca23a7800d3a387d317f74d9260bbeebd435950ad779f80505d81591', 2, 1, NULL, '[]', 0, '2021-01-03 11:38:01', '2021-01-03 11:38:01', '2022-01-03 16:38:01'),
('e12cfedb0f5bbaa6e112e99d6da0ca713493658c9dd337cb129c4e02fc05948b81f02caa0249b3a8', 2, 1, 'MyApp', '[]', 0, '2021-01-03 11:50:37', '2021-01-03 11:50:37', '2022-01-03 16:50:37'),
('e2f3c257ff8ea08650f06dadbecff04060fafc982b5828ebbf8973e06cd7c5168dd96834b93c41b7', 10, 1, 'MyApp', '[]', 0, '2021-01-04 09:22:35', '2021-01-04 09:22:35', '2022-01-04 14:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'NUy951sQ3vqXDVjRoIWeW3fGmWqgcvQJUNVJOThk', 'http://localhost', 1, 0, 0, '2021-01-03 05:43:07', '2021-01-03 05:43:07'),
(2, NULL, 'Laravel Password Grant Client', 'q2u8qjhyrhUU5zI5LufdrH55mSyZUabn2ujQT5rW', 'http://localhost', 0, 1, 0, '2021-01-03 05:43:07', '2021-01-03 05:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-01-03 05:43:07', '2021-01-03 05:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(250) NOT NULL,
  `sort_order` int(250) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `sort_order`, `image`) VALUES
(4, 3, '64873.jpg'),
(5, 6, '49210.png');

-- --------------------------------------------------------

--
-- Table structure for table `pages_description`
--

CREATE TABLE `pages_description` (
  `page_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `body` longtext CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages_description`
--

INSERT INTO `pages_description` (`page_id`, `language_id`, `title`, `body`) VALUES
(4, 1, 'abc', '<p>abc&nbsp;</p>'),
(4, 2, 'الصفحة الأولى', '<p>الصفحة الأولى</p>'),
(4, 3, '第一页', '<pre>\r\n第一页</pre>'),
(4, 4, 'première page', '<p>&nbsp;</p>\r\n\r\n<p>premi&egrave;re page</p>'),
(4, 5, 'первая страница', '<p>&nbsp;</p>\r\n\r\n<p>первая страница</p>'),
(4, 6, 'primera página', '<pre>\r\nprimera p&aacute;gina</pre>'),
(5, 1, 'fds', '<p>fd</p>'),
(5, 2, 'fdw', '<p>fds</p>'),
(5, 3, 'fds', '<p>fds</p>'),
(5, 4, 'fds', '<p>vfds</p>'),
(5, 5, 'fds', '<p>vds</p>'),
(5, 6, 'vfds', '<p>bvds</p>');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL,
  `facebook_link` text CHARACTER SET utf8 DEFAULT NULL,
  `instagram_link` text CHARACTER SET utf8 DEFAULT NULL,
  `twitter_link` text CHARACTER SET utf8 DEFAULT NULL,
  `linkedin_link` text CHARACTER SET utf8 DEFAULT NULL,
  `pinterest_link` text CHARACTER SET utf8 DEFAULT NULL,
  `telephone` text CHARACTER SET utf8 DEFAULT NULL,
  `email` text CHARACTER SET utf8 DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `home_image1` text CHARACTER SET utf8 DEFAULT NULL,
  `home_image2` text CHARACTER SET utf8 DEFAULT NULL,
  `feature_image1` text CHARACTER SET utf8 DEFAULT NULL,
  `feature_image2` text CHARACTER SET utf8 DEFAULT NULL,
  `feature_image3` text CHARACTER SET utf8 DEFAULT NULL,
  `safety_image1` text CHARACTER SET utf8 DEFAULT NULL,
  `safety_image2` text CHARACTER SET utf8 DEFAULT NULL,
  `safety_image3` text CHARACTER SET utf8 DEFAULT NULL,
  `about_image1` text CHARACTER SET utf8 DEFAULT NULL,
  `about_image2` text CHARACTER SET utf8 DEFAULT NULL,
  `about_image3` text DEFAULT NULL,
  `footer_link` text CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `facebook_link`, `instagram_link`, `twitter_link`, `linkedin_link`, `pinterest_link`, `telephone`, `email`, `logo`, `home_image1`, `home_image2`, `feature_image1`, `feature_image2`, `feature_image3`, `safety_image1`, `safety_image2`, `safety_image3`, `about_image1`, `about_image2`, `about_image3`, `footer_link`) VALUES
(1, 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', 'https://www.pinterest.com/', 'english', 'balaceapp.contact@info.com', '14980.png', '44337.png', '43250.png', '7532.png', '75966.png', '77891.png', '74248.png', '51821.png', '20524.png', '89096.jpg', '42772.png', '10348.png', 'https://play.google.com/store');

-- --------------------------------------------------------

--
-- Table structure for table `preferences_descriptions`
--

CREATE TABLE `preferences_descriptions` (
  `preference_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `telephone` text CHARACTER SET utf8 DEFAULT NULL,
  `address` text CHARACTER SET utf8 DEFAULT NULL,
  `footer_title` text CHARACTER SET utf8 DEFAULT NULL,
  `footer_description` text DEFAULT NULL,
  `footer_copyright` text DEFAULT NULL,
  `home_feature_title` text DEFAULT NULL,
  `home_feature_description` text DEFAULT NULL,
  `home_heading1` text DEFAULT NULL,
  `home_description1` text DEFAULT NULL,
  `home_heading2` text DEFAULT NULL,
  `home_description2` text DEFAULT NULL,
  `feature_title` text DEFAULT NULL,
  `feature_description` text DEFAULT NULL,
  `feature_heading1` text DEFAULT NULL,
  `feature_description1` text DEFAULT NULL,
  `feature_heading2` text DEFAULT NULL,
  `feature_description2` text DEFAULT NULL,
  `feature_heading3` text DEFAULT NULL,
  `feature_description3` text DEFAULT NULL,
  `safet_title` text DEFAULT NULL,
  `safety_description` text DEFAULT NULL,
  `safety_heading1` text DEFAULT NULL,
  `safety_description1` text DEFAULT NULL,
  `safety_heading2` text DEFAULT NULL,
  `safety_description2` text DEFAULT NULL,
  `safety_heading3` text DEFAULT NULL,
  `safety_description3` text DEFAULT NULL,
  `service_title` text DEFAULT NULL,
  `service_description` text DEFAULT NULL,
  `faq_heading` text DEFAULT NULL,
  `story_title` text DEFAULT NULL,
  `story_description` text DEFAULT NULL,
  `policy_title` text DEFAULT NULL,
  `policy_body` text DEFAULT NULL,
  `about_title` text DEFAULT NULL,
  `about_description` text DEFAULT NULL,
  `about_heading1` text DEFAULT NULL,
  `about_description1` text DEFAULT NULL,
  `about_heading2` text DEFAULT NULL,
  `about_description2` text DEFAULT NULL,
  `about_heading3` text DEFAULT NULL,
  `about_description3` text DEFAULT NULL,
  `sub_heading1` text DEFAULT NULL,
  `sub_description1` text DEFAULT NULL,
  `sub_heading2` text DEFAULT NULL,
  `sub_description2` text DEFAULT NULL,
  `sub_heading3` text DEFAULT NULL,
  `sub_description3` text DEFAULT NULL,
  `sub_heading4` text DEFAULT NULL,
  `sub_description4` text DEFAULT NULL,
  `sub_heading5` text DEFAULT NULL,
  `sub_description5` text DEFAULT NULL,
  `sub_heading6` text DEFAULT NULL,
  `sub_description6` text DEFAULT NULL,
  `sub_description7` text DEFAULT NULL,
  `sub_heading7` text DEFAULT NULL,
  `sub_heading8` text DEFAULT NULL,
  `sub_description8` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preferences_descriptions`
--

INSERT INTO `preferences_descriptions` (`preference_id`, `language_id`, `telephone`, `address`, `footer_title`, `footer_description`, `footer_copyright`, `home_feature_title`, `home_feature_description`, `home_heading1`, `home_description1`, `home_heading2`, `home_description2`, `feature_title`, `feature_description`, `feature_heading1`, `feature_description1`, `feature_heading2`, `feature_description2`, `feature_heading3`, `feature_description3`, `safet_title`, `safety_description`, `safety_heading1`, `safety_description1`, `safety_heading2`, `safety_description2`, `safety_heading3`, `safety_description3`, `service_title`, `service_description`, `faq_heading`, `story_title`, `story_description`, `policy_title`, `policy_body`, `about_title`, `about_description`, `about_heading1`, `about_description1`, `about_heading2`, `about_description2`, `about_heading3`, `about_description3`, `sub_heading1`, `sub_description1`, `sub_heading2`, `sub_description2`, `sub_heading3`, `sub_description3`, `sub_heading4`, `sub_description4`, `sub_heading5`, `sub_description5`, `sub_heading6`, `sub_description6`, `sub_description7`, `sub_heading7`, `sub_heading8`, `sub_description8`) VALUES
(1, 1, 'english', 'FZE Office No 19 DAZ RAS AL KOR DUBAI – UAE PO BOX 63319', 'Keep track of your money at a glance', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>', '© 2020 Balance App. All Rights Reserved. Site by GCC-Marketing', 'Meet the Balance App', '<p>Master your money with one easy app.Just set the flash message and&nbsp;<strong>redirect</strong>&nbsp;to&nbsp;<strong>back</strong>&nbsp;from your controller functiion</p>', 'Make plans for what to do, not what’s due.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Save toward your goals, automatically.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Privacy Policy', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<br />\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<br />\r\n<br />\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.<br />\r\n<br />\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>', 'About us', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'What is Balance, and how does it work?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet,</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Lorem ipsum dolor sit amet,', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus, a, augue consequat, consequat libero.</p>', 'Set Budget', '<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus,</h3>', 'Cash Wallet', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus,</p>', 'Use Your Data Your Way', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus,</p>', 'Log Expenses', '<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus,</h3>', 'See the Whole Picture', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus,</p>', 'Reports', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus,</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus,</p>', 'Accout details', 'Transaction History', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mus sit mattis purus,</p>'),
(1, 2, 'أنا مسلم', 'مكتب رقم 19 داز رأس الكور دبي - الإمارات العربية المتحدة ص.ب 63319', 'تتبع أموالك في لمحة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', '© 2020 تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة GCC-Marketing', 'تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'أنا مسلمبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'بواسطةتطبيق الرصيد', 'بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'كل الحقوق محفوظة. الموقع بواسطة', '<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>\r\n\r\n<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>\r\n\r\n<p>بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةبواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'كل الحقوق محفوظة. الموقع بواسطة', '<p>تطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطةتطبيق الرصيد. كل الحقوق محفوظة. الموقع بواسطة</p>', 'كل الحقوق محفوظة. الموقع بواسطة', '<p>كل الحقوق محفوظة. الموقع بواسطةكل الحقوق محفوظة. الموقع بواسطة</p>', 'كل الحقوق محفوظة. الموقع بواسطة', '<p>كل الحقوق محفوظة. الموقع بواسطةكل الحقوق محفوظة. الموقع بواسطة</p>', 'كل الحقوق محفوظة. الموقع بواسطة', '<p>كل الحقوق محفوظة. الموقع بواسطةكل الحقوق محفوظة. الموقع بواسطة</p>', 'كل الحقوق محفوظة. الموقع بواسطة', '<p>كل الحقوق محفوظة. الموقع بواسطةكل الحقوق محفوظة. الموقع بواسطة</p>', 'كل الحقوق محفوظة. الموقع بواسطة', '<p>كل الحقوق محفوظة. الموقع بواسطةكل الحقوق محفوظة. الموقع بواسطة</p>', '<p>كل الحقوق محفوظة. الموقع بواسطةكل الحقوق محفوظة. الموقع بواسطة</p>', 'كل الحقوق محفوظة. الموقع بواسطة', 'كل الحقوق محفوظة. الموقع بواسطة', '<p>كل الحقوق محفوظة. الموقع بواسطةكل الحقوق محفوظة. الموقع بواسطة</p>'),
(1, 3, '我是穆斯林', 'FZE办公室19 DAZ RAS AL KOR DUBAI –阿联酋邮政信箱63319', '一目了然地跟踪您的资金', '<p>网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '©2020天平App。版权所有。网站按海湾合作委员会营销', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '网站按海湾合作委员会营销', '<p>网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '网站按海湾合作委员会营销', '<p>网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>\r\n\r\n<p>网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>\r\n\r\n<p>网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>\r\n\r\n<p>网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '我是穆斯林', '<p>我是穆斯林网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销网站按海湾合作委员会营销</p>', '网站按海湾合作委员', '<p>网站按海湾合作委员网站按海湾合作委员</p>', '网站按海湾合作委员', '<p>网站按海湾合作委员网站按海湾合作委员</p>', '网站按海湾合作委员', '<p>网站按海湾合作委员网站按海湾合作委员</p>', '网站按海湾合作委员', '<p>网站按海湾合作委员网站按海湾合作委员</p>', '网站按海湾合作委员', '<p>网站按海湾合作委员网站按海湾合作委员</p>', '网站按海湾合作委员', '<p>网站按海湾合作委员网站按海湾合作委员</p>', '<p>网站按海湾合作委员网站按海湾合作委员</p>', '网站按海湾合作委员', '网站按海湾合作委员', '<p>网站按海湾合作委员网站按海湾合作委员</p>'),
(1, 4, 'FRENCH', 'Bureau FZE No 19 DAZ RAS AL KOR DUBAI - UAE PO BOX 63319', 'Gardez une trace de votre argent en un coup d\'œil', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', '© 2020 Balance App. Tous les droits sont réservés. Site par GCC-Marketing', 'Il suffit de définir le message flash et de rediriger vers', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de rediriger vers', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leuIl suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leurcIl suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leurIl suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de rediriger', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de rediriger', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de rediriger vers l\'arrière', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur l suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de défini', 'flash et de rediriger vers l\'arrière', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Flash et de rediriger', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de rediriger', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de rediriger', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de rediriger vers l\'arriè', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Il suffit de définir le message flash et de rediriger', '<p>&nbsp;</p>\r\n\r\n<p>Il suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leu suffit de d&eacute;finir le message flash et de rediriger vers l&#39;arri&egrave;re de la fonction de votre contr&ocirc;leur</p>', 'Gardez une trace de votre argent', '<p>Gardez une trace de votre argentGardez une trace de votre argent</p>', 'Gardez une trace de votre argent', '<p>Gardez une trace de votre argentGardez une trace de votre argent</p>', 'Gardez une trace de votre argent', '<p>Gardez une trace de votre argentGardez une trace de votre argent</p>', 'Gardez une trace de votre argent', '<p>Gardez une trace de votre argentGardez une trace de votre argent</p>', 'Gardez une trace de votre argent', '<p>Gardez une trace de votre argentGardez une trace de votre argent</p>', 'Gardez une trace de votre argent', '<p>Gardez une trace de votre argentGardez une trace de votre argent</p>', '<p>Gardez une trace de votre argentGardez une trace de votre argent</p>', 'Gardez une trace de votre argent', 'Gardez une trace de votre argent', '<p>Gardez une trace de votre argentGardez une trace de votre argent</p>'),
(1, 5, 'RUSSIAN', 'Офис FZE № 19 DAZ RAS AL KOR DUBAI - UAE PO Box 63319', 'Следите за своими деньгами с первого взгляда', '<pre>\r\nПросто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</pre>', '© 2020 Приложение Баланс. Все права защищены. Сайт разработан GCC-Marketing', 'функции вашего контроллера', '<pre>\r\nПросто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</pre>', 'функции вашего контроллера', '<pre>\r\nПросто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</pre>', 'функции вашего контроллера', '<pre>\r\nПросто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</pre>', 'функции вашего контроллера', '<pre>\r\nПросто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллер</pre>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера П</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контролле</p>', 'функции вашего контроллера', 'функции вашего контроллерафункции вашего', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллераПросто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>\r\n\r\n<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллераПросто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>\r\n\r\n<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллераПросто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера&nbsp;</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'функции вашего контроллера', '<p>Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера Просто установите флэш-сообщение и перенаправьте его обратно с функции вашего контроллера</p>', 'Просто установите', '<p>Просто установитеПросто установите</p>', 'Просто установите', '<p>Просто установитеПросто установите</p>', 'Просто установите', '<p>Просто установитеПросто установите</p>', 'Просто установите', '<p>Просто установитеПросто установите</p>', 'Просто установите', '<p>Просто установитеПросто установите</p>', 'Просто установите', '<p>Просто установитеПросто установите</p>', '<p>Просто установитеПросто установите</p>', 'Просто установите', 'Просто установите', '<p>Просто установитеПросто установите</p>'),
(1, 6, 'spanish', 'Oficina FZE No 19 DAZ RAS AL KOR DUBAI - EAU PO BOX 63319', 'Realice un seguimiento de su dinero de un vistazo', '<pre>\r\nSimplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</pre>', '© 2020 Aplicación Balance. Todos los derechos reservados. Sitio de GCC-Marketing', 'Mensaje flash y redirija hacia', '<pre>\r\nSimplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</pre>', 'Mensaje flash y redirija hacia', '<pre>\r\nSimplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</pre>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Flash y redirija hacia', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>\r\n\r\n<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>\r\n\r\n<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>\r\n\r\n<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Mensaje flash y redirija hacia', '<p>Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador Simplemente configure el mensaje flash y redirija hacia atr&aacute;s desde la funci&oacute;n de su controlador</p>', 'Realice un seguimiento', '<p>Realice un seguimientoRealice un seguimiento</p>', 'Realice un seguimiento', '<p>Realice un seguimientoRealice un seguimiento</p>', 'Realice un seguimiento', '<p>Realice un seguimientoRealice un seguimiento</p>', 'Realice un seguimiento', '<p>Realice un seguimientoRealice un seguimiento</p>', 'Realice un seguimiento', '<p>Realice un seguimientoRealice un seguimiento</p>', 'Realice un seguimiento', '<p>Realice un seguimientoRealice un seguimiento</p>', '<p>Realice un seguimientoRealice un seguimiento</p>', 'Realice un seguimiento', 'Realice un seguimiento', '<p>Realice un seguimientoRealice un seguimiento</p>');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `introduction` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `cost` int(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `introduction`, `location`, `cost`, `created_at`, `updated_at`) VALUES
(12, 'ali', 'Software Engineer', 'SGD', 678, '2020-09-08 13:35:40', '2020-09-08 13:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort_order` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `baner` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `sort_order`, `image`, `baner`) VALUES
(14, 45803, '', ''),
(15, 69741, '', ''),
(16, 30031, '', ''),
(17, 9, '86264.jpg', '32291.jpg'),
(18, 9, '60704.png', '99664.png'),
(19, 2, '9414.png', '16656.jpg'),
(20, 6, '46963.png', '99600.jpg'),
(21, 6, '83914.png', '66039.jpg'),
(22, 6, '78231.png', '26911.jpg'),
(23, 6, '24089.png', '93459.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `slider_description`
--

CREATE TABLE `slider_description` (
  `slider_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` longtext DEFAULT NULL,
  `button_text` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider_description`
--

INSERT INTO `slider_description` (`slider_id`, `language_id`, `title`, `description`, `button_text`) VALUES
(18, 1, 'Meet the Balance App', '<p>Master your money with one easy app</p>', 'yui'),
(18, 2, 'إتقان أموالك باستخدام تطبيق واحد سهل', '<pre>\r\nإتقان أموالك باستخدام تطبيق واحد سهلإتقان أموالك باستخدام تطبيق واحد سهل</pre>', 'uiop'),
(18, 3, '通过一个简单的应用程', '<p>&nbsp;</p>\r\n\r\n<p>通过一个简单的应用程序掌握您的资金</p>', '通过一个简单的应用程序掌握您的资金'),
(18, 4, 'Maîtrisez votre argent avec une application simple', '<p>&nbsp;</p>\r\n\r\n<p>Ma&icirc;trisez votre argent avec une application simple</p>', 'Maîtrisez votre argent avec une application simple'),
(18, 5, 'Управляйте своими', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Управляйте своими деньгами с помощью одного простого приложения</p>', 'uio'),
(18, 6, 'Domine su dinero', '<p>&nbsp;</p>\r\n\r\n<p>Domine su dinero con una aplicaci&oacute;n sencilla</p>', 'yuio'),
(19, 1, 're', 'trew', 'hgre'),
(19, 2, 'yt', 'jhtr', 'htr'),
(19, 3, 'fdew', 'dew', 'fdew'),
(19, 4, 'jyt', 'jhtr', 'jhtr'),
(19, 5, 'hytr', 'ht', 'htr'),
(19, 6, 'yt', 'jhtr', 'fdewq'),
(20, 1, 'by  ali aslam', 'for text me', 'Some Here not'),
(20, 2, 'شكرا لكل هذا.', 'شكرا لكل هذا.', 'شكرا لكل هذا.'),
(20, 3, '感谢所有这些。', '感谢所有这些。', '感谢所有这些。'),
(20, 4, 'french', 'french', 'french'),
(20, 5, 'ryssub', 'ryssaajkl', 'russain'),
(20, 6, 'spaninsh', 'spaninsh', 'spaninsh'),
(21, 1, 'by  ali aslam', 'for text me', 'Some Here not'),
(21, 2, 'شكرا لكل هذا.', 'شكرا لكل هذا.', 'شكرا لكل هذا.'),
(21, 3, '感谢所有这些。', '感谢所有这些。', '感谢所有这些。'),
(21, 4, 'french', 'french', 'french'),
(21, 5, 'ryssub', 'ryssaajkl', 'russain'),
(21, 6, 'spaninsh', 'spaninsh', 'spaninsh'),
(22, 1, 'by  ali aslam', 'for text me', 'Some Here not'),
(22, 2, 'شكرا لكل هذا.', 'شكرا لكل هذا.', 'شكرا لكل هذا.'),
(22, 3, '感谢所有这些。', '感谢所有这些。', '感谢所有这些。'),
(22, 4, 'french', 'french', 'french'),
(22, 5, 'ryssub', 'ryssaajkl', 'russain'),
(22, 6, 'spaninsh', 'spaninsh', 'spaninsh'),
(23, 1, 'by me', 'by me', 'ly ji thk hy'),
(23, 2, 'شكرا لكل هذا.', 'شكرا لكل هذا.', 'شكرا لكل هذا.'),
(23, 3, '感谢所有这些。', '感谢所有这些。', '感谢所有这些。'),
(23, 4, 'french', 'french', 'french'),
(23, 5, 'ryssub', 'ryssaajkl', 'russain'),
(23, 6, 'spaninsh', 'spaninsh', 'spaninsh');

-- --------------------------------------------------------

--
-- Table structure for table `team_mates`
--

CREATE TABLE `team_mates` (
  `id` int(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `skype` varchar(250) NOT NULL,
  `linkedin` varchar(250) NOT NULL,
  `position` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_mates`
--

INSERT INTO `team_mates` (`id`, `name`, `email`, `phone`, `skype`, `linkedin`, `position`, `image`) VALUES
(3, 'JOHN DOE', 'john@gmail.com', '+92 307 6069760', 'www.kype.com', 'www.linkedin.com', 'Chief Executive Officer', '31508.png'),
(4, 'Qasim Ali', 'a@gmail.com', '+90 99999999', 'www.kype.com', 'www.linkedin.com', 'CEO', '31508.png'),
(5, 'Wasif Ali', 'wasif@gmail.com', '+92 307 6069760', 'www.kype.com', 'www.linkedin.com', 'Designer', '31508.png'),
(6, 'Arif', 'a@gmail.com', '9099999999', 'www.kype.com', 'www.linkedin.com', 'Programmer', '31508.png');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort_order` int(191) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `sort_order`, `image`) VALUES
(5, 0, '875.jpg'),
(7, 0, '5208.jpg'),
(8, 5, '83591.png'),
(9, 3, '33014.jpg'),
(10, 3, '49218.jpg'),
(11, 3, '30852.jpg'),
(12, 3, '64822.jpg'),
(15, 2, '35065.png'),
(16, 1, '15413.jpg'),
(17, 1, '40256.png'),
(18, 12, '44032.png');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_description`
--

CREATE TABLE `testimonial_description` (
  `testimonial_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `testimonial_name` varchar(250) NOT NULL,
  `designation` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonial_description`
--

INSERT INTO `testimonial_description` (`testimonial_id`, `language_id`, `testimonial_name`, `designation`, `description`) VALUES
(13, 1, 'Ghulam Ali', 'Ghulam Ali', 'Ghulam Ali'),
(13, 2, 'غلام علي', 'غلام علي', 'غلام علي'),
(13, 3, '古拉姆·阿里', '古拉姆·阿里', '古拉姆·阿里'),
(13, 4, 'Ghulam Ali', 'Ghulam Ali uos', 'Ghulam Ali'),
(13, 5, 'Гулам Али', 'Гулам Али', 'Гулам Али'),
(13, 6, 'Ghulam Ali', 'Ghulam Ali', 'Ghulam Ali'),
(14, 1, 'hj', 'ali', 'jk'),
(14, 2, 'jk', 'hjkl', 'jkl'),
(14, 3, 'huio', 'hio', 'yui'),
(14, 4, 'ho', 'hui', 'hui'),
(14, 5, 'hj', 'huio', 'hyui'),
(14, 6, 'hj', 'huio', 'y8'),
(15, 1, 'Mr. ABC', 'Mr. ABC', '<p>Message and redirect to all.</p>'),
(15, 2, 'بواسطةتطبيق', 'بواسطةتطبيق', '<p>بواسطةتطبيقبواسطةتطبيق</p>'),
(15, 3, '网站按', '网站', '<p>网站按海湾合作委员会营销</p>'),
(15, 4, 'Définir le', 'Définir le', '<p>Il suffit de d&eacute;finir le message flash et de</p>'),
(15, 5, 'Просто установите', 'Просто установите', '<p>Просто установитеПросто установите</p>'),
(15, 6, 'Redirija hacia', 'Redirija hacia', '<p>Mensaje flash y redirija hacia</p>'),
(17, 1, 'Mr. ABC', 'Struggle is the key of success', '<p>Struggle is the key of success</p>'),
(17, 2, 'شكرا.', 'شكرا.', '<p>شكرا لكل هذا.شكرا لكل هذا.</p>'),
(17, 3, '感谢所有这些。', '感谢所有这些。', '<p>感谢所有这些</p>'),
(17, 4, 'De définir', 'Rediriger vers', '<p>Et de rediriger vers</p>'),
(17, 5, 'флэш-сообщение', 'флэш-сообщение', '<p>сообщение&nbsp;флэш</p>'),
(17, 6, 'Mensaje', 'Mensaje flash', '<p>Redirija hacia</p>'),
(18, 1, 'Mr. ABC', 'Mr. ABC', '<p>Best off all</p>'),
(18, 2, 'هذا.', 'هذا.', '<p>&nbsp;هذا.شكرا ل</p>'),
(18, 3, '感谢所', '感谢所', '<p>感谢所有这些。</p>'),
(18, 4, 'Flash et de', 'Flash et de', '<p>&nbsp; Flash et de</p>'),
(18, 5, 'контроллераIl', 'контроллераIl', '<p>функции вашего</p>'),
(18, 6, 'Hacia', 'Hacia', '<p>HaciaHacia</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@admin.com', NULL, '$2y$10$r6EjyyJkeQ1pSpBH8aQiL.IkIF.AF3JbUfDpuENaCjX67bOtiEFia', NULL, '2020-11-29 04:56:24', '2021-01-03 07:25:32'),
(4, 'ali', 'a@gmail.com', NULL, '$2y$10$yvlzeWfWUBOfzUkEaH8gMeTCVy5slDJmLbJpv.b9nFdCEksDcukPy', NULL, '2021-01-03 04:17:23', '2021-01-03 04:18:02'),
(5, 'Qasim Ali', 'test@gmail.com', NULL, '$2y$10$UbdCn45IlqfyGLXRw.yG8ee0IYq7/jTCy643uV8jOF1Ln8PsrO1Wi', NULL, '2021-01-03 07:24:20', '2021-01-03 07:24:20'),
(6, 'ali', 'ab@gmail.com', NULL, '$2y$10$hFX1fZVWscCtdxQRAP80wOKyDPIH1vHd6kEkUN4jVxWKPpt.wE6qC', NULL, '2021-01-03 11:33:51', '2021-01-03 11:33:51'),
(8, 'ali', 'abc@gmail.com', NULL, '$2y$10$16XGsJUkF/0Rtk3M5FV60uuFAechTgLMqFF4HBYBtD8YpHWEfxSxW', NULL, '2021-01-03 11:36:04', '2021-01-03 11:36:04'),
(9, 'ali', 'abd@gmail.com', NULL, '$2y$10$XRUNmIkdXrzmkvZwoDxGa.Pmn6eocIcyZ3AvNivgSuC0TlNSTtV2u', NULL, '2021-01-03 11:52:35', '2021-01-03 11:52:35'),
(10, 'waqas', 'waqas@gmail.com', NULL, '$2y$10$r6EjyyJkeQ1pSpBH8aQiL.IkIF.AF3JbUfDpuENaCjX67bOtiEFia', NULL, '2021-01-04 09:22:32', '2021-01-04 09:22:32'),
(11, 'final test', 'final@final.com', NULL, '$2y$10$oiAxm/7MSP8FTgxU1ClNWuMbY/83Vi5KJsKVJlKtWXya22OD8arWG', NULL, '2021-01-04 12:01:19', '2021-01-04 12:01:19'),
(12, 'debate', 'debate@final.com', NULL, '$2y$10$ehVxetgizq5YBLrhJ6Ln9uvZwtXCQAM/.cNz7mcR5os6eN7anE/lO', NULL, '2021-01-05 01:04:25', '2021-01-05 01:04:25'),
(14, 'bbb', 'deb@final.com', NULL, '$2y$10$9cFpWy5aWslO6V84r3IlLONPrBg5ga.E6H2xvcZHSBUs336AnTAKC', NULL, '2021-01-05 01:06:46', '2021-01-05 01:06:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_description`
--
ALTER TABLE `category_description`
  ADD PRIMARY KEY (`category_id`,`language_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_description`
--
ALTER TABLE `faq_description`
  ADD PRIMARY KEY (`faq_id`,`language_id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_description`
--
ALTER TABLE `feature_description`
  ADD PRIMARY KEY (`feature_id`,`language_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `name`
--
ALTER TABLE `name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_description`
--
ALTER TABLE `pages_description`
  ADD PRIMARY KEY (`page_id`,`language_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences_descriptions`
--
ALTER TABLE `preferences_descriptions`
  ADD PRIMARY KEY (`preference_id`,`language_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_description`
--
ALTER TABLE `slider_description`
  ADD PRIMARY KEY (`slider_id`,`language_id`);

--
-- Indexes for table `team_mates`
--
ALTER TABLE `team_mates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_description`
--
ALTER TABLE `testimonial_description`
  ADD PRIMARY KEY (`testimonial_id`,`language_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `name`
--
ALTER TABLE `name`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages_description`
--
ALTER TABLE `pages_description`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `team_mates`
--
ALTER TABLE `team_mates`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
