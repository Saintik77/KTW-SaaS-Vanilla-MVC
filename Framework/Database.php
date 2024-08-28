<?php
/**
 * Database Access Class
 *
 * Provides the database access tools used by our micro-framework
 *
 * DESCRIPTION OF THE PURPOSE AND USE OF THE CODE
 * MAY BE MORE THAN ONE LINE LONG
 * KEEP LINE LENGTH TO NO MORE THAN 96 CHARACTERS
 *
 * Filename:        Database.php
 * Location:        /Framework/
 * Project:         KTW-SaaS-Vanilla-MVC
 * Date Created:    28/8/2024
 *
 * Author:          Kobe Williams
 *
 */

namespace Framework;

use Exception;
use PDO;
use PDOStatement;
use PDOException;

class Database
{
    /**
     * Connection Property
     *
     * @var PDO
     */
    public PDO $conn;
    /**
     * Constructor for Database class
     *
     * @param array $config
     * @throws Exception
     */
    public function __construct($config)
    {
        $host = $config['host'];
        $port = $config['port'];
        $dbname = $config['dbname'];

        // Data Source Name ==dsn
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        $userName = $config['username'];
        $userPass = $config['password'];
        try {
            $this->conn = new PDO($dsn, $userName, $userPass, $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }

    /**
     * Query the database
     *
     * The SQL to execute and an optional array of named parameters and values
     * are required.
     *
     * Use:
     * <code>
     *   $sql = "SELECT name, description from products WHERE name like '%:name%'";
     *   $filter = ['name'=>'ian',];
     *   $results = $dbConn->query($sql,$filter);
     * </code>
     *
     * @param string $query
     * @param array $params []|[associative array of parameter names and values]
     *
     * @return PDOStatement
     * @throws PDOException|Exception
     */

    public function query($query, $params = [])
    {
        try {
            $sth = $this->conn->prepare($query);

            // Bind named params
            foreach ($params as $param => $value) {
                $sth->bindValue(':' . $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute: {$e->getMessage()}");
        }
    }
}