$(document).ready(function () {

  // Search all columns
  $('#search_all').keyup(function () {
    // Search Text
    var search = $(this).val();

    // Hide all #membertable tbody rows
    $('#membertable tbody tr').hide();

    // Count total search result
    var len = $('#membertable tbody tr:not(.notfound) td:contains("' + search + '")').length;

    if (len > 0) {
      // Searching text in columns and show match row
      $('#membertable tbody tr:not(.notfound) td:contains("' + search + '")').each(function () {
        $(this).closest('tr').show();
      });
    } else {
      $('.notfound').show();
    }

  });

  // Search on realname column only
  $('#search_realname').keyup(function () {
    // Search Text
    var search = $(this).val();

    // Hide all #membertable tbody rows
    $('#membertable tbody tr').hide();

    // Count total search result
    var len = $('#membertable tbody tr:not(.notfound) td:nth-child(3):contains("' + search + '")').length;

    if (len > 0) {
      // Searching text in columns and show match row
      $('#membertable tbody tr:not(.notfound) td:contains("' + search + '")').each(function () {
        $(this).closest('tr').show();
      });
    } else {
      $('.notfound').show();
    }

  });

  // Search on displayname column only
  $('#search_displayname').keyup(function () {
    // Search Text
    var search = $(this).val();

    // Hide all #membertable tbody rows
    $('#membertable tbody tr').hide();

    // Count total search result
    var len = $('#membertable tbody tr:not(.notfound) td:nth-child(4):contains("' + search + '")').length;

    if (len > 0) {
      // Searching text in columns and show match row
      $('#membertable tbody tr:not(.notfound) td:contains("' + search + '")').each(function () {
        $(this).closest('tr').show();
      });
    } else {
      $('.notfound').show();
    }

  });
    
  // Search on discord id column only
  $('#search_discordid').keyup(function () {
    // Search Text
    var search = $(this).val();

    // Hide all #membertable tbody rows
    $('#membertable tbody tr').hide();

    // Count total search result
    var len = $('#membertable tbody tr:not(.notfound) td:nth-child(2):contains("' + search + '")').length;

    if (len > 0) {
      // Searching text in columns and show match row
      $('#membertable tbody tr:not(.notfound) td:contains("' + search + '")').each(function () {
        $(this).closest('tr').show();
      });
    } else {
      $('.notfound').show();
    }

  });
    
  // Search on id column only
  $('#search_id').keyup(function () {
    // Search Text
    var search = $(this).val();

    // Hide all #membertable tbody rows
    $('#membertable tbody tr').hide();

    // Count total search result
    var len = $('#membertable tbody tr:not(.notfound) td:nth-child(1):contains("' + search + '")').length;

    if (len > 0) {
      // Searching text in columns and show match row
      $('#membertable tbody tr:not(.notfound) td:contains("' + search + '")').each(function () {
        $(this).closest('tr').show();
      });
    } else {
      $('.notfound').show();
    }

  });

});

// Case-insensitive searching (Note - remove the below script for Case sensitive search )
$.expr[":"].contains = $.expr.createPseudo(function (arg) {
  return function (elem) {
    return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
  };
});
