import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';

hideLoading();

$('input[type="password"]').on('input', function () {
  let limit = 50;
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

$('input[type="password"]').on('input', function() {
  $('input.is-invalid + div').hide();
  $('input.is-invalid').removeClass('is-invalid border-red-500');
});

$('#changePasswordForm').on('submit', function(event) {
  event.preventDefault();

  let validate = true;

  if ($('#currentPassword').val().length < 6) {
    validate = false;
    $('#currentPassword').addClass('is-invalid');
  }
  if ($('#newPassword').val().length < 6) {
    validate = false;
    $('#newPassword').addClass('is-invalid');
  }
  if ($('#confirmNewPassword').val().length < 6) {
    validate = false;
    $('#confirmNewPassword').addClass('is-invalid');
  }

  $('input.is-invalid').addClass('border-red-500');
  $('input.is-invalid + div').show();

  if (!validate) {
    event.stopImmediatePropagation();
  }
});

$('#changePasswordForm').on('submit', function(event) {
  event.preventDefault();

  let data = {
    currentPassword: $('#currentPassword').val(),
    newPassword: $('#newPassword').val(),
    confirmNewPassword: $('#confirmNewPassword').val(),
  }

  axios.patch('/viewer/changePassword', data)
  .then(function() {
    Swal.fire({
      title: 'Success',
      icon: 'success',
      text: 'Password has been changed!',
      confirmButtonColor: '#056839',
    })
    .then(function() {
      location.replace('/');
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

function hideLoading() {
  $('body').removeClass('inactive');
  $('#ltLoader').fadeOut();
}

