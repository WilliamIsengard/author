<?php
namespace Wisengard\Author;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Small Cross Section of an author profile
 *
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 3.0.0
 **/
class Author {
	use ValidateUuid;
	/**
 	* id for this author; this is the primary key
	* @var Uuid $authorId
	**/
	private $authorId;
	/**
	* Url for the author's avatar
	* @var string $authorAvatarUrl
	**/
	private $authorAvatarUrl;
	/**
	* Activation token for initial profile creation
	* @var string $authorActivationToken
	**/
	private $authorActivationToken;
	/**
	* Email address of author
	* @var string $authorEmail
	**/
	private $authorEmail;
	/**
	* Hash data for author profile
	* @var string $authorHash
	**/
	private $authorHash;
	/**
	* Author user name for profile
	* @var string $authorUsername
	**/
	private $authorUsername;

	/**
	* constructor for this
	* @param Uuid|string $newAuthorId new id of this author or null if a new author
	* @param string $newAuthorAvatarUrl Url for the new author's avatar
	* @param string $newAuthorActivationToken activation token for new author
	* @param string $newAuthorEmail email address for new author
	* @param string $newAuthorHash hash for new author
	* @param string $newAuthorUsername username for new author
	* @throws \InvalidArgumentException if data types are not valid
	* @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	* @throws \TypeError if data types violate type hints
	* @throws \Exception if some other exception occurs
	* @Documentation https://php.net/manual/en/language.oop5.decon.php
	**/
	public function __construct($newAuthorId, string $newAuthorAvatarUrl, string $newAuthorActivationToken, string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for author id
	 *
	 * @return Uuid value of author id
	 **/
	public function getAuthorId() : Uuid {
		return($this->authorId);
	}

	/**
	 * mutator method for author id
	 *
	 * @param Uuid|string $newAuthorId new value of author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not a uuid or string
	 **/
	public function setAuthorId( $newAuthorId) : void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author id
		$this->authorId = $uuid;
	}

	/**
	 * accessor method for avatar url
	 *
	 * @return string value of avatar url
	 **/
	public function getAuthorAvatarUrl() : string {
		return($this->authorAvatarUrl);
	}

	/**
	 * mutator method for avatar url
	 *
	 * @param string $newAuthorAvatarUrl new value of avatar url
	 * @throws \InvalidArgumentException if $newAuthorAvatarUrl is not a string or insecure
	 * @throws \RangeException if $newAuthorAvatarUrl is > 255 characters
	 * @throws \TypeError if $newAuthorAvatarUrl is not a string
	 **/
	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) : void {
		// verify the avatar url content is secure
		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorAvatarUrl) === true) {
			throw(new \InvalidArgumentException("avatar url is empty or insecure"));
		}

		// verify the avatar url will fit in the database
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("avatar url too large"));
		}

		// store the avatar url
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	/**
	 * mutator method for activation token
	 *
	 * @param string $newAuthorActivationToken new value of activation token
	 * @throws \InvalidArgumentException if $newAuthorActivationToken is not a string or insecure
	 * @throws \RangeException if $newAuthorActivationToken is > 32 characters
	 * @throws \TypeError if $newAuthorActivationToken is not a string
	 **/
	public function setAuthorActivationToken(string $newAuthorActivationToken) : void {
		// verify the activation token content is secure
		$newAuthorActivationToken = trim($newAuthorActivationToken);
		$newAuthorActivationToken = filter_var($newAuthorActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorActivationToken) === true) {
			throw(new \InvalidArgumentException("activation token is empty or insecure"));
		}

		// verify the activation token will fit in the database
		if(strlen($newAuthorActivationToken) > 32) {
			throw(new \RangeException("activation token too large"));
		}

		// store the activation token
		$this->authorActivationToken = $newAuthorActivationToken;
	}

	/**
	 * mutator method for email
	 *
	 * @param string $newAuthorEmail new value of email
	 * @throws \InvalidArgumentException if $newAuthorEmail is not a string or insecure
	 * @throws \RangeException if $newAuthorEmail is > 128 characters
	 * @throws \TypeError if $newAuthorEmail is not a string
	 **/
	public function setAuthorEmail(string $newAuthorEmail) : void {
		// verify the email content is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("email is empty or insecure"));
		}

		// verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("email too large"));
		}

		// store the email
		$this->authorEmail = $newAuthorEmail;
	}

	/**
	 * mutator method for hash
	 *
	 * @param string $newAuthorHash new value of hash
	 * @throws \InvalidArgumentException if $newAuthorHash is not a string or insecure
	 * @throws \RangeException if $newAuthorHash is > 97 characters
	 * @throws \TypeError if $newAuthorHash is not a string
	 **/
	public function setAuthorHash(string $newAuthorHash) : void {
		// verify the hash content is secure
		$newAuthorHash = trim($newAuthorHash);
		$newAuthorHash = filter_var($newAuthorHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("hash is empty or insecure"));
		}

		// verify the hash will fit in the database
		if(strlen($newAuthorHash) > 97) {
			throw(new \RangeException("hash too large"));
		}

		// store the hash
		$this->authorHash = $newAuthorHash;
	}

	/**
	 * mutator method for username
	 *
	 * @param string $newAuthorUsername new value of username
	 * @throws \InvalidArgumentException if $newAuthorUsername is not a string or insecure
	 * @throws \RangeException if $newAuthorUsername is > 32 characters
	 * @throws \TypeError if $newAuthorUsername is not a string
	 **/
	public function setAuthorUsername(string $newAuthorUsername) : void {
		// verify the username content is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}

		// verify the username will fit in the database
		if(strlen($newAuthorUsername) > 32) {
			throw(new \RangeException("username too large"));
		}

		// store the username
		$this->authorUsername = $newAuthorUsername;
	}

	/**
	 * inserts this author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
//	public function insert(\PDO $pdo) : void {
//
//		// create query template
//		$query = "INSERT INTO author(authorId,authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername) VALUES(:authorId, :authorAvatarId, :authorActivationToken, :authorEmail. :authorHash, :authorUsername)";
//		$statement = $pdo->prepare($query);
//
//	/**
//	 * deletes this author from mySQL
//	 *
//	 * @param \PDO $pdo PDO connection object
//	 * @throws \PDOException when mySQL related errors occur
//	 * @throws \TypeError if $pdo is not a PDO connection object
//	 **/
//	public function delete(\PDO $pdo) : void {
//
//		// create query template
//		$query = "DELETE FROM author WHERE authorId = :authorId";
//		$statement = $pdo->prepare($query);
//
//		// bind the member variables to the place holder in the template
//		$parameters = ["authorId" => $this->authorId->getBytes()];
//		$statement->execute($parameters);
//	}
//
//	/**
//	 * updates this author in mySQL
//	 *
//	 * @param \PDO $pdo PDO connection object
//	 * @throws \PDOException when mySQL related errors occur
//	 * @throws \TypeError if $pdo is not a PDO connection object
//	 **/
//	public function update(\PDO $pdo) : void {
//
//		// create query template
//		$query = "UPDATE author SET authorId = :authorId, authorAvatarUrl = :authorAvatarUrl, authorActivationToken = :authorActivationToken, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername WHERE authorId = :authorId";
//		$statement = $pdo->prepare($query);
//
//	}
//
//	/**
//	 * gets the author by authorId
//	 *
//	 * @param \PDO $pdo PDO connection object
//	 * @param Uuid|string $authorId author id to search for
//	 * @return author|null author found or null if not found
//	 * @throws \PDOException when mySQL related errors occur
//	 * @throws \TypeError when a variable are not the correct data type
//	 **/
//	public static function getAuthorByAuthorId(\PDO $pdo, $authorId) : ?author {
//		// sanitize the authorId before searching
//		try {
//			$authorId = self::validateUuid($authorId);
//		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
//			throw(new \PDOException($exception->getMessage(), 0, $exception));
//		}
//
//		// create query template
//		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
//		$statement = $pdo->prepare($query);
//
//		// bind the author id to the place holder in the template
//		$parameters = ["authorId" => $authorId->getBytes()];
//		$statement->execute($parameters);
//
//		// grab the author from mySQL
//		try {
//			$author = null;
//			$statement->setFetchMode(\PDO::FETCH_ASSOC);
//			$row = $statement->fetch();
//			if($row !== false) {
//				$author = new author($row["authorId"], $row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
//			}
//		} catch(\Exception $exception) {
//			// if the row couldn't be converted, rethrow it
//			throw(new \PDOException($exception->getMessage(), 0, $exception));
//		}
//		return($author);
//	}
//
//	/**
//	 * gets the author by avatar url
//	 *
//	 * @param \PDO $pdo PDO connection object
//	 * @param string $authorAvatarUrl to search for
//	 * @return \SplFixedArray SplFixedArray of authors found
//	 * @throws \PDOException when mySQL related errors occur
//	 * @throws \TypeError when variables are not the correct data type
//	 **/
//	public static function getAuthorByAuthorAvatarUrl(\PDO $pdo, string $authorAvatarUrl) : \SplFixedArray {
//		// sanitize the description before searching
//			$authorAvatarUrl = trim($authorAvatarUrl);
//			$authorAvatarUrl = filter_var($authorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//		if(empty($authorAvatarUrl) === true) {
//			throw(new \PDOException("avatar url is invalid"));
//		}
//
//		// escape any mySQL wild cards
//			$authorAvatarUrl = str_replace("_", "\\_", str_replace("%", "\\%", $authorAvatarUrl));
//
//		// create query template
//		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorActivationUrl LIKE :authorAvatarUrl";
//		$statement = $pdo->prepare($query);
//
//		// bind the avatar url to the place holder in the template
//			$authorAvatarUrl = "%$authorAvatarUrl%";
//		$parameters = ["authorAvatarUrl" => $authorAvatarUrl];
//		$statement->execute($parameters);
//
//		// build an array of avatar urls
//		$authors = new \SplFixedArray($statement->rowCount());
//		$statement->setFetchMode(\PDO::FETCH_ASSOC);
//		while(($row = $statement->fetch()) !== false) {
//			try {
//				$author = new author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
//				$authors[$authors->key()] = $author;
//				$authors->next();
//			} catch(\Exception $exception) {
//				// if the row couldn't be converted, rethrow it
//				throw(new \PDOException($exception->getMessage(), 0, $exception));
//			}
//		}
//		return($authors);
//	}
//
//		/**
//		 * gets the author by activation token
//		 *
//		 * @param \PDO $pdo PDO connection object
//		 * @param string $authorActivationToken to search for
//		 * @return \SplFixedArray SplFixedArray of authors found
//		 * @throws \PDOException when mySQL related errors occur
//		 * @throws \TypeError when variables are not the correct data type
//		 **/
//		public static function getAuthorByAuthorActivationToken(\PDO $pdo, string $authorActivationToken) : \SplFixedArray {
//			// sanitize the description before searching
//			$authorActivationToken = trim($authorActivationToken);
//			$authorActivationToken = filter_var($authorActivationToken, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//			if(empty($authorActivationToken) === true) {
//				throw(new \PDOException("activation token is invalid"));
//			}
//
//			// escape any mySQL wild cards
//			$authorActivationToken = str_replace("_", "\\_", str_replace("%", "\\%", $authorActivationToken));
//
//			// create query template
//			$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorActivationToken LIKE :authorActivationToken";
//			$statement = $pdo->prepare($query);
//
//			// bind the activation token to the place holder in the template
//			$authorActivationToken = "%$authorActivationToken%";
//			$parameters = ["authorActivationToken" => $authorActivationToken];
//			$statement->execute($parameters);
//
//			// build an array of activation tokens
//			$authors = new \SplFixedArray($statement->rowCount());
//			$statement->setFetchMode(\PDO::FETCH_ASSOC);
//			while(($row = $statement->fetch()) !== false) {
//				try {
//					$author = new author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
//					$authors[$authors->key()] = $author;
//					$authors->next();
//				} catch(\Exception $exception) {
//					// if the row couldn't be converted, rethrow it
//					throw(new \PDOException($exception->getMessage(), 0, $exception));
//				}
//			}
//			return($authors);
//		}
//
//		/**
//		 * gets the author by email
//		 *
//		 * @param \PDO $pdo PDO connection object
//		 * @param string $authorEmail to search for
//		 * @return \SplFixedArray SplFixedArray of authors found
//		 * @throws \PDOException when mySQL related errors occur
//		 * @throws \TypeError when variables are not the correct data type
//		 **/
//		public static function getAuthorByAuthorEmail(\PDO $pdo, string $authorEmail) : \SplFixedArray {
//			// sanitize the description before searching
//			$authorEmail = trim($authorEmail);
//			$authorEmail = filter_var($authorEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//			if(empty($authorEmail) === true) {
//				throw(new \PDOException("email is invalid"));
//			}
//
//			// escape any mySQL wild cards
//			$authorEmail = str_replace("_", "\\_", str_replace("%", "\\%", $authorEmail));
//
//			// create query template
//			$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorEmail LIKE :authorEmail";
//			$statement = $pdo->prepare($query);
//
//			// bind the email to the place holder in the template
//			$authorEmail = "%$authorEmail%";
//			$parameters = ["authorEmail" => $authorEmail];
//			$statement->execute($parameters);
//
//			// build an array of activation tokens
//			$authors = new \SplFixedArray($statement->rowCount());
//			$statement->setFetchMode(\PDO::FETCH_ASSOC);
//			while(($row = $statement->fetch()) !== false) {
//				try {
//					$author = new author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
//					$authors[$authors->key()] = $author;
//					$authors->next();
//				} catch(\Exception $exception) {
//					// if the row couldn't be converted, rethrow it
//					throw(new \PDOException($exception->getMessage(), 0, $exception));
//				}
//			}
//			return($authors);
//		}
//
//		/**
//		 * gets the author by hash
//		 *
//		 * @param \PDO $pdo PDO connection object
//		 * @param string $authorHash to search for
//		 * @return \SplFixedArray SplFixedArray of authors found
//		 * @throws \PDOException when mySQL related errors occur
//		 * @throws \TypeError when variables are not the correct data type
//		 **/
//		public static function getAuthorByAuthorHash(\PDO $pdo, string $authorHash) : \SplFixedArray {
//			// sanitize the description before searching
//			$authorHash = trim($authorHash);
//			$authorHash = filter_var($authorHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//			if(empty($authorHash) === true) {
//				throw(new \PDOException("hash is invalid"));
//			}
//
//			// escape any mySQL wild cards
//			$authorHash = str_replace("_", "\\_", str_replace("%", "\\%", $authorHash));
//
//			// create query template
//			$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorHash LIKE :authorHash";
//			$statement = $pdo->prepare($query);
//
//			// bind the hash to the place holder in the template
//			$authorHash = "%$authorHash%";
//			$parameters = ["authorHash" => $authorHash];
//			$statement->execute($parameters);
//
//			// build an array of activation tokens
//			$authors = new \SplFixedArray($statement->rowCount());
//			$statement->setFetchMode(\PDO::FETCH_ASSOC);
//			while(($row = $statement->fetch()) !== false) {
//				try {
//					$author = new author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
//					$authors[$authors->key()] = $author;
//					$authors->next();
//				} catch(\Exception $exception) {
//					// if the row couldn't be converted, rethrow it
//					throw(new \PDOException($exception->getMessage(), 0, $exception));
//				}
//			}
//			return($authors);
//		}
//
//		/**
//		 * gets the author by Username
//		 *
//		 * @param \PDO $pdo PDO connection object
//		 * @param string $authorUsername to search for
//		 * @return \SplFixedArray SplFixedArray of authors found
//		 * @throws \PDOException when mySQL related errors occur
//		 * @throws \TypeError when variables are not the correct data type
//		 **/
//		public static function getAuthorByAuthorUsername(\PDO $pdo, string $authorUsername) : \SplFixedArray {
//			// sanitize the description before searching
//			$authorUsername = trim($authorUsername);
//			$authorUsername = filter_var($authorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//			if(empty($authorUsername) === true) {
//				throw(new \PDOException("username is invalid"));
//			}
//
//			// escape any mySQL wild cards
//			$authorUsername = str_replace("_", "\\_", str_replace("%", "\\%", $authorUsername));
//
//			// create query template
//			$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author WHERE authorUsername LIKE :authorUsername";
//			$statement = $pdo->prepare($query);
//
//			// bind the username to the place holder in the template
//			$authorUsername = "%$authorUsername%";
//			$parameters = ["authorUsername" => $authorUsername];
//			$statement->execute($parameters);
//
//			// build an array of activation tokens
//			$authors = new \SplFixedArray($statement->rowCount());
//			$statement->setFetchMode(\PDO::FETCH_ASSOC);
//			while(($row = $statement->fetch()) !== false) {
//				try {
//					$author = new author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
//					$authors[$authors->key()] = $author;
//					$authors->next();
//				} catch(\Exception $exception) {
//					// if the row couldn't be converted, rethrow it
//					throw(new \PDOException($exception->getMessage(), 0, $exception));
//				}
//			}
//			return($authors);
//		}
//
//	/**
//	 * gets all authors
//	 *
//	 * @param \PDO $pdo PDO connection object
//	 * @return \SplFixedArray SplFixedArray of authors found or null if not found
//	 * @throws \PDOException when mySQL related errors occur
//	 * @throws \TypeError when variables are not the correct data type
//	 **/
//	public static function getAllAuthors\PDO $pdo) : \SPLFixedArray {
//		// create query template
//		$query = "SELECT authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername FROM author";
//		$statement = $pdo->prepare($query);
//		$statement->execute();
//
//		// build an array of authors
//		$authors = new \SplFixedArray($statement->rowCount());
//		$statement->setFetchMode(\PDO::FETCH_ASSOC);
//		while(($row = $statement->fetch()) !== false) {
//			try {
//				$author = new author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
//				$authorss[$authorss->key()] = $author;
//				$authors->next();
//			} catch(\Exception $exception) {
//				// if the row couldn't be converted, rethrow it
//				throw(new \PDOException($exception->getMessage(), 0, $exception));
//			}
//		}
//		return ($authors);
//	}

//	/**
//	 * formats the state variables for JSON serialization
//	 *
//	 * @return array resulting state variables to serialize
//	 **/
//	public function jsonSerialize() : array {
//		$fields = get_object_vars($this);
//
//		$fields["authorId"] = $this->authorId->toString();
//		$fields["authorAvatarUrl"] = $this->authorAvatarUrl->toString();
//		$fields["authorActivationToken"] = $this->authorActivationToken->toString();
//		$fields["authorEmail"] = $this->authorId->authorEmail();
//		$fields["authorHash"] = $this->authorId->authorHash();
//		$fields["authorUsername"] = $this->authorId->authorUsername();
//
//	}
}