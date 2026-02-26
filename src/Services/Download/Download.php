<?php

namespace RaifuCore\Support\Services\Download;

use Exception;
use RaifuCore\Support\Helpers\StringHelper;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class Download
{
    const KEY = '_rc_download_key_';

    /**
     * @throws Throwable
     */
    public static function setFile(DownloadRequestDto $dto): void
    {
        $filepath = $dto->getPath();

        if (! file_exists($filepath)) {
            throw new Exception('File not found');
        }

        // Собираем итоговое имя файла
        $inputName = $dto->getName();

        $targetFilename  = pathinfo($inputName ?: '', PATHINFO_FILENAME) ?: pathinfo($filepath, PATHINFO_FILENAME);
        $targetExtension = pathinfo($inputName ?: '', PATHINFO_EXTENSION) ?: pathinfo($filepath, PATHINFO_EXTENSION);

        $filename = $targetFilename . ($targetExtension ? '.' . $targetExtension : '');

        // Кладём уже нормализованный DTO
        $normalizedDto = new DownloadRequestDto(
            path: $filepath,
            name: $filename,
            deleteAfterDownload: $dto->isDeleteAfterDownload()
        );

        self::_setData($normalizedDto);
    }

    /**
     * @throws Throwable
     */
    public static function execute(): BinaryFileResponse
    {
        $dto = self::_getData();

        self::_unsetData();

        $response = response()
            ->download(
                $dto->getPath(),
                $dto->getName(),
                ['Content-Type' => 'application/octet-stream']
            );

        if ($dto->isDeleteAfterDownload()) {
            $response->deleteFileAfterSend();
        }

        return $response->send();
    }

    /**
     * @throws Throwable
     */
    private static function _getData(): DownloadRequestDto
    {
        $data = session()->get(self::KEY, []);

        $path   = $data['p'] ?? null;
        $name   = $data['n'] ?? null;
        $delete = $data['d'] ?? null;
        $secure = $data['s'] ?? null;

        if (!is_bool($delete)) {
            $delete = null;
        }

        if (
            !$path ||
            !$name ||
            $delete === null ||
            !$secure ||
            $secure !== StringHelper::arrayHash([$path, $name, (int)$delete])
        ) {
            throw new Exception('Wrong secure');
        }

        if (!file_exists($path)) {
            throw new Exception('File not found');
        }

        // Возвращаем DTO обратно
        return new DownloadRequestDto(
            path: $path,
            name: $name,
            deleteAfterDownload: $delete
        );
    }

    private static function _setData(DownloadRequestDto $dto): void
    {
        $path = $dto->getPath();
        $name = $dto->getName();
        $delete  = $dto->isDeleteAfterDownload();

        session()->put(self::KEY, [
            'p' => $path,
            'n' => $name,
            'd' => $delete,
            's' => StringHelper::arrayHash([$path, $name, (int)$delete]),
        ]);
    }

    private static function _unsetData(): void
    {
        session()->forget(self::KEY);
    }
}
