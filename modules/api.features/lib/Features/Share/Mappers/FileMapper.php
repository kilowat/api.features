<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\FileResponse;
use Api\Features\Share\Models\FileModel;
use Bitrix\Main\EO_File;

trait FileMapper
{
    public function toResponse(): FileResponse
    {
        return new FileResponse(
            id: $this->id,
            name: $this->name,
            originalName: $this->originalName,
            width: $this->width,
            height: $this->height,
            contentType: $this->contentType,
            description: $this->description,
            size: $this->size,
            src: $this->src,
        );
    }

    public static function fromEntity(EO_File $entity): FileModel
    {
        return new FileModel(
            id: $entity->getId(),
            name: $entity->getFileName(),
            originalName: $entity->getOriginalName(),
            width: $entity->getWidth(),
            height: $entity->getHeight(),
            contentType: $entity->getContentType(),
            description: $entity->getDescription(),
            size: $entity->getFileSize(),
            src: getDomain().\CFile::GetPath($entity->getId()) ?? '',
        );
    }
}