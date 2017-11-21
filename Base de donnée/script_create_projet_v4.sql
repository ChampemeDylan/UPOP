USE db708219960;

CREATE TABLE FICHE_USER (
	loginUser VARCHAR(10),
    nomUser VARCHAR(40) NOT NULL,
    prenomUser VARCHAR(40) NOT NULL,
    genreUser CHAR(1) NOT NULL,
    dateNaissanceUser DATE NOT NULL,
    passwordUser VARCHAR(512) NOT NULL,
    adresseUser VARCHAR(100) NOT NULL,
    cpUser CHAR(5) NOT NULL,
    villeUser VARCHAR(40) NOT NULL,
    mailUser VARCHAR(50) NOT NULL,
    typeUser BOOLEAN NOT NULL,
    CONSTRAINT PK_User PRIMARY KEY(loginUser));

CREATE TABLE COMMANDE (
	numeroCommande INT UNSIGNED auto_increment,
    loginUser VARCHAR(10) NOT NULL,
    dateCreation DATETIME NOT NULL,
    dateValidation DATETIME NOT NULL,
    CONSTRAINT PK_Commande PRIMARY KEY (numeroCommande),
    constraint FK_C_User foreign key (loginUser) references FICHE_User(loginUser));

CREATE TABLE UNIVERS (
	libelleUnivers VARCHAR(40),
    CONSTRAINT PK_Univers PRIMARY KEY (libelleUnivers));

CREATE TABLE CATEGORIE (
	libelleCategorie VARCHAR(20),
    CONSTRAINT PK_Categorie PRIMARY KEY (libelleCategorie));

CREATE TABLE UNIVERS_CATEGORIE (
	libelleUnivers VARCHAR(40) NOT NULL,
    libelleCategorie VARCHAR(20) NOT NULL,
	constraint FK_UC_univers foreign key (libelleUnivers) references UNIVERS(libelleUnivers),
    constraint FK_UC_categorie foreign key (libelleCategorie) references CATEGORIE(libelleCategorie),
    constraint PK_UniCat PRIMARY KEY (libelleUnivers,libelleCategorie));

CREATE TABLE FICHE_ARTICLE (
	refArticle CHAR(10),
    libelleArticle VARCHAR(50) NOT NULL,
    descriptifArticle TEXT NOT NULL,
    prixArticle FLOAT DEFAULT 25 NOT NULL,
    libelleUnivers VARCHAR(40) NOT NULL,
    CONSTRAINT PK_Article PRIMARY KEY (refArticle),
    constraint FK_FA_univers foreign key (libelleUnivers) references UNIVERS(libelleUnivers));

CREATE TABLE STOCK_ARTICLE (
	refArticle CHAR(10),
    stockArticle tinyint default 10 not null,
    constraint FK_SA_article FOREIGN KEY (refArticle) references FICHE_ARTICLE(refArticle),
    CONSTRAINT PK_Stock PRIMARY KEY (refArticle));

CREATE TABLE COMMANDE_ARTICLE (
	numeroCommande INT UNSIGNED NOT NULL,
    refArticle CHAR(10) NOT NULL,
    quantiteArticle SMALLINT UNSIGNED NOT NULL,
    constraint FK_CA_commande foreign key (numeroCommande) references COMMANDE(numeroCommande),
    constraint FK_CA_article foreign key (refArticle) references FICHE_ARTICLE(refArticle),
    constraint PK_ComArt primary key (numeroCommande,refArticle));
