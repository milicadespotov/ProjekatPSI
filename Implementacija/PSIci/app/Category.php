<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja vraća žanr vezan za kategoriju
     *
     * @param
     * @return Genre
     */
    public function genre(){
        return $this->hasOne('App\Genre', 'category_id');
    }

    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja vraća glumca vezanog za kategoriju
     *
     * @param
     * @return Actor
     */
    public function actor(){
        return $this->hasOne('App\Actor', 'category_id');
    }
    /**
     * Autor: Tijana Jovanović 0008/2015
     * Funkcija koja vraća režisera vezanog za kategoriju
     *
     * @param
     * @return Director
     */

    public function director(){
        return $this->hasOne('App\Director', 'category_id');
    }
}
