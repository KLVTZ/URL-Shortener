<?php

class Url extends Eloquent {
	public $timestamps = false;

	public static $rules =  array(
		'url' => 'required|url'
	);

	// use fillable as a white list
	protected $fillable = array('url', 'shortened');

	public static function get_unique_short_url() 
	{
		$shortened = base_convert(rand(10000, 99999), 10, 36);

		if(static::whereShortened($shortened)->first()) {
			return static::get_unique_short_url();
		}
		
		return $shortened;

	}

	public static function validate($input) {
		$v = Validator::make($input, static::$rules);
		return $v->fails()
			? $v
			: true;
	}

}
