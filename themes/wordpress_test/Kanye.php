<?php get_header() ?>
<?php /* Template Name: Kanye Posts */ ?>


<?php
    $url = 'https://api.kanye.rest/';
    $quotes = [];
    
    for ($i = 0; $i < 5; $i++) {
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $quotes[] = $data['quote'];
    }
?>


    <h1>Here are 5 Kanye quotes:</h1>
    <ul>
        <?php foreach ($quotes as $quote): ?>
            <li><?php echo $quote; ?></li>
        <?php endforeach; ?>
    </ul>


    <?php 
    
    function hs_give_me_coffee() {
        $url = 'http://localhost/wordpress_test_project/wp-json';
        $response = wp_remote_get( $url );
        if( is_wp_error( $response ) ) {
            return false;
        }
        $body = wp_remote_retrieve_body( $response );
        $coffee_data = json_decode( $body );
        return $coffee_data->file;
    }
    
    
    
    ?>


<?php get_footer() ?>