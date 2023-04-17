-- MySQL Script generated by MySQL Workbench
-- lun 03 abr 2023 17:31:57 -04
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema elretenciondb
-- -----------------------------------------------------
-- base de datos de registros de retenciones a IVA y ISLR sobre razones sociales
DROP SCHEMA IF EXISTS `elretenciondb` ;

-- -----------------------------------------------------
-- Schema elretenciondb
--
-- base de datos de registros de retenciones a IVA y ISLR sobre razones sociales
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `elretenciondb` DEFAULT CHARACTER SET utf8 ;
USE `elretenciondb` ;

-- -----------------------------------------------------
-- Table `reten_retenciones_registros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reten_retenciones_registros` ;

CREATE TABLE IF NOT EXISTS `reten_retenciones_registros` (
  `cod_retencion` VARCHAR(40) NOT NULL COMMENT 'YYYYMMDDHHMMSS codigo unico de retencion interno',
  `num_comprobante` VARCHAR(40) NOT NULL COMMENT 'YYYYMMDD+NNNNNNNN numero unico desde el seniat',
  `fecha_operacion_retencion` VARCHAR(40) NOT NULL COMMENT 'YYYYMMDD del comprobante despues de declarar',
  `fecha_periodo_fiscal` VARCHAR(40) NULL COMMENT 'YYYYMM de la fecha de la retencion',
  `cod_juridico_retencion` VARCHAR(40) NULL COMMENT 'rif del agente de retencion',
  `cod_juridico_retenido` VARCHAR(40) NULL COMMENT 'rif del agente a retener',
  `sessionflag` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien altero',
  `sessionficha` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien creo',
  PRIMARY KEY (`cod_retencion`))
ENGINE = InnoDB
COMMENT = 'tabla centralizada de registros de retenciones';


-- -----------------------------------------------------
-- Table `reten_facturas_retenciones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reten_facturas_retenciones` ;

CREATE TABLE IF NOT EXISTS `reten_facturas_retenciones` (
  `orden_operacion` VARCHAR(40) NOT NULL COMMENT 'numero de operacion',
  `cod_retencion` VARCHAR(40) NOT NULL COMMENT 'retencion asociada',
  `cod_factura` VARCHAR(40) NOT NULL COMMENT 'fatura asociada a la retencion',
  `sessionflag` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien altero',
  `sessionficha` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien creo',
  PRIMARY KEY (`cod_retencion`, `cod_factura`))
ENGINE = InnoDB
COMMENT = 'cuantas facturas tiene cada retencion';


-- -----------------------------------------------------
-- Table `reten_facturas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reten_facturas` ;

CREATE TABLE IF NOT EXISTS `reten_facturas` (
  `cod_factura` VARCHAR(40) NOT NULL COMMENT 'YYYYMMDD+NNNNNN  fecha_factura + num_factura',
  `num_factura` VARCHAR(40) NULL COMMENT 'numero de la factura',
  `num_control` VARCHAR(40) NOT NULL COMMENT 'numero interno de la facura en el talonario etc',
  `cod_retencion` VARCHAR(40) NULL DEFAULT NULL COMMENT 'solo si aplica en caso de retencion de ISLR, sino null',
  `mon_factura` DECIMAL(40,2) NOT NULL DEFAULT 0.0 COMMENT 'cantida pagada en fatura o total compras',
  `mon_factura_moneda` VARCHAR(40) NOT NULL DEFAULT 'VES' COMMENT 'codigo iso moneda enque esta la factura',
  `mon_objeto_retencion` DECIMAL(40,2) NULL COMMENT 'monto de operacion',
  `num_porcentaje_tasa` SMALLINT NULL DEFAULT 0 COMMENT 'tasa en porcentage retenido en dicho caso',
  `mon_retenido_o_iva` DECIMAL(40,2) NULL DEFAULT 0.0,
  `mon_objeto_retencion_acumulada` DECIMAL(40,2) NULL DEFAULT 0.0 COMMENT 'cantidad de objeto de retencion acumulada',
  `mon_retenido_o_iva_acumulado` DECIMAL(40,2) NULL DEFAULT 0.0,
  `tipo_retencion` VARCHAR(40) NULL COMMENT 'IVA O ISLR',
  `sessionflag` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien altero',
  `sessionficha` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien creo',
  PRIMARY KEY (`cod_factura`))
ENGINE = InnoDB
COMMENT = 'registro de facturas con retencion';


-- -----------------------------------------------------
-- Table `reten_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reten_usuarios` ;

CREATE TABLE IF NOT EXISTS `reten_usuarios` (
  `username` VARCHAR(40) NOT NULL COMMENT 'login del usuario, id del correo para este sistema especifico',
  `userkey` VARCHAR(40) NULL COMMENT 'sincronia con al calve del usuario',
  `estado` VARCHAR(40) NULL COMMENT 'ACTIVO|INACTIVO',
  `sessionflag` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien altero',
  `sessionficha` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien creo',
  PRIMARY KEY (`username`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reten_usuarios_modulos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reten_usuarios_modulos` ;

CREATE TABLE IF NOT EXISTS `reten_usuarios_modulos` (
  `username` VARCHAR(40) NOT NULL,
  `modulo_string` VARCHAR(40) NOT NULL DEFAULT 'ALL',
  `sessionflag` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien altero',
  `sessionficha` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien creo',
  PRIMARY KEY (`username`, `modulo_string`))
ENGINE = InnoDB
COMMENT = 'permiso granular en que modulo opera el usuario, si esta lis' /* comment truncated */ /*tado, permite vista, sino manda un mensaje*/;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;