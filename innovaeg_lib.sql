-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2016 at 09:38 PM
-- Server version: 5.6.31
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `innovaeg_lib`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`, `branch`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'ALL'),
(23, 'finance', '57336afd1f4b40dfd9f5731e35302fe5', 'Financial', 'ALL'),
(6, 'librarian', '35fa1bcb6fbfa7aa343aa7f253507176', 'Librarian', 'ALL'),
(5, 'borrow', '485ec278821f55d103fe0b06eaa85fa3', 'Borrowing', 'ALL'),
(7, 'sell', '8325324b47e1e62a1c2998a640cbdc72', 'Selling', 'ALL'),
(28, 'ports', '47f06098d3034f593871b524ce4f7965', 'Branch', 'PortSaid'),
(21, 'hr', 'adab7b701f23bb82014c8506d3dc784e', 'HR', 'Ismailia'),
(19, 'career', '8ae1016c4044ea668c4db3f57e3cc7f1', 'HR', 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE IF NOT EXISTS `attendence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `dates` date NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `employee_id`, `dates`, `status`) VALUES
(1, 1, '2016-03-24', 'present'),
(2, 2, '2016-03-24', 'absent');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `author` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `author`, `description`, `pic`) VALUES
(1, 'Dan Brown', 'Dan Brown\r\nDan Brown\r\nDan Brown', 'C20N3.gif'),
(2, 'يوسف زيدان', 'باحث ومفكر مصري متخصص في التراث العربي المخطوط وعلومه. له عديد من المؤلفات والأبحاث العلمية في الفكر الإسلامي والتصوف وتاريخ الطب العربي. وله إسهام أدبي يتمثل في أعمال روائية منشورة (رواية ظل الأفعى ورواية عزازيل) ، كما أن له مقالات دورية وغير دورية في عدد من الصحف المصرية والعربية. عمل مستشاراً لعدد من المنظمات الدولية الكبرى مثل: منظمة اليونسكو، منظمة الإسكوا، جامعة الدول العربية، وغيرها من المنظمات. وقد ساهم وأشرف على مشاريع ميدانية كثيرة تهدف إلى رسم خارطة للتراث العربي المخطوط المشتت بين أرجاء العالم المختلفة. يشغل منصب مدير مركز المخطوطات بمكتبة الإسكندرية منذ عام 2001 إلى الآن', '71777_zidan.jpg'),
(3, 'أحمد مراد', 'أحمد مراد\r\nأحمد مراد\r\nأحمد مراد', 'a7med morad.jpg'),
(4, 'George Orwell', 'جورج اورويل\r\nجورج اورويل\r\nجورج اورويل', 'George_Orwell_press_photo.jpg'),
(5, 'J.K. Rowling', 'J.K. Rowling', 'jk-rowling-official-portrait.jpg'),
(24, 'أحمد خالد توفيق', 'أحمد خالد توفيق\r\nأحمد خالد توفيق\r\nأحمد خالد توفيق', '171720_1417000889.JPG'),
(25, 'منى المرشود', 'منى المرشود\r\nمنى المرشود\r\nمنى المرشود', 'avatar.png'),
(31, 'عباس محمود العقاد', 'ولد العقاد في أسوان في 29 شوال 1306 هـ - 28 يونيو 1889 وتخرج من المدرسة الإبتدائية سنة 1903. أسس بالتعاون مع إبراهيم المازني وعبد الرحمن شكري "مدرسة الديوان"، وكانت هذه المدرسة من أنصار التجديد في الشعر والخروج به عن القالب التقليدي العتيق. عمل العقاد بمصنع للحرير في مدينة دمياط، وعمل بالسكك الحديدية لأنه لم ينل من التعليم حظا وافرا حيث حصل على الشهادة الإبتدائية فقط، لكنه في الوقت نفسه كان مولعا بالقراءة في مختلف المجالات، وقد أنفق معظم نقوده على شراء الكتب.\r\n', '100193.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ISBN` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `publisher` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `p_year` int(11) NOT NULL,
  `category` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `ISBN` (`ISBN`),
  UNIQUE KEY `pic` (`pic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `ISBN`, `author`, `publisher`, `p_year`, `category`, `description`, `pic`, `rate`) VALUES
(2, 'فيرتيجو', '111222333', 'أحمد مراد', 'دار ميريت', 2007, 'Novels', 'منذ سقط الحارس الأول ضغط بأعصابه على زر التصوير ولم يرفعه مسجلاً لآخر لقطة فى حياة هشام فتحى حتى مرت الرصاصة بجانبه فأصابت أذنيه بأزيز أعقبه صمم موقت فأفاق من تركيزه فى منظار الكاميرا وتملكه الرعب من أن يلحظ أحد وجوده فسحب شنطة الكاميرا وإلتصق بالحائط، فى اللحظة التى كان فيها المهاجم الثالث يسقط البارمان الذى ركض إلى الحمام بطلقتين فى ظهره وتوجه لحسام منير الذى وقف متسمراً خلف البيانو، نظر فى عينيه مباشرة للحظة بدت كساعة زمن ثم رفع فوهة مسدسه ناحيته فى نفس اللحظة التى حول حسام نظره ناحية الشرفة التى إستقر فيها أحمد باحثاً بحدقتيه عن الأخير', '280px-Vertigo_2.jpg', 0),
(3, 'Davinci Code', '1010101010', 'Dan Brown', 'الدار المصرية اللبنانية', 2006, 'Novels', 'ضمن أجواء غامضة يدور بحث البروفيسور لانغدون أستاذ علم الرموز الدينية في جامعة هارفرد عن سرّ الرسالة التي تركها جد صوفي خلف لوحة ليوناردو دافنشي "مادونا أوف ذا روكس" والتي كانت حلقة أخرى تضاف إلى سلسلة من الرموز المرتبطة ببعضها البعض، حيث كان جد صوفي سونيير ذا ولع شديد بالجانب الغامض والعبثي لليوناردو دافنشي. وفي الوقت ذاته كان اهتمام البروفيسور لانغدون وولعه شديداً بالرموز الدينية وبفكها، فكتبه حول الرسومات الدينية وعلم الرموز جعلت منه معارضاً مشهوراً في عالم الفن حتى غدا حضوره قوياً وشهرته واسعة وخاصة بعد تورطه في حادثة في الفاتيكان، تلك الحادثة أخذت أبعاداً إعلانية إلى درجة جعلت أهل الفن مهتمين به إلى أبعد الحدود. ينطلق لانغدون وصوفي في رحلة بحثية تمر في شوارع روما متوقفة عند كاتدرائياتها مروراً إلى باريس متوقفة عند متحف اللوفر في رحلة مشوقة لمعرفة سر رسالة جد صوفي والتي فتحت آفاقاً إلى اكتشاف سر الفارس المخلد في قصيدة دونت ضمن تلك الرسالة وذلك ضمن أجواء بوليسية شيقة وبأسلوب تميز به الكاتب دان براون في قصصه ذات الطابع البوليسي ويمكن القول بأن "شيفرة دافنتشي" هذه تتجاوز بتصنيفها الرواية البوليسية المثيرة بمراحل عديدة إذ أنها يلفها غموض ممتع مرتكز على أسرار بشكل ألغاز. تشد القارئ إلى درجة كبيرة متابعاً تفاصيل تلك الرواية بمزيد من المتع والذهول', '1247017390.jpg', 0),
(4, 'الرمز المفقود', '987654321', 'Dan Brown', 'الدار المصرية اللبنانية', 2009, 'Novels', 'Famed Harvard symbologist Robert Langdon answers an unexpected summons to appear at the U.S. Capitol Building. His planned lecture is interrupted when a disturbing object—artfully encoded with five symbols—is discovered in the building. Langdon recognizes in the find an ancient invitation into a lost world of esoteric, potentially dangerous wisdom. When his mentor Peter Solomon—a longstanding Mason and beloved philanthropist—is kidnapped, Langdon realizes that the only way to save Solomon is to accept the mystical invitation and plunge headlong into a clandestine world of Masonic secrets, hidden history, and one inconceivable truth . . . all under the watchful eye of Dan Brown''s most terrifying villain to date. Set within the hidden chambers, tunnels, and temples of Washington, D.C., The Lost Symbol is an intelligent, lightning-paced story with surprises at every turn--Brown''s most exciting novel yet. ', 'ramz.jpg', 0),
(5, 'عزازيل', '1156165', 'يوسف زيدان', 'دار الشروق', 2009, 'historical', 'دور أحداث الرواية في القرن الخامس الميلادي ما بين صعيد مصر والإسكندرية وشمال سوريا، عقب تبني الإمبراطورية الرومانية للدين المسيحي، وما تلا ذلك من صراع مذهبي داخلي بين آباء الكنيسة من جهة، والمؤمنين الجدد والوثنية المتراجعة من جهة أخرى.\r\n\r\n"ما أظن أني تمتعت بعمل من هذا القبيل.. ما أروع هذا العمل"\r\n-- يحيى الجمل\r\n\r\n"هذه الرواية عمل مبدع وخطير، مبدع لما يحتويه من مناطق حوارية إنسانية مكتوبة بحساسية مرهفة تمتزج فيها العاطفة بالمتعة، وخطير لأنه يتضمن دراسة في نشأة وتطور الصراع المذهبي بين الطوائف المسيحية في المشرق.. إن يوسف زيدان يتميز بالموهبتين، موهبة المبدع وموهبة الباحث، وكثيرا ما تتداخل الموهبتان في هذا العمل"\r\n-- سامي خشبة\r\n\r\n"لو قرأنا الرواية قراءة حقيقية، لأدركنا سمو أهدافها ونبل غاياتها الأخلاقية والروحية التي هي تأكيد لقيم التسامح وتقبل الآخر، واحترام حق الاختلاف، ورفض مبدأ العنف.. ولغة الرواية لغة شعرية، تترجع فيها أصداء المناجيات الصوفية، خصوصا حين نقرأ مناجاة هيبا لربه "\r\n-- د. جابر عصفور\r\n\r\n"يوسف زيدان هو أول روائي مسلم، يكتب عن اللاهوت المسيحي بشكل روائي عميق. وهو أول مسلم، يحاول أن يعطي حلولا لمشكلات كنسية كبرى.. إن يوسف زيدان اقتحم حياة الأديرة، ورسم بريشة راهب أحداثا كنسية حدثت بالفعل، وكان لها أثر عظيم في تاريخ الكنيسة القبطية"\r\n-- المطران يوحنا جريجووريوس', '3azazeel-1.jpg', 0),
(6, '1984', ' 0451524934', 'George Orwell', 'دار نون', 1950, 'Novels', 'The year 1984 has come and gone, but George Orwell''s prophetic, nightmarish vision in 1949 of the world we were becoming is timelier than ever. 1984 is still the great modern classic of "negative utopia" -a startlingly original and haunting novel that creates an imaginary world that is completely convincing, from the first sentence to the last four words. No one can deny the novel''s hold on the imaginations of whole generations, or the power of its admonitions -a power that seems to grow, not lessen, with the passage of time', '1984.jpg', 0),
(12, 'محال', '561651561', 'يوسف زيدان', 'دار الشروق', 2013, 'Novels', 'بطل هذه الرواية شاب مصري سوداني يتسم بالبراءة والتدين، ويعمل كمرشد سياحي في الأقصر وأسوان. كانت أقصى أحلام هذا الشاب هي الزواج من فتاة نوبية جميلة ليبدأ حياة سعيدة هانئة، ولكن نظام حياته المسالم والممل ينقلب رأسا على عقب بعد مقابلة مع أسامة بن لادن في السودان في أوائل التسعينيات.\r\n\r\nتأسرنا الرواية بإيقاعها المتسارع لنتتبع مصير بطلها من الأقصر للخليج لأوزبكستان ثم أفغانستان ومعتقل جوانتانامو. لغة يوسف زيدان الشعرية تجعلنا نعيش تجربة إنسانية فريدة، حيث يختلط الواقع بالخيال وننطلق مع البطل في رحلة لنكتشف خبايا النفس والعالم', '11995136.jpg', 0),
(14, 'الجحيم', '2147483647', 'Dan Brown', 'الدار المصرية اللبنانية', 2013, 'Novels', 'يفتح روبرت لانغدون، بروفيسور علم الرموز في جامعة هارفرد، عينيه في منتصف الليل متألماً من جرح في الرأس، ليكتشف أنه راقد في المستشفى لا يستطيع أن يتذكّر ما حدث معه خلال الساعات الست والثلاثين الأخيرة أو مصدر ذلك الشيء الرهيب الذي اكتشفه الأطباء بين أمتعته.\r\nإثر هذا تدبّ الفوضى في عالم لانغدون ويضطر للهروب عبر أزقة مدينة فلورنسا برفقة شابة لطيفة تدعى سيينّا بروكس، التي تمكنت من إنقاذ حياته بفعل تصرفاتها الذكية، ليتبيّن له أن بحوزته مجموعة من الرموز الخطرة التي ابتدعها عالِمٌ فذّ.\r\nتتسارع الأحداث عبر مواقع أثرية شهيرة، مثل قصر فيكيو، ويكتشف لانغدون وبروكس شبكة من السراديب القديمة، فضلاً عن نموذج علمي جديد ومخيف من شأنه أن يُستخدم إمّا لتحسين نوعية الحياة على الأرض... أو تدميرها.\r\nعلى هذه الخلفية، يصارع لانغدون خصماً رهيباً بينما يتشبث بلغز يأخذه إلى عالم الفنون الكلاسيكية والممرات السرية والعلوم المستقبلية، محاولاً اكتشاف الأجوبة ومعرفة مَن هو الجدير بثقته... قبل الانهيار الكبير', 'Inferno-cover.jpg', 0),
(24, 'الفيل الأزرق', '9789770931547', 'أحمد مراد', 'دار الشروق', 2012, 'Science Fiction', 'عد خمس سنوات من العُزلة الاختيارية يستأنف د. يحيى عمله في مستشفى العباسية للصحّة النفسية، حيث يجد في انتظاره مفاجأة..\r\n\r\nفي "8 غرب"، القسم الذي يقرّر مَصير مُرتكبي الجرائم، يُقابل صديقاً قديماً يحمل إليه ماضياً جاهد طويلاً لينساه، ويصبح مَصيره فجأة بين يدي يحيى..\r\n\r\nتعصِف المفاجآت بيحيى وتنقلب حياته رأسًا على عقب، ليصبح ما بدأ كمحاولة لاكتشاف حقيقة صديقه، رحلة مثيرة لاكتشاف نفسه.. أو ما تبقى منها..\r\n\r\nيأخذنا أحمد مراد في روايته الثالثة إلى كواليس عالم غريب قضى عامين في دراسة تفاصيله، رحلة مثيرة مستكشف فيها أعمق وأغرب خبايا النفس البشرية', '16031620.jpg', 0),
(25, 'أنت لي', '123456789000', 'منى المرشود', 'الدار المصرية اللبنانية', 2007, 'Novels', 'هي باختصار تسرد احداث حب بريئ فى قلوب مسلمة مؤمنة بالله ', 'cover2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_4mat`
--

CREATE TABLE IF NOT EXISTS `book_4mat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `soft_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_name` (`book_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `book_4mat`
--

INSERT INTO `book_4mat` (`id`, `book_name`, `type`, `url`, `soft_type`) VALUES
(29, 'أنت لي', 's', 'Library System.docx', 's'),
(2, 'فيرتيجو', 'b', 'https://www.facebook.com/AhmedMouradWriter', 'r'),
(3, 'Davinci Code', 's', 'https://www.facebook.com/davincicodeofficial', 'b'),
(4, 'الرمز المفقود', 'h', '', ''),
(5, 'عزازيل', 'b', 'https://www.facebook.com/pages/Youssef-Ziedan/102494903137146', 'r'),
(6, '1984', 'b', 'https://www.facebook.com/pages/1984-George-Orwell', 'b'),
(11, 'محال', 'h', '', ''),
(13, 'الجحيم', 'h', '', ''),
(28, 'الفيل الأزرق', 'b', 'https://www.facebook.com/pages/%D8%A7%D9%84%D9%81%D9%8A%D9%84-%D8%A7%D9%84%D8%A3%D8%B2%D8%B1%D9%82-%D8%B1%D9%88%D8%A7%D9%8A%D8%A9/847839068596703', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE IF NOT EXISTS `borrows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `b_date` date NOT NULL,
  `book_return` date NOT NULL,
  `user_return` date NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`id`, `book_name`, `username`, `b_date`, `book_return`, `user_return`, `status`, `type`) VALUES
(1, 'فيرتيجو', 'nehal', '2016-03-31', '2016-04-06', '2016-04-07', 'delay', 'hard'),
(2, 'الجحيم', 'nehal', '2016-04-07', '2016-04-21', '0000-00-00', '', 'hard'),
(3, 'عزازيل', 'm7md', '2016-04-07', '2016-04-14', '2016-04-07', 'In Time', 'soft'),
(4, 'محال', 'eng-nanna', '2016-03-31', '2016-04-14', '2016-04-07', 'In Time', 'hard');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `username` (`username`,`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `username`, `password`) VALUES
(4, 'Ismailia', 'ismailia', '911afacd7ec01e4dec9b507d4e36352f'),
(5, 'Cairo', 'cairo', '7f9d3e4a2e6ff5e78ccaf346214ad919'),
(6, 'PortSaid', 'ports', '47f06098d3034f593871b524ce4f7965');

-- --------------------------------------------------------

--
-- Table structure for table `b_copies`
--

CREATE TABLE IF NOT EXISTS `b_copies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `copies` int(11) NOT NULL,
  `current_copies` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_name` (`book_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `b_copies`
--

INSERT INTO `b_copies` (`id`, `book_name`, `branch`, `copies`, `current_copies`) VALUES
(2, 'فيرتيجو', '', 3, 3),
(3, 'Davinci Code', '', 0, 0),
(4, 'الرمز المفقود', '', 0, 0),
(5, 'عزازيل', '', 2, 2),
(6, '1984', '', 2, 2),
(11, 'محال', '', 2, 2),
(12, 'الجحيم', '', 1, 0),
(22, 'الفيل الأزرق', '', 3, 3),
(23, 'أنت لي', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `book_id`) VALUES
(1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `pic`) VALUES
(2, 'Novels', ''),
(3, 'Science Fiction', ''),
(5, 'historical', 'n-gram_old_books.jpg'),
(6, 'Children', 'bookstore-quality-childrens.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contract_date` date NOT NULL,
  `first` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `second` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attach` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `name`, `type`, `contract_date`, `first`, `second`, `attach`) VALUES
(3, 'contract', 'Insurance', '2016-05-22', 'tester1', 'tester2', 'Library System.docx');

-- --------------------------------------------------------

--
-- Table structure for table `extra_bonus`
--

CREATE TABLE IF NOT EXISTS `extra_bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `bonus` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `bonus_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `title`, `description`) VALUES
(1, 'Librarian', 'a person who works professionally in a library, providing access to information and sometimes social or technical programming. They are usually required to hold a degree from a library school such as a Master''s degree in Library Science or Library and Information Studies.'),
(2, 'HR', 'the set of individuals who make up the workforce of an organization, business sector, or economy. "Human capital" is sometimes used synonymously with human resources, although human capital typically refers to a more narrow view . Likewise, other terms sometimes used include "manpower", "talent", "labour", or simply "people".'),
(3, 'Financial', 'responsible for the financial health of an organization. They produce financial reports, direct investment activities, and develop strategies and plans for the long-term financial goals of their organization');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE IF NOT EXISTS `overtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `overtime_days` int(11) NOT NULL,
  `bonus` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `overtime_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE IF NOT EXISTS `penalty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `discount` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `penalty` text COLLATE utf8_unicode_ci NOT NULL,
  `penalty_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `soft_price` int(11) NOT NULL,
  `hard_price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_name` (`book_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `book_name`, `soft_price`, `hard_price`) VALUES
(2, 'فيرتيجو', 0, 40),
(3, 'Davinci Code', 35, 0),
(4, 'الرمز المفقود', 0, 50),
(5, 'عزازيل', 0, 45),
(6, '1984', 0, 45),
(14, 'محال', 0, 30),
(15, 'Harry Potter and the Sorcerer''s Stone', 0, 40),
(16, 'الجحيم', 0, 45),
(26, 'الفيل الأزرق', 25, 50),
(27, 'أنت لي', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE IF NOT EXISTS `privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `privilege` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `privilege` (`username`,`privilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `username`, `privilege`) VALUES
(7, 'career', 'jobs'),
(11, 'finance', 'ALL'),
(9, 'hr', 'employee,jobs,attend'),
(16, 'ports', 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`) VALUES
(1, 'دار الشروق'),
(5, 'دار دون'),
(6, 'دار ميريت'),
(7, 'دار نون'),
(8, 'الدار المصرية اللبنانية');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `quotes` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `book_id`, `quotes`) VALUES
(1, 5, 'لا يوجد في العالم أسمى من دفع الآلام عن انسان لايستطيع التعبير عن ألمه'),
(2, 5, 'النوم هبة إلهية لولاها لاجتاح العالم الجنون'),
(3, 5, 'ولعل البدايات كما كان أستاذي القديم سوريانوس يقول ، ما هي إلا محض أوهام نعتقدها . فالبداية والنهاية إنما تكونان فقط في الخط المستقيم . ولا خطوط مستقيمة إلا في أوهامنا ، أو في الوريقات التي نسطر فيها ما نتوهمه . أما في الحياة وفي الكون كله ، فكل شئٍ دائري يعود إلى ما منه بدأ ، ويتداخل مع ما به اتصل'),
(4, 24, 'أنا فُتات إنسان يتظاهر أنه على قيد الحياة وهو ليس كذلك...\r\nأنا الذي يتنفس ويأكُل وينَام بقوة الدفع..\r\nأنا ساعة بدون عقْرب..\r\nأنا يُونس في بطن حُوت كافر لن يَلفظني عند جزيرة'),
(5, 24, 'أمّا السكوت فدائِماً أبلغ.. يحوي بداخله ما تعجز عنه الكلمات'),
(6, 2, 'ومات بداخله بالسكتة القلبية ذلك الرجل المدعو ضميرا'),
(7, 2, 'فما أسهل إقناع الحبيب لحبيبته خاصة فترة ما قبل الزواج ، قبل إجراء عملية المياه البيضاء لمرأه الحب العمياء '),
(8, 2, 'خرجت وخرجت وراءها روحه');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `new_price` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `selling`
--

CREATE TABLE IF NOT EXISTS `selling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sell_date` date NOT NULL,
  `price` double NOT NULL,
  `copies` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `selling`
--

INSERT INTO `selling` (`id`, `book_name`, `username`, `sell_date`, `price`, `copies`, `type`) VALUES
(1, 'الفيل الأزرق', 'eng-nanna', '2016-04-10', 150, 3, 'hard'),
(4, 'Davinci Code', 'nehal', '2016-04-10', 35, 1, 'soft'),
(5, 'الفيل الأزرق', 'test', '2016-04-10', 50, 1, 'soft'),
(6, 'عزازيل', 'm7md', '2016-04-10', 45, 1, 'hard'),
(7, 'محال', 'nehal', '2016-04-01', 60, 2, 'hard'),
(9, 'الجحيم', 'eng-nanna', '2016-04-05', 45, 1, 'hard'),
(10, 'عزازيل', 'user', '2016-04-07', 45, 1, 'hard'),
(11, 'فيرتيجو', '', '1970-01-01', 40, 1, 'hard');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pic` (`pic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `pic`) VALUES
(1, 'Book-Every-Entrepreneur-Read-Jorge-Assam-750x450.jpg'),
(3, 'good_it_books.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `salary` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `experience` int(11) NOT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `military` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `age`, `salary`, `title`, `start_date`, `experience`, `address`, `phone`, `military`) VALUES
(1, 'tester tester', 30, '2500', 'HR', '2016-04-01', 4, 'ismailia', '0123456789', 'Does not apply'),
(2, 'Innova Company', 50, '5000', 'Financial', '2016-02-02', 3, 'ismailia', '01111111', 'Currently serving');

-- --------------------------------------------------------

--
-- Table structure for table `s_copies`
--

CREATE TABLE IF NOT EXISTS `s_copies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `copies` int(11) NOT NULL,
  `current_copies` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_name` (`book_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `s_copies`
--

INSERT INTO `s_copies` (`id`, `book_name`, `branch`, `copies`, `current_copies`) VALUES
(2, 'فيرتيجو', '', 15, 15),
(3, 'الرمز المفقود', '', 2, 2),
(4, 'عزازيل', '', 20, 18),
(5, '1984', '', 2, 2),
(9, 'محال', '', 20, 18),
(10, 'الجحيم', '', 6, 5),
(20, 'الفيل الأزرق', '', 40, 37),
(21, 'أنت لي', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `book` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `name`, `book`) VALUES
(4, 'أنت لي', 'Library System.docx');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `l_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `building` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `username`, `mail`, `password`, `tel`, `area`, `street`, `building`, `status`) VALUES
(4, 'user', 'user', 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '123456789', 'Ismailia', 'التجاري', '36', 'new member'),
(5, 'test', 'test', 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '064 - 1111111', 'Cairo', 'النصر', '4', 'new member'),
(11, 'nehal', 'nabil', 'nehal', 'nanna@gmail.com', '0cc8b1c331c5f270e8492484168c98d9', '01002654291', 'Ismailia', 'Hai Al-Zohor', '63', 'Uncommitted'),
(14, 'm7md', 'gharib', 'm7md', 'mano@gmail.com', '5b4d762427d4dff75f6e5885cb380080', '01111111111', 'Ismailia', 'test', '1', 'Active'),
(16, 'nehal', 'nabil', 'eng-nanna', '123@gmail.com', 'b8080314e7132a8310134b7cd47f3269', '01111111111', 'Ismailia', 'Fox', '5', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE IF NOT EXISTS `vacancies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desciption` text COLLATE utf8_unicode_ci NOT NULL,
  `salary` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `title`, `desciption`, `salary`, `deadline`) VALUES
(1, 'Conservator', 'Salary is £26,000 - £29,966 per annum\nFull Time (36 hours per week)\n\nWorking with one of the largest, richest and most diverse research collections in the world, you’ll use your recent practical hands-on experience in the conservation of books to carry out conservation and preparation treatments on a wide range of paper based collection items.\nWith a degree in conservation or equivalent experience and a high level of manual dexterity, you’ll diagnose conservation problems, develop and evaluate options for solutions and liaise with conservation colleagues and curators to ensure the longevity, stability and accessibility of these prized assets.\nOperating with minimal supervision, you’ll also demonstrate your ability to plan and manage your work to ensure that production deadlines are met and provide clear, detailed and accurate records of all treatments undertaken in accordance with professional conservation standards and frameworks', '', '2016-05-01'),
(2, 'Content Developer', 'Salary is £26,000 per annum\r\nFull Time (36 hours per week)\r\nFixed Term Contract to 31st March 2017\r\n\r\nAs the British Library works towards making more of its collection available online, join us to develop a number of new websites and content areas based on our extensive collection of images, sound recordings and texts.\r\nWith proven experience of working within Content Managements Systems, you will utilise your excellent organisation skills to co-ordinate the timely upload of content to the site working with a range of teams and collection areas. This will include ensuring that content is copyright cleared, and metadata and permissions information is stored accurately in the central database.', '', '2016-04-30'),
(3, 'tester', 'testing', '1000', '2016-04-11'),
(4, 'tester2', 'test test test', '', '2016-04-12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
