import {hideLoading} from './utils';
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
import tippy, {roundArrow, followCursor} from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling
import 'tippy.js/animations/scale.css';
import 'tippy.js/dist/svg-arrow.css';

// remove download column from table 
$('#listTable').find('th').last().remove(); 

// fetchNewest();
// fetchMostDownloaded();
initPagination();

let $filesTable = $('#listTable').DataTable({
  dom: '<"flex flex-wrap justify-between items-center top"f<"w-auto flex justify-center items-center info-page"ip>>t',
  responsive: true,
  processing: true,
  serverSide: true,
  deferRender: true,
  language: {
    info: "_START_ - _END_ of _TOTAL_",
    search: "_INPUT_",
    searchPlaceholder: "Search...",
  },
  ajax: '/public-files/all',
  "order": [[ 2, "desc" ]],
  columnDefs: [
    { "width": "35%", "targets": 0 },
    { "width": "35%", "targets": 1 },
    { "width": "30%", "targets": 2 },
    { className: "dt-head-left", targets: [ 0,1,2 ] },
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
          return moment(data).unix();
        } else {
          return moment(data).calendar();
        }
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


function fetchNewest() {
  axios.get('/public-newest')
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
        let $card = $(`
          <div class="w-[180px] h-[200px] mt-2 mr-5 rounded border border-gray-300 bg-white overflow-hidden relative file-card">
            <div class="h-2/3 text-center py-2 border-b bg-gray-500">
              <img src="/images/file-icon.svg" class="h-full inline-block">
            </div>
            <div class="file-card-footer h-1/3 p-2 pt-0 text-grey-dark">
                <span class="inline-block w-full h-4 font-medium">${title}</span>
                <span class="inline-block w-full h-4 text-sm">${moment(file.updated_at).fromNow()}</span>
            </div>
          </div>
        `);

        tippy($card.find('.file-card-footer').get(0), {
          content: `
            <div class="tippy-desc">
              <div class="tippy-filename">${file.title}</div>
              <div class="tippy-title">Description</div>
              <div>${file.description}</div>
            </div>
            <div class="tippy-footer">
              <span>Duration</span>
              <span>${file.duration}</span>
            </div>
          `,
          placement: 'top-start',
          theme: 'material',
          arrow: roundArrow,
          allowHTML: true,
          followCursor: true,
          plugins: [followCursor],
          theme: 'tomato',
        });

        $('#newestWrapper').append($card);
      })
    }
  })
  .catch(function(error) {
    console.log(error);
    // $('#newestWrapper').empty().append($noDataTemplate.clone());
  });
}

function fetchMostDownloaded() {
  axios.get('/public-most-downloaded')
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
        let $card = $(`
          <div class="w-[180px] h-[200px] mt-2 mr-5 rounded border border-gray-300 bg-white overflow-hidden relative file-card">
            <div class="h-2/3 text-center py-2 border-b bg-gray-500">
              <img src="/images/file-icon.svg" class="h-full inline-block">
            </div>
            <div class="file-card-footer h-1/3 p-2 pt-0 text-grey-dark">
                <span class="inline-block w-full h-4 font-medium">${title}</span>
                <span class="text-sm flex justify-between items-center w-full">
                  <span class="h-4 text-sm">Downloaded</span>
                  <span class="h-4 text-sm">${file.download}</span>
                </span>
            </div>
          </div>
        `);
        
        tippy($card.find('.file-card-footer').get(0), {
          content: `
            <div class="tippy-desc">
              <div class="tippy-filename">${file.title}</div>
              <div class="tippy-title">Description</div>
              <div>${file.description}</div>
            </div>
            <div class="tippy-footer">
              <span>Duration</span>
              <span>${file.duration}</span>
            </div>
          `,
          placement: 'top-start',
          theme: 'material',
          arrow: roundArrow,
          allowHTML: true,
          followCursor: true,
          plugins: [followCursor],
          theme: 'tomato',
        });
        
        $('#mostDownloadedWrapper').append($card);
      })
    }
  })
  .catch(function(error) {
    console.log(error);
    $('#mostDownloadedWrapper').empty().append($noDataTemplate.clone());
  });
}

const $noDataTemplate = $(`
<div class="text-center">
<img src="/images/no-data.svg" class="h-[100px] inline-block" alt="no data">
<div class="mt-5 text-3xl text-semibold text-gray-400">No data available</div>
</div>
`);

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