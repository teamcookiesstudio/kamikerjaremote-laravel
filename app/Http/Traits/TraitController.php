<?php

namespace App\Http\Traits;

use Storage;

trait TraitController
{
    public function findImage($opt = null)
    {
        return $this->triggerFindImage($opt);
    }

    public function triggerFindImage($image = null)
    {
        return $this->cekIfImageHasHttp($image) ? $image :
        ($image != null ? asset('storage/profile/'.$image) : asset('images/no_avatar.jpg'));
    }

    private function insertImage($request, $model, $attributes = [])
    {
        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                if ($request->hasFile($key)) {
                    if (!empty($value)) {
                        $file = Storage::disk('public')->delete('/profile/'.$value);
                    }

                    $fileName = ''.uniqid().'.'.
                    $request->file($key)->getClientOriginalExtension();
                    $request->file($key)->move(storage_path().'/app/public/profile/', $fileName);

                    $model->$key = $fileName;
                    $model->update();
                }
            }
        }
    }

    public function cekIfImageHasHttp($image)
    {
        return strpos($image, 'http') !== false;
    }
}
