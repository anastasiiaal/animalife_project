// function that handles click on .param elements to update query and doctor list
document.addEventListener('DOMContentLoaded', function () {
    let params = document.querySelectorAll('.param');
    params.forEach(function(param) {
        param.addEventListener('click', function() {
            let paramName = this.getAttribute('data-param');
            let url = new URL(window.location);
            url.searchParams.delete(paramName);
            window.location.href = url;
        });
    });
});