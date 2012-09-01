<?php
namespace User;

class Model_Skill extends \Orm\Model
{
   protected static $_table_name = 'skills'; //set the table name manually
   protected static $_many_many= array('users');

    protected static $_properties = array(
      'id',
      'name' => array( //column name
         'data_type' => 'string',
         'validation' => array('required', 'max_length'=>array(120)) //validation rules
      ),
    );
}
