<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emailMap = [
            "omran" => [
                "omran1@email.com",
                "omran2@email.com",
                "omran3@email.com",
                "omran4@email.com",
                "omran5@email.com",
            ],
            "ayoub" => [
                "ayoub1@email.com",
                "ayoub2@email.com",
                "ayoub3@email.com"
            ],
            "anas" => [
                "anas1@email.com ",
                "anas2@email.com",
                "anas3@email.com",
                "anas4@email.com",
            ],
            "test" => [
                "test1@email.com",
                "test2@email.com ",
                "test3@email.com",
                "test4@email.com"
            ]
        ];

        $allTeam = Team::all();
        foreach ($allTeam as $team) {
            $emailList = $emailMap[$team->name];
            if ($emailList == null) continue;
            foreach ($emailList as $key => $userEmail) {
                $status = 'Member';
                if($key == array_key_first($emailList)) $status = "Owner";
                if($key == array_key_last($emailList)) $status = "Pending";

                $user = User::where("email", $userEmail)->first();
                if ($user == null) continue;
                UserTeam::create([
                    "user_id" => $user->id,
                    "team_id" => $team->id,
                    "status" => $status
                ]);
            }
        }
    }
}
