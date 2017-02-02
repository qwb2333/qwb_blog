-- phpMyAdmin SQL Dump
-- version 4.0.10.11
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2017-02-01 21:50:19
-- 服务器版本: 5.1.56-community-log
-- PHP 版本: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `qwb`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_article_content`
--

CREATE TABLE IF NOT EXISTS `blog_article_content` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `md` text NOT NULL,
  `text` text NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `blog_article_content`
--

INSERT INTO `blog_article_content` (`pid`, `title`, `md`, `text`, `tag`) VALUES
(5, 'markdown编辑器功能演示', '首先，这是一款经典的markdown编辑器：\n \n- **功能丰富** ：支持高亮代码块、*LaTeX* 公式、流程图，本地图片等，是工作学习好帮手；\n- **得心应手** ：简洁高效的编辑器，支持移动端 Web；\n- **深度整合** ：支持markdown常用功能，并提供了一些新的但是很有用的小功能。\n\n-------------------\n\n[TOC]\n\n## Markdown简介\n\n> Markdown 是一种轻量级标记语言，它允许人们使用易读易写的纯文本格式编写文档，然后转换成格式丰富的HTML页面。    —— [维基百科](https://zh.wikipedia.org/wiki/Markdown)\n\n正如您在阅读的这份文档，它使用简单的符号标识不同的标题，将某些文字标记为**粗体**或者*斜体*，创建一个[链接](http://www.example.com)。下面列举了几个高级功能，更多语法请按`Ctrl + /`查看帮助\n\n### 代码块\n``` python\n@requires_authorization\ndef somefunc(param1='''', param2=0):\n    ''''''A docstring''''''\n    if param1 > param2: # interesting\n        print ''Greater''\n    return (param2 - param1 + 1) or None\nclass SomeClass:\n    pass\n>>> message = ''''''interpreter\n... prompt''''''\n```\n### LaTeX 公式\n可以创建行内公式，例如 $$\\gamma(n) = (n - 1)!\\quad\\forall n\\in Z$$。\n\n### 表格\n| Item      |    Value | Qty  |\n| :-------- | --------:| :--: |\n| Computer  | 1600 USD |  5   |\n| Phone     |   12 USD |  12  |\n| Pipe      |    1 USD | 234  |\n\n### 流程图\n```flow\nst=>start: Start\ne=>end\nop=>operation: My Operation\ncond=>condition: Yes or No?\n\nst->op->cond\ncond(yes)->e\ncond(no)->op\n```\n\n以及时序图:\n\n```sequence\nAlice->Bob: Hello Bob, how are you?\nNote right of Bob: Bob thinks\nBob-->Alice: I am good thanks!\n```\n\n> **提示：**想了解更多，请查看**流程图**语法以及**时序图**语法。\n\n-------------------\nqwb''blog 在此基础上，提供了一款解决插入图片大小的方案\n通过本地上传图片，通常可能图片会非常的大。\n![](picture.php?scale=1&id=20170201-9epKInZ4C2.jpg)\n下面是通过本地上传图片得到的md文本\n```md\n![](picture.php?scale=1&id=20170201-9epKInZ4C2.jpg)\n```\n我们只需要修改scale，就能自由调整缩放大小了，调整`scale = 0.6`后效果如下:\n![](picture.php?scale=0.6&id=20170201-9epKInZ4C2.jpg)', '\n首先，这是一款经典的markdown编辑器：\n\n功能丰富 ：支持高亮代码块、LaTeX 公式、流程图，本地图片等，是工作学习好帮手；\n\n得心应手 ：简洁高效的编辑器，支持移动端 Web；\n\n深度整合 ：支持markdown常用功能，并提供了一些新的但是很有用的小功能。\n\nMarkdown简介\n代码块\n\nLaTeX 公式\n\n表格\n\n流程图\n\n\nMarkdown简介\n\n\nMarkdown 是一种轻量级标记语言，它允许人们使用易读易写的纯文本格式编写文档，然后转换成格式丰富的HTML页面。    —— 维基百科\n\n\n正如您在阅读的这份文档，它使用简单的符号标识不同的标题，将某些文字标记为粗体或者斜体，创建一个链接。下面列举了几个高级功能，更多语法请按\nCtrl + /\n查看帮助\n\n代码块\n\n\n@requires_authorizationdef somefunc(param1='''', param2=0):    ''''''A docstring''''''    if param1 &gt; param2: # interesting        print ''Greater''    return (param2 - param1 + 1) or Noneclass SomeClass:    pass&gt;&gt;&gt; message = ''''''interpreter... prompt''''''\n\n\nLaTeX 公式\n\n可以创建行内公式，例如 γ(n)=(n−1)!∀n∈Z\\gamma(n) = (n - 1)!\\quad\\forall n\\in Zγ(n)=(n−1)!∀n∈Z。\n\n表格\nItemValueQtyComputer1600 USD5Phone12 USD12Pipe1 USD234\n流程图\nCreated with Raphaël 2.1.2StartMy OperationYes or No?Endyesno\n以及时序图:\nCreated with Raphaël 2.1.2AliceAliceBobBobHello Bob, how are you?Bob thinksI am good thanks!\n\n提示：想了解更多，请查看流程图语法以及时序图语法。\n\n\nqwb’blog 在此基础上，提供了一款解决插入图片大小的方案\n通过本地上传图片，通常可能图片会非常的大。\n\n下面是通过本地上传图片得到的md文本\n\n\n![](picture.php?scale=1&amp;id=20170201-9epKInZ4C2.jpg)\n\n\n我们只需要修改scale，就能自由调整缩放大小了，调整\nscale = 0.6\n后效果如下:\n\n', 'markdown');

-- --------------------------------------------------------

--
-- 表的结构 `blog_article_list`
--

CREATE TABLE IF NOT EXISTS `blog_article_list` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `time_tag` varchar(30) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `time_tag` (`time_tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `blog_article_list`
--

INSERT INTO `blog_article_list` (`pid`, `title`, `description`, `tag`, `time`, `time_tag`) VALUES
(5, 'markdown编辑器功能演示', '\n首先，这是一款经典的markdown编辑器：\n\n功能丰富 ：支持高亮代码块、LaTeX 公式、流程图，本地图片等，是工作学习好帮手；\n\n得心应手 ：简洁高效的编辑器，支持移动端 Web；\n\n深度整合 ：支持markdown常用功能，并提供了一些新的但是很有用的小功能。\n\nMarkdown简介\n代码块\n\nLaTeX 公式\n\n表格\n\n流程图\n\n\nMarkdown简介\n\n\nMarkdown 是一种轻量级标记语言，它允许人们使用易读易写的纯文本格式编写文档，然后转换成格式丰富的HTML页面。    —— 维基百科\n\n\n正如您在阅读的这份文档，它使用简单的符号标识不同的标题，将某些文字标记为粗体或者斜体，创建一个链接。下面列举了几个高级功能，更多语法请按\nCtrl + /\n查看帮助\n\n代码块\n\n\n@requires_authorizationdef somefunc(param1='''', param2=0):    ''''''A docstring''''''    if param1 &gt; param2: # interesting        print ''Greater''    return (param2 - p', 'markdown', '2017-02-01 10:02:52', '2017年02月');

-- --------------------------------------------------------

--
-- 表的结构 `blog_tag`
--

CREATE TABLE IF NOT EXISTS `blog_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `blog_tag`
--

INSERT INTO `blog_tag` (`tag_id`, `name`, `pid`) VALUES
(23, 'markdown', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
