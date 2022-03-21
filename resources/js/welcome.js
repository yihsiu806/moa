import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';
import moment from 'moment';
import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-dt/js/dataTables.dataTables.min.js';
import 'datatables.net-responsive/js/dataTables.responsive.min.js';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import 'datatables.net-responsive-dt/js/responsive.dataTables.min.js';

let $noDataTemplate = $(`
<div class="text-center">
<img src="/images/no-data.svg" class="h-[100px] inline-block" alt="no data">
<div class="mt-5 text-3xl text-semibold text-gray-400">No data available</div>
</div>
`);

fetchNewest();
fetchMostDownloaded();

let $filesTable = $('#filesTable').DataTable({
  responsive: true,
  // processing: true,
  // serverSide: true,
  // ajax: '/files',
});

function fetchNewest() {
  axios.get('/newest')
  .then(function(res) {
    if (res.data.length == 0) {
      throw 'No file found';
    } else {
      $('#newestWrapper').empty();
      res.data.forEach(file => {
        let title = file.title.slice(0, 17);
        if (file.title.length > 17) {
          title += '...'
        }
        $('#newestWrapper').append(`
          <div class="w-[180px] h-[200px] mt-2 mr-5 rounded border border-gray-300 bg-white overflow-hidden relative file-card">
            <div class="hidden absolute top-0 right-0 bottom-0 left-0 flex justify-center items-center" style="background-color: rgba(0,0,0,.5);">
              <a class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5" href="/uploads/${file.path}" download"${file.title}" target="_blank">Download</a>
            </div>
            <div class="h-2/3 text-center py-2 border-b bg-gray-500">
              <img src="/images/file-icon.svg" class="h-full inline-block">
            </div>
            <div class="h-1/3 p-2 pt-0 text-grey-dark">
                <span class="inline-block w-full h-4 font-medium">${title}</span>
                <span class="inline-block w-full h-4 text-sm">${moment(file.updated_at).fromNow()}</span>
            </div>
          </div>
        `);
        $('.file-card').on('mouseover', function() {
          $(this).children().first().css('display', 'flex');
        })
        $('.file-card').on('mouseout', function() {
          $(this).children().first().hide();
        })
      })
    }
  })
  .catch(function(error) {
    console.log(error);
    $('#newestWrapper').empty().append($noDataTemplate.clone());
  });
}

function fetchMostDownloaded() {
  axios.get('/most-downloaded')
  .then(function(res) {
    if (res.data.length == 0) {
      throw 'No file found';
    }  else {
      $('#mostDownloadedWrapper').empty();
      res.data.forEach(file => {
        let title = file.title.slice(0, 17);
        if (file.title.length > 17) {
          title += '...'
        }
        $('#mostDownloadedWrapper').append(`
          <div class="w-[180px] h-[200px] mt-2 mr-5 rounded border border-gray-300 bg-white overflow-hidden relative file-card">
            <div class="hidden absolute top-0 right-0 bottom-0 left-0 flex justify-center items-center" style="background-color: rgba(0,0,0,.5);">
              <a class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5" href="/uploads/${file.path}" download"${file.title}" target="_blank">Download</a>
            </div>
            <div class="h-2/3 text-center py-2 border-b bg-gray-500">
              <img src="/images/file-icon.svg" class="h-full inline-block">
            </div>
            <div class="h-1/3 p-2 pt-0 text-grey-dark">
                <span class="inline-block w-full h-4 font-medium">${title}</span>
                <span class="inline-block w-full h-4 text-sm">${file.download}</span>
            </div>
          </div>
        `);
        $('.file-card').on('mouseover', function() {
          $(this).children().first().css('display', 'flex');
        })
        $('.file-card').on('mouseout', function() {
          $(this).children().first().hide();
        })
      })
    }
  })
  .catch(function(error) {
    console.log(error);
    $('#mostDownloadedWrapper').empty().append($noDataTemplate.clone());
  });
}

(() => {
  files.forEach(file => {
    let $node = $(`
      <tr>
      <td>${file.title}</td>
      <td>${file.description}</td>
      <td>${moment(file.from).format('ll')} ~ ${moment(file.to).format('ll')}</td>
      <td>${file.division}</td>
      <td>${moment(file.updated_at).calendar()}</td>
      <td>
        <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="uploads/${file.path}" download="${file.title}">Download</a>
      </td>
      </tr>
    `);

    $filesTable.row.add($node).draw();
  })
})();