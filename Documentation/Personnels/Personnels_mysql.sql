CREATE DATABASE IF NOT EXISTS `PERSONNELS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `PERSONNELS`;

CREATE TABLE `NOTIFIER` (
  `notification_id` VARCHAR(42),
  `document_id` VARCHAR(42),
  PRIMARY KEY (`notification_id`, `document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `DOCUMENTS` (
  `document_id` VARCHAR(42),
  `pdf` VARCHAR(42),
  `envoyé(o/n)` VARCHAR(42),
  `user_id` VARCHAR(42),
  `année_id` VARCHAR(42),
  `mois_id` VARCHAR(42),
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `STATUTS` (
  `statut_id` VARCHAR(42),
  `libellé` VARCHAR(42),
  PRIMARY KEY (`statut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `NOTIFICATIONS` (
  `notification_id` VARCHAR(42),
  `contenu` VARCHAR(42),
  `intervalle` VARCHAR(42),
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `USERS` (
  `user_id` VARCHAR(42),
  `mail` VARCHAR(42),
  `mdp` VARCHAR(42),
  `nom` VARCHAR(42),
  `prénom` VARCHAR(42),
  `admin(o/n)` VARCHAR(42),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `EXERCER` (
  `user_id` VARCHAR(42),
  `statut_id` VARCHAR(42),
  PRIMARY KEY (`user_id`, `statut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
CREATE TABLE `ANNÉES` (
  `année_id` VARCHAR(42),
  PRIMARY KEY (`année_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

CREATE TABLE `MOIS` (
  `année_id` VARCHAR(42),
  `mois_id` VARCHAR(42),
  PRIMARY KEY (`année_id`, `mois_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ÊTREACTIF` (
  `année_id` VARCHAR(42),
  `mois_id` VARCHAR(42),
  `user_id` VARCHAR(42),
  PRIMARY KEY (`année_id`, `mois_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `NOTIFIER` ADD FOREIGN KEY (`document_id`) REFERENCES `DOCUMENTS` (`document_id`);
ALTER TABLE `NOTIFIER` ADD FOREIGN KEY (`notification_id`) REFERENCES `NOTIFICATIONS` (`notification_id`);
ALTER TABLE `DOCUMENTS` ADD FOREIGN KEY (`année_id`, `mois_id`) REFERENCES `MOIS` (`année_id`, `mois_id`);
ALTER TABLE `DOCUMENTS` ADD FOREIGN KEY (`user_id`) REFERENCES `USERS` (`user_id`);
ALTER TABLE `EXERCER` ADD FOREIGN KEY (`statut_id`) REFERENCES `STATUTS` (`statut_id`);
ALTER TABLE `EXERCER` ADD FOREIGN KEY (`user_id`) REFERENCES `USERS` (`user_id`);
-- ALTER TABLE `MOIS` ADD FOREIGN KEY (`année_id`) REFERENCES `ANNÉES` (`année_id`);
ALTER TABLE `ÊTREACTIF` ADD FOREIGN KEY (`user_id`) REFERENCES `USERS` (`user_id`);
ALTER TABLE `ÊTREACTIF` ADD FOREIGN KEY (`année_id`, `mois_id`) REFERENCES `MOIS` (`année_id`, `mois_id`);