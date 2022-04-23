function createTableEdit(data) {
  $('#membertable').Tabledit({
    url: '/api/memberlist/edit',

    // hide the column that has the identifier
    hideIdentifier: false,

    // activate focus on first input of a row when click in save button
    autoFocus: true,

    // activate save button when click on edit button
    saveButton: true,
    // Activate edit button instead of spreadsheet style
    editButton: true,
    // Activate delete button
    deleteButton: true,
    // Activate restore button to undo delete action
    restoreButton: true,

    // Class for form inputs
    inputClass: 'form-control input-sm searchbox-dark',
    // Class for buttons toolbar
    toolbarClass: 'btn-toolbar',
    // Class for buttons group
    groupClass: 'btn-group btn-group-sm',
    // Class for row when ajax request fails
    dangerClass: 'danger',
    // Class for row when save changes
    warningClass: 'warning',
    // Class for row when is deleted
    mutedClass: 'muted',
    // Trigger to change for edit mode
    eventType: 'click',
      
      
    columns: {
      identifier: [0, 'id'],
      editable: data
    },

    buttons: {
      edit: {
        class: 'btn btn-sm btn-default',
        html: '<i class="fas fa-pencil-alt icon-white"></i>',
        action: 'edit'
      },
      delete: {
        class: 'btn btn-sm btn-default',
        html: '<i class="fas fa-trash icon-white"></i>',
        action: 'delete'
      },
      save: {
        class: 'btn btn-sm btn-success',
        html: 'Save'
      },

      restore: {
        class: 'btn btn-sm btn-warning',
        html: 'Restore',
        action: 'restore'
      },
      confirm: {
        class: 'btn btn-sm btn-danger',
        html: 'Confirm'
      }
    },
    onDraw: function () {
      $('#membertable tbody tr:last').after('<tr class="notfound"><td colspan="6" class="text-center">No record found</td></tr>');
    },
    onSuccess: function (data, textStatus, jqXHR) {
      if (data.action == 'delete') {
        // $('#' + data.id).remove();

        notifications.success("Request successful", "Your request to delete was successful for #" + data.id);
        setTimeout(function () {
          location.reload();
        }, 2000);
      }
      if (data.action == 'edit') {
        notifications.success("Request successful", "Your request to edit was successful for #" + data.id);
        setTimeout(function () {
          location.reload();
        }, 2000);
      }
      if (data.action == 'restore') {

        notifications.success("Request successful", "Your request to restore was successful for #" + data.id);
      }
    },
    onFail: function (jqXHR, textStatus, errorThrown) {

      notifications.fail("Request Failed", "The server cannot process your requests. Inform the webmaster about the problem! Info: " + textStatus + "/"+ errorThrown + "/" + jqXHR);
    },
    onAlways: function () { },
    onAjax: function (action, serialize) {
      notifications.loading("Info", "Your request \"" + action + "\" was sent.");
    }
  })
}

$(document).ready(
  function () {
    // request groups from mysql with php
    $.post('/api/groups')
      .done(function (res) {
        console.log(res);
        let data = [
          [1, 'discordid'],
          [3, 'displayname'],
          [4, 'group', JSON.stringify(res)]
        ]
        createTableEdit(data)
      })
  }
);

