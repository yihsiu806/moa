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

let $filesTable = $('#filesTable').DataTable({
  responsive: true,
});

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