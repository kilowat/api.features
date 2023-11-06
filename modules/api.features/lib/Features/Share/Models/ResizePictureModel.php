<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Mappers\ResizePictureMapper;

class ResizePictureModel
{
    use ResizePictureMapper;

    public function __construct(
        public ?FileModel $sm = null,
        public ?FileModel $md = null,
        public ?FileModel $orig = null,
    )
    {
    }

}