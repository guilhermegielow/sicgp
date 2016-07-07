<?class ImagensComponent extends Object
{
        var $controller = true;


//        function upload(){
//        }
        
        function redimensiona($origem,$destino='',$largura='600',$formato='JPEG') {

    switch($formato)
    {
        case 'JPEG':
            $tn_formato = 'jpg';
            break;
        case 'PNG':
            $tn_formato = 'png';
            break;
    }
    $ext = split("[/\\.]",strtolower($origem));
    $n = count($ext)-1;
    $ext = $ext[$n];

    $arr = split("[/\\]",$origem);
    $n = count($arr)-1;
    $arra = explode('.',$arr[$n]);
    $n2 = count($arra)-1;
    $tn_name = str_replace('.'.$arra[$n2],'',$arr[$n]);
    $destino = $destino.$tn_name.'.'.$tn_formato;

    if ($ext == 'jpg' || $ext == 'jpeg'){
        $im = imagecreatefromjpeg($origem);
    }elseif($ext == 'png'){
        $im = imagecreatefrompng($origem);
    }elseif($ext == 'gif'){
        return false;
    }
    $w = imagesx($im);
    $h = imagesy($im);
    if ($w > $h)
    {
        $nw = $largura;
        $nh = ($h * $largura)/$w;
    }else{
        $nh = $largura;
        $nw = ($w * $largura)/$h;
    }
    if(function_exists('imagecopyresampled'))
    {
        if(function_exists('imageCreateTrueColor'))
        {
            $ni = imageCreateTrueColor($nw,$nh);
        }else{
            $ni    = imagecreate($nw,$nh);
        }
        if(!@imagecopyresampled($ni,$im,0,0,0,0,$nw,$nh,$w,$h))
        {
            imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);
        }
    }else{
        $ni    = imagecreate($nw,$nh);
        imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);
    }
    if($tn_formato=='jpg'){
        imagejpeg($ni,$destino,60);
    }elseif($tn_formato=='png'){
        imagepng($ni,$destino);
    }
}
        
        function thumbnail($origem,$destino='/',$largura='70',$pre='',$formato='JPEG') {

        switch($formato)
        {
        case 'JPEG':
            $tn_formato = 'jpg';
            break;
        case 'PNG':
            $tn_formato = 'png';
            break;
        }
    $ext = split("[/\\.]",strtolower($origem));
    $n = count($ext)-1;
    $ext = $ext[$n];

    $arr = split("[/\\]",$origem);
    $n = count($arr)-1;
    $arra = explode('.',$arr[$n]);
    $n2 = count($arra)-1;
    $tn_name = str_replace('.'.$arra[$n2],'',$arr[$n]);
    $destino = $destino.$pre.$tn_name.'.'.$tn_formato;

    if ($ext == 'jpg' || $ext == 'jpeg'){
        $im = imagecreatefromjpeg($origem);
    }elseif($ext == 'png'){
        $im = imagecreatefrompng($origem);
    }elseif($ext == 'gif'){
        return false;
    }
    $w = imagesx($im);
    $h = imagesy($im);
    if ($w > $h)
    {
        $nw = $largura;
        $nh = ($h * $largura)/$w;
    }else{
        $nh = $largura;
        $nw = ($w * $largura)/$h;
    }
    if(function_exists('imagecopyresampled'))
    {
        if(function_exists('imageCreateTrueColor'))
        {
            $ni = imageCreateTrueColor($nw,$nh);
        }else{
            $ni    = imagecreate($nw,$nh);
        }
        if(!@imagecopyresampled($ni,$im,0,0,0,0,$nw,$nh,$w,$h))
        {
            imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);
        }
    }else{
        $ni    = imagecreate($nw,$nh);
        imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);
    }
    if($tn_formato=='jpg'){
        imagejpeg($ni,$destino,60);
    }elseif($tn_formato=='png'){
        imagepng($ni,$destino);
    }
}




}
  ?>
