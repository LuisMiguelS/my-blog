<?php

namespace App\Http\Controllers;

use App\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('anuncios.index', [
            'anuncios' => Anuncio::where('estado', '=', 1)
                ->orderBy('id_anuncio', 'ASC')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('anuncios.edit', [
            'anuncio' => Anuncio::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:5120'
        ]);

        $anuncio = Anuncio::findOrFail($id);
        $anuncio->link = (! $anuncio->requiere_imagen) ? $this->updateWithVideo($request->link) : $request->link;
        $anuncio->mostrar = $request->mostrar;

        if(request()->hasFile('image'))
        {
            if(! is_null($anuncio->image))
                unlink(storage_path('app/public/' . $anuncio->image));

            $anuncio->image = $request->file('image')->store('anuncio', 'public');
        }

        $anuncio->update();

        return redirect()->route('anuncios.index')->with(['success' => "¡El anuncio No. {$anuncio->id_anuncio} se ha actualizado correctamente!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->mostrar = 0;
        $anuncio->update();

        return redirect()->route('anuncios.index')->with(['success' => "¡El anuncio No. {$anuncio->id_anuncio} se ha ocultado correctamente!"]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $anuncio->mostrar = 1;
        $anuncio->update();

        return redirect()->route('anuncios.index')->with(['success' => "¡El anuncio No. {$anuncio->id_anuncio} se ha ocultado correctamente!"]);
    }

    public function updateWithVideo ($url)
    {
        $url_parts = explode(' ', $url);

        for($x = 0; $x < count($url_parts); $x++)
        {
            if(substr($url_parts[$x], 0, 5) == 'width')
            {
                $url_parts[$x] = 'width="100%"';
                break;
            }
        }

        $url_final = implode(' ', $url_parts);

        return  $url_final;
    }
}
