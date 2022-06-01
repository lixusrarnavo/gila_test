<?php

class DB
{

  protected $dbh;

  public function __construct()
  {
    try {
      $dsn = "mysql:host=sql5.freemysqlhosting.net;dbname=sql5496946;port=3306";
      $this->dbh = new PDO($dsn, 'sql5496946', 'euPRwgkx2c');
    } catch (PDOException $e){
      echo $e->getMessage();
    }
  }

  public function query (string $query)
  {
    $this->execute($query);
    return $data = $this->stmt->fetchAll(PDO::FETCH_ASSOC);;
  }

  public function insertProducto(
    string $nombre,
    string $sku,
    string $marca,
    float $costo,
    int $id_categoria,
    int $id_caracteristica,
    string $descripcion
    ): bool {
      $stmt = $this->dbh->prepare("
        INSERT INTO
        productos
        (nombre, sku, marca, costo, id_categoria, id_caracteristica, descripcion)
        VALUES
        (?, ?, ?, ?, ?, ?, ?)
      ");

      $stmt->bindParam(1, $nombre);
      $stmt->bindParam(2, $sku);
      $stmt->bindParam(3, $marca);
      $stmt->bindParam(4, $costo);
      $stmt->bindParam(5, $id_categoria);
      $stmt->bindParam(6, $id_caracteristica);
      $stmt->bindParam(7, $descripcion);

      $stmt->execute();

      return true;
  }

  protected function execute(string $query)
  {
    $this->stmt = $this->dbh->prepare($query);
    // Especificamos el fetch mode antes de llamar a fetch()
    $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
    // Ejecutamos
    $this->stmt->execute();
  }
}
