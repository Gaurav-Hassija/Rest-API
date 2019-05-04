<?php
	class Movie
	{
		private $conn;
		private $table = 'movies';

		public $id;
		public $name;
		public $genre;
		public $language;
		public $runtime;

		//constructor
		public function __construct($db) {
			$this->conn = $db;
		}

		public function read()
		{
			$query = 'SELECT id, name, language, genre, runtime FROM ' . $this->table;

			$stmt = $this->conn->prepare($query);
			$stmt -> execute();

			return $stmt;
		}

		public function create()
		{
			$query = 'INSERT INTO ' . $this->table . ' SET name = :name, language = :language, genre = :genre, runtime = :runtime';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':language', $this->language);
			$stmt->bindParam(':genre', $this->genre);
			$stmt->bindParam(':runtime', $this->runtime);
			
			if($stmt->execute())
			{
				return true;
			}

			printf("Error: %s./n",$stmt->error);
			return false;
		}

		public function update()
		{
			$query = 'UPDATE ' . $this->table . ' SET name = :name, language = :language, genre = :genre, runtime = :runtime WHERE id = :id';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':language', $this->language);
			$stmt->bindParam(':genre', $this->genre);
			$stmt->bindParam(':runtime', $this->runtime);
			$stmt->bindParam(':id', $this->id);
			
			
			if($stmt->execute())
			{
				return true;
			}

			printf("Error: %s./n",$stmt->error);
			return false;
		}

		public function delete()
		{
			$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':id', $this->id);
			
			if($stmt->execute())
			{
				return true;
			}

			printf("Error: %s./n",$stmt->error);
			return false;
		}
	}
?>