-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 10 Lut 2020, 12:20
-- Wersja serwera: 5.5.41-MariaDB
-- Wersja PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `so586_ciacho`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Adresaci`
--

CREATE TABLE `Adresaci` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nazwisko` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `adres` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `kodpocztowy` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `miasto` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telefon` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `nr_transakcji` varchar(7) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Dostawa`
--

CREATE TABLE `Dostawa` (
  `id` int(11) NOT NULL,
  `typ` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `koszt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Dostawa`
--

INSERT INTO `Dostawa` (`id`, `typ`, `koszt`) VALUES
(1, 'Przesyłka kurierska', 20),
(2, 'Poczta Polska', 16),
(3, 'Odbiór osobisty', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Klienci`
--

CREATE TABLE `Klienci` (
  `id` int(11) NOT NULL,
  `nazwisko` varchar(50) DEFAULT NULL,
  `imie` varchar(50) DEFAULT NULL,
  `adres` varchar(50) DEFAULT NULL,
  `kodpocztowy` varchar(50) DEFAULT NULL,
  `miasto` varchar(50) DEFAULT NULL,
  `telefon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'https://aleciacho.eu/media/avatary/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Klienci`
--

INSERT INTO `Klienci` (`id`, `nazwisko`, `imie`, `adres`, `kodpocztowy`, `miasto`, `telefon`, `email`, `login`, `avatar`) VALUES
(1, 'Kawalec', 'Szymon', 'Os. Jagiellońskie 22/61', '31-834', 'Kraków', '+48691214087', 'kawalec.szymon@gmail.com', 'skawalec', 'https://aleciacho.eu/media/avatary/748467.jpg'),
(11, '-', 'Admin', '-', '--', '-', '-', '-', 'admin', 'https://aleciacho.eu/media/avatary/default.png'),
(12, 'Kawalec', 'Szymon', 'Os. Jagiellońskie 22/61', '31-834', 'Kraków', '691214087', 'sajgonskyy@gmail.com', 'akademia', 'https://aleciacho.eu/media/avatary/default.png'),
(13, 'Ćwik', 'Zuzanna', 'Miła 19', '32-300', 'Olkusz', '609340945', 'zuzannafull@gmail.com', 'latajacyjednorozec97', 'https://aleciacho.eu/media/avatary/424583.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Komentarze`
--

CREATE TABLE `Komentarze` (
  `id` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `komentarz` text,
  `ocena` int(11) DEFAULT NULL,
  `id_towaru` int(11) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Komentarze`
--

INSERT INTO `Komentarze` (`id`, `data`, `komentarz`, `ocena`, `id_towaru`, `login`) VALUES
(1, '2019-02-11 00:00:00', 'Super pyszny torcik, gorąco polecam!', 5, 1, 'skawalec'),
(2, '2019-02-10 00:00:00', 'Supi!', 4, 1, 'admin'),
(3, '2019-02-06 10:16:09', 'Ujdzie...', 2, 2, 'skawalec'),
(4, '2019-10-06 15:28:24', 'Fajne', 5, 16, 'skawalec'),
(5, '2019-10-12 11:09:16', 'BARDZO SUPER!', 5, 15, 'latajacyjednorozec97'),
(6, '2019-10-12 11:09:49', 'Nie przypomina letnich koszul z polotem, ale i tak dobre..', 4, 6, 'latajacyjednorozec97');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Koszyk`
--

CREATE TABLE `Koszyk` (
  `id` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `id_towaru` int(11) DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Koszyk`
--

INSERT INTO `Koszyk` (`id`, `login`, `id_towaru`, `ilosc`) VALUES
(56, 'skawalec', 17, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Magazyn`
--

CREATE TABLE `Magazyn` (
  `id` int(11) NOT NULL,
  `id_towaru` int(11) DEFAULT NULL,
  `dostepnosc` int(11) DEFAULT NULL,
  `sprzedanych` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Magazyn`
--

INSERT INTO `Magazyn` (`id`, `id_towaru`, `dostepnosc`, `sprzedanych`) VALUES
(1, 1, 5, 0),
(2, 2, 3, 2),
(3, 3, 2, 0),
(4, 4, 5, 2),
(5, 5, 2, 1),
(6, 6, 11, 7),
(7, 7, 10, 1),
(8, 8, 6, 1),
(9, 9, 3, 0),
(10, 10, 5, 0),
(11, 11, 6, 0),
(12, 12, 11, 0),
(13, 13, 7, 0),
(14, 14, 15, 2),
(15, 15, 7, 7),
(16, 16, 21, 4),
(17, 17, 9, 3),
(18, 18, 7, 2),
(19, 19, 11, 1),
(20, 20, 11, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Opisy`
--

CREATE TABLE `Opisy` (
  `id` int(11) NOT NULL,
  `id_towaru` int(11) DEFAULT NULL,
  `opis` text,
  `waga` int(11) DEFAULT NULL,
  `alergeny` varchar(255) DEFAULT NULL,
  `grafika` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Opisy`
--

INSERT INTO `Opisy` (`id`, `id_towaru`, `opis`, `waga`, `alergeny`, `grafika`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1500, 'Brak', 'https://aleciacho.eu/media/produkty/293324060.jpg'),
(2, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1024, 'mak', 'https://aleciacho.eu/media/produkty/288873968.jpg'),
(3, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2000, 'Brak', 'https://aleciacho.eu/media/produkty/131605552.jpg'),
(4, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2500, 'Brak', 'https://aleciacho.eu/media/produkty/678901112.jpg'),
(5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1300, 'Orzechy', 'https://aleciacho.eu/media/produkty/67851934.jpg'),
(6, 6, 'Pyszna babeczka z kremem, który smakiem przypomina letnie koszule z polotem. Najlepiej smakuje z kawą w dobrym towarzystwie.', 75, 'Cytrusy, nabiał ', 'https://aleciacho.eu/media/produkty/567560529.jpeg'),
(7, 7, 'Tarta na kruchym spodzie z nadzieniem jagodowym oraz śmietaną obficie wyłożone sezonowymi owocami.', 600, 'śmietana, jaja, mleko, ', 'https://aleciacho.eu/media/produkty/182127337.jpeg'),
(8, 8, 'Niesamowicie rozpływające się w ustach czekoladowo-orzechowe marzenie z kremem Nutella w roli głównej.', 650, 'orzechy laskowe, mleko, jaja, śmietana', 'https://aleciacho.eu/media/produkty/972317257.jpeg'),
(9, 9, 'Klasyczny biszkopt nasączany lekkim sokiem cytrynowym. ', 750, 'jaja, mleko', 'https://aleciacho.eu/media/produkty/884203186.jpeg'),
(10, 10, 'Kruche ciasto z pysznym cytrynowym kremem, który został zwieńczony malutkimi bezikami', 560, 'jaja, śmietana', 'https://aleciacho.eu/media/produkty/104291239.jpeg'),
(11, 11, ' Ciasto składające się z kruchych blatów ciasta miodowego przełożonych kremem budyniowym i kajmakowym, z dodatkiem orzechów i pszczółek z plastycznej masy czekoladowej.', 730, 'miód, jaja, orzechy', 'https://aleciacho.eu/media/produkty/727631297.jpeg'),
(12, 12, 'Zawijaniec kakaowy to ciasto dla koneserów smaków z dzieciństwa. Lekkie ciasto drożdżowe przekładane kakaem i cukrem każdemu zapewni powrót do domu rodzinnego.', 500, 'jaja, mleko, kakao', 'https://aleciacho.eu/media/produkty/920170919.jpeg'),
(13, 13, 'To prawdziwa bomba orzechowa, strzeżcie się alergicy! Biszkopt przekładany kremem orzechowym z kawałkami nerkowców i migdałów, kremem z orzechów włoskich i laskowych, zwieńczony fistaszkami.', 800, 'jaja, mleko, orzechy', 'https://aleciacho.eu/media/produkty/715301531.jpeg'),
(14, 14, 'Czekoladowe babeczki przełożone musem czekoladowym oraz masą migdałowo-orzechową z prażynkami, zwieńczone czekoladowym ganache. Palce lizać!', 55, 'jaja, kakao, mleko', 'https://aleciacho.eu/media/produkty/631165216.jpeg'),
(15, 15, 'Najbardziej awangardowa babeczka w naszym sklepie, specjał dla szukających wrażeń i nowych doznań czekoladomaniaków. ', 55, 'jaja, lawenda, mleko', 'https://aleciacho.eu/media/produkty/290754464.jpg'),
(16, 16, 'Urodziny? Ślub? Chrzciny? To dla nas nie problem! Specjalnie dla Ciebie spersonalizujemy babeczki pod każdą imprezę okolicznościową.', 45, 'jaja, mleko, migdały', 'https://aleciacho.eu/media/produkty/336175027.jpeg'),
(17, 17, 'Ciasteczka z logotypem systemu ANDROID, także dla użytkowników iOS-a! ', 100, 'jaja, mleko', 'https://aleciacho.eu/media/produkty/914959848.jpeg'),
(18, 18, 'Pierniczki lukrowane nie tyko na Boże Narodzenie', 350, 'jaja, mleko, przyprawa korzenna', 'https://aleciacho.eu/media/produkty/975802863.jpeg'),
(19, 19, 'Makaroniki sprowadzane specjalnie z Francji, oryginalny przepis i składniki z najwyższej półki to właśnie to co sprawia, że są takie wyjątkowe!', 200, 'jaja, mleko, migdały', 'https://aleciacho.eu/media/produkty/178404448.jpeg'),
(20, 20, 'Ciastka czekoladowe z prawdziwą 90% czekoladą!', 250, 'orzechy laskowe, mleko, jaja, śmietana', 'https://aleciacho.eu/media/produkty/979686999.jpeg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Platnosc`
--

CREATE TABLE `Platnosc` (
  `id` int(11) NOT NULL,
  `typ` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `typ2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `koszt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Platnosc`
--

INSERT INTO `Platnosc` (`id`, `typ`, `typ2`, `koszt`) VALUES
(1, 'Przelew tradycyjny', 'Płatność z góry', 0),
(2, 'Gotówka', 'Płatność przy odbiorze', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Szczegoly_transakcji`
--

CREATE TABLE `Szczegoly_transakcji` (
  `id` int(11) NOT NULL,
  `id_towaru` int(11) DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL,
  `nr_transakcji` varchar(7) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Szczegoly_transakcji`
--

INSERT INTO `Szczegoly_transakcji` (`id`, `id_towaru`, `ilosc`, `nr_transakcji`) VALUES
(34, 8, 1, '50X4UPL'),
(35, 5, 1, '50X4UPL'),
(36, 16, 1, 'EISL5W1'),
(37, 16, 1, 'D7WECWI'),
(38, 15, 7, 'YFS11G7'),
(39, 6, 5, 'YFS11G7'),
(40, 18, 2, 'YFS11G7');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Towary`
--

CREATE TABLE `Towary` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(256) DEFAULT NULL,
  `kategoria` varchar(50) DEFAULT NULL,
  `cena` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Towary`
--

INSERT INTO `Towary` (`id`, `nazwa`, `kategoria`, `cena`) VALUES
(1, 'Tort kakaowo-truskawkowy', 'Torty', 59),
(2, 'Tort z wiśnią i makiem', 'Torty', 79),
(3, 'Tort owocowy', 'Torty', 99),
(4, 'Tort kakaowy', 'Torty', 39),
(5, 'Tort orzechowy', 'Torty', 49),
(6, 'Babeczka z kremem cytrynowym', 'Babeczki', 6),
(7, 'Tarta z owocami sezonowymi', 'Ciasta', 15),
(8, 'Nutellowe szaleństwo', 'Ciasta', 23),
(9, 'Biszkopt klasyczny', 'Ciasta', 25),
(10, 'Cytrynowa beza', 'Ciasta', 45),
(11, 'Miodowy raj', 'Ciasta', 48),
(12, 'Zawijaniec kakaowy', 'Ciasta', 28),
(13, 'Orzechowiec', 'Ciasta', 45),
(14, 'Babeczka czekoladowa z ganache', 'Babeczki', 8),
(15, 'Lawendowe serduszko', 'Babeczki', 9),
(16, 'Personalizowane babeczki z dekoracjami cukrowymi', 'Babeczki', 12),
(17, 'Ciastka ANDROID', 'Ciastka', 4),
(18, 'Lukrowane serduszka', 'Ciastka', 12),
(19, 'Makaroniki owocowe', 'Ciastka', 25),
(20, 'Ciastka ', 'Ciastka', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Transakcje`
--

CREATE TABLE `Transakcje` (
  `id` int(11) NOT NULL,
  `nr_transakcji` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `dostawa` int(11) DEFAULT NULL,
  `platnosc` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Transakcje`
--

INSERT INTO `Transakcje` (`id`, `nr_transakcji`, `login`, `dostawa`, `platnosc`, `data`) VALUES
(22, '50X4UPL', 'skawalec', 0, 0, '2019-09-27 14:56:53'),
(23, 'EISL5W1', 'skawalec', 0, 0, '2019-09-27 15:00:54'),
(24, 'D7WECWI', 'skawalec', 0, 0, '2019-09-27 15:05:54'),
(25, 'YFS11G7', 'latajacyjednorozec97', 0, 0, '2019-10-12 11:08:46');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Userzy`
--

CREATE TABLE `Userzy` (
  `id` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `haslo` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Userzy`
--

INSERT INTO `Userzy` (`id`, `login`, `haslo`, `token`) VALUES
(1, 'skawalec', '$2y$10$cHhZNdLq2V/RqRXatTzsoeAEM5Mxchj.iKACxRvn.dNcEvxH64YUi', NULL),
(11, 'admin', '$2y$10$CcEgmfeL6Ui7PClSNxJXVu2FsXjmGfnYTMLDsK6ebNIdhD.KtBK66', NULL),
(12, 'akademia', '$2y$10$2pg1.ccNaavTmytAQwdXaulJcptCHaJZ2UTKjPSpQGhMSthga68H6', NULL),
(13, 'latajacyjednorozec97', '$2y$10$FP3Zz3qOBzzTNBdY1P054umHnSe/udh4iF7w02vUGJbObiDN3mWlO', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Adresaci`
--
ALTER TABLE `Adresaci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Dostawa`
--
ALTER TABLE `Dostawa`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Klienci`
--
ALTER TABLE `Klienci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Komentarze`
--
ALTER TABLE `Komentarze`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Koszyk`
--
ALTER TABLE `Koszyk`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Magazyn`
--
ALTER TABLE `Magazyn`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Opisy`
--
ALTER TABLE `Opisy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Platnosc`
--
ALTER TABLE `Platnosc`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Szczegoly_transakcji`
--
ALTER TABLE `Szczegoly_transakcji`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Towary`
--
ALTER TABLE `Towary`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Transakcje`
--
ALTER TABLE `Transakcje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `Userzy`
--
ALTER TABLE `Userzy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Adresaci`
--
ALTER TABLE `Adresaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `Dostawa`
--
ALTER TABLE `Dostawa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `Klienci`
--
ALTER TABLE `Klienci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `Komentarze`
--
ALTER TABLE `Komentarze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `Koszyk`
--
ALTER TABLE `Koszyk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT dla tabeli `Magazyn`
--
ALTER TABLE `Magazyn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `Opisy`
--
ALTER TABLE `Opisy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `Platnosc`
--
ALTER TABLE `Platnosc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `Szczegoly_transakcji`
--
ALTER TABLE `Szczegoly_transakcji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `Towary`
--
ALTER TABLE `Towary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `Transakcje`
--
ALTER TABLE `Transakcje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `Userzy`
--
ALTER TABLE `Userzy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
