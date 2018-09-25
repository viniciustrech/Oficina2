<?php

namespace App\Services;

class Upload
{

    public function resize($origem, $destino, $max_width, $max_height, $force = false)
    {

        list($orig_width, $orig_height) = getimagesize($origem);

        $width = $orig_width;
        $height = $orig_height;

        if ($force) {

            $width = $max_width;
            $height = $max_height;

        } else {

            if ($width > $height) {
                $height = $height * $max_width / $width;
                $width = $max_width;
            } else {
                $width = $width * $max_height / $height;
                $height = $max_height;
            }

        }
        $image_p = imagecreatetruecolor($width, $height);

        //$image = imagecreatefromjpeg($origem);
        //Trocar linha acima para upload jpg/png com fundo branco
        $image = imagecreatefromstring(file_get_contents($origem));
        $branco = imagecolorallocate($image_p, 255, 255, 255);
        imagefill($image_p, 0, 0, $branco);


        imagecopyresampled($image_p, $image, 0, 0, 0, 0,
            $width, $height, $orig_width, $orig_height);

        imagejpeg($image_p, $destino, 100);
    }


    public function marca_dagua($foto, $tamanho = false)
    {

        if ($tamanho == 1){
            $marca = public_path() . "/upload/marcadagua/logo_p.png";
        }else{
            $marca = public_path() . "/upload/marcadagua/logo.png";
        }

        //altera o tamanho da logo

        $imagem_original = $foto; //nome da imagem original
        $logo_img = $marca; //nome da logo (utilize png ou gif com fundo transparente)

        $padding = 10; //define o espaço que a logo terá no lado esquerdo e na parte de baixo
        $opacidade = 15; //define a porcentagem de transparência da logo ( 100 é totalmente vizivel 0 é invisivel)

        $logo = imagecreatefrompng($logo_img); //cria a logo
        imagefilter($logo, IMG_FILTER_SMOOTH, 50);
        $imagem = imagecreatefromjpeg($imagem_original); //cria a imagem original
        imagefilter($imagem, IMG_FILTER_SMOOTH, 50);
        if ($imagem || $logo) {

            $logo_size = getimagesize($logo_img); //obtêm as dimensões da logo
            $logo_width = $logo_size[0]; //atribui a largura da logo
            $logo_height = $logo_size[1]; //atribui a altura da logo
            $imagem_size = getimagesize($imagem_original); //obtêm as dimensões da imagem original
            $dest_x = $imagem_size[0] - $logo_width - $padding;//define a posição horizontal que a logo se posicionará
            $dest_y = $imagem_size[1] - $logo_height - $padding;//define a posição vertical que a logo se posicionará

            // força o fundo transparente no logo
            $bg = imagecolortransparent($logo, imagecolorallocatealpha($logo, 255, 255, 255, 127));
            imagefill($logo, 0, 0, $bg);

            imagecopymerge($imagem, $logo, $dest_x, $dest_y, 0, 0, $logo_width, $logo_height, $opacidade);//cópia marca d'água na imagem original

            imagejpeg($imagem, $imagem_original, 100);
            imagedestroy($imagem);
            imagedestroy($logo);
        }
    }

    public function resizepng($origem, $destino, $max_width, $max_height, $force = false)
    {

        list($orig_width, $orig_height) = getimagesize($origem);

        $width = $orig_width;
        $height = $orig_height;

        if ($force) {

            $width = $max_width;
            $height = $max_height;

        }

//        else {
//
//            if ($width > $height) {
//                $height = $height * $max_width / $width;
//                $width = $max_width;
//            } else {
//                $width = $width * $max_height / $height;
//                $height = $max_height;
//            }
//
//        }

        $image_p = imagecreatetruecolor($width, $height);

        imagealphablending($image_p, false);
        imagesavealpha($image_p, true);
        $transparent = imagecolorallocatealpha($image_p, 255, 255, 255, 127);
        imagefilledrectangle($image_p, 0, 0, $width, $height, $transparent);

        $image = imagecreatefromstring(file_get_contents($origem));

        imagecopyresampled($image_p, $image, 0, 0, 0, 0,
            $width, $height, $orig_width, $orig_height);

        //quality maxima é 9 para png
        imagepng($image_p, $destino, 9);
    }


}
