-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'Education'
-- 
-- ---

DROP TABLE IF EXISTS `Education`;
		
CREATE TABLE `Education` (
  `Education_ID` tinyint NOT NULL AUTO_INCREMENT,
  `Education_Name` varchar(255) NOT NULL,
  `Education_Start` datetime NOT NULL,
  `Education_End` datetime NOT NULL,
  `Education_School` tinyint NOT NULL,
  `Education_Level` tinyint NOT NULL,
  PRIMARY KEY (`Education_ID`)
);

-- ---
-- Table 'School'
-- 
-- ---

DROP TABLE IF EXISTS `School`;
		
CREATE TABLE `School` (
  `School_ID` tinyint NOT NULL AUTO_INCREMENT,
  `School_Name` char(255) NOT NULL,
  `School_City` tinyint NOT NULL,
  PRIMARY KEY (`School_ID`)
);

-- ---
-- Table 'Cities'
-- 
-- ---

DROP TABLE IF EXISTS `Cities`;
		
CREATE TABLE `Cities` (
  `Cities_id` tinyint NOT NULL AUTO_INCREMENT,
  `Cities_name` varchar(255) NULL DEFAULT NULL,
  `Cities_Country` varchar(5) NULL DEFAULT NULL,
  PRIMARY KEY (`Cities_id`)
);

-- ---
-- Table 'Language'
-- 
-- ---

DROP TABLE IF EXISTS `Language`;
		
CREATE TABLE `Language` (
  `Language_ID` tinyint NOT NULL AUTO_INCREMENT,
  `Language_Name` varchar(30) NOT NULL,
  `Language_Tag` varchar(10) NOT NULL,
  `Language_LanguageLevel` tinyint NOT NULL,
  PRIMARY KEY (`Language_ID`)
);

-- ---
-- Table 'EducationLevel'
-- 
-- ---

DROP TABLE IF EXISTS `EducationLevel`;
		
CREATE TABLE `EducationLevel` (
  `EducationLevel_Id` tinyint NOT NULL AUTO_INCREMENT,
  `EducationLevel_Name` varchar(60) NOT NULL,
  PRIMARY KEY (`EducationLevel_Id`)
);

-- ---
-- Table 'LanguageLevel'
-- 
-- ---

DROP TABLE IF EXISTS `LanguageLevel`;
		
CREATE TABLE `LanguageLevel` (
  `LanguageLevel_ID` tinyint NOT NULL AUTO_INCREMENT,
  `LanguageLevel_Name` varchar(20) NOT NULL,
  PRIMARY KEY (`LanguageLevel_ID`)
);

-- ---
-- Table 'Country'
-- 
-- ---

DROP TABLE IF EXISTS `Country`;
		
CREATE TABLE `Country` (
  `Country_ID` varchar(64) NOT NULL AUTO_INCREMENT,
  `Country_Name` varchar(60) NULL DEFAULT NULL,
  PRIMARY KEY (`Country_ID`)
);

-- ---
-- Table 'Admin'
-- 
-- ---

DROP TABLE IF EXISTS `Admin`;
		
CREATE TABLE `Admin` (
  `Admin_ID` tinyint NOT NULL AUTO_INCREMENT,
  `Admin_Name` varchar(60) NOT NULL,
  `Admin_Email` varchar(254) NOT NULL,
  `Admin_Password` varchar(80) NOT NULL,
  PRIMARY KEY (`Admin_ID`)
);

-- ---
-- Table 'WorkExperience'
-- 
-- ---

DROP TABLE IF EXISTS `WorkExperience`;
		
CREATE TABLE `WorkExperience` (
  `WorkExperience_ID` tinyint NOT NULL AUTO_INCREMENT,
  `WorkExperience_Name` varchar(255) NOT NULL,
  `WorkExperience_Description` varchar(255) NOT NULL,
  `WorkExperience_Icon` varchar(255) NOT NULL DEFAULT '/public/image/icon/000.png',
  `WorkExperience_City` tinyint NOT NULL,
  `WorkExperience_Start` datetime NOT NULL,
  `WorkExperience_End` datetime NOT NULL,
  PRIMARY KEY (`WorkExperience_ID`)
);

-- ---
-- Table 'Technologies'
-- 
-- ---

DROP TABLE IF EXISTS `Technologies`;
		
CREATE TABLE `Technologies` (
  `technologies_ID` tinyint NOT NULL AUTO_INCREMENT,
  `technologies_Name` varchar(255) NOT NULL,
  `technologies_Description` varchar(255) NOT NULL,
  `technologies_Icon` varchar(255) NOT NULL DEFAULT '/public/image/icon/000.png',
  `technologies_Level` tinyint NOT NULL,
  PRIMARY KEY (`technologies_ID`)
);

-- ---
-- Table 'Project'
-- 
-- ---

DROP TABLE IF EXISTS `Project`;
		
CREATE TABLE `Project` (
  `Project_ID` tinyint NOT NULL AUTO_INCREMENT,
  `Project_Name` varchar(255) NOT NULL,
  `Project_Link` varchar(255) NOT NULL,
  `Project_Description` varchar(255) NOT NULL,
  `Project_Icon` varchar(255) NOT NULL DEFAULT '/public/image/icon/000.png',
  PRIMARY KEY (`Project_ID`)
);

-- ---
-- Table 'PointOfInterest'
-- 
-- ---

DROP TABLE IF EXISTS `PointOfInterest`;
		
CREATE TABLE `PointOfInterest` (
  `PointOfInterest_ID` tinyint NOT NULL AUTO_INCREMENT,
  `PointOfInterest_Name` varchar(60) NOT NULL,
  `PointOfInterest_Icon` varchar(255) NOT NULL DEFAULT '/public/image/icon/000.png',
  PRIMARY KEY (`PointOfInterest_ID`)
);

-- ---
-- Table 'TechnologyLevel'
-- 
-- ---

DROP TABLE IF EXISTS `TechnologyLevel`;
		
CREATE TABLE `TechnologyLevel` (
  `TechnologyLevel_Id` tinyint NOT NULL AUTO_INCREMENT,
  `Level_Name` varchar(30) NOT NULL,
  PRIMARY KEY (`TechnologyLevel_Id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `Education` ADD FOREIGN KEY (Education_School) REFERENCES `School` (`School_ID`);
ALTER TABLE `Education` ADD FOREIGN KEY (Education_Level) REFERENCES `EducationLevel` (`EducationLevel_Id`);
ALTER TABLE `School` ADD FOREIGN KEY (School_City) REFERENCES `Cities` (`Cities_id`);
ALTER TABLE `Cities` ADD FOREIGN KEY (Cities_Country) REFERENCES `Country` (`Country_ID`);
ALTER TABLE `Language` ADD FOREIGN KEY (Language_LanguageLevel) REFERENCES `LanguageLevel` (`LanguageLevel_ID`);
ALTER TABLE `WorkExperience` ADD FOREIGN KEY (WorkExperience_City) REFERENCES `Cities` (`Cities_id`);
ALTER TABLE `Technologies` ADD FOREIGN KEY (technologies_Level) REFERENCES `TechnologyLevel` (`TechnologyLevel_Id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `Education` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `School` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Cities` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Language` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `EducationLevel` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `LanguageLevel` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Country` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Admin` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `WorkExperience` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Technologies` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Project` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `PointOfInterest` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `TechnologyLevel` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `Education` (`Education_ID`,`Education_Name`,`Education_Start`,`Education_End`,`Education_School`,`Education_Level`) VALUES
-- ('','','','','','');
-- INSERT INTO `School` (`School_ID`,`School_Name`,`School_City`) VALUES
-- ('','','');
-- INSERT INTO `Cities` (`Cities_id`,`Cities_name`,`Cities_Country`) VALUES
-- ('','','');
-- INSERT INTO `Language` (`Language_ID`,`Language_Name`,`Language_Tag`,`Language_LanguageLevel`) VALUES
-- ('','','','');
-- INSERT INTO `EducationLevel` (`EducationLevel_Id`,`EducationLevel_Name`) VALUES
-- ('','');
-- INSERT INTO `LanguageLevel` (`LanguageLevel_ID`,`LanguageLevel_Name`) VALUES
-- ('','');
-- INSERT INTO `Country` (`Country_ID`,`Country_Name`) VALUES
-- ('','');
-- INSERT INTO `Admin` (`Admin_ID`,`Admin_Name`,`Admin_Email`,`Admin_Password`) VALUES
-- ('','','','');
-- INSERT INTO `WorkExperience` (`WorkExperience_ID`,`WorkExperience_Name`,`WorkExperience_Description`,`WorkExperience_Icon`,`WorkExperience_City`,`WorkExperience_Start`,`WorkExperience_End`) VALUES
-- ('','','','','','','');
-- INSERT INTO `Technologies` (`technologies_ID`,`technologies_Name`,`technologies_Description`,`technologies_Icon`,`technologies_Level`) VALUES
-- ('','','','','');
-- INSERT INTO `Project` (`Project_ID`,`Project_Name`,`Project_Link`,`Project_Description`,`Project_Icon`) VALUES
-- ('','','','','');
-- INSERT INTO `PointOfInterest` (`PointOfInterest_ID`,`PointOfInterest_Name`,`PointOfInterest_Icon`) VALUES
-- ('','','');
-- INSERT INTO `TechnologyLevel` (`TechnologyLevel_Id`,`Level_Name`) VALUES
-- ('','');