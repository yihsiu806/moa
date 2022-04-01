import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';

// parameter
// division
// officer

initDivisionField();
initOfficerField();

if (!division && !officer) {
  $('#editTitle').text('Add New Division');
}

function initDivisionField() {
  if (!division) {
    return;
  }
  $('#divisionName').val(division.name);
  $('#divisionSlug').val(division.slug);

  if (division.picture && division.picture != 'default') {
    $('#divisionPicture').attr('src', '/storage/' + division.picture);
    $('#divisionPicture').get(0).result = division.picture;
  }

  $('#divisionIcon').attr('src', 'data:image/svg+xml;base64,'+ btoa(division.icon));
  $('#divisionIcon').get(0).result = division.icon;
}

function initOfficerField() {
  if (!officer) {
    return;
  }

  $('#officerName').val(officer.name);
  $('#officerPosition').val(officer.position);
  $('#officerTelephone').val(officer.telephone);
  $('#officerEmail').val(officer.email);
  if (officer.picture && officer.picture != 'default') {
    $('#officerPicture').attr('src', '/storage/' + officer.picture);
    $('#officerPicture').get(0).result = officer.picture;
  }
}

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
      $('#divisionPicture').get(0).result = null;
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
      $('#officerPicture').get(0).result = null;
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
      $('#divisionIcon').get(0).result = null
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
    $('#divisionPicture').get(0).result = null;
  })
  
  $('#resetDivisionIcon').on('click', function() {
    $('#editDivisionIcon').val('');
    $('#divisionIcon').attr('src', '/images/division-default-icon.svg');
    $('#divisionIcon').get(0).result = null;
  })

  $('#resetOfficerPicture').on('click', function() {
    $('#editOfficerPicture').val('');
    $('#officerPicture').attr('src', '/images/officer-default-picture.png');
    $('#officerPicture').get(0).result = null;
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

  axios.patch('/division/edit', data)
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
    let message = error.response.data.message || 'Something went wrong. Sorry.';;
    Swal.fire({
      title: 'Error',
      icon: 'error',
      text: message,
      confirmButtonColor: '#056839',
    })
  });
});