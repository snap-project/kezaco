$(function() {

  var $collectionHolder;

  var $addDocLink = $('<a href="#" class="add_document_link">Ajouter un document</a>');
  var $newLinkLi = $('<li></li>').append($addDocLink);

  $collectionHolder = $('#kezaco_corebundle_resource_document_documents');
  $collectionHolder.append($newLinkLi);
  $collectionHolder.data('index', $collectionHolder.find(':input').length);

  $addDocLink.on('click', function(e) {
    e.preventDefault();
    addDocForm($collectionHolder, $newLinkLi);
  });

  function addDocForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index)
      .replace(/label__/, '')
    ;

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
  }

});
