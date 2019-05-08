<?php
/**
 * User: kazak
 * Email: mk@altrecipe.com
 * Date: 2019-05-08
 * Time: 13:47
 */

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\View\View;

if (! function_exists('app')) {
	/**
	 * Get the available container instance.
	 *
	 * @param string $abstract
	 * @param array $parameters
	 *
	 * @return mixed|Application
	 * @throws BindingResolutionException
	 */
	function app($abstract = null, array $parameters = [])
	{
		if (is_null($abstract)) {
			return Container::getInstance();
		}

		return Container::getInstance()->make($abstract, $parameters);
	}
}

if (! function_exists('config')) {
	/**
	 * Get / set the specified configuration value.
	 *
	 * If an array is passed as the key, we will assume you want to set an array of values.
	 *
	 * @param array|string $key
	 * @param mixed $default
	 *
	 * @return mixed
	 * @throws BindingResolutionException
	 */
	function config($key = null, $default = null)
	{
		if (is_null($key)) {
			return app('config');
		}

		if (is_array($key)) {
			return app('config')->set($key);
		}

		/** @noinspection PhpMethodParametersCountMismatchInspection */
		return app('config')->get($key, $default);
	}
}

if (! function_exists('response')) {
	/**
	 * Return a new response from the application.
	 *
	 * @param View|string|array|null $content
	 * @param int $status
	 * @param array $headers
	 *
	 * @return Response|ResponseFactory
	 * @throws BindingResolutionException
	 */
	function response($content = '', $status = 200, array $headers = [])
	{
		$factory = app(ResponseFactory::class);

		if (func_num_args() === 0) {
			return $factory;
		}

		/** @noinspection PhpMethodParametersCountMismatchInspection */
		/** @noinspection PhpParamsInspection */
		return $factory->make($content, $status, $headers);
	}
}