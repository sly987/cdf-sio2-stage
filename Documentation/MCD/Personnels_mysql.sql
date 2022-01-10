CREATE DATABASE IF NOT EXISTS `PERSONNELS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `PERSONNELS`;

/*
CREATE TABLE `ANNÉE` (
  `annéesid` VARCHAR(42),
  PRIMARY KEY (`annéesid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

CREATE TABLE `ÊTREACTIF` (
  `annéesid` VARCHAR(42),
  `moisid` VARCHAR(42),
  `persosid` VARCHAR(42),
  PRIMARY KEY (`annéesid`, `moisid`, `persosid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `PERSONNEL` (
  `persosid` VARCHAR(42),
  `mail` VARCHAR(42),
  `mdp` VARCHAR(42),
  `nom` VARCHAR(42),
  `prénom` VARCHAR(42),
  `admin(o/n)` VARCHAR(42),
  PRIMARY KEY (`persosid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `EXERCER` (
  `persosid` VARCHAR(42),
  `statutsid` VARCHAR(42),
  PRIMARY KEY (`persosid`, `statutsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `STATUT` (
  `statutsid` VARCHAR(42),
  `libellé` VARCHAR(42),
  PRIMARY KEY (`statutsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `MOIS` (
  `annéesid` VARCHAR(42),
  `moisid` VARCHAR(42),
  PRIMARY KEY (`annéesid`, `moisid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `NOTIFIER` (
  `notificationsid` VARCHAR(42),
  `persosid` VARCHAR(42),
  PRIMARY KEY (`notificationsid`, `persosid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `NOTIFICATION` (
  `notificationsid` VARCHAR(42),
  `contenu` VARCHAR(42),
  `intervalle` VARCHAR(42),
  PRIMARY KEY (`notificationsid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ENVOYÉ` (
  `envoyésid` VARCHAR(42),
  `pdf` VARCHAR(42),
  `persosid` VARCHAR(42),
  `annéesid` VARCHAR(42),
  `moisid` VARCHAR(42),
  PRIMARY KEY (`envoyésid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `CONFIRMÉ` (
  `confirmésid` VARCHAR(42),
  `envoyésid` VARCHAR(42),
  PRIMARY KEY (`confirmésid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `ÊTREACTIF` ADD FOREIGN KEY (`persosid`) REFERENCES `PERSONNEL` (`persosid`);
ALTER TABLE `ÊTREACTIF` ADD FOREIGN KEY (`annéesid`, `moisid`) REFERENCES `MOIS` (`annéesid`, `moisid`);
ALTER TABLE `EXERCER` ADD FOREIGN KEY (`statutsid`) REFERENCES `STATUT` (`statutsid`);
ALTER TABLE `EXERCER` ADD FOREIGN KEY (`persosid`) REFERENCES `PERSONNEL` (`persosid`);
-- ALTER TABLE `MOIS` ADD FOREIGN KEY (`annéesid`) REFERENCES `ANNÉE` (`annéesid`);
ALTER TABLE `NOTIFIER` ADD FOREIGN KEY (`persosid`) REFERENCES `PERSONNEL` (`persosid`);
ALTER TABLE `NOTIFIER` ADD FOREIGN KEY (`notificationsid`) REFERENCES `NOTIFICATION` (`notificationsid`);
ALTER TABLE `ENVOYÉ` ADD FOREIGN KEY (`annéesid`, `moisid`) REFERENCES `MOIS` (`annéesid`, `moisid`);
ALTER TABLE `ENVOYÉ` ADD FOREIGN KEY (`persosid`) REFERENCES `PERSONNEL` (`persosid`);
ALTER TABLE `CONFIRMÉ` ADD FOREIGN KEY (`envoyésid`) REFERENCES `ENVOYÉ` (`envoyésid`);