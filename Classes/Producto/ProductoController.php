<?php

class ProductoController
{

  protected DB $db;

    public function __construct()
    {
      $this->db = new DB();
    }

    public function getCategorias(): array
    {
      return $this->db->query("
        SELECT
          *
        FROM
          categoria
        ");
    }

    public function getCaracteristicas(int $id): array
    {
      return $this->db->query("
        SELECT
          *
        FROM
          caracteristica
        WHERE
          id_categoria = " . $id . "
      ");
    }

    public function getProductos(): array
    {
      $data = $this->db->query("
        SELECT
          p.*,
          c.descripcion as categoria,
          cc.descripcion as caracteristica
        FROM
          productos p
        LEFT JOIN
          categoria c ON c.id = p.id_categoria
        LEFT JOIN
          caracteristica cc on cc.id = p.id_caracteristica
      ");

      foreach ($data as &$dat) {
        switch ($dat['id_caracteristica']) {
          case 1:
            $margen = 0.35;
            break;
          case 2:
            $margen = 0.4;
            break;
          case 3:
            $margen = 0.3;
            break;
        }
        $dat['margen'] = $dat['costo'] * 0.3;
      }

      return $data;
    }
}
