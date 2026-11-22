(function () {
  document.addEventListener('DOMContentLoaded', function () {
    // 注意：不要手动 toggle .navbar-toggler 的折叠状态——
    // bootstrap.bundle.min.js 已通过 data-bs-toggle="collapse" 处理，
    // 手动 toggle 会与 Bootstrap 逻辑互相抵消，导致菜单打不开。

    var searchForms = document.querySelectorAll('.blog-search-form');
    searchForms.forEach(function (form) {
      form.addEventListener('submit', function (e) {
        var input = form.querySelector('input[type="search"], input[type="text"]');
        if (input && !input.value.trim()) {
          e.preventDefault();
          input.focus();
        }
      });
    });
  });
})();
