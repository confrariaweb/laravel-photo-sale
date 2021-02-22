<?php

namespace ConfrariaWeb\PhotoSale\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class PolaroidFilter implements FilterInterface
{
    public function applyFilter(Image $img)
    {
        $width = $img->width();
        $height = $img->height();
        $rotate = ($width <= $height)? 0 : -90;
        return $img
            ->rotate($rotate)
            ->fit(300, 400, function ($constraint) {
                $constraint->upsize();
            })
            ->resizeCanvas(320, 420, 'center', false, 'ffffff');
    }
}