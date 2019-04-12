<?

require_once(__DIR__."/config.php");

$temp = array('width' => 1000, 'height' => 461, 'file' => '2017/12/banner-min.jpg', 'sizes'=>array(
'thumbnail' => array('file' => '2017/12/banner-min.jpg',
'width' => 150,
'height' => 150,
'mime-type' => 'image/jpeg')),
'image_meta' => array
        (
            'aperture' => 0,
            'credit' => '',
            'camera' => '',
            'caption' => '',
            'created_timestamp' => 0,
            'copyright' => '',
            'focal_length' => 0,
            'iso' => 0,
            'shutter_speed' => 0,
            'title' => '',
            'orientation' => 0,
            'keywords' => array()
        )

);

echo maybe_serialize($temp);