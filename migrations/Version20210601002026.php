<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601002026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //---- Structure de la table `unite`
        $this->addSql('CREATE TABLE `unite` (`idU` int(10) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`DesUnit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');    
        // ---- Structure de la table `famille`
        $this->addSql('CREATE TABLE `famille` (`idFamille` int(10) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`Famille` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,`famille_sup` tinyint(1) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
         // ---- Structure de la table `depot`
         $this->addSql('CREATE TABLE `depot` (`CodeD` int(2) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY ,`DesDep` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,`Dep_Sup` tinyint(1) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        // ---- Structure de la table `contact`
        $this->addSql('CREATE TABLE `contact` (`idContact` int(8) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`tel` varchar(20) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `client`
        $this->addSql('CREATE TABLE `client` (`idCl` int(3) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`nomCl` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,`AdrCl` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,`EmailCl` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,`client_sup` tinyint(1) NOT NULL DEFAULT 0) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        // ---- Structure de la table `frs`
        $this->addSql('CREATE TABLE `frs` (`idF` int(3) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`nomf` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,`AdrF` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,`EmailF` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,`frs_sup` tinyint(1) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        // ---- Structure de la table `nifclient`
        $this->addSql('CREATE TABLE `nifclient` (`idCl` int(10) UNSIGNED ZEROFILL PRIMARY KEY,`NifCl` varchar(20) NOT NULL UNIQUE,CONSTRAINT `fk_client_NifClient` FOREIGN KEY (`idCl`) REFERENCES `client` (`idCl`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `niff`
        $this->addSql('CREATE TABLE `niff` (`idF` int(10) UNSIGNED ZEROFILL PRIMARY KEY,`NifF` varchar(20) NOT NULL UNIQUE,CONSTRAINT `fk_niff_frs` FOREIGN KEY (`idF`) REFERENCES `frs` (`idF`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `cifclient`
        $this->addSql('CREATE TABLE `cifclient` (`idCl` int(10) UNSIGNED ZEROFILL PRIMARY KEY,`CifCl` varchar(20) NOT NULL UNIQUE,CONSTRAINT `fk_cifClient_client` FOREIGN KEY (`idCl`) REFERENCES `client` (`idCl`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `ciff`
        $this->addSql('CREATE TABLE `ciff` (`idF` int(10) UNSIGNED ZEROFILL PRIMARY KEY,`cifF` varchar(20) NOT NULL UNIQUE,CONSTRAINT `fk_ciff_frs` FOREIGN KEY (`idF`) REFERENCES `frs` (`idF`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `rcsclient`
        $this->addSql('CREATE TABLE `rcsclient` (`idCl` int(10) UNSIGNED ZEROFILL PRIMARY KEY,`RcsCl` varchar(40) NOT NULL UNIQUE,CONSTRAINT `fk_client_rcsClient` FOREIGN KEY (`idCl`) REFERENCES `client` (`idCl`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `rcsf`
        $this->addSql('CREATE TABLE `rcsf` (`idF` int(10) UNSIGNED ZEROFILL PRIMARY KEY,`RcsF` varchar(40) NOT NULL UNIQUE,CONSTRAINT `fk_rcsf_frs` FOREIGN KEY (`idF`) REFERENCES `frs` (`idF`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `statclient`
        $this->addSql('CREATE TABLE `statclient` (`idCl` int(10) UNSIGNED ZEROFILL PRIMARY KEY,`StatCl` varchar(20) NOT NULL UNIQUE,CONSTRAINT `fk_StatClient_client` FOREIGN KEY (`idCl`) REFERENCES `client` (`idCl`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `statf`
        $this->addSql('CREATE TABLE `statf` (`idF` int(10) UNSIGNED ZEROFILL PRIMARY KEY,`statF` varchar(20) NOT NULL UNIQUE,CONSTRAINT `fk_statf_frs` FOREIGN KEY (`idF`) REFERENCES `frs` (`idF`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `produit`
        $this->addSql('CREATE TABLE `produit` (`idProd` int(3) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`RefProduit` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,`desProduit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,`PrixAP` int(10) UNSIGNED NOT NULL,`PrixVP` int(10) UNSIGNED NOT NULL,`prod_sup` tinyint(1) DEFAULT NULL,`SeuilAp` int(10) UNSIGNED NOT NULL,`idFamille` int(10) UNSIGNED DEFAULT NULL,`idU` int(10) UNSIGNED DEFAULT NULL,CONSTRAINT `FK_29A5EC2734CA99E1` FOREIGN KEY (`idFamille`) REFERENCES `famille` (`idFamille`),CONSTRAINT `FK_29A5EC27A2D72265` FOREIGN KEY (`idU`) REFERENCES `unite` (`idU`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        // ---- Structure de la table `contactclient`
        $this->addSql('CREATE TABLE `contactclient` (`idCl` int(3) UNSIGNED ZEROFILL NOT NULL,`idContact` int(8) UNSIGNED ZEROFILL NOT NULL,PRIMARY KEY (`idCl`,`idContact`),CONSTRAINT `fk_client_contact` FOREIGN KEY (`idCl`) REFERENCES `client` (`idCl`),CONSTRAINT `fk_contact_contactClient` FOREIGN KEY (`idContact`) REFERENCES `contact` (`idContact`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `contactfrs`
        $this->addSql('CREATE TABLE `contactfrs` (`idF` int(3) UNSIGNED ZEROFILL NOT NULL,`idContact` int(8) UNSIGNED ZEROFILL NOT NULL,PRIMARY KEY (`idF`,`idContact`),CONSTRAINT `fk_contact_contactFrs` FOREIGN KEY (`idContact`) REFERENCES `contact` (`idContact`),CONSTRAINT `fk_frs_contactFrs` FOREIGN KEY (`idF`) REFERENCES `frs` (`idF`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `vente`
        $this->addSql('CREATE TABLE `vente` (`numV` int(6) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`dateV` date NOT NULL DEFAULT curdate(),`idCl` int(3) UNSIGNED ZEROFILL DEFAULT NULL,`Tvav` float(4,2) UNSIGNED ZEROFILL NOT NULL,CONSTRAINT `fk_vente_client` FOREIGN KEY (`idCl`) REFERENCES `client` (`idCl`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `achat`
        $this->addSql('CREATE TABLE `achat` (`numA` int(6) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`dateA` date NOT NULL DEFAULT curdate(),`idF` int(3) UNSIGNED ZEROFILL NOT NULL,`tvaA` float(4,2) UNSIGNED ZEROFILL NOT NULL,CONSTRAINT `fk_achat_frs` FOREIGN KEY (`idF`) REFERENCES `frs` (`idF`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `detaila`
        $this->addSql('CREATE TABLE `detaila` (`idProd` int(3) UNSIGNED ZEROFILL NOT NULL,`numA` int(6) UNSIGNED ZEROFILL NOT NULL,`QteA` float(8,2) UNSIGNED ZEROFILL NOT NULL,`PrixA` float(10,2) UNSIGNED ZEROFILL NOT NULL,PRIMARY KEY (`idProd`,`numA`),CONSTRAINT `fk_achat_detaila` FOREIGN KEY (`numA`) REFERENCES `achat` (`numA`),CONSTRAINT `fk_produit_detaila` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `detailstock`
        $this->addSql('CREATE TABLE `detailstock` (`idProd` int(3) UNSIGNED ZEROFILL NOT NULL,`CodeD` int(2) UNSIGNED ZEROFILL NOT NULL,`QteP` float(8,2) NOT NULL,PRIMARY KEY (`idProd`,`CodeD`),CONSTRAINT `fk_depot_detailStock` FOREIGN KEY (`CodeD`) REFERENCES `depot` (`CodeD`),CONSTRAINT `fk_produit_detailStock` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `detailv`
        $this->addSql('CREATE TABLE `detailv` (`idProd` int(3) UNSIGNED ZEROFILL NOT NULL,`numV` int(8) UNSIGNED ZEROFILL NOT NULL,`CodeD` int(2) UNSIGNED ZEROFILL NOT NULL,`QteV` float(8,2) UNSIGNED ZEROFILL NOT NULL,`PrixV` float(10,2) UNSIGNED ZEROFILL NOT NULL,PRIMARY KEY (`numV`,`idProd`,`CodeD`),CONSTRAINT `fk_depot_detailv` FOREIGN KEY (`CodeD`) REFERENCES `depot` (`CodeD`),CONSTRAINT `fk_produit_detailv` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`),CONSTRAINT `fk_vente_detailv` FOREIGN KEY (`numV`) REFERENCES `vente` (`numV`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `paiementa`
        $this->addSql('CREATE TABLE `paiementa` (`idPaiement` int(8) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`montantP` int(10) UNSIGNED ZEROFILL NOT NULL,`dateP` date NOT NULL DEFAULT curdate(),`numA` int(6) UNSIGNED ZEROFILL DEFAULT NULL,`Piece` varchar(255) DEFAULT NULL,CONSTRAINT `fk_achat_paiement` FOREIGN KEY (`numA`) REFERENCES `achat` (`numA`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `paiementv`
        $this->addSql('CREATE TABLE `paiementv` (`idPaiementV` int(8) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`montantP` int(10) UNSIGNED ZEROFILL NOT NULL,`dateP` date NOT NULL DEFAULT curdate(),`numV` int(6) UNSIGNED ZEROFILL DEFAULT NULL,`Piece` varchar(255) DEFAULT NULL,CONSTRAINT `fk_vente_paiementv` FOREIGN KEY (`numV`) REFERENCES `vente` (`numV`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `task`
        $this->addSql('CREATE TABLE `task` (`idTask` int(5) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`TitleT` varchar(50) NOT NULL,`descT` text DEFAULT NULL,`taskF` binary(1) DEFAULT 1) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `ajoutstock`
        $this->addSql('CREATE TABLE `ajoutstock` (`idProd` int(3) UNSIGNED ZEROFILL NOT NULL,`CodeD` int(2) UNSIGNED ZEROFILL NOT NULL,`QteP` float(8,2) UNSIGNED ZEROFILL NOT NULL,`numA` int(8) UNSIGNED ZEROFILL NOT NULL,PRIMARY KEY (`idProd`,`CodeD`,`numA`),CONSTRAINT `fk_achat_ajoutStock` FOREIGN KEY (`numA`) REFERENCES `achat` (`numA`),CONSTRAINT `fk_depot_ajoutStock` FOREIGN KEY (`CodeD`) REFERENCES `depot` (`CodeD`),CONSTRAINT `fk_produit_ajoutStock` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // ---- Structure de la table `charge`
        $this->addSql('CREATE TABLE `charge` (`idProd` int(3) UNSIGNED ZEROFILL AUTO_INCREMENT PRIMARY KEY,`idCharge` int(8) UNSIGNED ZEROFILL NOT NULL,`PrixP` int(8) UNSIGNED ZEROFILL DEFAULT NULL,`QteP` float(8,2) UNSIGNED ZEROFILL NOT NULL,`codeD` int(2) UNSIGNED ZEROFILL NOT NULL,`dateC` date NOT NULL DEFAULT curdate(),CONSTRAINT `fk_charge_produit` FOREIGN KEY (`idProd`) REFERENCES `produit` (`idProd`),CONSTRAINT `fk_depot_charge` FOREIGN KEY (`codeD`) REFERENCES `depot` (`CodeD`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');
        // -----------Vue---
        //Achatliste
        $this->addSql('CREATE VIEW `achatliste`  AS SELECT `detaila`.`numA` AS `numa`, `achat`.`dateA` AS `dateA`, `produit`.`RefProduit` AS `refproduit`, `produit`.`desProduit` AS `desproduit`, `detaila`.`QteA` AS `QteA`, `detaila`.`PrixA` AS `prixA` FROM ((`detaila` JOIN `achat` ON(`achat`.`numA` = `detaila`.`numA`)) JOIN `produit` ON(`produit`.`idProd` = `detaila`.`idProd`))');
        //
        $this->addSql('CREATE VIEW `paiementachat`  AS SELECT `paiementa`.`numA` AS `numa`, SUM(`paiementa`.`montantP`) AS `Montantp` FROM `paiementa` GROUP BY `paiementa`.`numA` ORDER BY `paiementa`.`numA` DESC ');
        //
        $this->addSql('CREATE VIEW `paiementvente`  AS SELECT `paiementv`.`numV` AS `numv`, SUM(`paiementv`.`montantP`) AS `montantp` FROM `paiementv` GROUP BY `paiementv`.`numV` ORDER BY `paiementv`.`numV` DESC ');
        //
        $this->addSql('CREATE VIEW `montantachat`  AS SELECT `detaila`.`numA` AS `numa`, SUM(`detaila`.`QteA` * `detaila`.`PrixA`) - SUM(`detaila`.`QteA` * `detaila`.`PrixA`) * `achat`.`tvaA` / 100 AS `mont` FROM (`detaila` join `achat` on(`detaila`.`numA` = `achat`.`numA`)) GROUP BY `detaila`.`numA` ORDER BY `detaila`.`numA` DESC ');
        //
        $this->addSql('CREATE VIEW `montantvente`  AS SELECT `vente`.`numV` AS `numv`, SUM(`detailv`.`QteV` * `detailv`.`PrixV`) - SUM(`detailv`.`QteV` * `detailv`.`PrixV`) * `vente`.`Tvav` / 100 AS `mont` FROM (`detailv` join `vente` on(`detailv`.`numV` = `vente`.`numV`)) GROUP BY `detailv`.`numV` ORDER BY `detailv`.`numV` DESC ');
        //
        $this->addSql('CREATE VIEW `achatpaiement`  AS SELECT `montantachat`.`numa` AS `numa`, `montantachat`.`mont` AS `mont`, `paiementachat`.`Montantp` AS `montantp` FROM (`montantachat` LEFT JOIN `paiementachat` ON(`montantachat`.`numa` = `paiementachat`.`numa`)) ORDER BY `montantachat`.`numa` DESC ');
        //
        $this->addSql('CREATE VIEW `approvisionnement`  AS SELECT `detaila`.`numA` AS `numa`, `detaila`.`idProd` AS `idprod`, `detaila`.`QteA` AS `qtea`, SUM(`ajoutstock`.`QteP`) AS `qtep` FROM (`detaila` LEFT JOIN `ajoutstock` ON(`detaila`.`numA` = `ajoutstock`.`numA` AND `detaila`.`idProd` = `ajoutstock`.`idProd`)) GROUP BY `detaila`.`numA`, `detaila`.`idProd`');
        //
        $this->addSql('CREATE VIEW `month`  AS SELECT MONTH(`achat`.`dateA`) AS `MONTH`, SUM(`detaila`.`QteA` * `detaila`.`PrixA`) AS `somme`, SUM(`detaila`.`QteA` * `detaila`.`PrixA`) * `achat`.`tvaA` / 100 AS `sommeTva` FROM (`achat` join `detaila` ON(`achat`.`numA` = `detaila`.`numA`)) WHERE MONTH(`achat`.`dateA`) = MONTH(CURDATE())');
        //
        $this->addSql('CREATE VIEW `ventepaiement`  AS SELECT `montantvente`.`numv` AS `numv`, `montantvente`.`mont` AS `mont`, `paiementvente`.`montantp` AS `montantp` FROM (`montantvente` LEFT JOIN `paiementvente` ON(`montantvente`.`numv` = `paiementvente`.`numv`)) ORDER BY `montantvente`.`numv` DESC ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
