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
import tippy, {roundArrow, followCursor} from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling
import 'tippy.js/animations/scale.css';
import 'tippy.js/dist/svg-arrow.css';

sessionStorage.removeItem('previousLocation');

initInfoSection();

function initInfoSection() {
  if (division && division.name) {
    $('#divisionName').text(division.name);
  }
  
  if (division && division.picture) {
    $('#divisionPicture').attr('src', '/storage/' + division.picture);
  } else {
    $('#divisionPicture').attr('src', '/images/division-default-picture.png');
  }
  
  if (officer) {
    if (officer.name) {
      $('#officerName').text(officer.name);
    }
    if (officer.position) {
      $('#officerPosition').text(officer.position);
    }
    if (officer.telephone) {
      $('#officerTelephone').text(officer.telephone);
    }
    if (officer.email) {
      $('#officerEmail').text(officer.email);
    }
  }

  if (officer && officer.picture) {
    $('#officerPicture').attr('src', '/storage/' + officer.picture);
  } else {
    $('#officerPicture').attr('src', '/images/officer-default-picture.png');
  }
}

// let $filesTable = $('#filesTable').DataTable({
//   responsive: true,
// });

// (() => {
//   files.forEach(file => {
//     let $node = $(`
//       <tr>
//       <td>${file.title}</td>
//       <td>${file.description}</td>
//       <td>${moment(file.from).format('ll')} ~ ${moment(file.to).format('ll')}</td>
//       <td>${moment(file.updated_at).calendar()}</td>
//       <td>
//         <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="uploads/${file.path}">Download</a>
//       </td>
//       </tr>
//     `);

//     $filesTable.row.add($node).draw();
//   })
// })();

initPagination();

let $filesTable = $('#listTable').DataTable({
  dom: '<"flex flex-wrap justify-between items-center top"f<"w-auto flex justify-center items-center info-page"ip>>t',
  responsive: true,
  processing: true,
  serverSide: true,
  deferRender: true,
  search: {
    return: false
  },
  language: {
    info: "_START_ - _END_ of _TOTAL_",
    search: "_INPUT_",
    searchPlaceholder: "Search...",
  },
  ajax: '/files/'+division.id,
  "order": [[ 2, "desc" ]],
  columnDefs: [
    { "width": "25%", "targets": 0 },
    { "width": "35%", "targets": 1 },
    { "width": "20%", "targets": 2 },
    { "width": "20%", "targets": 3 },
    { className: "dt-head-left", targets: [ 0,1,2,3 ] },
    {
      'targets': [3], /* column index */
      'orderable': false, /* true or false */
    }
  ],
  "columns": [
    { "data": "title" },
    { "data": "division",
      "render": function(data, type, row) {
        if (type == 'display') {
          return data;
        } else if (type == 'sort') {
          return data;
        } else {
          return data;
        }
      }
    },
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
      "data": "path",
      "render": function(data, type, row) {
        return `<a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="/uploads/${row.path}" download="${row.title}">Download</a>`
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
  "rowCallback": function( row, data ) {
    tippy(row.firstChild, {
      content: `
        <div class="tippy-desc">
          <div class="tippy-title">Description</div>
          <div>${data.description}</div>
        </div>
        <div class="tippy-footer">
          <span>Duration</span>
          <span>${data.duration}</span>
        </div>
      `,
      placement: 'top-start',
      theme: 'material',
      // arrow: false,
      arrow: roundArrow,
      allowHTML: true,
      followCursor: true,
      plugins: [followCursor],
      theme: 'tomato',
      // hideOnClick: false,
      // trigger: 'click',
    });
  },
});

$('.dataTables_filter input').addClass('focus:outline-none focus:ring-3 focus:ring-yellow focus:ring-opacity-60');



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
      $nNext.addClass('paginate-arrow next disabled');
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

      if (iCurrentPage >= iPages) {
        $next.addClass('disabled')
      } else {
        $next.removeClass('disabled')
      }
    },
  };
}