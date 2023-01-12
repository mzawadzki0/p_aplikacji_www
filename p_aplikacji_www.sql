-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Sty 2023, 21:46
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `p_aplikacji_www`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_list`
--

CREATE TABLE `category_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `category_list`
--

INSERT INTO `category_list` (`id`, `parent_id`, `category_name`) VALUES
(1, NULL, 'obiekty'),
(2, 1, 'nieruchomości'),
(3, 2, 'mosty'),
(4, 2, 'budynki'),
(5, 1, 'produkty'),
(6, 1, 'usługi'),
(7, 6, 'bilety'),
(8, 3, 'małe mosty'),
(9, 3, 'duże mosty'),
(10, 12, 'modele'),
(11, 5, 'elektronika'),
(12, 5, 'kolekcje'),
(13, 28, 'obrazy'),
(14, 5, 'odzież'),
(15, 14, 'męskie'),
(16, 14, 'damskie'),
(17, 14, 'koszukli'),
(18, 14, 'czapki'),
(19, 14, 'bluzy'),
(20, 5, 'pamiątki'),
(21, 20, 'kubki'),
(22, 20, 'wisiorki'),
(23, 20, 'długopisy'),
(24, 5, 'zabawki'),
(25, 28, 'pocztówki'),
(26, 20, 'magnesy na lodówkę'),
(27, 12, 'znaczki pocztowe'),
(28, 5, 'grafika'),
(29, 28, 'plakaty'),
(30, 5, 'akcesoria'),
(40, 5, 'AGD');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `category_list_parents_named`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `category_list_parents_named` (
`id` int(10) unsigned
,`parent_id` int(10) unsigned
,`category_name` varchar(30)
,`parent_category_name` varchar(30)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_content` text DEFAULT NULL,
  `status` tinyint(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'Galeria', '<div class=\"article\">\r\n<img src=\"img/most11.jpg\">\r\n<img src=\"img/most12.jpg\">\r\n<img src=\"img/most13.jpg\">\r\n<img src=\"img/most14.jpg\">\r\n<img src=\"img/most21.jpg\">\r\n<img src=\"img/most22.jpg\">\r\n<img src=\"img/most23.jpg\">\r\n<img src=\"img/most31.jpg\">\r\n<img src=\"img/most32.jpg\">\r\n<img src=\"img/most33.jpg\">\r\n<img src=\"img/most34.jpg\">\r\n<img src=\"img/most41.webp\">\r\n<img src=\"img/most42.webp\">\r\n<img src=\"img/most43.webp\">\r\n<img src=\"img/most44.webp\">\r\n</div>', 1),
(2, 'Nawigacja', '<a href=\"?\">\r\n    <div class=\"nav-item pad\">\r\n        Strona główna\r\n    </div>\r\n</a>\r\n<a href=\"?shop\">\r\n    <div class=\"nav-item pad\">\r\n        Sklep\r\n    </div>\r\n</a>\r\n<a href=\"?page=1\">\r\n    <div class=\"nav-item pad\">\r\n        Galeria\r\n    </div>\r\n</a>\r\n<a href=\"?page=7\">\r\n    <div class=\"nav-item pad\">\r\n        Filmy\r\n    </div>\r\n</a>\r\n<a href=\"?page=3\">\r\n    <div class=\"nav-item pad\">\r\n        Most cieśniny Akashishi\r\n    </div>\r\n</a>\r\n<a href=\"?page=4\">\r\n    <div class=\"nav-item pad\">\r\n        Most na wyspie Rousski\r\n    </div>\r\n</a>\r\n<a href=\"?page=5\">\r\n    <div class=\"nav-item pad\">\r\n        Pontchartrain\r\n    </div>\r\n</a>\r\n<a href=\"?contact_form\">\r\n    <div class=\"nav-item pad\">\r\n        Kontakt\r\n    </div>\r\n</a>', 1),
(3, 'p1', '<div class=\"article\">\r\n<h3>Most cieśniny Akashishi </h3>\r\nPokład Akashi Strait (明石海峡大橋, Akashi Kaikyo Ohashi ? ) Czy most wiszący , z siedzibą w Japonii . Przecina Morze Śródlądowe Seto, aby połączyć Kobe , na głównej wyspie Honsiu , z miastem Awaji na wyspie o tej samej nazwie . Jego przęsło środkowe jest najdłuższe na świecie i ma 1991  m . Całkowita długość mostu wynosi 3911  m .\r\n<br><br>\r\nMost ten jest ostatnim elementem sieci łączącej cztery główne wyspy Japonii: Honshū , Hokkaidō , Kyūshū i Shikoku . \r\n<hr>\r\n<h4>Geneza księgi</h4>\r\nOkoło 1930 r. Chujiro Haraguchi, który był wówczas inżynierem w Ministerstwie Spraw Wewnętrznych (później został burmistrzem Kobe ), zaproponował połączenie dwóch wysp, Honsiu i Sikoku, mostem wiszącym. W tym czasie japońskie finanse i techniki budowlane były niewystarczające.\r\n<br><br>\r\nPrzed wybudowaniem mostu pasażerowie musieli korzystać z promów, aby przeprawić się przez Cieśninę Akashi . Ten ostatni jest niebezpiecznym szlakiem morskim, często podlegającym trudnym warunkom pogodowym. W 1955 roku dwa promy rozbijają się w cieśninie podczas burzy, zabijając 168 dzieci. W obliczu szoku spowodowanego tym wydarzeniem, japońskie Ministerstwo Sprzętu i Kolei podjęło ten pomysł w 1959 roku: w 1970 roku utworzono Komisję Mostu Honshū - Shikoku w celu zaprojektowania, budowy i utrzymania dróg i linii kolejowych. Inżynierowie zaproponowali stworzenie trzech odcinków: osi Kojima – Sakaide , która została ukończona w 1988 roku, osi Kobe – Naruto wraz z mostem Akashi-Kaikyo oraz osi Onomichi – Imabari .\r\n<br><br>\r\nPierwotny projekt przewidywał most mieszany (drogowo-kolejowy); zrezygnowano z tej opcji na rzecz 6-pasmowego mostu drogowego . Budowę mostu rozpoczęto w maju 1988 roku . Został otwarty dla ruchu na5 kwietnia 1998 r.. \r\n<hr>\r\n<img src=\"img/most11.jpg\">\r\n<img src=\"img/most12.jpg\">\r\n<img src=\"img/most13.jpg\">\r\n<img src=\"img/most14.jpg\">\r\n<hr>\r\n<h4>Charakterystyka</h4>\r\nAkashi Strait to międzynarodowa trasa wysyłka wykorzystywane przez ponad 1400 statków dziennie; minimalna szerokość tego pasa musi wynosić 1500 metrów. Most ma zatem centralną rozpiętość 1.991 metrów i dwa boczne przęsła 960 metrów , co daje całkowitą długość 3911 metrów. Rozpiętość środkowa miała początkowo mierzyć 1990 metrów; został rozciągnięty o metr w wyniku trzęsienia ziemi w Kobe ,17 stycznia 1995, którego epicentrum znajdowało się pomiędzy dwoma filarami mostu.\r\n<br><br>\r\nMost obsługuje trzy pasy ruchu w każdym kierunku.\r\n<br><br>\r\nKonstrukcja mostu musi być odporna na wiatry o prędkości 80 m/s (prawie 290 km/h ), trzęsienia ziemi o sile 8,5 w skali Richtera oraz prądy morskie o prędkości 4,5 m/s . \r\n<hr>\r\n<h4>Badania tunelu aerodynamicznego</h4>\r\nPonieważ tak duża rozpiętość środkowa zapewnia znaczną odporność na wiatr, zbudowano model mostu, 100 razy mniejszy niż rzeczywisty most, w celu zbadania jego zachowania w tunelu aerodynamicznym. Konstrukcja opracowana na podstawie tych testów powinna wytrzymać wiatry, które wiałyby z prędkością ponad 290 kilometrów na godzinę.\r\n<br><br>\r\nRysując przęsła specjaliści stwierdzili, że określony rodzaj skręcania pokładu podczas pewnych wiatrów może być irytujący: bez tłumienia most pękłby. Dzięki nowym testom w tunelu aerodynamicznym zaprojektowali następnie wzmocnione przęsło, które nie wykazywało tego rezonansu, oraz zamontowali pionowe płyty stabilizacyjne pod środkową taśmą mostu w celu wytłumienia drgań. \r\n</div>', 1),
(4, 'p2', '<div class=\"article\">\r\n<h3>Most na wyspie Rousski</h3>\r\nRousski Wyspa Most ( rosyjski  : Русский мост , Rousski większość ) to 1104 m wantowy most , który łączy miasto Władywostoku do Roussky wyspie ( Primorsky Krai , Rosja ). \r\n<hr>\r\n<h4>Historia</h4>\r\nMost ten, wraz z Mostem Zolotoy Rog i Mostem Obniżonym, zostały wybudowane w ramach programu przygotowania miasta Władywostok do szczytu APEC (Azja-Pacyfik Współpracy Gospodarczej ) w 2012 roku. Projekt polegał na stworzeniu połączenia autostradowego między lotniskiem Knevichi a Wyspą Rousskiego , gdzie miał się odbyć szczyt APEC. \r\n<hr>\r\n<img src=\"img/most21.jpg\">\r\n<img src=\"img/most22.jpg\">\r\n<img src=\"img/most23.jpg\">\r\n<hr>\r\n<h4>Informacje techniczne</h4>\r\nKonstrukcja o długości 3100 metrów łączy Władywostok z Wyspą Roussky przez Półwysep Sapiorny na Dalekim Wschodzie Rosji . Do czasu otwarcia mostu Yavuz Sultan Selim w Stambule w 2015 roku był to najdłuższy most wantowy na świecie, mający 1104  m między dwoma pylonami. Jego płyta postojowa znajduje się 70 metrów nad powierzchnią cieśniny wschodniego Bosforu .\r\n<br><br>\r\nMost autostradowy 2×2 składa się z pylonów o wysokości 320  m, na których połączonych jest 168 lin odciągowych i 103 ortotropowych kesonów stalowych , które tworzą pokład. Został on zbudowany w ekstremalnych warunkach temperaturowych w zakresie od 37  ° C latem do -31  ° C zimowym . \r\n<hr>\r\n<h4>Budowa</h4>\r\nPrzeprowadzają go rosyjskie firmy SK Most i Mostovik między 3 września 2008 i 12 kwietnia 2012. Ostatni element głównego przęsła o długości 12 metrów ułożono w nocy z 11 na 1112 kwietnia.\r\n<br><br>\r\n2 lipca 2012, most został zainaugurowany przez premiera Dmitrija Miedwiediewa i otwarty dla ruchu drogowego1 st sierpieńnastępujący. Jego koszt to 33,9 mld rubli (867 mln euro )\r\n</div>\r\n', 1),
(5, 'p3', '<div class=\"article\">\r\n<h3>Grobla nad jeziorem Pontchartrain</h3>\r\nGrobli jeziora Pontchartrain , Lake Pontchartrain Causeway w języku angielskim , jest rampa składa się z dwóch równoległych mostów . Te dwa mosty przecinają jezioro Pontchartrain w południowej Luizjanie w Stanach Zjednoczonych . Jest to piąty najdłuższy most drogowy na świecie o długości 38 422  km (23 mil). Mosty są podparte ponad 9 000 pali betonowych.\r\n<br><br>\r\nMost prowadzi na południe do Metairie w Luizjanie , na przedmieściach Nowego Orleanu , i na północ do Mandeville , również Luizjany. \r\n<hr>\r\n<h4>Historyczny</h4>\r\nDroga była pierwotnie w 1956 roku zbudowana z pojedynczego dwupasmowego mostu. W 1969 roku otwarto drugi dwupasmowy most równoległy do ​​pierwotnego i nieco dłuższy. Grobla jeziora Pontchartrain zawsze była płatną drogą. Do 1999 roku opłata za przejazd pobierana była przy każdym wejściu na most. Aby jednak poprawić ruch po stronie południowej, południowa opłata została przeniesiona na północ, przy wyjściu z mostu. Opłata za przejazd w wysokości 1,5  USD w każdą stronę została zwiększona do 3  USD tylko w przypadku samochodów jadących na południe.\r\n<br><br>\r\nOtwarcie grobli znacznie poprawiło standard życia w małych miasteczkach po północnej stronie jeziora Pontchartrain. Mieszkańcy mogli w ten sposób dostać się do Nowego Orleanu .\r\n<br><br>\r\nW następstwie huraganu Katrina dalej29 sierpnia 2005liczne filmy pokazały uszkodzenia mostu, głównie wizualne, przy czym fundamenty konstrukcji pozostały nienaruszone. Ponieważ autostrada I-10 Twin Spans została poważnie uszkodzona, chodnik był używany jako główna trasa dla ekip ratowniczych do Nowego Orleanu. Po zamknięciu most jest teraz ponownie otwarty dla publiczności.\r\n<br><br>\r\nGrobli Lake Pontchartrain nie należy mylić z Pontchartrain Expressway , jednym z odcinków I-10 ( Interstate 10 ) i US Highway 90 w centrum Nowego Orleanu. \r\n<hr>\r\n<h4>Charakterystyka</h4>\r\n<img src=\"img/most31.jpg\">\r\n<img src=\"img/most32.jpg\">\r\n<img src=\"img/most33.jpg\">\r\n<img src=\"img/most34.jpg\">\r\n</div>', 1),
(6, 'Nagłówek', '<a href=\"?page=1\" >\r\n    <div id=\"icon\">\r\n        <img src=\"img/icon.png\">\r\n    </div>\r\n</a>\r\n<div>\r\n    <h3>Największe mosty świata</h3>\r\n    <h4>Galeria | Lista największych mostów na świecie</h4>\r\n</div>\r\n<div id=\"settings\">\r\n    <div>\r\n        <input type=\"color\" id=\"textcol\" name=\"text\" value=\"#ebebde\">\r\n        <label for=\"text\">Tekst</label>\r\n        <input type=\"color\" id=\"bgcol\" name=\"bg\" value=\"#1a1a1a\">\r\n        <label for=\"bg\">Tło</label>\r\n    </div>\r\n    <div id=\"colswitch\" class=\"pointer\" onclick=\"switchcolors()\">\r\n        Zmień kolor\r\n    </div>\r\n</div>\r\n<div id=\"header-item-right\">\r\n    <div id=\"time\"></div>\r\n    <div id=\"date\"></div>\r\n    <div>\r\n        <a href=\"?contact_form\">\r\n            Formularz\r\n        </a>\r\n    </div>\r\n    <div>\r\n        <u><a href=\"mailto:<?= $email ?>\">Kontakt</a></u>\r\n    </div>\r\n</div>', 1),
(7, 'Filmy', '<div class=\"article\">\r\n<iframe width=\"853\" height=\"480\" src=\"https://www.youtube.com/embed/luUniOv4Me4\" title=\"NAJDŁUŻSZY WISZĄCY MOST NA ŚWIECIE ! || Sky Bridge 721\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n<br>\r\n<iframe width=\"640\" height=\"480\" src=\"https://www.youtube.com/embed/lofQn1xgdVw\" title=\"ニューマチックケーソン工法\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n<br>\r\n<iframe width=\"853\" height=\"480\" src=\"https://www.youtube.com/embed/3Hs1pWRzdIQ\" title=\"Najbardziej SPEKTAKULARNE MOSTY świata #1 // Subiektywne TOP10 !\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>', 1),
(8, 'Kontakt', '<form action=\"\">\r\n    <fieldset>\r\n        Imię:<br>\r\n        <input type=\"text\" id=\"imie\"><br>\r\n        Nazwisko:<br>\r\n        <input type=\"text\" id=\"nazwisko\"><br>\r\n        Komentarz:<br>\r\n        <textarea cols=\"60\" rows=\"5\">NIE DZIAŁA.\r\nPRAWDZIWY FORMULARZ KONTAKTOWY W NAGŁÓWKU STRONY</textarea><br><br>\r\n        <input type=\"submit\" value=\"Wyślij\">\r\n    </fieldset>\r\n    </form> \r\n                ', 1),
(9, 'jQuery', '<div id=\"animacjaTestowa1\" class=\"test-block\">\r\n    Kliknij\r\n</div>\r\n<div id=\"animacjaTestowa2\" class=\"test-block\">\r\n    Lub tu kliknij\r\n</div>\r\n', 1),
(18, 'test', 'Treść tej strony nie powinna się wyświetlać bo strona nieaktywna\r\n(status == 0)', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_list`
--

CREATE TABLE `product_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_expires` datetime DEFAULT NULL,
  `net_price` decimal(12,2) UNSIGNED NOT NULL,
  `vat_percent` decimal(3,0) UNSIGNED NOT NULL DEFAULT 0,
  `units_in_stock` int(10) UNSIGNED NOT NULL,
  `availablity` tinyint(4) NOT NULL DEFAULT 1,
  `category` int(10) UNSIGNED DEFAULT NULL,
  `size` varchar(200) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `product_list`
--

INSERT INTO `product_list` (`id`, `name`, `description`, `date_created`, `date_modified`, `date_expires`, `net_price`, `vat_percent`, `units_in_stock`, `availablity`, `category`, `size`, `photo`) VALUES
(1, 'Obraz do salonu MIASTO NOCĄ MOST NOWOCZESNY 145x45', 'OBRAZ NA PŁÓTNIE CANVAS [145 x 45 cm]\r\nGotowy do zawieszenia na ścianie\r\n\r\nObrazy na płótnie canvas to rodzaj dekoracji dedykowanych dla osób, które chcą cieszyć się nią przez jak najdłuższy czas. Nasze obrazy z pewnością odmienią wnętrze Twojego mieszkania, wniosą powiew unikalności i świeżości. Pasują do wszystkich typów pomieszczeń, wzory które oferujemy dopasujesz do każdego wnętrza dodając mu oryginalnego charakteru i stylu. Co więcej, obrazy na płótnie canvas wykazują również odporność na promienie słoneczne, dlatego mogą służyć nam przez długi czas.\r\n\r\nObraz jest od razu gotowy do zawieszenia : po rozpakowaniu możesz od razu zawiesić dekoracje na ścianie. Każdy obraz z tyłu posiada zamontowaną metalową zawieszkę, która gwarantuje prosty i bezpieczny montaż', '2023-01-07 17:01:39', '2023-01-08 23:04:33', NULL, '119.99', '23', 5000, 1, 13, '145 x 45 cm', 'Screenshot 2023-01-07 at 16-53-33 Obraz do salonu MIASTO NOCĄ MOST NOWOCZESNY 145x45.png'),
(2, 'ROUTER BRIDGE REPEATER ACCESS POINT AP CPE WiFi', 'zewnęrzny access point WiFi (głównie do tworzenia mostów WiFi) 1szt; POE Passthrough N300 SINMAX 5IN1\r\n\r\nporty POE działające jak zasilacz dla kolejnego urządzenia POE, oraz ogromna funkcjonalność oprogramowania w przystępnej cenie (do budowy funkcjonalności mostu należy dokupić drugą sztukę, lub użyć własnego access pointa)\r\n\r\n    5W1 to samodzielny: accesspoint, bridge, router, repeater, switch\r\n    obsługa magistral VLAN (tagowanie i trunk natywny) - kompatybilność z urządzeniami innych producentów w standardzie 802.1Q\r\n    2 porty LAN POE 48V 100/10 MBps z POE Passthrough, w tym jeden port LAN/WAN\r\n    Prędkość łącza aż do 300MBps w paśmie 2.4GHz; standardy pracy b/g/n\r\n    anteny 14dBi 2.4GHz\r\n    w trybie bridge zasięg nawet aż do 5KM (tylko dla topologii point-to-point w sprzyjających warunkach dla dwóch takich samych urządzeń)\r\n    charakterystyka promieniowania kierunkowa, szerokość wiązki 60° w poziomie, 30° w pionie\r\n    możliwość rozszerzania o kolejne elementy systemu (w topologii point-to-multipoint)\r\n    przełączanie pakietów IP z LAN/WAN do WIFi nawet aż do 95Mbps\r\n    Wsparcie dla 64/128-bitowego szyfrowania WPA2-PSK\r\n    klasa wodoodporności IP65\r\n    kanały WiFi outdoor i indoor 0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,5,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255\r\n    bardzo proste zarządzanie przeglądarkowym oprogramowaniem SINMAX w języku angielskim\r\n    kompatybilność z Windows 7, Windows 7 64bit, Windows 8, Windows 8.1, Windows 10, Windows 10, Windows 11, Linux, MAC OS', '2023-01-07 17:05:51', '2023-01-08 23:04:24', NULL, '253.72', '23', 5, 1, 11, '', 'Screenshot 2023-01-07 at 17-06-25 POE PASSTHROUGH BRIDGE ACCESS POINT CPE WiFi MOST.png'),
(3, 'MOST DYFER PRZÓD CAYENNE 7P 3.0 TDI', 'Stan:\r\n\r\njak na foto\r\n\r\n---------------------------------------------------------------------------\r\n\r\nPorsche Cayenne II 7P – 2010 – 3.0 TDI', '2023-01-07 17:07:55', '2023-01-08 23:04:15', NULL, '1500.00', '0', 1, 1, 5, '', 'Screenshot 2023-01-07 at 17-09-11 MOST DYFER PRZÓD CAYENNE 7P 3.0 TDI.png'),
(4, 'Obraz szklany do salonu duży Most Brookliński', 'Cechy naszego produktu:\r\n\r\n    Tafla hartowanego szkła float o grubości 4 mm;\r\n    Warstwa z nadrukiem;\r\n    Warstwa folii ochronnej;\r\n    Ekologiczna metoda wydruku;\r\n    W komplecie otrzymujesz 2 zawieszki montowane z tyłu obrazu;\r\n    Obraz świetnie komponuje się w różnych pomieszczeniach, nadając im nowy lepszy styl;\r\n    Produkt nie potrzebuje żadnych dodatkowych ram i od razu po wyjęciu z pudełka jest gotowy do zawieszenia;\r\n    Nasz obraz to jedna z najnowocześniejszych form dekorowania wnętrz.', '2023-01-07 17:10:04', '2023-01-08 23:03:15', NULL, '298.99', '23', 900, 1, 13, 'Szerokość: 125 cm\r\nWysokość: 50 cm', 'Obraz-szklany-do-salonu-duzy-Most-Brooklinski.jpg'),
(5, 'Zegar na ścianę 80x40 Miasto Most do salonu Obraz', 'Zegar - Obraz z zegarem - Most nocą - Tanel Teemusk\r\n\r\nOferujemy wysokiej jakości obraz z zegarem (przeprowadzamy testy jakości). Dostępne są wszystkie zaprezentowane na naszych aukcjach wzory. Numer ID (katalogowy) obrazu z tej aukcji to: x. Obraz składa się z 3 i posiada rozmiar 80x40 cm. Jego szerokość to: 80, a wysokość to: 40.\r\nCharakterystyka obrazu\r\n\r\n    Płótno z wydrukiem mocowane jest na specjalnie przygotowanej blejtramie. Boki obrazu z zegarem są zadrukowane i stanowią całość z głównym motywem. Dotyczy to obrazów jednoczęściowych, jak i wieloczęściowych (tryptyki, dyptyki itd.). Dzięki temu dodatkowa oprawa nie jest potrzebna.\r\n\r\n     Zegar jest prawdziwy. Działa. Wskazówki chodzą płynnie (nie tykają). Zegar zasilany jest na baterie paluszki.\r\n\r\n    Komplet zawiera całkowicie DARMOWY zestaw mocowań i uchwytów do zamocowania obrazu na ścianie.\r\n\r\n    Prezentowane wzory to miniatury właściwych obrazów. W przesycłe otrzymają Państwo duże obrazy z zegarem prezentujące znakomitą jakość oraz dokładność szczegółów.\r\n\r\n    Gwarantujemy bezpieczeństwo całego procesu zamówienia. Zapraszamy do zakupów.\r\n', '2023-01-07 17:11:35', '2023-01-08 23:02:55', NULL, '93.77', '23', 51, 1, 11, '80x40 cm', 'Zegar-na-sciane-80x40-Miasto-Most-do-salonu-Obraz.jpg'),
(6, 'Tęczowy Most Bujak Montessori Pastel Huśtawka', 'Bujak Artnico kolorowa huśtawka Montessori pastel\r\n\r\n    Bezpieczna i stymulująca przestrzeń, która zachęci dzieci do zabawy i rozwoju!\r\n    Estetycznie wykonany, kolorowy bujak montessori\r\n    Wiele możliwości zastosowania bujaka jako miejsce do zabawy, snu, wypoczynku\r\n\r\nCechy i funkcje:\r\nMontessori w Twoim domu\r\n\r\nZłóż ze swoim dzieckiem niezwykłą zabawkę, która wciągnie je w wir zabawy, wykorzystując jego nieskończone pokłady energii! Konstrukcja oraz możliwości wykorzystania bujaka idealnie wpisują się w filozofię Montessori. Bujak służy do zabawy równoważnej i wspomaga rozwój motoryki. Rozwój motoryczny to proces, który ma kluczowe znaczenie dla nauki czytania, pisania oraz wyrabiania orientacji przestrzennej czy koordynacji wzrokowo-ruchowej. Bujak Artnico zapewni Twojemu dziecku świetną zabawę, dzięki niemu maluch pobudzi swoją wyobraźnię i kreatywność. Produkt zachęca do zabaw ruchowych poprawiając ogólną sprawność fizyczną.', '2023-01-07 17:13:36', '2023-01-08 23:02:30', '2030-03-19 17:13:36', '219.00', '23', 100, 1, 24, '2.84 kg', 'Bujak-Montessori-Pastel-Hustawka-Teczowy-Most.jpg'),
(7, 'Nowy most w Bartoszycach', 'Most przy ul. Bema w kierunku Bezled: Świętego Jana Pawła II Wielkiego Polaka. Rondo na skrzyżowaniu ul. Poniatowskiego z ulicą Słowackiego: Polaka — Prymasa Tysiąclecia Kardynała Stefana Wyszyńskiego. Most w kierunku osiedla Rotmistrza Witolda Pileckiego: Polaka — Prezydenta Rzeczypospolitej Polskiej Lecha Kaczyńskiego. Rondo w kierunku wsi Spytajny z ulicą Gdańską: Świętego Brata Alberta Chmielowskiego. ', '2023-01-07 17:16:05', '2023-01-08 23:02:22', '2024-12-31 17:16:05', '39000.00', '0', 1, 1, 8, '', 'z27935103IHR,Nowy-most-w-Bartoszycach.jpg'),
(8, 'Tomek Przyjaciele Trackmaster Most kroczący GHK84', 'Fisher-Price Tomek i Przyjaciele Most kroczący GHK84\r\n\r\nTen zestaw do zabawy z linii Tomek i Przyjaciele Motorized pozwala odgrywać niezwykle ekscytujące przygody w pokonywanie przepaści za pomocą mostu kroczącego! O, nie! Tor się skończył! Mali inżynierowie mogą wykorzystać ruchomy most, aby pomóc Tomkowi przedostać się na drugą stronę. Gdy Tomek lub inna lokomotywka z napędem wjedzie na tor, most kroczący przeniesie ją bezpiecznie nad przepaścią. Pociągnij za dźwignię, aby odsłonić zapadnię – Tomek może przejechać także pod mostem i pędzić po torze o długości 1,8 m! Zestaw zawiera jedną lokomotywę Tomka z napędem. Łączy się z innymi zestawami Tomek i Przyjaciele Motorized, tworząc nieograniczone możliwości zabawy!\r\n\r\nCechy zestawu:\r\n\r\n    rozbudowany tor Motorized o długości 1,8 metra\r\n    3 możliwe konfiguracje torów\r\n    gdy lokomotywa z napędem wjedzie na most kroczący, zostanie przeniesiona bezpiecznie na drugą stronę\r\n    dzieci mogą też otworzyć ukrytą zapadnię, by umożliwić lokomotywkom przejazd sekretnym tunelem pod mostem\r\n    tor może być ułożony na różne sposoby tworząc zamkniętą pętle\r\n    tor zawiera, zwrotnice, zapadnię, most kroczący, punkt startowy.\r\n    lokomotywa Tomek z napędem\r\n\r\nWymagane baterie do lokomotywy: 2 x AAA (brak w zestawie)\r\n\r\nWiek: 3+', '2023-01-07 17:20:28', '2023-01-08 23:02:11', '2025-01-15 17:20:28', '209.00', '23', 65, 1, 24, '2 kg', 'KOLEJKA-FISHER-TOR-TOMEK-MOST-KROCZACY-GHK84-1-8M-Skala-inna.jpg'),
(9, 'Foto obraz na płótnie Most Brookliński 125x50 cm', 'Foto obraz na płótnie Most Brookliński 125x50 cm\r\nSpecyfikacja obrazu: \r\n\r\n    Materiał: Płótno polycanvas\r\n    Wymiary: szer. 125 cm, wys. 50 cm\r\n    Montaż: W komplecie są dwie zawieszki oraz cztery śrubki do samodzielnego montażu\r\n    Motyw przewodni: Zabytki & architektura\r\n    Kolory przewodni:\r\n    Nr. katalogowy: x\r\n\r\nStawiamy na jakość i ekologie\r\n\r\nObraz drukowany jest cyfrowo w technologii ekosolwent, która jest przyjazna dla środowiska i ludzi, nie tracąc przy tym na jakości i trwałości.', '2023-01-07 17:30:22', '2023-01-08 23:00:57', NULL, '168.99', '23', 9990, 1, 13, '125x50 cm', 'Foto-obraz-na-plotnie-Most-Brooklinski-125x50-cm.jpg'),
(10, 'Most drewniany - Solidny Kolejkowy Zakątek', 'Most drewniany - Solidny Kolejkowy Zakątek\r\n\r\nProducent: Kolejkowy Zakątek \r\n\r\nWyjątkowo solidny i stabilny wiadukt kolejowy w całości wykonany z twardego drewna. W zestawie dwa podjazdy oraz most z jednym przęsłem o wysokości: 6cm odpowiedniej dla poprowadzenia innej linii kolejowej.\r\n\r\nZ przejazdu pod mostem mogą korzystać samochody, piesi lub można stworzyć bezkolizyjne skrzyżowanie tras kolejowych.\r\n\r\nTor z drewna bukowego dobrej jakości.\r\n\r\nDługość zestawu: 42cm.\r\n\r\nPodstawowe dane:\r\n\r\n    Długość w cm ok: 42\r\n    Opakowanie: bez pudełka, sprzedawane luzem\r\n    Zabawka: nowa\r\n\r\nW skład ofery wchodzi:\r\n\r\n    Most\r\n    Podjazdy\r\n\r\nDopasowanie:\r\n\r\nTory pasują do innych systemów drewnianych firm: Brio, Bigjigs, Woodyland, Ikea, Eichhorn, Tesco, Carousel, Maxim, Bino\r\n\r\nChoć wszystkie tory są kompatybilne, dla najlepszego efektu polecamy stosowanie torów jednego producenta', '2023-01-07 17:31:35', '2023-01-08 23:00:48', NULL, '38.00', '23', 24, 1, 24, '42 cm', 'Most-drewniany-Solidny-Kolejkowy-Zakatek.jpg'),
(11, 'Most kolejowy na Łynie', 'Fajne miejsce, ale trzeba uważać, ponieważ jest stare i ryzykowne jest chodzenie po nim?\r\n\r\nNiestety wielu traktuje ten most jako miejsce na selfie, tamując ruch.', '2023-01-07 17:33:01', '2023-01-08 23:00:36', '2023-09-19 17:33:01', '799000.00', '0', 1, 1, 9, '14000x2500 cm', 'Bartoszyce._Most_kolejowy_na_Łynie..jpg'),
(12, 'MOST 5100020K21 30-200 A', 'Półautomat spawalniczy MOST FANMIG J5\r\n\r\n    Urządzenie spełniające wyśrubowane normy europejskie.\r\n    24 m-ce gwarancji dla klienta detalicznego.\r\n    Spawanie w metodach MIG/MAG, TIG Lift Arc, MMA\r\n    Cyfrowy panel sterowania dla precyzyjnych nastaw.\r\n    Przewód masowy oraz przewód elektrodowy.\r\n    Zasilanie 230V, wystarczy zwykłe gniazdko.\r\n    Szeroki zakres prądu spawania MIG/MAG: 30-200A, TIG: 10-180A, MMA: 10-160A.\r\n    Niska masa urządzenia, tylko 9,2KG\r\n    Poręczne wymiary 550x210x410mm.\r\n    Prąd spawania w cyklu pracy: MIG/MAG: 200A 20%, 90A 100%, MMA: 160A 20%, 71,5A 100%.', '2023-01-07 17:42:38', '2023-01-08 22:58:17', NULL, '2105.07', '23', 3, 1, 11, '9.2 kg\r\nWysokość 350 mm\r\nDługość	440 mm\r\nSzerokość 180 mm\r\nDługość kabla masowego 200 cm\r\nDługość przewodu spawalniczego 300 cm', 'Zestaw-spawalniczy-MOST-FANMIG-J5-Marka-MOST.jpg'),
(13, 'Fototapeta MOST MIASTO NOCĄ WIDOK EFEKT 3D 368x254', 'NOWOCZESNA FOTOTAPETA NA FLIZELINIE\r\n\r\nTapeta jest gotowa do montażu : BEZ DOCINANIA / BEZ MARGINESÓW\r\n\r\n    Rozmiar (szerokość x wysokość) : 368 cm x 254 cm\r\n    soczyste i żywe kolory zachowujące intensywna barwę\r\n    wysoka odporność na promienie UV / kolory nie blakną\r\n    fotograficzne odwzorowanie detali / cyfrowa jakość wydruku\r\n    druk metodą lateksową, ekologiczną i bezzapachową\r\n    gruby i trwały materiał, nie rozciąga się pod wpływem kleju\r\n    łatwy i wygodny montaż, klej nakładamy tylko na ścianę\r\n    właściwości maskujące delikatne nierówności ścian\r\n    solidne zabezpieczenie na czas transportu\r\n    specjalny klej i instrukcja montażu [GRATIS]\r\n\r\nDo każdego zamówienia podchodzimy indywidualnie. Fototapeta produkowana jest przez nas dopiero w momencie złożenia zamówienia. Indywidualne podejście do klienta oraz brak masowej produkcji gwarantują najwyższą jakość wykonania ♡\r\n100 % CERTYFIKOWANA FLIZELINA\r\n\r\nFototapety flizelinowe drukowane są na grubym, ekologicznym oraz wytrzymałym podłożu, które gwarantuje wysoką odporność na odkształcenia, rozciąganie oraz innego rodzaju uszkodzenia mechaniczne podczas montażu. Dzięki zastosowaniu najnowocześniejszej technologii druku - tapety charakteryzują się doskonałym nasyceniem i bogactwem kolorów. Fototapety na flizelinie nie blakną wraz z upływem czasu, po latach prezentując się dokładnie tak, jak w dniu zakupu. Materiał wykazuje również cechy izolacyjne - ocieplając i wygłuszając pomieszczenie. Dodatkowo podłoże z włókniny sprawia, że ozdobiona fototapetą ściana oddycha i staje się przyjemna w dotyku. Ze względu na dużą możliwość personalizacji, fototapety flizelinowe można dostosować właściwie do każdego pomieszczenia (tj. sypialnia, salon, biuro, przedpokój, kuchnia, pokój dziecka)\r\n\r\n    Metoda produkcji : ekologiczna\r\n    Wytrzymałość materiału : wysoka\r\n    Technologia druku : HP Latex (druk bezzapachowy i bezpieczny)\r\n    Sposób klejenia : krawędź w krawędź (klej nakładamy tylko na ścianę)\r\n    Wykończenie : półmatowa i gładka powierzchnia (nie błyszczy się / równomiernie odbija promienie słoneczne)', '2023-01-07 17:44:54', '2023-01-08 23:00:21', '2023-08-14 17:46:33', '219.00', '23', 930, 1, 29, '368 cm x 254 cm', 'Fototapeta-MOST-MIASTO-NOCA-WIDOK-EFEKT-3D-368x254.jpg'),
(14, 'LONDYN - Tower Bridge - Most - Magnes na lodówkę', 'Motyw: LONDYN - Tower Bridge - Most\r\n\r\nWymiar: 100 mm x 68 mm\r\n\r\nGrubość: 0.7 mm\r\n\r\nRodzaj: elastyczny\r\n\r\nOpakowanie: foliowe z kodem kreskowym\r\n\r\nnr kat. XXXXXX\r\n\r\nZdjęcia umieszczone na naszych pracach, pochodzą z legalnych źródeł\r\n\r\nProdukt wykonywany na profesjonalnych urządzeniach\r\n\r\nDla odbiorców hurtowych wykonujemy bezpłatne ekspozytory z plexi\r\n\r\nZachęcamy do zapoznania się z naszą ofertą i zapraszamy do współpracy', '2023-01-07 17:47:07', '2023-01-08 23:00:02', NULL, '5.90', '23', 60, 1, 26, '100 mm x 68 mm', 'LONDYN-Tower-Bridge-Most-Magnes-na-lodowke.jpg'),
(15, 'Lego 15254 Łuk Mostek 1X6x2 Szary Jasny (2G)', 'Lego Arch 1 x 6 x 2 - Medium Thick Top without Reinforced Underside\r\n\r\nKOLOR: Jasnoszary - Light Bluish Gray\r\n\r\nElement nowy, zapakowany w woreczek strunowy.', '2023-01-07 17:48:27', '2023-01-08 22:59:54', NULL, '1.00', '0', 1, 1, 24, '', 'Screenshot 2023-01-07 at 17-49-27 LEGO 15254 ŁUK MOSTEK 1x6x2 szary jasny NOWY (2g).png'),
(16, 'London Bridge Koszulka Most Londyński Anglia', 'Koszulka z nadrukiem:\r\n\r\n    Przyjemna w dotyku bawełna Ring-spun\r\n    Pre-shrunk/Dekatyzowana niekurczliwa\r\n    Taśma wzmacniająca na karku i ramionach\r\n    Mankiety rękawów i dół koszulki wykończony podwójnymi szwami\r\n    Brak szwów bocznych\r\n    Prosty krój typu Unisex świetnie sprawdza się jako koszulka męska jak i damska\r\n    100% bawełna (Kolor szary 90% bawełna, 10% poliester)', '2023-01-07 17:49:44', '2023-01-08 22:59:36', NULL, '59.00', '23', 400, 1, 17, 'Waga produktu z opakowaniem jednostkowym 0.25 kg\r\nrozm XL', 'London-Bridge-Koszulka-Most-Londynski-Anglia.jpg'),
(17, 'koszulka M-B Elbląg most zwodzony', 'Męska koszulka wysokiej jakości:\r\n\r\n    Koszulka premium popularnej firmy JHK\r\n    klasyczny krój koszulki typu T-shirt pasuje zarówno dla mężczyzn jak i kobiet\r\n    z grubego materiału, gramatura 190g\r\n    wykonana w 100% z bawełny single jersey, miękka w dotyku i przyjazna dla ciała również w upały\r\n    solidnie uszyta, z podwójnymi szwami na ramionach. Dekolt wykończony bawełnianym, wąskim ściągaczem. Taśma wzmacniająca na karku z tego samego materiału.\r\n    trwały nadruk, o wysokim nasyceniu kolorów, wykonany metodą DTG (druk bezpośredni)', '2023-01-07 17:50:59', '2023-01-08 22:59:03', NULL, '699.00', '23', 100, 1, 17, '0.35 kg', 'koszulka-M-B-Elblag-most-zwodzony.jpg'),
(18, 'Koszulka Krym Most na Krymie rozmiar XL', 'T-shirt z wizerunkiem spalonego mostu na Krymie.\r\n\r\nWielkość nadruku na koszulce \"Krym\"\r\n\r\nSzerokość nadruku na koszulkach różni się w zależności od rozmiaru T-shirtu i wynosi odpowiednio:\r\n\r\n    przy rozmiarze S - 20 cm\r\n    przy rozmiarze M - 23 cm\r\n    przy rozmiarze L, XL, XXL - 26 cm. \r\n\r\nWysokość wzoru jest dobierana proporcjonalnie, jednak nigdy nie przekracza 38 cm. W przypadku dłuższych grafik szerokość nadruku wynika z proporcji przy zachowaniu długości 38 cm.', '2023-01-07 17:52:37', '2023-01-08 22:52:06', NULL, '34.90', '23', 999, 1, 17, 'XL', 'Koszulka-Krym-Most-na-Krymie-rozmiar-XL.jpg'),
(19, 'koszulka M-BU b nie pal za sobą mostów XL', 'Męska koszulka wysokiej jakości:\r\n\r\n    Koszulka premium popularnej firmy JHK\r\n    klasyczny krój koszulki typu T-shirt pasuje zarówno dla mężczyzn jak i kobiet\r\n    z grubego materiału, gramatura 190g\r\n    wykonana w 100% z bawełny single jersey, miękka w dotyku i przyjazna dla ciała również w upały\r\n    solidnie uszyta, z podwójnymi szwami na ramionach. Dekolt wykończony bawełnianym, wąskim ściągaczem. Taśma wzmacniająca na karku z tego samego materiału.\r\n    trwały nadruk, o wysokim nasyceniu kolorów, wykonany metodą DTG (druk bezpośredni)', '2023-01-07 17:54:40', '2023-01-08 22:51:58', NULL, '40.00', '0', 3000, 1, 17, '2cm poniżej rękawów', 'koszulka-M-BU-b-nie-pal-za-soba-mostow-XL.jpg'),
(20, 'Mostek prostowniczy FEND QL100A1600V', '    Wersja mostka: 1-fazowy\r\n    Prąd znamionowy: 100 A\r\n    Napięcie wsteczne: 1600 V\r\n    Wyprowadzenia: na konektory', '2023-01-07 17:55:33', '2023-01-08 22:51:49', NULL, '79.90', '0', 49, 1, 11, '    Długość: 98 mm\r\n    Szerokość: 60 mm\r\n    Wysokość: 28 mm (nie licząc wyprowadzeń)\r\n    Masa: 235 g', '2x-mostek-prostowniczy-100A-1600V-z-radiatorem.jpg'),
(21, 'Obraz obrazy na ścianę do salonu sypialni most', 'Obraz obrazy na ścianę do salonu sypialni most', '2023-01-07 17:56:36', '2023-01-08 22:51:41', '2023-07-20 17:56:36', '125.00', '0', 80, 1, 13, 'Wysokość produktu 60 cm\r\nSzerokość produktu 120 cm', 'Screenshot 2023-01-07 at 17-57-44 Obraz obrazy na ścianę do salonu sypialni most.png'),
(22, 'Ukraina 2022 Most Krymski', 'Ukraina parka 2 znaczki', '2023-01-07 17:58:57', '2023-01-08 22:51:32', NULL, '19.00', '0', 1, 1, 27, '1x2\"', '57fd36184466b697ab3d51308e47.jpg'),
(23, 'MOST NA OGRÓD MOSTEK OGRODOWY Z DREWNA KŁADKA', 'Mostek to doskonała ozdoba każdego ogrodu. Wykonany z prawdziwego drewna sosnowego. Drewno zostało zaimpregnowane przez co jest znacznie bardziej odporne na warunki atmosferyczne. Może służyć nie tylko jako mostek na oczkiem wodnym ale również jako wspaniała ozdoba.\r\n\r\nW skład przesyłki wchodzi:\r\n\r\n    Mostek ogrodowy do samodzielnego prostego montażu\r\n', '2023-01-07 18:00:13', '2023-01-09 12:11:45', '2023-01-15 05:05:05', '519.00', '23', 35, 1, 40, '    Wymiary całkowite: 150 x 67 x 55 cm (długość x szerokość x wysokość)\r\n    Waga bez opakowania: ~ 15 kg\r\n    Naturalne lite drewno (sosna) - impregnowane\r\n    Kolor: brązowy\r\n    Nośność: 150 kg', 'MOST-NA-OGROD-MOSTEK-OGRODOWY-Z-DREWNA-KLADKA.jpg'),
(27, 'TEST', 'opis', '2023-01-09 11:35:15', '2023-01-09 14:34:16', '2024-01-01 00:00:00', '10.00', '23', 5, 0, 1, 'gabaryty', NULL),
(29, 'Sydney Harbour Bridge', 'Sydney Harbour Bridge, most w Sydney nad zatoką Port Jackson. Ukończony w 1932 most ma 1149 m długości, a jego najwyższy punkt znajduje się 134 metry nad poziomem zatoki.', '2023-01-09 11:39:00', '2023-01-09 11:41:51', NULL, '450000.00', '0', 1, 1, 9, '1149x134 m', '1920px-Sydney_Harbour_Bridge_from_Circular_Quay.jpg');

-- --------------------------------------------------------

--
-- Struktura widoku `category_list_parents_named`
--
DROP TABLE IF EXISTS `category_list_parents_named`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `category_list_parents_named`  AS SELECT `category_list2`.`id` AS `id`, `category_list2`.`parent_id` AS `parent_id`, `category_list2`.`category_name` AS `category_name`, (select `category_list`.`category_name` from `category_list` where `category_list`.`id` = `category_list2`.`parent_id` limit 1) AS `parent_category_name` FROM `category_list` AS `category_list2` LIMIT 0, 500500  ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT dla tabeli `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `category_list`
--
ALTER TABLE `category_list`
  ADD CONSTRAINT `category_list_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category_list` (`id`);

--
-- Ograniczenia dla tabeli `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `product_list_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category_list` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
