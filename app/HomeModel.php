<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeModel extends Model
{
    private $contacts;
    private $favorites;

    public function __construct
    (
        Contacts $modelContacts,
        FavoritesContacts $modelFavorites
    )
    {
        $this->contacts = $modelContacts;
        $this->favorites = $modelFavorites;
    }

    public function getContacts()
    {
        $user_id = addslashes(Auth::id());
        $query = $this->contacts
            ->select(['contacts.*', 'fc.id as id_favorites'])
            ->leftJoin($this->favorites->getTable() . ' as fc', function($q) use ($user_id)
            {
                $q->on('fc.id_contats', '=', 'contacts.id')
                    ->on('fc.id_user', '=', DB::raw($user_id));
            })
            ->orderBy('contacts.id')
            ->get();

        return $query->isEmpty() ? [] : $query->toArray();
    }

    public function getFavoritesByUser()
    {
        $query = $this->contacts
            ->select(['contacts.*', 'fc.id as id_favorites'])
            ->join($this->favorites->getTable() . ' as fc', 'fc.id_contats', '=', 'contacts.id')
            ->where(['fc.id_user' => Auth::id()])
            ->orderBy('contacts.id')
            ->get();

        return $query->isEmpty() ? [] : $query->toArray();
    }

    public function saveFavorites($request)
    {
        $res = $this->favorites->insert([
            'id_contats' => $request->id,
            'id_user' => Auth::id()
        ]);

        return $res;
    }
}
