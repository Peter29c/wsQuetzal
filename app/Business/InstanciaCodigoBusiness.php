<?php

namespace App\Business;

// Models
use App\Models\InstanciaSistema;
// Facades
use Illuminate\Support\Facades\DB;

//Models

/**
 * Clase de negocios del InstanciaCodigo
 *
 * Created by Edewaldo Nuñez.
 * Date: 16 Jun 2020
 */
class InstanciaCodigoBusiness
{

     /**
     *  valida que el InstanciaCodigo exista en el sistema
     *
     * @return \App\Model\Usuario
     */
    public static function fnLoginUser($code,$idCliente)
    {
        
        $idSistema = InstanciaSistema::where("idCliente", "=", $idCliente)->select("idInstanciaSistema")->first();
  
        // Guarda el codigo en el sistenma deacuerdo a la instancia de usuario logeado
        $instancia_codigos = new InstanciaCodigos;

        $instancia_codigos->idInstanciaSistema = $idSistema->idInstanciaSistema;
        $instancia_codigos->codigo = $code;
        $instancia_codigos->activo = 1;
        $instancia_codigos->created_at = date("Y-m-d H:i:s");
        $instancia_codigos->save();

        return true;
    }
}
