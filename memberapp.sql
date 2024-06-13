-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-06-13 10:13:16
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `memberapp`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `member_id` text NOT NULL,
  `name_s` text NOT NULL,
  `name_m` text NOT NULL,
  `name_s_kn` text NOT NULL,
  `name_m_kn` text NOT NULL,
  `email` text NOT NULL,
  `position` text NOT NULL,
  `address` text NOT NULL,
  `tel` text NOT NULL,
  `birthday` date NOT NULL,
  `gender` text NOT NULL,
  `joincom` date NOT NULL,
  `department` text NOT NULL,
  `comment` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`id`, `member_id`, `name_s`, `name_m`, `name_s_kn`, `name_m_kn`, `email`, `position`, `address`, `tel`, `birthday`, `gender`, `joincom`, `department`, `comment`, `flag`) VALUES
(1, '', '', '', '', '', '', '', '', '', '0000-00-00', '女性', '0000-00-00', '', '', 0),
(2, '24064', '森', '春稀', 'モリ', 'ハルキ', 'memomemo@co.jp', '代表取締役', '千葉県某所', '08000008800', '2004-03-06', '男性', '2024-04-10', 'コンピ', '実に順調', 1),
(3, '845687169', '宮本', 'るり', 'ミヤモト', 'ルリ', 'sagagsa@gagags.com', '', '鬼が島', '741963852', '2024-06-20', '女性', '2024-06-14', '営業本部', '※推しキャラの名前です', 1),
(4, '21551', '髑髏林', '禿鷹丸', 'ドクロバヤシ', 'ハゲタカマル', 'wdfghj@nsu.gu', '', '恐山', '7894561230', '2024-06-22', '男性', '2024-06-12', 'コンピ', '', 0),
(5, '1235469', '山本', '元柳斎重國', 'ヤマモト', 'ゲンリュウサイシゲクニ', 'xfgcbhnjmk@dfgh.o', '護廷十三隊総隊長', '尸魂界', '89456965', '2024-05-30', '男性', '2024-06-11', '一番隊', '万象一切灰燼と為せ、流刃若火！', 1),
(6, '745122', '濱野', '奈の羽', 'はまの', 'なのは', 'fvbnm@hmn.v', '専務', '埼玉', '8520745', '2024-06-27', '女性', '2024-06-05', 'コンピ', '', 0),
(7, '80980808', '杉本', '高文', 'すぎもと', 'たかふみ', 'fgbhnrtghy@fgh', '大御所', '東京', '85429685', '2024-06-19', '男性', '2024-06-10', 'ｄｆｇｈｋ', '', 0),
(8, 'ボボボーボ・ボーボボ', 'ds', 'ds', 'hjhb', 'hbhnb', 'hnn@a', 'nj', 'hnjj', 'jj', '2024-06-25', '男性', '2024-06-26', 'jkjm', '', 0),
(9, '3', '早川', 'アキ', 'ハヤカワ', 'アキ', 'hiuhaihu@ha', 'デビルハンター', '日本', '4582165', '2024-06-11', '男性', '2024-06-10', '公安', 'コン', 1),
(10, 'dfgjkl', 'dfvgbnm', 'fvgbnm', 'fvbnmd', 'dcvbn', 'ffvbgnhm@fgbhnm', 'fgbhn,m', 'fvgbhn,k', '8521000', '0000-00-00', '女性', '0000-00-00', 'dfbghn,m.', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 0),
(11, '45274518', 'ところ', '天の助', 'トコロ', 'テンノスケ', 'wertyui@nbgfd', '', '佐渡島', '74185296', '0000-00-00', '男性', '2024-06-12', 'グランドクロス', '殺してやるぞ天の助', 1),
(12, '5144948', 'ドンキー', 'コング', 'ドンキー', 'コング', 'uhuh@uh', 'ジャングルの王', 'ドンキーコングアイランド', '282828282', '2024-06-13', '男性', '2024-06-12', 'バナナ工場', '', 1),
(13, '745122', 'ウイルス', 'ミス', 'ウイルス', 'ミス', 'drftghjik@rtyui', '医者', 'カリフォルニア', '9654749', '2024-06-29', '男性', '2024-07-04', '病院', '', 1),
(14, '855544', '衛宮', '士郎', 'エミヤ', 'シロウ', 'ubw@dbs', '正義の味方', '冬木', '5485587', '2024-06-19', '男性', '2024-06-19', 'ガイア', 'I am the born of my sord.', 1),
(15, '114514', '田所', '浩二', 'タドコロ', 'コウジ', '810@inm', '学生', '下北沢', '810114514', '2024-06-26', '男性', '2024-06-10', '無所属', '', 0),
(16, '74578', '已己巳己', '巴', 'イコミキ', 'ドモエ', 'tyuiop@rtyuio', '虚', '空座町', '74252', '2024-06-13', 'その他', '2024-06-17', '虚圏', '', 1),
(17, '789121255', '田代', 'まさし', 'タシロ', 'マサシ', 'fvhjkl@kjhvc', '歌手', '日本', '852955', '2024-06-21', '男性', '2024-06-12', '拘留所', '塩酸シメジヒラメ出目金\r\n塩酸シメジヒラメ出目金\r\n田代！田代！', 1),
(18, '894398', 'マルフォイ', 'ドラコ', 'マルフォイ', 'ドラコ', 'mrkaitefoi@aaa', '闇払い', 'ホグワーツ', '91454701475', '2024-06-29', '男性', '2024-06-10', '魔法省', 'まーるかいてふぉい', 1),
(19, '5826950006', '中村', '悠一', 'ナカムラ', 'ユウイチ', 'siky@s', '声優', '杉田智和宅', '59216945', '2024-06-07', '男性', '2024-06-11', 'インテンション', '', 0),
(20, '8528521', '八満', '結', 'ハチミツ', 'ユイ', '83@1', '学生', '日本', '8956985', '2015-01-12', '女性', '2024-06-12', '高校', '', 1),
(21, '1111111', '後藤', 'ひとり', 'ゴトウ', 'ヒトリ', 'bocchi@rock', 'ギター', '下北沢', '8541854154', '2024-06-19', '女性', '2024-06-12', '結束バンド', '社会が怖い！', 1),
(22, '598568942', '衛宮', '切嗣', 'エミヤ', 'キリツグ', 'bsaiga@fa', '魔術師殺し', '冬木', '841294616', '1960-05-12', '男性', '2024-06-12', '正義の味方', '', 1),
(23, '1111111', '後藤', 'ふたり', 'ゴトウ', 'フタリ', 'memomemo@co.jp', '妹', '下北沢', '080-6060-2205', '2024-04-17', '女性', '2024-06-20', '下北沢', 'おねえちゃん誰も友達いないもんね！', 1),
(24, '184184', 'ダヴィンチ', 'レオナルド', 'ダヴィンチ', 'レオナルド', 'dvnc@aa', '芸術家', 'ヨーロッパ', '5848946', '2024-06-13', '男性', '2024-06-13', '学術部', '', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`id`, `name`, `pass`) VALUES
(1, 'testid', 'testpass'),
(2, 'admin', 'admin');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
