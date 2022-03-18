import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';

import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-dt/js/dataTables.dataTables.min.js';
import 'datatables.net-responsive/js/dataTables.responsive.min.js';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import 'datatables.net-responsive-dt/js/responsive.dataTables.min.js';

let $usersTable = $('#usersTable').DataTable({
  responsive: true,
});

(() => {
  users.forEach(user => {
    let updated = new Date(users.updated_at).toLocaleDateString();

    let $node = $(`
      <tr>
      <td>${user.role}</td>
      <td>${user.username}</td>
      <td>${user.division}</td>
      <td>${updated}</td>
      <td>
        <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="#">Edit</a>
      </td>
      </tr>
    `);

    $usersTable.row.add($node).draw();
  })
  
})();