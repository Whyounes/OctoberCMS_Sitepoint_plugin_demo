function uniqueInputChanged($el, context, data, textStatus, jqXHR)
{
    var addon = $el.parents('.input-group').find('.input-group-addon');

    if( !$el.val().trim() || data.exists )
    {
        addon.removeClass('oc-icon-check').addClass('oc-icon-remove');

        return;
    }

    addon.removeClass('oc-icon-remove').addClass('oc-icon-check');
}