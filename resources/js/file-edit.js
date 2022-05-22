import {hideLoading} from './utils';
import $ from 'jquery';
import { init } from 'svelte/internal';
import Swal from 'sweetalert2';
import moment from 'moment';

hideLoading();
initForm();

$('#selectFileArea').on('dragover', function() {
  $('#selectFileAreaWrapper').css('border-color', '#facc15');
  $('#selectFileAreaWrapper').css('border-style', 'dashed');
  $('#selectFileAreaWrapper').css('border-width', '6px');
});
$('#selectFileArea').on('dragleave dragend drop', function() {
  $('#selectFileAreaWrapper').css('border-color', '#eee');
  $('#selectFileAreaWrapper').css('border-style', 'solid');
  $('#selectFileAreaWrapper').css('border-width', '4px');
});

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
    this.result = '';
    return;
  }

  let fileName = target.name.split('.').shift();
  let fileExtension = '.' + target.name.split('.').pop();

  $('#selectFileModeOn').hide();
  $('#selectFileModeOff').show();
  $('#selectFileModeOffFileName').text(target.name);
  $('#fileTitle').val(fileName);
  $('#fileExtension').text(fileExtension);

  let _this = this;
  var fr = new FileReader();
  fr.addEventListener('load', function (e) {
    $('#progressBarWrapper').hide();
    let result = e.target.result;
    _this.result = result;
    _this.fileExtension = fileExtension;
  });
  fr.addEventListener('progress', event => {
    let currentNum = Math.trunc(event.loaded/event.total*100) + '%';
    $('#progressNumber').text( currentNum )
    $('#progressRect').css('width', currentNum);

    // console.log((event.loaded/event.total).toFixed(2))
  });
  
  $('#progressBarWrapper').show();
  fr.readAsDataURL(target);
});

$('#selectFileModeOffRemoveBtn').on('click', function(event) {
  $('#selectFileArea').val('');
  $('#selectFileArea').get(0).result = '';
  $('#selectFileArea').get(0).fileExtension = '';
  $('#selectFileModeOff').hide();
  $('#selectFileModeOn').show();
  $('#fileTitle').val('');
  $('#fileExtension').text('');
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
      validate = false;
    }
  }

  // if (!$('#selectFileArea').get(0).result) {
  //   validate = false;
  //   $('#selectFileAreaWrapper').css('border-color', '#dc2626');
  //   $('#selectFileAreaError').css('color', '#dc2626');
  // }

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
    extension: $('#selectFileArea').get(0).fileExtension,
    description: $('#fileDescription').val(),
    file: $('#selectFileArea').get(0).result,
    from: $('#durationFrom').val(),
    to: $('#durationTo').val(),
  }

  Swal.fire({
    title: 'Uploading...',
    didOpen: () => {
      Swal.showLoading()
    },
    allowOutsideClick: false,
  })

  axios.patch('/file/edit/'+file.id, newFile)
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
    let message = error.response.data.message || 'Something went wrong. Sorry.';
    Swal.fire({
      title: 'Error',
      icon: 'error',
      text: message,
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

function initForm() {
  if (!file) {
    return;
  }

  if (file.title) {
    let extension = '.' + file.title.split('.').pop();
    let title = file.title.replace(extension, '');
    $('#fileTitle').val(title);
    $('#fileExtension').text(extension);
    $('#selectFileModeOffFileName').text(file.title);
    $('#selectFileArea').get(0).fileExtension = extension;
  }

  if (file.description) {
    $('#fileDescription').val(file.description)
  }

  if (file.from) {
    $('#durationFrom').val(file.from);
  }

  if (file.to) {
    $('#durationTo').val(file.to);
  }
}