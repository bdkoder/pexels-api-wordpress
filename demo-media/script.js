(function ($) {
    $(document).ready(function () {
        console.log('script.js loaded 1');

        var api = 'l7Pk56fQ7sjfslcgFBUXVuggY5sZ2EIRLtSvM1pBwLyzpIWjdQ93gVpH';
        var page = 1;
        var per_page = 15;
        var loading = false;
        var search = '';
        var searchMode = false;

        function loadImages(reset = false) {
            if (loading) return;
            loading = true;

            // Show the loading indicator
            $('#loading-indicator').show();

            var url = searchMode ? 'http://192.168.1.111:9001/wp-json/pexels/v1/search' : 'http://192.168.1.111:9001/wp-json/pexels/v1/curated';
            var data = {
                api_key: api,
                page: page,
                per_page: per_page
            };

            if (searchMode) {
                data.search = search;
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                success: function (response) {
                    var images = response;
                    var output = '';

                    $.each(images, function (index, image) {
                        output += '<img src="' + image.src.medium + '" alt="' + image.photographer + '">';
                    });

                    if (reset) {
                        $('#paw-images').html(output);
                    } else {
                        $('#paw-images').append(output);
                    }

                    // Hide the loading indicator
                    $('#loading-indicator').hide();

                    loading = false;
                    page++;
                },
                error: function () {
                    // Hide the loading indicator
                    $('#loading-indicator').hide();

                    loading = false;
                }
            });
        }

        function checkScroll() {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                loadImages();
            }
        }

        $(window).on('scroll', checkScroll);

        // Initial load
        loadImages();

        // Search form submission
        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            search = $('#search-input').val().trim();
            page = 1;
            searchMode = true;
            loadImages(true);
        });
        
    });
})(jQuery);
