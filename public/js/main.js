var $collectionHolder;
var $addSupplierButton = $('<button type="button" class="add_supplier_link">Add a supplier</button>');
var $newLinkLi = $('<li></li>').append($addSupplierButton);

jQuery(document).ready(function() {
    $collectionHolder = $('ul.suppliers');

    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addSupplierButton.on('click', function(e) {
        addSupplierForm($collectionHolder, $newLinkLi);
    });
});

function addSupplierForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);


    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    $newFormLi.append('<button class="remove-supplier"  type="button">Delete this supplier</button>');

    $newLinkLi.before($newFormLi);

    $('.remove-supplier').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}