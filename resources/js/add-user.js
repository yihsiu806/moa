import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';

(() => {
  if (divisions) {
    divisions.forEach(division => {
      $('#divisionSelect').append(`
        <option value="${division.id}">${division.name}</option>
      `)
    });
  }
})();

(() => {
  $('#username, #password').on('input', function () {
    let limit = 100;
    if (this.value.length > limit) {
      Swal.fire({
        title: 'Text length limit',
        text: `${limit} characters max.`,
        icon: 'warning',
        confirmButtonColor: '#058344',
      });
      this.value = this.value.slice(0, limit);
    }
  });
})();

(() => {
  $('#roleSelect').on('change', function() {
    if (this.value == 'division') {
      $('.division-select').show();
    } else {
      $('.division-select').hide();
    }
  })
})();

(() => {
  $('input[type="text"], input[type="password"]').on('input', function() {
    $('input.is-invalid + div').hide();
    $('input.is-invalid').removeClass('is-invalid border-red-500');
  });
})();

$('#addNewUserForm').on('submit', function(event) {
  event.preventDefault();

  let validate = true;

  if (!$('#username').val()) {
    validate = false;
    $('#username').addClass('is-invalid');
  }
  
  if (!$('#password').val()) {
    validate = false;
    $('#password').addClass('is-invalid');
  } else if ($('#password').val().length < 6) {
    validate = false;
    $('#password').addClass('is-invalid');
  }

  $('input.is-invalid').addClass('border-red-500');
  $('input.is-invalid + div').show();

  if (!validate) {
    event.stopImmediatePropagation();
  }
});

$('#addNewUserForm').on('submit', function(event) {
  event.preventDefault();

  let data = {
    username: $('#username').val(),
    password: $('#password').val(),
    role: $('#roleSelect').val(),
    division: $('#divisionSelect').val(),
  }

  axios.post('/user/add', data)
  .then(function() {
    Swal.fire({
      title: 'Success',
      icon: 'success',
      text: 'Create a new user successfully',
      confirmButtonColor: '#056839',
    })
    .then(function() {
      $('#backBtn').get(0).click();
    })
  })
  .catch(function(error) {
    console.log(error);
    let message = error.response.data.message || 'Something went wrong. Sorry.';
    Swal.fire({
      title: 'Error',
      icon: 'error',
      text: message,
      confirmButtonColor: '#056839',
    })
  });
});