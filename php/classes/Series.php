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
