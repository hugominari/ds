try
{
  $('#box-members, #box-positions .connectedSortable').sortable({
    connectWith: '.connectedSortable',
    opacity: 0.5,
  }).disableSelection();
  
  $("#box-positions .connectedSortable").on("sortreceive", function(event, ui) {
    var $list = $(this);
    
    if ($list.children().length > 1) {
      $(ui.sender).sortable('cancel');
    }
  });
}
catch (e)
{
  console.log('asd');
}

/**
 *
 */
Callbacks.preSubmit = function()
{
  let $directors = $('#box-directors > div');
  let $fiscals = $('#box-fiscals > div');
  let Director = [];
  let Fiscal = [];
  
  let $qtdDirectors = $directors.length;
  let $qtdFiscals = $fiscals.length;
  let $ctrDirectors = 0;
  let $ctrFiscals = 0;
  
  // Directors
  $.each($directors, function()
  {
    $member = $(this).find('img').attr('data-member');
    
    if (!!$member)
    {
      Director.push({
        position_id: $(this).attr('data-position'),
        member_id: $member,
      });
      
      $ctrDirectors++;
    }
  });
  
  // Fiscal
  $.each($fiscals, function()
  {
    $member = $(this).find('img').attr('data-member');
    
    if (!!$member)
    {
      Fiscal.push({
        position_id: $(this).attr('data-position'),
        member_id: $member,
      });
      
      $ctrFiscals++;
    }
  });
  
  let $hasDirectors = ($qtdDirectors > $ctrDirectors);
  let $hasFicals = ($qtdFiscals > $ctrFiscals);
  
  if ($hasDirectors || $hasFicals)
  {
    let $message = 'Você precisa montar o conselho fiscal!';
    
    if ($hasDirectors)
      $message = 'Você precisa montar a diretoria!';
    
    generateNotify('Opss', $message, 'error');
    return false;
  }
  
  $('#directors').val(JSON.stringify(Director));
  $('#fiscals').val(JSON.stringify(Fiscal));
  
  return true;
};