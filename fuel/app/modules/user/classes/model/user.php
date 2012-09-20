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

  protected static $_many_many = array('skills');

  protected static $_created_at = 'created_at';

  protected static $_properties = array(
    'id',
    'username' => array(
       'data_type' => 'string',
       'label'     => 'mustached.user.email',
       'form'  => array('type' => false)
    ),
    'group' => array(
       'data_type' => 'int',
       'label'     => 'mustached.user.group',
       'form'  => array('type' => false)
    ),
    'email' => array(
       'data_type' => 'string',
       'label'     => 'mustached.user.email',
       'form'  => array('type' => 'text', 'autocomplete' => 'off'),
       'validation' => array('required', 'max_length'=>array(120))
    ),
    'firstname' => array( //column name
       'data_type' => 'string',
       'label'     => 'mustached.user.firstname',
       'form'      => array('type' => 'text', 'autocomplete' => 'off'),
       'validation'=> array('required') //validation rules
    ),
    'lastname'     => array(
       'data_type' => 'string',
       'label'     => 'mustached.user.lastname',
       'form'      => array('type' => 'text', 'autocomplete' => 'off'),
       'validation' => array('required')
    ),
    'biography'     => array(
       'data_type' => 'string',
       'label'     => 'mustached.user.biography',
       'form'      => array('type' => 'textarea', 'autocomplete' => 'off'),
    ),
    'password' => array(
       'data_type'  => 'string',
       'label'     => 'mustached.user.password',
       'validation' => array('required'),
       'form'       => array('type' => 'password', 'autocomplete' => 'off')
    ),
    'twitter' => array(
       'data_type'  => 'string',
       'label'     => 'mustached.user.twitter',
       'form'      => array('type' => 'text', 'autocomplete' => 'off')
    ),
    'company_id' => array(
       'data_type'  => 'int',
       'form'       => array('type' => 'text', 'id' => 'companies', 'name' => 'company'),
    ),
    'created_at' => array(
      'data_type' => 'int',
      'label' => 'Created At',
      'form' => array(
          'type' => false, // this prevents this field from being rendered on a form
      ),
    ),
    'last_login' => array(
      'data_type' => 'string',
      'label' => 'Last login',
      'form' => array(
          'type' => false, // this prevents this field from being rendered on a form
      ),
    ),

  );

  protected static $_observers = array(
    'Orm\\Observer_CreatedAt' => array(
      'mysql_timestamp' => true,
    ),
  );

  public static function set_edit_fields($form, $instance = null)
  {
    $editable = array('firstname', 'lastname', 'email', 'twitter', 'biography');
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
          $form->add($name, '', array_merge($property['form'], array('placeholder' => \Lang::get($property['label']))), $validation);
        }
        $property = next(self::$_properties);
    }
    return $form;
  }




}
