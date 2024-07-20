<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Intervention\Image\Laravel\Facades\Image as ImageIntervention;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    public function getThumb(int $property_id, int $position){
        $image = Image::where('property_id', $property_id)->where('position', $position)->first();
        $APP_URL = env('APP_URL');
        $result = $image ? $APP_URL.$image->thumbnail : '';
        return $result;
    }
    public function getOriginal(int $property_id, int $position){
        $image = Image::where('property_id', $property_id)->where('position', $position)->first();
        $APP_URL = env('APP_URL');
        $result = $image ? $APP_URL.$image->original : '';
        return $result;
    }
    public function getImageFull(int $property_id, int $position){
        $image = Image::where('property_id', $property_id)->where('position', $position)->first();
        if(!$image){
            return [];
        }
        $APP_URL = env('APP_URL');
        $image->thumbnail = $image->thumbnail ? $APP_URL.$image->thumbnail : '';
        $image->original = $image->original ? $APP_URL.$image->original : '';
        // Obtener las dimensiones de la imagen original
        if ($image->original) {
            $path = public_path(str_replace($APP_URL, '', $image->original));
            $img = ImageIntervention::read($path);
            $image->width = $img->width();
            $image->height = $img->height();
        } else {
            $image->width = null;
            $image->height = null;
        }
        return $image;
    }

    public function upload(UploadedFile $file, int $id, int $position)
    {
        try{
            $ext = $file->getClientOriginalExtension();
            $newName = 'original_'. '_' . uniqid(). '.' . $ext;
            $destination = 'images/properties/'.$id;

             // Obtener la ruta completa del destino
            $rootPath = public_path($destination);

            // Crear el directorio si no existe
            if (!file_exists($rootPath)) {
                mkdir($rootPath, 0775, true);
                chmod($rootPath, 0775);
            }

            // Guardar la imagen en un directorio
            $imagePath = $file->storeAs($destination, $newName,['disk' => 'public_uploads']);
            // crear miniatura
            $thumbnailPath = $this->thumbnailWebp($file, 300, $destination);

            // Verificar si ya existe una imagen para el property_id
            $existingImageCover = Image::where('property_id', $id)->where('position', $position)->first();

            //Actualizar imagen
            if ($existingImageCover) {
                // Eliminar la imagen existente
                $this->destroyImages([$existingImageCover->original, $existingImageCover->thumbnail]);

                // Actualizar la imagen existente
                $existingImageCover->original = $imagePath;
                $existingImageCover->thumbnail = $thumbnailPath;
                $existingImageCover->save();

                return $existingImageCover;
            }

            //crear nuevo imagen
            $imageCover = new Image;
            $imageCover->property_id = $id;
            $imageCover->position = $position;
            $imageCover->original = $imagePath;
            $imageCover->thumbnail = $thumbnailPath;
            $imageCover->save();
            return $imageCover;
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al guardar la imagen en la base de datos',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function thumbnailWebp($file, $width, $path)
    {
        try{
            $newName = 'thumb_'. '_' . uniqid() . '.webp';
            $destination = $path.'/'.$newName;
            $image = ImageIntervention::read($file);

            $image->scale(width:$width);
            // encoding webp data and save
            $image->toWebp(60)->save($destination);
            return $destination;
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al crear miniatura de la imagen',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroyImages(array $images){
        try{
            foreach ($images as $image) {
                $path = public_path($image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        } catch (\Exception $e){
            return redirect()->back()->withErrors([
                'message' => 'Error al eliminar la imagen',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy( int $id, int $position): JsonResponse
    {

        try{
            $image = Image::where('property_id', $id)->where('position', $position)->firstOrFail();
            // Eliminar físicamente las imagenes original y thumbnail
            $this->destroyImages([$image->original, $image->thumbnail]);

            // Eliminar la imagen de la base de datos
            $image->delete();

            return response()->json([
                'message' => '¡Imagen eliminada!',
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'message' => 'Error al eliminar la imagen!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
