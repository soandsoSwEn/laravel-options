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
    public function set(string $key, $value) : bool
    {
        if ($this->isValidData($value) === false) {
            throw new Exception('The data format is not supported. Available string and array');
        }

        if ($this->get($key) !== false) {
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
    public function get(string $key)
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

    /**
     * Deletes parameter entries
     *
     * All entries older than the specified date are deleted.
     * If the date is not specified, then all parameters are deleted.
     *
     * @param string|null $date
     * @return bool
     */
    public function destroy(string $date = null) : bool
    {
        if (app()->runningInConsole() === false) {
            return false;
        }

        if (is_null($date)) {
            if (Option::query()->delete() === false) {
                return false;
            }
        } else {
            if (Option::where('updated_at', '<', $date)->delete() === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Deletes a parameter by its key
     *
     * @param string $key Parameter key
     * @return bool
     */
    public function destroyByKey(string $key) : bool
    {
        if (Option::where('key', $key)->delete()) {
            return true;
        }

        return false;
    }

    /**
     * Checks if the parameter with the given key exists
     *
     * @param string $key Parameter key
     * @return bool
     */
    public function exists(string $key) : bool
    {
        if (is_null(Option::where('key', $key)->first())) {
            return false;
        }

        return true;
    }
}