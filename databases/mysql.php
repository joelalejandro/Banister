<?php
namespace Banister;

class MysqlDatabase {
  private $_settings;
  private $_pdo;

  public function __construct($connectionSettings) {
    $this->_settings = $connectionSettings;
  }

  public function connect() {
    $this->_pdo = new \PDO(
      "mysql:host={$this->_settings->host};dbname={$this->_settings->schema}",
      $this->_settings->username,
      $this->_settings->password,
      isset($this->_settings->charset) ? array(1002 => "SET NAMES {$this->_settings->charset}") : array()
    );
    $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
    $this->_pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
  }

  public function handler() {
    return $this->_pdo;
  }

  public function close() {
    unset($this->_pdo);
    $this->_pdo = null;
  }
}