import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';
import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-dt/js/dataTables.dataTables.min.js';
import 'datatables.net-responsive/js/dataTables.responsive.min.js';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import 'datatables.net-responsive-dt/js/responsive.dataTables.min.js';

hideLoading();

initPagination();

let $usersTable = $('#usersTable').DataTable({
  dom: '<"flex justify-between items-center top"f<"w-auto flex justify-center items-center info-page"ip>>t',
  responsive: true,
  language: {
    info: "_START_ - _END_ of _TOTAL_",
    search: "_INPUT_",
    searchPlaceholder: "Search...",
  },
  columnDefs: [
    { "width": "15%", "targets": 0 },
    { "width": "15%", "targets": 1 },
    { "width": "25%", "targets": 2 },
    { "width": "25%", "targets": 3 },
    { "width": "20%", "targets": 4 },
    { className: "dt-head-left", targets: [ 0,1,2,3,4 ] },
    {
      'targets': [4], /* column index */
      'orderable': false, /* true or false */
    }
  ],
  pagingType: 'arrows',
});

let $divisionsTable = $('#divisionsTable').DataTable({
  dom: '<"flex justify-between items-center top"f<"w-auto flex justify-center items-center info-page"ip>>t',
  responsive: true,
  language: {
    info: "_START_ - _END_ of _TOTAL_",
    search: "_INPUT_",
    searchPlaceholder: "Search...",
  },
  columnDefs: [
    { "width": "25%", "targets": 0 },
    { "width": "25%", "targets": 1 },
    { "width": "20%", "targets": 2 },
    { "width": "15%", "targets": 3 },
    { "width": "15%", "targets": 4 },
    { className: "dt-head-left", targets: [ 0,1,2,3,4 ] },
    {
      'targets': [3], /* column index */
      'orderable': false, /* true or false */
    }
  ],
  pagingType: 'arrows',
});

$('.dataTables_filter input').addClass('focus:outline-none focus:ring-3 focus:ring-yellow focus:ring-opacity-60');

(() => {
  users.forEach(user => {
    let updated = new Date(user.updated_at).toLocaleDateString();

    let $node = $(`
      <tr>
      <td>${user.role}</td>
      <td>${user.username}</td>
      <td>${user.division ? user.division : ''}</td>
      <td>${updated}</td>
      <td id="user-${user.id}">
        <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="/user/edit/${user.id}" onclick="(() => {sessionStorage.setItem('previousLocation', 'user-${user.id}')})();">Edit</a>
      </td>
      </tr>
    `);

    $usersTable.row.add($node).draw();
  })
})();

function deleteDivision(event) {
  let id = this.getAttribute('data-id');

  let promise;
  promise = Swal.fire({
    title: `Are you sure delete "${$(this).closest('tr').children().first().text()}"?`,
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#056839',
    confirmButtonText: 'Yes, delete it!'
  })
  
  promise = promise.then((result) => {
    if (result.isConfirmed) {
      return axios.patch('/division/delete', {id: id})
    } else {
      return Promise.reject('cancel');
    }
  });

  let _this = this;

  promise
  .then(function() {
    Swal.fire({
      title: 'Deleted!',
      icon: 'success',
      text: `Division "${$(_this).closest('tr').children().first().text()}" has been deleted.`,
      confirmButtonColor: '#056839',
    })
    .then(function() {
      location.reload();
    })
  })
  .catch(function(error) {
    if (error == 'cancel') {
      return;
    }
    console.log(error);
    let message = error.response.data.message || 'Something went wrong. Sorry.';
    Swal.fire({
      title: 'Error',
      icon: 'error',
      text: message,
      confirmButtonColor: '#056839',
    })
  })
  .then(function() {
    sessionStorage.removeItem('previousLocation');
    $('#divisionsTable').get(0).scrollIntoView({block: "center"});
  })
}

(() => {
  divisions.forEach(division => {
    let updated = new Date(division.updated_at).toLocaleDateString();

    let $tr = $('<tr>');

    $tr.append(`
      <td>${division.name}</td>
      <td>${division.officer ? division.officer : ''}</td>
      <td>${updated}</td>
      <td id="division-${division.id}">
        <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="/division/edit/${division.id}" onclick="(() => {sessionStorage.setItem('previousLocation', 'division-${division.id}')})();">Edit</a>
      </td>
    `);

    let $td = $('<td>');

    let $btn = $(`
    <button data-id="${division.id}" type="button" class="py-2 px-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Delete</button>
    `);

    $btn.on('click', deleteDivision);

    $td.append($btn);
    $tr.append($td);

    // console.log($tr);

    $divisionsTable.row.add($tr).draw();
  })
})();

if (sessionStorage.getItem('previousLocation')) {
  let id = sessionStorage.getItem('previousLocation');
  $(`#${id}`).get(0).scrollIntoView({block: "center"});
}



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