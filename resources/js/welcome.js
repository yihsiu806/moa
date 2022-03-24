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
import 'datatables.net-buttons/js/buttons.colVis.min.js';
import 'datatables.net-buttons/js/dataTables.buttons.min.js';
import 'datatables.net-buttons-dt/css/buttons.dataTables.min.css';
import 'datatables.net-buttons-dt/js/buttons.dataTables.min.js';

let $noDataTemplate = $(`
<div class="text-center">
<img src="/images/no-data.svg" class="h-[100px] inline-block" alt="no data">
<div class="mt-5 text-3xl text-semibold text-gray-400">No data available</div>
</div>
`);

fetchNewest();
fetchMostDownloaded();

// axios.get('/files')
// .then(function(res) {
//   console.log(res.data)
// })

let $filesTable = $('#filesTable').DataTable({
  dom: 'Bfrtip',
  buttons: [
    'colvis'
  ],
  responsive: true,
  processing: true,
  serverSide: true,
  ajax: '/files',
  deferRender: true,
  search: {
    return: false
  },
  columnDefs: [
    { orderable: false, targets: 5 },
    { visible: false, targets: [4,5,6] },
    { class: 'col-2', targets: 2 },
  ],
  "columns": [
    { "data": "title" },
    { "data": "division" },
    {
      "data": "updated_at",
      "render": function(data, type, row) {
        if (type === 'sort') {
          return moment(data);
        }
        return moment(data).calendar()
      }
    },
    { 
      "data": "path",
      "render": function(data, type, row) {
        return `<a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="uploads/${row.path}" download="${row.title}">Download</a>`
      }
    },
    { "data": "description" },
    { 
      "data": "duration",
      "render": function(data, type, row) {
        if (type === 'display') {
          return moment(row.from).format('ll') + ' ~ ' + moment(row.to).format('ll');
        } else if (type === 'filter') {
          return moment(row.from).format('ll') + ' ' + moment(row.to).format('ll');
        } else if (type === 'sort') {
          return moment(row.from);
        }
        return data;
      }
    },
    { "data": "download" },
    
    
  ],
  "language": {
    "info": "_START_ - _END_ of _TOTAL_",
  },
  "pagingType": "simple",
  drawCallback: function() {
    $('#filesTable_paginate').empty();
    $('#filesTable_paginate').addClass('inline-flex justify-center items-center')
    $('#filesTable_paginate').append(`
      <span id="customPrevious" class="p-3 mr-5 ml-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#5F6368" d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>
      </span>
      <span id="customNext" class="p-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#5F6368" d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg>
      </span>
    `);
    $('#customNext').on( 'click', function () {
      $filesTable.page( 'next' ).draw( 'page' );
    } );

    $('#customPrevious').on( 'click', function () {
      $filesTable.page( 'previous' ).draw( 'page' );
    } );
  },
});

$('#filesTable').after('<div class="files-table-footer flex justify-end items-center mt-5 mb-5 mr-5"></div>');
$('.files-table-footer').append($('#filesTable_info'))
$('.files-table-footer').append($('#filesTable_paginate'))




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
                <span class="text-sm flex justify-between items-center w-full">
                  <span class="h-4 text-sm">Downloaded</span>
                  <span class="h-4 text-sm">${file.download}</span>
                </span>
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

// (() => {
//   files.forEach(file => {
//     let $node = $(`
//       <tr>
//       <td>${file.title}</td>
//       <td>${file.description}</td>
//       <td>${moment(file.from).format('ll')} ~ ${moment(file.to).format('ll')}</td>
//       <td>${file.division}</td>
//       <td>${moment(file.updated_at).calendar()}</td>
//       <td>
//         <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="uploads/${file.path}" download="${file.title}">Download</a>
//       </td>
//       </tr>
//     `);

//     $filesTable.row.add($node).draw();
//   })
// })();