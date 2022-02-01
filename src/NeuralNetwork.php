<?php

namespace Westacks\FANN;

use Westacks\FANN\Traits\TrainsNeuralNetwork;

class NeuralNetwork
{
    use TrainsNeuralNetwork;

    /**
     * FANN instance.
     *
     * @var resource
     */
    protected $ann;

    public function __construct(protected array $config)
    {
        // TODO: Create ANN using config

        $this->trainCallback = fn ($data) => $data;
    }

    public function __destruct()
    {
        fann_destroy($this->ann);
    }
}