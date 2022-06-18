import $ from 'jquery';

let previousPosition = parseInt(sessionStorage.getItem('sidebarScrollOffset'));
if (isFinite(previousPosition)) {
  document.getElementById('sidebar').scroll(0, previousPosition);
}

document.getElementById('sidebar').addEventListener('scroll', function() {
  sessionStorage.setItem('sidebarScrollOffset', this.scrollTop.toFixed());
})

sessionStorage.setItem('currentSidebarPath', location.pathname);