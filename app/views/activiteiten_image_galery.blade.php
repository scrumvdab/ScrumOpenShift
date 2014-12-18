@extends('templates.default')
@section('content')
<?php
// general variables
$imgListArray = array(); // main image array list 
$imgExtArray = array("jpg"); // accepted image extensions (in lower-case !important)
$thumbsDir = "./uploads/thumbs/"; // path to the thumbnails destination directory
$galleryFiles = "./uploads/*/*"; // path to all files and sub-directories (use your own gallery name directory)
// iterate all subdirectories and files 
foreach (glob($galleryFiles) as $file) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)); // get extension in lower-case for validation purposes
    $imagePath = pathinfo($file, PATHINFO_DIRNAME) . "/"; // get path for validation purposes (added trailing slash)
    // if image extension is valid (is in the $imgExtArray array) AND the image is not inside the "thumbs" sub-directory
    if (in_array($ext, $imgExtArray) && $imagePath != $thumbsDir) {
        // additional image variables 
        $imageName = pathinfo($file, PATHINFO_BASENAME); // returns "cheeta.jpg"
        $thumbnail = $thumbsDir . $imageName; // thumbnail full path and name, i.e "./gallery/thumbs/cheeta.jpg"
        $dataFilter = substr($file, 10, 4); // from "./gallery/animals/cheeta.jpg" returns "anim" 
        // for each image, get width and height
        $imageSize = getimagesize($file); // image size 
        $imageWidth = $imageSize[0];  // extract image width 
        $imageHeight = $imageSize[1]; // extract image height
        // set the thumb size
        if ($imageHeight > $imageWidth) {
            // images is portrait so set thumbnail width to 100px and calculate height keeping aspect ratio
            $thumbWidth = 100;
            $thumbHeight = floor($imageHeight * ( 100 / $imageWidth ));
            $thumbPosition = "margin-top: -" . floor(( $thumbHeight - 100 ) / 2) . "px; margin-left: 0";
        } else {
            // image is landscape so set thumbnail height to 100px and calculate width keeping aspect ratio
            $thumbHeight = 100;
            $thumbWidth = floor($imageWidth * ( 100 / $imageHeight ));
            $thumbPosition = "margin-top: 0; margin-left: -" . floor(( $thumbWidth - 100 ) / 2) . "px";
        } // END else if
        // verify if thumbnail exists, otherwise create it
        if (!file_exists($thumbnail)) {
            $createFromjpeg = imagecreatefromjpeg($file);
            $thumb_temp = imagecreatetruecolor($thumbWidth, $thumbHeight);
            imagecopyresized($thumb_temp, $createFromjpeg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $imageWidth, $imageHeight);
            imagejpeg($thumb_temp, $thumbnail);
        } // END if()
        // Create sub-array for this image
        // notice the key,value pair
        $imgListSubArray = array(
            'LinkTo' => $file,
            'ImageName' => $imageName,
            'Datafilter' => $dataFilter,
            'Thumbnail' => $thumbnail,
            'Position' => $thumbPosition
        );
        // Push this sub-array into main array $imgListArray
        array_push($imgListArray, $imgListSubArray);
    } // END if()
} // END foreach()
unset($file); // destroy the reference after foreach()
// END the loop
?>
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
<div class="jumbotron container cf" id="content">
    <div id="galleryTab" class="cf">
        <a data-rel="all" href="javascript:;" class="filter active">Alle foto's</a>
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
    <div class="galleryWrap cf">
        <?php
// shuffle and render
        shuffle($imgListArray); // random order otherwise is boring
        $countedItems = count($imgListArray); // number of images in gallery
// render html links and thumbnails
        for ($row = 0; $row < $countedItems; $row++) {
            // watch out for escaped double quotes 
            echo "<a class=\"fancybox imgContainer\" data-fancybox-group=\"gallery\" href=\"" .
            $imgListArray[$row]['LinkTo'] . "\" data-filter=\"" .
            $imgListArray[$row]['Datafilter'] . "\"><img src=\"" .
            $imgListArray[$row]['Thumbnail'] . "\" style=\"" .
            $imgListArray[$row]['Position'] . "\" alt=\"" .
            $imgListArray[$row]['ImageName'] . "\" /></a>\n";
        } // END for()
        ?>
        <br />
    </div>
</div>

{{ HTML::style('bootstrap/css/jquery-ui.css') }}
{{ HTML::style('fancybox/source/jquery.fancybox.css') }}
{{ HTML::script('http://code.jquery.com/jquery-1.10.2.js') }}
{{ HTML::script('http://code.jquery.com/ui/1.11.1/jquery-ui.js') }}
{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('fancybox/lib/jquery.mousewheel-3.0.6.pack.js') }}
{{ HTML::script('fancybox/source/jquery.fancybox.pack.js') }}

@stop