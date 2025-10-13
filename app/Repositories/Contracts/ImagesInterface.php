<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface ImagesInterface
{
    public function uploadMultiple(Request $images, int $id, $path);
    public function uploadSingle(Request $images, int $id, $path, $attribute);
    public function update(Request $images, int $id, $pathName, $attribute);
    public function deleteColumn(int $id, $attribute);
}
