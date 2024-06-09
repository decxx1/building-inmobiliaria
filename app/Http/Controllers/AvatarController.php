<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;
use Intervention\Image\Laravel\Facades\Image as ImageIntervention;

class AvatarController extends Controller
{
    public function get(int $user_id){
        $userAvatar = Avatar::where('user_id', $user_id)->first();
        $APP_URL = env('APP_URL');
        $avatar = !$userAvatar  ? $APP_URL.'avatar.webp' : $APP_URL.$userAvatar->thumbnail;

        return $avatar;
    }

    public function upload(Request $request, int $id)
    {
        try{
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $newName = 'original_'. '_' . uniqid(). '.' . $ext;
            $destination = 'avatars/'.$id;

            // Guardar la imagen en un directorio
            $imagePath = $file->storeAs($destination, $newName,['disk' => 'public_uploads']);
            // crear miniatura
            $thumbnailPath = $this->thumbnailWebp($file, 96, $destination);

            // Verificar si ya existe un avatar para el user_id
            $existingAvatar = Avatar::where('user_id', $id)->first();

            //Actualizar avatar
            if ($existingAvatar) {
                // Eliminar el avatar existente
                $this->destroyImages([$existingAvatar->original, $existingAvatar->thumbnail]);

                // Actualizar el avatar existente
                $existingAvatar->original = $imagePath;
                $existingAvatar->thumbnail = $thumbnailPath;
                $existingAvatar->save();

                return $existingAvatar;
            }

            //crear nuevo avatar
            $avatar = new Avatar;
            $avatar->user_id = $id;
            $avatar->original = $imagePath;
            $avatar->thumbnail = $thumbnailPath;
            $avatar->save();
            return $avatar;
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
            $newName = 'thumbnail_'. '_' . uniqid() . '.webp';
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

    // cuando se elimine un usuario se eliminará el avatar automáticamente
    // public function destroy(int $id)
    // {
    //     try{
    //         $avatar = Avatar::where('user_id', $id)->first();
    //         if($avatar){
    //             $this->destroyImages([$avatar->original, $avatar->thumbnail]);
    //         }
    //         $avatar->delete();
    //         return redirect()->back();
    //     } catch (\Exception $e){
    //         return redirect()->back()->withErrors([
    //             'message' => 'Error al eliminar la imagen',
    //             'error' => $e->getMessage()
    //         ]);
    //     }
    // }
}
