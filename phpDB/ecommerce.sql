-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 10:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `customer_id`, `created_at`, `modified_at`) VALUES
(1, 23, '2023-09-09 13:09:20', '2023-09-09 13:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Electronics', 'Electronic gadgets and accessories'),
(2, 'Clothing', 'Fashion apparel'),
(3, 'Books', 'Books and educational materials'),
(4, 'Home Appliances', 'Household appliances and equipment'),
(5, 'Toys', 'Children\'s toys and games'),
(6, 'Furniture', 'Home and office furniture'),
(7, 'Jewelry', 'Fashion and fine jewelry'),
(8, 'Sports and Fitness', 'Sporting goods and fitness equipment'),
(9, 'Beauty and Personal Care', 'Cosmetics and personal care products'),
(10, 'Food and Beverages', 'Groceries and beverages'),
(11, 'Home Decor', 'Decorative items for your home');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `password_hash`) VALUES
(1, 'John', 'Doe', 'john@example.com', 'password123', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(2, 'Jane', 'Smith', 'jane@example.com', 'securepassword', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(3, 'Alice', 'Johnson', 'newemail@example.com', 'securepass123', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(4, 'Bob', 'Smith', 'bob@example.com', 'strongpassword', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(5, 'Eva', 'Davis', 'eva@example.com', 'mypassword', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(6, 'Michael', 'Brown', 'michael@example.com', 'password12345', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(7, 'Sophia', 'Lee', 'sophia@example.com', 'sophiapass', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(8, 'Daniel', 'Wilson', 'daniel@example.com', 'wilson123', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(9, 'Olivia', 'Moore', 'olivia@example.com', 'moorepass', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(10, 'William', 'Martinez', 'william@example.com', 'will123', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(11, 'Mia', 'Taylor', 'mia@example.com', 'miapassword', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(12, 'James', 'Harris', 'james@example.com', 'jamespass', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(13, 'Ava', 'Clark', 'ava@example.com', 'avapassword', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(14, 'Benjamin', 'Lewis', 'benjamin@example.com', 'benjamin123', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(15, 'Emma', 'Walker', 'emma@example.com', 'emmapass', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(16, 'Liam', 'White', 'liam@example.com', 'liampassword', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(17, 'Chloe', 'Turner', 'chloe@example.com', 'chloepass', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(18, 'Elijah', 'Smith', 'elijah@example.com', 'elijah123', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(19, 'Charlotte', 'Garcia', 'charlotte@example.com', 'charlottepass', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(20, 'Henry', 'Anderson', 'henry@example.com', 'henrypass123', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(21, 'Amelia', 'Hall', 'amelia@example.com', 'ameliapass', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(22, 'Mason', 'Johnson', 'mason@example.com', 'masonpassword', '$2a$12$0ZK1gYKSTeQ8w4ZT.z48r.b6z7ZLbqOzYQIoxW3T5guIScTzEq6qy'),
(23, 'REYHAN', 'LUYAI', 'reyhanluyai@gmail.com', '', '$2y$10$Q0sruvxxXYg9W3OK.c6LlOe8DFRPYnwL7XvW3sd/VGd2w0dNdLuBa');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_amount`) VALUES
(1, 1, '2023-09-06 17:57:53', 799.98),
(2, 2, '2023-09-06 17:57:53', 69.98),
(3, 1, '2023-09-06 18:03:37', 199.99),
(4, 2, '2023-09-06 18:03:37', 99.95),
(5, 3, '2023-09-06 18:03:37', 149.75),
(6, 4, '2023-09-06 18:03:37', 239.50),
(7, 5, '2023-09-06 18:03:37', 79.99),
(8, 1, '2023-09-06 18:03:37', 129.99),
(9, 6, '2023-09-06 18:03:37', 299.00),
(10, 7, '2023-09-06 18:03:37', 49.99),
(11, 8, '2023-09-06 18:03:37', 179.95),
(12, 9, '2023-09-06 18:03:37', 219.80),
(13, 10, '2023-09-06 18:03:37', 159.99),
(14, 11, '2023-09-06 18:03:37', 89.75),
(15, 12, '2023-09-06 18:03:37', 109.50),
(16, 13, '2023-09-06 18:03:37', 399.99),
(17, 14, '2023-09-06 18:03:37', 59.95),
(18, 5, '2023-09-06 18:07:44', 149.99),
(19, 23, '2023-09-09 17:00:05', 0.00),
(20, 23, '2023-09-09 17:03:54', 1319.98),
(21, 23, '2023-09-09 17:17:48', 1299.99),
(22, 23, '2023-09-09 17:31:46', 19.99),
(23, 23, '2023-09-09 17:39:47', 19.99),
(24, 23, '2023-09-09 17:40:44', 1299.99),
(25, 23, '2023-09-09 17:44:43', 1299.99),
(26, 23, '2023-09-09 17:48:18', 1299.99),
(27, 23, '2023-09-09 17:48:22', 1299.99),
(28, 23, '2023-09-09 17:49:00', 1299.99),
(29, 23, '2023-09-09 17:51:28', 1299.99),
(30, 23, '2023-09-09 17:52:01', 1299.99),
(31, 23, '2023-09-09 17:57:40', 1299.99),
(32, 23, '2023-09-09 17:57:56', 19.99),
(33, 23, '2023-09-09 18:00:47', 19.99),
(34, 23, '2023-09-09 18:01:09', 12999.99),
(35, 23, '2023-09-09 18:14:36', 12999.99),
(36, 23, '2023-09-09 18:18:21', 12999.99),
(37, 23, '2023-09-09 18:18:58', 12999.99),
(38, 23, '2023-09-09 18:21:18', 1299.99),
(39, 23, '2023-09-09 18:41:08', 7929.89);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `subtotal`) VALUES
(1, 1, 1, 2, 1399.98),
(2, 2, 3, 3, 59.97),
(3, 1, 1, 2, 1399.98),
(4, 2, 3, 3, 59.97),
(5, 3, 4, 1, 49.99),
(6, 4, 8, 2, 599.90),
(7, 5, 12, 1, 109.50),
(8, 6, 15, 2, 59.98),
(9, 7, 6, 1, 49.95),
(10, 8, 18, 3, 149.97),
(11, 9, 7, 1, 29.99),
(12, 10, 10, 4, 79.96),
(13, 11, 5, 2, 79.98),
(14, 11, 14, 1, 49.95),
(15, 19, 2, 30, 38999.70),
(16, 19, 3, 12, 239.88),
(17, 19, 6, 1, 699.99),
(18, 19, 9, 1, 49.99),
(19, 20, 3, 1, 19.99),
(20, 20, 2, 1, 1299.99),
(21, 21, 2, 1, 1299.99),
(22, 22, 3, 1, 19.99),
(23, 24, 2, 1, 1299.99),
(24, 25, 2, 1, 1299.99),
(25, 28, 2, 1, 1299.99),
(26, 30, 2, 1, 1299.99),
(27, 32, 3, 1, 19.99),
(28, 34, 2, 1, 1299.99),
(29, 38, 2, 1, 1299.99),
(30, 39, 2, 6, 7799.94),
(31, 39, 4, 1, 49.99),
(32, 39, 3, 4, 79.96);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category_id`) VALUES
(1, 'Smartphone', 'High-end smartphone', 699.99, 1),
(2, 'Laptop', 'Powerful laptop for work, gaming, and creativity', 1299.99, 1),
(3, 'T-shirt', 'Cotton T-shirt', 19.99, 2),
(4, 'Jeans', 'Slim-fit jeans', 49.99, 2),
(5, 'Python Programming Book', 'Learn Python programming', 39.99, 3),
(6, 'Smartphone X', 'High-end smartphone with advanced features', 699.99, 1),
(7, 'Laptop Pro', 'Powerful laptop for work and gaming', 1299.99, 1),
(8, 'T-shirt (Red)', 'Cotton T-shirt in red color', 19.99, 2),
(9, 'Jeans (Blue)', 'Slim-fit jeans in blue color', 49.99, 2),
(10, 'Python Programming Book', 'Learn Python programming', 39.99, 3),
(11, 'Coffee Maker', 'Drip coffee maker with timer', 49.95, 4),
(12, 'Toy Train Set', 'Battery-powered toy train set', 29.99, 5),
(13, 'Office Desk', 'Wooden office desk with drawers', 299.95, 6),
(14, 'Diamond Necklace', 'Elegant diamond necklace', 999.99, 7),
(15, 'Treadmill', 'High-performance treadmill for fitness', 699.00, 8),
(16, 'Lipstick Set', 'Set of 6 matte lipsticks', 19.99, 9),
(17, 'LED TV', '55-inch LED TV with 4K resolution', 599.95, 1),
(18, 'Soccer Ball', 'Official size and weight soccer ball', 14.99, 8),
(19, 'Fruit Basket', 'Assorted fresh fruits in a basket', 29.99, 10),
(20, 'Running Shoes', 'Running shoes with cushioning', 79.99, 8),
(21, 'Digital Camera', 'High-resolution digital camera', 499.00, 1),
(22, 'Backpack', 'Durable backpack for travel and hiking', 39.95, 6),
(23, 'Earrings', 'Stylish earrings with gemstones', 49.99, 7),
(24, 'Yoga Mat', 'Non-slip yoga mat for exercise', 19.99, 8),
(25, 'Blender', 'High-speed blender for smoothies', 69.95, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `customer_id`, `rating`, `review_text`, `review_date`) VALUES
(1, 1, 1, 5, 'Excellent smartphone, highly recommended!', '2023-09-06 18:10:47'),
(2, 2, 2, 4, 'Great laptop for both work and gaming.', '2023-09-06 18:10:47'),
(3, 3, 3, 5, 'Comfortable and stylish T-shirt.', '2023-09-06 18:10:47'),
(4, 4, 4, 4, 'Nice pair of jeans.', '2023-09-06 18:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`address_id`, `customer_id`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `country`) VALUES
(1, 1, '123 Main St', NULL, 'New York', 'NY', '10001', 'USA'),
(2, 2, '456 Elm St', NULL, 'Los Angeles', 'CA', '90001', 'USA'),
(3, 3, '789 Oak St', NULL, 'Chicago', 'IL', '60601', 'USA'),
(4, 4, '101 Pine St', NULL, 'San Francisco', 'CA', '94101', 'USA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `shipping_addresses_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
