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



<?php get_footer() ?>