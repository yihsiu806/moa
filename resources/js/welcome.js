import $ from 'jquery';

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
    <tr class="border-b">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
      ${file.title}
    </td>
    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
      ${owner[0].username}
    </td>
    <td class="">
      ${updated}
    </td>
    <td class="">
      <a class="py-2 px-3 text-white bg-green hover:bg-green-light focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" href="storage/${file.path}" download="${file.title}">Download</a>
    </td>
    </tr>
    `)
  })
})();
