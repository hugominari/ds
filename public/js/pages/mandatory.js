try {
  $('#box-members, #box-positions .connectedSortable').sortable({
    connectWith: '.connectedSortable',
    opacity: 0.5
  }).disableSelection();

  $("#box-positions .connectedSortable").on("sortreceive", function (event, ui) {
    var $list = $(this);
    var $member = $list.find('[data-member]').attr('alt');
    var $depart = $list.parent().find('p').text();
    var $memberId = $list.find('[data-member]').attr('data-member');
    var $departId = $list.parent().attr('data-position');
    var $id = $memberId + "-" + $departId;
    var isDirector = $list.parents('#box-fiscals').length === 0;
    var $method = isDirector ? '#list-director' : '#list-fiscals';
    var $box = $($method);

    //Remove
    $('[id^=' + $memberId + '-]').remove();
    //Add
    var $itemList = $('</p>').attr('id', $id).html("<b>" + $depart + "</b> <br />será ocupado por <b>" + $member + "</b>");
    $itemList.appendTo($box);

    if ($list.children().length > 1) {
      $(ui.sender).sortable('cancel');
    }
  });
} catch (e) {
  console.log('asd');
}

$('[data-toggle="tooltip"]').tooltip();
$('[data-toggle="popover"]').popover({
  trigger: 'hover'
});

/**
 *
 */
Callbacks.preSubmit = function () {
  var $directors = $('#box-directors > div');
  var $fiscals = $('#box-fiscals > div');
  var Director = [];
  var Fiscal = [];

  var $qtdDirectors = $directors.length;
  var $qtdFiscals = $fiscals.length;
  var $ctrDirectors = 0;
  var $ctrFiscals = 0;

  // Directors
  $.each($directors, function () {
    $member = $(this).find('img').attr('data-member');

    if (!!$member) {
      Director.push({
        position_id: $(this).attr('data-position'),
        member_id: $member
      });

      $ctrDirectors++;
    }
  });

  // Fiscal
  $.each($fiscals, function () {
    $member = $(this).find('img').attr('data-member');

    if (!!$member) {
      Fiscal.push({
        position_id: $(this).attr('data-position'),
        member_id: $member
      });

      $ctrFiscals++;
    }
  });

  var $hasDirectors = $qtdDirectors > $ctrDirectors;
  var $hasFicals = $qtdFiscals > $ctrFiscals;

  if ($hasDirectors || $hasFicals) {
    var $message = 'Você precisa montar o conselho fiscal!';

    if ($hasDirectors) $message = 'Você precisa montar a diretoria!';

    generateNotify('Opss', $message, 'error');
    return false;
  }

  $('#directors').val(JSON.stringify(Director));
  $('#fiscals').val(JSON.stringify(Fiscal));

  return true;
};
