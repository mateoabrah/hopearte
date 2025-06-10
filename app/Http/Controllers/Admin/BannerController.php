<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    /**
     * Mostrar la página de gestión del banner
     */
    public function index()
    {
        // Obtener cervezas destacadas ordenadas por la posición en el banner
        $featuredBeers = Beer::where('featured_in_banner', true)
                            ->orderBy('banner_position')
                            ->get();
                            
        // Obtener cervezas disponibles (no destacadas)
        $availableBeers = Beer::where('featured_in_banner', false)
                             ->orderBy('name')
                             ->get();
                             
        return view('admin.banner.index', compact('featuredBeers', 'availableBeers'));
    }
    
    /**
     * Activar/desactivar una cerveza en el banner
     */
    public function toggleFeatured(Beer $beer)
    {
        try {
            if ($beer->featured_in_banner) {
                // Si la cerveza ya está en el banner, la quitamos
                $beer->featured_in_banner = false;
                $beer->banner_position = null;
                $beer->save();
                
                // Reordenar las posiciones de las cervezas restantes
                $this->reorderAfterRemoval();
                
                return redirect()->route('admin.banner.index')
                    ->with('success', 'Cerveza eliminada del banner correctamente');
            } else {
                // Si la cerveza no está en el banner, la añadimos
                $beer->featured_in_banner = true;
                
                // Asignar la última posición
                $lastPosition = Beer::where('featured_in_banner', true)
                                   ->max('banner_position') ?? 0;
                $beer->banner_position = $lastPosition + 1;
                
                $beer->save();
                
                return redirect()->route('admin.banner.index')
                    ->with('success', 'Cerveza añadida al banner correctamente');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.banner.index')
                ->with('error', 'Error al actualizar el banner: ' . $e->getMessage());
        }
    }

    /**
     * Reordenar las cervezas en el banner
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request)
    {
        try {
            // Validar la solicitud
            $validated = $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'required|integer|exists:beers,id',
            ]);

            // Obtener los IDs en el nuevo orden
            $ids = $validated['ids'];
            
            // Actualizar el orden en la base de datos
            foreach ($ids as $position => $beerId) {
                Beer::where('id', $beerId)
                    ->update(['banner_position' => $position + 1]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Orden guardado correctamente'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al reordenar el banner: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el orden: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reordenar posiciones después de eliminar una cerveza
     */
    private function reorderAfterRemoval()
    {
        $featuredBeers = Beer::where('featured_in_banner', true)
                            ->orderBy('banner_position')
                            ->get();
                            
        foreach ($featuredBeers as $index => $beer) {
            $beer->banner_position = $index + 1;
            $beer->save();
        }
    }
}
