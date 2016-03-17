-- Creates database
CREATE DATABASE IF NOT EXISTS budhi;

-- creating tables for HitCount
DROP TABLE IF EXISTS budhi.hits;
CREATE TABLE budhi.hits (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  origem varchar(50) NOT NULL,
  destino varchar(50) NOT NULL,
  count bigint(20) NOT NULL DEFAULT '0',
  created_at datetime NOT NULL,
  updated_at datetime NOT NULL,
  PRIMARY KEY (`id`)
);
