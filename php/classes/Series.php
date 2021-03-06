<?php
namespace Edu\Cnm\Ttalcott\NetflixTvShow;
/**
 * Small cross section of a Netflix like Series 
 *
 * @author Travis Talcott <ttalcott@cnm.edu>
 * @version 1.0.0
 **/
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
			throw(new\TypeError($typeError->getMessage(), 0, $typeError));
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
		return ($this->seriesId);
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
		return ($this->seriesTitle);
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
		if(strlen($newSeriesTitle) > 32) {
			throw(new \RangeException("title contains too many characters"));
		}

		//convert and store series title
		$this->seriesTitle = $newSeriesTitle;
	}

	/**
	 * inserts this series into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL error occurs
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		//enforce series id is null (don't insert a series that already exists)
		if($this->seriesId !== null) {
			throw(new \PDOException("not a new series"));
		}

		//create query template
		$query = "INSERT INTO series(seriesTitle) VALUES(:seriesTitle)";
		$statement = $pdo->prepare($query);

		//bind the variables to the placeholders in this template
		$parameters = ["seriesTitle" => $this->seriesTitle];
		$statement->execute($parameters);

		//update null seriesId with the value mySQL gives us
		$this->seriesId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this series from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) {
		//enforce this series id is not null (do not delete a series that doesn't exist)
		if($this->seriesId !==null) {
			throw(new \PDOException("cannot delete data that does not exist"));
		}

		//create query template
		$query = "DELETE FROM series WHERE seriesId = :seriesId";
		$statement = $pdo->prepare($query);

		//bind the variables to the placeholders in this template
		$parameters = ["seriesId" => $this->seriesId];
		$statement->execute($parameters);
	}

	/**
	 * updates this series in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) {
		//enforce series id is not null (do not update a series that doesn't exist)
		if($this->seriesId !== null) {
			throw(new \PDOException("cannot update a series that doesn't exist"));
		}

		//create query template
		$query = "UPDATE series SET seriesTitle = :seriesTitle WHERE seriesId = seriesId";
		$statement = $pdo->prepare($query);

		//bind the variables to the placeholders in this template
		$parameters = ["seriesTitle" => $this->seriesTitle];
		$statement->execute($parameters);
	}
}
