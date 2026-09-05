function debounce(func, wait) {
    let timeout;
    return function(...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
    };
}

const debouncedDisplayRealtime = debounce(function() {
    display_realtime(1); // Call the function with the first page
}, 300);

$(".mySearch").on("keyup", function () {
    var searchTerm = $(this).val().toLowerCase().trim();
    debouncedDisplayRealtime();
});;