<?php

echo "<ul class='pagination'>";

if ($page > 1) {
    echo "<li><a href='{$page_url}' title='Przejdz do pierwszej strony.'>";
        echo "Pierwsza strona";
    echo "</a></li>";
}

$total_pages = ceil($total_rows / $records_per_page);

// liczba stron do wybrania z paska
$range = 2;

$initial_num = $page - $range;
$conditional_limit_num = ($page + $range) + 1;

for($x = $initial_num; $x < $conditional_limit_num; $x++) {

    if(($x > 0) && ($x <= $total_pages)) {

        if($x == $page) {
            echo "<li class='active'><a href=\"#\">$x <span class=\"sr-only\">(current)</span></a></li>";
        }

        // nie biezaca
        else {
            echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
        }
    }
}

if($page < $total_pages) {
    echo "<li><a href='" .$page_url. "page={$total_pages}' title='Ostatnią stroną jest {$total_pages}. '>";
        echo "Ostatnia strona";
    echo "</a></li>";
}

echo "</ul>";

?>