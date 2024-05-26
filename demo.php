<form>
    <input type="text" id="paw-search" placeholder="Search for images">
    <input type="submit" value="Search">
</form>
<style>
    form {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    input[type="text"], input[type="submit"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #333;
        color: #fff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #444;
    }

    #paw-images {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 20px;
    }

    #paw-images img {
        width: 100%;
        height: auto;
    }
    
</style>
<div id="paw-images"></div>

<script>
    jQuery(document).ready(function($) {
        var api = 'l7Pk56fQ7sjfslcgFBUXVuggY5sZ2EIRLtSvM1pBwLyzpIWjdQ93gVpH';
        var search = '';
        var page = 1;
        var per_page = 15;

        $('#paw-search').on('input', function() {
            search = $(this).val();
        });

        $('form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'http://192.168.1.111:9001/wp-json/pexels/v1/search',
                method: 'POST',
                // beforeSend: function(xhr) {
                //     xhr.setRequestHeader('X-WP-Nonce', paw_data.nonce);
                // },
                data: {
                    search: search,
                    api_key: api,
                    page: page,
                    per_page: per_page
                },
                success: function(response) {
                    var images = response;
                    var output = '';

                    $.each(images, function(index, image) {
                        output += '<img src="' + image.src.medium + '" alt="' + image.photographer + '">';
                    });

                    $('#paw-images').html(output);
                }
            });
        });
    });
</script>