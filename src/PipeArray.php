<?php

namespace AZnC\PipeArray;


class PipeArray implements \ArrayAccess, \Countable
{
    /**
     * @var array
     */
    protected $container;

    public function __construct($elements = array())
    {
        if (is_array($elements)) {
            $this->container = $elements;
        } else {
            $this->container = array($elements);
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return ($offset < $this->count());
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return count($this->container);
    }

    /**
     * @param int $case
     * @return PipeArray
     */
    public function changeKeyCase($case = CASE_LOWER)
    {
        return new self(array_change_key_case($this->container, $case));
    }

    /**
     * aliases of changeKeyCase
     * @param int $case
     * @return PipeArray
     */
    public function change_key_case($case = CASE_LOWER)
    {
        return $this->changeKeyCase($case);
    }

    /**
     * @param $column_key
     * @param null $index_key
     * @return PipeArray
     */
    public function column($column_key, $index_key = null)
    {
        return new self(array_column($this->container, $column_key, $index_key));
    }

    /**
     * @return PipeArray
     */
    public function countValues()
    {
        return new self(array_count_values($this->container));
    }

    /**
     * aliases of countValues
     * @return PipeArray
     */
    public function count_values()
    {
        return $this->countValues();
    }

    /**
     * @param $func
     * @return PipeArray
     */
    public function filter($func)
    {
        return new self(array_filter($this->container, $func));
    }

    /**
     * @return PipeArray
     */
    public function flip()
    {
        return new self(array_flip($this->container));
    }

    /**
     * @param $key
     * @return bool
     */
    public function keyExists($key)
    {
        return array_key_exists($key, $this->container);
    }

    /**
     * aliases of keyExists
     * @param $key
     * @return bool
     */
    public function key_exists($key)
    {
        return $this->keyExists($key);
    }

    /**
     * @param null $search_value
     * @param bool $strict
     * @return PipeArray
     */
    public function keys($search_value = null, $strict = false)
    {
        return new self(array_keys($this->container, $search_value, $strict));
    }

    /**
     * @param $func
     * @return PipeArray
     */
    public function map($func)
    {
        return new self(array_map($func, $this->container));
    }

    /**
     * @param $size
     * @param $value
     * @return PipeArray
     */
    public function pad($size, $value)
    {
        return new self(array_pad($this->container, $size, $value));
    }

    /**
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->container);
    }

    /**
     * @return number
     */
    public function product()
    {
        return array_product($this->container);
    }

    /**
     * @param $value
     * @return int
     */
    public function push($value)
    {
        $args = func_get_args();

        return call_user_func_array("array_push", array_merge(array(&$this->container), $args));
    }

    /**
     * @param int $num
     * @return mixed
     */
    public function rand($num = 1)
    {
        return array_rand($this->container, $num);
    }

    /**
     * @param $func
     * @return PipeArray
     */
    public function reduce($func)
    {
        return new self(array_reduce($func, $this->container));
    }

    /**
     * @param bool $preserve_keys
     * @return PipeArray
     */
    public function reverse($preserve_keys = false)
    {
        return new self(array_reverse($this->container, $preserve_keys));
    }

    /**
     * @param $needle
     * @param bool $strict
     * @return mixed
     */
    public function search($needle, $strict = false)
    {
        return array_search($needle, $this->container, $strict);
    }

    /**
     * @return mixed
     */
    public function shift()
    {
        return array_shift($this->container);
    }

    /**
     * @param $offset
     * @param null $length
     * @param bool $preserve_keys
     * @return PipeArray
     */
    public function slice($offset, $length = NULL, $preserve_keys = false)
    {
        return new self(array_slice($this->container, $offset, $length, $preserve_keys));
    }

    /**
     * @param $offset
     * @param null $length
     * @param null $replacement
     * @return PipeArray
     */
    public function splice($offset, $length = NULL, $replacement = NULL)
    {
        return new self(array_splice($this->container, $offset, $length, $replacement));
    }

    /**
     * @return number
     */
    public function sum()
    {
        return array_sum($this->container);
    }

    /**
     * @param int $sort_flags
     * @return PipeArray
     */
    public function unique($sort_flags = SORT_STRING)
    {
        return new self(array_unique($this->container, $sort_flags));
    }

    /**
     * @return int
     */
    public function unshift()
    {
        $args = func_get_args();

        return call_user_func_array("array_unshift", array_merge(array(&$this->container), $args));
    }

    /**
     * @return PipeArray
     */
    public function values()
    {
        return new self(array_values($this->container));
    }

    /**
     * @param $callback
     * @param null $userdata
     * @return bool
     */
    public function walkRecursive($callback, $userdata = NULL)
    {
        return array_walk_recursive($callback, $userdata);
    }

    /**
     * aliases of walkRecursive
     * @param $callback
     * @param null $userdata
     * @return bool
     */
    public function walk_recursive($callback, $userdata = NULL)
    {
        return $this->walkRecursive($callback, $userdata);
    }

    /**
     * @param $callback
     * @param null $userdata
     * @return bool
     */
    public function walk($callback, $userdata = NULL)
    {
        return array_walk($this->container, $callback, $userdata);
    }

    /**
     * @param int $sort_flags
     * @return bool
     */
    public function arsort($sort_flags = SORT_REGULAR)
    {
        return arsort($this->container, $sort_flags);
    }

    /**
     * @param int $sort_flags
     * @return bool
     */
    public function asort($sort_flags = SORT_REGULAR)
    {
        return asort($this->container, $sort_flags);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->container);
    }

    /**
     * @return array
     */
    public function each()
    {
        return each($this->container);
    }

    /**
     * @return mixed
     */
    public function end()
    {
        return end($this->container);
    }

    /**
     * @param $needle
     * @param bool $strict
     * @return bool
     */
    public function inArray($needle, $strict = FALSE)
    {
        return in_array($needle, $this->container, $strict);
    }

    /**
     * aliases of inArray
     * @param $needle
     * @param bool $strict
     * @return bool
     */
    public function in_array($needle, $strict = FALSE)
    {
        return $this->inArray($needle, $strict);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->container);
    }

    /**
     * @param int $sort_flags
     * @return bool
     */
    public function krsort($sort_flags = SORT_REGULAR)
    {
        return krsort($this->container, $sort_flags);
    }

    /**
     * @param int $sort_flags
     * @return bool
     */
    public function ksort($sort_flags = SORT_REGULAR)
    {
        return ksort($this->container, $sort_flags);
    }

    /**
     * @return bool
     */
    public function natcasesort()
    {
        return natcasesort($this->container);
    }

    /**
     * @return bool
     */
    public function natsort()
    {
        return natsort($this->container);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->container);
    }

    /**
     * @return mixed
     */
    public function pos()
    {
        return current($this->container);
    }

    /**
     * @return mixed
     */
    public function prev()
    {
        return prev($this->container);
    }

    /**
     * @return mixed
     */
    public function reset()
    {
        return reset($this->container);
    }

    /**
     * @param int $sort_flags
     * @return bool
     */
    public function rsort($sort_flags = SORT_REGULAR)
    {
        return rsort($this->container, $sort_flags);
    }

    /**
     * @return bool
     */
    public function shuffle()
    {
        return shuffle($this->container);
    }

    /**
     * @return int
     */
    public function size()
    {
        return sizeof($this->container);
    }

    /**
     * @param int $sort_flags
     * @return bool
     */
    public function sort($sort_flags = SORT_REGULAR)
    {
        return sort($this->container, $sort_flags);
    }

    /**
     * @param $value_compare_func
     * @return bool
     */
    public function uasort($value_compare_func)
    {
        return uasort($this->container, $value_compare_func);
    }

    /**
     * @param $value_compare_func
     * @return bool
     */
    public function uksort($value_compare_func)
    {
        return uksort($this->container, $value_compare_func);
    }

    /**
     * @param $value_compare_func
     * @return bool
     */
    public function usort($value_compare_func)
    {
        return usort($this->container, $value_compare_func);
    }

    /**
     * @param $pattern
     * @return PipeArray
     */
    public function grep($pattern)
    {
        return new self(preg_grep($pattern, $this->container));
    }

    /**
     * @return array
     */
    public function rawData()
    {
        return $this->container;
    }
}