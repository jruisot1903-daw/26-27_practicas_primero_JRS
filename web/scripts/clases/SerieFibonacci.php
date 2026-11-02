<?php
class SerieFibonacci implements Iterator
{
    private int $_limite;
    private int $_claveActual = 0;
    private array $_valores = [];

    public function __construct(int $limite)
    {
        $this->_limite = $limite;
        $this->_valores = [0, 1]; // Inicializamos los dos primeros valores
    }

    // Métodos de la interfaz Iterator
    public function current(): int
    {
        return $this->_valores[$this->_claveActual];
    }

    public function key(): int
    {
        return $this->_claveActual;
    }

    public function next(): void
    {
        $this->_claveActual++;
        if (!isset($this->_valores[$this->_claveActual])) {
            $this->_valores[$this->_claveActual] =
                $this->_valores[$this->_claveActual - 1] +
                $this->_valores[$this->_claveActual - 2];
        }
    }

    public function rewind(): void
    {
        $this->_claveActual = 0;
    }

    public function valid(): bool
    {
        return $this->_claveActual <= $this->_limite;
    }

    // Función estática con generador
    public static function fFibonacci(int $ultimo): Generator
    {
        $a = 0;
        $b = 1;
        yield $a; // F(0)
        yield $b; // F(1)

        for ($i = 2; $i <= $ultimo; $i++) {
            $siguiente = $a + $b;
            yield $siguiente;
            $a = $b;
            $b = $siguiente;
        }
    }
}