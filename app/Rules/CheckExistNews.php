<?php


namespace App\Rules;
use App\News;
use Illuminate\Contracts\Validation\Validator;

class CheckExistNews implements Validator
{
	/**
	 * Get the messages for the instance.
	 *
	 * @return \Illuminate\Contracts\Support\MessageBag
	 */
	public function getMessageBag()
	{
		// TODO: Implement getMessageBag() method.
	}

	/**
	 * Determine if the data fails the validation rules.
	 *
	 * @return bool
	 */
	public function fails()
	{
		// TODO: Implement fails() method.
	}

	/**
	 * Get the failed validation rules.
	 *
	 * @return array
	 */
	public function failed()
	{
		// TODO: Implement failed() method.
	}

	/**
	 * Add conditions to a given field based on a Closure.
	 *
	 * @param string $attribute
	 * @param string|array $rules
	 * @param callable $callback
	 * @return $this
	 */
	public function sometimes($attribute, $rules, callable $callback)
	{
		// TODO: Implement sometimes() method.
	}

	/**
	 * After an after validation callback.
	 *
	 * @param callable|string $callback
	 * @return $this
	 */
	public function after($callback)
	{
		// TODO: Implement after() method.
	}


}