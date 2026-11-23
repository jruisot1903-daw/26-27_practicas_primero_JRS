<?php

class Punto
{
    public const COLORES = [
        "black" => ["nombre" => "negro", "rgb" => [0, 0, 0]],
        "red" => ["nombre" => "rojo", "rgb" => [255, 0, 0]],
        "green" => ["nombre" => "verde", "rgb" => [0, 255, 0]],
        "blue" => ["nombre" => "azul", "rgb" => [0, 0, 255]],
        "yellow" => ["nombre" => "amarillo", "rgb" => [255, 255, 0]],
    ];

    public const GROSORES = [
        1 => "fino",
        2 => "medio",
        3 => "grueso"
    ];

    private int $x;
    private int $y;
    private string $color;
    private int $grosor;

    public function __construct(int $x, int $y, string $color, int $grosor)
    {
        if (!$this->setX($x) || !$this->setY($y) || !$this->setColor($color) || !$this->setGrosor($grosor)) {
            throw new Exception("Valores inválidos al crear el punto.");
        }
    }

    public function setX(int $x): bool
    {
        if ($x >= 0 && $x <= 20000) {
            $this->x = $x;
            return true;
        }
        return false;
    }

    public function setY(int $y): bool
    {
        if ($y >= 0 && $y <= 20000) {
            $this->y = $y;
            return true;
        }
        return false;
    }

    public function setColor(string $color): bool
    {
        if (array_key_exists($color, self::COLORES)) {
            $this->color = $color;
            return true;
        }
        return false;
    }

    public function setGrosor(int $grosor): bool
    {
        if (array_key_exists($grosor, self::GROSORES)) {
            $this->grosor = $grosor;
            return true;
        }
        return false;
    }

    public function getX(): int { return $this->x; }
    public function getY(): int { return $this->y; }
    public function getColor(): string { return $this->color; }
    public function getGrosor(): int { return $this->grosor; }

    public function __toString(): string
{
    return "{$this->x} ; {$this->y} ; {$this->color} ; {$this->grosor}";
}

public function __set($nombre, $valor): void
{
    throw new Exception("No se pueden crear propiedades dinámicas.");
}

}