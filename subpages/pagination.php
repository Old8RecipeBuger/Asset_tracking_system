<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">      
        <?php
        //$url= "../subpages/taballoc.php?value=history";
        //this is to set up first and previous button
        echo "<li class=\"page-item\">";
        echo "<a class=\"page-link\" href=\"{$url}1\">First</a>";
        echo "<a class=\"page-link\" href=\"{$url}{$previous}\">Previous</a>";
        echo "</li>";

        $links = "";
        
        if ($pages > 1 && $page <= $pages) {
            $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}1\">1</a></li>";
            $i = max(2, $page - 5);
            if ($i > 2){
                $links .= "<li class=\"page-item\"><a class=\"page-link\" >...</a></li>";
            }
            for (; $i < min($page + 6, $pages); $i++) {
                $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$i}\">{$i}</a></li>";
            }
            if ($i != $pages){
                $links .= "<li class=\"page-item\"><a class=\"page-link\" >...</a></li>";
            }
            $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$pages}\">{$pages}</a></li>";
        }
        elseif ($pages == 1){
            $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}1\">1</a></li>";
        }
        echo "$links";

        //this is to set up next and last button
        echo "<li class=\"page-item\">";
        echo "<a class=\"page-link\" href=\"{$url}{$next}\">Next</a>";
        echo "<a class=\"page-link\" href=\"{$url}{$pages}\">Last</a>";
        echo "</li>";
        ?>
    </ul>
</nav>