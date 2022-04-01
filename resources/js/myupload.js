import $ from 'jquery';
import Swal from 'sweetalert2';
import axios from 'axios';

import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-dt/js/dataTables.dataTables.min.js';
import 'datatables.net-responsive/js/dataTables.responsive.min.js';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import 'datatables.net-responsive-dt/js/responsive.dataTables.min.js';

$('#helloDivision').text(division.name);
if (division.picture && division.picture != 'default') {
  $('#divisionPicture').attr('src', '/storage/' + division.picture);
}
if (officer && officer.picture && officer.picture != 'default') {
  $('#officerPicture').attr('src', '/storage/' + division.picture);
}
$('#officerName').text(officer.name);
$('#officerPosition').text(officer.position);
$('#officerTelephone').text(officer.telephone);
$('#officerEmail').text(officer.email);

(() => {
  let $target = $('#filesTable').find('tbody');
  files.forEach(file => {
    let updated = new Date(file.updated_at).toLocaleDateString();
    $target.append(`
    <tr>
      <td>${file.title}</td>
      <td>${updated}</td>
      <td>
        <button type="button" class="py-2 px-3 text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">Edit</button>
      </td>
      <td>
        <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="uploads/${file.path}" download="${file.title}">Download</a>
      </td>
    </tr>
    `)
  })
  $('#filesTable').DataTable({
    responsive: true,
  });
})();

