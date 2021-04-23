-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema AvaliacaoAC
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema AvaliacaoAC
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `AvaliacaoAC` DEFAULT CHARACTER SET utf8 ;
USE `AvaliacaoAC` ;

-- -----------------------------------------------------
-- Table `AvaliacaoAC`.`Produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AvaliacaoAC`.`Produto` (
  `idProduto` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL,
  `valorUnitario` DECIMAL NULL,
  `estoque` INT NULL,
  `codigoBarra` INT NULL,
  `deletado` TINYINT NULL,
  `dataUltimaVenda` DATE NULL,
  `valorTotalVendas` DECIMAL NULL,
  PRIMARY KEY (`idProduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AvaliacaoAC`.`Venda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AvaliacaoAC`.`Venda` (
  `idVenda` INT NOT NULL AUTO_INCREMENT,
  `quantidade` INT NULL,
  `Produto_idProduto` INT NOT NULL,
  PRIMARY KEY (`idVenda`),
  INDEX `fk_Venda_Produto_idx` (`Produto_idProduto` ASC),
  CONSTRAINT `fk_Venda_Produto`
    FOREIGN KEY (`Produto_idProduto`)
    REFERENCES `AvaliacaoAC`.`Produto` (`idProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
