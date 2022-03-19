import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';

(() => {
  $('#divisionName').val(division.name);
  $('#divisionSlug').val(division.slug);
  $('#officerName').val(officer.name);
  $('#officerPosition').val(officer.position);
  $('#officerTelephone').val(officer.telephone);
  $('#officerEmail').val(officer.email);

  if (officer.picture && officer.picture != 'default') {
    $('#officerPicture').attr('src', '/storage/' + officer.picture);
    $('#officerPicture').get(0).result = officer.picture;
  } else {
    $('#officerPicture').get(0).result = 'default';
  }

  if (division.picture && division.picture != 'default') {
    $('#divisionPicture').attr('src', '/storage/' + division.picture);
    $('#divisionPicture').get(0).result = division.picture;
  } else {
    $('#divisionPicture').get(0).result = 'default';
  }

  $('#divisionIcon').attr('src', 'data:image/svg+xml;base64,'+ btoa(division.icon));
  $('#divisionIcon').get(0).result = division.icon;
})();

(() => {
  $('#editDivisionPicture').on('change', function (event) {
    if (event.target.files.length <= 0) {
      return;
    }
    let targetPhoto = event.target.files[0];

    let filesize = (targetPhoto.size / 1024 / 1024).toFixed(2); //MiB

    if (filesize > 5) {
      Swal.fire({
        title: 'File size limit',
        text: `File is too big (${filesize}MiB). Max filesize: 5MiB.`,
        icon: 'warning',
        confirmButtonColor: '#00a0e9',
      });
      this.value = '';
      return;
    }

    let src = URL.createObjectURL(targetPhoto);

    $('#divisionPicture').attr('src', src);

    var fr = new FileReader();
    fr.addEventListener('load', function (e) {
      let result = e.target.result;
      $('#divisionPicture').get(0).result = result;
    });

    fr.readAsDataURL(targetPhoto);
  });

  $('#editOfficerPicture').on('change', function (event) {
    if (event.target.files.length <= 0) {
      return;
    }
    let targetPhoto = event.target.files[0];

    let filesize = (targetPhoto.size / 1024 / 1024).toFixed(2); //MiB

    if (filesize > 5) {
      Swal.fire({
        title: 'File size limit',
        text: `File is too big (${filesize}MiB). Max filesize: 5MiB.`,
        icon: 'warning',
        confirmButtonColor: '#00a0e9',
      });
      this.value = '';
      return;
    }

    let src = URL.createObjectURL(targetPhoto);

    $('#officerPicture').attr('src', src);

    var fr = new FileReader();
    fr.addEventListener('load', function (e) {
      let result = e.target.result;
      $('#officerPicture').get(0).result = result;
    });

    fr.readAsDataURL(targetPhoto);
  });

  $('#editDivisionIcon').on('change', function (event) {
    if (event.target.files.length <= 0) {
      return;
    }
    let targetPhoto = event.target.files[0];

    let filesize = (targetPhoto.size / 1024 / 1024).toFixed(2); //MiB

    if (filesize > 1) {
      Swal.fire({
        title: 'File size limit',
        text: `File is too big (${filesize}MiB). Max filesize: 1MiB.`,
        icon: 'warning',
        confirmButtonColor: '#00a0e9',
      });
      this.value = '';
      return;
    }

    let src = URL.createObjectURL(targetPhoto);

    $('#divisionIcon').attr('src', src);

    var fr = new FileReader();
    fr.addEventListener('load', function (e) {
      let result = e.target.result;
      $('#divisionIcon').get(0).result = result
    });

    fr.readAsText(targetPhoto);
  });

  $('#resetDivisionPicture').on('click', function() {
    $('#editDivisionPicture').val('');
    $('#divisionPicture').attr('src', '/images/division-default-picture.png');
    $('#divisionPicture').get(0).result = 'default';
  })
  
  $('#resetDivisionIcon').on('click', function() {
    $('#editDivisionIcon').val('');
    $('#divisionIcon').attr('src', '/images/division-default-icon.svg');
    $('#divisionIcon').get(0).result = defaultIcon;
  })

  $('#resetOfficerPicture').on('click', function() {
    $('#editOfficerPicture').val('');
    $('#officerPicture').attr('src', '/images/officer-default-picture.png');
    $('#officerPicture').get(0).result = 'default';
  })
})();

(() => {
  $('#divisionName').on('input', function () {
    let limit = 255;
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
  
  $('#divisionSlug').on('input', function () {
    let limit = 10;
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

  $('#officerName, #officerPosition, #officerTelephone, #officerEmail').on('input', function () {
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
  $('input[type="text"]').on('input', function() {
    $('input.is-invalid + div').hide();
    $('input.is-invalid').removeClass('is-invalid border-red-700');
  });
})();

const validateEmail = (email) => {
  return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

$('#modifyDivisionForm').on('submit', function(event) {
  event.preventDefault();

  let validate = true;

  if (!$('#divisionName').val()) {
    validate = false;
    $('#divisionName').addClass('is-invalid');
  }
  if (!$('#divisionSlug').val()) {
    validate = false;
    $('#divisionSlug').addClass('is-invalid');
  }
  if (!$('#officerName').val()) {
    validate = false;
    $('#officerName').addClass('is-invalid');
  }
  if (!$('#officerPosition').val()) {
    validate = false;
    $('#officerPosition').addClass('is-invalid');
  }
  if (!$('#officerTelephone').val()) {
    validate = false;
    $('#officerTelephone').addClass('is-invalid');
  }
  if (!$('#officerEmail').val()) {
    validate = false;
    $('#officerEmail').addClass('is-invalid');
    $('#officerEmail + div').text('Email can not be empty.');
  }
  if (!validateEmail($('#officerEmail').val())) {
    validate = false;
    $('#officerEmail').addClass('is-invalid');
    $('#officerEmail + div').text('Email address is invalid.');
  }

  $('input.is-invalid').addClass('border-red-700');
  $('input.is-invalid + div').show();

  if (!validate) {
    event.stopImmediatePropagation();
  }
})

$('#modifyDivisionForm').on('submit', function(event) {
  event.preventDefault();

  let data = {
    picture: $('#divisionPicture').get(0).result,
    icon: $('#divisionIcon').get(0).result,
    divisionName: $('#divisionName').val(),
    divisionSlug: $('#divisionSlug').val(),
    officerName: $('#officerName').val(),
    officerPosition: $('#officerPosition').val(),
    officerTelephone: $('#officerTelephone').val(),
    officerEmail: $('#officerEmail').val(),
    officerPicture: $('#officerPicture').get(0).result,
  }
  axios.patch('/modify/division', data)
  .then(function() {
    Swal.fire({
      title: 'Success',
      icon: 'success',
      text: 'Update division successfully',
      confirmButtonColor: '#056839',
    })
  })
  .catch(function(error) {
    console.log(error);
    Swal.fire({
      title: 'Error',
      icon: 'error',
      text: 'Something went wrong. Sorry.',
      confirmButtonColor: '#056839',
    })
  })
})

const defaultIcon = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="100" preserveAspectRatio="xMidYMid meet" version="1.0"><path fill="rgb(37.249756%, 38.819885%, 40.779114%)" d="M 10.71875 346.996094 C 3.695312 349.148438 -0.238281 356.597656 1.914062 363.617188 C 4.070312 370.636719 11.527344 374.546875 18.539062 372.421875 C 70.71875 356.371094 114.960938 346.410156 174.203125 346.410156 C 235.414062 346.410156 303.539062 356.128906 356.460938 372.421875 C 363.511719 374.601562 370.945312 370.597656 373.085938 363.617188 C 375.253906 356.59375 371.304688 349.164062 364.28125 346.996094 C 312.765625 331.144531 247.660156 321.355469 187.5 320.066406 L 187.5 186.730469 C 239.46875 186.238281 291.847656 181.394531 329.136719 149.429688 C 370.265625 114.175781 373.671875 65.226562 373.671875 13.960938 C 373.671875 6.621094 367.710938 0.664062 360.371094 0.664062 C 317.9375 0.664062 258.191406 8.511719 214.585938 45.890625 C 186.25 70.1875 172.792969 101.835938 166.449219 128.179688 C 160.105469 116.769531 151.863281 105.679688 141.171875 95.863281 C 103.269531 61.144531 51.4375 53.855469 14.628906 53.855469 C 7.289062 53.855469 1.328125 59.8125 1.328125 67.152344 C 1.328125 114.28125 4.28125 159.296875 39.839844 191.886719 C 71.886719 221.261719 116.503906 226.050781 160.902344 226.609375 L 160.902344 320.09375 C 104.972656 321.476562 61.277344 331.4375 10.71875 346.996094 Z M 231.886719 66.089844 C 265.09375 37.621094 310.613281 29.109375 346.96875 27.554688 C 346.261719 68.429688 341.210938 104.054688 311.820312 129.242188 C 281.289062 155.425781 234.800781 159.707031 188.070312 160.1875 C 190.066406 136.582031 198.511719 94.707031 231.886719 66.089844 Z M 57.804688 172.273438 C 33.164062 149.695312 28.710938 117.632812 28.03125 80.8125 C 58.402344 82.472656 95.796875 90.371094 123.179688 115.480469 C 151.039062 141.011719 158.445312 178.3125 160.304688 200.054688 C 121.4375 199.507812 83.003906 195.386719 57.804688 172.273438 Z M 57.804688 172.273438 " fill-opacity="1" fill-rule="nonzero"/></svg>`;