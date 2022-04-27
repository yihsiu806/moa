import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';
import {hideLoading} from './utils';

hideLoading();

console.log(user);
console.log(divisions);

if (user && user.username) {
  $('#username').val(user.username);
}

if (user && user.role) {
  $('#roleSelect').val(user.role);
}

if (divisions) {
  divisions.forEach(division => {
    $('#divisionSelect').append(`
      <option value="${division.id}">${division.name}</option>
    `)
  });
}

if (user.division) {
  $('.division-select').show();
  $('#divisionSelect').val(user.division);
}

$('#roleSelect').on('change', function() {
  if (this.value == 'division') {
    $('.division-select').show();
  } else {
    $('.division-select').hide();
  }
});

$('#username, #passowrd').on('input', function () {
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

$('input[type="text"], input[type="password"]').on('input', function() {
  $('input.is-invalid + div').hide();
  $('input.is-invalid').removeClass('is-invalid border-red-500');
  // $('#editUserSavedInfo').hide();
});

$('#editUserForm').on('submit', function(event) {
  event.preventDefault();

  let validate = true;

  if (!$('#username').val()) {
    validate = false;
    $('#username').addClass('is-invalid');
  }

  if (!(/^[a-zA-Z0-9_]+$/.test($('#username').val()))) {
    validate = false;
    $('#username').addClass('is-invalid');
  }

  $('input.is-invalid').addClass('border-red-500');
  $('input.is-invalid + div').show();

  if (!validate) {
    event.stopImmediatePropagation();
  }
});

$('#editUserForm').on('submit', function(event) {
  event.preventDefault();

  let data = {
    id: userId,
    username: $('#username').val(),
    role: $('#roleSelect').val(),
    division: $('#divisionSelect').val(),
  }

  axios.patch('/user/edit', data)
  .then(function() {
    Swal.fire({
      title: 'Success',
      icon: 'success',
      text: 'Change has saved!',
      confirmButtonColor: '#056839',
    })
    .then(function() {
      // $('#editUserSavedInfo').show();
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

$('#resetPasswordForm').on('submit', function(event) {
  event.preventDefault();

  let validate = true;

  if (!$('#password').val()) {
    validate = false;
    $('#password').addClass('is-invalid');
  }

  $('input.is-invalid').addClass('border-red-500');
  $('input.is-invalid + div').show();

  if (!validate) {
    event.stopImmediatePropagation();
  }
});

$('#resetPasswordForm').on('submit', function(event) {
  event.preventDefault();

  let data = {
    id: userId,
    password: $('#password').val(),
  }

  axios.patch('/user/reset', data)
  .then(function() {
    Swal.fire({
      title: 'Success',
      icon: 'success',
      text: 'Password has been reset!',
      confirmButtonColor: '#056839',
    })
    .then(function() {
      // $('#editUserSavedInfo').show();
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

$('#deleteUserBtn').on('click', function() {
  let promise;
  promise = Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#056839',
    confirmButtonText: 'Yes, delete it!'
  })
  
  promise = promise.then((result) => {
    if (result.isConfirmed) {
      return axios.patch('/user/delete', {id: userId})
    } else {
      return Promise.reject('cancel');
    }
  });

  promise
  .then(function() {
    Swal.fire({
      title: 'Deleted!',
      icon: 'success',
      text: `User '${user.username}' has been deleted.`,
      confirmButtonColor: '#056839',
    })
    .then(function() {
      $('#backBtn').get(0).click();
    })
  })
  .catch(function(error) {
    if (error == 'cancel') {
      return;
    }
    console.log(error);
    let message = error.response.data.message || 'Something went wrong. Sorry.';
    Swal.fire({
      title: 'Error',
      icon: 'error',
      text: message,
      confirmButtonColor: '#056839',
    })
  })
})