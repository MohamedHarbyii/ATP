<?php

namespace App;

use App\Models\Game;

class GameDB
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function Get_game_with_backages()
    {
        $games = Game::with('packages')->get();

        return $games;

    }

    public static function store($data)
    {
        $game = Game::create($data);
        if (isset($data['image'])) {
            ImageService::upload($game, 'game');
        }
        if (isset($data['package_id'])) {
            $package = PackageDB::get_package($data['package_id']);
            PackageDB::attach_backage_to_game($package, $game->id);
        }

        return $game->load(['packages', 'media']);
    }

    public static function update(Game $game, $data)
    {
        $game->update($data);
        if (isset($data['image'])) {
            ImageService::update($game, 'game');
        }
        if (isset($data['package_id'])) {
            $package = PackageDB::get_package($data['package_id']);
            PackageDB::attach_backage_to_game($package, $game->id);
        }

        return $game->load('packages');
    }

    public static function delete(Game $game)
    {
        $game->delete();
        ImageService::delete($game, 'game');
    }
}
