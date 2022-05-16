import $ from 'jquery';

$('#searchBtn').on('click', function() {
  let query = $('#searchInput').val().trim();
  window.location.href = '/search-result/'+query;
})