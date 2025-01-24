function toggleMenu() {
    const menu = document.getElementById('menu');
    const content = document.getElementById('content');
    if (menu.style.left === '0px') {
        menu.style.left = '-250px';
        content.style.marginLeft = '15px';
    } else {
        menu.style.left = '0px';
        content.style.marginLeft = '265px';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const rowsPerPageSelect = document.querySelector('select[name="rows_per_page"]');
    if (rowsPerPageSelect) {
        rowsPerPageSelect.addEventListener('change', function() {
            this.form.submit();
        });
    }
});
