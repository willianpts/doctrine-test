Doctrine 2.4.6 update problem
-----------

Maybe I have stumbled into a strange problem.
This repo may be used to reproduce it.

#### Database setup
Please insert your connection settings at [em.php](em.php) then create the tables:
```sql
USE test;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `orgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `empresa_id` (`empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` VALUES (1,'One'),(2,'Two');
INSERT INTO `orgs` VALUES (1,1,'Company 1');
INSERT INTO `admins` VALUES (1,1,1,'2014-10-01 00:00:00'),(2,1,2,'2014-10-23 00:00:00');
```

#### Running

```
composer install
php index.php
```
After running index.php you'll see that Doctrine hasnt updated the database records.

Now if we comment line 56 of [Organization.php](src/Entities/Organization.php) the UPDATE executes correctly.

