-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2020 a las 03:22:42
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `description`, `price`, `updated_at`, `created_at`) VALUES
(1, 'tomato', '', 0.50, '2020-01-15 17:36:21', '0000-00-00 00:00:00'),
(2, 'sliced mushrooms', '', 0.50, '2020-01-15 17:36:21', '0000-00-00 00:00:00'),
(3, 'feta cheese', '', 1.00, '2020-01-15 17:37:06', '0000-00-00 00:00:00'),
(4, 'sausages', '', 1.00, '2020-01-15 17:37:06', '0000-00-00 00:00:00'),
(5, 'mozzarella cheese', '', 0.50, '2020-01-15 17:37:38', '0000-00-00 00:00:00'),
(6, 'oregano', '', 1.00, '2020-01-15 17:37:38', '0000-00-00 00:00:00'),
(7, 'bacon', '', 1.00, '2020-01-17 04:13:44', '0000-00-00 00:00:00'),
(8, 'sliced onion', '', 0.50, '2020-01-17 04:00:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredients_pizza`
--

CREATE TABLE `ingredients_pizza` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pizza` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingredients_pizza`
--

INSERT INTO `ingredients_pizza` (`id`, `id_pizza`, `id_ingredient`, `updated_at`, `created_at`) VALUES
(1, 1, 1, '2020-01-15 17:38:57', '2020-01-16 01:58:35'),
(2, 1, 2, '2020-01-15 17:38:57', '2020-01-16 01:58:35'),
(3, 1, 3, '2020-01-15 17:39:19', '2020-01-16 01:58:35'),
(4, 1, 4, '2020-01-15 17:39:19', '2020-01-16 01:58:35'),
(5, 1, 5, '2020-01-15 17:39:32', '2020-01-16 01:58:35'),
(6, 1, 6, '2020-01-15 17:39:32', '2020-01-16 01:58:35'),
(7, 1, 8, '2020-01-15 21:59:28', '2020-01-16 01:58:35'),
(8, 2, 1, '2020-01-15 17:40:16', '2020-01-16 01:58:35'),
(9, 2, 5, '2020-01-15 20:38:57', '2020-01-16 01:58:35'),
(10, 2, 6, '2020-01-15 20:38:21', '2020-01-16 01:58:35'),
(11, 2, 2, '2020-01-15 17:47:13', '2020-01-16 01:58:35'),
(12, 2, 7, '2020-01-15 17:47:13', '2020-01-16 01:58:35'),
(13, 17, 1, '2020-01-16 04:58:47', '2020-01-16 04:58:47'),
(14, 17, 5, '2020-01-16 04:58:47', '2020-01-16 04:58:47'),
(15, 17, 6, '2020-01-16 04:58:47', '2020-01-16 04:58:47'),
(16, 18, 1, '2020-01-16 05:01:00', '2020-01-16 05:01:00'),
(17, 18, 5, '2020-01-16 05:01:00', '2020-01-16 05:01:00'),
(18, 18, 6, '2020-01-16 05:01:00', '2020-01-16 05:01:00'),
(19, 19, 1, '2020-01-16 05:03:40', '2020-01-16 05:03:40'),
(20, 19, 5, '2020-01-16 05:03:40', '2020-01-16 05:03:40'),
(21, 19, 6, '2020-01-16 05:03:40', '2020-01-16 05:03:40'),
(22, 20, 1, '2020-01-16 05:05:21', '2020-01-16 05:05:21'),
(23, 20, 5, '2020-01-16 05:05:21', '2020-01-16 05:05:21'),
(24, 20, 6, '2020-01-16 05:05:21', '2020-01-16 05:05:21'),
(25, 21, 1, '2020-01-16 05:07:50', '2020-01-16 05:07:50'),
(26, 22, 1, '2020-01-16 05:09:15', '2020-01-16 05:09:15'),
(27, 23, 1, '2020-01-16 05:36:34', '2020-01-16 05:36:34'),
(28, 23, 5, '2020-01-16 05:36:34', '2020-01-16 05:36:34'),
(29, 23, 6, '2020-01-16 05:36:34', '2020-01-16 05:36:34'),
(30, 24, 1, '2020-01-16 14:53:49', '2020-01-16 14:53:49'),
(31, 24, 5, '2020-01-16 14:53:49', '2020-01-16 14:53:49'),
(32, 24, 6, '2020-01-16 14:53:49', '2020-01-16 14:53:49'),
(33, 25, 1, '2020-01-16 15:01:14', '2020-01-16 15:01:14'),
(34, 25, 5, '2020-01-16 15:01:14', '2020-01-16 15:01:14'),
(35, 25, 6, '2020-01-16 15:01:14', '2020-01-16 15:01:14'),
(37, 27, 1, '2020-01-16 15:38:45', '2020-01-16 15:38:45'),
(38, 27, 2, '2020-01-16 15:38:45', '2020-01-16 15:38:45'),
(39, 27, 3, '2020-01-16 15:38:45', '2020-01-16 15:38:45'),
(40, 27, 4, '2020-01-16 15:38:45', '2020-01-16 15:38:45'),
(41, 27, 5, '2020-01-16 15:38:45', '2020-01-16 15:38:45'),
(42, 27, 6, '2020-01-16 15:38:45', '2020-01-16 15:38:45'),
(43, 27, 8, '2020-01-16 15:38:45', '2020-01-16 15:38:45'),
(57, 28, 1, '2020-01-16 16:58:46', '2020-01-16 16:58:46'),
(58, 28, 5, '2020-01-16 16:58:46', '2020-01-16 16:58:46'),
(59, 28, 6, '2020-01-16 16:58:47', '2020-01-16 16:58:47'),
(66, 29, 1, '2020-01-17 04:38:30', '2020-01-17 04:38:30'),
(67, 29, 5, '2020-01-17 04:38:30', '2020-01-17 04:38:30'),
(68, 29, 6, '2020-01-17 04:38:30', '2020-01-17 04:38:30'),
(72, 26, 1, '2020-01-17 05:22:06', '2020-01-17 05:22:06'),
(73, 26, 5, '2020-01-17 05:22:06', '2020-01-17 05:22:06'),
(74, 26, 6, '2020-01-17 05:22:06', '2020-01-17 05:22:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_ingredients_pizza_table', 1),
(2, '2014_10_12_000000_create_ingredients_table', 1),
(3, '2014_10_12_000000_create_pizzas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pizzas`
--

CREATE TABLE `pizzas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pizzas`
--

INSERT INTO `pizzas` (`id`, `name`, `description`, `updated_at`, `created_at`) VALUES
(1, 'Fun Pizza', 'Fun Pizza', '2020-01-15 17:31:25', '0000-00-00 00:00:00'),
(2, 'Super Mushroom Pizza', 'Super Mushroom Pizza', '2020-01-15 17:31:25', '0000-00-00 00:00:00'),
(26, 'Muzzarella', NULL, '2020-01-17 05:22:05', '2020-01-16 15:05:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingredients_pizza`
--
ALTER TABLE `ingredients_pizza`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ingredients_pizza`
--
ALTER TABLE `ingredients_pizza`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
