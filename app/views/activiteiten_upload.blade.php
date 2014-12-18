@extends('templates.default')
@section('content')
<!--begin inhoud-->

<div class="jumbotron container cf" id="content">
    <h2>Foto's toevoegen</h2>
    <div id="galleryTab" class="cf">
        <a data-rel="all" href="javascript:;" class="filter active">Kies de juiste activiteit</a>
        <?php
        // render category selector tabs
        $galleryDir = "./uploads/*"; // target directories under gallery : notice the star "*" after the trailing slash  
        foreach (glob($galleryDir, GLOB_ONLYDIR) as $dir) {
            // render category selector tabs and exclude the thumbnail directory
            if ($dir != "./uploads/thumbs") {
                $dataRel = substr($dir, 10, 4); // return first 4 letters of each folder as category
                $dirName = trim(substr($dir, 10, 200)); // returns a trimmed string (200 chars length) with name of folder without parent folder
                echo "<a data-rel=\"" . $dataRel . "\" href=\"javascript:;\" class=\"filter\">" . $dirName . "</a>";
            } // END if()
        } // END foreach()
        unset($dir);
        ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        // The Fancybox script
        $(".fancybox").fancybox();
        // The category selector jQuery script
        $(".filter").on("click", function () {
            var $this = $(this);
            // if we click the active tab, do nothing
            if (!$this.hasClass("active")) {
                $(".filter").removeClass("active");
                $this.addClass("active"); // set the active tab
                var $filter = $this.data("rel"); // get the data-rel value from selected tab and set as filter
                $filter == 'all' ? // if we select "view all", return to initial settings and show all
                        $(".fancybox").attr("data-fancybox-group", "gallery").not(":visible").fadeIn()
                        : // otherwise
                        $(".fancybox").fadeOut(0).filter(function () {
                    return $(this).data("filter") == $filter; // set data-filter value as the data-rel value of selected tab
                }).attr("data-fancybox-group", $filter).fadeIn(1000); // set data-fancybox-group and show filtered elements
            } // if
        }); // on
    }); // ready
</script>
{{ HTML::style('bootstrap/css/jquery-ui.css') }}
{{ HTML::style('fancybox/source/jquery.fancybox.css') }}
{{ HTML::script('http://code.jquery.com/jquery-1.10.2.js') }}
{{ HTML::script('http://code.jquery.com/ui/1.11.1/jquery-ui.js') }}
{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('fancybox/lib/jquery.mousewheel-3.0.6.pack.js') }}
{{ HTML::script('fancybox/source/jquery.fancybox.pack.js') }}

@stop