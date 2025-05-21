-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 15 jan. 2025 à 21:01
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `food_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 0, 'med', 'med@med.com', '12345678', 'test test'),
(2, 1, 'med', 'med@med.com', '12312312', 'bnjr');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'En attente',
  `id_prefixe` varchar(3) NOT NULL DEFAULT 'CMD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `id_prefixe`) VALUES
(7, 1, 'med', '123456', 'med@med.com', 'Virement', 'test, test, test, test, test, test, tets - 1234', 'Teramissu (10 x 2) - Kounafa (13 x 2) - ', 46, '2024-08-21 21:55:56', 'complétée', 'CMD'),
(8, 1, 'med', '123456', 'med@med.com', 'credit card', 'test, test, test, test, test, test, tets - 1234', 'pizza (11 x 1) - Jus au fraise (5 x 1) - ', 16, '2024-08-21 21:57:20', 'En attente', 'CMD'),
(9, 1, 'med', '123456', 'med@med.com', 'credit card', 'test, test, test, test, test, test, tets - 1234', 'Jus au banane (6 x 4) - Panini (12 x 4) - Kounafa (13 x 4) - ', 124, '2024-08-21 22:05:55', 'En attente', 'CMD'),
(10, 1, 'med', '123456', 'med@med.com', 'credit card', 'test, test, test, test, test, test, tets - 1234', 'kouskous (25 x 3) - Makloub (10 x 2) - Jus au fraise (5 x 2) - ', 105, '2024-08-22 20:57:18', 'En attente', 'CMD');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`) VALUES
(1, 'kouskous', 'Plat', 25, 'KOUSKOUS.png'),
(2, 'riz', 'Plat', 10, 'rouz-jerbi.png'),
(3, 'roti', 'dessert', 44, 'roti.jpg'),
(5, 'Spaghetti', 'Plat', 35, 'Spaghetti-2224.jpg'),
(6, 'Makloub', 'Fast food', 10, 'makloub.jpg'),
(7, 'Panini', 'Fast food', 12, 'panini.jpg'),
(8, 'Kounafa', 'Dessert', 13, 'kounafa.jpg'),
(9, 'Teramissu', 'Dessert', 10, 'teramissu.jpg'),
(10, 'Jus au banane', 'Boisson', 6, 'jus banane.jpg'),
(11, 'Jus au fraise', 'Boisson', 5, 'jus fraise.jpeg'),
(12, 'pizza', 'Fast food', 20, 'Supreme_pizza.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'En attente',
  `reservation_start` datetime NOT NULL,
  `reservation_end` datetime NOT NULL,
  `id_prefixe` varchar(3) NOT NULL DEFAULT 'RSV'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `name`, `number`, `email`, `method`, `total_products`, `total_price`, `placed_on`, `payment_status`, `reservation_start`, `reservation_end`, `id_prefixe`) VALUES
(9, 1, 'med', '123456', 'med@med.com', 'Virement', 'kouskous (25 x 1) - pizza (11 x 1) - ', 36, '2024-08-21 21:52:38', 'complétée', '2025-12-22 22:22:00', '0000-00-00 00:00:00', 'RSV'),
(10, 1, 'med', '123456', 'med@med.com', 'credit card', 'riz (10 x 1) - Jus au banane (6 x 1) - ', 16, '2024-08-21 21:53:41', 'En attente', '2025-09-12 12:12:00', '0000-00-00 00:00:00', 'RSV'),
(11, 1, 'med', '123456', 'med@med.com', 'Virement', 'Panini (12 x 1) - Spaghetti (35 x 2) - roti (44 x 2) - ', 170, '2024-08-21 21:54:44', 'complétée', '2025-08-08 23:22:00', '0000-00-00 00:00:00', 'RSV'),
(12, 1, 'med', '123456', 'med@med.com', 'credit card', 'Jus au fraise (5 x 3) - Kounafa (13 x 3) - Makloub (10 x 3) - ', 84, '2024-08-21 22:07:48', 'En attente', '2025-09-12 12:12:00', '0000-00-00 00:00:00', 'RSV');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'med', 'med@med.com', '123456', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'test, test, test, test, test, test, tets - 1234');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
