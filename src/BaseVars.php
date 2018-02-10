<?php
namespace KlikFlight;
class BaseVars{
	protected $__vars;
    /**
     * Gets a variable.
     *
     * @param string $key Key
     * @return mixed
     */
    final public function getVar($key = null) {
        if ($key === null) return $this->__vars;

        return isset($this->__vars[$key]) ? $this->__vars[$key] : null;
    }

    /**
     * Sets a variable.
     *
     * @param mixed $key Key
     * @param string $value Value
     */
    final public function setVar($key, $value = null) {
        if (is_array($key) || is_object($key)) {
            foreach ($key as $k => $v) {
                $this->__vars[$k] = $v;
            }
        }
        else {
            $this->__vars[$key] = $value;
        }
    }

    /**
     * Checks if a variable has been set.
     *
     * @param string $key Key
     * @return bool Variable status
     */
    final public function hasVar($key) {
        return isset($this->__vars[$key]);
    }

    /**
     * Unsets a variable. If no key is passed in, clear all variables.
     *
     * @param string $key Key
     */
    final public function clearVar($key = null) {
        if (is_null($key)) {
            $this->__vars = array();
        }
        else {
            unset($this->__vars[$key]);
        }
    }
}