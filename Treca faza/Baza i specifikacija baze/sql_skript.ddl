
CREATE TABLE Acting
(
	IdActor              INTEGER NOT NULL CHECK ( IdActor >= 0 ),
	IdTVShow             INTEGER NOT NULL
);

ALTER TABLE Acting
ADD CONSTRAINT XPKActing PRIMARY KEY (IdActor,IdTVShow);

CREATE TABLE Actor
(
	Id                   INTEGER NOT NULL CHECK ( Id >= 0 )
);

ALTER TABLE Actor
ADD CONSTRAINT XPKActor PRIMARY KEY (Id);

CREATE TABLE Category
(
	Id                   INTEGER PRIMARY KEY AUTO_INCREMENT,
	Name                 VARCHAR(20) NOT NULL
) AUTO_INCREMENT = 0;

CREATE TABLE Comment
(
	Id                   INTEGER PRIMARY KEY AUTO_INCREMENT,
	Description          VARCHAR(30) NOT NULL,
	DateAndTime          TIMESTAMP NOT NULL,
	ContainsSpoiler      boolean NOT NULL DEFAULT false,
	UserName             VARCHAR(20) NOT NULL,
	IdEpisode            INTEGER NOT NULL
) AUTO_INCREMENT = 0;



CREATE TABLE Content
(
	Id                   INTEGER PRIMARY KEY AUTO_INCREMENT,
	Name                 VARCHAR(30) NOT NULL,
	Trailer              VARCHAR(20) NULL,
	ReleaseDate          TIMESTAMP NULL,
	Description          VARCHAR(40) NULL,
	NumberOfRates        INTEGER NOT NULL DEFAULT 0 CHECK ( NumberOfRates >= 0 ),
	Rating               DECIMAL(4,2) NOT NULL DEFAULT 0
) AUTO_INCREMENT = 0;



CREATE TABLE Directing
(
	IdDirector           INTEGER NOT NULL CHECK ( IdDirector >= 0 ),
	IdTVShow             INTEGER NOT NULL
);

ALTER TABLE Directing
ADD CONSTRAINT XPKDirecting PRIMARY KEY (IdDirector,IdTVShow);

CREATE TABLE Director
(
	Id                   INTEGER NOT NULL CHECK ( Id >= 0 )
);

ALTER TABLE Director
ADD CONSTRAINT XPKDirector PRIMARY KEY (Id);

CREATE TABLE Episode
(
	Id                   INTEGER NOT NULL,
	IdSeason             INTEGER NOT NULL,
	Length               INTEGER NULL CHECK ( Length >= 0 ),
	EpisodeNumber        INTEGER NOT NULL CHECK ( EpisodeNumber >= 0 )
);

ALTER TABLE Episode
ADD CONSTRAINT XPKEpisode PRIMARY KEY (Id);

CREATE TABLE Genre
(
	Id                   INTEGER NOT NULL CHECK ( Id >= 0 )
);

ALTER TABLE Genre
ADD CONSTRAINT XPKGenre PRIMARY KEY (Id);

CREATE TABLE List
(
	Id                   INTEGER PRIMARY KEY AUTO_INCREMENT,
	Private              boolean NOT NULL DEFAULT false,
	Naziv                VARCHAR(20) NOT NULL,
	IdCategory           INTEGER NULL CHECK ( IdCategory >= 0 ),
	UserName             VARCHAR(20) NOT NULL,
	Description          VARCHAR(30) NULL
) AUTO_INCREMENT = 0;



CREATE TABLE PartOfList
(
	IdList               INTEGER NOT NULL CHECK ( IdList >= 0 ),
	IdTVShow             INTEGER NOT NULL,
	Description          VARCHAR(30) NULL,
	DateAndTime          TIMESTAMP NOT NULL
);

ALTER TABLE PartOfList
ADD CONSTRAINT XPKPartOfList PRIMARY KEY (IdList,IdTVShow);

CREATE TABLE Picture
(
	IdContent            INTEGER NOT NULL,
	Id                   INTEGER PRIMARY KEY AUTO_INCREMENT,
	Path                 VARCHAR(30) NULL
) AUTO_INCREMENT = 0;


CREATE TABLE Rating
(
	UserName             VARCHAR(20) NOT NULL,
	IdColumn             INTEGER NOT NULL,
	DateAndTime          TIMESTAMP NOT NULL,
	Rating               INTEGER NULL CHECK ( Rating BETWEEN 0 AND 10 )
);

ALTER TABLE Rating
ADD CONSTRAINT XPKRating PRIMARY KEY (UserName,IdColumn);

CREATE TABLE Season
(
	Id                   INTEGER NOT NULL,
	IdTVShow             INTEGER NOT NULL,
	NumberOfEpisodes     INTEGER NULL DEFAULT 0 CHECK ( NumberOfEpisodes >= 0 ),
	SeasonNumber         INTEGER NOT NULL CHECK ( SeasonNumber >= 0 )
);

ALTER TABLE Season
ADD CONSTRAINT XPKSeason PRIMARY KEY (Id);

CREATE TABLE TVShow
(
	Id                   INTEGER NOT NULL,
	Country              VARCHAR(20) NULL,
	Language             VARCHAR(20) NULL,
	Length               INTEGER NULL CHECK ( Length >= 0 ),
	EndDate              TIMESTAMP NULL,
	LastEditDate         TIMESTAMP NULL,
	NumberOfEpisodes     INTEGER NULL DEFAULT 0 CHECK ( NumberOfEpisodes >= 0 )
);

ALTER TABLE TVShow
ADD CONSTRAINT XPKTVShow PRIMARY KEY (Id);

CREATE TABLE TypeOf
(
	IdTVShow             INTEGER NOT NULL,
	IdGenre              INTEGER NOT NULL CHECK ( IdGenre >= 0 )
);

ALTER TABLE TypeOf
ADD CONSTRAINT XPKTypeOf PRIMARY KEY (IdTVShow,IdGenre);

CREATE TABLE User
(
	UserName             VARCHAR(20) NOT NULL,
	Name                 VARCHAR(20) NULL,
	Surname              VARCHAR(20) NULL,
	Gender               CHAR NULL,
	E_mail               VARCHAR(20) NOT NULL,
	Password             VARCHAR(20) NOT NULL,
	BirthDate            TIMESTAMP NULL,
	IsAdmin              boolean NOT NULL,
	SecurityQuestion     VARCHAR(30) NOT NULL,
	Answer               VARCHAR(20) NOT NULL,
	PicturePath          VARCHAR(20) NULL,
	RegistrationDate     TIMESTAMP NULL,
	AdminSince           DATE NULL
);

ALTER TABLE User
ADD CONSTRAINT XPKUser PRIMARY KEY (UserName);

CREATE TABLE WatchedEpisode
(
	IdEpisode            INTEGER NOT NULL,
	UserName             VARCHAR(20) NOT NULL,
	DateAndTime          TIMESTAMP NOT NULL
);

ALTER TABLE WatchedEpisode
ADD CONSTRAINT XPKWatchedEpisode PRIMARY KEY (IdEpisode,UserName);

CREATE TABLE WatchedSeason
(
	UserName             VARCHAR(20) NOT NULL,
	IdSeason             INTEGER NOT NULL,
	DateAndTime          TIMESTAMP NOT NULL
);

ALTER TABLE WatchedSeason
ADD CONSTRAINT XPKWatchedSeason PRIMARY KEY (UserName,IdSeason);

ALTER TABLE Acting
ADD CONSTRAINT R_21 FOREIGN KEY (IdActor) REFERENCES Actor (Id);

ALTER TABLE Acting
ADD CONSTRAINT R_22 FOREIGN KEY (IdTVShow) REFERENCES TVShow (Id);

ALTER TABLE Actor
ADD CONSTRAINT R_17 FOREIGN KEY (Id) REFERENCES Category (Id)
		ON DELETE CASCADE;

ALTER TABLE Comment
ADD CONSTRAINT R_13 FOREIGN KEY (UserName) REFERENCES User (UserName);

ALTER TABLE Comment
ADD CONSTRAINT R_14 FOREIGN KEY (IdEpisode) REFERENCES Episode (Id);

ALTER TABLE Directing
ADD CONSTRAINT R_23 FOREIGN KEY (IdDirector) REFERENCES Director (Id);

ALTER TABLE Directing
ADD CONSTRAINT R_24 FOREIGN KEY (IdTVShow) REFERENCES TVShow (Id);

ALTER TABLE Director
ADD CONSTRAINT R_18 FOREIGN KEY (Id) REFERENCES Category (Id)
		ON DELETE CASCADE;

ALTER TABLE Episode
ADD CONSTRAINT R_4 FOREIGN KEY (Id) REFERENCES Content (Id)
		ON DELETE CASCADE;

ALTER TABLE Episode
ADD CONSTRAINT R_10 FOREIGN KEY (IdSeason) REFERENCES Season (Id);

ALTER TABLE Genre
ADD CONSTRAINT R_16 FOREIGN KEY (Id) REFERENCES Category (Id)
		ON DELETE CASCADE;

ALTER TABLE List
ADD CONSTRAINT R_31 FOREIGN KEY (IdCategory) REFERENCES Category (Id);

ALTER TABLE List
ADD CONSTRAINT R_32 FOREIGN KEY (UserName) REFERENCES User (UserName);

ALTER TABLE PartOfList
ADD CONSTRAINT R_33 FOREIGN KEY (IdList) REFERENCES List (Id);

ALTER TABLE PartOfList
ADD CONSTRAINT R_34 FOREIGN KEY (IdTVShow) REFERENCES TVShow (Id);

ALTER TABLE Picture
ADD CONSTRAINT R_15 FOREIGN KEY (IdContent) REFERENCES Content (Id);

ALTER TABLE Rating
ADD CONSTRAINT R_11 FOREIGN KEY (UserName) REFERENCES User (UserName);

ALTER TABLE Rating
ADD CONSTRAINT R_12 FOREIGN KEY (IdColumn) REFERENCES Content (Id);

ALTER TABLE Season
ADD CONSTRAINT R_3 FOREIGN KEY (Id) REFERENCES Content (Id)
		ON DELETE CASCADE;

ALTER TABLE Season
ADD CONSTRAINT R_9 FOREIGN KEY (IdTVShow) REFERENCES TVShow (Id);

ALTER TABLE TVShow
ADD CONSTRAINT R_1 FOREIGN KEY (Id) REFERENCES Content (Id)
		ON DELETE CASCADE;

ALTER TABLE TypeOf
ADD CONSTRAINT R_19 FOREIGN KEY (IdTVShow) REFERENCES TVShow (Id);

ALTER TABLE TypeOf
ADD CONSTRAINT R_20 FOREIGN KEY (IdGenre) REFERENCES Genre (Id);

ALTER TABLE WatchedEpisode
ADD CONSTRAINT R_25 FOREIGN KEY (IdEpisode) REFERENCES Episode (Id);

ALTER TABLE WatchedEpisode
ADD CONSTRAINT R_26 FOREIGN KEY (UserName) REFERENCES User (UserName);

ALTER TABLE WatchedSeason
ADD CONSTRAINT R_27 FOREIGN KEY (UserName) REFERENCES User (UserName);

ALTER TABLE WatchedSeason
ADD CONSTRAINT R_29 FOREIGN KEY (IdSeason) REFERENCES Season (Id);
