import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';

console.log(files)

$('#addNewFile').on('click', function() {
  $('#uploadFileModal').css("display", "flex")
  .hide()
  .fadeIn();
})

$('#cancelFileModal').on('click', function() {
  $('#uploadFileModal').fadeOut();
})

$('#FileUpload').on('change', function(event) {
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
      confirmButtonColor: '#00a0e9',
    });
    $(this).val('');
    $('#fileTitle').val('');
    return;
  }

  $('#fileTitle').val(target.name);

  let _this = this;
  var fr = new FileReader();
  fr.addEventListener('load', function (e) {
    let result = e.target.result;
    _this.result = result;
  });
  fr.readAsDataURL(target);
})

$('#uploadFile').on('submit', function(event) {
  event.preventDefault();
  let file = {
    title: $('#fileTitle').val(),
    description: $('#fileDescription').val(),
    file: $('#FileUpload').get(0).result
  }
  let req = axios.post('/file', file)
  req
  .then(function() {

  })
  .catch(function() {

  })
  .then(function() {
    $('#uploadFileModal').fadeOut();
    location.reload();
  })
});

(() => {
  let $target = $('#filesTable').find('tbody');
  files.forEach(file => {
    let updated = new Date(file.updated_at).toLocaleDateString();
    $target.append(`
    <tr class="border-b">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
      ${file.title}
    </td>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
      ${updated}
    </td>
    <td class="">
      <button type="button" class="py-2 px-3 text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">Modify</button>
    </td>
    <td class="">
      <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="uploads/${file.path}" download="${file.title}">Download</a>
      
    </td>
    </tr>
    `)
  })
})();
