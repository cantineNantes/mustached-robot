<?php
namespace User;

class Model_User extends \Orm\Model
{
  protected static $_table_name = 'users'; //set the table name manually
  protected static $_belongs_to = array('company');
  protected static $_has_many = array(
                      'checkins' => array(
                          'model_to' => '\Checkin\Model_Checkin',
                      ),
                    );


  protected static $_created_at = 'created_at';
  protected static $_updated_at = 'updated_at';

  protected static $_properties = array(
    'id',
    'email' => array(
       'data_type' => 'string',
       'label' => 'mustached.user.email',
       'form'  => array('type' => 'text'),
       'validation' => array('required', 'max_length'=>array(120))
    ),
    'is_admin' => array(
       'data_type'  => 'int',
       'label'      => 'Is Admin',
       'form'       => array('type' => false),
    ),
    'firstname' => array( //column name
       'data_type' => 'string',
       'label'     => 'mustached.user.firstname',
       'form'      => array('type' => 'text'),
       'validation'=> array('required') //validation rules
    ),
    'lastname'     => array(
       'data_type' => 'string',
       'label'     => 'mustached.user.lastname',
       'form'      => array('type' => 'text'),
       'validation' => array('required')
    ),
    'password' => array(
       'data_type'  => 'string',
       'label'      => 'mustached.user.password',
       'validation' => array('required'),
       'form'       => array('type' => 'password')
    ),
    'twitter' => array(
       'data_type'  => 'string',
       'label'      => 'mustached.user.twitter',
       'form'      => array('type' => 'text')
    ),
    'company_id' => array(
       'data_type'  => 'int',
       'label'      => 'mustached.user.company',
       'form'       => array('type' => 'text', 'id' => 'companies', 'name' => 'company'),
    ),
    'created_at' => array(
      'data_type' => 'int',
      'label' => 'Created At',
      'form' => array(
          'type' => false, // this prevents this field from being rendered on a form
      ),
    ),
    'updated_at' => array(
      'data_type' => 'int',
      'label' => 'Updated At',
      'form' => array(
          'type' => false, // this prevents this field from being rendered on a form
      ),
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

  public static function set_edit_fields($form, $instance = null)
  {
    $editable = array('firstname', 'lastname', 'email', 'twitter');
    self::build_form($form, $editable);
  }

  public static function set_add_fields($form, $instance = null)
  {
    $editable = array('firstname', 'lastname', 'email', 'password', 'twitter');
    self::build_form($form, $editable);
  }

  /**
   * Build a fieldset according to the model _properties
   *
   * @param \Fieldset
   * @param Array fields to display on the form
   * @return Fieldset
   */
  private static function build_form($form, $editable) {

    $property = current(self::$_properties);

    for($i=0;$i<sizeof(self::$_properties);$i++)
    {
        $name = key(self::$_properties);
        if(in_array($name, $editable, true))
        {
          $validation = (isset($property['validation'])) ? array($property['validation']) : array() ;
          $form->add($name, $property['label'], $property['form'], $validation);
        }
        $property = next(self::$_properties);
    }
    return $form;
  }




}
