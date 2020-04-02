$('.open-m').click(function() {

  $('#exampleModalLabel').text('Add user');
  $('#user_send').text('Add');
});

// Add + Edit
$('#user_send').click(async function() {
  let id = $('#firstName')[0].dataset.id;
  let status = '';
  let firstName = $('#firstName').val();
  let lastName = $('#lastName').val();
  let role = $('#role').val();  

  if ($('#customSwitch1')[0].checked) {
      status = 'active';
  } else if (!$('#customSwitch1')[0].checked) {
      status = 'not-active';
  };
  $.ajax({
    url: '/main/add/',
    method: 'POST',
    cache: false,
    data: {
      id,
      name: firstName + ' ' + lastName,
      role,
      status
    },
    dataType: 'html',
    success(data) {      
      $('#close-bt').click();
      document.location.replace('/');
    }
  });
});

// Del by icon
$('.snippet').click(function(e) {
  if ($(e.target).is('.del_me_icon')) {
    let id = $(e.target).closest('tr').find('.group_checkbox')[0].id;
    let name = $(e.target).closest('tr').find('.user_name').text();
    popup('#confirmModal', '.person-del', name);
    $('#confirmModal').click(function (e) {
      if ($(e.target).is('.yes-modal')) {
        $('#confirmModal').modal('hide');
        document.location.replace('/main/del?id=' + id);
      }
    });
  }
});

// Del, edit status by action-bar
$('.action-bar').click(function(e) {
  if ($(e.target).hasClass('action_user')) {
    let actionUsers = [];
    $('.group_checkbox').each(function(n) {
      if (this.checked) {
        actionUsers.push($(this).val());
      }        
    });     
    let action_id = $(this).find('.action_status').val(); 
    if (!action_id) {
      popup('#alertModal', '.alerm-item', 'action'); 
      return;
    } else if (!actionUsers.length) {
      popup('#alertModal', '.alerm-item', 'user'); 
      return;
    }

    $.ajax({
      url: '/main/action/',
      method: 'POST',
      cache: false,
      data: { 
        action_id,
        actionUsers: actionUsers.join(',')
      },       
      dataType: 'html',
      success(data) {
        document.location.reload(true);
      }
    });        
  }  
});


$('#exampleModal').on('hide.bs.modal', function () {
  document.location.replace('/');
})

$('#group_checkbox_all').change(function() {    
    if (this.checked) {
      $('.group_checkbox').each(function() {        
        this.checked = true;
      })
    } else {
      $('.group_checkbox').each(function() {        
        this.checked = false;
      })
    }
});

$('.group_checkbox').change(function() {
  if (!this.checked) { 
      $('#group_checkbox_all')[0].checked = false;
  }
  else {
    return;
  }  
});

$('#customSwitch1').change(function() {
  if (!this.checked) {
    $('label[for=customSwitch1]').text('Not-active');
  } else {    
    $('label[for=customSwitch1]').text('Active');
  }
});
function popup(id, selector, text) {
  //alert(123);
  $(id).find(selector).text(text);
  $(id).modal('show');
}

if ($('#firstName')[0].dataset.id != '') {
        $('#exampleModal').modal('show');
        $('#exampleModalLabel').text('Edit user');
        $('#user_send').text('Save');
}