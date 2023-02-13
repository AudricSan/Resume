-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'Education'
-- ---

DROP TABLE IF EXISTS `Education`;
		
CREATE TABLE `Education` (
  `Education_ID` tinyint  AUTO_INCREMENT,
  `Education_Name` varchar(255) ,
  `Education_Start` datetime ,
  `Education_End` datetime ,
  `Education_School` tinyint ,
  `Education_Level` tinyint ,
  PRIMARY KEY (`Education_ID`)
);

-- ---
-- Table 'School'
-- ---

DROP TABLE IF EXISTS `School`;
		
CREATE TABLE `School` (
  `School_ID` tinyint AUTO_INCREMENT,
  `School_Name` char(255),
  `School_City` tinyint,
  PRIMARY KEY (`School_ID`)
);

-- ---
-- Table 'City'
-- ---

DROP TABLE IF EXISTS `City`;
		
CREATE TABLE `City` (
  `City_ID` tinyint  AUTO_INCREMENT,
  `City_Name` varchar(190) ,
  `City_Zip` int(18) ,
  `City_Country` tinyint ,
  PRIMARY KEY (`City_ID`)
);

-- ---
-- Table 'Language'
-- ---

DROP TABLE IF EXISTS `Language`;
		
CREATE TABLE `Language` (
  `Language_ID` tinyint  AUTO_INCREMENT,
  `Language_Name` varchar(30) ,
  `Language_Tag` varchar(10) ,
  `Language_LanguageLevel` tinyint ,
  PRIMARY KEY (`Language_ID`)
);

-- ---
-- Table 'EducationLevel'
-- ---

DROP TABLE IF EXISTS `EducationLevel`;
		
CREATE TABLE `EducationLevel` (
  `EducationLevel_Id` tinyint  AUTO_INCREMENT,
  `EducationLevel_Name` varchar(60) ,
  PRIMARY KEY (`EducationLevel_Id`)
);

-- ---
-- Table 'LanguageLevel'
-- ---

DROP TABLE IF EXISTS `LanguageLevel`;
		
CREATE TABLE `LanguageLevel` (
  `LanguageLevel_ID` tinyint  AUTO_INCREMENT,
  `LanguageLevel_Name` varchar(20) ,
  PRIMARY KEY (`LanguageLevel_ID`)
);

-- ---
-- Table 'Country'
-- ---

DROP TABLE IF EXISTS `Country`;
		
CREATE TABLE `Country` (
  `Country_ID` tinyint  AUTO_INCREMENT,
  `Country_Name` varchar(90) ,
  PRIMARY KEY (`Country_ID`)
);

-- ---
-- Table 'Admin'
-- ---

DROP TABLE IF EXISTS `Admin`;
		
CREATE TABLE `Admin` (
  `Admin_ID` tinyint  AUTO_INCREMENT,
  `Admin_Name` varchar(60) ,
  `Admin_Email` varchar(254) ,
  `Admin_Password` varchar(80) ,
  PRIMARY KEY (`Admin_ID`)
);

-- ---
-- Table 'WorkExperience'
-- ---

DROP TABLE IF EXISTS `WorkExperience`;
		
CREATE TABLE `WorkExperience` (
  `WorkExperience_ID` tinyint  AUTO_INCREMENT,
  `WorkExperience_Name` varchar(255) ,
  `WorkExperience_Description` varchar(255) ,
  `WorkExperience_Icon` varchar(255)  DEFAULT '/public/image/icon/000.png',
  `WorkExperience_City` tinyint ,
  PRIMARY KEY (`WorkExperience_ID`)
);

-- ---
-- Table 'Technology'
-- ---

DROP TABLE IF EXISTS `Technology`;
		
CREATE TABLE `Technology` (
  `Technology_ID` tinyint  AUTO_INCREMENT,
  `Technology_Name` varchar(255) ,
  `Technology_Description` varchar(255) ,
  `Technology_Icon` varchar(255)  DEFAULT '/public/image/icon/000.png',
  `Technology_Level` tinyint ,
  PRIMARY KEY (`Technology_ID`)
);

-- ---
-- Table 'Project'
-- ---

DROP TABLE IF EXISTS `Project`;
		
CREATE TABLE `Project` (
  `Project_ID` tinyint  AUTO_INCREMENT,
  `Project_Name` varchar(255) ,
  `Project_Link` varchar(255) ,
  `Project_Description` varchar(255) ,
  `Project_Icon` varchar(255)  DEFAULT '/public/image/icon/000.png',
  PRIMARY KEY (`Project_ID`)
);

-- ---
-- Table 'PointOfInterest'
-- ---

DROP TABLE IF EXISTS `PointOfInterest`;
		
CREATE TABLE `PointOfInterest` (
  `PointOfInterest_ID` tinyint  AUTO_INCREMENT,
  `PointOfInterest_Name` varchar(60) ,
  `PointOfInterest_Icon` varchar(255)  DEFAULT '/public/image/icon/000.png',
  PRIMARY KEY (`PointOfInterest_ID`)
);

-- ---
-- Table 'Level'
-- ---

DROP TABLE IF EXISTS `Level`;
		
CREATE TABLE `Level` (
  `Level_Id` tinyint  AUTO_INCREMENT,
  `Level_Name` varchar(30) ,
  PRIMARY KEY (`Level_Id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `Education` ADD FOREIGN KEY (Education_School) REFERENCES `School` (`School_ID`);
ALTER TABLE `Education` ADD FOREIGN KEY (Education_Level) REFERENCES `EducationLevel` (`EducationLevel_Id`);
ALTER TABLE `School` ADD FOREIGN KEY (School_City) REFERENCES `City` (`City_ID`);
ALTER TABLE `City` ADD FOREIGN KEY (City_Country) REFERENCES `Country` (`Country_ID`);
ALTER TABLE `Language` ADD FOREIGN KEY (Language_LanguageLevel) REFERENCES `LanguageLevel` (`LanguageLevel_ID`);
ALTER TABLE `WorkExperience` ADD FOREIGN KEY (WorkExperience_City) REFERENCES `City` (`City_ID`);
ALTER TABLE `Technology` ADD FOREIGN KEY (Technology_Level) REFERENCES `Level` (`Level_Id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `Education` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `School` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `City` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Language` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `EducationLevel` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `LanguageLevel` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Country` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Admin` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `WorkExperience` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Technology` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Project` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `PointOfInterest` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `Level` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `Education` (`Education_ID`,`Education_Name`,`Education_Start`,`Education_End`,`Education_School`,`Education_Level`) VALUES
-- ('','','','','','');
-- INSERT INTO `School` (`School_ID`,`School_Name`,`School_City`) VALUES
-- ('','','');
-- INSERT INTO `City` (`City_ID`,`City_Name`,`City_Zip`,`City_Country`) VALUES
-- ('','','','');
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
-- INSERT INTO `WorkExperience` (`WorkExperience_ID`,`WorkExperience_Name`,`WorkExperience_Description`,`WorkExperience_Icon`,`WorkExperience_City`) VALUES
-- ('','','','','');
-- INSERT INTO `Technology` (`Technology_ID`,`Technology_Name`,`Technology_Description`,`Technology_Icon`,`Technology_Level`) VALUES
-- ('','','','','');
-- INSERT INTO `Project` (`Project_ID`,`Project_Name`,`Project_Link`,`Project_Description`,`Project_Icon`) VALUES
-- ('','','','','');
-- INSERT INTO `PointOfInterest` (`PointOfInterest_ID`,`PointOfInterest_Name`,`PointOfInterest_Icon`) VALUES
-- ('','','');
-- INSERT INTO `Level` (`Level_Id`,`Level_Name`) VALUES
-- ('','');