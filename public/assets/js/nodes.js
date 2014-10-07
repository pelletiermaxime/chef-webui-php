function refreshRunList() {
    var cookbooks = ''
    $("#panel-available-run-list .run-list .available_recipe").each(function(index, el) {
        cookbooks += ' ' + $.trim($(el).text());
    });
    $('#run_list').val(cookbooks);
}

$(function() {
    $('.jstree').jstree({}).on('before_open.jstree', function(node){
        $inputs = $('.jstree').find('input');
        $inputs.each(function(index, el) {
            $(el).appendTo($(el).parents('li:first'));
        });
    });

    $(".available_recipe").draggable({
        revert: "invalid",
        helper: "clone",
        cursor: "move",
    });
    $("#panel-available-run-list").droppable({
        accept: ".available_recipes > li",
        drop: function( event, ui ) {
            ui.draggable.appendTo($(this).children('ul'));
            refreshRunList();
        },
        tolerance: "touch"
    });
    $("#panel-available-recipes").droppable({
        accept: ".run-list > li",
        drop: function( event, ui ) {
            ui.draggable.appendTo($(this).children('ul'));
            setTimeout(refreshRunList, 100);
        },
        tolerance: "touch"
    });

    var options = {
      valueNames: [ 'name' ]
    };

    var userList = new List('panel-available-recipes', options);
});
