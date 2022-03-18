<?php

namespace Soandso\LaravelOptions;

use Exception;
use Soandso\LaravelOptions\Models\Option;

/**
 * Class OptionService contains methods for working with arbitrary options
 *
 * Any arbitrary option is represented in the format key => value. The key and value values are in string format
 *
 * @author Dmytriyenko Vyacheslav <dmytriyenko.vyacheslav@gmail.com>
 */
class OptionService
{
    /**
     * Sets the value of a parameter by its key
     *
     * @param string $key Parameter key
     * @param string|array $value Parameter value
     * @return bool
     * @throws Exception
     */
    public function setData(string $key, $value)
    {
        if ($this->isValidData($value) === false) {
            throw new Exception('The data format is not supported. Available string and array');
        }

        if ($this->getData($key) !== false) {
            return $this->updateData($key, $value);
        } else {
            return $this->createData($key, $value);
        }
    }

    /**
     * Returns the value of the parameter by its key
     *
     * @param string $key Parameter key
     * @return false|mixed
     */
    public function getData(string $key)
    {
        $option = Option::select(['value'])->where('key', $key)->first();
        if (is_null($option)) {
            return false;
        }

        $output = json_decode($option->value, true);
        return $output;
    }

    /**
     * Create an entry for a parameter
     *
     * @param string $key Parameter key
     * @param string|array $valueData Parameter value
     * @return bool
     */
    protected function createData(string $key, $valueData) : bool
    {
        if (Option::create([
            'key' => $key,
            'value' => json_encode($valueData),
        ])) {
            return true;
        }

        return false;
    }

    /**
     * Updates the value of the parameter in storage
     *
     * @param string $key Parameter key
     * @param string|array $value Parameter value
     * @return bool
     */
    protected function updateData(string $key, $value) : bool
    {
        if (Option::where('key', $key)->update(['value' => json_encode($value)]) === false) {
            return false;
        }

        return true;
    }

    /**
     * Checks the validity of the data to save
     *
     * @param string|array $data Parameter value
     * @return bool
     */
    protected function isValidData($data) : bool
    {
        if (is_string($data)) {
            return true;
        }

        if (is_array($data)) {
            return true;
        }

        return false;
    }
}