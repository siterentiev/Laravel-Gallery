<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    private $images;

    public function __construct(ImageService $imageService)
    {
        $this->images = $imageService;
    }

    function index() {
        $images = $this->images->all();
        return view('welcome', ['imagesInView' => $images]);
    }

        function create() {
        return view('create');
    }

    function store(Request $request) {
        $filename = $request->image->store('uploads');
        $this->images->add($filename);
        return redirect('/');
    }

    function show($id) {
        $myImage = $this->images->one($id);
        return view('show', ['imageInView' => $myImage->image]);
    }

    function edit($id) {
        $image = $this->images->one($id);
        return view('edit', ['imageInView' => $image]);
    }

    function update(Request $request, $id) {
        $this->images->update($id, $request->image);
        return redirect('/');
    }

    function delete($id) {
        $this->images->delete($id);
        return redirect('/');
    }
}
