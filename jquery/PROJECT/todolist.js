$(document).ready(function() {
    $('#addtaskbutton').on('click', function() {
      addTask();
    });
  
    $('input[name=listtask]').keypress(function(event) {
      if (event.which === 13) {
        event.preventDefault();
        addTask();
      }
    });
  
    $(document).on('dblclick', 'li', function() {
      $(this).toggleClass('strike').fadeOut('slow', function() {
        $(this).remove();
      });
    });
  
 
  
    $('ul').sortable();
  });
  
  function addTask() {
    var toAdd = $('input[name=listtask]').val();
    if (toAdd !== '') {
      $('ul').append('<li>' + toAdd + '</li>');
      $('input[name=listtask]').val('');
    }
  }