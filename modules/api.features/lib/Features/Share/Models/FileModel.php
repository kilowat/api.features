<?php

namespace Api\Features\Share\Models;

use Api\Core\Pic;
use Api\Features\Share\Mappers\FileMapper;

class FileModel
{
    use FileMapper;

    public function __construct(
        public int $id,
        public string $name,
        public string $originalName,
        public int $width,
        public int $height,
        public string $contentType,
        public string $description,
        public int $size,
        public string $src,
    ){}

    public static function fromId(
        $id,
        array $arSize,
        bool $comress = true,
        bool $isProportional = true,
        int $resizeType = BX_RESIZE_IMAGE_PROPORTIONAL,
        bool $bInitSizes = false,
        array $arFilters = [],
        bool $bImmediate = false,
        bool $jpgQuality = false
    ): FileModel | null
    {
        if($id == null) return null;

        $resizeFile = [];
        if($comress) {
            $resizeFile = Pic::resizeById(
                id: $id,
                width: $arSize['width'] ?? 10000,
                height: $arSize['height'] ?? 10000,
                isProportional: $isProportional,
            );
        }


        //if(!isset($resizeFile['SRC'])) return null;

        $fetchFile = \CFile::GetByID($id);
        $file = $fetchFile->Fetch();
        $src = $resizeFile['SRC'] ? getDomain().$resizeFile['SRC'] : getDomain().\CFile::GetPath($id);

        return new FileModel(
            id: $id,
            name: $file['FILE_NAME'],
            originalName: $file['ORIGINAL_NAME'],
            width: $resizeFile['WIDTH'] ?? $file['WIDTH'],
            height: $resizeFile['HEIGHT'] ?? $file['HEIGHT'],
            contentType: $file['CONTENT_TYPE'],
            description: $file['DESCRIPTION'],
            size: $file['FILE_SIZE'] ?? 0,
            src: $src,
        );
    }
}