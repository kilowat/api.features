<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]

class ResizePictureResponse
{
    public function __construct(
        #[OA\Property(description: 'Маленькая', nullable: true)]
        public ?FileResponse $sm,

        #[OA\Property(description: 'Средняя', nullable: true)]
        public ?FileResponse $md,

        #[OA\Property(description: 'Оригинальная', nullable: true)]
        public ?FileResponse $orig,
    )
    {
    }
}