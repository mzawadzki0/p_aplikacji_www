-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Lis 2022, 20:02
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `p_aplikacje_www`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_content` text DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'Strona główna', '<img src=\"img/most11.jpg\">\r\n<img src=\"img/most12.jpg\">\r\n<img src=\"img/most13.jpg\">\r\n<img src=\"img/most14.jpg\">\r\n<img src=\"img/most21.jpg\">\r\n<img src=\"img/most22.jpg\">\r\n<img src=\"img/most23.jpg\">\r\n<img src=\"img/most31.jpg\">\r\n<img src=\"img/most32.jpg\">\r\n<img src=\"img/most33.jpg\">\r\n<img src=\"img/most34.jpg\">\r\n<img src=\"img/most41.webp\">\r\n<img src=\"img/most42.webp\">\r\n<img src=\"img/most43.webp\">\r\n<img src=\"img/most44.webp\">\r\n', 1),
(2, 'Nawigacja', '<a href=\"?id=1\">\r\n    <div class=\"nav-item pad\">\r\n        Galeria\r\n    </div>\r\n</a>\r\n<a href=\"?id=7\">\r\n    <div class=\"nav-item pad\">\r\n        Filmy\r\n    </div>\r\n</a>\r\n<a href=\"?id=3\">\r\n    <div class=\"nav-item pad\">\r\n        Most cieśniny Akashishi\r\n    </div>\r\n</a>\r\n<a href=\"?id=4\">\r\n    <div class=\"nav-item pad\">\r\n        Most na wyspie Rousski\r\n    </div>\r\n</a>\r\n<a href=\"?id=5\">\r\n    <div class=\"nav-item pad\">\r\n        Pontchartrain\r\n    </div>\r\n</a>\r\n<a href=\"?id=8\">\r\n    <div class=\"nav-item pad\">\r\n        Kontakt\r\n    </div>\r\n</a>\r\n<a href=\"?id=9\">\r\n    <div class=\"nav-item pad\">\r\n        jQuery\r\n    </div>\r\n</a>\r\n', 1),
(3, 'p1', '<h3>Most cieśniny Akashishi </h3>\r\nPokład Akashi Strait (明石海峡大橋, Akashi Kaikyo Ohashi ? ) Czy most wiszący , z siedzibą w Japonii . Przecina Morze Śródlądowe Seto, aby połączyć Kobe , na głównej wyspie Honsiu , z miastem Awaji na wyspie o tej samej nazwie . Jego przęsło środkowe jest najdłuższe na świecie i ma 1991  m . Całkowita długość mostu wynosi 3911  m .\r\n<br><br>\r\nMost ten jest ostatnim elementem sieci łączącej cztery główne wyspy Japonii: Honshū , Hokkaidō , Kyūshū i Shikoku . \r\n<hr>\r\n<h4>Geneza księgi</h4>\r\nOkoło 1930 r. Chujiro Haraguchi, który był wówczas inżynierem w Ministerstwie Spraw Wewnętrznych (później został burmistrzem Kobe ), zaproponował połączenie dwóch wysp, Honsiu i Sikoku, mostem wiszącym. W tym czasie japońskie finanse i techniki budowlane były niewystarczające.\r\n<br><br>\r\nPrzed wybudowaniem mostu pasażerowie musieli korzystać z promów, aby przeprawić się przez Cieśninę Akashi . Ten ostatni jest niebezpiecznym szlakiem morskim, często podlegającym trudnym warunkom pogodowym. W 1955 roku dwa promy rozbijają się w cieśninie podczas burzy, zabijając 168 dzieci. W obliczu szoku spowodowanego tym wydarzeniem, japońskie Ministerstwo Sprzętu i Kolei podjęło ten pomysł w 1959 roku: w 1970 roku utworzono Komisję Mostu Honshū - Shikoku w celu zaprojektowania, budowy i utrzymania dróg i linii kolejowych. Inżynierowie zaproponowali stworzenie trzech odcinków: osi Kojima – Sakaide , która została ukończona w 1988 roku, osi Kobe – Naruto wraz z mostem Akashi-Kaikyo oraz osi Onomichi – Imabari .\r\n<br><br>\r\nPierwotny projekt przewidywał most mieszany (drogowo-kolejowy); zrezygnowano z tej opcji na rzecz 6-pasmowego mostu drogowego . Budowę mostu rozpoczęto w maju 1988 roku . Został otwarty dla ruchu na5 kwietnia 1998 r.. \r\n<hr>\r\n<img src=\"img/most11.jpg\">\r\n<img src=\"img/most12.jpg\">\r\n<img src=\"img/most13.jpg\">\r\n<img src=\"img/most14.jpg\">\r\n<hr>\r\n<h4>Charakterystyka</h4>\r\nAkashi Strait to międzynarodowa trasa wysyłka wykorzystywane przez ponad 1400 statków dziennie; minimalna szerokość tego pasa musi wynosić 1500 metrów. Most ma zatem centralną rozpiętość 1.991 metrów i dwa boczne przęsła 960 metrów , co daje całkowitą długość 3911 metrów. Rozpiętość środkowa miała początkowo mierzyć 1990 metrów; został rozciągnięty o metr w wyniku trzęsienia ziemi w Kobe ,17 stycznia 1995, którego epicentrum znajdowało się pomiędzy dwoma filarami mostu.\r\n<br><br>\r\nMost obsługuje trzy pasy ruchu w każdym kierunku.\r\n<br><br>\r\nKonstrukcja mostu musi być odporna na wiatry o prędkości 80 m/s (prawie 290 km/h ), trzęsienia ziemi o sile 8,5 w skali Richtera oraz prądy morskie o prędkości 4,5 m/s . \r\n<hr>\r\n<h4>Badania tunelu aerodynamicznego</h4>\r\nPonieważ tak duża rozpiętość środkowa zapewnia znaczną odporność na wiatr, zbudowano model mostu, 100 razy mniejszy niż rzeczywisty most, w celu zbadania jego zachowania w tunelu aerodynamicznym. Konstrukcja opracowana na podstawie tych testów powinna wytrzymać wiatry, które wiałyby z prędkością ponad 290 kilometrów na godzinę.\r\n<br><br>\r\nRysując przęsła specjaliści stwierdzili, że określony rodzaj skręcania pokładu podczas pewnych wiatrów może być irytujący: bez tłumienia most pękłby. Dzięki nowym testom w tunelu aerodynamicznym zaprojektowali następnie wzmocnione przęsło, które nie wykazywało tego rezonansu, oraz zamontowali pionowe płyty stabilizacyjne pod środkową taśmą mostu w celu wytłumienia drgań. \r\n', 1),
(4, 'p2', '<h3>Most na wyspie Rousski</h3>\r\nRousski Wyspa Most ( rosyjski  : Русский мост , Rousski większość ) to 1104 m wantowy most , który łączy miasto Władywostoku do Roussky wyspie ( Primorsky Krai , Rosja ). \r\n<hr>\r\n<h4>Historia</h4>\r\nMost ten, wraz z Mostem Zolotoy Rog i Mostem Obniżonym, zostały wybudowane w ramach programu przygotowania miasta Władywostok do szczytu APEC (Azja-Pacyfik Współpracy Gospodarczej ) w 2012 roku. Projekt polegał na stworzeniu połączenia autostradowego między lotniskiem Knevichi a Wyspą Rousskiego , gdzie miał się odbyć szczyt APEC. \r\n<hr>\r\n<img src=\"img/most21.jpg\">\r\n<img src=\"img/most22.jpg\">\r\n<img src=\"img/most23.jpg\">\r\n<hr>\r\n<h4>Informacje techniczne</h4>\r\nKonstrukcja o długości 3100 metrów łączy Władywostok z Wyspą Roussky przez Półwysep Sapiorny na Dalekim Wschodzie Rosji . Do czasu otwarcia mostu Yavuz Sultan Selim w Stambule w 2015 roku był to najdłuższy most wantowy na świecie, mający 1104  m między dwoma pylonami. Jego płyta postojowa znajduje się 70 metrów nad powierzchnią cieśniny wschodniego Bosforu .\r\n<br><br>\r\nMost autostradowy 2×2 składa się z pylonów o wysokości 320  m, na których połączonych jest 168 lin odciągowych i 103 ortotropowych kesonów stalowych , które tworzą pokład. Został on zbudowany w ekstremalnych warunkach temperaturowych w zakresie od 37  ° C latem do -31  ° C zimowym . \r\n<hr>\r\n<h4>Budowa</h4>\r\nPrzeprowadzają go rosyjskie firmy SK Most i Mostovik między 3 września 2008 i 12 kwietnia 2012. Ostatni element głównego przęsła o długości 12 metrów ułożono w nocy z 11 na 1112 kwietnia.\r\n<br><br>\r\n2 lipca 2012, most został zainaugurowany przez premiera Dmitrija Miedwiediewa i otwarty dla ruchu drogowego1 st sierpieńnastępujący. Jego koszt to 33,9 mld rubli (867 mln euro )\r\n', 1),
(5, 'p3', '<h3>Grobla nad jeziorem Pontchartrain</h3>\r\nGrobli jeziora Pontchartrain , Lake Pontchartrain Causeway w języku angielskim , jest rampa składa się z dwóch równoległych mostów . Te dwa mosty przecinają jezioro Pontchartrain w południowej Luizjanie w Stanach Zjednoczonych . Jest to piąty najdłuższy most drogowy na świecie o długości 38 422  km (23 mil). Mosty są podparte ponad 9 000 pali betonowych.\r\n<br><br>\r\nMost prowadzi na południe do Metairie w Luizjanie , na przedmieściach Nowego Orleanu , i na północ do Mandeville , również Luizjany. \r\n<hr>\r\n<h4>Historyczny</h4>\r\nDroga była pierwotnie w 1956 roku zbudowana z pojedynczego dwupasmowego mostu. W 1969 roku otwarto drugi dwupasmowy most równoległy do ​​pierwotnego i nieco dłuższy. Grobla jeziora Pontchartrain zawsze była płatną drogą. Do 1999 roku opłata za przejazd pobierana była przy każdym wejściu na most. Aby jednak poprawić ruch po stronie południowej, południowa opłata została przeniesiona na północ, przy wyjściu z mostu. Opłata za przejazd w wysokości 1,5  USD w każdą stronę została zwiększona do 3  USD tylko w przypadku samochodów jadących na południe.\r\n<br><br>\r\nOtwarcie grobli znacznie poprawiło standard życia w małych miasteczkach po północnej stronie jeziora Pontchartrain. Mieszkańcy mogli w ten sposób dostać się do Nowego Orleanu .\r\n<br><br>\r\nW następstwie huraganu Katrina dalej29 sierpnia 2005liczne filmy pokazały uszkodzenia mostu, głównie wizualne, przy czym fundamenty konstrukcji pozostały nienaruszone. Ponieważ autostrada I-10 Twin Spans została poważnie uszkodzona, chodnik był używany jako główna trasa dla ekip ratowniczych do Nowego Orleanu. Po zamknięciu most jest teraz ponownie otwarty dla publiczności.\r\n<br><br>\r\nGrobli Lake Pontchartrain nie należy mylić z Pontchartrain Expressway , jednym z odcinków I-10 ( Interstate 10 ) i US Highway 90 w centrum Nowego Orleanu. \r\n<hr>\r\n<h4>Charakterystyka</h4>\r\n<img src=\"img/most31.jpg\">\r\n<img src=\"img/most32.jpg\">\r\n<img src=\"img/most33.jpg\">\r\n<img src=\"img/most34.jpg\">\r\n', 1),
(6, 'Nagłówek', '<a href=\"?id=1\" >\r\n    <div id=\"icon\">\r\n        <img src=\"img/icon.png\">\r\n    </div>\r\n</a>\r\n<div>\r\n    <h3>Największe mosty świata</h3>\r\n    <h4>Galeria | Lista największych mostów na świecie</h4>\r\n</div>\r\n<div id=\"settings\">\r\n    <div>\r\n        <input type=\"color\" id=\"textcol\" name=\"text\" value=\"#ebebde\">\r\n        <label for=\"text\">Tekst</label>\r\n        <input type=\"color\" id=\"bgcol\" name=\"bg\" value=\"#1a1a1a\">\r\n        <label for=\"bg\">Tło</label>\r\n    </div>\r\n    <div id=\"colswitch\" class=\"pointer\" onclick=\"switchcolors()\">\r\n        Zmień kolor\r\n    </div>\r\n</div>\r\n<div id=\"header-item-right\">\r\n    <div id=\"time\"></div>\r\n    <div id=\"date\"></div>\r\n    <div>\r\n        <a href=\"?p=form.html\">\r\n            Formularz\r\n        </a>\r\n    </div>\r\n    <div>\r\n        <u><a href=\"mailto:macioz5621@gmail.com\">Kontakt</a></u>\r\n    </div>\r\n</div>', 1),
(7, 'Filmy', '<iframe width=\"853\" height=\"480\" src=\"https://www.youtube.com/embed/luUniOv4Me4\" title=\"NAJDŁUŻSZY WISZĄCY MOST NA ŚWIECIE ! || Sky Bridge 721\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n\r\n<iframe width=\"640\" height=\"480\" src=\"https://www.youtube.com/embed/lofQn1xgdVw\" title=\"ニューマチックケーソン工法\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n\r\n<iframe width=\"853\" height=\"480\" src=\"https://www.youtube.com/embed/3Hs1pWRzdIQ\" title=\"Najbardziej SPEKTAKULARNE MOSTY świata #1 // Subiektywne TOP10 !\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n', 1),
(8, 'Kontakt', '<form action=\"\">\r\n    <fieldset>\r\n        Imię:<br>\r\n        <input type=\"text\" id=\"imie\"><br>\r\n        Nazwisko:<br>\r\n        <input type=\"text\" id=\"nazwisko\"><br>\r\n        Komentarz:<br>\r\n        <textarea cols=\"60\" rows=\"5\"></textarea><br><br>\r\n        <input type=\"submit\" value=\"Wyślij\">\r\n    </fieldset>\r\n    </form> \r\n                ', 1),
(9, 'jQuery', '<div id=\"animacjaTestowa1\" class=\"test-block\">\r\n    Kliknij\r\n</div>\r\n<div id=\"animacjaTestowa2\" class=\"test-block\">\r\n    Lub tu kliknij\r\n</div>\r\n', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
