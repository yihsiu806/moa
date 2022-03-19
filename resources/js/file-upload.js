import $ from 'jquery';
import Swal from 'sweetalert2';
import moment from 'moment';

$('#selectFileArea').on('change', function(event) {
  if (event.target.files.length <= 0) {
    return;
  }
  
  let target = event.target.files[0];
  let filesize = (target.size / 1024 / 1024).toFixed(2); //MiB

  if (filesize > 1024) {
    Swal.fire({
      title: 'File size limit',
      text: `File is too big (${filesize}MiB). Max filesize: 1GiB.`,
      icon: 'warning',
      confirmButtonColor: '#056839',
    });
    $(this).val('');
    $('#fileTitle').val('');
    return;
  }

  $('#selectFileModeOn').hide();
  $('#selectFileModeOff').show();
  $('#selectFileModeOffFileName').text(target.name);

  $('#fileTitle').val(target.name);

  let _this = this;
  var fr = new FileReader();
  fr.addEventListener('load', function (e) {
    let result = e.target.result;
    _this.result = result;
  });
  fr.readAsDataURL(target);
});

$('#selectFileModeOffRemoveBtn').on('click', function(event) {
  $('#selectFileArea').val('');
  $('#selectFileArea').get(0).result = '';
  $('#selectFileModeOff').hide();
  $('#selectFileModeOn').show();
  $('#fileTitle').val('');
})

$('#uploadFileForm').on('submit', function(event) {
  event.preventDefault();

  let validate = true;

  if (!$('#fileTitle').val()) {
    validate = false;
    $('#fileTitle').addClass('is-invalid');
  }

  if (!$('#fileDescription').val()) {
    validate = false;
    $('#fileDescription').addClass('is-invalid');
  }

  if (!$('#durationFrom').val()) {
    validate = false;
    $('#durationFrom').addClass('is-invalid');
  }
  if (!$('#durationTo').val()) {
    validate = false;
    $('#durationTo').addClass('is-invalid');
  }

  if ($('#durationFrom').val() && $('#durationTo').val()) {
    let from = moment($('#durationFrom').val());
    let to = moment($('#durationTo').val());
    let isafter = to.isAfter(from);
    if (!isafter) {
      Swal.fire({
        title: 'Duration Error',
        text: `Start date exceed end date.`,
        icon: 'warning',
        confirmButtonColor: '#058344',
      });
    }
  }

  if (!$('#selectFileArea').get(0).result) {
    validate = false;
    $('#selectFileAreaWrapper').css('border-color', '#dc2626');
    $('#selectFileAreaError').css('color', '#dc2626');
  }

  $('input.is-invalid').addClass('border-red-700');
  $('textarea.is-invalid').addClass('border-red-700');
  $('input.is-invalid + div').show();
  $('textarea.is-invalid + div').show();

  if (!validate) {
    event.stopImmediatePropagation();
  }
});

(() => {
  $('input[type="text"], input[type="date"], input[type="file"], textarea').on('input change', function() {
    $('input.is-invalid + div').hide();
    $('input.is-invalid').removeClass('is-invalid border-red-700');
    $('textarea.is-invalid + div').hide();
    $('textarea.is-invalid').removeClass('is-invalid border-red-700');
    $('#selectFileAreaWrapper').css('border-color', '#eee');
    $('#selectFileAreaError').css('color', '#5f6982');
  });
})();

$('#uploadFileForm').on('submit', function(event) {
  event.preventDefault();

  let newFile = {
    title: $('#fileTitle').val(),
    description: $('#fileDescription').val(),
    file: $('#selectFileArea').get(0).result,
    from: $('#durationFrom').val(),
    to: $('#durationTo').val(),
  }

  axios.post('/upload/file', newFile)
  .then(function() {
    Swal.fire({
      title: 'Success',
      icon: 'success',
      text: 'Upload file successfully',
      confirmButtonColor: '#056839',
    })
    .then(function() {
      $('#goBack').get(0).click();
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
});

(() => {
  $('#fileTitle').on('input', function () {
    let limit = 128;
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

  $('#fileDescription').on('input', function () {
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
})();