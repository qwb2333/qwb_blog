<?php
class QwbImage {
    public $image_type;

    private function ImageInfo($img) { 
        $imageInfo = @getimagesize($img);
        if ($imageInfo !== false) { 
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1)); 
            $imageSize = filesize($img); 
            $Info = array(
            "width" => $imageInfo[0], 
            "height" => $imageInfo[1], 
            "type" => $imageType,
            "size" => $imageSize,
            "mime" => $imageInfo['mime']
        );
            $this->image_type = $Info['mime'];
            return $Info;
        }
        else { 
          return false;
        }
    }
    public function ImageZip($file, $scale) {
        $info = $this->ImageInfo($file);
        if($info === false) return false;
        switch($info['type']) {
            case 'gif':
            $img = imagecreatefromgif($file);
            break;

            case 'jpeg':
            $img = imagecreatefromjpeg($file);
            break;

            case 'png':
            $img = imagecreatefrompng($file);
            break;
        }
        if(!isset($img)) return false;
        if($scale == 1) {
            return @file_get_contents($file);
        }

        $width = $info['width'] * $scale;
        $height = $info['height'] * $scale;
        $now = imagecreatetruecolor($width, $height);
        $otsc = imagecolortransparent($img);
        if($otsc >= 0 && $otsc <= imagecolorstotal($img)) {
            $stran = imagecolorsforindex($img, $otsc);
            $newt = imagecolorallocate($img, $stran['red'], $stran['green'], $stran['blue']); 
            imagefill($now, 0, 0, $newt);
            imagecolortransparent($now, $newt);
        }
        imagecopyresampled($now, $img, 0, 0, 0, 0, $width, $height, $info['width'], $info['height']);
        imagedestroy($img);

        $new_file = tempnam("", "img");
        switch ($info['type']) {
            case 'jpeg':
                imagejpeg($now, $new_file);
                break;

            case 'png':
                imagepng($now, $new_file);
                break;

            case 'gif':
                imagegif($now, $new_file);
                break;
        }
        imagedestroy($now);
        $c = @file_get_contents($new_file);
        unlink($new_file);
        return $c;
    }
}
?>