-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: mysql.crystalsky.co.il
-- Generation Time: May 21, 2016 at 12:23 PM
-- Server version: 5.6.25-log
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csjewelrydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesslog`
--

CREATE TABLE `businesslog` (
  `id` bigint(20) NOT NULL,
  `datex` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alert_type` varchar(100) NOT NULL,
  `ip_addr` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `the_info` longtext NOT NULL,
  `the_page` varchar(200) DEFAULT NULL,
  `the_country` varchar(50) DEFAULT NULL,
  `the_city` varchar(50) DEFAULT NULL,
  `the_region` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businesslog`
--

INSERT INTO `businesslog` (`id`, `datex`, `alert_type`, `ip_addr`, `email`, `the_info`, `the_page`, `the_country`, `the_city`, `the_region`) VALUES
(7, '2016-05-11 06:44:49', 'SEND_CONTACT_MSG', '46.116.198.51', 'irena.alexandrovich@yandex.ru', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>11-05-2016 06:44:49</b><br/>Имя отправителя сообщения: <b>Ирина</b><br/>Фамилия отправителя сообщения: <b>Александрович</b><br/>Тема сообщения: <b>Ирина Ивановна, пожалуйста</b><br/>Сообщение: <b>Ирина Ивановна, пожалуйста напишите мне. спасибо!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(8, '2016-05-11 06:48:15', 'SEND_CONTACT_MSG', '46.116.198.51', 'ivan.ivanov@yandex.ru', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>11-05-2016 06:48:15</b><br/>Имя отправителя сообщения: <b>Иван</b><br/>Фамилия отправителя сообщения: <b>Иванов</b><br/>Тема сообщения: <b>Проверка контактной формы</b><br/>Сообщение: <b>Проверка сообщения контактной формы. Раз два три четыре пять шесть... :)</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(9, '2016-05-11 07:09:48', 'SEND_CONTACT_MSG', '46.116.198.51', 'idontknow@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>11-05-2016 07:09:48</b><br/>Имя отправителя сообщения: <b>Коко</b><br/>Фамилия отправителя сообщения: <b>Шанель</b><br/>Тема сообщения: <b>Коко Шанель: интервью   фильм</b><br/>Сообщение: <b>Коко Шанель, интервью французскому телевидению1969 г.\nhttps://www.youtube.com/watch?v=YUqVBEC2EFM\n\nфильм - Коко до Шанель 2009\nhttps://www.yo</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(10, '2016-05-11 07:18:44', 'SEND_CONTACT_MSG', '46.116.198.51', 'idontknow@yandex.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>11-05-2016 07:18:44</b><br/>Имя отправителя сообщения: <b>Коко</b><br/>Фамилия отправителя сообщения: <b>Шанель</b><br/>Тема сообщения: <b>Коко Шанель: интервью   фильм</b><br/>Сообщение: <b>Коко Шанель, интервью французскому телевидению1969 г.\nhttps://www.youtube.com/watch?v=YUqVBEC2EFM\n\nФильм Коко до Шанель 2009 смотреть онлайн бесплатно Coco avant Chanel\nhttps://www.youtube.com/watch?v=vk53SUEjW44\n\nСериал Коко Шанель (Coco Chanel) - 4 серии\nhttp://www.online-life.cc/5990-koko-shan</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(11, '2016-05-12 19:05:52', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:05:52</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Тема сообщения: <b>Тестовое сообщение</b><br/>Сообщение: <b>Тестовое сообщение # Тестовое сообщение # Тестовое сообщение </b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(12, '2016-05-12 19:11:45', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yandex.ru', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:11:45</b><br/>Имя отправителя сообщения: <b>peter</b><br/>Фамилия отправителя сообщения: <b>petrov</b><br/>Тема сообщения: <b>test theme</b><br/>Сообщение: <b>мое сообщение мое сообщение</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(13, '2016-05-12 19:13:03', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.sidorov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:13:03</b><br/>Имя отправителя сообщения: <b>peter</b><br/>Фамилия отправителя сообщения: <b>sidorov</b><br/>Тема сообщения: <b>это тестовое сообщение</b><br/>Сообщение: <b>тест # тест # тест # это тест</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(14, '2016-05-12 19:14:24', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yandex.ru', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:14:24</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Тема сообщения: <b>Тестовое сообщение</b><br/>Сообщение: <b>тесто вое сообщение # тестовое сообщение</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(15, '2016-05-12 19:15:33', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:15:33</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Тема сообщения: <b>это тестовое сообщение</b><br/>Сообщение: <b>это тест # это тест  # это тест </b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(16, '2016-05-12 19:22:05', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:22:05</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Тема сообщения: <b>Тестовое сообщение</b><br/>Сообщение: <b>Тест сообщение # Тест сообщение  # Тест сообщение</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(17, '2016-05-12 19:26:49', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:26:49</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Email отправителя сообщения: <b>peter.petrov@yahoo.com</b><br/>Тема сообщения: <b>Это тестовое сообщение </b><br/>Сообщение: <b>Это тестовое сообщение ; Это тестовое сообщение ; Это тестовое сообщение ; Это тестовое сообщение  :)</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(18, '2016-05-12 19:28:45', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@gmail.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:28:45</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Email отправителя сообщения: <b>peter.petrov@gmail.com</b><br/>Тема сообщения: <b>это тестовое сообщение</b><br/>Сообщение: <b>это тестовое сообщение | это тестовое сообщение | это тестовое сообщение</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(19, '2016-05-13 02:00:31', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'irina@somewhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>13-05-2016 02:00:31</b><br/>Имя отправителя отзыва: <b>Ирина</b><br/>Email отправителя отзыва: <b>irina@somewhere.net</b><br/>Тема отзыва: <b>Спасибо!!!</b><br/>Отзыв: <b>Спасибо!!!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(20, '2016-05-13 02:05:59', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'irina@somewhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>13-05-2016 02:05:59</b><br/>Имя отправителя отзыва: <b>Ирина</b><br/>Email отправителя отзыва: <b>irina@somewhere.net</b><br/>Город отправителя отзыва: <b>Нижне-Вилюйск</b><br/>Тема отзыва: <b>Спасибо за то что вы</b><br/>Отзыв: <b>Спасибо за то что вы есть...</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(21, '2016-05-13 02:15:42', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'irina@somewhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>13-05-2016 02:15:42</b><br/>Имя отправителя отзыва: <b>Ирина</b><br/>Email отправителя отзыва: <b>irina@somewhere.net</b><br/>Город отправителя отзыва: <b>Москва</b><br/>Тема отзыва: <b>Спасибо!!!</b><br/>Отзыв: <b>Спасибо!!!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(22, '2016-05-13 02:22:04', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'ivan@somewhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>13-05-2016 02:22:04</b><br/>Имя отправителя отзыва: <b>Иван</b><br/>Email отправителя отзыва: <b>ivan@somewhere.net</b><br/>Город отправителя отзыва: <b>Нижне-Вилюйск</b><br/>Тема отзыва: <b>Все просто круто!</b><br/>Отзыв: <b>Все просто круто!</b><br/>Отзыв будет опубликован на сайте после проверки администратором.</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(23, '2016-05-13 10:23:13', 'ORDER_FROM_SITE', '46.116.198.51', 'test@test0123.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Новый заказ с сайта Crystalsky.co.il!<br/><br/>Дата заказа: <b>13-05-2016 10:23:13</b><br/>Наименование товара: <b>Сапфировый набор</b><br/>Изображение товара: <b> <img src="app_data/app_images/product_1_1.jpg"></b><br/>Артикул товара: <b>808081</b><br/>Цена товара: <b>250.00</b><br/>Имя заказчика: <b>SomeOne</b><br/>Фамилия заказчика: <b>SomeOne2</b><br/>Email заказчика: <b>test@test0123.net</b><br/>Страна заказчика: <b></b><br/>Адрес заказчика: <b></b><br/>Почтовый индекс заказчика: <b></b><br/>Телефон заказчика: <b>app_data/app_images/product_1_1.jpg</b><br/>Примечание к заказу: <b></b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(24, '2016-05-13 10:28:11', 'ORDER_FROM_SITE', '46.116.198.51', 'pavel.pavlov@yandex.ru', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Новый заказ с сайта Crystalsky.co.il!<br/><br/>Дата заказа: <b>13-05-2016 10:28:11</b><br/>Наименование товара: <b>Красивый набор</b><br/>Изображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_3_1.jpg"></b><br/>Артикул товара: <b>808085</b><br/>Цена товара: <b>340.00</b><br/>Имя заказчика: <b>Иван</b><br/>Фамилия заказчика: <b>Павлов</b><br/>Email заказчика: <b>pavel.pavlov@yandex.ru</b><br/>Страна заказчика: <b>Россия</b><br/>Адрес заказчика: <b>Москва, Шаболовка 37</b><br/>Почтовый индекс заказчика: <b>127000</b><br/>Телефон заказчика: <b>072-1827382193213</b><br/>Примечание к заказу: <b>никаких примечаний. только замечания!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(25, '2016-05-13 10:37:04', 'ORDER_FROM_SITE', '46.116.198.51', 'somewher@someowen.met', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Новый заказ с сайта Crystalsky.co.il!<br/><br/>Дата заказа: <b>13-05-2016 10:37:04</b><br/>Наименование товара: <b>Сапфировый набор</b><br/>Изображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_1_1.jpg width=300 "></b><br/>Артикул товара: <b>808081</b><br/>Цена товара: <b>250.00</b><br/>Имя заказчика: <b>Зия</b><br/>Фамилия заказчика: <b>Ульхак</b><br/>Email заказчика: <b>somewher@someowen.met</b><br/>Страна заказчика: <b></b><br/>Адрес заказчика: <b>справа</b><br/>Почтовый индекс заказчика: <b></b><br/>Телефон заказчика: <b>1232-1234124134</b><br/>Примечание к заказу: <b></b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(26, '2016-05-13 10:39:23', 'ORDER_FROM_SITE', '46.116.198.51', 'test@test.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Новый заказ с сайта Crystalsky.co.il!<br/><br/>Дата заказа: <b>13-05-2016 10:39:23</b><br/>Наименование товара: <b>Сапфировый набор</b><br/>Изображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_1_1.jpg" width=300 ></b><br/>Артикул товара: <b>808081</b><br/>Цена товара: <b>250.00</b><br/>Имя заказчика: <b>Test name</b><br/>Фамилия заказчика: <b>Test lastnamt</b><br/>Email заказчика: <b>test@test.net</b><br/>Страна заказчика: <b></b><br/>Адрес заказчика: <b></b><br/>Почтовый индекс заказчика: <b></b><br/>Телефон заказчика: <b>1232-1234124134</b><br/>Примечание к заказу: <b></b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(27, '2016-05-13 11:43:42', 'ORDER_FROM_SITE', '46.116.198.51', 'ivan.ivanov@yandex.ru', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Новый заказ с сайта Crystalsky.co.il!<br/><br/>Дата заказа: <b>13-05-2016 11:43:42</b><br/>Наименование товара: <b>Красивый набор</b><br/>Изображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_3_1.jpg" width=300 ></b><br/>Артикул товара: <b>808085</b><br/>Цена товара: <b>340.00</b><br/>Имя заказчика: <b>Иван</b><br/>Фамилия заказчика: <b>Иванов</b><br/>Email заказчика: <b>ivan.ivanov@yandex.ru</b><br/>Страна заказчика: <b></b><br/>Адрес заказчика: <b></b><br/>Почтовый индекс заказчика: <b></b><br/>Телефон заказчика: <b>09522222</b><br/>Примечание к заказу: <b></b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(28, '2016-05-13 12:09:41', 'ORDER_FROM_SITE', '46.116.198.51', 'neznayu@mymail.ru', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Новый заказ с сайта Crystalsky.co.il!<br/><br/>Дата заказа: <b>13-05-2016 12:09:41</b><br/>Наименование товара: <b>Набор с цирконием</b><br/>Изображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_2_1.jpg" width=300 ></b><br/>Артикул товара: <b>808090</b><br/>Цена товара: <b>320.00</b><br/>Имя заказчика: <b>Иван</b><br/>Фамилия заказчика: <b>Иванов</b><br/>Email заказчика: <b>neznayu@mymail.ru</b><br/>Страна заказчика: <b>Россия</b><br/>Адрес заказчика: <b>ул Королева 12</b><br/>Почтовый индекс заказчика: <b>127000</b><br/>Телефон заказчика: <b>495</b><br/>Примечание к заказу: <b>ничего не знаю....</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(29, '2016-05-13 12:14:29', 'ORDER_FROM_SITE', '46.116.198.51', 'ivan.ivanov@walla.co.il', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Новый заказ с сайта Crystalsky.co.il!<br/><br/>Дата заказа: <b>13-05-2016 12:14:29</b><br/>Наименование товара: <b>Сапфировый набор</b><br/>Изображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_1_1.jpg" width=300 ></b><br/>Артикул товара: <b>808081</b><br/>Цена товара: <b>250.00</b><br/>Имя заказчика: <b>Иван</b><br/>Фамилия заказчика: <b>Иванов</b><br/>Email заказчика: <b>ivan.ivanov@walla.co.il</b><br/>Страна заказчика: <b>Израиль</b><br/>Адрес заказчика: <b>ул. Эхад А Ам, 123</b><br/>Почтовый индекс заказчика: <b>123456</b><br/>Телефон заказчика: <b>057</b><br/>Примечание к заказу: <b>какой прекрасный набор... супер!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(30, '2016-05-13 12:19:52', 'ORDER_FROM_SITE', '46.116.198.51', 'alla.pugacheva@neskagu.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Новый заказ с сайта Crystalsky.co.il!<br/><br/>Дата заказа: <b>13-05-2016 12:19:52</b><br/>Наименование товара: <b>Красивый набор</b><br/>Изображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_3_1.jpg" width=300 ></b><br/>Артикул товара: <b>808085</b><br/>Цена товара: <b>340.00</b><br/>Имя заказчика: <b>Алла</b><br/>Фамилия заказчика: <b>Пугачева</b><br/>Email заказчика: <b>alla.pugacheva@neskagu.net</b><br/>Страна заказчика: <b>Россия</b><br/>Адрес заказчика: <b>Московская область, Одинцовский р-он, дер. Грязь, дом 16</b><br/>Почтовый индекс заказчика: <b>143057</b><br/>Телефон заказчика: <b>ха...</b><br/>Примечание к заказу: <b>какой очаровательный наборЧИК!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(31, '2016-05-13 12:29:26', 'ORDER_FROM_SITE', '46.116.198.51', 'test@test.co.il', '<html><body>Здравствуйте, Crystalsky!<br/><br/> \r\nНовый заказ с сайта Crystalsky.co.il!<br/><br/> \r\nДата заказа: <b>13-05-2016 12:29:26</b><br/> \r\nНаименование товара: <b>Сапфировый набор</b><br/> \r\nИзображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_1_1.jpg" width=300 ></b><br/>Артикул товара: <b>808081</b><br/> \r\nЦена товара: <b>250.00</b><br/> \r\nИмя заказчика: <b>Зия</b><br/> \r\nФамилия заказчика: <b>Ульхак</b><br/> \r\nEmail заказчика: <b>test@test.co.il</b><br/> \r\nСтрана заказчика: <b>Мозамбик</b><br/> \r\nАдрес заказчика: <b>Москва, Шаболовка 37</b><br/> \r\nПочтовый индекс заказчика: <b>123456</b><br/> \r\nТелефон заказчика: <b>1923-120349-1232</b><br/> \r\nПримечание к заказу: <b>ddddddddddddddddddd нет нет нет нет </b><br/><br/> \r\nС уважением,  <br/> \r\nАдминистрация.</body></html>', '', NULL, NULL, NULL),
(32, '2016-05-13 12:33:36', 'ORDER_FROM_SITE', '46.116.198.51', 'gfdsgfsd@fdgdfsgs.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый заказ с сайта Crystalsky.co.il!<br/><br/> \nДата заказа: <b>13-05-2016 12:33:36</b><br/> \nНаименование товара: <b>Сапфировый набор</b><br/>\nИзображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_1_1.jpg" width=300 ></b><br/>Артикул товара: <b>808081</b><br/> \nЦена товара: <b>250.00</b><br/> \nИмя заказчика: <b>yrerdfsgsdgf</b><br/> \nФамилия заказчика: <b>sdfgsdfgsdfg</b><br/> \nEmail заказчика: <b>gfdsgfsd@fdgdfsgs.net</b><br/> \nСтрана заказчика: <b></b><br/> \nАдрес заказчика: <b>sdfgsdfgdsfgsdfg</b><br/> \nПочтовый индекс заказчика: <b>dsfgdsfgdfsg</b><br/> \nТелефон заказчика: <b>2324141234123</b><br/> \nПримечание к заказу: <b>adsfasdfas</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', NULL, NULL, NULL),
(33, '2016-05-13 13:45:12', 'ORDER_FROM_SITE', '46.116.198.51', 'ivan.ivanov@yahoo.com', '<html><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый заказ с сайта Crystalsky.co.il!<br/><br/> \nДата заказа: <b>13-05-2016 13:45:12</b><br/> \nНаименование товара: <b>Красивый набор</b><br/>\nИзображение товара: <b> <img src="http://crystalsky.co.il/app_data/app_images/product_3_1.jpg" width=300 ></b><br/>Артикул товара: <b>808085</b><br/> \nЦена товара: <b>340.00</b><br/> \nИмя заказчика: <b>Иван</b><br/> \nФамилия заказчика: <b>Иванов</b><br/> \nEmail заказчика: <b>ivan.ivanov@yahoo.com</b><br/> \nСтрана заказчика: <b></b><br/> \nАдрес заказчика: <b></b><br/> \nПочтовый индекс заказчика: <b></b><br/> \nТелефон заказчика: <b>058</b><br/> \nПримечание к заказу: <b>в общем все понятно в общем все понятно в общем все понятно в общем все понятно в общем все понятно в общем все понятно в общем все понятно</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', NULL, NULL, NULL),
(34, '2016-05-15 11:26:23', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'ilana@nowhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>15-05-2016 11:26:23</b><br/>Имя отправителя отзыва: <b>Илана</b><br/>Email отправителя отзыва: <b>ilana@nowhere.net</b><br/>Город отправителя отзыва: <b>Афула</b><br/>Тема отзыва: <b>Влюбилась в кулончик из-за красивых</b><br/>Отзыв: <b>Влюбилась в кулончик из-за красивых переплетений в виде цветов. Размер у кулона небольшой. Проба стоит, как на самом сердце, так и на замке цепочки - 925, говорят, что не темнеет и после полугода. Хотя все мы знаем, что любое серебро со временем надо чистить. Вот такие пироги, дорогие мои.</b><br/>Отзыв будет опубликован на сайте после проверки администратором.</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(50, '2016-05-17 01:48:50', 'SEND_ADMIN_CONTACT_MSG', '', 'ivan.ivanov@yandex.ru', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение со страницы управления сайтом Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>17-05-2016 01:48:50</b><br/>Имя отправителя сообщения: <b>rewt</b><br/>Email отправителя сообщения: <b>ivan.ivanov@yandex.ru</b><br/>Тема сообщения: <b></b><br/>Сообщение: <b>afadsfdf </b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(51, '2016-05-17 01:51:47', 'SEND_ADMIN_CONTACT_MSG', '', 'ilana.goldin@yahoo.ru', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение со страницы управления сайтом Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>17-05-2016 01:51:47</b><br/>Имя отправителя сообщения: <b>Илана</b><br/>Email отправителя сообщения: <b>ilana.goldin@yahoo.ru</b><br/>Сообщение: <b>Это тест Это тест</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(52, '2016-05-17 02:09:00', 'SEND_ADMIN_CONTACT_MSG', '', 'ilana.test@yahoo.com', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение со страницы управления сайтом Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>17-05-2016 02:09:00</b><br/>Имя отправителя сообщения: <b>Илана</b><br/>Email отправителя сообщения: <b>ilana.test@yahoo.com</b><br/>Сообщение: <b>Это тестовое сообщение, отправленное с панели управления сайтом CrystalSky</b><br/><br/>С уважением,  <br/>Администрация.</body></html>', '', NULL, NULL, NULL),
(214, '2016-05-19 10:59:23', 'LOGIN', '37.26.149.195', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>19-05-2016 10:59:23</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=37.26.149.195" target="_blank"><b>37.26.149.195</b></a><br/> \nОперационная система: <b>Android</b><br/> \nБраузер: <b>Handheld Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(215, '2016-05-19 11:42:23', 'LOGIN', '37.26.149.195', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>19-05-2016 11:42:23</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=37.26.149.195" target="_blank"><b>37.26.149.195</b></a><br/> \nОперационная система: <b>Android</b><br/> \nБраузер: <b>Handheld Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(216, '2016-05-19 12:23:40', 'LOGIN', '66.249.66.131', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>19-05-2016 12:23:40</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.66.131" target="_blank"><b>66.249.66.131</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(217, '2016-05-19 14:22:03', 'LOGIN', '66.249.66.187', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>19-05-2016 14:22:03</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.66.187" target="_blank"><b>66.249.66.187</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(249, '2016-05-19 22:15:28', 'LOGIN', '66.249.69.32', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>19-05-2016 22:15:28</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.69.32" target="_blank"><b>66.249.69.32</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(250, '2016-05-20 00:58:56', 'LOGIN', '66.249.64.194', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>20-05-2016 00:58:56</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.64.194" target="_blank"><b>66.249.64.194</b></a><br/> \nОперационная система: <b>Android</b><br/> \nБраузер: <b>Handheld Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(252, '2016-05-20 04:11:12', 'LOGIN', '157.55.39.0', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>20-05-2016 04:11:12</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=157.55.39.0" target="_blank"><b>157.55.39.0</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(257, '2016-05-20 10:31:46', 'LOGIN', '66.249.69.32', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>20-05-2016 10:31:46</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.69.32" target="_blank"><b>66.249.69.32</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(258, '2016-05-20 23:53:44', 'LOGIN', '66.249.64.189', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>20-05-2016 23:53:44</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.64.189" target="_blank"><b>66.249.64.189</b></a><br/> \nОперационная система: <b>Android</b><br/> \nБраузер: <b>Handheld Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(345, '2016-05-21 14:44:02', 'LOGIN', '66.249.64.194', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 14:44:02</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.64.194" target="_blank"><b>66.249.64.194</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(462, '2016-05-21 19:02:19', 'LOGIN', '66.249.66.131', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 19:02:19</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.66.131" target="_blank"><b>66.249.66.131</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(464, '2016-05-21 19:07:38', 'LOGIN', '66.249.66.131', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 19:07:38</b><br/> \nСтраница посещения: <b>item.php?i=77</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.66.131" target="_blank"><b>66.249.66.131</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=77', '', '', ''),
(465, '2016-05-21 19:08:04', 'LOGIN', '66.249.66.187', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 19:08:04</b><br/> \nСтраница посещения: <b>item.php?i=76</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.66.187" target="_blank"><b>66.249.66.187</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=76', '', '', ''),
(466, '2016-05-21 19:08:32', 'LOGIN', '66.249.66.187', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 19:08:32</b><br/> \nСтраница посещения: <b>item.php?i=79</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.66.187" target="_blank"><b>66.249.66.187</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=79', '', '', ''),
(468, '2016-05-21 19:09:03', 'LOGIN', '66.249.66.190', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 19:09:03</b><br/> \nСтраница посещения: <b>item.php?i=78</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=66.249.66.190" target="_blank"><b>66.249.66.190</b></a><br/> \nОперационная система: <b>Unknown OS Platform</b><br/> \nБраузер: <b>Unknown Browser</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=78', '', '', ''),
(588, '2016-05-21 21:25:03', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:25:03</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(589, '2016-05-21 21:25:53', 'UPDATE_PRODUCT', '89.139.184.4', 'support@crystalsky.co.il', '<html><body>Здравствуйте, Crystalsky!<br/><br/> \nПродукт был изменен с панели управления Crystalsky.co.il!<br/><br/> \nДата изменения: <b>21-05-2016 21:25:53</b><br/> \nID товара, который был изменен: <a href="http://crystalsky.co.il/item.php?i=79" target="_blank"><b>79</b></a><br/>\nМакат: <b>E199B23</b><br/> \nНаименование: <b>Элегантное ожерелье</b><br/> \n<br/>С уважением,  <br/> \nАдминистрация.</body></html>', NULL, NULL, NULL, NULL),
(590, '2016-05-21 21:25:55', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:25:55</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(591, '2016-05-21 21:26:03', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:26:03</b><br/> \nСтраница посещения: <b>item.php?i=79</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=79', '', '', ''),
(592, '2016-05-21 21:26:31', 'UPDATE_PRODUCT', '89.139.184.4', 'support@crystalsky.co.il', '<html><body>Здравствуйте, Crystalsky!<br/><br/> \nПродукт был изменен с панели управления Crystalsky.co.il!<br/><br/> \nДата изменения: <b>21-05-2016 21:26:31</b><br/> \nID товара, который был изменен: <a href="http://crystalsky.co.il/item.php?i=79" target="_blank"><b>79</b></a><br/>\nМакат: <b>E199B23</b><br/> \nНаименование: <b>Элегантное ожерелье</b><br/> \n<br/>С уважением,  <br/> \nАдминистрация.</body></html>', NULL, NULL, NULL, NULL),
(593, '2016-05-21 21:27:34', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:27:34</b><br/> \nСтраница посещения: <b>item.php?i=1</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=1', '', '', ''),
(594, '2016-05-21 21:29:06', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:29:06</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', ''),
(595, '2016-05-21 21:29:11', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:29:11</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', ''),
(596, '2016-05-21 21:29:15', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:29:15</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', ''),
(597, '2016-05-21 21:29:25', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:29:25</b><br/> \nСтраница посещения: <b>basket.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php', '', '', ''),
(598, '2016-05-21 21:29:53', 'ORDER_FROM_SITE', '89.139.184.4', 'ilan@test.co.il', '<html><head><title>Новый заказ с сайта Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый заказ с сайта Crystalsky.co.il!<br/><br/> \nДата заказа: <b>21-05-2016 21:29:53</b><br/> \n<br/><table border="1">\n<thead>\n<tr>\n<th colspan="2">Товар</th> \n<th>Кол-во</th>\n<th>Цена</th>\n<th colspan="2">Итого</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td style="vertical-align: middle">\n<a href="http://crystalsky.co.il/item.php?i=79?>#come_here" target="_blank">\n<img border="0" src="http://crystalsky.co.il/app_data/app_images/20160521_171447_517961_img_06_09_1.jpg" alt="Элегантное ожерелье" width="50">\n</a>\n</td>\n<td style="vertical-align: middle"><a href="http://crystalsky.co.il/item.php?i=79" target="_blank">Элегантное ожерелье; [makat=E199B23]</a>\n</td>\n<td style="vertical-align: middle">\n<input name="0" id="0" value="1" class="form-control" style="width: 50px; text-align: right;">\n</td>\n<td style="vertical-align: middle; text-align:right">49.99 шек.</td> \n<td colspan="2" style="vertical-align: middle; text-align:right">49.99 шек.</td>\n</tr>\n<tr>\n<td style="vertical-align: middle">\nКупон\n</td>\n<td colspan="3" style="vertical-align: middle">\n<table>\n<tr>\n<td>\nHAPPY2017\n</td>\n<td style="padding:10px; width:350px">\n<small>Скидка 5%</small>\n</td>\n<tr>\n</table>\n</td>\n<td colspan="2" style="vertical-align: middle; text-align:right"><span style="color:green">- 2.50 шек.</span></td>\n</tr>\n</tbody>\n<tfoot>\n<tr>\n<th colspan="4">Итого</th>\n<th colspan="2" style="text-align:right">47.49 шек.</th>\n</tr>\n</tfoot>\n</table><br/>\n\nИмя заказчика: <b>Илан</b><br/> \nФамилия заказчика: <b>Илан</b><br/> \nEmail заказчика: <b>ilan@test.co.il</b><br/> \nСтрана заказчика: <b>Израиль</b><br/> \nАдрес заказчика: <b>Ришон</b><br/> \nПочтовый индекс заказчика: <b>7839474</b><br/> \nТелефон заказчика: <b>97473832</b><br/> \nПримечание к заказу: <b>Буду рад!</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', NULL, NULL, NULL, NULL),
(599, '2016-05-21 21:29:56', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:29:56</b><br/> \nСтраница посещения: <b>basket.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php', '', '', ''),
(600, '2016-05-21 21:30:06', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:30:06</b><br/> \nСтраница посещения: <b>item.php?i=79?%3E</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=79?%3E', '', '', ''),
(601, '2016-05-21 21:30:21', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:30:21</b><br/> \nСтраница посещения: <b>item.php?i=79?%3E</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=79?%3E', '', '', ''),
(602, '2016-05-21 21:34:24', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:34:24</b><br/> \nСтраница посещения: <b>index.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'index.php', '', '', ''),
(603, '2016-05-21 21:34:37', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:34:37</b><br/> \nСтраница посещения: <b>item.php?i=79</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=79', '', '', ''),
(604, '2016-05-21 21:34:40', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:34:40</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', ''),
(605, '2016-05-21 21:34:42', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:34:42</b><br/> \nСтраница посещения: <b>basket.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php', '', '', ''),
(606, '2016-05-21 21:35:13', 'ORDER_FROM_SITE', '89.139.184.4', 'vovan@mail.ru', '<html><head><title>Новый заказ с сайта Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый заказ с сайта Crystalsky.co.il!<br/><br/> \nДата заказа: <b>21-05-2016 21:35:13</b><br/> \n<br/><table border="1">\n<thead>\n<tr>\n<th colspan="2">Товар</th> \n<th>Кол-во</th>\n<th>Цена</th>\n<th colspan="2">Итого</th>\n</tr>\n</thead>\n<tbody>\n<tr>\n<td style="vertical-align: middle">\n<a href="http://crystalsky.co.il/item.php?i=79#come_here" target="_blank">\n<img border="0" src="http://crystalsky.co.il/app_data/app_images/20160521_171447_517961_img_06_09_1.jpg" alt="Элегантное ожерелье" width="50">\n</a>\n</td>\n<td style="vertical-align: middle"><a href="http://crystalsky.co.il/item.php?i=79" target="_blank">Элегантное ожерелье; [makat=E199B23]</a>\n</td>\n<td style="vertical-align: middle">\n<input name="0" id="0" value="1" class="form-control" style="width: 50px; text-align: right;">\n</td>\n<td style="vertical-align: middle; text-align:right">49.99 шек.</td> \n<td colspan="2" style="vertical-align: middle; text-align:right">49.99 шек.</td>\n</tr>\n<tr>\n<td style="vertical-align: middle">\nКупон\n</td>\n<td colspan="3" style="vertical-align: middle">\n<table>\n<tr>\n<td>\nHAPPY2017\n</td>\n<td style="padding:10px; width:350px">\n<small>Скидка 5%</small>\n</td>\n<tr>\n</table>\n</td>\n<td colspan="2" style="vertical-align: middle; text-align:right"><span style="color:green">- 2.50 шек.</span></td>\n</tr>\n</tbody>\n<tfoot>\n<tr>\n<th colspan="4">Итого</th>\n<th colspan="2" style="text-align:right">47.49 шек.</th>\n</tr>\n</tfoot>\n</table><br/>\n\nИмя заказчика: <b>Вован</b><br/> \nФамилия заказчика: <b>Вован</b><br/> \nEmail заказчика: <b>vovan@mail.ru</b><br/> \nСтрана заказчика: <b>Эстония</b><br/> \nАдрес заказчика: <b>34258458</b><br/> \nПочтовый индекс заказчика: <b>3385743</b><br/> \nТелефон заказчика: <b>3454245</b><br/> \nПримечание к заказу: <b>ertretwret</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', NULL, NULL, NULL, NULL),
(607, '2016-05-21 21:35:25', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:35:25</b><br/> \nСтраница посещения: <b>item.php?i=79</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=79', '', '', ''),
(608, '2016-05-21 21:36:05', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:36:05</b><br/> \nСтраница посещения: <b></b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', '', '', '', ''),
(609, '2016-05-21 21:39:06', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:39:06</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', ''),
(610, '2016-05-21 21:39:11', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:39:11</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', ''),
(611, '2016-05-21 21:39:21', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:39:21</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', ''),
(612, '2016-05-21 21:39:31', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:39:31</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', '');
INSERT INTO `businesslog` (`id`, `datex`, `alert_type`, `ip_addr`, `email`, `the_info`, `the_page`, `the_country`, `the_city`, `the_region`) VALUES
(613, '2016-05-21 21:39:50', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:39:50</b><br/> \nСтраница посещения: <b>basket.php?</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'basket.php?', '', '', ''),
(614, '2016-05-21 21:42:42', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:42:42</b><br/> \nСтраница посещения: <b>index.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'index.php', '', '', ''),
(615, '2016-05-21 21:42:46', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 21:42:46</b><br/> \nСтраница посещения: <b>contact_us.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'contact_us.php', '', '', ''),
(616, '2016-05-21 22:16:14', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 22:16:14</b><br/> \nСтраница посещения: <b>index.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'index.php', '', '', ''),
(617, '2016-05-21 22:16:33', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 22:16:33</b><br/> \nСтраница посещения: <b>item.php?i=84</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'item.php?i=84', '', '', ''),
(618, '2016-05-21 22:16:39', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 22:16:39</b><br/> \nСтраница посещения: <b>index.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'index.php', '', '', ''),
(619, '2016-05-21 22:18:21', 'LOGIN', '89.139.184.4', 'n/a', '<html><head><title>Логин на сайт Crystalsky.co.il</title><meta charset="utf-8"></head><body>Здравствуйте, Crystalsky!<br/><br/> \nНовый посетитель пришел на сайт Crystalsky.co.il!<br/><br/> \nДата посещения: <b>21-05-2016 22:18:21</b><br/> \nСтраница посещения: <b>index.php</b><br/> \nIP адрес: <a href="http://www.geoplugin.net/json.gp?ip=89.139.184.4" target="_blank"><b>89.139.184.4</b></a><br/> \nОперационная система: <b>Windows 7</b><br/> \nБраузер: <b>Chrome</b><br/><br/> \nС уважением,  <br/> \nАдминистрация.</body></html>', 'index.php', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `name`, `ord`) VALUES
(1, 'Белый', 1),
(2, 'Желтый', 2),
(3, 'Зеленый', 3),
(4, 'Красный', 4),
(5, 'Синий', 5),
(6, 'Фиолетовый', 6),
(7, 'Розовый', 7),
(8, 'Бирюзовый', 8),
(9, 'Бежевый', 9),
(10, 'Серый', 10),
(11, 'Голубой', 11),
(12, 'Черный', 12),
(13, 'Серебряный', 13),
(14, 'Малиновый', 22),
(15, 'Оранжевый', 234),
(16, 'Бордовый', 43);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `type` char(1) NOT NULL,
  `par1` varchar(10) NOT NULL,
  `par2` varchar(10) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `start_dt` datetime NOT NULL,
  `exp_dt` datetime DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `type`, `par1`, `par2`, `display_name`, `start_dt`, `exp_dt`, `status`) VALUES
(1, 'BONUS10NIS', '1', '10', '', 'Подарок 10 шекелей', '2016-05-15 00:00:00', NULL, 1),
(2, 'BONUS20NIS', '1', '20', '', 'Подарок 20 шекелей', '2016-05-15 00:00:00', NULL, 1),
(3, 'BONUS30NIS', '1', '30', '', 'Подарок 30 шекелей', '2016-05-15 00:00:00', NULL, 1),
(4, 'DISC10PCT', '2', '10', '', 'Скидка 10%', '2016-05-15 00:00:00', NULL, 1),
(5, 'DISC15PCT', '2', '15', '', 'Скидка 15%', '2016-05-15 00:00:00', NULL, 1),
(7, 'DISC5PCT', '2', '5', '', 'Скидка 5%', '2016-05-15 00:00:00', NULL, 1),
(8, 'BO10NIS100', '3', '10', '100', 'Бонус 10 шек. при покупке на сумму более 100 шек.', '2016-05-15 00:00:00', NULL, 1),
(9, 'BO20NIS200', '3', '20', '200', 'Бонус 20 шек. при покупке на сумму более 200 шек.', '2016-05-15 00:00:00', NULL, 1),
(10, 'BO10PCT200', '4', '10', '200', 'Скидка 10% на покупку более 200 шекелей', '2016-05-15 00:00:00', NULL, 1),
(21, '50SHEK300', '3', '50', '300', 'Бонус 50 шек. при покупке на сумму более 300 шек.', '2016-05-17 09:57:08', '2016-05-24 09:57:08', 1),
(22, 'SUPERBON', '4', '15', '300', 'Скидка 15% на покупку более 300 шекелей', '2016-05-17 14:08:04', '2016-05-24 14:08:04', 1),
(23, 'HAPPY2017', '2', '5', '', 'Скидка 5%', '2016-05-21 10:35:03', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) NOT NULL,
  `datex` datetime NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `feedback_title` varchar(200) NOT NULL,
  `feedback_msg` varchar(2000) NOT NULL,
  `status` char(1) NOT NULL,
  `lang` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `datex`, `email`, `user_name`, `user_city`, `feedback_title`, `feedback_msg`, `status`, `lang`) VALUES
(1, '2016-05-03 00:00:00', 'somenika@idontknow.com', 'Ника', 'Нацерет-Илит', 'Моя первая покупка в магазине "Crystal Sky"', 'Моя первая покупка в магазине "Crystal Sky" состоялась еще до того, как этот магазин стал популярным. Просто наткнулась на симпатичную вывеску "Crystal Sky" в торговом центре Раско, в Нацерет-Илите, я любитель серебра, но подобрать что нибудь что мне реально нравится мне достаточно сложно, а там я сразу нашла кучу симпатичных вещичек. И первыми я купила серьги. Цену уже не помню, но тогда она мне не показалась слишком дорогой. Эту покупку я совершила в апреле. С тех пор с сережками все отлично! Ношу не снимая, могу в них спать.', '1', 'ru'),
(2, '2016-05-10 00:00:00', 'anjela@somewhere.com', 'Анжела', 'Афула', 'Недавно мы с моим любимым посетили магазин Crystal Sky.', 'Недавно мы с моим любимым посетили магазин Crystal Sky. Там была очень заманчивая акция - с хорошей скидкой продавалось колечко. Мне уже давно хотелось именно такое кольцо: просто узенькое и с маленькими камешками по ободку. Я его померила, и оно мне очень понравилось.В результате, мы купили именно это серебряное кольцо.', '1', 'ru'),
(3, '2016-05-12 00:00:00', 'alena.afula@somewhere.com', 'Алена', 'Нацрат-Илит', 'Ювелирные украшения - это то, что приятно получать в подарок', 'Ювелирные украшения - это то, что приятно получать в подарок от любимого и от себя самой. Как же я рада, что магазин украшений Кристал Скай находится недалеко от моего дома! В магазине широкий ассортимент. Красивые изделия! Одна моя подруга приняла родированное серебро за белое золото :)', '1', 'ru'),
(9, '2016-05-06 02:00:00', 'elena@netakogo@net', 'Елена', 'Афула', 'Колечко очень красивое', 'Мне очень понравился ваш магазин. Украшения здесь стильные, необычные, не такие, как в большинстве ювелирных магазинов. Да и цены приемлемые. Комфортное обслуживание. Обязательно расскажу о нем знакомым и... куплю опять что-нибудь! Елена', '1', 'ru'),
(14, '2016-05-15 11:26:23', 'ilana@nowhere.net', 'Илана', 'Афула', 'Влюбилась в кулончик из-за красивых', 'Влюбилась в кулончик из-за красивых переплетений в виде цветов. Размер у кулона небольшой. Проба стоит, как на самом сердце, так и на замке цепочки - 925, говорят, что не темнеет и после полугода. Хотя все мы знаем, что любое серебро со временем надо чистить. Вот такие пироги, дорогие мои.', '1', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

CREATE TABLE `main_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`id`, `name`, `ord`) VALUES
(1, 'Изделия из серебра', 1),
(2, ' Изделия из позолоты', 2),
(3, 'Изделия из камней', 3),
(4, 'Модные украшения', 4);

-- --------------------------------------------------------

--
-- Table structure for table `metall`
--

CREATE TABLE `metall` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `metall`
--

INSERT INTO `metall` (`id`, `name`, `ord`) VALUES
(1, 'Серебро 925', 1),
(2, 'Позолота', 2),
(3, 'Другой', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(20) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifydate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `makat` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `photo1` varchar(200) NOT NULL,
  `photo2` varchar(200) NOT NULL,
  `photo3` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `metall` int(11) NOT NULL,
  `short_desc` varchar(150) NOT NULL,
  `long_desc` varchar(2000) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `show_price` char(1) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_new` char(1) NOT NULL,
  `is_discount` char(1) NOT NULL,
  `status` char(1) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `nviews` int(11) NOT NULL,
  `color1` int(11) DEFAULT NULL,
  `color2` int(11) DEFAULT NULL,
  `color3` int(11) DEFAULT NULL,
  `stone1` int(11) DEFAULT NULL,
  `stone2` int(11) DEFAULT NULL,
  `stone3` int(11) DEFAULT NULL,
  `size1` int(11) DEFAULT NULL,
  `size2` int(11) DEFAULT NULL,
  `size3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `createdate`, `modifydate`, `makat`, `title`, `photo1`, `photo2`, `photo3`, `category`, `metall`, `short_desc`, `long_desc`, `price`, `show_price`, `quantity`, `is_new`, `is_discount`, `status`, `remark`, `nviews`, `color1`, `color2`, `color3`, `stone1`, `stone2`, `stone3`, `size1`, `size2`, `size3`) VALUES
(1, '2016-05-15 19:18:51', '2016-05-05 19:19:22', '808081', 'Сапфировый набор', 'app_data/app_images/product_1_1.jpg', 'app_data/app_images/product_1_2.jpg', 'app_data/app_images/product_1_3.jpg', 1, 1, 'Набор серебро 925 с сапфирами, кубический цирконий', 'Очень красивый набор из серебра 925 с сапфирами, с кубическим цирконием.', '250.00', '1', 1, '1', '0', '1', 'Очень красивое украшение!', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2016-05-15 19:18:51', '2016-05-15 19:19:22', '808090', 'Набор с цирконием', 'app_data/app_images/product_2_1.jpg', 'app_data/app_images/product_2_2.jpg', 'app_data/app_images/product_2_3.jpg', 1, 1, 'Набор с цирконием', 'Очень красивый набор - серебро 925, цирконий. Прекрасное украшение для Вас!', '320.00', '1', 1, '1', '', '1', 'Оригинальная идея! Очень красивое украшение!', 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2016-05-15 19:18:51', '2016-05-15 19:19:22', '808085', 'Красивый набор', 'app_data/app_images/product_3_1.jpg', 'app_data/app_images/product_3_2.jpg', 'app_data/app_images/product_3_3.jpg', 1, 1, 'Красивый набор из серебра 925 зеленые камни. Ждем Вас за покупками!', 'Красивый набор из серебра 925 зеленые камни.', '340.00', '1', 1, '1', '', '1', '', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2016-05-21 04:17:49', '2016-05-21 04:17:49', '808023', ' Красивы', 'app_data/app_images/product_4_1.jpg', 'app_data/app_images/product_4_2.jpg', 'app_data/app_images/product_4_3.jpg', 1, 1, 'Трехцветны', 'Очаровательный трехцветный набор, кольцо, серьги, кулончик', '290.00', '1', 1, '1', '', '1', 'Рекомендуется для подарка!', 19, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(76, '2016-05-21 20:11:59', '2016-05-21 20:11:59', 'D25E16Z', 'Ожерелье из камней', 'app_data/app_images/20160521_201159_269931_a1.jpg', 'app_data/app_images/20160521_201159_270728_a2.jpg', '', 15, 0, 'Красное модное и легкое ожерелье из камней.', 'Красное модное и легкое ожерелье из камней.', '99.00', '1', 1, '1', '0', '1', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(77, '2016-05-21 20:32:46', '2016-05-21 20:32:46', 'E18292Z', 'Розовое ожерелье', 'app_data/app_images/20160521_201420_478226_b1.jpg', 'app_data/app_images/20160521_201420_478884_b2.jpg', '', 15, 0, 'Розовое изящное ожерелье для Вас!', 'Розовое изящное ожерелье для Вас! Хит сезона весна - лето 2016 года! Спешите купить это раскошное ожерелье в нашем магазине Crystal Sky!', '99.00', '1', 1, '0', '1', '1', '', 11, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(78, '2016-05-21 20:30:32', '2016-05-21 20:30:32', 'E13V99', 'Разноцвет ожерелье', 'app_data/app_images/20160521_202810_166431_c1.jpg', 'app_data/app_images/20160521_202810_167103_c2.jpg', '', 15, 0, 'Чудесное разноцветное ожерелье в современном стиле!', 'Чудесное разноцветное ожерелье в современном стиле! Приходите за покупками в магазин Crystal Sky!', '99.00', '1', 1, '1', '0', '1', 'Товар повышенного спроса!', 10, 7, 9, 16, 0, 0, 0, 0, 0, 0),
(79, '2016-05-21 21:26:31', '2016-05-21 21:26:31', 'E199B23', 'Элегантное ожерелье', 'app_data/app_images/20160521_171447_517961_img_06_09_1.jpg', '', '', 15, 0, 'Восхитительное ожерелье! Спешите за покупками!', 'Восхитительное модное и элегантное ожерелье для Вас! Спешите за покупками!', '49.99', '1', 1, '0', '1', '1', '', 5, 3, 6, 11, 0, 0, 0, 0, 0, 0),
(80, '2016-05-21 17:16:48', '2016-05-21 17:16:48', 'E19203', 'Серое ожерелье', 'app_data/app_images/20160521_171648_365339_img_06_11_22.jpg', '', '', 15, 0, 'Очень красивое серое ожерелье для Вас!', 'Очень красивое серое ожерелье для Вас!', '99.00', '1', 1, '1', '0', '1', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(81, '2016-05-21 20:42:24', '2016-05-21 20:42:24', 'E15L124', 'Бежевое ожерелье', 'app_data/app_images/20160521_204224_600988_aa3.jpg', 'app_data/app_images/20160521_204224_601510_aa1.jpg', 'app_data/app_images/20160521_204224_601873_aa2.jpg', 15, 0, 'Потрясающе красивое бежевое ожерелье!', 'Потрясающе красивое бежевое ожерелье', '99.00', '1', 1, '1', '0', '1', '', 0, 9, 0, 0, 0, 0, 0, 0, 0, 0),
(82, '2016-05-21 17:21:29', '2016-05-21 17:21:29', 'E1393B23', 'Элегантное ожерелье', 'app_data/app_images/20160521_172129_412492_img_06_07_01.jpg', '', '', 15, 0, 'Элегантное модное ожерелье', 'Элегантное модное ожерелье', '99.00', '1', 1, '1', '0', '1', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(83, '2016-05-21 20:36:55', '2016-05-21 20:36:55', 'E88B12', 'Ожерелье из камней', 'app_data/app_images/20160521_203655_174987_e1.jpg', 'app_data/app_images/20160521_203655_175497_e2.jpg', 'app_data/app_images/20160521_203655_175974_e3.jpg', 15, 0, 'Очень красивое и элегантное ожерелье из камней', 'Очень красивое и элегантное ожерелье из камней. Подходит как к классическому стилю, так и к повседневному, свободному. Спешите! Ждем Вас за покупками!', '99.00', '1', 1, '1', '0', '1', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(84, '2016-05-21 21:01:51', '2016-05-21 21:01:51', 'A88B293', 'Ожерелье Мечта', 'app_data/app_images/20160521_205652_450956_f10.jpg', 'app_data/app_images/20160521_205652_451604_f11.jpg', '', 15, 0, 'Восхитительное ожерелье от Crystal Sky! Приходите сегодня!', 'Восхитительное ожерелье от Crystal Sky! Эффектное, грациозное и элегантное. Приходите сегодня!', '99.00', '0', 1, '1', '0', '1', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(85, '2016-05-21 21:14:35', '2016-05-21 21:14:35', 'RO192E55', 'Роскошное ожерелье', 'app_data/app_images/20160521_211435_287216_s10.jpg', 'app_data/app_images/20160521_211435_287793_s11.jpg', '', 15, 0, 'Хит сезона весна-лето 2016! Рекомендуем!', 'Мы рады представить это замечательное роскошное ожерелье! Уважаемые Друзья! в магазине Crystal Sky вы сможете найти регулярно пополняемый ассортимент оригинальных изделий из серебра. Украшения с полудрагоценными камнями, позолоты и многое другое...Приглашаем!', '99.00', '1', 1, '1', '0', '1', 'Хит сезона весна-лето 2016!', 0, 10, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `ord`) VALUES
(3, '15', 3),
(4, '15 1/2', 4),
(6, '16', 6),
(7, '16 1/2', 7),
(8, '17', 8),
(12, '17 1/2', 9),
(14, '18', 11),
(15, '18 1/2', 12),
(16, '19', 13),
(17, '19 1/2', 14),
(18, '20', 15),
(19, '20 1/2', 16),
(21, '21', 18),
(22, '21 1/2', 19),
(24, '22', 21);

-- --------------------------------------------------------

--
-- Table structure for table `stones`
--

CREATE TABLE `stones` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stones`
--

INSERT INTO `stones` (`id`, `name`, `ord`) VALUES
(1, 'Сваровски', 1),
(2, 'Агат', 2),
(3, 'Александрит', 3),
(4, 'Аметист', 4),
(5, 'Гранат', 5),
(6, 'Жемчуг', 6),
(7, 'Изумруд', 7),
(8, 'Кварц', 8),
(9, 'Оникс', 9),
(10, 'Родолит', 10),
(11, 'Рубин', 11),
(12, 'Сапфир', 12),
(13, 'Топаз', 13),
(14, 'Турмалин', 14),
(15, 'Фианит', 15),
(16, 'Хризолит', 16),
(17, 'Цитрин', 25),
(18, 'Цирконий', 20),
(19, 'Коралл', 29),
(20, 'Нефрит', 27);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `main_category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `main_category`, `name`, `ord`) VALUES
(1, 1, 'Наборы', 1),
(2, 1, 'Кольца', 2),
(3, 1, 'Серьги', 3),
(4, 1, 'Кулоны', 4),
(5, 1, 'Браслеты', 5),
(6, 1, 'Ожерелья', 6),
(7, 1, 'Цепочки', 7),
(8, 2, 'Наборы', 10),
(9, 2, 'Кольца', 20),
(10, 2, 'Серьги', 30),
(11, 2, 'Кулоны', 40),
(12, 2, 'Браслеты', 50),
(13, 2, 'Ожерелья', 60),
(14, 2, 'Цепочки', 70),
(15, 3, 'Ожерелья', 110),
(16, 3, 'Браслеты', 120),
(17, 4, 'Кулоны из стекла', 310),
(18, 4, 'Ожерелья из стекла', 320),
(19, 4, 'Серьги из стекла', 330),
(20, 4, 'Часы', 340);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesslog`
--
ALTER TABLE `businesslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_category`
--
ALTER TABLE `main_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metall`
--
ALTER TABLE `metall`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `makat` (`makat`),
  ADD KEY `products_fk_category` (`category`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `stones`
--
ALTER TABLE `stones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_category_fk` (`main_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesslog`
--
ALTER TABLE `businesslog`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=620;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `main_category`
--
ALTER TABLE `main_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `metall`
--
ALTER TABLE `metall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `stones`
--
ALTER TABLE `stones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_fk_category` FOREIGN KEY (`category`) REFERENCES `sub_category` (`id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_fk` FOREIGN KEY (`main_category`) REFERENCES `main_category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
