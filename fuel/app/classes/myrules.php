<?php

class MyRules
{
    // note this is a static method
    public static function _validation_unique($val, $options)
    {
    	if(!\Str::lower($val)) return true;
        list($table, $field,$update) = explode('.', $options);  
        $query = \DB::select("  LOWER(\"$field\") ")
        ->where($field, '=', \Str::lower($val));
        if($update>0){
        	$query->where('id','!=',$update);
        }
        $result = $query->from($table)->execute();
	 	\Validation::active()->set_message('unique', __('comm.The field :label must be unique, but :value has already been used'));
        return ! ($result->count() > 0);
    }

    // note this is a non-static method
    public function _validation_is_upper($val)
    {
        return $val === strtoupper($val);
    }

}
