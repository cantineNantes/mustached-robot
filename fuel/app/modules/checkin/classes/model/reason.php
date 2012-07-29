<?php
namespace Checkin;

class Model_Reason extends \Orm\Model
{
   protected static $_table_name = 'reasons'; //set the table name manually
   protected static $_has_many = array('checkins');

    protected static $_properties = array(
      'id',
      'name' => array( //column name
         'data_type' => 'string',
         'validation' => array('required') //validation rules
      ),
      'sentence' => array( //column name
         'data_type' => 'string',
         'validation' => array('required') //validation rules
      ),
      'order' => array( //column name
         'data_type' => 'int',
         'validation' => array('required') //validation rules
      ),
    );


}
