<?php
namespace Checkin;

class Model_Checkin extends \Orm\Model
{
   protected static $_table_name = 'checkins'; //set the table name manually
   protected static $_belongs_to = array(
   		'reason',
   		'user' => array(
			   'model_to' => '\User\Model_User',
   		),
   	);

   protected static $_created_at = 'created_at';
   protected static $_updated_at = 'updated_at';

    protected static $_properties = array(
      'id',
      'public' => array(
         'data_type' => 'int',
         'label'     => 'mustached.checkin.fields.public',
      ),
      'killed' => array(
      	'data_type' => 'int',
      ),
      'count' => array(
      	'data_type' => 'int',
      ),
      'reason_id' => array(
       'data_type'  => 'int',
      ),
      'user_id' => array(
       'data_type'  => 'int',
      ),
      'created_at' => array(
       'data_type'  => 'int',
      ),
      'updated_at' => array(
       'data_type'  => 'int',
      ),
    );

    protected static $_observers = array(
      'Orm\\Observer_CreatedAt' => array(
        'mysql_timestamp' => true,
       ),

      'Orm\\Observer_UpdatedAt' => array(
        'mysql_timestamp' => true,
      )
    );


}
