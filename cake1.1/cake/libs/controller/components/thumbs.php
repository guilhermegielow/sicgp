<?class ThumbsComponent extends Object
{
        var $controller = true;

        function createThumbnail($file, $maxsize = 140)
        {
                if(!eregi("^image\/(jpeg)$", $file["type"]) || ($maxsize < 10))
                        return null;
                else {
                        $newfilename = md5(uniqid(time())) . ".jpg";
                        $newfilepath = "img/thumbs/" . $newfilename;
                        list($width_orig, $height_orig) = getimagesize($file["tmp_name"]);
                        if(($height_orig < $maxsize) && ($width_orig < $maxsize)) {
                                if($height_orig > $width_orig) {
                                        $width = $height = $height_orig;
                                } else {
                                        $width = $height = $width_orig;
                                }
                        } else {
                                $width = $height = $maxsize;
                        }
                        $ratio_orig = $width_orig/$height_orig;
                        if ($width/$height > $ratio_orig) {
                                $width = $height*$ratio_orig;
                        } else {
                                $height = $width/$ratio_orig;
                        }
                        $image_placeholder = imagecreatetruecolor($width, $height);
                        $image = imagecreatefromjpeg($file["tmp_name"]);
                        imagecopyresampled(     $image_placeholder,
                                                                $image,
                                                                0, 0, 0, 0,
                                                                $width, $height,
                                                                $width_orig, $height_orig);
                        imagejpeg($image_placeholder, $newfilepath, 90);
                        return $newfilename;
                }
        }


}
  ?>
