var web = {
    tapa: {
        show: function () {
            $('body').append('<div id="tapa" class="loading">Loading&#8230;</div>');
        },
        remove: function () {
            $('#tapa').remove();
        }
    }
};