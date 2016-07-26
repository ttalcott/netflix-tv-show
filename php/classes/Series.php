<?php
class Series {
	/**
	 * id for this series; this is the primary key
	 * @var int $seriesId
	 **/
	private $seriesId;
	/**
	 * title for this series
	 * @var string $seriesTitle
	 **/
	private $seriesTitle;

	/**
	 * constructor for this series
	 *
	 * @param int|null $newSeriesId id of this series or null if new
	 * @param string $newSeriesTitle string containing title of this series
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are too big (i.e. strings that exceed character limit)
	 * @throws \TypeError if data violates type hints
	 * @throws \Exception if any other exception occurs
	 **/
	public function __construct(int $newSeriesId = null, string $newSeriesTitle) {
		try {
		$this->setSeriesId($newSeriesId);
		$this->setSeriesTitle($newSeriesTitle);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new\InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new\RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow to the caller/
			throw(new\TypeError($typeError ->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow to the caller
			throw(new\Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for series Id
	 *
	 * @return int|null value of series Id
	 **/
	public function getSeriesId() {
		return($this->seriesId);
	}

	/**
	 * mutator method for series Id
	 *
	 * @param int|null $newSeriesId new value of series Id
	 * @throws \RangeException if $newSeriesId is not positive
	 * @throws \TypeError if $newSeriesId is not an integer
	 **/
	public function setSeriesId(int $newSeriesId = null) {
		if($newSeriesId === null) {
			$this->seriesId = null;
			return;
		}

		//verify series id is positive
		if($newSeriesId <= 0) {
			throw(new \RangeException("series id is not positive"));
		}

		//convert and store series id
		$this->seriesId = $newSeriesId;
	}

	/**
	 * accessor method for series title
	 *
	 * @return string value for series title
	 */
	public function getSeriesTitle() {
		return($this->seriesTitle);
	}

	/**
	 * mutator method for series title
	 *
	 * @param string $newSeriesTitle new value for series title
	 * @throws \InvalidArgumentException if $newSeriesTitle is not a string or insecure
	 * @throws \RangeException if $newSeriesTitle is > 32 characters long
	 * @throws \TypeError if $newSeriesTitle is not a string
	 */
	public function setSeriesTitle(string $newSeriesTitle) {
		//verify title content is secure
		$newSeriesTitle = trim($newSeriesTitle);
		$newSeriesTitle = filter_var($newSeriesTitle, FILTER_SANITIZE_STRING);
		if(empty($newSeriesTitle) === true) {
			throw(new \InvalidArgumentException("title content is empty or insecure"));
		}

		//verify title contains correct number of characters
		if(strlen($newSeriesTitle) >32) {
			throw(new \RangeException("title contains too many characters"));
		}

		//convert and store series title
		$this->seriesTitle = $newSeriesTitle;
	}
}

class Episode {
	/**
	 * id for this episode; this is the primary key
	 * @var int $episodeId
	 **/
	private $episodeId;
	/**
	 * id for the series this episode belongs to; this is a foreign key
	 * @var int $episodeSeriesId
	 **/
	private $episodeSeriesId;
	/**
	 * episode title for this show
	 * @var string $episodeTitle
	 **/
	private $episodeTitle;
	/**
	 * episode type
	 * @var string $episodeType
	 *
	**/
	private $episodeType;
	/**
	 * resolution of this episode
	 * @var int $episodeResolution
	 **/
	private $episodeResolution;

	/**
	 * constructor for this episode
	 *
	 * @param int|null $newEpisodeId id of this episode or null if new episode
	 * @param int $newEpisodeSeriesId id of the series this episode belongs to
	 * @param string $newEpisodeTitle string containing episode title
	 * @param string $newEpisodeType string containing episode type
	 * @param int|null $newEpisodeResolution resolution of this episode
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (i.e. string too long, integer not positive)
	 * @throws \TypeError if data type violates type hints
	 * @throws \Exception if there are any other exceptions
	 **/
	public function __construct(int $newEpisodeId = null, int $newEpisodeSeriesId, string $newEpisodeTitle, string $newEpisodeType, int $newEpisodeResolution = null) {
		try {
			$this->setEpisodeId($newEpisodeId);
			$this->setEpisodeSeriesId($newEpisodeSeriesId);
			$this->setEpisodeTitle($newEpisodeTitle);
			$this->setEpisodeType($newEpisodeType);
			$this->setEpisodeResolution($newEpisodeResolution);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow exception to caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow exception to caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow exception to caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow exception to caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for episode id
	 *
	 * @return int|null value of episode id
	 **/
	public function getEpisodeId() {
		return($this->episodeId);
	}

	/**
	 * mutator method for $episodeId
	 *
	 * @param int|null $newEpisodeId new value of episode id
	 * @throws \RangeException if $newEpisodeId is not positive
	 * @throws \TypeError if $newEpisodeId is not an integer
	 **/
	public function setEpisodeId(int $newEpisodeId) {
		if($newEpisodeId === null){
			$this->episodeId = null;
			return;
		}

		//verify episode id is positive
		if($newEpisodeId<= 0) {
			throw(new\RangeException("episode id is not positive"));
		}

		//convert and store episode id
		$this->episodeId = $newEpisodeId;
	}

	/**
	 * accessor method for episode series id
	 *
	 * @return int value of episode series id
	 **/
	public function getEpisodeSeriesId() {
		return($this->episodeSeriesId);
	}

	/**
	 * mutator method for episode series id
	 *
	 * @param int $newEpisodeSeriesId new value of episode series id
	 * @throws \RangeException if $newEpisodeSeriesId is not positive
	 * @throws \TypeError if $newEpisodeSeriesId is not an integer
	 **/
	public function setEpisodeSeriesId(int $newEpisodeSeriesId) {
		//verify episode series id is positive
		if($newEpisodeSeriesId<= 0) {
			throw(new\RangeException("episode series id is not positive"));
		}

		//convert and store episode series id
		$this->episodeSeriesId = $newEpisodeSeriesId;
	}

	/**
	 * accessor method for episode title
	 *
	 * @return string value of episode title
	 **/
	public function getEpisodeTitle() {
		return($this->episodeTitle);
	}

	/**
	 * mutator method for episode title
	 *
	 * @param string $newEpisodeTitle new value of episode title
	 * @throws \InvalidArgumentException if $newEpisodeTitle is not a string or is insecure
	 * @throws \RangeException if $newEpisodeTitle is > 140 characters
	 * @throws \TypeError if $newEpisodeTitle is not a string
	 **/
	public function setEpisodeTitle(string $newEpisodeTitle) {
		//verify title content is secure
		$newEpisodeTitle = trim($newEpisodeTitle);
		$newEpisodeTitle = filter_var($newEpisodeTitle, FILTER_SANITIZE_STRING);
		if(empty($newEpisodeTitle) === true) {
			throw(new \InvalidArgumentException("episode title is empty or insecure"));
		}

		//verify title is correct amount of characters
		if(strlen($newEpisodeTitle) >140) {
			throw(new \RangeException("title content is too large"));
		}

		//convert and store episode title
		$this->episodeTitle = $newEpisodeTitle;
	}

	/**
	 * accessor method for episode type
	 *
	 * @return string value of episode type
	 **/
	public function getEpisodeType() {
		return($this->episodeType);
	}

	/**
	 * mutator method for episode type
	 *
	 * @param string $newEpisodeType new value of episode type
	 * @throws \InvalidArgumentException if $newEpisodeType is not a string or insecure
	 * @throws \RangeException if $newEpisodeType is >127 characters
	 * @throws \TypeError if $newEpisodeType is not a string
	 **/
	public function setEpisodeType(string $newEpisodeType) {
		//verify episode type is secure
		$newEpisodeType = trim($newEpisodeType);
		$newEpisodeType = filter_var($newEpisodeType, FILTER_SANITIZE_STRING);
		if(empty($newEpisodeType) === true) {
			throw(new \InvalidArgumentException ("episode type is empty or insecure"));
		}

		//verify episode type is correct length
		if(strlen($newEpisodeType) >127) {
			throw(new \RangeException("episode type content is too large"));
		}

		//convert and store episode type
		$this->episodeType = $newEpisodeType;
	}

	/**
	 * accessor method for episode resolution
	 *
	 * @return int|null value of episode resolution
	 **/
	public function getEpisodeResolution() {
		return($this->episodeResolution);
	}

	/**
	 * mutator method for episode resolution
	 *
	 * @param int|null $newEpisodeResolution new value of episode resolution
	 * @throws \RangeException if $newEpisodeResolution is not positive
	 * @throws \TypeError if $newEpisodeResolution is not an integer
	 **/
	public function setEpisodeResolution(int $newEpisodeResolution) {
		if($newEpisodeResolution === null) {
			$this->episodeResolution = null;
			return;
		}

		//verify episode resolution is positive
		if($newEpisodeResolution <= 0){
			throw(new \RangeException("episode resolution is not positive"));
		}

		//convert and store episode resolution
		$this->episodeResolution = $newEpisodeResolution;
	}
}