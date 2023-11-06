<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\MetaDataResponse;

trait MetaDataMapper
{
    public function toResponse(): MetaDataResponse
    {
        return new MetaDataResponse(
            title: htmlspecialchars_decode($this->title),
            description: htmlspecialchars_decode($this->description),
        );
    }

}