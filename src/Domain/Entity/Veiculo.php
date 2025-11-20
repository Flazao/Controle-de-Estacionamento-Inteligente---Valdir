<?php
namespace Domain\Entity;

class Veiculo
{
    private string $placa;
    private string $tipo;

    public function __construct(string $placa, string $tipo)
    {
        $this->placa = $placa;
        $this->tipo = $tipo;
    }

    public function getPlaca(): string
    {
        return $this->placa;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }
}
