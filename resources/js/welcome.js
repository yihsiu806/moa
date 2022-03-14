import $ from 'jquery';
import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-dt/css/jquery.dataTables.css';
import 'datatables.net-dt/js/dataTables.dataTables.min.js';
import 'datatables.net-responsive/js/dataTables.responsive.min.js';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import 'datatables.net-responsive-dt/js/responsive.dataTables.min.js';

console.log(files);
console.log(users);

(() => {
  let $target = $('#filesTable').find('tbody');
  files.forEach(file => {
    let owner = file.owner;
    owner = users.filter(user => {
      if (user.id == owner) {
        return true;
      }
    })
    let updated = new Date(file.updated_at).toLocaleDateString();
    $target.append(`
    <tr>
    <td>
      ${file.title}
    </td>
    <td>
      ${owner[0].username}
    </td>
    <td>
      ${updated}
    </td>
    <td>
      <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="storage/${file.path}" download="${file.title}">Download</a>
    </td>
    </tr>
    `)
  });
  $('#filesTable').DataTable({
    responsive: true,
  });
})();
