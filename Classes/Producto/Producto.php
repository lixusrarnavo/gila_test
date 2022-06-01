<?php

class Producto
{
  protected string $nombre;

  protected string $sku;

  protected string $marca;

  protected float $costo;

  protected int $id_categoria;

  protected int $id_caracteristica;

  protected string $descripcion;

  protected array $data;

  public function __construct()
  {
    $this->db = new DB();
  }

  public function setNombre(string $nombre): void
  {
    $this->nombre = $nombre;
  }

  public function setSku(string $sku): void
  {
    $this->sku = $sku;
  }

  public function setMarca(string $marca): void
  {
    $this->marca = $marca;
  }

  public function setIdCategoria(int $id_categoria): void
  {
    $this->id_categoria = $id_categoria;
  }

  public function setIdCaracteristica(int $id_caracteristica): void
  {
    $this->id_caracteristica = $id_caracteristica;
  }

  public function setDescripcion(string $descripcion): void
  {
    $this->descripcion = $descripcion;
  }

  public function setCosto(float $costo): void
  {
    $this->costo = $costo;
  }

  public function getNombre(): string
  {
    return $this->nombre;
  }

  public function getSku(): string
  {
    return $this->sku;
  }

  public function getMarca(): string
  {
    return $this->marca;
  }

  public function getIdCategoria(): int
  {
    return $this->id_categoria;
  }

  public function getIdCaracteristica(): int
  {
    return $this->id_caracteristica;
  }

  public function getDescripcion(): string
  {
    return $this->descripcion;
  }

  public function getCosto(): float
  {
    return $this->costo;
  }

  public function getData(): array
  {
    return $this->data;
  }
}
