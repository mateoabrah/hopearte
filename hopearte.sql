-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2025 a las 23:50:27
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hopearte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beers`
--

CREATE TABLE `beers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brewery_id` bigint(20) UNSIGNED NOT NULL,
  `beer_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `abv` decimal(4,2) DEFAULT NULL COMMENT 'Alcohol By Volume',
  `ibu` decimal(5,2) DEFAULT NULL COMMENT 'International Bitterness Units',
  `color` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `first_brewed` year(4) DEFAULT NULL,
  `seasonal` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `featured_in_banner` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `beers`
--

INSERT INTO `beers` (`id`, `brewery_id`, `beer_category_id`, `name`, `slug`, `description`, `abv`, `ibu`, `color`, `image`, `first_brewed`, `seasonal`, `created_at`, `updated_at`, `created_by`, `featured_in_banner`) VALUES
(1, 1, 2, 'Dorada Clásica', 'dorada-clasica', 'Nuestra cerveza insignia, elaborada con cebada local y lúpulo aromático europeo. Sabor equilibrado y refrescante.', 4.80, 22.00, 'Dorado', NULL, '2015', 0, '2025-05-04 09:13:41', '2025-05-20 15:47:45', NULL, 0),
(2, 1, 5, 'Trigo Mediterráneo', 'trigo-mediterraneo', 'Cerveza de trigo con toques cítricos y un final ligeramente especiado. Perfecta para los días de calor.', 5.20, 15.00, 'Amarillo pálido', NULL, '2016', 0, '2025-05-04 09:13:41', '2025-05-20 11:54:09', NULL, 0),
(3, 1, 1, 'IPA Catalana', 'ipa-catalana', 'IPA con un toque mediterráneo, utilizando lúpulos locales y americanos. Aromas cítricos y tropicales.', 6.50, 65.00, 'Ámbar', NULL, '2017', 0, '2025-05-04 09:13:41', '2025-05-20 15:47:47', NULL, 0),
(4, 2, 4, 'Pico Nevado', 'pico-nevado', 'Pilsner cristalina inspirada en el agua pura de montaña. Sabor limpio con un ligero amargor.', 4.50, 35.00, 'Dorado claro', NULL, '2018', 0, '2025-05-04 09:13:41', '2025-05-20 15:47:49', NULL, 0),
(5, 2, 7, 'Bosque Oscuro', 'bosque-oscuro', 'Porter robusta con sabores a chocolate negro y café tostado. Un abrazo cálido para días fríos.', 5.80, 28.00, 'Marrón oscuro', NULL, '2019', 0, '2025-05-04 09:13:41', '2025-05-17 23:39:45', NULL, 1),
(6, 3, 1, 'Triple Lúpulo', 'triple-lupulo', 'IPA potente con triple adición de lúpulo. Explosión de aromas cítricos y resinosos.', 7.20, 75.00, 'Ámbar profundo', NULL, '2013', 0, '2025-05-04 09:13:41', '2025-05-17 23:39:47', NULL, 1),
(7, 3, 6, 'Session Naranja', 'session-naranja', 'Session IPA con piel de naranja valenciana. Baja graduación pero gran sabor cítrico.', 4.00, 40.00, 'Dorado', NULL, '2015', 0, '2025-05-04 09:13:41', '2025-05-20 15:47:53', NULL, 1),
(8, 3, 1, 'Imperial Tropical', 'imperial-tropical', 'Double IPA con lúpulos tropicales. Potente, jugosa y aromática.', 8.50, 85.00, 'Ámbar rojizo', NULL, '2016', 1, '2025-05-04 09:13:41', '2025-05-17 23:39:40', NULL, 1),
(9, 4, 10, 'Tradición 1956', 'tradicion-1956', 'Receta original de nuestra fundación. Cerveza ámbar con equilibrio perfecto entre dulzor y amargor.', 5.50, 30.00, 'Ámbar', NULL, '1956', 0, '2025-05-04 09:13:41', '2025-05-04 09:13:41', NULL, 0),
(10, 4, 9, 'Sidra del Cantábrico', 'sidra-del-cantabrico', 'Cerveza ácida inspirada en la tradición sidrera vasca. Refrescante y con notas de manzana verde.', 5.00, 10.00, 'Amarillo pálido', NULL, '2010', 0, '2025-05-04 09:13:41', '2025-05-04 09:13:41', NULL, 0),
(11, 5, 1, 'Rebelde Sin Causa', 'rebelde-sin-causa', 'IPA experimental con lúpulos poco convencionales. Cada lote es una sorpresa diferente.', 6.60, 66.00, 'Variable', NULL, '2020', 0, '2025-05-04 09:13:41', '2025-05-04 09:13:41', NULL, 0),
(12, 6, 8, 'Trappist Española', 'trappist-espanola', 'Inspirada en las cervezas trapenses belgas. Rica, compleja y con notas de frutas pasas.', 7.50, 25.00, 'Ámbar oscuro', NULL, '2009', 0, '2025-05-04 09:13:41', '2025-05-04 09:13:41', NULL, 0),
(13, 7, 6, 'Brisa Marina', 'brisa-marina', 'Pale ale ligera con un toque salino que recuerda al mar Mediterráneo.', 5.00, 35.00, 'Dorado pálido', NULL, '2017', 0, '2025-05-04 09:13:41', '2025-05-17 23:39:53', NULL, 1),
(14, 8, 3, 'Lava Negra', 'lava-negra', 'Stout imperial intensa como la lava volcánica. Sabores a chocolate, café y un toque mineral único.', 9.00, 50.00, 'Negro intenso', NULL, '2015', 0, '2025-05-04 09:13:41', '2025-05-04 09:13:41', NULL, 0),
(15, 9, 1, 'Nómada', 'nomada', 'IPA experimental que cambia con cada lote. Esta edición presenta notas de frutas tropicales y pino.', 6.80, 60.00, 'Ámbar', NULL, '2018', 1, '2025-05-04 09:13:41', '2025-05-04 09:13:41', NULL, 0),
(16, 10, 6, 'Marejada', 'marejada', 'Pale ale atlántica con un toque salino y aroma a lúpulos frescos.', 5.50, 40.00, 'Ámbar claro', NULL, '2012', 0, '2025-05-04 09:13:41', '2025-05-04 09:13:41', NULL, 0),
(17, 2, 3, 'Re Russian Imperial', 're-russian-imperial', 'Cerveza negra tipo Stout con mucho cuerpo y alta graduación alcohólica.', 10.10, 35.00, NULL, NULL, NULL, 0, '2025-05-04 13:51:05', '2025-05-04 13:51:05', 2, 0),
(18, 1, 2, 'Cerveza Rosita', 'cerveza-rosita', 'Cerveza rubia fresca y ligera.', 4.80, 15.00, NULL, NULL, NULL, 0, '2025-05-04 14:04:50', '2025-05-04 14:04:50', 2, 0),
(19, 12, 2, 'La verde', 'la-verde', 'Rubia ligera refrescante con notas de menta', 4.50, 22.00, NULL, 'beers/B2kiCjngwGUti4dKywtradcp2Ibzuzshg19Ct25r.jpg', NULL, 0, '2025-05-20 06:10:02', '2025-05-20 11:54:03', 5, 1),
(20, 14, 3, 'Cerveza Prades', 'cerveza-prades', 'Cerveza negra tipo Stout', 6.30, 34.00, NULL, 'beers/XpE4ruvCLBsaZtLBLhVnBXHdgAPCHa2o67Ow2OAK.png', NULL, 0, '2025-05-20 15:43:39', '2025-05-20 15:43:39', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beer_categories`
--

CREATE TABLE `beer_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `beer_categories`
--

INSERT INTO `beer_categories` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'IPA', 'India Pale Ale, cerveza con alto contenido de lúpulo, amargor pronunciado y aromas cítricos o florales.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(2, 'Lager', 'Cerveza de fermentación baja, ligera, refrescante y con sabores limpios.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(3, 'Stout', 'Cerveza oscura con sabores tostados, malta y a menudo con notas de café o chocolate.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(4, 'Pilsner', 'Lager pálida originaria de República Checa, con sabor a malta ligera y un amargor distintivo del lúpulo.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(5, 'Wheat Beer', 'Cerveza elaborada con una proporción significativa de trigo, generalmente turbia con sabores afrutados.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(6, 'Pale Ale', 'Cerveza de fermentación alta con un color ámbar claro y un equilibrio entre malta y lúpulo.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(7, 'Porter', 'Cerveza oscura con un cuerpo medio, sabores a chocolate y café menos intensos que la Stout.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(8, 'Belgian Ale', 'Familia de cervezas belgas con características diversas, generalmente con sabores complejos y frutales.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(9, 'Sour Beer', 'Cervezas con acidez distintiva resultado de bacterias como Lactobacillus durante la fermentación.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39'),
(10, 'Amber Ale', 'Cerveza de color ámbar con equilibrio entre maltas caramelizadas y amargor del lúpulo.', NULL, '2025-05-04 09:13:39', '2025-05-04 09:13:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beer_favorites`
--

CREATE TABLE `beer_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `beer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `beer_favorites`
--

INSERT INTO `beer_favorites` (`id`, `user_id`, `beer_id`, `created_at`, `updated_at`) VALUES
(1, 6, 17, NULL, NULL),
(4, 7, 6, NULL, NULL),
(5, 2, 19, NULL, NULL),
(6, 1, 16, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `breweries`
--

CREATE TABLE `breweries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `founded_year` year(4) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `visitable` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `breweries`
--

INSERT INTO `breweries` (`id`, `user_id`, `name`, `description`, `city`, `address`, `latitude`, `longitude`, `founded_year`, `website`, `visitable`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, 'La Birra Dorada', 'Cervecería artesanal fundada por apasionados de la cerveza. Nos especializamos en cervezas de estilo belga y alemán, elaboradas con ingredientes naturales de la más alta calidad.', 'Barcelona', 'Carrer del Torrent de l\'Olla, 175', 41.40488700, 2.15388900, '2015', 'https://labirradorada.com', 1, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(2, 2, 'Cerveza Montaña', 'Pequeña cervecería ubicada en las afueras de la ciudad. Nuestras cervezas se inspiran en los sabores de la montaña, utilizando agua de manantial y hierbas locales.', 'Madrid', 'Calle de Fuencarral, 45', 40.42614700, -3.70224000, '2018', 'https://cervezamontana.es', 1, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(3, 1, 'Lupulus Craft', 'Somos pioneros en la elaboración de cervezas IPA en España. Nuestro maestro cervecero ha ganado varios premios internacionales por sus creaciones innovadoras.', 'Valencia', 'Avinguda del Port, 87', 39.46469100, -0.32630800, '2012', 'https://lupuluscraft.com', 0, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(4, 1, 'Cervecería del Norte', 'Tradición cervecera desde 1956. Elaboramos nuestras cervezas siguiendo recetas familiares transmitidas de generación en generación, con un toque moderno.', 'Bilbao', 'Calle Licenciado Poza, 16', 43.26298500, -2.93501300, '1956', 'https://cerveceriadelnorte.com', 1, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(5, 1, 'Malasuerte Brewing Co.', 'Cervecería urbana con espíritu rebelde. Nuestras cervezas experimentales desafían los estilos tradicionales y exploran nuevos horizontes de sabor.', 'Sevilla', 'Calle Feria, 35', 37.39833300, -5.99416700, '2019', 'https://malasuertebrewing.com', 1, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(6, 1, 'La Abadía', 'Inspirados en las cervezas trapenses, elaboramos nuestros productos con técnicas tradicionales en un antiguo monasterio restaurado como fábrica.', 'Granada', 'Calle Elvira, 23', 37.17805500, -3.59888900, '2008', 'https://laabadiacerveza.es', 1, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(7, 1, 'Isla Brewing Project', 'Nacimos como un proyecto de amigos que se convirtió en una reconocida cervecería. Nos especializamos en cervezas frescas y tropicales.', 'Palma de Mallorca', 'Carrer Sant Magí, 41', 39.56960000, 2.63833300, '2016', 'https://islabrewing.com', 0, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(8, 1, 'Cerveza Volcánica', 'Elaboramos nuestras cervezas en terreno volcánico, aprovechando las propiedades minerales del agua filtrada a través de la roca volcánica.', 'Tenerife', 'Calle San José, 15, La Orotava', 28.38941000, -16.52360000, '2014', 'https://cervezavolcanica.com', 1, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(9, 2, 'Lúpulo Errante', 'Cervecería nómada que colabora con diferentes productores para crear ediciones limitadas y experimentales que cambian con cada temporada.', 'Zaragoza', 'Calle Don Jaime I, 38', 41.65111100, -0.87861100, '2017', 'https://lupuloerrante.es', 0, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(10, 1, 'Cervezas Atlánticas', 'El sabor del Atlántico en cada sorbo. Nuestras cervezas reflejan el carácter salvaje del océano y la brisa marina.', 'A Coruña', 'Rúa de San Andrés, 156', 43.36888900, -8.39833300, '2011', 'https://cervezasatlanticas.gal', 1, NULL, '2025-05-04 09:00:44', '2025-05-04 09:00:44'),
(11, 5, 'LaBirra', 'Cervecería La Birra en Reus', 'Reus', 'Carrer de Pubill Oriol, 7, 43201 Reus, Tarragona', 41.15488033, 1.10746141, '2025', NULL, 1, NULL, '2025-05-04 09:26:19', '2025-05-04 09:33:22'),
(12, 5, 'La Birra 2', 'La Birra 2 de Reus', 'Reus', 'Carrer de Fuster Valldeperes', 41.15571648, 1.11831352, '2025', NULL, 1, NULL, '2025-05-04 10:51:26', '2025-05-04 10:51:26'),
(13, 5, 'La Birra 3', 'Cervecería de nuestra franquicia con las mejores variedades de cerveza artesanal.', 'Tarragona', 'Rambla Nova 54', 41.11530597, 1.25286385, '2025', NULL, 1, 'breweries/uploads/qZUPzFCY3ac9k4MWLbNygfeKtxG5RPocEXMLNVtO.jpg', '2025-05-20 08:18:31', '2025-05-20 08:18:31'),
(14, 2, 'La Birra 4', 'Cervecería artesanal 4ta franquicia en Cataluña', 'Barcelona', 'Carrer de Badajoz', 41.39768870, 2.19666749, '2025', NULL, 1, 'breweries/uploads/sJFBjKyzEDzDg5gxgt1VQRhRqGnojYcI8dPaOzsj.jpg', '2025-05-20 15:41:24', '2025-05-20 15:41:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brewery_beer`
--

CREATE TABLE `brewery_beer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brewery_id` bigint(20) UNSIGNED NOT NULL,
  `beer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `brewery_beer`
--

INSERT INTO `brewery_beer` (`id`, `brewery_id`, `beer_id`, `created_at`, `updated_at`) VALUES
(1, 2, 17, NULL, NULL),
(2, 1, 18, NULL, NULL),
(3, 2, 18, NULL, NULL),
(4, 9, 18, NULL, NULL),
(5, 12, 19, NULL, NULL),
(6, 13, 19, NULL, NULL),
(7, 14, 19, NULL, NULL),
(8, 14, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brewery_favorites`
--

CREATE TABLE `brewery_favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `brewery_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `brewery_favorites`
--

INSERT INTO `brewery_favorites` (`id`, `user_id`, `brewery_id`, `created_at`, `updated_at`) VALUES
(2, 6, 11, NULL, NULL),
(3, 6, 2, NULL, NULL),
(4, 7, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('mateo@gmail.com|127.0.0.1', 'i:1;', 1747742728),
('mateo@gmail.com|127.0.0.1:timer', 'i:1747742728;', 1747742728),
('mateo@mateo.com|127.0.0.1', 'i:2;', 1747742713),
('mateo@mateo.com|127.0.0.1:timer', 'i:1747742713;', 1747742713);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_22_021630_create_breweries_table', 1),
(5, '2025_02_25_170608_create_beer_categories_table', 1),
(6, '2025_05_01_122326_create_favorites_table', 1),
(7, '2025_05_04_075401_add_role_to_users_table', 1),
(8, '2025_05_04_110428_create_beers_table', 2),
(9, '2025_05_04_110949_create_beer_categories_table', 3),
(10, '2025_05_04_111044_add_beer_category_id_to_beers_table', 4),
(11, '2025_05_04_145956_create_brewery_beer_table', 5),
(12, '2025_05_04_151149_add_slug_to_beers_table', 6),
(13, '2025_05_04_152419_add_created_by_to_beers_table', 7),
(14, '2023_05_04_000000_create_reviews_table', 8),
(15, '2025_05_04_create_reviews_table', 9),
(16, '2025_05_18_000652_add_featured_in_banner_to_beers_table', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reviewable_type` varchar(255) NOT NULL,
  `reviewable_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL COMMENT 'Rating from 1 to 5',
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `reviewable_type`, `reviewable_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(2, 6, 'App\\Models\\Beer', 13, 5, NULL, '2025-05-04 15:18:10', '2025-05-04 15:18:10'),
(3, 6, 'App\\Models\\Beer', 2, 4, NULL, '2025-05-04 15:25:28', '2025-05-04 15:25:28'),
(4, 6, 'App\\Models\\Beer', 17, 5, 'La mejor cerveza artesanal de la región!!!', '2025-05-04 15:30:42', '2025-05-04 15:30:42'),
(5, 6, 'App\\Models\\Brewery', 11, 5, NULL, '2025-05-04 15:37:53', '2025-05-04 15:37:53'),
(6, 6, 'App\\Models\\Brewery', 12, 4, 'Buena cervecería, le falta variedad de cervezas.', '2025-05-04 16:26:15', '2025-05-04 16:26:15'),
(7, 7, 'App\\Models\\Beer', 18, 5, 'De diez', '2025-05-20 10:05:16', '2025-05-20 10:11:00'),
(8, 7, 'App\\Models\\Beer', 5, 4, 'Bastante buena!', '2025-05-20 10:32:40', '2025-05-20 10:32:40'),
(9, 7, 'App\\Models\\Beer', 19, 4, 'De diez', '2025-05-20 15:36:56', '2025-05-20 15:36:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jxbjbhFhumScawJgDaOjPMSrrMDtYSMwOpDyF2Yg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTAwRmlsWFdTdHNUcE1ZdjRIYUVhUTZZTUl5eHVUR2txVUI0aWh6ZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9iZWVyLWNhdGVnb3JpZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747753720),
('OEERm39SNv3yAaO7mYc00QCp63XhRLAqGUdjO09J', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSFhlMFpzOGhxbGVROWYyblloYndVZ1lzZUVlVDg2dEprRkVnaTV1UyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbXktYnJld2VyaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1747752552),
('qv8RIXdaFSSmnDJibjkrgeyNdeI1CWkArBVf2axR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT1pDQXFkbjB4S25INzNnRldoVUQxdkh3NzBUc3dicnIxOGFsUEFmayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9icmV3ZXJpZXMvMTMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747753108),
('ZgyB0bHf1m0EA2Hk2swF7m6zrd1qzEzHL14xKXxW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1hCSzNRMW1TZTJRTkdtdFdOMUJleE1uUUNTOUhtM0lJZUtrM0kxciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9iYW5uZXIiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747763869);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@hopearte.com', NULL, '$2y$12$cC5buHq3VeF4DNBq456jA.eF2AM/6AQa5Zsoqni7fbysGeFHXQf0u', 'admin', NULL, '2025-05-04 08:57:04', '2025-05-04 08:57:04'),
(2, 'La Birra', 'labirra@gmail.com', NULL, '$2y$12$J2ztCCjZnB7UtT4jTLzgrOpW1thcFDHO2Uij2h/8/.RCzGBHJFXH2', 'company', NULL, '2025-05-04 08:57:04', '2025-05-04 08:57:04'),
(3, 'Usuario', 'usuario@gmail.com', NULL, '$2y$12$S9YRM2TpVN74btgcUh.2D.1F3rl2yktA9HP1dDzyoiA03ga5V.F.i', 'user', NULL, '2025-05-04 08:57:05', '2025-05-04 08:57:05'),
(5, 'LaBirra', 'labirra@gmail.co', NULL, '$2y$12$GXX/O1jBwFkTxwhqDpZkeeKtI6/x1gwB.7D0WMjzLrTZA0MtGRiey', 'company', NULL, '2025-05-04 09:22:37', '2025-05-04 09:22:37'),
(6, 'Júlia', 'julia@julia.com', NULL, '$2y$12$7Eb6bgKxoKV1vPGqfzax1u5NJNZdxaw1KYfByOqD83mrD1WsxItQ2', 'user', NULL, '2025-05-04 13:59:06', '2025-05-04 13:59:06'),
(7, 'Mateo Abraham', 'mateo.abrah@gmail.com', NULL, '$2y$12$bKp1wlMo1dy1cednEa0eK.egzCkUZB8INm5QiqqWPJ7mg75ZHyZXa', 'user', NULL, '2025-05-20 10:04:55', '2025-05-20 11:48:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beers`
--
ALTER TABLE `beers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beers_slug_unique` (`slug`),
  ADD KEY `beers_brewery_id_foreign` (`brewery_id`),
  ADD KEY `beers_created_by_foreign` (`created_by`);

--
-- Indices de la tabla `beer_categories`
--
ALTER TABLE `beer_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `beer_favorites`
--
ALTER TABLE `beer_favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beer_favorites_user_id_beer_id_unique` (`user_id`,`beer_id`);

--
-- Indices de la tabla `breweries`
--
ALTER TABLE `breweries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `breweries_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `brewery_beer`
--
ALTER TABLE `brewery_beer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brewery_beer_brewery_id_beer_id_unique` (`brewery_id`,`beer_id`),
  ADD KEY `brewery_beer_beer_id_foreign` (`beer_id`);

--
-- Indices de la tabla `brewery_favorites`
--
ALTER TABLE `brewery_favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brewery_favorites_user_id_brewery_id_unique` (`user_id`,`brewery_id`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_user_id_reviewable_id_reviewable_type_unique` (`user_id`,`reviewable_id`,`reviewable_type`),
  ADD KEY `reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beers`
--
ALTER TABLE `beers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `beer_categories`
--
ALTER TABLE `beer_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `beer_favorites`
--
ALTER TABLE `beer_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `breweries`
--
ALTER TABLE `breweries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `brewery_beer`
--
ALTER TABLE `brewery_beer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `brewery_favorites`
--
ALTER TABLE `brewery_favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beers`
--
ALTER TABLE `beers`
  ADD CONSTRAINT `beers_brewery_id_foreign` FOREIGN KEY (`brewery_id`) REFERENCES `breweries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `breweries`
--
ALTER TABLE `breweries`
  ADD CONSTRAINT `breweries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `brewery_beer`
--
ALTER TABLE `brewery_beer`
  ADD CONSTRAINT `brewery_beer_beer_id_foreign` FOREIGN KEY (`beer_id`) REFERENCES `beers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brewery_beer_brewery_id_foreign` FOREIGN KEY (`brewery_id`) REFERENCES `breweries` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
