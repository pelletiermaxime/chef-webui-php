var fieldNumber = 0
$('.add_field').click(function(event) {
	$parentDiv = $(this).parent();
	$fieldTemplate = $('.add_field_template');

	//Create new field and set proper IDs, Names and Fors
	$newField = $fieldTemplate.clone(true);
	newNameID = 'item_name_' + (fieldNumber +1 );
	$newField.find('.item_name').attr('id', newNameID)
		.attr('name', 'item_name[]')
		.prev('label').attr('for', newNameID);

	newValueID = 'item_value_' + (fieldNumber + 1);
	$newField.find('.item_value').attr('id', newValueID)
		.attr('name', 'item_value[]')
		.prev('label').attr('for', newValueID);

	newAddFieldID = 'add_field_' + (fieldNumber + 1);
	$newField.find('.add_field').attr('id', newAddFieldID)

	newRemoveFieldID = 'remove_field_' + (fieldNumber + 1);
	$newField.find('.remove_field').attr('id', newRemoveFieldID)

	fieldNumber++;

	//Show the field
	$newField.removeClass('hidden add_field_template');

	//Add it after the field containing the pressed "Add Field"
	$parentDiv.after($newField)
});

$('.remove_field').click(function(event) {
	$parentDiv = $(this).parent();
	$parentDiv.remove();
});
