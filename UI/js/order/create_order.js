let orderItems = null;
$( function() {
    var presentItems = $('#presentItems').val();
    orderItems = (presentItems.length > 0)? jQuery.parseJSON(presentItems) : [];
    $.each(orderItems, function () {
        this.IsNew = 0;
    });
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
        orderItem.Notes = '';
        orderItem.IsCooked = 0;
        orderItems.push(orderItem);
        updateOrderItemsUI();
    });
    var yesCancel = $('#areYouSure');
    yesCancel.hide();
    $('#cancelOrder').on('click', function (e) {
        e.preventDefault();
        yesCancel.show();
    });
    var order = $('#order-list');
    var hiddenInput1 = $('#itemsToSave');
    var hiddenInput2 = $('#itemsToComplete');
    var total = 0.00;
    $.each(orderItems, function (index) {
        var hideIfCooked = (this.IsCooked === '1') ? 'hidden' : '';
        var showIfCooked = (this.IsCooked === '1') ?
            '<th colspan="2">Cooked/Made</th></tr>' :
            '<td><button class=" btn btn-danger" itemIndex="'+ index +'" onclick="removeOrderItem(event)" '+ hideIfCooked + '>Remove</button></td>' +
            '<td><button class=" btn btn-primary" itemIndex="'+ index +'" onclick="editOrderItem(event)" '+ hideIfCooked + '>Update</button></td>';
        var node = '<tr id="'+this.id_MenuItem+'"><th scope="row">'
            + this.Name + '</th><td>$' + this.ItemPrice +
            '</td>' + showIfCooked;
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
        var hideIfCooked = (this.IsCooked === '1') ? 'hidden' : '';
        var showIfCooked = (this.IsCooked === '1') ?
            '<th colspan="2">Cooked/Made</th></tr>' :
            '<td><button class=" btn btn-danger" itemIndex="'+ index +'" onclick="removeOrderItem(event)" '+ hideIfCooked + '>Remove</button></td>' +
            '<td><button class=" btn btn-primary" itemIndex="'+ index +'" onclick="editOrderItem(event)" '+ hideIfCooked + '>Update</button></td>';
        var node = '<tr id="'+this.id_MenuItem+'"><th scope="row">'
            + this.Name + '</th><td>$' + this.ItemPrice +
            '</td>' + showIfCooked;
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

function editOrderItem(event) {
    var index = parseInt(event.currentTarget.getAttribute('itemIndex'));
    var mItemName = $('#editItemName');
    var mItemPrice = $('#editItemPrice');
    var mItemNotes = $('#editItemNote');
    var modal = $('#editItem');
    mItemName.val(orderItems[index].Name);
    mItemPrice.val(orderItems[index].ItemPrice);
    mItemNotes.val(orderItems[index].Notes);
    modal.show();
    $('#submitEditItem').on('click', function () {
        modal.hide();
        orderItems[index].ItemPrice = mItemPrice.val();
        orderItems[index].Notes = mItemNotes.val();
        console.log(orderItems[index]);
        updateOrderItemsUI()
    });
    $('#closeEditItem').on('click', function () {
        modal.hide();
    });
}