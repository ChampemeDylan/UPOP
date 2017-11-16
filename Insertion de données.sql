-- Insertion des données Univers

insert into univers(libelleUnivers) values
	("Dragon Ball Z"),
    ("Marvel"),
    ("South Park"),
    ("Harry Potter"),
    ("Le Seigneur Des Anneaux"),
    ("Star Wars"),
    ("Assassin’s Creed"),
    ("Tekken"),
    ("The Witcher"),
    ("Breaking Bad"),
    ("Games Of Thrones"),
    ("Lost");

select * from univers;

-- Insertion des données Categorie

insert into categorie(libelleCategorie) values
	("Dessin Animé"),
    ("Film"),
    ("Série"),
    ("Jeu Vidéo");
    
select * from categorie;

-- Insertion des données Univers-Categorie

insert into univers_categorie(libelleUnivers,libelleCategorie) values
	("Dragon Ball Z","Dessin Animé"),
    ("Marvel","Dessin Animé"),
    ("South Park","Dessin Animé"),
    ("Star Wars","Dessin Animé"),
    ("Harry Potter","Film"),
    ("Le Seigneur Des Anneaux","Film"),
    ("Star Wars","Film"),
    ("Marvel","Film"),
    ("Assassin’s Creed","Jeu Vidéo"),
    ("Tekken","Jeu Vidéo"),
    ("The Witcher","Jeu Vidéo"),
    ("Dragon Ball Z","Jeu Vidéo"),
    ("Marvel","Jeu Vidéo"),
    ("Harry Potter","Jeu Vidéo"),
    ("Le Seigneur Des Anneaux","Jeu Vidéo"),
    ("Star Wars","Jeu Vidéo"),
    ("Games Of Thrones","Jeu Vidéo"),
    ("Breaking Bad","Série"),
    ("Games Of Thrones","Série"),
    ("Lost","Série"),
    ("Star Wars","Série");
    
select * from univers_categorie;

SELECT * FROM fiche_article;

update fiche_article set prixArticle = 25;

select * from stock_article;

insert into fiche_user(loginUser,nomUser,prenomUser,genreUser,dateNaissanceUser,passwordUser,adresseUser,cpUser,villeUser,mailUser,typeUser) values
	("simon","Simon","JC","M","1977-04-26","simon","rue du php","63000","Clermont","tada@tada.fr",0);
    
select * from fiche_user;
