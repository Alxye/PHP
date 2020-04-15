-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-04-14 08:17:09
-- 服务器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `course_system`
--

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(8) NOT NULL COMMENT '课程编号',
  `course_name` varchar(10) CHARACTER SET gbk COLLATE gbk_bin NOT NULL COMMENT '课程名称',
  `course_teacher` varchar(10) CHARACTER SET gbk COLLATE gbk_bin NOT NULL COMMENT '任课教师',
  `course_time` varchar(20) CHARACTER SET gbk COLLATE gbk_bin NOT NULL COMMENT '上课时间',
  `course_venue` varchar(20) CHARACTER SET gbk COLLATE gbk_bin NOT NULL COMMENT '上课地点',
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_teacher`, `course_time`, `course_venue`) VALUES
(1001, '高等数学', '陈老师', '周一3，4，5', '六教北101'),
(1002, '大学英语', '张老师', '周一4，5', '六教北102'),
(1003, '大学体育', '徐老师', '周四3，4', '西北田径场'),
(1005, 'C语言程序设计', '梁老师', '周二6，7，8', '六教北105');

-- --------------------------------------------------------

--
-- 表的结构 `select_course`
--

DROP TABLE IF EXISTS `select_course`;
CREATE TABLE IF NOT EXISTS `select_course` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  KEY `course_id` (`course_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `select_course`
--

INSERT INTO `select_course` (`id`, `course_id`) VALUES
(10, 1003),
(1, 1002),
(2, 1001),
(8, 1005),
(8, 1002),
(10, 1002),
(10, 1005),
(10, 1001),
(8, 1001);

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(8) NOT NULL COMMENT '八位学号',
  `student_name` varchar(10) CHARACTER SET gbk COLLATE gbk_bin NOT NULL COMMENT '姓名',
  `student_age` int(3) NOT NULL COMMENT '年龄',
  `address` varchar(20) CHARACTER SET gbk COLLATE gbk_bin NOT NULL COMMENT '住址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`id`, `student_id`, `student_name`, `student_age`, `address`) VALUES
(1, 16998554, '张三', 18, 'ZXC'),
(2, 18861001, '李四', 55, 'ZZZ'),
(8, 18220255, '梁艺', 19, 'LKS'),
(10, 18131001, '李浅', 18, 'ZZZ'),
(11, 18102232, '赵敏', 20, 'XXX'),
(12, 17152311, '许今', 19, 'CCC'),
(16, 18220974, '梁艺', 19, 'LKS');

--
-- 限制导出的表
--

--
-- 限制表 `select_course`
--
ALTER TABLE `select_course`
  ADD CONSTRAINT `select_course_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `select_course_ibfk_2` FOREIGN KEY (`id`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
