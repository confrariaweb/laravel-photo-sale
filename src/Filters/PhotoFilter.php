<?php

namespace ConfrariaWeb\PhotoSale\Filters;

use Illuminate\Support\Facades\Config;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class PhotoFilter implements FilterInterface
{
    private $type;

    /**
     * PhotoFilter constructor.
     */
    public function __construct($type)
    {
        $this->type = Config::get('cw_photo_sale.types.' . $type);
    }

    public function applyFilter(Image $img)
    {
        $widthImg = $img->width();
        $heightImg = $img->height();
        $width = $this->type['width'] ?? $widthImg;
        $height = $this->type['height'] ?? $heightImg;
        $border = $this->type['border'] ?? 0;
        $widthCanva = $width + ($border * 2);
        $heightCanva = $height + ($border * 2);
        $rotateImg = ($widthImg <= $heightImg) ? 0 : -90;
        if (!isset($this->type)) {
            return $img->rotate($rotateImg);
        }
        return $img
            ->rotate($rotateImg)
            ->fit($width, $height)
            ->resizeCanvas($widthCanva, $heightCanva, 'center', false, 'ffffff');
    }
}