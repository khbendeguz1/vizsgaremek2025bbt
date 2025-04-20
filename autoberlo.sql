-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: mysql.omega:3306
-- Létrehozás ideje: 2025. Ápr 20. 19:55
-- Kiszolgáló verziója: 5.7.42-log
-- PHP verzió: 7.2.34-54+0~20250311.107+debian12~1.gbpd6988c

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `autoberlo`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `berlesek`
--

CREATE TABLE `berlesek` (
  `id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `ugyfel_nev` varchar(255) DEFAULT NULL,
  `berles_kezdete` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `berles_vege` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `berlesek`
--

INSERT INTO `berlesek` (`id`, `auto_id`, `ugyfel_nev`, `berles_kezdete`, `berles_vege`) VALUES
(82, 1, 'Teszt Elek1', '2025-05-01 00:00:00', '2025-05-05'),
(83, 1, 'Teszt Elek1', '2025-05-01 00:00:00', '2025-05-05'),
(84, 1, 'Teszt Elek1', '2025-05-01 00:00:00', '2025-05-05');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `marka` varchar(255) NOT NULL,
  `tipus` text NOT NULL,
  `leiras` text NOT NULL,
  `kep` varchar(255) NOT NULL,
  `kategoria` int(11) NOT NULL,
  `berelve` tinyint(1) NOT NULL,
  `ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `cars`
--

INSERT INTO `cars` (`id`, `marka`, `tipus`, `leiras`, `kep`, `kategoria`, `berelve`, `ar`) VALUES
(1, 'BMW', 'E46 3 Series', 'Sportos és megbízható.', 'https://bringatrailer.com/wp-content/uploads/2021/01/1610963066c14862cBMW-E46-3Series-For-Sale-Results-Value-Guide-Bring-a-Trailer.jpg', 1, 1, 12700),
(4, 'Honda', 'Civic 2005', 'Megbízható és alacsony fogyasztás.', 'https://bringatrailer.com/wp-content/uploads/2020/01/2002_honda_civic_1580855780b34c9898IMG_5370.jpg?fit=940%2C627', 1, 0, 8000),
(5, 'Toyota', 'Yaris 2008', 'Kis méret, nagy hatékonyság.', 'https://images.caradisiac.com/images/4/1/1/5/4115/S1-La-Toyota-Yaris-elue-voiture-verte-2008-par-l-ETA-2914.jpg', 1, 0, 10900),
(6, 'Ford', 'Fiesta 2009', 'Kompakt és energiatakarékos.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQs7r04Yn2_5s1Vjie2Y-cIFQbpvWIADow8NA&s', 1, 0, 5000),
(7, 'Nissan', 'Micra 2007', 'Kis városi autó.', 'https://carsguide-res.cloudinary.com/image/upload/c_fit,h_841,w_1490,f_auto,t_cg_base/v1/editorial/Nissan-Micra-2007.jpg', 1, 0, 6500),
(8, 'Mazda', '6 2005', 'Stílusos és kényelmes.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f113/mazda-6-i-hatchback-typ-gg-gy-gg1-facelift-2005.jpg', 1, 0, 4900),
(9, 'Volkswagen', 'Passat B6', 'Nagy autó, kényelmes utazás.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f92/volkswagen-passat-variant-b6.jpg', 1, 0, 12000),
(10, 'Peugeot', '308 2008', 'Kiváló minőség és gazdaságos.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im01807-1-peugeot-308.jpg', 1, 0, 6500),
(11, 'Volkswagen', 'Golf 7', 'Praktikus és gazdaságos.', 'https://upload.wikimedia.org/wikipedia/commons/5/59/2013_Volkswagen_Golf_SE_BlueMotion_Technology_1.4_Front.jpg', 2, 0, 6000),
(12, 'Ford', 'Focus MK3', 'Jó fogyasztás és modern dizájn.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f47/ford-focus-iii-hatchback.jpg', 2, 1, 4500),
(13, 'Toyota', 'Corolla 2015', 'Megbízható és alacsony fenntartási költség.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkMnROObRnPvw3Q4Him8bo_dX3QovQngLAGw&s', 2, 0, 5500),
(14, 'Nissan', 'Qashqai 2017', 'Crossover a családoknak.', 'https://i.gaw.to/vehicles/photos/08/34/083479_2017_nissan_Qashqai.jpg?640x400\'', 2, 0, 6000),
(15, 'Mazda', 'CX-5 2018', 'Kiváló vezetési élmény.', 'https://i.gaw.to/content/photos/31/59/315914_2018_Mazda_CX-5.jpg', 2, 0, 6500),
(16, 'BMW', 'F30 3 Series', 'Sportos és dinamikus.', 'https://cdn.bmwblog.com/wp-content/uploads/2017/04/BMW-3-Series-Seadan-F30-LCI-5431_24-750x500.jpg', 2, 0, 14000),
(17, 'Audi', 'A3 8V', 'Stílusos és gazdaságos.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f129/audi-a3-8v.jpg', 2, 0, 14000),
(18, 'Mercedes', 'A-Class 2014', 'Fiatalos és technológiai csúcs.', 'https://upload.wikimedia.org/wikipedia/commons/f/ff/Mercedes-Benz_A_180_Urban_%28W_176%29_%E2%80%93_Frontansicht%2C_30._November_2014%2C_Ratingen.jpg', 2, 0, 12935),
(20, 'Skoda', 'Octavia 2016', 'Kiváló ár-érték arány.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im02863-1-skoda-octavia.jpg', 2, 0, 13000),
(21, 'Tesla', 'Model 3', 'Elektromos autó prémium technológiával.', 'https://www.shop4tesla.com/cdn/shop/articles/tesla-model-3-uber-230000-km-und-tausende-euro-gespart-956682.jpg?v=1728598029', 3, 1, 15000),
(22, 'BMW', 'G20 3 Series', 'Modern és dinamikus szedán.', 'https://images.pistonheads.com/nimg/45693/a10.jpg', 3, 1, 16500),
(23, 'Mercedes', 'W223 S-Class', 'A luxus csúcsa.', 'https://en.mercedesassistance.com/wp-content/uploads/2024/08/image-30.png', 3, 1, 17500),
(24, 'Hyundai', 'Ioniq 5', 'Innovatív elektromos autó.', 'https://upload.wikimedia.org/wikipedia/commons/8/85/Hyundai_Ioniq_5_AWD_Techniq-Paket_%E2%80%93_f_31122024.jpg', 3, 0, 22000),
(25, 'Ford', 'Mustang Mach-E', 'Elektromos SUV legendás névvel.', 'https://d2v1gjawtegg5z.cloudfront.net/posts/preview_images/000/015/446/original/2024_Ford_Mustang_Mach-E_Bronze_02.jpeg?1724260399', 3, 0, 21800),
(26, 'Audi', 'Q4 e-tron', 'Elektromos crossover.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im06285-1-audi-q4-etron-sportback.jpg', 3, 0, 22900),
(27, 'Volkswagen', 'ID.4', 'Elektrikusan hajtott SUV.', 'https://kep.cdn.index.hu/1/0/3464/34649/346496/34649641_2652549_3aae361350ee79c14126a8fc198ddfaa_wm.jpg', 3, 0, 18800),
(28, 'BMW', 'i4', 'Elektrikus prémium szedán.', 'https://ev-database.org/img/auto/BMW_i4_2024/BMW_i4_2024-01.jpg', 3, 1, 16700),
(29, 'Mercedes', 'EQC 400', 'Elektromos luxus SUV.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Mercedes-Benz_EQC_400_4MATIC_AMG_Line_%28N_293%29_%E2%80%93_f_02042021.jpg/2560px-Mercedes-Benz_EQC_400_4MATIC_AMG_Line_%28N_293%29_%E2%80%93_f_02042021.jpg', 3, 0, 35000),
(30, 'Tesla', 'Model Y', 'Tágas és praktikus elektromos SUV.', 'https://www.topgear.com/sites/default/files/2022/03/TopGear%20-%20Tesla%20Model%20Y%20-%20003.jpg', 3, 0, 17600),
(31, 'BMW', 'M3 E46', 'Sportos és erőteljes.', 'https://www.modelcar.com/modelcar/Ottomobile-BMW-M3-E46-Phoenix-Yellow-G025-front.jpg', 1, 0, 16500),
(32, 'Audi', 'A3 8P', 'Stílusos és kompakt.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im01921-1-audi-a3.jpg', 1, 0, 15400),
(33, 'Mercedes', 'C-Class W204', 'Elegáns és kifinomult.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f76/mercedes-benz-c-class-w204.jpg', 1, 0, 12800),
(34, 'Honda', 'Accord 2007', 'Megbízható és tágas.', 'https://media.ed.edmunds-media.com/honda/accord/2007/oem/2007_honda_accord_sedan_ex-l-v-6_fq_oem_2_1600.jpg', 1, 1, 5500),
(35, 'Toyota', 'Avensis 2007', 'Kényelmes és jól felszerelt.', 'https://i.ytimg.com/vi/lvwbuYqgEEs/maxresdefault.jpg', 1, 0, 7000),
(36, 'Ford', 'Mondeo 2008', 'Tágas és családbarát.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im01765-1-ford-mondeo.jpg', 1, 0, 7300),
(37, 'Mazda', '3 2009', 'Sportos és fiatalos.', 'https://d1gymyavdvyjgt.cloudfront.net/drive/images/made/drive/images/remote/https_d2yv47kjv2gmpz.cloudfront.net/filestore/0/4/1/2_2e5f8261979c166/5cb4653217d39363cf4495514a063e86/2140_62fbe548aa6ceb6_794_529_70.jpg', 1, 0, 5000),
(38, 'Nissan', 'Almera 2005', 'Kedvező ár-érték arány.', 'https://upload.wikimedia.org/wikipedia/commons/c/c0/Nissan_almera_n16_jaslo.JPG', 1, 0, 4800),
(39, 'Peugeot', '407 2006', 'Elegáns és tágas.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f49/peugeot-407-sw.jpg', 1, 1, 5100),
(40, 'Citroen', 'C4 2007', 'Kényelmes és praktikus.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f36/citroen-c4-i-picasso-phase-i-2007.jpg', 1, 0, 6500),
(41, 'Opel', 'Astra J', 'Jó minőség és gazdaságosság.', 'https://kocsi-media.hu/1247/opel-astra-j-1-4-sport-973710_444993_2xl.jpg', 2, 0, 5600),
(42, 'Renault', 'Megane 2012', 'Modern dizájn, gazdaságos.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f89/renault-megane-iii-phase-ii-2012.jpg', 2, 0, 8000),
(43, 'Peugeot', '2008 2015', 'Komfort és megbízhatóság.', 'https://d1gymyavdvyjgt.cloudfront.net/drive/images/made/drive/images/remote/https_d2yv47kjv2gmpz.cloudfront.net/filestore/1/8/1/2_e2b155f29cbc16f/ef20f35024fe51c0c1672b69545928c5/2181_5cca4ebae93c2c9_794_529_70.jpg', 2, 0, 8500),
(44, 'Mazda', 'CX-3 2016', 'Kiváló vezetési élmény és stílusos.', 'https://tesztelok.hu/wp-content/uploads/cx32.jpg', 2, 0, 10000),
(45, 'Honda', 'CR-V 2016', 'Tágas és kényelmes crossover.', 'https://i.pcmag.com/imagery/reviews/06CTOlym5JPco9CcAsbKQYN-4..v1569479118.jpg', 2, 0, 9500),
(46, 'Hyundai', 'Tucson 2017', 'A legjobb családi autó.', 'https://hips.hearstapps.com/hmg-prod/amv-prod-cad-assets/wp-content/uploads/2016/11/2017-Hyundai-Tucson-Night-Edition-104.jpg', 2, 0, 11000),
(47, 'Kia', 'Sportage 2018', 'Sportos crossover.', 'https://kocsi-media.hu/107/kia-sportage-1-6-gdi-silver-218146_453311_1xl.jpg', 2, 0, 13000),
(48, 'Subaru', 'Forester 2018', 'Alkalmas minden terepre.', 'https://gofatherhood.com/wp-content/uploads/2017/10/2018-subaru-forester-4.jpg', 2, 0, 14600),
(49, 'Toyota', 'RAV4 2019', 'Kiváló minőség és megbízhatóság.', 'https://toyotahering.hu/wp-content/uploads/2019/01/large_Toyota_RAV4_27.jpg', 2, 0, 16000),
(50, 'BMW', 'X5 2019', 'Luxus SUV erős motorral.', 'https://www.iihs.org/cdn-cgi/image/width=636/api/ratings/model-year-images/2879/', 2, 0, 22000),
(51, 'Tesla', 'Cybertruck', 'A jövő pickupja.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im05977-1-tesla-cybertruck.jpg', 3, 0, 75000),
(52, 'Rivian', 'R1T', 'Elektromos pickup innovatív technológiával.', 'https://hips.hearstapps.com/hmg-prod/images/2025-rivian-r1t-104-665f78ba4b647.jpg?crop=1.00xw:0.844xh;0,0.156xh&resize=2048:*', 3, 0, 48000),
(53, 'Lucid', 'Air', 'Luxus elektromos szedán.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/26/2022_Lucid_Air_Grand_Touring_in_Zenith_Red%2C_front_left.jpg/800px-2022_Lucid_Air_Grand_Touring_in_Zenith_Red%2C_front_left.jpg', 3, 0, 45000),
(54, 'Ford', 'F-150 Lightning', 'Elektromos amerikai pickup.', 'https://media.ed.edmunds-media.com/ford/f-150-lightning/2024/oem/2024_ford_f-150-lightning_crew-cab-pickup_flash_fq_oem_1_1600.jpg', 3, 0, 40000),
(55, 'Volkswagen', 'ID. Buzz', 'Elektromos minibusz retró dizájnnal.', 'https://www.kbb.com/wp-content/uploads/2023/06/2025-vw-id-buzz-exterior-front-blue.jpg?w=918', 3, 0, 35000),
(56, 'Audi', 'e-tron GT', 'Elektrikus sportkocsi.', 'https://e-cars.hu/wp-content/uploads/2018/11/audi-e-tron-GT1.jpg', 3, 1, 55000),
(57, 'BMW', 'iX3', 'Elektromos SUV a BMW-től.', 'https://upload.wikimedia.org/wikipedia/commons/7/75/BMW_iX3_G08_FL_IMG_6225.jpg', 3, 0, 24000),
(58, 'Porsche', 'Taycan', 'Sportos elektromos autó.', 'https://di-uploads-pod15.dealerinspire.com/bluegrassmotorsport/uploads/2024/02/Taycan-Turbo.jpg', 3, 0, 60000),
(59, 'Mercedes', 'EQS', 'Elektromos luxus szedán.', 'https://cdn.motor1.com/images/mgl/1m4XW/s3/2022-mercedes-benz-eqs-450-exterior-front-quarter.jpg', 3, 0, 56000),
(60, 'Volvo', 'XC40 Recharge', 'Elektromos SUV a családoknak.', 'https://www.greencarguide.co.uk/wp-content/uploads/2021/04/Volvo-XC40-Recharge-Twin-006-low-res.jpeg', 3, 0, 42000),
(61, 'BMW', 'M5 F90', 'Prémium sportautó.', 'https://i.auto-bild.de/ir_img/1/3/2/8/0/0/7/BMW-M5-F90-2017-Test-Infos-und-Bilder-1200x800-078a9f1eb8cb5d91.jpg', 2, 0, 34000),
(62, 'Audi', 'RS7', 'Erőteljes sportos autó.', 'https://cf-cdn-v6-api.audi.at/files/d84892316f1aac3c6726113af1789cebeaca858d/5c8718f3-c070-4068-98b1-e95c13b089c1/rs720224375-l', 2, 0, 59000),
(63, 'Mercedes', 'E-Class W213', 'Kifinomult szedán.', 'https://assets.autobuzz.my/wp-content/uploads/2016/01/23142934/2016-Mercedes-Benz-E-Class-W213-9.jpg', 2, 0, 43000),
(64, 'Honda', 'Jazz 2020', 'Praktikus és tágas kisautó.', 'https://alapjarat.hu/sites/default/files/styles/article_cover_image_mobile/public/honda_jazz_alapjarat_sb-21.jpg?itok=lfW60y_t', 2, 0, 35000),
(65, 'Toyota', 'Yaris Cross', 'Kis SUV nagy hatékonysággal.', 'https://www.automotor.hu/wp-content/uploads/2022/04/yariscross1.jpg', 2, 0, 27000),
(66, 'Ford', 'Puma 2020', 'Kompakt SUV crossover.', 'https://upload.wikimedia.org/wikipedia/commons/0/02/2020_Ford_Puma_ST-Line_X_EcoBoost_Hybrid_1.0_Front.jpg', 2, 0, 25000),
(67, 'Mazda', 'MX-5 Miata', 'Sportos kabrió.', 'https://www.usnews.com/object/image/00000192-f84f-d6b4-aff3-fd7fbd0e0001/25-mazda-miata-ext1.jpg?update-time=1730742994781&size=responsive640', 2, 0, 20000),
(68, 'Peugeot', '508 2021', 'Elegáns és dinamikus szedán.', 'https://i.bstr.es/highmotor/2020/09/peugeot-508-pse-seguimiento-oficial-delantero-1220x808.jpg', 2, 0, 33000),
(69, 'Citroen', 'C3 Aircross', 'Tágas és stílusos crossover.', 'https://vezess2.p3k.hu/app/uploads/2024/04/citroen-c3-aircross-2024-2.jpg', 2, 0, 25000),
(70, 'Nissan', 'Leaf 2022', 'Kiváló elektromos autó.', 'https://e-cars.hu/wp-content/uploads/2022/02/2022-nissan-leaf-euro-spec1.jpg', 3, 0, 22000),
(71, 'BMW', 'Z4', 'Sportos roadster.', 'https://vezess2.p3k.hu/app/uploads/2022/10/bmw-z4-m40i-8.jpg', 2, 0, 18500),
(72, 'Mazda', 'RX-8', 'Legendás sportautó.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im00890-1-mazda-rx8.jpg', 2, 0, 19000),
(73, 'Peugeot', '308 GTi', 'Sportos kompakt.', 'https://media.autoexpress.co.uk/image/private/s--X-WVjvBW--/f_auto,t_content-image-full-desktop@1/v1562241180/autoexpress/1/67/renault-20150603_085630-big_0_0_0_0_0.jpg', 2, 0, 29000),
(74, 'Opel', 'Insignia 2017', 'Modern és elegáns szedán.', 'https://estaticos-cdn.prensaiberica.es/clip/877433d3-7d9f-4f91-9379-56dd3b8c53d9_alta-libre-aspect-ratio_default_0.jpg', 2, 0, 19800),
(75, 'Skoda', 'Fabia 2019', 'Praktikus kisautó.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im05576-1-skoda-fabia.jpg', 2, 0, 20000),
(76, 'Kia', 'Ceed', 'Kiváló minőség és megbízhatóság.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im05554-1-kia-ceed.jpg', 2, 0, 26000),
(77, 'Toyota', 'Hilux 2020', 'Kiváló terepjáró pickup.', 'https://carsguide-res.cloudinary.com/image/upload/f_auto,fl_lossy,q_auto,t_default/v1/editorial/review/hero_image/toyota-hilux-sr5-my20-red-tw-1001x565-(1).jpg', 2, 0, 25000),
(78, 'Renault', 'Clio 2020', 'Fiatalos és stílusos városi autó.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im05755-1-renault-clio-v.jpg', 2, 0, 22000),
(79, 'Ford', 'Ranger 2021', 'Erős és praktikus pickup.', 'https://www.motortrend.com/uploads/2021/12/2022-Ford-Ranger-Tremor-37.jpg?w=768&width=768&q=75&format=webp', 3, 0, 29000),
(80, 'Volvo', 'XC90', 'Tágas és biztonságos családi SUV.', 'https://hips.hearstapps.com/hmg-prod/images/2025-volvo-xc90-125-6740db2f61c75.jpg?crop=0.720xw:0.609xh;0.280xw,0.372xh&resize=2048:*', 2, 0, 28000),
(81, 'BMW', 'X6', 'Luxus SUV sportos megjelenéssel.', 'https://cdn.motor1.com/images/mgl/pOAWo/s3/2020-bmw-x6.jpg', 2, 0, 32000),
(82, 'Audi', 'Q5', 'Elegáns és tágas crossover.', 'https://cdn.motor1.com/images/mgl/43GX1/s3/2021-audi-q5.jpg', 2, 0, 37000),
(83, 'Mercedes', 'GLC', 'Luxus crossover.', 'https://egyszermarlattamautot.hu/wp-content/uploads/2023/09/Az-uj-Mercedes-AMG-GLC-Coupe_LEAD-1.jpg', 2, 0, 41000),
(84, 'Honda', 'Pilot', 'Tágas családi SUV.', 'https://hips.hearstapps.com/hmg-prod/images/2025-honda-pilot-black-edition-01-65e1e8b47b986.jpg?crop=0.587xw:0.587xh;0.231xw,0.262xh&resize=2048:*', 2, 0, 32000),
(85, 'Nissan', 'Murano', 'Prémium crossover.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f125/nissan-murano-i-z50.jpg', 2, 0, 29500),
(86, 'Toyota', 'Sequoia', 'Nagy méretű és erős SUV.', 'https://vehicle-images.dealerinspire.com/bf18-110007925/7SVAAABA6SX058563/c3b44fa6d0ddcb170c1e5b705526f3f8.jpg', 2, 0, 23000),
(87, 'Subaru', 'Outback', 'Terepjáró és családi autó kombinációja.', 'https://i.gaw.to/vehicles/photos/40/39/403990-2025-subaru-outback.jpg', 2, 0, 26000),
(88, 'Mazda', 'CX-9', 'Tágas és erős SUV.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f34/mazda-cx-9-ii.jpg', 2, 0, 28500),
(89, 'Chevrolet', 'Traverse', 'Nagy méretű családi SUV.', 'https://i.gaw.to/content/photos/61/75/617517-chevrolet-traverse-2024.jpeg', 2, 0, 33000),
(90, 'GMC', 'Yukon', 'Erős és tágas prémium SUV.', 'https://cdn.motor1.com/images/mgl/G6BKE/s3/2021-gmc-yukon-denali-front-quarter.jpg', 2, 0, 32500),
(91, 'BMW', '740e', 'Luxus plug-in hibrid szedán.', 'https://www.carpro.com/hubfs/car-review-blog/review_274910_1.jpg', 3, 1, 68000),
(92, 'Audi', 'Q7', 'Nagy prémium crossover.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Audi_Q7_%28Facelift%29_front_20110115.jpg/1200px-Audi_Q7_%28Facelift%29_front_20110115.jpg', 2, 1, 64000),
(93, 'Jaguar', 'F-Pace', 'Sportos luxus SUV.', 'https://cdn.motor1.com/images/mgl/NR8nM/s1/2021-jaguar-f-pace.jpg', 2, 0, 60400),
(94, 'Land Rover', 'Range Rover Sport', 'Luxus és terepjáró képesség.', 'https://cdn.motor1.com/images/mgl/2NNLxK/s1/range-rover-sport-2022.jpg', 2, 0, 61000),
(95, 'Mitsubishi', 'Outlander PHEV', 'Hibrid terepjáró.', 'https://autopult.hu/galeria/1612teszt/mphev/mitsubishi_outlander_phev_2016_11_medium.JPG', 2, 0, 45000),
(96, 'BMW', 'X1', 'Kompakt luxus crossover.', 'https://images.clickdealer.co.uk/vehicles/6083/6083257/large1/143855757.jpg', 2, 0, 48500),
(97, 'Toyota', 'Land Cruiser 70', 'Robusztus terepjáró.', 'https://upload.wikimedia.org/wikipedia/commons/e/ec/Toyota_Land_Cruiser_70_003_%28cropped%29.JPG', 2, 0, 57000),
(98, 'Kia', 'Seltos', 'Praktikus és stílusos crossover.', 'https://imgcdn.oto.com/large/gallery/exterior/20/2972/kia-seltos-front-angle-low-view-718961.jpg', 2, 0, 52000),
(99, 'Hyundai', 'Santa Fe', 'Tágas és családbarát SUV.', 'https://upload.wikimedia.org/wikipedia/commons/e/e6/2024_Hyundai_Santa_Fe_Luxury_AWD_in_Hampton_Grey%2C_front_left%2C_2024-06-30.jpg', 2, 0, 54000),
(100, 'Mazda', 'CX-30', 'Stílusos crossover.', 'https://vezess2.p3k.hu/app/uploads/2024/04/mazda-cx-30-nagisa-teszt-2024-04.jpg', 2, 0, 50000),
(101, 'SangYong', 'SangYong', 'SUV, nagy, kényelmes, gyors.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/20090606Actyon.jpg/960px-20090606Actyon.jpg', 3, 0, 25000),
(102, 'Toyota', 'Corolla', 'Kiváló állapotú, gazdaságos autó.', 'https://schillerrent.hu/wp-content/uploads/2021/11/cc_2023TOC330004_01_1280_1F7.jpg', 2, 0, 6500),
(103, 'Ford', 'Focus', 'Friss műszaki vizsga, kényelmes autó.', 'https://kep.cdn.index.hu/1/0/6091/60914/609141/60914117_4505253_0367485243c98c1c5e77d918851fe62d_wm.jpg', 2, 0, 6000),
(104, 'Honda', 'Civic', 'Sportos megjelenés, megbízható motor.', 'https://www.motorhang.hu/static/medias/17128/1200x1200/A-valasz-Honda-Civic-eHEV-Advance_6f1e5411e95ae79330f1e2dd06e2c5cb.jpg', 2, 0, 7000),
(105, 'BMW', '320i', 'Luxus és teljesítmény a legjobban.', 'https://mbmrent.hu/storage/vehicle/main/bmw-320i--main-261.jpg', 3, 0, 12000),
(106, 'Volkswagen', 'Golf', 'Tágas belső tér, gazdaságos.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im06023-1-vw-golf-viii-gtd.jpg', 2, 0, 6500),
(107, 'Audi', 'A3', 'Sportos és elegáns.', 'https://speedzone.hu/wp-content/uploads/2024/03/a3fokep.jpg', 3, 1, 9000),
(108, 'Peugeot', '208', 'Kis városi autó, könnyű vezethetőség.', 'https://rstck-joautok-dev.s3.eu-central-003.backblazeb2.com/postings/images/09b8146d-d3e5-4c1a-99bf-7c57c41756b6_ORIGINAL.jpeg', 1, 0, 5000),
(109, 'Ford', 'Fiesta', 'Nagyon jó állapotú, ideális első autó.', 'https://upload.wikimedia.org/wikipedia/commons/a/a7/Ford_Fiesta_ST-Line_%28VII%2C_Facelift%29_–_f_30012023.jpg', 1, 0, 4500),
(110, 'Nissan', 'Micra', 'Kis méret, nagy teljesítmény.', 'https://vezess2.p3k.hu/app/uploads/2018/07/img_9380.jpg', 1, 0, 4000),
(111, 'Chevrolet', 'Aveo', 'Gazdaságos, alacsony fenntartás.', 'https://www.autonavigator.hu/wp-content/uploads/2011/01/48758_source.jpg\r\n', 1, 0, 4500),
(112, 'Opel', 'Astra', 'Meghosszabbított szervizidőszak.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im05843-1-opel-astra-k.jpg', 1, 0, 4700),
(113, 'Renault', 'Clio', 'Megbízható, könnyen parkolható.', 'https://cdn.motor1.com/images/mgl/2MMyp/s1/renault-clio-1.0.jpg', 1, 0, 4600),
(114, 'Mazda', '3', 'Sportos dizájn, alacsony fogyasztás.', 'https://mazda.schneiderautohaz.hu/wp-content/uploads/2023/07/Mazda-3-HB-G150-Homura-1024x476.png', 2, 0, 7000),
(115, 'Kia', 'Ceed', 'Nagy belső tér, kényelmes vezetés.', 'https://assets.adac.de/image/upload/v1/Autodatenbank/Fahrzeugbilder/im05554-1-kia-ceed.jpg', 2, 0, 6500),
(116, 'Citroën', 'C3', 'Kompakt városi autó.', 'https://autoarnyekolas.hu/wp-content/uploads/2023/04/citroen-c3-20106-autoarnyekolas-autoarnyekolo.jpg', 1, 0, 4800),
(117, 'Hyundai', 'i30', 'Modern dizájn, gazdaságos üzemeltetés.', 'https://rstck-joautok-dev.s3.eu-central-003.backblazeb2.com/postings/images/76c6cfea-e81e-459b-bbee-3a86c75f4d97_ORIGINAL.jpeg', 2, 0, 6700),
(118, 'Seat', 'Leon', 'Sportos megjelenés, dinamikus vezetés.', 'https://www.automoli.com/common/vehicles/_assets/img/gallery/f104/seat-leon-ii-1p.jpg', 2, 0, 6900),
(119, 'Fiat', 'Punto', 'Kis méret, nagy élmény.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Fiat_Punto_2012_5door_front.JPG/800px-Fiat_Punto_2012_5door_front.JPG', 1, 0, 4300),
(120, 'Suzuki', 'Swift', 'Könnyű vezethetőség, alacsony fogyasztás.', 'https://kep.index.hu/1/0/3014/30144/301447/30144769_d8dd328ab764d3b8330dba255503ef20_wm.jpg', 1, 0, 4600);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jogositvany_megszerzese` date NOT NULL,
  `jogositvany_szam` varchar(9) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `nev`, `username`, `password`, `email`, `jogositvany_megszerzese`, `jogositvany_szam`, `admin`) VALUES
(7, 'Armando', 'Armando', '$2y$10$unKMy2Sfi0v5EZolsiTTRucyCu8PetFSviWdNoINaRxTKuTR45SQW', '72458257331@szily.hu', '2022-11-16', '', 0),
(9, 'Fábián Zoltán', 'fzolee', '$2y$10$xUjIWHAjUL9w6He.Z7WLN.rJtdWxJWAB9F7/Z0Z7qwZN6tSsCQ.We', 'fzolee@fzolee.hu', '2019-02-05', '123456ne', 1),
(10, 'Vékony Márk', 'vmark', '$2y$10$8uiZf98lr4iFQZg9Y0MR5uEfqSWK6CM6Oezk7ZERC225NGi4Qa7Wu', 'vmak@vmrark.hu', '2024-08-03', '', 0),
(12, 'Varga Katalin', 'Wargakat', '$2y$10$T5BvFFKCnsQCZ8aR4/tJbeCYOVemQhjiCjkHe1XQV6kceAtTI20H6', 'wargakat@yahoo.fr', '1999-01-06', '1', 0),
(15, 'Boros Zoé', 'boroszoe', '$2y$10$c/zfphzxlIOone.IR6qg3ui4asIu6s0z0qVT.SaE275DfsG6MuyIm', 'zoe.flora.boros@icloud.com', '2024-03-03', '123456NE', 0),
(17, 'Lévai Ádám', 'RealDeep', '$2y$10$SptAzFxfkNRtw/LkeNV17uEBf1g340g6yvFpDJuSrxeiCDWIZf6Ry', 'Levaiadam1125@gmail.com', '2025-03-15', '123', 0),
(23, 'beleczki_bence', 'beleczki_bence', '$2y$10$JGE00I5DBIEA0gs0aaDnrey9JWZiYlz9RICeZQCNkJUhsEP.m4ku.', 'beleczki.bence@gmail.com', '2015-09-06', 'gh3434343', 1),
(25, 'Steyer Zalán', 'steyer', '$2y$10$0m7XjpeRrz5ey6AzEtgLnOx7xKpjDDK7BDdqoXU1fcpdpTu16NZjm', 'steyer@zalan.hu', '1994-07-21', '12344567a', 0),
(26, 'Kiss-Horváth Bendegúz', 'khbendeguz1', '$2y$10$GCL3CFtQ3o2LdHA56NaBXOT2Cf2Zhr6ROMaPIaGePd.pQpvr0zpzW', 'khbendi@gmail.com', '2024-08-06', 'CZ842678', 0),
(27, 'Kovácsné Horváth Csilla', 'horvathcsilla', '$2y$10$y5WyIkwsuIEdl1hZNKf6Le.ugjLyjvBbcp1HIs15GLx4ior.pAmYu', 'horvathcsilla44@gmail.com', '2016-11-30', '123456ab', 0),
(28, 'Kis istván', 'Isti', '$2y$10$ztj0132Xv5edILr9H255seXZ4uyjuOqwrI5vOsqJewOtGz2w.g4b2', 'isti@gmail.com', '2005-05-24', '21254845', 0),
(30, 'brezy', 'brezy', '$2y$10$sCmjKj8oogNsKkj4PcNA..4VR.FeYnqI9choksv7izFR9OuhNsrxK', 'david@brezy.eu', '2019-09-05', 'buzibeni', 0),
(31, 'Tóth Júlia', 'tothjulia', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'tothjulia@example.com', '2018-06-15', 'ABC12345', 0),
(32, 'Kiss Milán', 'kissmilan99', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'kissmilan99@example.com', '2017-09-03', 'KM998877', 0),
(33, 'Zsombor Bike', 'zsomborbike', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'zsomborbike@example.com', '2020-01-20', 'ZB202020', 0),
(34, 'Nagy Anita', 'nagyanita', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'nagyanita@example.com', '2019-12-01', 'NA123456', 0),
(35, 'Ferencz Ádám', 'ferenczadam', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'ferenczadam@example.com', '2021-04-18', 'FA141414', 0),
(36, 'Lukács Bea', 'lukacsbea', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'lukacsbea@example.com', '2022-07-10', 'LB707070', 0),
(37, 'Péter Bence', 'peterbence', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'peterbence@example.com', '2016-11-22', 'PB333333', 0),
(38, 'Szekeres Róbert', 'szekeresrobi', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'szekeresrobi@example.com', '2015-03-29', 'SR888888', 0),
(39, 'Kovács Zsófi', 'kovacszsofi', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'kovacszsofi@example.com', '2020-08-13', 'KZ999999', 0),
(40, 'Varga Marcell', 'vargamarci', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'vargamarci@example.com', '2021-02-14', 'VM666666', 0),
(41, 'Szabó János', 'szabojani', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'szabojani@example.com', '2018-10-05', 'SJ555555', 0),
(42, 'Kerekes Dóra', 'kerekesdora', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'kerekesdora@example.com', '2017-05-06', 'KD112233', 0),
(43, 'Nagy Bálint', 'nagybalu', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'nagybalu@example.com', '2020-06-08', 'NB332211', 0),
(44, 'Szilágyi Imre', 'szilagyiimre', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'szilagyiimre@example.com', '2019-01-30', 'SI101010', 0),
(45, 'Tóth Mariann', 'mariann90', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'mariann90@example.com', '2016-12-22', 'TM202020', 0),
(46, 'Kiss Fanni', 'kissfanni', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'kissfanni@example.com', '2021-01-19', 'KF141516', 0),
(47, 'Barna István', 'barnaistvan', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'barnaistvan@example.com', '2018-08-09', 'BI774455', 0),
(48, 'Kovács Dániel', 'kovacsdani', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'kovacsdani@example.com', '2023-04-12', 'KD343434', 0),
(49, 'Csordás Vivien', 'csordasvivi', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'csordasvivi@example.com', '2022-03-03', 'CV787878', 0),
(50, 'Szabó Áron', 'szaboaron', '$2y$10$K3jJj8N1eRz.uOwEzL6v2OoS8gM1NkU3Z9ZoUPPe7xIX3/3K0vzK2', 'szaboaron@example.com', '2019-09-09', 'SA909090', 0),
(51, 'asd', 'asdasdasdasdasdasd', '$2y$10$RwH5evBOlBUbp/cf8vTWM.2i9Yq6kNisWDeRAa5FqpoKPsK1IYGMC', 'asdasd@asdasd.asdasd', '2025-04-09', 'asd', 0),
(52, 'Teszt Elek', 'tesztelek', '$2y$10$C9RoMu1Thk.mmbxBLtIQke3wAs9BXd0WOy41rCkZ9rMnIma58Re/.', 'teszt@elek.hu', '2021-02-20', 'NE123456', 0),
(53, 'testuser\', \'password\'); DROP TABLE users; --', 'testuser\', \'password\'); DROP TABLE users; --', '$2y$10$1mbCSGVPrzmo8McH/TOgA.S90Jsj0jksUpG5hWFmpJrq5qw5M3daW', 'asd@asd.asd', '1111-11-11', 'AB2312312', 0),
(67, 'Teszt Elek1', 'tesztfelhasznalo', '$2y$10$9Q/qFsdloBC1zzmtWASrL.P1gBCsVcc.DmNBfj4QPs8g0Wd3NP3LG', 'asdasd@asdasd.asdasdasd', '2017-02-02', 'NE1234568', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `velemenyek`
--

CREATE TABLE `velemenyek` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `velemeny` mediumtext NOT NULL,
  `pro` mediumtext NOT NULL,
  `contra` mediumtext NOT NULL,
  `ertekeles` tinyint(4) NOT NULL,
  `datum` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `velemenyek`
--

INSERT INTO `velemenyek` (`id`, `username`, `velemeny`, `pro`, `contra`, `ertekeles`, `datum`) VALUES
(23, 'khbendeguz1', 'Nagyon felhasználóbarát rendszer.', 'Gyors bérlési folyamat.', 'Kicsit drága autók', 4, '2025-03-30 18:14:35'),
(24, 'horvathcsilla', 'Jó kis cég, megbízhatóak.', 'Nagy autók elérhetőek', 'Nincs', 5, '2025-03-30 18:24:44'),
(29, 'beleczki_bence', 'Nagyon jó volt az autó', 'Tiszta, gyors', 'Drága', 4, '2025-04-07 14:25:48'),
(30, 'tothjulia', 'Nagyon meg voltunk elégedve!', 'Kedves ügyfélszolgálat', 'Kevés kisautó', 5, '2025-04-01 08:12:23'),
(31, 'kissmilan99', 'Korrekt árak, jó választék.', 'Gyors ügyintézés', 'Nem volt elérhető a kedvenc típus', 4, '2025-04-01 09:55:12'),
(32, 'zsomborbike', 'Sima bérlés, minden rendben ment.', 'Egyszerű rendszer', 'Kaució magas', 4, '2025-04-02 07:34:47'),
(33, 'nagyanita', 'Ajánlom mindenkinek!', 'Szép autók', 'Telefonos elérés nehéz', 5, '2025-04-02 13:22:39'),
(34, 'ferenczadam', 'Az autó tiszta volt, de kicsit zajos.', 'Gyors átvétel', 'Zajos motor', 3, '2025-04-02 16:45:11'),
(35, 'lukacsbea', 'Minden flottul ment.', 'Gyors ügyintézés', 'Nincs ilyen', 5, '2025-04-03 11:30:56'),
(36, 'peterbence', 'Elégedett vagyok, máskor is innen bérelek.', 'Nagy választék', 'Átadás picit csúszott', 4, '2025-04-03 15:18:04'),
(37, 'szekeresrobi', 'Szeretem ezt a céget, mindig segítőkészek.', 'Segítőkész csapat', 'Nincs nonstop nyitva', 5, '2025-04-04 06:50:09'),
(38, 'kovacszsofi', 'Az autó állapota kifogástalan volt.', 'Új járművek', 'Kaució magas', 5, '2025-04-04 10:34:26'),
(39, 'vargamarci', 'Gyors foglalás, megbízható cég.', 'Átlátható foglalás', 'Nincs személyes átvételi pont a közelben', 4, '2025-04-05 12:23:47'),
(40, 'szabojani', 'Rugalmasak voltak, ajánlom!', 'Rugalmas időpontok', 'Késői ügyfélszolgálat', 4, '2025-04-05 15:02:55'),
(41, 'kerekesdora', 'Jó tapasztalat, biztos visszatérek.', 'Tiszta autók', 'Magas biztosítási díj', 4, '2025-04-06 07:12:45'),
(42, 'nagybalu', 'Az appjuk is nagyon jól működik.', 'Modern rendszer', 'Időnként lassú', 4, '2025-04-06 10:30:17'),
(43, 'szilagyiimre', 'Gyors kiszállítás, kényelmes volt.', 'Kiszállítás elérhető', 'Kicsit drága', 5, '2025-04-06 13:49:33'),
(44, 'mariann90', 'Nem volt gond, de semmi extra.', 'Korrekt hozzáállás', 'Sima élmény', 3, '2025-04-07 07:00:00'),
(45, 'kissfanni', 'Imádtam a bérautót!', 'Új, kényelmes autók', 'Nincs automata váltós opció', 5, '2025-04-07 09:25:41'),
(46, 'barnaistvan', 'Jó ár-érték arány.', 'Olcsóbb, mint más cégek', 'Sok papírmunka', 4, '2025-04-08 06:12:11'),
(47, 'kovacsdani', 'Megbízható partner, korrekt feltételek.', 'Transzparens szerződés', 'Kaució sokáig van bent', 4, '2025-04-08 08:22:48'),
(48, 'csordasvivi', 'Kicsit késve kaptuk meg az autót.', 'Segítőkész ügyfélszolgálat', 'Késés az átvételnél', 3, '2025-04-09 11:17:36'),
(49, 'szaboaron', 'Tökéletes élmény!', 'Minden gördülékeny volt', 'Semmi', 5, '2025-04-09 14:55:27'),
(50, 'tesztelek', 'Gyors bérlési folyamat', 'Van', 'Nincs', 5, '2025-04-18 21:36:02');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `berlesek`
--
ALTER TABLE `berlesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berlesek_ibfk_1` (`auto_id`),
  ADD KEY `fk_berlesek_users` (`ugyfel_nev`);

--
-- A tábla indexei `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nev` (`nev`);

--
-- A tábla indexei `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_velemenyek_users` (`username`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `berlesek`
--
ALTER TABLE `berlesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT a táblához `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `berlesek`
--
ALTER TABLE `berlesek`
  ADD CONSTRAINT `berlesek_ibfk_1` FOREIGN KEY (`auto_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_berlesek_users` FOREIGN KEY (`ugyfel_nev`) REFERENCES `users` (`nev`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD CONSTRAINT `fk_velemenyek_users` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
