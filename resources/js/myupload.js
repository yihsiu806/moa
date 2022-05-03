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

hideLoading();

$('#helloDivision').text(division.name);
if (division && division.picture) {
  $('#divisionPicture').attr('src', '/storage/' + division.picture);
}
if (officer && officer.picture) {
  $('#officerPicture').attr('src', '/storage/' + officer.picture);
}
$('#officerName').text(officer.name);
$('#officerPosition').text(officer.position);
$('#officerTelephone').text(officer.telephone);
$('#officerEmail').text(officer.email);

// (() => {
//   let $target = $('#filesTable').find('tbody');
//   files.forEach(file => {
//     let updated = new Date(file.updated_at).toLocaleDateString();
//     $target.append(`
//     <tr>
//       <td>${file.title}</td>
//       <td>${updated}</td>
//       <td>
//         <button type="button" class="py-2 px-3 text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">Edit</button>
//       </td>
//       <td>
//         <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="uploads/${file.path}" download="${file.title}">Download</a>
//       </td>
//     </tr>
//     `)
//   })
//   $('#filesTable').DataTable({
//     responsive: true,
//   });
// })();

initPagination();

let $filesTable = $('#filesTable').DataTable({
  dom: '<"flex justify-between items-center top"f<"w-auto flex justify-center items-center info-page"ip>>t',
  responsive: true,
  processing: true,
  serverSide: true,
  deferRender: true,
  // search: {
  //   return: true
  // },
  language: {
    info: "_START_ - _END_ of _TOTAL_",
    search: "_INPUT_",
    searchPlaceholder: "Search...",
  },
  ajax: '/files/all',
  "order": [[ 1, "desc" ]],
  columnDefs: [
    { "width": "30%", "targets": 0 },
    { "width": "20%", "targets": 1 },
    { "width": "20%", "targets": 2 },
    { "width": "20%", "targets": 3 },
    { className: "dt-head-left", targets: [ 0,1,2,3 ] },
    {
      'targets': [2,3], /* column index */
      'orderable': false, /* true or false */
    }
  ],
  "columns": [
    { "data": "title" },
    {
      "data": "updated_at",
      "render": function(data, type, row) {
        if (type === 'sort') {
          // console.log(data)
          // console.log(moment(data).unix())
          return moment(data).unix();
        } else {
          return moment(data).calendar();
        }
      }
    },
    {
      data: "DT_RowId",
      "render": function(data, type, row) {
        return `<button type="button" class="py-2 px-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Edit</button>`
      }
    },
    { 
      "data": "path",
      "render": function(data, type, row) {
        return `<a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="uploads/${row.path}" download="${row.title}">Download</a>`
      }
    },
    
  ],
  pagingType: 'arrows',
  "drawCallback": function( settings ) {
    $('body').removeClass('inactive');
    $('#ltLoader').fadeOut();
    $('#ltPlaceholder').hide();
    $('#ltWrapper').fadeIn();
  },
});

$('.dataTables_filter input').addClass('focus:outline-none focus:ring-3 focus:ring-yellow focus:ring-opacity-60');

function hideLoading() {
  $('body').removeClass('inactive');
  $('#ltLoader').fadeOut();
}

function initPagination() {
  function calcCurrentPage(oSettings) {
    return Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1;
  }

  function calcPages(oSettings) {
    return Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength);
  }
  $.fn.DataTable.ext.pager.arrows = {
    "fnInit": function ( oSettings, nPaging, fnCallbackDraw ) {
      let $nPaging = $(nPaging);
      let $nPrevious = $(`
        <span class="rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>
        </span>
      `);
      let $nNext = $(`
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg>
        </span>
      `);
      $nPrevious.addClass('paginate-arrow prev disabled');
      $nNext.addClass('paginate-arrow next');
      $nPaging.addClass('inline-flex justify-center items-center')
      $nPaging.append($nPrevious);
      $nPaging.append(`<span class="px-2"></span>`)
      $nPaging.append($nNext);

      $nPrevious.on('click', function() {
        var iCurrentPage = calcCurrentPage(oSettings);
        if (iCurrentPage !== 1) {
            oSettings.oApi._fnPageChange(oSettings, 'previous');
            fnCallbackDraw(oSettings);
        }
      });

      $nNext.on('click', function() {
          var iCurrentPage = calcCurrentPage(oSettings);
          if (iCurrentPage !== calcPages(oSettings)) {
              oSettings.oApi._fnPageChange(oSettings, 'next');
              fnCallbackDraw(oSettings);
          }
      });
    },
    "fnUpdate": function (oSettings, fnCallbackDraw) {
      if (!oSettings.aanFeatures.p) {
        return;
      }

      let an = oSettings.aanFeatures.p;

      var iPages = calcPages(oSettings);
      var iCurrentPage = calcCurrentPage(oSettings);

      let $prev = $(an).find('.paginate-arrow.prev');
      let $next = $(an).find('.paginate-arrow.next');

      if (iCurrentPage == 1) {
        $prev.addClass('disabled')
      } else {
        $prev.removeClass('disabled')
      }

      if (iCurrentPage == iPages) {
        $next.addClass('disabled')
      } else {
        $next.removeClass('disabled')
      }
    },
  };
}