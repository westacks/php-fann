<?php

namespace Westacks\FANN\Traits;

trait TrainsNeuralNetwork
{
    /**
     * FANN instance.
     *
     * @var resource
     */
    protected $ann;

    /**
     * Dataset to train FANN.
     *
     * @var array
     */
    protected $trainDataset = [];

    /**
     * Callback function that used over train data
     *
     * @var callable
     */
    protected $trainCallback;

    /**
     * Add data on the dataset to neural network.
     *
     * @param float|float[] $expect Expected output.
     * @param mixed $input Input.
     * @return self
     */
    public function addTrainData($input, $expect)
    {
        if (!is_array($expect)) $expect = [$expect];

        $callback = $this->trainCallback ?? fn ($data) => $data;
        $input = $callback($input);

        $this->trainDataset[] = compact('input', 'expect');

        return $this;
    }

    public function train($max_epoch, $epoch_between_errors, $desired_error)
    {
        return fann_train_on_data($this->ann, $this->trainDataset, $max_epoch, $epoch_between_errors, $desired_error);
    }

    public function setTrainingAlgorithm(int $training_algorithm)
    {
        return fann_set_training_algorithm($this->ann, $training_algorithm);
    }
}