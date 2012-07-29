<?php
namespace User;

class Model_Company extends \Orm\Model
{
   protected static $_table_name = 'companies'; //set the table name manually
   protected static $_has_many= array('users');


    protected static $_properties = array(
      'id',
      'name' => array( //column name
         'data_type' => 'string',
         'validation' => array('required', 'max_length'=>array(120)) //validation rules
      ),
    );


}
