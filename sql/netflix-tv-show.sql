CREATE TABLE series (
	seriesId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	seriesTitle VARCHAR (32) NOT NULL,
	UNIQUE (seriesTitle),
	PRIMARY KEY (seriesId)
);
CREATE TABLE episode (
	episodeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	episodeSeriesId INT UNSIGNED NOT NULL,
	episodeTitle VARCHAR(140) NOT NULL,
	episodeType VARCHAR(127) NOT NULL,
	episodeResolution SMALLINT UNSIGNED NOT NULL,
	INDEX(episodeSeriesId),
	FOREIGN KEY(episodeSeriesId) REFERENCES series(seriesId),
	PRIMARY KEY(episodeId)
);
CREATE TABLE watchlist (
	watchlistEpisodeId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	watchlistUserId INT UNSIGNED NOT NULL,
	INDEX(watchlistEpisodeId),
	INDEX(watchlistUserId),
	FOREIGN KEY(watchlistEpisodeId) REFERENCES episode(episodeId),
	FOREIGN KEY(watchlistUserId) REFERENCES user(userId),
	PRIMARY KEY(watchlistEpisodeId, watchlistUserId)
);
CREATE TABLE user (
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userEmail VARCHAR(128) NOT NULL,
	userName VARCHAR(32) NOT NULL,
	UNIQUE(userEmail),
	UNIQUE(userName),
	PRIMARY KEY(userId)
);