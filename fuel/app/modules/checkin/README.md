# Checkin modules

## Plugins

### Customizables forms

#### The checkin form

If you want to configure the checkin form, create a "Form" class in your module and add the method ```addElementOnPublicCheckin()```

By default, the new element(s) will be added after the last field. You can override this settings by using the two parameters (the first is the name of the element on the current form, the second is the position -- 'before' or after' -- of your new field relatively to the first parameter.

### Customizable actions

#### Do something when user checks in

If you want to do something when a user checks in, create a "Trigger" class in your module, and add the method ```postCheckin()```

This method send one argument $options with a 'fieldset' key containing the fields submitted by the user on the checkin form (if you have previously configured the checkin form, the datas added on the form by your plugin will be also available, see the twitter plugin example for reference).