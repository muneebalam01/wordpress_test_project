jQuery(document).ready(function($) {
    $.ajax({
        url: '/wordpress_test_project/wp-admin/admin-ajax.php',
        type: 'POST',
        dataType: "text",
        data: {
            action: 'my_ajax_endpoint'
        },
        success: function(response) { 
            $('#custom-posts-container').html(response);
            console.log(response);
            $('#myposts').append(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
    $.ajax({
        url: '/wordpress_test_project/wp-admin/admin-ajax.php',
        type: 'POST',
        dataType: "text",
        data: {
            action: 'my_ajax_endpoint_loggedin'
        },
        success: function(response) {
            $('#custom-posts-container').html(response);
            console.log(response);
            $('#myposts').append(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
});
