<?php

namespace ConfrariaWeb\PhotoSale\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class PolaroidFilter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(750, 1010)->greyscale();
    }
}