-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: mysql.crystalsky.co.il
-- Generation Time: May 12, 2016 at 09:52 PM
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
  `the_info` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businesslog`
--

INSERT INTO `businesslog` (`id`, `datex`, `alert_type`, `ip_addr`, `email`, `the_info`) VALUES
(7, '2016-05-11 06:44:49', 'SEND_CONTACT_MSG', '46.116.198.51', 'irena.alexandrovich@yandex.ru', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>11-05-2016 06:44:49</b><br/>Имя отправителя сообщения: <b>Ирина</b><br/>Фамилия отправителя сообщения: <b>Александрович</b><br/>Тема сообщения: <b>Ирина Ивановна, пожалуйста</b><br/>Сообщение: <b>Ирина Ивановна, пожалуйста напишите мне. спасибо!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(8, '2016-05-11 06:48:15', 'SEND_CONTACT_MSG', '46.116.198.51', 'ivan.ivanov@yandex.ru', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>11-05-2016 06:48:15</b><br/>Имя отправителя сообщения: <b>Иван</b><br/>Фамилия отправителя сообщения: <b>Иванов</b><br/>Тема сообщения: <b>Проверка контактной формы</b><br/>Сообщение: <b>Проверка сообщения контактной формы. Раз два три четыре пять шесть... :)</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(9, '2016-05-11 07:09:48', 'SEND_CONTACT_MSG', '46.116.198.51', 'idontknow@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>11-05-2016 07:09:48</b><br/>Имя отправителя сообщения: <b>Коко</b><br/>Фамилия отправителя сообщения: <b>Шанель</b><br/>Тема сообщения: <b>Коко Шанель: интервью   фильм</b><br/>Сообщение: <b>Коко Шанель, интервью французскому телевидению1969 г.\nhttps://www.youtube.com/watch?v=YUqVBEC2EFM\n\nфильм - Коко до Шанель 2009\nhttps://www.yo</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(10, '2016-05-11 07:18:44', 'SEND_CONTACT_MSG', '46.116.198.51', 'idontknow@yandex.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>11-05-2016 07:18:44</b><br/>Имя отправителя сообщения: <b>Коко</b><br/>Фамилия отправителя сообщения: <b>Шанель</b><br/>Тема сообщения: <b>Коко Шанель: интервью   фильм</b><br/>Сообщение: <b>Коко Шанель, интервью французскому телевидению1969 г.\nhttps://www.youtube.com/watch?v=YUqVBEC2EFM\n\nФильм Коко до Шанель 2009 смотреть онлайн бесплатно Coco avant Chanel\nhttps://www.youtube.com/watch?v=vk53SUEjW44\n\nСериал Коко Шанель (Coco Chanel) - 4 серии\nhttp://www.online-life.cc/5990-koko-shan</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(11, '2016-05-12 19:05:52', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:05:52</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Тема сообщения: <b>Тестовое сообщение</b><br/>Сообщение: <b>Тестовое сообщение # Тестовое сообщение # Тестовое сообщение </b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(12, '2016-05-12 19:11:45', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yandex.ru', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:11:45</b><br/>Имя отправителя сообщения: <b>peter</b><br/>Фамилия отправителя сообщения: <b>petrov</b><br/>Тема сообщения: <b>test theme</b><br/>Сообщение: <b>мое сообщение мое сообщение</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(13, '2016-05-12 19:13:03', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.sidorov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:13:03</b><br/>Имя отправителя сообщения: <b>peter</b><br/>Фамилия отправителя сообщения: <b>sidorov</b><br/>Тема сообщения: <b>это тестовое сообщение</b><br/>Сообщение: <b>тест # тест # тест # это тест</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(14, '2016-05-12 19:14:24', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yandex.ru', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:14:24</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Тема сообщения: <b>Тестовое сообщение</b><br/>Сообщение: <b>тесто вое сообщение # тестовое сообщение</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(15, '2016-05-12 19:15:33', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:15:33</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Тема сообщения: <b>это тестовое сообщение</b><br/>Сообщение: <b>это тест # это тест  # это тест </b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(16, '2016-05-12 19:22:05', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:22:05</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Тема сообщения: <b>Тестовое сообщение</b><br/>Сообщение: <b>Тест сообщение # Тест сообщение  # Тест сообщение</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(17, '2016-05-12 19:26:49', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@yahoo.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:26:49</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Email отправителя сообщения: <b>peter.petrov@yahoo.com</b><br/>Тема сообщения: <b>Это тестовое сообщение </b><br/>Сообщение: <b>Это тестовое сообщение ; Это тестовое сообщение ; Это тестовое сообщение ; Это тестовое сообщение  :)</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(18, '2016-05-12 19:28:45', 'SEND_CONTACT_MSG', '46.116.198.51', 'peter.petrov@gmail.com', ' Мама папа <html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлено сообщение с контактной страницы сайта Crystalsky.co.il!<br/><br/>Дата отправки сообщения: <b>12-05-2016 19:28:45</b><br/>Имя отправителя сообщения: <b>Петр</b><br/>Фамилия отправителя сообщения: <b>Петров</b><br/>Email отправителя сообщения: <b>peter.petrov@gmail.com</b><br/>Тема сообщения: <b>это тестовое сообщение</b><br/>Сообщение: <b>это тестовое сообщение | это тестовое сообщение | это тестовое сообщение</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(19, '2016-05-13 02:00:31', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'irina@somewhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>13-05-2016 02:00:31</b><br/>Имя отправителя отзыва: <b>Ирина</b><br/>Email отправителя отзыва: <b>irina@somewhere.net</b><br/>Тема отзыва: <b>Спасибо!!!</b><br/>Отзыв: <b>Спасибо!!!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(20, '2016-05-13 02:05:59', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'irina@somewhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>13-05-2016 02:05:59</b><br/>Имя отправителя отзыва: <b>Ирина</b><br/>Email отправителя отзыва: <b>irina@somewhere.net</b><br/>Город отправителя отзыва: <b>Нижне-Вилюйск</b><br/>Тема отзыва: <b>Спасибо за то что вы</b><br/>Отзыв: <b>Спасибо за то что вы есть...</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(21, '2016-05-13 02:15:42', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'irina@somewhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>13-05-2016 02:15:42</b><br/>Имя отправителя отзыва: <b>Ирина</b><br/>Email отправителя отзыва: <b>irina@somewhere.net</b><br/>Город отправителя отзыва: <b>Москва</b><br/>Тема отзыва: <b>Спасибо!!!</b><br/>Отзыв: <b>Спасибо!!!</b><br/><br/>С уважением,  <br/>Администрация.</body></html>'),
(22, '2016-05-13 02:22:04', 'SEND_FEEDBACK_MSG', '46.116.198.51', 'ivan@somewhere.net', '<html><body>Здравствуйте, Crystalsky!<br/><br/>Вам отправлен отзыв пользователя/покупателя сайта Crystalsky.co.il!<br/><br/>Дата отправки отзыва: <b>13-05-2016 02:22:04</b><br/>Имя отправителя отзыва: <b>Иван</b><br/>Email отправителя отзыва: <b>ivan@somewhere.net</b><br/>Город отправителя отзыва: <b>Нижне-Вилюйск</b><br/>Тема отзыва: <b>Все просто круто!</b><br/>Отзыв: <b>Все просто круто!</b><br/>Отзыв будет опубликован на сайте после проверки администратором.</b><br/><br/>С уважением,  <br/>Администрация.</body></html>');

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
(13, 'Серебряный', 13);

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
(3, '2016-05-12 00:00:00', 'alena.afula@somewhere.com', 'Алена', 'Афула', 'Ювелирные украшения - это то, что приятно получать в подарок...', 'Ювелирные украшения - это то, что приятно получать в подарок от любимого и от себя самой. Как же я рада, что магазин украшений Кристал Скай находится недалеко от моего дома! В магазине широкий ассортимент. Красивые изделия! Одна моя подруга приняла родированное серебро за белое золото :)', '1', 'ru'),
(4, '2016-05-04 00:00:00', 'irina@idontknow.net', 'Irina', 'Nazereth-Illit', 'Отличный магазин, прекрасные изделия...', 'Отличный магазин, прекрасные изделия, Обязательно буду еще заказывать, стала постоянной покупательницей.', '0', 'ru'),
(6, '2016-05-12 00:00:00', 'nina@netakogo.net', 'Нина', 'Афула', 'Колечки замечательные', 'Колечки замечательные ,смотрятся на руке даже красивее,чем на фото.Спасибо!', '0', 'ru'),
(7, '2016-05-11 10:00:00', 'leonid@netakogo.net', 'Леонид', 'Хайфа', 'Колечки замечательные', 'Прекрасный подарок для внучки! Буду и впредь у вас покупать', '0', 'ru'),
(9, '2016-05-06 02:00:00', 'elena@netakogo@net', 'Елена', 'Афула', 'Колечко очень красивое', 'Мне очень понравился ваш магазин. Украшения здесь стильные, необычные, не такие, как в большинстве ювелирных магазинов. Да и цены приемлемые. Комфортное обслуживание. Обязательно расскажу о нем знакомым и... куплю опять что-нибудь! Елена', '1', 'ru'),
(10, '2016-05-13 02:00:31', 'irina@somewhere.net', 'Ирина', '', 'Спасибо!!!', 'Спасибо!!!', '0', 'ru'),
(11, '2016-05-13 02:05:59', 'irina@somewhere.net', 'Ирина', 'Нижне-Вилюйск', 'Спасибо за то что вы', 'Спасибо за то что вы есть...', '0', 'ru'),
(12, '2016-05-13 02:15:42', 'irina@somewhere.net', 'Ирина', 'Москва', 'Спасибо!!!', 'Спасибо!!!', '0', 'ru'),
(13, '2016-05-13 02:22:04', 'ivan@somewhere.net', 'Иван', 'Нижне-Вилюйск', 'Все просто круто!', 'Все просто круто!', '0', 'ru');

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
  `remark` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `makat`, `title`, `photo1`, `photo2`, `photo3`, `category`, `metall`, `short_desc`, `long_desc`, `price`, `show_price`, `quantity`, `is_new`, `is_discount`, `status`, `remark`) VALUES
(1, '808081', 'Сапфировый набор', 'app_data/app_images/product_1_1.jpg', 'app_data/app_images/product_1_2.jpg', 'app_data/app_images/product_1_3.jpg', 1, 1, 'Набор серебро 925 с сапфирами, кубический цирконий', 'Очень красивый набор из серебра 925 с сапфирами, с кубическим цирконием.', '250.00', '1', 2, '1', '0', '1', 'Очень выгодная покупка!'),
(3, '808090', 'Набор с цирконием', 'app_data/app_images/product_2_1.jpg', 'app_data/app_images/product_2_2.jpg', 'app_data/app_images/product_2_3.jpg', 1, 1, 'Набор с цирконием', 'Очень красивы набор - серебро 925, цирконий', '320.00', '1', 10, '1', '', '1', ''),
(4, '808085', 'Красивый набор', 'app_data/app_images/product_3_1.jpg', 'app_data/app_images/product_3_2.jpg', 'app_data/app_images/product_3_3.jpg', 1, 1, 'Красивый набор из серебра 925 зеленые камни. Ждем Вас за покупками!', 'Красивый набор из серебра 925 зеленые камни.', '340.00', '1', 4, '1', '', '1', ''),
(5, '808023', 'набор с драг/камнями', 'app_data/app_images/product_4_1.jpg', 'app_data/app_images/product_4_2.jpg', 'app_data/app_images/product_4_3.jpg', 1, 1, 'набор с драг/камнями', 'набор с драг/камнями', '290.00', '1', 2, '1', '', '1', 'Изделие повышенного спроса!');

-- --------------------------------------------------------

--
-- Table structure for table `product_color_link`
--

CREATE TABLE `product_color_link` (
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_size_link`
--

CREATE TABLE `product_size_link` (
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_size_link`
--

INSERT INTO `product_size_link` (`product_id`, `size_id`) VALUES
(1, 16),
(1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `product_stone_link`
--

CREATE TABLE `product_stone_link` (
  `product_id` int(11) NOT NULL,
  `stone_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_stone_link`
--

INSERT INTO `product_stone_link` (`product_id`, `stone_id`) VALUES
(1, 12),
(1, 13),
(3, 18);

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
(1, '14', 1),
(2, '14 1/2', 2),
(3, '15', 3),
(4, '15 1/2', 4),
(5, '15 3/4', 5),
(6, '16', 6),
(7, '16 1/2', 7),
(8, '17', 8),
(12, '17 1/4', 9),
(13, '17 3/4', 10),
(14, '18', 11),
(15, '18 1/2', 12),
(16, '19', 13),
(17, '19 1/2', 14),
(18, '20', 15),
(19, '20 1/4', 16),
(20, '20 3/4', 17),
(21, '21', 18),
(22, '21 1/4', 19),
(23, '21 3/4', 20),
(24, '22', 21),
(25, '22 1/2', 22),
(26, '23', 23),
(27, '23 1/2', 24),
(28, '23 3/4', 25),
(29, '24 1/4', 26),
(30, '24 1/2', 27);

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
(18, 'Цирконий', 20);

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `makat` (`makat`),
  ADD KEY `products_fk_category` (`category`);

--
-- Indexes for table `product_color_link`
--
ALTER TABLE `product_color_link`
  ADD UNIQUE KEY `product_color_link_u` (`product_id`,`color_id`),
  ADD KEY `product_color_link_idx1` (`product_id`),
  ADD KEY `product_color_link_idx2` (`color_id`);

--
-- Indexes for table `product_size_link`
--
ALTER TABLE `product_size_link`
  ADD UNIQUE KEY `product_size_link_u` (`product_id`,`size_id`),
  ADD KEY `product_size_link_fk_size` (`size_id`);

--
-- Indexes for table `product_stone_link`
--
ALTER TABLE `product_stone_link`
  ADD UNIQUE KEY `product_stone_link_u` (`product_id`,`stone_id`),
  ADD KEY `product_stone_link_idx1` (`product_id`),
  ADD KEY `product_stone_link_idx2` (`stone_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stones`
--
ALTER TABLE `stones`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `stones`
--
ALTER TABLE `stones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
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
-- Constraints for table `product_color_link`
--
ALTER TABLE `product_color_link`
  ADD CONSTRAINT `product_color_fk_color` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  ADD CONSTRAINT `product_color_fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_size_link`
--
ALTER TABLE `product_size_link`
  ADD CONSTRAINT `product_size_fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_size_link_fk_size` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `product_stone_link`
--
ALTER TABLE `product_stone_link`
  ADD CONSTRAINT `product_stone_link_fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_stone_link_fk_stone` FOREIGN KEY (`stone_id`) REFERENCES `stones` (`id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_fk` FOREIGN KEY (`main_category`) REFERENCES `main_category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
