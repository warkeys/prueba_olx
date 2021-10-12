<style>
  
  body {
    background-color: #ddd;
  }
  .img{
    width: 250px;
    height: 250px;
  }

  .container{
    text-align: center;
  }

  .title{
    font-weight: 400;
    margin: 0;
    font-size: 16px;
    color: rgba(0,47,52,.64);
    line-height: 24px;
    word-break: break-word;
  }

  .price{
    direction: ltr;
    font-weight: 700;
    margin-bottom: 8px;
    color: #002f34;
    font-size: 34px;
    line-height: 32px;
  }
</style>

<?php

//Url de la prueba
$product = 'https://www.olx.com.pe/item/collagen-390-iid-1104290964';
$url = file_get_contents($product);

$doc = new DOMDocument();
@$doc->loadHTML($url);



//Extraer titulo
foreach ($doc->getElementsByTagName('h1')as $div) {
    if ($div->getAttribute('class') === '_3rJ6e') {
        $title = $div->nodeValue;
    }
}

//Extraer precio
foreach ($doc->getElementsByTagName('span')as $div) {
    if ($div->getAttribute('class') === '_2xKfz') {
        $price = $div->nodeValue;
    }
}


echo '<div class=container>';
echo '<span class=price>Precio: '. $price.'</span>';
echo '<br>';
echo '<span class=title>Título del post: '. $title.'</span>';
echo '<br>';

//Extraer imagen
$image = $doc->getElementsByTagName('img');


foreach ($image as $img) {
    $imageExt = $img->getAttribute('src').' | '.$img->nodeValue;

    $porciones = explode("|", $imageExt);
    echo "<img class='img' src='".$porciones[0]."'>";
    break;
}
echo '</div>';
