var fieldNumber = 0
$('.add_field').click(function(event) {
	$parentDiv = $(this).parent();
	$fieldTemplate = $('.add_field_template');

	//Create new field and set proper IDs
	$newField = $fieldTemplate.clone(true);
	newNameID = 'item_name_'+(fieldNumber+1);
	$newField.find('.item_name').attr('id', newNameID)
		.prev('label').attr('for', newNameID);
	newValueID = 'item_value_'+(++fieldNumber);
	$newField.find('.item_value').attr('id', newValueID )
		.prev('label').attr('for', newValueID);

	//Show the field
	$newField.removeClass('hidden add_field_template');

	//Add it after the field containing the pressed "Add Field"
	$parentDiv.after($newField)
});