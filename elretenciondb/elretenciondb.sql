-- SQL script
-- mar 09 may 2023 08:01:41
-- Model: New Model    Version: 1.0

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
COMMENT = 'registro de facturas con retencion';


-- -----------------------------------------------------
-- Table `reten_usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reten_usuarios` ;

CREATE TABLE IF NOT EXISTS `reten_usuarios` (
  `username` VARCHAR(40) NOT NULL COMMENT 'login del usuario, id del correo para este sistema especifico',
  `userkey` VARCHAR(40) NULL COMMENT 'sincronia con al calve del usuario',
  `userstatus` VARCHAR(40) NULL COMMENT 'ACTIVO|INACTIVO',
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
COMMENT = 'permiso granular en que modulo opera el usuario, si esta lis' /* comment truncated */ /*tado, permite vista, sino manda un mensaje*/;

-- -----------------------------------------------------
-- Schema eladmindb
-- -----------------------------------------------------
-- admin shcema for common data
-- DROP SCHEMA IF EXISTS `eladmindb` ; -- only drops if project central do not exits yet

-- -----------------------------------------------------
-- Schema eladmindb
--
-- admin shcema for common data
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `eladmindb` ;
USE `eladmindb` ;

-- -----------------------------------------------------
-- Table `adm_juridico`
-- -----------------------------------------------------
-- DROP TABLE IF EXISTS `adm_juridico` ; -- only creates if not exits

CREATE TABLE IF NOT EXISTS `adm_juridico` (
  `cod_juridico` VARCHAR(40) NOT NULL,
  `cod_denominacion` VARCHAR(40) NULL,
  `nombre_legal` VARCHAR(40) NULL,
  `nombre_comercial` VARCHAR(40) NULL,
  `tipo_juridico` VARCHAR(40) NULL,
  `ficha` VARCHAR(40) NULL,
  `sessionflag` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien altero',
  `sessionficha` VARCHAR(40) NULL COMMENT 'YYYYMMDDhhmmss.entidad.usuario quien creo',
  PRIMARY KEY (`cod_juridico`))
COMMENT = 'tabla razones sociales.. externa.. aqui solo para compatibil' /* comment truncated */ /*idad*/;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

