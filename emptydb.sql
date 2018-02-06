
CREATE TABLE `admin` (
  `aid` int(25) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `password` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`aid`),
  KEY `aid` (`aid`)
) TYPE=MyISAM;

CREATE TABLE `movies` (
  `id` int(11) NOT NULL auto_increment,
  `cat_id` int(11) NOT NULL default '0',
  `views` int(11) NOT NULL default '0',
  `pic` varchar(250) NOT NULL default '',
  `title` varchar(250) NOT NULL default '',
  `url` text NOT NULL,
  `date` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE `cat` (
  `id` int(11) NOT NULL auto_increment,
  `title` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;


INSERT INTO `admin` VALUES ('', 'admin', '947858500885d97781ed709cd7b88430');
        