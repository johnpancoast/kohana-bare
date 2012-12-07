<?php

/**
 * simple debug print function
 */
function d($data, $prefix = '')
{
	echo ( ! empty($prefix) ? $prefix : '').Debug::vars($data);
}
