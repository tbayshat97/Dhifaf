<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Models\Album;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Galleries"],
        ];

        $addNewBtn = "admin.gallery.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.galleries.list', compact('galleries', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/gallery", 'name' => "Galleries"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend.galleries.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddGalleryRequest $request)
    {
        try {
            $gallery = new Gallery();

            if ($request->file('image')) {
                $image = uploadFile('gallery', $request->file('image'));
                $galleryImage[] = saveFileUploaderMedia($image, $request->file('image'), 'gallery');
            }

            $gallery->image = json_encode($galleryImage);
            $gallery->save();

            if ($request->hasfile('gallery_image')) {
                foreach ($request->file('gallery_image') as $file) {
                    $image = uploadFile('album', $file);
                    $albumGallery[] = saveFileUploaderMedia($image, $file, 'album');
                }
            }

            $album = new Album();
            $album->gallery_id = $gallery->id;
            $album->gallery_image = count($albumGallery) ? json_encode($albumGallery) : null;
            $album->save();

            foreach ($this->lang as $lang) {
                $gallery->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $gallery->save();
            }

            return redirect(route('admin.gallery.show', $gallery))->with('success', __('system-messages.add'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/gallery", 'name' => "Galleries"], ['name' => "Update"]
        ];

        return view('backend.galleries.show', compact(['gallery', 'langs', 'breadcrumbs']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        try {
            if ($request->file('image')) {
                $oldImage = $gallery->getProductImage();
                $image = uploadFile('gallery', $request->file('image'), $oldImage);
                $galleryImage[] = saveFileUploaderMedia($image,  $request->file('image'), 'gallery');

                $gallery->image = json_encode($galleryImage);
            }

            $gallery->save();

            $current_images = getCurrentFileUploaderMedia($request->get('fileuploader-list-gallery_image'));

            $updated_images = getUpdatedFileUploaderMedia($gallery->album->gallery_image, $current_images);

            if ($request->hasfile('gallery_image')) {
                foreach ($request->file('gallery_image') as $file) {
                    $image = uploadFile('album', $file);
                    $updated_images[] = saveFileUploaderMedia($image,  $file, 'album');
                }
            }

            $album = Album::where('gallery_id', $gallery->id)->first();
            $album->gallery_image = json_encode($updated_images);
            $album->save();

            foreach ($this->lang as $lang) {
                $gallery->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
                $gallery->save();
            }

            return redirect(route('admin.gallery.show', $gallery))->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect(route('admin.gallery.index'))->with('success', __('system-messages.delete'));
    }
}
