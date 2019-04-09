let orderItems = null;
$( function() {
    var presentItems = $('#presentItems').val();
    orderItems = (presentItems.length > 0)? jQuery.parseJSON(presentItems) : [];
    $( "#tabs" ).tabs();
    $(".menuItem").on('click', function (e) {
        var target = e.currentTarget;
        var orderItem = {};
        var id = $(target).attr('id');
        var price = $(target).attr('price');
        var name = $(target).attr('item');
        orderItem.id_MenuItem = id;
        orderItem.ItemPrice = price;
        orderItem.Name = name;
        orderItems.push(orderItem);
        updateOrderItemsUI();
    });
    var order = $('#order-list');
    var hiddenInput1 = $('#itemsToSave');
    var hiddenInput2 = $('#itemsToComplete');
    var total = 0.00;
    $.each(orderItems, function (index) {
        var node = '<tr id="'+this.id_MenuItem+'"><th scope="row">' + this.Name + '</th><td>$' + this.ItemPrice + '</td><td><button class=" btn btn-danger" itemIndex="'+ index +'" onclick="removeOrderItem(event)">Remove</button></td></tr>';
        order.append(node);
        total += parseFloat(this.ItemPrice);
    });
    $('#total').text('$'+total.toFixed(2));
    hiddenInput1.empty();
    hiddenInput2.empty();
    hiddenInput1.val(JSON.stringify(orderItems));
    hiddenInput2.val(JSON.stringify(orderItems));




} );

function updateOrderItemsUI() {
    var order = $('#order-list');
    var hiddenInput1 = $('#itemsToSave');
    var hiddenInput2 = $('#itemsToComplete');
    var total = 0.00;
    order.empty();
    $.each(orderItems, function (index) {
        var node = '<tr id="'+this.id_MenuItem+'"><th scope="row">' + this.Name + '</th><td>$' + this.ItemPrice + '</td><td><button class=" btn btn-danger" itemIndex="'+ index +'" onclick="removeOrderItem(event)">Remove</button></td></tr>';

        order.append(node);
        total += parseFloat(this.ItemPrice);
    });
    $('#total').text('$'+total.toFixed(2));
    hiddenInput1.empty();
    hiddenInput2.empty();
    hiddenInput1.val(JSON.stringify(orderItems));
    hiddenInput2.val(JSON.stringify(orderItems));
}

function removeOrderItem(e) {
    var index = parseInt(e.currentTarget.getAttribute('itemIndex'));
    console.log(e.currentTarget.getAttribute('itemIndex'));
    orderItems.splice(index, 1);
    updateOrderItemsUI();
}