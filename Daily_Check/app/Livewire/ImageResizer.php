<?php

namespace App\Livewire;

use Livewire\Component;
use Intervention\Image\ImageManagerStatic as Image;

class ImageResizer extends Component
{
public $message = '';

public function resizeImage()
{
try {
$imagePath = public_path('images/test.png');

if (!file_exists($imagePath)) {
$this->message = 'Error: Image file does not exist at ' . $imagePath;
return;
}

$image = Image::make($imagePath)->resize(300, 200);
$resizedImagePath = public_path('images/resized_test.png');
$image->save($resizedImagePath);

$this->message = 'Image resized and saved successfully!';
} catch (\Exception $e) {
$this->message = 'Error: ' . $e->getMessage();
}
}

public function render()
{
$resizedImagePath = 'images/resized_test.png';
$imageExists = file_exists(public_path($resizedImagePath));

return view('livewire.image-resizer', [
'imageExists' => $imageExists,
'resizedImagePath' => $resizedImagePath,
'message' => $this->message, // ここで $message をビューに渡します
]);
}
}
