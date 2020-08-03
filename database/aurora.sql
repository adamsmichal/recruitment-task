-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Sie 2020, 12:47
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `aurora`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `article_title` tinytext NOT NULL,
  `article_content` text NOT NULL,
  `article_timestamp` int(4) NOT NULL,
  `article_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`article_id`, `article_title`, `article_content`, `article_timestamp`, `article_status`) VALUES
(12, 'Article 1', 'Bacon ipsum dolor amet burgdoggen short loin beef ribs flank ball tip. Alcatra frankfurter doner pork loin, chislic salami venison pastrami bacon ground round shank ham hock shoulder strip steak short loin. Ham hock jerky short loin salami meatloaf pork. Brisket frankfurter alcatra kevin pig, t-bone salami tenderloin ground round drumstick andouille corned beef tri-tip ribeye. Frankfurter cow andouille venison pork. Drumstick pork meatloaf, biltong corned beef ball tip rump ribeye fatback sirloin tongue leberkas. Tongue andouille pancetta frankfurter venison bacon burgdoggen chicken turkey short loin corned beef ribeye.\r\n\r\nBuffalo ribeye salami rump landjaeger shank, chuck pastrami tail. Cupim tenderloin swine beef leberkas bresaola buffalo kielbasa short ribs sirloin turducken jowl shankle pork loin tail. Pig shoulder andouille beef ribs frankfurter tongue. Jerky spare ribs pork chop, pancetta meatball biltong ham burgdoggen chicken frankfurter rump venison jowl shankle. Corned beef buffalo filet mignon ground round tongue kevin brisket pork loin boudin shoulder flank frankfurter shank. Shankle meatloaf swine, chuck spare ribs turducken alcatra flank ground round porchetta biltong ham hock jowl pork chop. Ham hock landjaeger bacon sausage turducken kielbasa doner shoulder cupim.\r\n\r\nHam chislic shoulder porchetta burgdoggen strip steak. T-bone pork chop andouille bresaola rump. Pork chicken shankle beef ribs strip steak pork chop kevin burgdoggen. Biltong turkey buffalo bresaola, short ribs rump leberkas meatloaf pork kielbasa chislic tri-tip.', 1596451457, 0),
(13, 'Article 2', 'Boudin short loin picanha meatloaf t-bone pork pastrami buffalo kevin sausage jowl bacon pig biltong kielbasa. Turducken pork chicken, salami capicola pancetta pork belly pork loin short loin. Frankfurter porchetta pork hamburger. Leberkas sirloin pig, buffalo bacon alcatra bresaola meatball porchetta biltong flank landjaeger. Rump chislic meatball swine ground round, chicken doner bacon. Hamburger chuck sirloin, corned beef ham hock swine cow andouille chislic bacon pancetta.\r\n\r\nPig tenderloin landjaeger ribeye. Biltong t-bone picanha, hamburger pork chop swine burgdoggen shankle pork belly shank shoulder andouille leberkas. Turducken chislic cupim capicola, porchetta short loin tri-tip bresaola pork loin drumstick doner. Sausage pork loin porchetta shankle short loin burgdoggen doner tongue bresaola salami strip steak jerky alcatra swine leberkas. Ham ribeye pork chop spare ribs pig. Cow chislic turducken jowl kielbasa doner meatball boudin pastrami swine sausage turkey picanha.\r\n\r\nDoes your lorem ipsum text long for something a little meatier? Give our generator a try… it’s tasty', 1596451474, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` tinytext NOT NULL,
  `user_email` tinytext NOT NULL,
  `user_password` longtext NOT NULL,
  `salt` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `salt`) VALUES
(40, 'admin', 'admin@admin', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
