<?php

namespace App\Http\Controllers;

use App\Logic\CardLogic;
use App\Logic\TeamLogic;
use App\Models\Board;
use App\Models\Card;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function __construct(protected TeamLogic $teamLogic, protected CardLogic $cardLogic)
    {
    }
    public function showCard(Request $request, $team_id, $board_id, $card_id)
    {
        $board_id = intval($board_id);
        $team_id = intval($team_id);

        $card = Card::find($card_id);


        $board = Board::find($board_id);
        $team = Team::find($team_id);
        $owner = $this->teamLogic->getTeamOwner($team_id);
        $workers = $this->cardLogic->getWorkers($card_id, $team_id);
        $hist = $this->cardLogic->getHistories($card_id);

        return view("card")
            ->with("card", $card)
            ->with("board", $board)
            ->with("team", $team)
            ->with("workers", $workers)
            ->with("histories", $hist)
            ->with("owner", $owner);
    }

    public function assignCard(Request $request, $team_id, $board_id, $card_id)
    {
        return redirect()->back();
    }

    public function assignSelf(Request $request, $team_id, $board_id, $card_id)
    {
        $user_id = Auth::user()->id;
        $card_id = intval($card_id);
        $this->cardLogic->addUser($card_id, $user_id);
        $this->cardLogic->cardAddEvent($card_id, $user_id, "Joined card.");
        return redirect()->back()->with("notif", ["Success\nAdded yourself to the card"]);
    }

    public function assignCardMember(Request $request, $team_id, $board_id, $card_id)
    {
        $user_id = Auth::user()->id;
        $team = Team::findOrFail($team_id);
        $board = Board::findOrFail($board_id);
        $card = Card::findOrFail($card_id);
        // Vérifier si l'utilisateur authentifié est le propriétaire de l'équipe
//        if ($user_id !== $team->owner_id) {
//            abort(403, "You don't have permission to assign members to this card.");
//        }
        $assigned_user_id = $request->input('assigned_user');
        // S'assurer que l'utilisateur assigné est un membre valide de l'équipe
        if (!$team->users->contains($assigned_user_id)) {
            return redirect()->back()->withErrors(['assigned_user' => 'Invalid assigned user.']);
        }
        $this->cardLogic->addUser($card_id, $assigned_user_id);
        $this->cardLogic->cardAddEvent($card_id, $user_id, "Assigned card to a member.");
        return redirect()->back()->with("notif", ["Success\nAssigned a member to the card."]);
    }




    public function leaveCard(Request $request, $team_id, $board_id, $card_id)
    {
        $user_id = Auth::user()->id;
        $card_id = intval($card_id);
        $this->cardLogic->removeUser($card_id, $user_id);
        $this->cardLogic->cardAddEvent($card_id, $user_id, "Left card.");
        return redirect()
            ->route("board", ["team_id" => $team_id, "board_id" => $board_id])
            ->with("notif", ["Success\nQuit Card"]);
    }

    public function deleteCard(Request $request, $team_id, $board_id, $card_id)
    {
        $this->cardLogic->deleteCard(intval($card_id));
        return redirect()
            ->route("board", ["team_id" => $team_id, "board_id" => $board_id])
            ->with("notif", ["Success\nCard is deleted"]);
    }

//    old
//    public function updateCard(Request $request, $team_id, $board_id, $card_id)
//    {
//        $request->validate([
//            "card_name" => "required|max:95"
//        ]);
//        $user_id = Auth::user()->id;
//        $card_id = intval($card_id);
//        $card = Card::find($card_id);
//        $card->name = $request->card_name;
//        $card->description = $request->card_description;
//        $card->save();
//        $this->cardLogic->cardAddEvent($card_id, $user_id, "Updated card informations.");
//        return redirect()->back()->with("notif", ["Succss\nCard updated successfully"]);
//    }

//  new
//    public function updateCard(Request $request, $team_id, $board_id, $card_id)
//    {
//        $request->validate([
//            "card_name" => "required|max:95"
//        ]);
//
//        $user_id = Auth::user()->id;
//        $card = Card::findOrFail($card_id);
//
//        // Update the card properties based on the form data
//        $card->name = $request->input('card_name');
//        $card->description = $request->input('card_description');
//        $card->priority = $request->input('priority');
//        $card->type = $request->input('card_type');
//        $card->type_color = $request->input('type_color');
//        $card->estimated_time = $request->input('estimated_time'); // Update the estimated time
//
//        // Save the updated card
//        $card->save();
//
//        // Add event logic, if applicable
//        $this->cardLogic->cardAddEvent($card_id, $user_id, "Updated card information.");
//
//        return redirect()->back()->with("notif", ["Success\nCard updated successfully"]);
//    }


    public function updateCard(Request $request, $team_id, $board_id, $card_id)
    {
        $request->validate([
            "card_name" => "required|max:95"
        ]);

        $user_id = Auth::user()->id;
        $card = Card::findOrFail($card_id);

        // Update the card properties based on the form data
        $card->name = $request->input('card_name');
        $card->description = $request->input('card_description');
        $card->priority = $request->input('priority');
        $card->type = $request->input('card_type');
        $card->type_color = $request->input('type_color');
        $card->start_date = $request->input('start_date');
        $card->estimated_end_date = $request->input('estimated_end_date');

        // Update the estimated time
        $card->estimated_time = $request->input('estimated_time'); // Add this line

        // Save the updated card
        $card->save();

        // Add event logic, if applicable
        $this->cardLogic->cardAddEvent($card_id, $user_id, "Updated card information.");

        return redirect()->back()->with("notif", ["Success\nCard updated successfully"]);
    }




    public function addComment(Request $request, $team_id, $board_id, $card_id)
    {
        $request->validate(["content" => "required|max:200"]);
        $user_id = Auth::user()->id;
        $card_id = intval($card_id);
        $this->cardLogic->cardComment($card_id, $user_id, $request->content);
        return redirect()->back();
    }
}
