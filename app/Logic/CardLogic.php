<?php

namespace App\Logic;

use App\Models\Card;
use App\Models\CardHistory;
use App\Models\CardUser;
use App\Models\User;

class CardLogic
{
    public function getData(int $card_id) {
        $card = Card::find($card_id);
        return $card;
    }


    //  workers in the card and in the team on the same time
    public function getWorkers(int $card_id, int $team_id) {
        // $users = Card::find($card_id)->users()->get();
        $users = User::join('card_user', 'users.id', '=', 'card_user.user_id')
            ->join('cards', 'cards.id', '=', 'card_user.card_id')
            ->join('columns', 'columns.id', '=', 'cards.column_id')
            ->join('boards', 'boards.id', '=', 'columns.board_id')
            ->join('teams', 'teams.id', '=', 'boards.team_id')
            ->join('user_team', 'users.id', '=', 'user_team.user_id')
            ->where('card_user.card_id', $card_id)
            ->where('teams.id', $team_id)
            ->select('users.*')
            ->get();
        return $users;
    }

    public function addUser(int $card_id, int $user_id) {
        CardUser::create([
            "user_id" => $user_id,
            "card_id" => $card_id,
        ]);
        return;
    }

    public function removeUser(int $card_id, int $user_id) {
        CardUser::where([
            "user_id" => $user_id,
            "card_id" => $card_id,
        ])->delete();
        return;
    }

    function cardAddEvent(int $card_id, int $user_id, string $content){
        $event = CardHistory::create([
            "user_id" => $user_id,
            "card_id" => $card_id,
            "type" => "event",
            "content" => $content,
        ]);

        return $event;
    }

    function cardComment(int $card_id, int $user_id, string $content){
        $event = CardHistory::create([
            "user_id" => $user_id,
            "card_id" => $card_id,
            "type" => "comment",
            "content" => $content,
        ]);

        return $event;
    }

    function getHistories(int $card_id){
        $evets = CardHistory::with("user")
            ->where("card_id", $card_id)
            ->orderBy("created_at")
            ->get();
        return $evets;
    }

    function deleteCard(int $target_card_id){
        $target_card = Card::find($target_card_id);
        $top_card = null;
        $bottom_card = null;
        if(!$target_card) return;
        if($target_card->previous_id) $top_card = Card::find($target_card->previous_id);
        if($target_card->next_id) $bottom_card = Card::find($target_card->next_id);

        if($top_card){
            $top_card->next_id = $bottom_card ? $bottom_card->id : null;
            $top_card->save();
        }
        if($bottom_card){
            $bottom_card->previous_id = $top_card ? $top_card->id : null;
            $bottom_card->save();
        }
        $target_card->delete();
    }
}
