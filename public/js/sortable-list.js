$(function () {
    var list = $("#sortable");
    var orderOptionsHolder = $("[data-role='order-options']");
    var changeBtn = $("[data-role='change-order']");
    var cancelBtn = $("[data-role='cancel-order']");
    var saveBtn = $("[data-role='save-order']");
    list.sortable({
        placeholder: "ui-state-highlight",
        update: function (event, ui) {
            $("[data-role='sortable-item']").each(function (i, item) {
                $(item).find("[data-role='order']").html(i + 1);
            });
        }
    });
    list.sortable("disable");
    list.disableSelection();
    changeBtn.click(function (e) {
        e.preventDefault();
        orderOptionsHolder.addClass("active-changes");
        list.sortable("enable");
    });
    cancelBtn.click(function (e) {
        e.preventDefault();
        list.sortable('cancel');
        list.sortable("disable");
        $("[data-role='sortable-item']").each(function (i, item) {
            $(item).find("[data-role='order']").html(i + 1);
        });
        orderOptionsHolder.removeClass("active-changes");
    });
    saveBtn.click(function (e) {
        e.preventDefault();
        list.sortable("disable");
        var order = {};
        $("[data-role='sortable-item']").each(function (i, item) {
            itemId = $(item).data("id");
            order[itemId] = i;
        });
        // Ajax save the order
        var request = $.ajax({
            url: "/admin/save-order/client",
            method: "POST",
            data: {order: order}
        });
        request.done(function (msg) {
            if (msg == "true") {
                $("#sortable").effect("highlight", {}, 1000);
                orderOptionsHolder.removeClass("active-changes");
            }
        });
        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

});