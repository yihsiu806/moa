import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';
import {filePath, validateEmail} from './utils';
import { hideLoading } from './utils';

// parameter:
// division
// officer

hideLoading();

if (!division && !officer) {
  $('#editTitle').text('Add New Division');
  $('#officerTitle').text('Officer');
}

initDivisionField();
initOfficerField();
initPictureCallback();
initInputLengthCheck();
initFormValidation();
initSubmitCallback();

function initDivisionField() {
  if (!division) {
    $('#divisionPicture').empty();
    $('#divisionPicture').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white"
    src="/images/division-default-picture.png" alt="division picture">    
    `);
    $('#divisionIcon').empty();
    $('#divisionIcon').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white" src="/images/division-default-icon.svg" alt="division picture">
    `);
    return;
  }
  $('#divisionName').val(division.name);

  $('#divisionPicture').empty();
  if (division.picture) {
    $('#divisionPicture').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white"
    src="${filePath + division.picture}" alt="division picture">    
    `);
  } else {
    $('#divisionPicture').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white"
    src="/images/division-default-picture.png" alt="division picture">    
    `);
  }

  $('#divisionIcon').empty();
  if (division.icon) {
    let svg64 = btoa(division.icon);
    let image64 = 'data:image/svg+xml;base64,' + svg64;
    $('#divisionIcon').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white" src="${image64}" alt="division picture">
    `);
  } else {
    $('#divisionIcon').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white" src="/images/division-default-icon.svg" alt="division picture">
    `);
  }
}

function initOfficerField() {
  if (!officer) {
    $('#officerName').val('TBD');
    $('#officerPosition').val('TBD');
    $('#officerTelephone').val('TBD');
    $('#officerEmail').val('TBD');

    $('#officerPicture').empty();
    $('#officerPicture').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white " src="/images/officer-default-picture.png" alt="officer picture">
    `);

    return;
  }

  $('#officerName').val(officer.name);
  $('#officerPosition').val(officer.position);
  $('#officerTelephone').val(officer.telephone);
  $('#officerEmail').val(officer.email);

  $('#officerPicture').empty();
  if (officer.picture) {
    $('#officerPicture').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white " src="${filePath + officer.picture}" alt="officer picture">
    `)
  } else {
    $('#officerPicture').append(`
    <img class="avatar-icon inline-block overflow-hidden bg-white " src="/images/officer-default-picture.png" alt="officer picture">
    `)
  }
}

function initPictureCallback() {
  const maxPictureSize = 3; // 3 MiB

  $('#editDivisionPicture').on('change', function (event) {
    if (event.target.files.length <= 0) {
      return;
    }

    let $target = $('#divisionPicture');

    let targetPhoto = event.target.files[0];
  
    let filesize = (targetPhoto.size / 1024 / 1024).toFixed(2); // MiB
  
    if (filesize > maxPictureSize) {
      Swal.fire({
        title: 'File size limit',
        text: `File is too big (${filesize}MiB). Max filesize: ${maxPictureSize} MiB.`,
        icon: 'warning',
        confirmButtonColor: '#00a0e9',
      });
      this.value = '';
      $target.get(0).result = null;
      return;
    }
  
    let src = URL.createObjectURL(targetPhoto);
  
    $target.find('img').attr('src', src);
  
    var fr = new FileReader();
    fr.addEventListener('load', function (e) {
      let result = e.target.result;
      $target.get(0).result = result;
    });
  
    fr.readAsDataURL(targetPhoto);
  });

  $('#editOfficerPicture').on('change', function (event) {
    if (event.target.files.length <= 0) {
      return;
    }

    let $target = $('#officerPicture');

    let targetPhoto = event.target.files[0];
  
    let filesize = (targetPhoto.size / 1024 / 1024).toFixed(2); // MiB
  
    if (filesize > maxPictureSize) {
      Swal.fire({
        title: 'File size limit',
        text: `File is too big (${filesize}MiB). Max filesize: ${maxPictureSize} MiB.`,
        icon: 'warning',
        confirmButtonColor: '#00a0e9',
      });
      this.value = '';
      $target.get(0).result = null;
      return;
    }
  
    let src = URL.createObjectURL(targetPhoto);
  
    $target.find('img').attr('src', src);
  
    var fr = new FileReader();
    fr.addEventListener('load', function (e) {
      let result = e.target.result;
      $target.get(0).result = result;
    });
  
    fr.readAsDataURL(targetPhoto);
  });

  $('#editDivisionIcon').on('change', function (event) {
    if (event.target.files.length <= 0) {
      return;
    }

    let $target = $('#divisionIcon')

    let targetPhoto = event.target.files[0];

    let filesize = (targetPhoto.size / 1024).toFixed(2); // KiB

    if (filesize > 60) {
      Swal.fire({
        title: 'File size limit',
        text: `File is too big (${filesize}KiB). Max filesize: 60 KiB.`,
        icon: 'warning',
        confirmButtonColor: '#00a0e9',
      });
      this.value = '';
      $target.get(0).result = null
      return;
    }

    let src = URL.createObjectURL(targetPhoto);

    $target.find('img').attr('src', src);

    var fr = new FileReader();
    fr.addEventListener('load', function (e) {
      let result = e.target.result;
      $target.get(0).result = result
    });

    fr.readAsText(targetPhoto);
    // fr.readAsDataURL(targetPhoto);
  });

  $('#resetDivisionPicture').on('click', function() {
    $('#editDivisionPicture').val('');
    $('#divisionPicture').find('img').attr('src', '/images/division-default-picture.png');
    $('#divisionPicture').get(0).result = 'reset';
  })

  $('#resetOfficerPicture').on('click', function() {
    $('#editOfficerPicture').val('');
    $('#officerPicture').find('img').attr('src', '/images/officer-default-picture.png');
    $('#officerPicture').get(0).result = 'reset';
  })
  
  $('#resetDivisionIcon').on('click', function() {
    $('#editDivisionIcon').val('');
    $('#divisionIcon').find('img').attr('src', '/images/division-default-icon.svg');
    $('#divisionIcon').get(0).result = 'reset';
  })
}

function initInputLengthCheck() {
  $('#divisionName, #officerName, #officerPosition, #officerTelephone, #officerEmail').on('input', function () {
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
}

function initFormValidation() {
  $('input[type="text"]').on('input', function() {
    $('input.is-invalid + div').hide();
    $('input.is-invalid').removeClass('is-invalid border-red-700');
  });

  $('#modifyDivisionForm').on('submit', function(event) {
    event.preventDefault();
  
    let validate = true;
  
    if (!$('#divisionName').val()) {
      validate = false;
      $('#divisionName').addClass('is-invalid');
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
      if ($('#officerEmail').val().trim() != 'TBD') {
        validate = false;
        $('#officerEmail').addClass('is-invalid');
        $('#officerEmail + div').text('Email address is invalid.');
      }
    }
  
    $('input.is-invalid').addClass('border-red-700');
    $('input.is-invalid + div').show();
  
    if (!validate) {
      event.stopImmediatePropagation();
    }
  })
}

function initSubmitCallback() {
  $('#modifyDivisionForm').on('submit', function(event) {

    event.preventDefault();
  
    let data = {
      picture: $('#divisionPicture').get(0).result,
      icon: $('#divisionIcon').get(0).result,
      divisionName: $('#divisionName').val().trim(),
      officerName: $('#officerName').val().trim(),
      officerPosition: $('#officerPosition').val().trim(),
      officerTelephone: $('#officerTelephone').val().trim(),
      officerEmail: $('#officerEmail').val().trim(),
      officerPicture: $('#officerPicture').get(0).result,
      division: division? division.id : null,
    }
  
    axios.patch('/division/edit', data)
    .then(function() {
      Swal.fire({
        title: 'Success',
        icon: 'success',
        text: 'Update division successfully',
        confirmButtonColor: '#056839',
      })
      .then(function() {
        document.getElementById('backBtn').click();
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
}






