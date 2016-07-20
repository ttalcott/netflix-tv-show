CREATE TABLE series (
	seriesId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	seriesTitle VARCHAR (32) NOT NULL,
	UNIQUE (seriesTitle),
	PRIMARY KEY (seriesId)
);
CREATE TABLE episode (
	episodeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	episodeSeriesId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	episodeResolution
)