<?php

namespace Illuminate\Contracts;

interface Ajax
{
	/**
	 * registra las ajax
	 */
	static function registerAjax();

	/**
	 * metodo de respuesta del ayax
	 */
	static function privMethod();

	/**
	 * metodo de respuesta del ayax no privado  
	 */
	static function noPrivMethod();
}
