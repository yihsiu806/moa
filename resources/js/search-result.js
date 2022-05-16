import {hideLoading} from './utils';
import $ from 'jquery';
import axios from 'axios';
import { mergeDataIntoQueryString } from '@inertiajs/inertia';

hideLoading();

$('#searchResultCount').text(0);

let promise = getSearchResult(0);

function getSearchResult(next) {
  return axios.post('/search', {
    query: searchQuery,
    start: next,
  })
  .then(function(res) {
    generateListView(res.data)
    if (res.data.next) {
      promise = promise.then(function() {
        getSearchResult(res.data.next);
      });
    }
  })
}

function generateListView(data) {

}

