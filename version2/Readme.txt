
# Copy paste this into the sql

CREATE TABLE IF NOT EXISTS `Groups` (
	`GroupID` INT NOT NULL AUTO_INCREMENT,
	`Name` VARCHAR(50) NOT NULL,
	`Color` VARCHAR(10) NOT NULL,
	`Weight` INT,
    PRIMARY KEY (`GroupID`)
);

INSERT INTO `Groups`(`Name`, `Weight`, `Color`) VALUES ('Default',1, 'black');
INSERT INTO `Groups`(`Name`, `Weight`, `Color`) VALUES ('Owner',10, 'red');
INSERT INTO `Groups`(`Name`, `Weight`, `Color`) VALUES ('Supporter',50, 'yellow');
INSERT INTO `Groups`(`Name`, `Weight`, `Color`) VALUES ('Nobody',100, 'gray');

CREATE TABLE IF NOT EXISTS `Members` (
    `MemberID` INT NOT NULL AUTO_INCREMENT,
    `DiscordID` VARCHAR(50),
    `Username` VARCHAR(50),
    `Displayname` VARCHAR(50),
    `Avatar` VARCHAR(50),
    `GroupID` INT,
    `Deleted` BOOLEAN,
    PRIMARY KEY (`MemberID`),
    FOREIGN KEY (`GroupID`) REFERENCES `Groups`(`GroupID`)
);

CREATE TABLE IF NOT EXISTS `Accounts` (
    `UserID` INT NOT NULL AUTO_INCREMENT,
    `Username` VARCHAR(50) NOT NULL,
    `Password` VARCHAR(50) NOT NULL,
    `UserGroup` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`UserID`)
);

CREATE TABLE IF NOT EXISTS `user_failed_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ip_address` int(11) unsigned DEFAULT NULL,
  `attempted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

# --------------------------------------------------------------------------------------------

// You must install restcord for Discord
// https://github.com/restcord/restcord

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

php composer-setup.php --install-dir=. --filename=composer

./composer require restcord/restcord