<?php

namespace App\Functions;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageIntervention;

class Images
{
    /**
     * Get the Filename of Class Constructor.
     *
     * @return string
     */
    protected $filename;

    /**
     * Get the Path of Class Constructor.
     *
     * @return string
     */
    protected $path;

    /**
     * Get the Width of Class Constructor.
     *
     * @return int
     */
    protected $width;

    /**
     * Get the Height of Class Constructor.
     *
     * @return int
     */
    protected $height;

    /**
     * instantiate an Image of a Class Constructor.
     *
     */
    public function __construct(string $filename, string $path, int $width, int $height)
    {
        $this->filename = $filename;
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Store images to storage folder and resize it.
     *
     * @return $url
     * @var string
     */
    public function storeToStorage(mixed $new_image_file, mixed $old_image_file = null): string
    {
        $formatted_picture = $this->filename.'-'.time().'.'.$new_image_file->getClientOriginalExtension();

        if (!file_exists(storage_path("app/public/$this->path/"))) {
            mkdir(storage_path("app/public/$this->path/"), 0775, true);
        }

        if ((!is_null($old_image_file)) && Storage::exists("/public/$this->path/".getFileName($old_image_file))) {
            Storage::delete("/public/$this->path/".getFileName($old_image_file));
        }

        ImageIntervention::make($new_image_file)->resize($this->width, $this->height)->save(storage_path("app/public/$this->path/".$formatted_picture));

        return url("storage/.'$this->path'./$formatted_picture");
    }
}
