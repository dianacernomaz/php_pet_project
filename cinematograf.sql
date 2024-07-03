-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 11 2023 г., 22:15
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cinematograf`
--

-- --------------------------------------------------------

--
-- Структура таблицы `actorii`
--

CREATE TABLE `actorii` (
  `ID_actor` int(11) NOT NULL,
  `Nume` varchar(30) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  `Data_nasterii` date NOT NULL,
  `Tara_origine` varchar(30) NOT NULL,
  `ID_film` int(11) NOT NULL,
  `Poza` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `actorii`
--

INSERT INTO `actorii` (`ID_actor`, `Nume`, `Prenume`, `Data_nasterii`, `Tara_origine`, `ID_film`, `Poza`) VALUES
(2, 'Freeman', 'Morgan', '1937-06-01', 'SUA', 2, 'img/actor2.jpg'),
(3, 'Travolta	', 'John', '1954-02-18', 'SUA', 3, 'img/actor3.jpg'),
(6, 'Watson', 'Emma', '1998-02-10', 'Marea Britanie', 104, 'img/actor6.jpg'),
(12, 'Emma', 'Roberts', '1989-12-12', 'SUA', 12, 'img/actor7.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `cinematografe`
--

CREATE TABLE `cinematografe` (
  `ID_cinematograf` int(11) NOT NULL,
  `Denumirea` varchar(30) NOT NULL,
  `Adresa` varchar(50) NOT NULL,
  `Oras` varchar(30) NOT NULL,
  `Stat` varchar(30) NOT NULL,
  `Capacitate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `cinematografe`
--

INSERT INTO `cinematografe` (`ID_cinematograf`, `Denumirea`, `Adresa`, `Oras`, `Stat`, `Capacitate`) VALUES
(1, 'CineMax', 'Str. Libertății 23', 'București', 'Romania', 200),
(2, 'Star Cinema', 'Str. Mihai Viteazu 7', 'Cluj-Napoca', 'Romania', 150),
(4, 'FilmPlex', 'Str. Unirii 11', 'Iasi', 'Romania', 210),
(5, 'Patria Loteanu', 'Bd. Stefan cel Mare, 19', 'Chisinau', 'Republica Moldova', 210),
(6, 'Cineplex Mall', 'Arborilor, 21 Shopping Malldova', 'Chisinau', 'Republica Moldova', 300);

-- --------------------------------------------------------

--
-- Структура таблицы `filme`
--

CREATE TABLE `filme` (
  `ID_film` int(11) NOT NULL,
  `Titlu` varchar(30) NOT NULL,
  `Regizor` varchar(30) NOT NULL,
  `An_lansare` int(11) NOT NULL,
  `Gen` varchar(20) NOT NULL,
  `Durata` int(11) NOT NULL,
  `Limba` varchar(20) NOT NULL,
  `ID_cinematograf` int(11) NOT NULL,
  `Poster` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `filme`
--

INSERT INTO `filme` (`ID_film`, `Titlu`, `Regizor`, `An_lansare`, `Gen`, `Durata`, `Limba`, `ID_cinematograf`, `Poster`) VALUES
(2, 'The Shawshank Redemption', 'Frank Smith', 1994, 'Drama', 142, 'English', 102, 'img/film1.jpeg'),
(5, 'Pulp Fiction', 'Quentin Folly', 1994, 'Crime', 154, 'English', 101, 'img/film3.jpg'),
(6, 'The Dark Knight', 'Christopher Davis', 2008, 'Action', 152, 'English', 103, 'img/film4.jpg'),
(15, 'Home Alone', 'Chris Columbus', 1990, 'comedie', 167, 'english', 2, 'img/film6.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `recenzii`
--

CREATE TABLE `recenzii` (
  `ID_recenzie` int(11) NOT NULL,
  `ID_film` int(11) NOT NULL,
  `Data_recenziei` date NOT NULL,
  `Scor` int(11) NOT NULL,
  `Text_recenzie` text NOT NULL,
  `ID_spectator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `recenzii`
--

INSERT INTO `recenzii` (`ID_recenzie`, `ID_film`, `Data_recenziei`, `Scor`, `Text_recenzie`, `ID_spectator`) VALUES
(1, 1, '2023-10-25', 9, 'Foarte bun film.', 101),
(2, 2, '2023-10-24', 9, 'O capodoperă.', 102),
(3, 3, '2023-10-26', 8, 'Un film interesant.', 103),
(5, 5, '2023-10-24', 7, 'Un clasic.', 102),
(6, 1, '2023-10-09', 3, 'Nu mi-a placut!', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `spectatori`
--

CREATE TABLE `spectatori` (
  `ID_spectator` int(11) NOT NULL,
  `Nume` varchar(30) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  `Data_nasterii` date NOT NULL,
  `Adresa` varchar(50) NOT NULL,
  `Nr_telefon` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `spectatori`
--

INSERT INTO `spectatori` (`ID_spectator`, `Nume`, `Prenume`, `Data_nasterii`, `Adresa`, `Nr_telefon`) VALUES
(101, 'Popescu', 'Ana', '1990-05-15', 'Str. Rozelor 3, București', 69162556),
(102, 'Ionescu', 'Vasile', '1985-03-22', 'Str. Trandafirilor 5, Cluj-Napoca', 68705151),
(104, 'Radu', 'Andrei', '1987-12-03', 'Str. Unirii 7, Iași', 60442466),
(105, 'Radu', 'Elena', '1995-08-20', 'Str. Independenței 9, Brașov', 78561234),
(110, 'Diana ', '', '2023-12-30', 'str.Florilor', 78675656);

-- --------------------------------------------------------

--
-- Структура таблицы `utilizatori`
--

CREATE TABLE `utilizatori` (
  `ID_utilizator` int(11) NOT NULL,
  `ID_spectator` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Parola` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `utilizatori`
--

INSERT INTO `utilizatori` (`ID_utilizator`, `ID_spectator`, `Username`, `Parola`) VALUES
(0, 110, 'diana', '$2y$10$K7ZhqJS09IP3W6Z36QqmYOh/7wyLrmYh3MtQcMrBml6AF4AjVIfQ.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `actorii`
--
ALTER TABLE `actorii`
  ADD PRIMARY KEY (`ID_actor`);

--
-- Индексы таблицы `cinematografe`
--
ALTER TABLE `cinematografe`
  ADD PRIMARY KEY (`ID_cinematograf`);

--
-- Индексы таблицы `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`ID_film`);

--
-- Индексы таблицы `recenzii`
--
ALTER TABLE `recenzii`
  ADD PRIMARY KEY (`ID_recenzie`);

--
-- Индексы таблицы `spectatori`
--
ALTER TABLE `spectatori`
  ADD PRIMARY KEY (`ID_spectator`);

--
-- Индексы таблицы `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`ID_utilizator`),
  ADD KEY `ID_spectator` (`ID_spectator`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `actorii`
--
ALTER TABLE `actorii`
  MODIFY `ID_actor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `cinematografe`
--
ALTER TABLE `cinematografe`
  MODIFY `ID_cinematograf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `filme`
--
ALTER TABLE `filme`
  MODIFY `ID_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `recenzii`
--
ALTER TABLE `recenzii`
  MODIFY `ID_recenzie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `spectatori`
--
ALTER TABLE `spectatori`
  MODIFY `ID_spectator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD CONSTRAINT `utilizatori_ibfk_1` FOREIGN KEY (`ID_spectator`) REFERENCES `spectatori` (`ID_spectator`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
