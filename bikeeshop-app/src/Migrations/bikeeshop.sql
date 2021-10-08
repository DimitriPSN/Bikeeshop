-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 1 mars 2019 à 10:35
-- Version du serveur :  5.7.24
-- Version de PHP :  7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bikeeshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `visual` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E6612469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `category_id`, `name`, `description`, `visual`, `price`, `stock`) VALUES
(1, 1, 'Orbea MX 27 ENT 50', 'Altera sententia est, quae definit amicitiam paribus officiis ac voluntatibus. Hoc quidem est nimis exigue et exiliter ad calculos vocare amicitiam, ut par sit ratio acceptorum et datorum. Divitior mihi et affluentior videtur esse vera amicitia nec observare restricte, ne plus reddat quam acceperit; neque enim verendum est, ne quid excidat, aut ne quid in terram defluat, aut ne plus aequo quid in amicitiam congeratur.', 'p1.jpg', '499.00', 2),
(2, 1, 'Scott Contessa 740', 'Quam ob rem vita quidem talis fuit vel fortuna vel gloria, ut nihil posset accedere, moriendi autem sensum celeritas abstulit; quo de genere mortis difficile dictu est; quid homines suspicentur, videtis; hoc vere tamen licet dicere, P. Scipioni ex multis diebus, quos in vita celeberrimos laetissimosque viderit, illum diem clarissimum fuisse, cum senatu dimisso domum reductus ad vesperum est a patribus conscriptis, populo Romano, sociis et Latinis, pridie quam excessit e vita, ut ex tam alto dignitatis gradu ad superos videatur deos potius quam ad inferos pervenisse.', 'p2.jpg', '449.00', 16),
(3, 1, 'Scott Aspect 770 co', 'Principium autem unde latius se funditabat, emersit ex negotio tali. Chilo ex vicario et coniux eius Maxima nomine, questi apud Olybrium ea tempestate urbi praefectum, vitamque suam venenis petitam adseverantes inpetrarunt ut hi, quos suspectati sunt, ilico rapti conpingerentur in vincula, organarius Sericus et Asbolius palaestrita et aruspex Campensis.', 'p3.jpg', '449.00', 10),
(4, 1, 'Scott Aspect 960', 'Nec minus feminae quoque calamitatum participes fuere similium. nam ex hoc quoque sexu peremptae sunt originis altae conplures, adulteriorum flagitiis obnoxiae vel stuprorum. inter quas notiores fuere Claritas et Flaviana, quarum altera cum duceretur ad mortem, indumento, quo vestita erat, abrepto, ne velemen quidem secreto membrorum sufficiens retinere permissa est. ideoque carnifex nefas admisisse convictus inmane, vivus exustus est.', 'p4.jpg', '499.00', 10),
(5, 2, 'Scott Speedster 50', 'Atque, ut Tullius ait, ut etiam ferae fame monitae plerumque ad eum locum ubi aliquando pastae sunt revertuntur, ita homines instar turbinis degressi montibus impeditis et arduis loca petivere mari confinia, per quae viis latebrosis sese convallibusque occultantes cum appeterent noctes luna etiam tum cornuta ideoque nondum solido splendore fulgente nauticos observabant quos cum in somnum sentirent effusos per ancoralia, quadrupedo gradu repentes seseque suspensis passibus iniectantes in scaphas eisdem sensim nihil opinantibus adsistebant et incendente aviditate saevitiam ne cedentium quidem ulli parcendo obtruncatis omnibus merces opimas velut viles nullis repugnantibus avertebant. haecque non diu sunt perpetrata.', 'p5.jpg', '599.00', 10),
(6, 2, 'Trek Domane AL 2', 'Iis igitur est difficilius satis facere, qui se Latina scripta dicunt contemnere. in quibus hoc primum est in quo admirer, cur in gravissimis rebus non delectet eos sermo patrius, cum idem fabellas Latinas ad verbum e Graecis expressas non inviti legant. quis enim tam inimicus paene nomini Romano est, qui Ennii Medeam aut Antiopam Pacuvii spernat aut reiciat, quod se isdem Euripidis fabulis delectari dicat, Latinas litteras oderit.', 'p6.jpg', '649.00', 10),
(7, 2, 'Scott Speedster 20', 'Sed si ille hac tam eximia fortuna propter utilitatem rei publicae frui non properat, ut omnia illa conficiat, quid ego, senator, facere debeo, quem, etiamsi ille aliud vellet, rei publicae consulere oporteret.', 'p7.jpg', '999.00', 10),
(8, 2, 'Trek Émonda ALR 4', 'Nihil morati post haec militares avidi saepe turbarum adorti sunt Montium primum, qui divertebat in proximo, levi corpore senem atque morbosum, et hirsutis resticulis cruribus eius innexis divaricaturn sine spiramento ullo ad usque praetorium traxere praefecti.', 'p8.jpg', '1299.00', 5),
(9, 3, 'Gazelle CityZen Speed', 'Nemo quaeso miretur, si post exsudatos labores itinerum longos congestosque adfatim commeatus fiducia vestri ductante barbaricos pagos adventans velut mutato repente consilio ad placidiora deverti.', 'p9.jpg', '3999.00', 2),
(10, 3, 'BMC Alpenchallenge City', 'Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.', 'p10.jpg', '3999.00', 2),
(11, 3, 'Scott Sub Cross eRide 30', 'Auxerunt haec vulgi sordidioris audaciam, quod cum ingravesceret penuria commeatuum, famis et furoris inpulsu Eubuli cuiusdam inter suos clari domum ambitiosam ignibus subditis inflammavit rectoremque ut sibi iudicio imperiali addictum calcibus incessens et pugnis conculcans seminecem laniatu miserando discerpsit. post cuius lacrimosum interitum in unius exitio quisque imaginem periculi sui considerans documento recenti similia formidabat.', 'p11.jpg', '1999.00', 4),
(12, 3, 'Orbea Keram 29 15', 'Non ergo erunt homines deliciis diffluentes audiendi, si quando de amicitia, quam nec usu nec ratione habent cognitam, disputabunt. Nam quis est, pro deorum fidem atque hominum! qui velit, ut neque diligat quemquam nec ipse ab ullo diligatur, circumfluere omnibus copiis atque in omnium rerum abundantia vivere? Haec enim est tyrannorum vita nimirum, in qua nulla fides, nulla caritas, nulla stabilis benevolentiae potest esse fiducia, omnia semper suspecta atque sollicita, nullus locus amicitiae.', 'p12.jpg', '2599.00', 2),
(13, 1, 'Trek Marlin 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed finibus eget felis a cursus. Cras laoreet mi dui. In vel tincidunt est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac lacinia leo. Nam varius, lacus at efficitur scelerisque, dui dolor consequat est, tincidunt auctor felis est at diam. Proin in eros elit. Phasellus feugiat sagittis lacus, eu condimentum orci sagittis pretium. Nunc vehicula sem id orci ultrices dictum. Praesent arcu libero, sodales eget augue vitae, egestas aliquam elit. Donec metus diam, sagittis nec magna sit amet, molestie sodales ipsum. Mauris euismod sagittis orci, a tincidunt nibh malesuada ut. Aenean vitae auctor massa. Aenean ac est felis. Mauris tristique elementum odio, in ullamcorper urna cursus sit amet.', 'p13.jpg', '449.00', 2),
(14, 1, 'Scott Contessa 740', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent scelerisque purus et dui tincidunt condimentum. Duis porttitor justo sed est pharetra pharetra. Nullam sit amet tellus massa. Praesent auctor ornare sapien et tincidunt. Pellentesque est erat, commodo nec gravida eget, ultrices at justo. Cras ut euismod lacus. Quisque ut dolor ullamcorper, rhoncus diam quis, viverra eros.', 'p14.jpg', '449.00', 3),
(15, 1, 'Scott Aspect 760', 'Dolor sit amet, consectetur adipiscing elit. Mauris orci metus, euismod nec bibendum vitae, accumsan id urna. Nam in lobortis mauris, id egestas odio. Sed et egestas elit. Sed aliquet ornare arcu, id malesuada orci consectetur ut. Pellentesque nec dolor ac libero cursus suscipit. Etiam sed sem est. Donec id molestie risus. Donec facilisis massa tortor, id dapibus elit mollis et. Mauris at dolor non elit finibus iaculis et eu metus. Aenean bibendum ex quis fermentum laoreet.', 'p15.jpg', '499.00', 4),
(16, 1, 'Trek Marlin 4', 'Illud tamen te esse admonitum volo, primum ut qualis es talem te esse omnes existiment ut, quantum a rerum turpitudine abes, tantum te a verborum libertate seiungas; deinde ut ea in alterum ne dicas, quae cum tibi falso responsa sint, erubescas. Quis est enim, cui via ista non pateat, qui isti aetati atque etiam isti dignitati non possit quam velit petulanter, etiamsi sine ulla suspicione, at non sine argumento male dicere? Sed istarum partium culpa est eorum, qui te agere voluerunt; laus pudoris tui, quod ea te invitum dicere videbamus, ingenii, quod ornate politeque dixisti.', 'p16.jpg', '429.00', 3),
(17, 1, 'GT Aggressor Sport', 'Horum adventum praedocti speculationibus fidis rectores militum tessera data sollemni armatos omnes celeri eduxere procursu et agiliter praeterito Calycadni fluminis ponte, cuius undarum magnitudo murorum adluit turres, in speciem locavere pugnandi. neque tamen exiluit quisquam nec permissus est congredi. formidabatur enim flagrans vesania manus et superior numero et ruitura sine respectu salutis in ferrum.\r\n\r\n', 'p17.jpg', '399.00', 6),
(18, 1, 'Scott Aspect 980', 'Metuentes igitur idem latrones Lycaoniam magna parte campestrem cum se inpares nostris fore congressione stataria documentis frequentibus scirent, tramitibus deviis petivere Pamphyliam diu quidem intactam sed timore populationum et caedium, milite per omnia diffuso propinqua, magnis undique praesidiis conmunitam.', 'p18.jpg', '399.00', 8),
(19, 1, 'Orbea MX 29 ENT 60', 'Sed quid est quod in hac causa maxime homines admirentur et reprehendant meum consilium, cum ego idem antea multa decreverim, que magis ad hominis dignitatem quam ad rei publicae necessitatem pertinerent? Supplicationem quindecim dierum decrevi sententia mea. Rei publicae satis erat tot dierum quot C. Mario ; dis immortalibus non erat exigua eadem gratulatio quae ex maximis bellis. Ergo ille cumulus dierum hominis est dignitati tributus.\r\n\r\n', 'p19.jpg', '229.00', 8),
(20, 2, 'Trek Domane AL 3', 'Rogatus ad ultimum admissusque in consistorium ambage nulla praegressa inconsiderate et leviter proficiscere inquit ut praeceptum est, Caesar sciens quod si cessaveris, et tuas et palatii tui auferri iubebo prope diem annonas. hocque solo contumaciter dicto subiratus abscessit nec in conspectum eius postea venit saepius arcessitus.', 'p20.jpg', '649.00', 4),
(21, 2, 'Scott Speedster 40', 'Procedente igitur mox tempore cum adventicium nihil inveniretur, relicta ora maritima in Lycaoniam adnexam Isauriae se contulerunt ibique densis intersaepientes itinera praetenturis provincialium et viatorum opibus pascebantur.', 'p20.jpg', '699.00', 4),
(22, 2, 'Scott Contessa Speedster 35', 'Et licet quocumque oculos flexeris feminas adfatim multas spectare cirratas, quibus, si nupsissent, per aetatem ter iam nixus poterat suppetere liberorum, ad usque taedium pedibus pavimenta tergentes iactari volucriter gyris, dum exprimunt innumera simulacra, quae finxere fabulae theatrales.', 'p22.jpg', '699.00', 5),
(23, 2, 'Lapierre AUDACIO 100 CP', 'Eius populus ab incunabulis primis ad usque pueritiae tempus extremum, quod annis circumcluditur fere trecentis, circummurana pertulit bella, deinde aetatem ingressus adultam post multiplices bellorum aerumnas Alpes transcendit et fretum, in iuvenem erectus et virum ex omni plaga quam orbis ambit inmensus, reportavit laureas et triumphos, iamque vergens in senium et nomine solo aliquotiens vincens ad tranquilliora vitae discessit.', 'p23.jpg', '749.00', 4),
(24, 2, 'Lapierre AUDACIO 100', 'At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri, miraberis numquam antea visus summatem virum tenuem te sic enixius observantem, ut paeniteat ob haec bona tamquam praecipua non vidisse ante decennium Romam.', 'p24.jpg', '749.00', 3),
(25, 2, 'Cannondale Topstone Disc SE Sora', 'Rogatus ad ultimum admissusque in consistorium ambage nulla praegressa inconsiderate et leviter proficiscere inquit ut praeceptum est, Caesar sciens quod si cessaveris, et tuas et palatii tui auferri iubebo prope diem annonas. hocque solo contumaciter dicto subiratus abscessit nec in conspectum eius postea venit saepius arcessitus.', 'p25.jpg', '999.00', 6),
(26, 3, 'Orbea Keram 29 30', 'Accedat huc suavitas quaedam oportet sermonum atque morum, haudquaquam mediocre condimentum amicitiae. Tristitia autem et in omni re severitas habet illa quidem gravitatem, sed amicitia remissior esse debet et liberior et dulcior et ad omnem comitatem facilitatemque proclivior.', 'p26.jpg', '1999.00', 15),
(27, 3, 'Orbea Gain F40', 'Hoc inmaturo interitu ipse quoque sui pertaesus excessit e vita aetatis nono anno atque vicensimo cum quadriennio imperasset. natus apud Tuscos in Massa Veternensi, patre Constantio Constantini fratre imperatoris, matreque Galla sorore Rufini et Cerealis, quos trabeae consulares nobilitarunt et praefecturae.', 'p27.jpg', '1899.00', 15),
(28, 3, 'Scott Sub Cross eRide 30', 'Et olim licet otiosae sint tribus pacataeque centuriae et nulla suffragiorum certamina set Pompiliani redierit securitas temporis, per omnes tamen quotquot sunt partes terrarum, ut domina suscipitur et regina et ubique patrum reverenda cum auctoritate canities populique Romani nomen circumspectum et verecundum.', 'p28.jpg', '1999.00', 15),
(29, 3, 'Scott Roxter eRide 24', 'Eminuit autem inter humilia supergressa iam impotentia fines mediocrium delictorum nefanda Clematii cuiusdam Alexandrini nobilis mors repentina; cuius socrus cum misceri sibi generum, flagrans eius amore, non impetraret, ut ferebatur, per palatii pseudothyrum introducta, oblato pretioso reginae monili id adsecuta est, ut ad Honoratum tum comitem orientis formula missa letali omnino scelere nullo contactus idem Clematius nec hiscere nec loqui permissus occideretur.', 'p29.jpg', '1999.00', 15),
(30, 3, 'Lapierre OVERVOLT CROSS 400', 'Sed tamen haec cum ita tutius observentur, quidam vigore artuum inminuto rogati ad nuptias ubi aurum dextris manibus cavatis offertur, inpigre vel usque Spoletium pergunt. haec nobilium sunt instituta.', 'p30.jpg', '2099.00', 15),
(31, 3, 'Orbea Keram 29 20', 'Quid enim tam absurdum quam delectari multis inanimis rebus, ut honore, ut gloria, ut aedificio, ut vestitu cultuque corporis, animante virtute praedito, eo qui vel amare vel, ut ita dicam, redamare possit, non admodum delectari? Nihil est enim remuneratione benevolentiae, nihil vicissitudine studiorum officiorumque iucundius.', 'p31.jpg', '2299.00', 15),
(32, 3, 'Lapierre OVERVOLT HT 500', 'Homines enim eruditos et sobrios ut infaustos et inutiles vitant, eo quoque accedente quod et nomenclatores adsueti haec et talia venditare, mercede accepta lucris quosdam et prandiis inserunt subditicios ignobiles et obscuros.', 'p32.jpg', '2199.00', 15),
(33, 3, 'Riese & Müller Delite GTS', 'Has autem provincias, quas Orontes ambiens amnis imosque pedes Cassii montis illius celsi praetermeans funditur in Parthenium mare, Gnaeus Pompeius superato Tigrane regnis Armeniorum abstractas dicioni Romanae coniunxit.', 'p33.jpg', '9999.00', 4),
(34, 3, 'BMC Speedfox AMP ONE', 'Tantum autem cuique tribuendum, primum quantum ipse efficere possis, deinde etiam quantum ille quem diligas atque adiuves, sustinere. Non enim neque tu possis, quamvis excellas, omnes tuos ad honores amplissimos perducere, ut Scipio P. Rupilium potuit consulem efficere, fratrem eius L. non potuit. Quod si etiam possis quidvis deferre ad alterum, videndum est tamen, quid ille possit sustinere.', 'p34.jpg', '8999.00', 15),
(35, 3, 'Moustache Samedi 27 Race 11', 'Cuius acerbitati uxor grave accesserat incentivum, germanitate Augusti turgida supra modum, quam Hannibaliano regi fratris filio antehac Constantinus iunxerat pater, Megaera quaedam mortalis, inflammatrix saevientis adsidua, humani cruoris avida nihil mitius quam maritus; qui paulatim eruditiores facti processu temporis ad nocendum per clandestinos versutosque rumigerulos conpertis leviter addere quaedam male suetos falsa et placentia sibi discentes, adfectati regni vel artium nefandarum calumnias insontibus adfligebant.', 'p35.jpg', '8599.00', 15),
(36, 3, 'Cube Cross Hybrid ONE 500', 'Et Epigonus quidem amictu tenus philosophus, ut apparuit, prece frustra temptata, sulcatis lateribus mortisque metu admoto turpi confessione cogitatorum socium, quae nulla erant, fuisse firmavit cum nec vidisset quicquam nec audisset penitus expers forensium rerum; Eusebius vero obiecta fidentius negans, suspensus in eodem gradu constantiae stetit latrocinium illud esse, non iudicium clamans.', 'p36.jpg', '2199.00', 10),
(37, 3, 'Moustache Samedi 26 OFF', 'Haec igitur Epicuri non probo, inquam. De cetero vellem equidem aut ipse doctrinis fuisset instructior est enim, quod tibi ita videri necesse est, non satis politus iis artibus, quas qui tenent, eruditi appellantur aut ne deterruisset alios a studiis. quamquam te quidem video minime esse deterritum.', 'p37.jpg', '2199.00', 8),
(38, 3, 'HAIBIKE SDURO Cross 3.0', 'Denique Antiochensis ordinis vertices sub uno elogio iussit occidi ideo efferatus, quod ei celebrari vilitatem intempestivam urgenti, cum inpenderet inopia, gravius rationabili responderunt; et perissent ad unum ni comes orientis tunc Honoratus fixa constantia restitisset.', 'p38.jpg', '2499.00', 3),
(39, 3, 'Cube Cross Hybrid Race 500 Allroad', 'Excitavit hic ardor milites per municipia plurima, quae isdem conterminant, dispositos et castella, sed quisque serpentes latius pro viribus repellere moliens, nunc globis confertos, aliquotiens et dispersos multitudine superabatur ingenti, quae nata et educata inter editos recurvosque ambitus montium eos ut loca plana persultat et mollia, missilibus obvios eminus lacessens et ululatu truci perterrens.', 'p39.jpg', '2999.00', 6),
(40, 3, 'Luinora Winora Sinus IN8 Urban', 'Verum ad istam omnem orationem brevis est defensio. Nam quoad aetas M. Caeli dare potuit isti suspicioni locum, fuit primum ipsius pudore, deinde etiam patris diligentia disciplinaque munita. Qui ut huic virilem togam deditšnihil dicam hoc loco de me; tantum sit, quantum vos existimatis; hoc dicam, hunc a patre continuo ad me esse deductum; nemo hunc M. Caelium in illo aetatis flore vidit nisi aut cum patre aut mecum aut in M. Crassi castissima domo, cum artibus honestissimis erudiretur.', 'p40.jpg', '2399.00', 7);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `visual` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `visual`) VALUES
(1, 'VTT', 'Le VTT réunit les sensations fortes et l’amour de la nature, l’adrénaline et la technique, et le sport et le plaisir. Il est maintenant de plus en plus utilisé en ville - quoi de plus pratique que d’utiliser le même vélo la semaine en ville et le week-end à la campagne ? ', 'c1.jpg'),
(2, 'Vélo de route', 'Ces machines fines et racées avalent les kilomètres et démarrent au quart de tour, le pied à peine posé sur la pédale.', 'c2.jpg'),
(3, 'Vélo électrique', 'Vous recherchez le plaisir du pilotage ? Atteignez des records avec cette machine de guerre dernière génération !', 'c3.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `lastname`, `firstname`, `password`, `address`, `zipcode`, `city`, `email`, `phone`) VALUES
(1, 'KINCHT', 'Fred', 'lol', '69, avenue des Amandiers', '41000', 'BLOIS', 'JohnnyMPalmer@hotmail.fr', '0796432014'),
(2, 'BUSCH', 'Johnny', 'lol', '94, rue des Chaligny', '06300', 'NICE', 'bushjohn@outlook.com', '0763214565'),
(3, 'TREVISANI', 'Mathilde', 'lol', '74, rue Lenotre', '35200', 'RENNES', 'mathilde.trevisani@gmail.com', '0641298565'),
(4, 'KOLOVOSKI', 'Olga', 'lol', '99, rue du Fossé des Tanneurs', '83000', 'TOULON', 'olga.83@outlook.fr', '0694523621');

-- --------------------------------------------------------

--
-- Structure de la table `line_order`
--

DROP TABLE IF EXISTS `line_order`;
CREATE TABLE IF NOT EXISTS `line_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AADB41B8D9F6D38` (`order_id`),
  KEY `IDX_AADB41B7294869C` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `line_order`
--

INSERT INTO `line_order` (`id`, `order_id`, `article_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_E52FFDEE19EB6921` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `date`) VALUES
(1, 3, '2019-03-23 10:24:04');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `line_order`
--
ALTER TABLE `line_order`
  ADD CONSTRAINT `FK_AADB41B7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_AADB41B8D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEE19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
