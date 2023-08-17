<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "admin@123";
    private $dbname = "sports";

    private $conn;

    public function connect()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            return false;
        }

        return true;
    }

    public function update($table, $field, $value, $user_id)
    {
        $query = "UPDATE $table SET $field = ? WHERE user_id = ?";
        $params = [$value, $user_id];

        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $types = "si"; // "s" for string and "i" for integer, adjust accordingly
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
        }

        return false;
    }

    public function close()
    {
        $this->conn->close();
    }
}
?>
